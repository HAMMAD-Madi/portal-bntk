<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Libraries\PcmanGtin;
use RuntimeException;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InventoryProductExport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use GtinValidation\GtinValidator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;


class ProductController extends Controller
{

    public function check_product(Request $request)
    {
        $item_no   = $request->item_no;
        $color     = $request->color;
        $condition = strtolower($request->condition); // normalize

        $exists = DB::table('products')
            ->where('item_no', $item_no)
            ->where('color_id', $color)
            ->whereRaw('LOWER(`condition`) = ?', [$condition])
            ->exists();

        return response()->json($exists);
    }


    public function updateLocation(Request $request)
    {
        $ids = $request->ids;          // array of product IDs
        $location = $request->location;

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['success' => false, 'message' => 'No products selected']);
        }

        if (!$location || trim($location) === '') {
            return response()->json(['success' => false, 'message' => 'Location is required']);
        }

        try {
            DB::table('products')
                ->whereIn('id', $ids)
                ->update([
                    'location_id' => $location,
                    'updated_at' => now()
                ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating location',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function updateRetired(Request $request)
    {
        $ids = $request->ids;          // array of product IDs
        $retired = $request->retired;

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['success' => false, 'message' => 'No products selected']);
        }

        if (trim($retired) === '') {
            return response()->json(['success' => false, 'message' => 'Retired is required']);
        }

        try {
            DB::table('products')
                ->whereIn('id', $ids)
                ->update([
                    'retired' => $retired,
                    'updated_at' => now()
                ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating Retired',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function updateLockPrice(Request $request)
    {
        $ids = $request->ids;          // array of product IDs
        $lock_price = $request->lockPrice;

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['success' => false, 'message' => 'No products selected']);
        }

        if (trim($lock_price) === '') {
            return response()->json(['success' => false, 'message' => 'Lock Price is required']);
        }

        try {
            DB::table('products')
                ->whereIn('id', $ids)
                ->update([
                    'lock_price' => $lock_price,
                    'updated_at' => now()
                ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating Lock Price',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $perPage = $request->input('perPage') === 'Alles' || $request->input('perPage') == -1 ? null : ($request->input('perPage') ?? 12);
        $query = Product::query()->withTrashed();

        // Apply filters using AND logic
        // if ($request->filled('category') && $request->input('category') !== 'Alles') {
        //     $query->where('category_id', $request->input('category'));
        // }
        if ($request->filled('category') && $request->input('category') !== 'Alles') {
            $categories = is_array($request->input('category'))
                ? $request->input('category')
                : explode(',', $request->input('category'));

            $query->where(function ($q) use ($categories) {
                foreach ($categories as $catId) {
                    $q->orWhereRaw("FIND_IN_SET(?, category_id)", [$catId]);
                }
            });
        }

        if ($request->filled('color') && $request->input('color') !== 'Alles') {
            $query->where('color_id', $request->input('color'));
        }

        // In Laravel controller (example)
        if ($request->filled('item_no')) {
            $query->where('item_no', 'like', '%' . $request->item_no . '%');
        }


        if ($request->filled('brand') && $request->input('brand') !== 'Alles') {
            $query->where('brand', $request->input('brand'));
        }

        if ($request->input('filter') === 'stock') {
            $query->where('stock', '>', 0);
        }

        if ($request->filled('condition') && $request->input('condition') !== 'Alles') {
            $query->where('condition', $request->input('condition'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $columns = ['title', 'description', 'category_id', 'gtin', 'sku', 'brand', 'stock', 'supplier'];
                foreach ($columns as $col) {
                    $q->orWhere($col, 'like', '%' . $search . '%');
                }
            });
        }

        // Apply pagination or fetch all
        if ($perPage === null) {
            $productsData = $query->get();
            $products = [
                'data' => $productsData,
                'total' => $productsData->count(),
                'last_page' => 1,
            ];
        } else {
            $paginated = $query->paginate($perPage);
            $products = $paginated->toArray();
        }

        // Calculate total stock value (only for non-deleted)
        $products['totalprice'] = DB::table('products')
            ->whereNull('deleted_at')
            ->select(DB::raw('SUM(price * stock) as total'))
            ->pluck('total')
            ->first();

        // Pad GTINs to 13 digits
        foreach ($products['data'] as $key => $product) {
            $products['data'][$key]['gtin'] = str_pad($product['gtin'], 13, '0', STR_PAD_LEFT);
        }

        return response()->json($products);
    }

    // public function index(Request $request)
    // {
    //     // $products = Product::meta('products_meta')->where(function($query){
    //     //     $query->where('products_meta.key', '=', 'spec');               
    //     // })->get();
    //     $perPage = $request->input('perPage') ?? 12;
    //     $query = Product::query();

    //     if($request->input('filter') == 'stock') {
    //         if($request->input('category')) {
    //             if($request->input('category') == 'Alles') {
    //                 if($perPage == 'Alles' || $perPage == -1 ) {
    //                     $products['data'] = $query->where('category', $request->input('category'))->where('stock', '>', '0')->orderByDesc('stock')->get()->toArray();
    //                     $products['total'] = count($products['data']);
    //                     $products['last_page'] = 1;
    //                 } else {
    //                     $query->where('stock', '>', '0')->orderByDesc('stock');
    //                     $products = $query->paginate($perPage)->toArray();
    //                 }  
    //             } else {
    //                 if($perPage == 'Alles'  || $perPage == -1 ) {
    //                     $products['data'] = $query->where('category', $request->input('category'))->where('stock', '>', '0')->orderByDesc('stock')->get()->toArray();
    //                     $products['total'] = count($products['data']);
    //                     $products['last_page'] = 1;
    //                 } else {
    //                     $query->where('category', $request->input('category'))->where('stock', '>', '0')->orderByDesc('stock');
    //                     $products = $query->paginate($perPage)->toArray();
    //                 }  
    //             }

    //         } else {
    //             if($perPage == 'Alles'  || $perPage == -1 ) {
    //                 $products['data'] = $query->where('stock', '>', '0')->orderByDesc('stock')->get()->toArray();
    //                 $products['total'] = count($products['data']);
    //                 $products['last_page'] = 1;
    //             } else {
    //                 $query->where('stock', '>', '0')->orderByDesc('stock');
    //                 $products = $query->paginate($perPage)->toArray();
    //             }  
    //         }
    
    //     }elseif($request->input('condition') && $request->input('condition') != 'Alles') {
    //         // New condition filter
    //         $condition = $request->input('condition');
    //         if($condition) {
    //             $query->where('condition', $condition);
    //         }
            
    //         if($perPage == 'Alles' || $perPage == -1) {
    //             $products['data'] = $query->get()->toArray();
    //             $products['total'] = count($products['data']);
    //             $products['last_page'] = 1;
    //         } else {
    //             $products = $query->paginate($perPage)->toArray();
    //         }
    //     } else {
    //         if($request->input('search')) {

    //             $input = $request->input('search');
                
    //             $query->withTrashed();
     
    //             $columns = ['title', 'description', 'category_id', 'gtin', 'sku', 'brand', 'stock', 'supplier'];
    //             foreach($columns as $column){
    //                 $query->orWhere($column, 'LIKE', '%' . $input . '%');
    //             }
    //             $products = [];
    //             $perPage = 12;
    //             if($perPage == 'Alles'  || $perPage == -1 ) {
    //                 $products['data'] = $query->get()->toArray();
    //                 $products['total'] = count($products['data']);
    //                 $products['last_page'] = 1;
    //             } else {                    
    //                 $products = $query->paginate($perPage)->toArray();  
    //             }

    //         } else {
    //             if($perPage == 'Alles'  || $perPage == -1 ) {
    //                 if($request->input('category') == 'components') {
    //                     $products['data'] = Product::with(['supplierproduct'])->whereNotIn('category_id', ['Desktop PC', 'Game PC'])->get()->toArray();
    //                     $products['total'] = count($products['data'] );
    //                     $products['last_page'] = 1;
    //                 } else {
    //                     if($request->input('category')) {
    //                         $products['data'] = Product::where('category_id', $request->input('category'))->get()->toArray();
    //                     } else {
    //                         $products['data'] = Product::get()->toArray();

    //                     }
    //                     $products['total'] = count($products['data'] );
    //                     $products['last_page'] = 1;
    //                 }

    //             } else {
    //                 if($request->input('category')) {
    //                     $category = $request->input('category') ?? null;
    //                     //$products = Product::with(['components','supplierproduct'])->whereIn('category', $categoryMenu)->paginate($perPage)->toArray();
    //                     //$query->whereRaw('LOWER(`newsTitle`) LIKE ? ',[trim(strtolower($newsTitle)).'%']);
    //                     if($category == 'Alles') {
    //                         $products = Product::whereNot('category_id', 'inkt')->paginate($perPage)->toArray();

    //                     } else {

    //                         if($request->input('brand')) {

    //                             $brand = $request->input('brand');

    //                             if($brand == 'Alles') {

    //                                 $products = Product::where('category_id', $category)->paginate($perPage)->toArray();
    //                             } else {
    //                                 $products = Product::where('category_id', $category)->where('brand', $brand)->paginate($perPage)->toArray();

    //                             }

    //                         } else {
    //                             $products = Product::where('category_id', $category)->paginate($perPage)->toArray();
    //                         }


    //                     }

    //                 } else {
    //                     $products = Product::paginate($perPage)->toArray();
    //                 }
    //             }
    //         }

    //     }


    //     $products['totalprice'] = DB::table('products')
    //     ->select(DB::raw('sum(price * stock) as total'))
    //     ->whereNull('deleted_at')
    //     ->get()
    //     ->pluck('total')[0];

    //     //file_put_contents(__DIR__.'/producten_test.json', json_encode($products));
        
    //     foreach($products['data'] as $key => $product) {
    //         $products['data'][$key]['gtin'] =  str_pad($products['data'][$key]['gtin'], 13, "0", STR_PAD_LEFT);

    //     }
    //     return Response()->json($products);  
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::get('https://f7e904cd416fc6d2482caab6e7dd5cb5:de2521369af590d5a38332cff00b97ba@api.webshopapp.com/nl/catalog/count.json');
        $count = $response->json()['count'];
        $pages = ceil($count / 250);
        $_products = [];
        for ($page = 1; $page < $pages + 1; $page++) {
            $response = Http::get(
                'https://f7e904cd416fc6d2482caab6e7dd5cb5:de2521369af590d5a38332cff00b97ba@api.webshopapp.com/nl/catalog.json',
                [
                    'page' => $page,
                    'limit' => 250,
                ]
            );

            $_products = array_merge_recursive($_products, $response->json());
        }
        //echo '<pre>' . var_export($_products, true) . '</pre>';

        //exit();


        $gtins = [];
        foreach ($_products['products'] as $product) {

            $inventoryProduct = new Product;


            $inventoryProduct->title = $product['title'];
            if (isset($product['categories'])) {
                if (isset($product['categories'][array_key_first($product['categories'])])) {
                    $inventoryProduct->category = $product['categories'][array_key_first($product['categories'])]['title'];
                }
            }
            if (isset($product['variants'])) {
                if (isset($product['variants'][array_key_first($product['variants'])]['ean'])) {
                    if (in_array($product['variants'][array_key_first($product['variants'])]['ean'], $gtins)) {
                        continue;
                    } else {
                        $gtins[] = $product['variants'][array_key_first($product['variants'])]['ean'];
                    }
                    $inventoryProduct->gtin = $product['variants'][array_key_first($product['variants'])]['ean'];
                }
                if (isset($product['variants'][array_key_first($product['variants'])]['stockLevel'])) {
                    $inventoryProduct->quantity = $product['variants'][array_key_first($product['variants'])]['stockLevel'];
                }
            }

            $image = $product['image']['src'];
            $filename =  $inventoryProduct->gtin . '.' . pathinfo(parse_url($image, PHP_URL_PATH))['extension'];
            $pathInternal = '/app/public/inventoryImages/' . $filename;
            $pathPublic = '/storage/inventoryImages/' . $filename;

            file_put_contents(storage_path() . $pathInternal, file_get_contents($image));

            $inventoryProduct->image = $pathPublic;
            $inventoryProduct->save();
            //echo '<pre>' . var_export($product, true) . '</pre>';


            //echo '<pre>' . var_export($product, true) . '</pre>';
            //echo $product['title'] . '<br>';
            //echo $product['category']['title'] . '<br>';
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     $request->validate([
    //         'gtin' => 'required',
    //         'title' => 'required|string',
    //         // 'quantity' => 'required|integer',
    //         // 'stock' => 'required|integer',
    //         'price' => 'required',
    //         'category' => 'required|exists:categories,id',
    //         'condition' => 'nullable|string',
    //         'mainImage' => 'nullable|string',
    //         'gallery' => 'nullable|array',
    //         'gallery.*' => 'nullable|string',
    //         'imageurl' => 'nullable|string',
    //         'location_id' => 'nullable|exists:stock_locations,id',
    //         // 'shelf_position' => 'nullable|string|max:50'
    //     ]);

    //     $gtin = $request->input('id');
    //     // $id = $request->input('id');
    //     $product = Product::withTrashed()->where('id', $gtin)->first();
    //     if(!$product) {
    //         $product = new Product();
    //     }

    //     if($product->is_trashed) {
    //         $product->restore();
    //     }


    //     $url = null;
    //     if(preg_match('!^data:image\/(png|jpg|jpeg|gif|webp);base64,!', $request->input('main_image'))) {
    //         $storage_path = storage_path();
    //         $img = Image::make($request->input('main_image'))->setFileInfoFromPath($request->input('main_image'))->orientate();;


    //         $extension = explode('/', $img->mime())[1] ?? 'png';
    //         if(!in_array($extension , ['png', 'gif', 'jpg', 'jpeg', 'webp'])) {
    //             return Response()->json(['productImage' => 'incorrect mime']);
    //         } 

    //         foreach (File::glob($storage_path . '/app/public/inventoryImages/'. $gtin .'*') as $filename) {
    //             if(File::exists($filename)) File::delete($filename);
    //             //$oldImage[] = '/img/uploads/' . basename($filename);
    //         }


    //         //$filename = $request->input('gtin') . '.'.$mime;
    //         $rand_val = date('YMDHIS') . rand(11111, 99999);
    //         $imagePath = $storage_path . '/app/public/inventory_images/' . $gtin . '_'. md5($rand_val).'.'.$extension;

    //         // unlink($path);

    //         $img->save($imagePath);
    //         $url = '/storage/inventory_images/'. $gtin . '_'. md5($rand_val).'.'.$extension;
    //         //$request->merge(['image' => $url]);
    //         //$request->merge(array('image' => $url));

    //         $product->main_image = $url;
    //     }

    //     $gallery = $request->input('gallery_images');
    //     $_gallery = [];
    //     if($gallery) {
    //         foreach ($gallery as $galleryImage) {
    //             if(preg_match('!^data:image\/(png|jpg|jpeg|gif|webp);base64,!', $galleryImage)) {
    //                 $storage_path = storage_path();
    //                 $img = Image::make($galleryImage)->setFileInfoFromPath($galleryImage)->orientate();


    //                 $extension = explode('/', $img->mime())[1] ?? 'png';
    //                 if(!in_array($extension , ['png', 'gif', 'jpg', 'jpeg', 'webp'])) {
    //                     return Response()->json(['productImage' => 'incorrect mime']);
    //                 } 

    //                 foreach (File::glob($storage_path . '/app/public/inventoryImages/'. $gtin .'*') as $filename) {
    //                     if(File::exists($filename)) File::delete($filename);
    //                     //$oldImage[] = '/img/uploads/' . basename($filename);
    //                 }


    //                 //$filename = $request->input('gtin') . '.'.$mime;
    //                 $rand_val = date('YMDHIS') . rand(11111, 99999);
    //                 $imagePath = $storage_path . '/app/public/inventory_images/' . $gtin . '_'. md5($rand_val).'.'.$extension;

    //                 // unlink($path);

    //                 $img->save($imagePath);
    //                 $url = '/storage/inventory_images/'. $gtin . '_'. md5($rand_val).'.'.$extension;
    //                 $_gallery[] = $url;
    //                 //$request->merge(['image' => $url]);
    //                 //$request->merge(array('image' => $url));
    //             }
    //         }

    //         $product->gallery_images = $_gallery;
    //     } else {
    //         $product->gallery_images = [];
    //     }


    //     $product->imageurl = $request->input('imageurl');
    //     $product->gtin = $request->input('gtin');
    //     $product->title = $request->input('title');
    //     // $product->stock = $request->input('quantity');
    //     $product->stock = $request->input('stock');
    //     $product->price = str_replace(',', '.', $request->input('price'));
    //     $product->category_id = $request->input('category');
    //     $product->condition = $request->input('condition', 'new');
    //     $product->location_id = $request->input('location_id', null);

    //     if($request->has('is_investment')) {
    //         $product->is_investment = $request->input('is_investment');
    //         //add all investment fields
    //         $product->purchase_price = $request->input('purchase_price', 0);
    //         $product->purchase_date = $request->input('purchase_date', Carbon::now());
    //         $product->expected_list_date = $request->input('expected_list_date', null);
    //         $product->target_price = $request->input('target_price', null);
    //         $product->investment_notes = $request->input('investment_notes', null);
    //     }

    //     $product->save();


    //     // $product = Product::updateOrCreate(['gtin' => intval($gtin)], [
    //     //     'gtin' => $gtin,
    //     //     'title' => $request->input('title'),
    //     //     'stock' => $request->input('quantity'),
    //     //     'main_image' => $url,
    //     //     'gallery_images' => $_gallery,
    //     //     'price' => str_replace(',', '.', $request->input('price')),
    //     //     'category_id' => $request->input('category')
    //     // ]);

    //     // if($request->input('meta') != null) {

    //     //     $metaInputs = $request->input('meta');

    //     //     $meta =  [];
    //     //     foreach($metaInputs as $metaInput) {
    //     //         $meta[$metaInput['key']] = ['value' => $metaInput['value']['value'], 'order' => $metaInput['value']['order']];
    //     //     }
    //     //     $meta = collect($meta);
    //     //     $metasDiff = $product->getMeta()->diffKeys($meta);
    //     //     // echo var_export($metasDiff->toArray(), true);
    //     //     // exit();   
    //     //     //$product->unsetMeta($metasDiff->keys()->toArray());


    //     //     //$product->setMeta($meta->toArray());
    //     //     $product->save();

    //     // }
    //     echo 'was created: ' .  ($product->wasRecentlyCreated ? 'true' : 'false') . PHP_EOL;
    //     echo 'was changed: ' . ($product->wasChanged() ? 'true' : 'false') . PHP_EOL;

    //     //$product->save();
    // }
    public function store(Request $request)
    {
        // dd($request->all());
        // ✅ Validate the incoming request
        // $request->validate([
        // 'gtin' => 'nullable',
        // 'title' => 'required|string',
        // 'item_no' => 'required|string',
        // 'item_type' => 'required|string|in:MINIFIG,PART,SET,BOOK,GEAR,CATALOG,INSTRUCTION,UNSORTED_LOT,ORIGINAL_BOX',
        // 'color_name' => 'required|string',
        // // 'color_id' => 'nullable|integer',
        // 'stock' => 'required|integer',
        // 'price' => 'required',
        // 'category' => 'required|exists:categories,id',
        // 'condition' => 'required|string|in:new,used',
        // // 'completeness' => 'nullable|in:C,B,S',
        // 'sku' => 'nullable|string',
        // // 'retain' => 'required|boolean',
        // // 'is_stock_room' => 'required|boolean',
        // // 'stock_room_id' => 'nullable|string|in:A,B,C',
        // 'imageurl' => 'nullable|string',
        // 'location_id' => 'nullable|exists:stock_locations,id',
        // // 'main_image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp',
        // // 'gallery_images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp',
        // ]);

        // ✅ Create or find product by GTIN
        $gtin = $request->input('gtin');
        if ($gtin == "undefined") {
            $gtin = NULL;
        }
        $product = Product::withTrashed()->where('gtin', $gtin)->where('gtin', '!=', NULL)->first();
        if (!$product) {
            $product = new Product();
        }

        if ($product->trashed()) {
            $product->restore();
        }

        // ✅ Save main image if uploaded
        if ($request->hasFile('main_image')) {
            $mainImage = $request->file('main_image');
            $path = $mainImage->store('inventory_images', 'public');
            $product->main_image = '/public/storage/' . $path;
        }

        // ✅ Save gallery images if uploaded
        $_gallery = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $galleryImage) {
                $galleryPath = $galleryImage->store('inventory_images', 'public');
                $_gallery[] = '/public/storage/' . $galleryPath;
            }
        }
        $product->gallery_images = $_gallery;

        // ✅ Assign other fields
        $product->gtin = $gtin;
        $product->title = $request->input('title');
        $product->item_no = $request->input('item_no');
        $product->item_type = $request->input('item_type');
        $product->color_name = $request->input('color_name');
        $product->color_id = $request->input('color_id');
        $product->stock = $request->input('stock');
        $product->price = str_replace(',', '.', $request->input('price'));
        // $product->category_id = $request->input('category');
        $product->condition = $request->input('condition', 'new');
        $product->completeness = $request->input('completeness');
        $product->sku = $request->input('sku');
        $product->retain = filter_var($request->input('retain'), FILTER_VALIDATE_BOOLEAN);
        $product->is_stock_room = filter_var($request->input('is_stock_room'), FILTER_VALIDATE_BOOLEAN);
        $product->stock_room_id = ($request->input('stock_room_id') == "undefined") ? NULL : $request->input('stock_room_id');
        $product->imageurl = $request->input('imageurl');
        $product->location_id = $request->input('location_id');

        // ✅ Investment fields
        if ($request->has('is_investment')) {
            $product->is_investment = $request->input('is_investment');
            $product->purchase_price = $request->input('purchase_price', 0);
            $product->purchase_date = $request->input('purchase_date', Carbon::now());
            $product->expected_list_date = $request->input('expected_list_date', null);
            $product->target_price = $request->input('target_price', null);
            $product->investment_notes = $request->input('investment_notes', null);
        }

        /* 5. SAVE MULTIPLE CATEGORIES AS STRING ----------------------------- */
        $categoryIDs = $request->input('category_ids', []);   // array
        // store like "3,7,12"
        $product->category_id = implode(',', $categoryIDs);
        // dd($product);
        // ✅ Save product
        try {
            $product->save();

            return response()->json([
                'success' => true,
                'message' => 'Product saved successfully',
                'product' => $product
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, // ❌ It's an error, not success
                'message' => $e->getMessage(), // ✅ Proper exception message
            ], 500); // ❗ Use status code 500 for server error
        }

        // if (is_null($product->bricklink_inventory_id)) {
        //     $product->bricklink_inventory_id = $product->id;
        //     $product->save();   // update only that column
        // }


    }

    public function sendToWebhookForPostRequest(Request $request)
    {
        // dd($request->all());die;
        $response = Http::post('https://v2.bntk.eu/webhook/portal-bricklink-price', [
            'item_no' => $request->item_no,
            'item_type' => $request->item_type,
            'color_id' => $request->item_color_id,
            'condition' => $request->item_condition
        ]);

        return $response->json();
    }


    public function sendToWebhook($itemNo, $itemType)
    {
        $response = Http::post('https://v2.bntk.eu/webhook/portal-bricklink-price', [
            'item_no' => $itemNo,
            'item_type' => $itemType
        ]);

        return $response->json();
    }



    public function add_from_overview_page(Request $request)
    {
        // dd($request->all());
        // ✅ Validate the incoming request
        // $request->validate([
        // 'gtin' => 'nullable',
        // 'title' => 'required|string',
        // 'item_no' => 'required|string',
        // 'item_type' => 'required|string|in:MINIFIG,PART,SET,BOOK,GEAR,CATALOG,INSTRUCTION,UNSORTED_LOT,ORIGINAL_BOX',
        // 'color_name' => 'required|string',
        // // 'color_id' => 'nullable|integer',
        // 'stock' => 'required|integer',
        // 'price' => 'required',
        // 'category' => 'required|exists:categories,id',
        // 'condition' => 'required|string|in:new,used',
        // // 'completeness' => 'nullable|in:C,B,S',
        // 'sku' => 'nullable|string',
        // // 'retain' => 'required|boolean',
        // // 'is_stock_room' => 'required|boolean',
        // // 'stock_room_id' => 'nullable|string|in:A,B,C',
        // 'imageurl' => 'nullable|string',
        // 'location_id' => 'nullable|exists:stock_locations,id',
        // // 'main_image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp',
        // // 'gallery_images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp',
        // ]);

        // ✅ Create or find product by GTIN
        $gtin = $request->input('gtin');
        if ($gtin == "undefined") {
            $gtin = NULL;
        }
        $product = Product::withTrashed()->where('gtin', $gtin)->where('gtin', '!=', NULL)->first();
        if (!$product) {
            $product = new Product();
        }

        if ($product->trashed()) {
            $product->restore();
        }


        /*
|--------------------------------------------------------------------------
| MAIN IMAGE
|--------------------------------------------------------------------------
*/
        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('inventory_images', 'public');
            $product->main_image = '/public/storage/' . $path;
        }

        /*
|--------------------------------------------------------------------------
| GALLERY IMAGES
|--------------------------------------------------------------------------
*/
        if ($request->hasFile('gallery_images')) {
            $_gallery = [];

            foreach ($request->file('gallery_images') as $file) {
                if ($file->isValid()) {
                    $path = $file->store('inventory_images', 'public');
                    $_gallery[] = '/public/storage/' . $path;
                }
            }

            // only set if files were uploaded
            if (!empty($_gallery)) {
                $product->gallery_images = $_gallery;
            }
        }

        /*
|--------------------------------------------------------------------------
| VINTED MAIN IMAGE
|--------------------------------------------------------------------------
*/
        if ($request->hasFile('vinted_main_image')) {
            $path = $request->file('vinted_main_image')->store('inventory_images', 'public');
            $product->vinted_main_image = '/public/storage/' . $path;
        }

        /*
|--------------------------------------------------------------------------
| VINTED GALLERY IMAGES
|--------------------------------------------------------------------------
*/
        if ($request->hasFile('vinted_gallery_images')) {
            $_vinted_gallery = [];

            foreach ($request->file('vinted_gallery_images') as $file) {
                if ($file->isValid()) {
                    $path = $file->store('inventory_images', 'public');
                    $_vinted_gallery[] = '/public/storage/' . $path;
                }
            }

            // only set if files were uploaded
            if (!empty($_vinted_gallery)) {
                $product->vinted_gallery_images = $_vinted_gallery;
            }
        }


        // vinted end

        $data_from_webhook = $this->sendToWebhook($request->input('item_no'), $request->input('item_type'));
        // print_r($data_from_webhook['avg_price']);die;

        // ✅ Assign other fields

        $product->vinted_active = (($request->input('vinted_active') == NULL) ? 0 : 1);
        $product->vinted_item_id = $request->input('vinted_item_id');
        $product->vinted_bulk_amount = $request->input('vinted_bulk_amount');
        $product->vinted_status = $request->input('vinted_status');

        $product->item_no = $request->input('item_no');
        $product->item_type = $request->input('item_type');
        $product->completeness = $request->input('completeness');
        $product->imageurl = $request->input('image_url');
        $product->gtin = $request->input('ean');
        $product->sku = $request->input('sku') ?? '';
        $product->title = $request->input('title');
        $product->retain = $request->input('retain');
        $product->weight = $request->input('weight');
        $product->is_stock_room = $request->input('is_stock_room');
        $product->stock_room_id = $request->input('stock_room_id');
        $product->stock = $request->input('stock');
        // $product->category_id = $request->input('category_id');
        $product->color_id = $request->input('color_id');
        $colordetail = DB::table('colors')->where('bricklink_id', $product->color_id)->get();
        $product->color_name = $colordetail[0]->bricklink_name ?? null;

        $product->condition = $request->input('condition');
        $product->category = $request->input('category');
        //add location_id if provided
        $product->location_id = $request->input('location_id', null);

        /* 5. SAVE MULTIPLE CATEGORIES AS STRING ----------------------------- */
        $categoryIDs = $request->input('category_id', []);   // array
        // store like "3,7,12"
        $product->category_id = implode(',', $categoryIDs);
        $product->bricklink_inventory_id = $request->input('bricklink_inventory_id');
        $product->rebrickable_id = $request->input('rebrickable_id');

        $product->dim_x = $request->input('dim_x');
        $product->dim_y = $request->input('dim_y');
        $product->dim_z = $request->input('dim_z');
        $product->pieces = $request->input('pieces');
        $product->year = $request->input('year');
        $product->min_age = $request->input('min_age');
        $product->description = $request->input('description');
        $product->extended_description = $request->input('extended_description');
        $product->set_minifigures = $request->input('set_minifigures');
        $product->remarks = $request->input('remarks');

        $product->price = $request->input('price');
        // $product->price = $data_from_webhook['avg_price'] ?? 0;
        $product->sell_price = $request->input('sell_price');
        $product->purchase_price = $request->input('purchase_price');
        $product->sale_rate = $request->input('sale_rate');
        $product->tier_quantity1 = $request->input('tier_quantity1');
        $product->tier_price1 = $request->input('tier_price1');
        $product->tier_quantity2 = $request->input('tier_quantity2');
        $product->tier_price2 = $request->input('tier_price2');
        $product->tier_quantity3 = $request->input('tier_quantity3');
        $product->tier_price3 = $request->input('tier_price3');
        $product->currency = $request->input('currency');

        $product->shopify_variant_id = $request->input('shopify_variant_id');
        $product->shopify_product_id = $request->input('shopify_product_id');

        $product->amazon_sku = $request->input('amazon_sku');
        $product->amazon_price = $request->input('amazon_price');
        $product->amazon_condition_type = $request->input('amazon_condition_type');
        $product->amazon_fulfillment_channel = $request->input('amazon_fulfillment_channel');
        $product->amazon_target_age_min = $request->input('amazon_target_age_min');
        $product->amazon_listing_id = $request->input('amazon_listing_id');
        $product->amazon_status = $request->input('amazon_status');
        $product->amazon_last_sync = $request->input('amazon_last_sync');

        $product->ebay_item_id = $request->input('ebay_item_id');
        $product->ebay_price = $request->input('ebay_price');
        $product->ebay_condition_id = $request->input('ebay_condition_id');
        $product->ebay_category_id = $request->input('ebay_category_id');
        $product->ebay_listing_type = $request->input('ebay_listing_type');
        $product->ebay_listing_duration = $request->input('ebay_listing_duration');
        $product->ebay_primary_image = $request->input('ebay_primary_image');
        $product->ebay_item_specifics = $request->input('ebay_item_specifics');
        $product->ebay_handling_time = $request->input('ebay_handling_time');
        $product->ebay_sku = $request->input('ebay_sku');
        $product->ebay_status = $request->input('ebay_status');
        $product->ebay_last_sync = $request->input('ebay_last_sync');

        $product->bol_active = $request->input('bol_active');
        $product->bol_offerId = $request->input('bol_offerId');
        $product->bol_price = $request->input('bol_price');
        $product->bol_fulfilment_method = $request->input('bol_fulfilment_method');
        $product->bol_delivery_code = $request->input('bol_delivery_code');

        $product->woocommerce_parent_id = $request->input('woocommerce_parent_id');
        $product->woocommerce_id = $request->input('woocommerce_id');
        $product->bricklink_inventory_id = $request->input('bricklink_inventory_id');
        $product->brickowl_id = $request->input('brickowl_id');
        $product->element_id = $request->input('element_id');
        $product->notifyvalues = $request->input('notifyvalues');
        $product->notifyselected = $request->input('notifyselected');
        $product->notifystatus = $request->input('notifystatus');
        $product->bind_id = $request->input('bind_id');
        $product->reserved_for = $request->input('reserved_for');
        $product->date = $request->input('date');
        $product->new_or_used = $request->input('new_or_used');
        $product->upgrades = $request->input('upgrades');
        $product->retired = (($request->input('retired') == NULL) ? 0 : 1);
        $product->lock_price = (($request->input('lock_price') == NULL) ? 0 : 1);

        $product->supplier = $request->input('supplier');
        $product->stockSupplier = $request->input('stockSupplier');
        $product->location_id = $request->input('location_id');
        $product->lot_id = $request->input('lot_id');
        $product->super_lot_id = $request->input('super_lot_id');
        $product->super_lot_qty = $request->input('super_lot_qty');

        // ✅ Investment fields
        if ($request->has('is_investment')) {
            $product->is_investment = $request->input('is_investment');
            $product->purchase_price = $request->input('purchase_price', 0);
            $product->purchase_date = $request->input('purchase_date', Carbon::now());
            $product->expected_list_date = $request->input('expected_list_date', null);
            $product->target_price = $request->input('target_price', null);
            $product->investment_notes = $request->input('investment_notes', null);
        }

        /* 5. SAVE MULTIPLE CATEGORIES AS STRING ----------------------------- */
        $categoryIDs = $request->input('category_ids', []);   // array
        // store like "3,7,12"
        $product->category_id = implode(',', $categoryIDs);
        // dd($product);
        // ✅ Save product
        $product->save();
        // try {
        //     $product->save(); 

        //     return response()->json([
        //         'success' => true,
        //         'message' => 'Product saved successfully',
        //         'product' => $product
        //     ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'success' => false, // ❌ It's an error, not success
        //         'message' => $e->getMessage(), // ✅ Proper exception message
        //     ], 500); // ❗ Use status code 500 for server error
        // }
        return redirect()->back();

        // if (is_null($product->bricklink_inventory_id)) {
        //     $product->bricklink_inventory_id = $product->id;
        //     $product->save();   // update only that column
        // }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($gtin)
    {
        // echo $gtin;die;
        //$gtin = substr($gtin, 0, -1);
        if (is_numeric($gtin)) {
            try {
                $product = Product::withTrashed()->where('id', intval($gtin))->firstOrFail();
                return Response()->json($product->toArray());
            } catch (ModelNotFoundException $e) {
                return Response()->json([
                    'error' => 'product_not_found'
                ], 404);
            }
        } else {
            return Response()->json([
                'error' => 'gtin_invalid'

            ], 400);
        }
    }

    public function find($gtin)
    {
        if (is_numeric($gtin)) {
            try {
                $product = CompliesProduct::where('gtin', intval($gtin))->firstOrFail();

                return Response()->json($product);
            } catch (ModelNotFoundException $e) {
                return Response()->json([
                    'error' => 'product_not_found'
                ], 404);
            }
            try {
                $product = GistronProduct::where('gtin', intval($gtin))->firstOrFail();

                return Response()->json($product);
            } catch (ModelNotFoundException $e) {
                // return Response()->json([
                //     'error' => 'product_not_found'
                // ], 404);
                return Response()->json([
                    'error' => 'product_not_found'
                ], 404);
            }
            try {
                $product = ApibvProduct::where('gtin', intval($gtin))->firstOrFail();

                return Response()->json($product);
            } catch (ModelNotFoundException $e) {
                return Response()->json([
                    'error' => 'product_not_found'
                ], 404);
            }
            return Response()->json([
                'error' => 'product_not_found'
            ], 404);
        } else {
            return Response()->json([
                'error' => 'gtin_invalid'

            ], 400);
        }
        //return Response()->json();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // print_r($request->all());die;
        $request->validate([
            // 'gtin' => 'required|string',
            // 'title' => 'required|string',
            // 'quantity' => 'required|integer',
            // 'price' => 'required|numeric',
            // 'category' => 'required|exists:categories,id',
            // 'condition' => 'nullable|string',
            // 'mainImage' => 'nullable|string',
            // 'gallery' => 'nullable|array',
            // 'gallery.*' => 'nullable|string',
            // 'imageurl' => 'nullable|string',
            // 'location_id' => 'nullable|exists:stock_locations,id',
            // 'shelf_position' => 'nullable|string|max:50'
        ]);

        $gtin = $request->input('gtin');
        $product = Product::withTrashed()->where('id', $id)->first();
        if (!$product) {
            $product = new Product();
        }

        if ($product->is_trashed) {
            $product->restore();
        }

        // ✅ Save main image if uploaded
        if ($request->hasFile('mainImage')) {
            $mainImage = $request->file('mainImage');
            $path = $mainImage->store('inventory_images', 'public');
            $product->main_image = '/public/storage/' . $path;
        }

        // ✅ Save gallery images if uploaded
        $_gallery = $product->gallery_images;
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $galleryImage) {
                $galleryPath = $galleryImage->store('inventory_images', 'public');
                $_gallery[] = '/public/storage/' . $galleryPath;
            }
        }
        $product->gallery_images = $_gallery;


        $product->item_no = $request->input('item_no');
        $product->item_type = $request->input('item_type');
        $product->completeness = $request->input('completeness');
        $product->imageurl = $request->input('imageurl');
        $product->gtin = $request->input('gtin');
        $product->sku = $request->input('sku');
        $product->title = $request->input('title');
        $product->retain = $request->input('retain');
        $product->is_stock_room = $request->input('is_stock_room');
        $product->stock_room_id = $request->input('stock_room_id');
        $product->stock = $request->input('quantity');
        $product->price = str_replace(',', '.', $request->input('price'));
        // $product->category_id = $request->input('category_id');
        $product->color_id = $request->input('color_id');
        $product->condition = $request->input('condition', 'new');
        //add location_id if provided
        $product->location_id = $request->input('location_id', null);

        /* 5. SAVE MULTIPLE CATEGORIES AS STRING ----------------------------- */
        $categoryIDs = $request->input('category_id', []);   // array
        // store like "3,7,12"
        $product->category_id = implode(',', $categoryIDs);

        $product->save();


        // $product = Product::updateOrCreate(['gtin' => intval($gtin)], [
        //     'gtin' => $gtin,
        //     'title' => $request->input('title'),
        //     'stock' => $request->input('quantity'),
        //     'main_image' => $url,
        //     'gallery_images' => $_gallery,
        //     'price' => str_replace(',', '.', $request->input('price')),
        //     'category_id' => $request->input('category')
        // ]);

        // if($request->input('meta') != null) {

        //     $metaInputs = $request->input('meta');

        //     $meta =  [];
        //     foreach($metaInputs as $metaInput) {
        //         $meta[$metaInput['key']] = ['value' => $metaInput['value']['value'], 'order' => $metaInput['value']['order']];
        //     }
        //     $meta = collect($meta);
        //     $metasDiff = $product->getMeta()->diffKeys($meta);
        //     // echo var_export($metasDiff->toArray(), true);
        //     // exit();   
        //     //$product->unsetMeta($metasDiff->keys()->toArray());


        //     //$product->setMeta($meta->toArray());
        //     $product->save();

        // }
        echo 'was created: ' .  ($product->wasRecentlyCreated ? 'true' : 'false') . PHP_EOL;
        echo 'was changed: ' . ($product->wasChanged() ? 'true' : 'false') . PHP_EOL;

        //$product->save();
    }


    public function update_from_overview_page(Request $request, $id)
    {
        try {
            // print_r($request->all());die;
            $request->validate([
                // 'gtin' => 'required|string',
                // 'title' => 'required|string',
                // 'quantity' => 'required|integer',
                // 'price' => 'required|numeric',
                // 'category' => 'required|exists:categories,id',
                // 'condition' => 'nullable|string',
                // 'mainImage' => 'nullable|string',
                // 'gallery' => 'nullable|array',
                // 'gallery.*' => 'nullable|string',
                // 'imageurl' => 'nullable|string',
                // 'location_id' => 'nullable|exists:stock_locations,id',
                // 'shelf_position' => 'nullable|string|max:50'
            ]);

            $gtin = $request->input('gtin');
            $product = Product::withTrashed()->where('id', $id)->first();
            if (!$product) {
                $product = new Product();
            }

            if ($product->is_trashed) {
                $product->restore();
            }


            if ($request->hasFile('main_image')) {
                $mainImage = $request->file('main_image');
                $path = $mainImage->store('inventory_images', 'public');
                $product->main_image = '/public/storage/' . $path;
            }

            if ($request->filled('gallery_images')) {
                $_gallery = [];
                $galleryArray = json_decode($request->input('gallery_images'), true);

                foreach ($galleryArray as $base64) {
                    if (Str::startsWith($base64, 'data:image')) {
                        $image_parts = explode(";base64,", $base64);
                        $image_type = explode("image/", $image_parts[0])[1];
                        $image_base64 = base64_decode($image_parts[1]);

                        $fileName = uniqid() . '.' . $image_type;
                        $tmpPath = sys_get_temp_dir() . '/' . $fileName;
                        file_put_contents($tmpPath, $image_base64);

                        $uploadedFile = new UploadedFile($tmpPath, $fileName, null, null, true);
                        $path = $uploadedFile->store('inventory_images', 'public');

                        $_gallery[] = '/public/storage/' . $path;
                        @unlink($tmpPath);
                    } else {
                        $_gallery[] = $base64;
                    }
                }

                $product->gallery_images = $_gallery;
            }


            // Vinted
            if ($request->hasFile('vinted_main_image')) {
                $mainImage = $request->file('vinted_main_image');
                $path = $mainImage->store('inventory_images', 'public');
                $product->vinted_main_image = '/public/storage/' . $path;
            }

            if ($request->filled('vinted_gallery_images')) {
                $_vinted_gallery = [];
                $vinted_galleryArray = json_decode($request->input('vinted_gallery_images'), true);

                foreach ($vinted_galleryArray as $base64) {
                    if (Str::startsWith($base64, 'data:image')) {
                        $image_parts = explode(";base64,", $base64);
                        $image_type = explode("image/", $image_parts[0])[1];
                        $image_base64 = base64_decode($image_parts[1]);

                        $fileName = uniqid() . '.' . $image_type;
                        $tmpPath = sys_get_temp_dir() . '/' . $fileName;
                        file_put_contents($tmpPath, $image_base64);

                        $uploadedFile = new UploadedFile($tmpPath, $fileName, null, null, true);
                        $path = $uploadedFile->store('inventory_images', 'public');

                        $_vinted_gallery[] = '/public/storage/' . $path;
                        @unlink($tmpPath);
                    } else {
                        $_vinted_gallery[] = $base64;
                    }
                }

                $product->vinted_gallery_images = $_vinted_gallery;
            }

            // Vinted End        




            $product->vinted_active = (($request->input('vinted_active') == NULL) ? 0 : 1);
            $product->vinted_item_id = $request->input('vinted_item_id');
            $product->vinted_bulk_amount = $request->input('vinted_bulk_amount');
            $product->vinted_status = $request->input('vinted_status');

            $product->item_no = $request->input('item_no');
            $product->item_type = $request->input('item_type');
            $product->completeness = $request->input('completeness');
            $product->imageurl = $request->input('image_url');
            $product->gtin = $request->input('ean');
            $product->sku = $request->input('sku');
            $product->title = $request->input('title');
            $product->retain = $request->input('retain');
            $product->weight = $request->input('weight');
            $product->is_stock_room = $request->input('is_stock_room');
            $product->stock_room_id = $request->input('stock_room_id');
            $product->stock = $request->input('stock');
            // $product->category_id = $request->input('category_id');
            $product->color_id = $request->input('color_id');
            $colordetail = DB::table('colors')->where('bricklink_id', $product->color_id)->get();
            $product->color_name = $colordetail[0]->bricklink_name ?? null;


            $product->condition = $request->input('condition') ?? "New";
            $product->category = $request->input('category');
            $product->bricklink_inventory_id = $request->input('bricklink_inventory_id');
            $product->rebrickable_id = $request->input('rebrickable_id');

            $product->dim_x = $request->input('dim_x');
            $product->dim_y = $request->input('dim_y');
            $product->dim_z = $request->input('dim_z');
            $product->pieces = $request->input('pieces');
            $product->year = $request->input('year');
            $product->min_age = $request->input('min_age');
            $product->description = $request->input('description');
            $product->extended_description = $request->input('extended_description');
            $product->set_minifigures = $request->input('set_minifigures');
            $product->remarks = $request->input('remarks');

            $product->price = $request->input('price');
            $product->sell_price = $request->input('sell_price');
            $product->purchase_price = $request->input('purchase_price');
            $product->sale_rate = $request->input('sale_rate');
            $product->tier_quantity1 = $request->input('tier_quantity1');
            $product->tier_price1 = $request->input('tier_price1');
            $product->tier_quantity2 = $request->input('tier_quantity2');
            $product->tier_price2 = $request->input('tier_price2');
            $product->tier_quantity3 = $request->input('tier_quantity3');
            $product->tier_price3 = $request->input('tier_price3');
            $product->currency = $request->input('currency');

            $product->shopify_variant_id = $request->input('shopify_variant_id');
            $product->shopify_product_id = $request->input('shopify_product_id');

            $product->amazon_sku = $request->input('amazon_sku');
            $product->amazon_price = $request->input('amazon_price');
            $product->amazon_condition_type = $request->input('amazon_condition_type');
            $product->amazon_fulfillment_channel = $request->input('amazon_fulfillment_channel');
            $product->amazon_target_age_min = $request->input('amazon_target_age_min');
            $product->amazon_listing_id = $request->input('amazon_listing_id');
            $product->amazon_status = $request->input('amazon_status');
            $product->amazon_last_sync = $request->input('amazon_last_sync');

            $product->ebay_item_id = $request->input('ebay_item_id');
            $product->ebay_price = $request->input('ebay_price');
            $product->ebay_condition_id = $request->input('ebay_condition_id');
            $product->ebay_category_id = $request->input('ebay_category_id');
            $product->ebay_listing_type = $request->input('ebay_listing_type');
            $product->ebay_listing_duration = $request->input('ebay_listing_duration');
            $product->ebay_primary_image = $request->input('ebay_primary_image');
            $product->ebay_item_specifics = $request->input('ebay_item_specifics');
            $product->ebay_handling_time = $request->input('ebay_handling_time');
            $product->ebay_sku = $request->input('ebay_sku');
            $product->ebay_status = $request->input('ebay_status');
            $product->ebay_last_sync = $request->input('ebay_last_sync');

            $product->bol_active = $request->input('bol_active');
            $product->bol_offerId = $request->input('bol_offerId');
            $product->bol_price = $request->input('bol_price');
            $product->bol_fulfilment_method = $request->input('bol_fulfilment_method');
            $product->bol_delivery_code = $request->input('bol_delivery_code');

            $product->woocommerce_parent_id = $request->input('woocommerce_parent_id');
            $product->woocommerce_id = $request->input('woocommerce_id');
            $product->bricklink_inventory_id = $request->input('bricklink_inventory_id');
            $product->brickowl_id = $request->input('brickowl_id');
            $product->element_id = $request->input('element_id');
            $product->notifyvalues = $request->input('notifyvalues');
            $product->notifyselected = $request->input('notifyselected');
            $product->notifystatus = $request->input('notifystatus');
            $product->bind_id = $request->input('bind_id');
            $product->reserved_for = $request->input('reserved_for');
            $product->date = $request->input('date');
            $product->new_or_used = $request->input('new_or_used');
            $product->upgrades = $request->input('upgrades');
            $product->retired = (($request->input('retired') == NULL) ? 0 : 1);
            $product->lock_price = (($request->input('lock_price') == NULL) ? 0 : 1);

            $product->supplier = $request->input('supplier');
            $product->stockSupplier = $request->input('stockSupplier');
            $product->location_id = $request->input('location_id');
            $product->lot_id = $request->input('lot_id');
            $product->super_lot_id = $request->input('super_lot_id');
            $product->super_lot_qty = $request->input('super_lot_qty');


            //add location_id if provided
            $product->location_id = $request->input('location_id', null);

            /* 5. SAVE MULTIPLE CATEGORIES AS STRING ----------------------------- */
            $categoryIDs = $request->input('category_id', []);   // array
            // store like "3,7,12"
            $product->category_id = implode(',', $categoryIDs);

            $product->save();


            // $product = Product::updateOrCreate(['gtin' => intval($gtin)], [
            //     'gtin' => $gtin,
            //     'title' => $request->input('title'),
            //     'stock' => $request->input('quantity'),
            //     'main_image' => $url,
            //     'gallery_images' => $_gallery,
            //     'price' => str_replace(',', '.', $request->input('price')),
            //     'category_id' => $request->input('category')
            // ]);

            // if($request->input('meta') != null) {

            //     $metaInputs = $request->input('meta');

            //     $meta =  [];
            //     foreach($metaInputs as $metaInput) {
            //         $meta[$metaInput['key']] = ['value' => $metaInput['value']['value'], 'order' => $metaInput['value']['order']];
            //     }
            //     $meta = collect($meta);
            //     $metasDiff = $product->getMeta()->diffKeys($meta);
            //     // echo var_export($metasDiff->toArray(), true);
            //     // exit();   
            //     //$product->unsetMeta($metasDiff->keys()->toArray());


            //     //$product->setMeta($meta->toArray());
            //     $product->save();

            // }
            // echo 'was created: ' .  ($product->wasRecentlyCreated ? 'true' : 'false') . PHP_EOL;
            // echo 'was changed: ' . ($product->wasChanged() ? 'true' : 'false') . PHP_EOL;

            //$product->save();

            return redirect()->back()->with('success', 'Product updated successfully');
        } catch (\Throwable $e) {

            // Log full error for debugging (recommended)
            \Log::error('Product update failed', [
                'error' => $e->getMessage(),
                'file'  => $e->getFile(),
                'line'  => $e->getLine(),
            ]);

            // Send ORIGINAL error message to view
            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
    
    
// public function update(Request $request, $id){
    
// }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($gtin)
    {
        Product::where('id', $gtin)->delete();
    }

    public function generateGtin()
    {
        $ean = PcmanGtin::getNextProductEan();
        $ean = PcmanGtin::addCheck($ean);
        return Response()->json(['ean' => $ean]);
    }

    public function search(Request $request)
    {
        $input = $request->input('search');
        $query = Product::query();
        $query->withTrashed();
        $gtinValidator = new GtinValidator($input);
        $gtinObject = $gtinValidator->getGtinObject();
        if ($gtinObject->isValid()) {
            $products = [];
            $product = $query->where('gtin', $input)->first();
            if ($product) {
                $products['data'][] = $product->toArray();
            } else {
                $products['data'] = [];
            }
        } else {

            // if(empty($input)) {
            //     $query->get();
            // } else {
            //     if(is_numeric($input)) {
            //         $query->where('gtin', 'LIKE', '%' . $input . '%');
            //     } else {
            //         $query->whereRaw("MATCH(title,description,category,sku,brand,supplier) AGAINST(? IN BOOLEAN MODE)", array($input));

            //     }

            // }
            $columns = ['title', 'description', 'category', 'gtin', 'sku', 'brand', 'stock', 'supplier'];
            //$query->where('gtin', 'LIKE', '%' . $input . '%');

            foreach ($columns as $column) {
                $query->orWhere($column, 'LIKE', '%' . $input . '%');
            }

            $products = [];
            $perPage = $request->input('perPage');
            if ($perPage == 'Alles') {
                $products['data'] = $query->get()->toArray();
                $products['total'] = count($products['data']);
                $products['last_page'] = 1;
            } else {
                $products = $query->paginate($perPage)->toArray();
            }
        }
        //file_put_contents(__DIR__.'/producten_test2.json', json_encode($products));
        if (isset($products['data'])) {
            if (count($products['data']) > 0) {
                foreach ($products['data'] as $key => $product) {
                    $products['data'][$key]['gtin'] =  str_pad($products['data'][$key]['gtin'], 13, "0", STR_PAD_LEFT);
                }
            }
        }

        return Response()->json($products);
    }

    // public function updateNotify(Request $request) {
    //     $gtin = $request->input('gtin');
    //     $notify = $request->input('notify');
    //     $product = Product::where('gtin', $gtin)->first();
    //     $product->notify = intval($notify);
    //     $product->save();
    // }

    public function exportproducts()
    {
        $filename = Carbon::now()->format('Ymdhms') . '-producten.xlsx';
        Excel::store(new InventoryProductExport, 'public/productexports/' . $filename);
        return Response()->json(['url' => 'https://web.pcman.nl/storage/productexports/' . $filename]);
        //return Excel::download(new InventoryProductExport, 'producten.xlsx');

    }

    public function updatenotifystatus(Request $request)
    {
        $gtin = $request->input('gtin');
        $status = $request->input('status');
        $product = Product::where('gtin', $gtin)->first();
        $product->notifystatus = $status;
        $product->save();
    }

    public function categories()
    {
        return Response()->json(Category::all());
    }

    public function quantity(Request $request)
    {

        $id = $request->input('id');
        $operation = $request->input('operation');


        if ($operation == 'plus') {
            Product::where('id', $id)->increment('stock', 1);
        } else if ($operation == 'minus') {
            Product::where('id', $id)->decrement('stock', 1);
        }

        return Response()->json(['status' => 'success']);
    }

    public function generateEan()
    {
        return Response()->json(Product::getNextProductEan());
    }

    public function batchUpload(Request $request)
    {

        try {
            if (!$request->hasFile('file')) {
                return response()->json([
                    ['gtin' => 'Error', 'title' => 'No file uploaded', 'success' => false, 'error' => 'No file provided']
                ], 400);
            }

            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();

            if (!in_array($extension, ['csv', 'xlsx'])) {
                return response()->json([
                    ['gtin' => 'Error', 'title' => 'Invalid file type', 'success' => false, 'error' => 'File must be CSV or XLSX']
                ], 400);
            }

            // Read the file
            $products = [];
            if ($extension === 'csv') {
                $products = $this->parseCsvFile($file);
            } else {
                $products = $this->parseExcelFile($file);
            }

            $results = [];
            foreach ($products as $productData) {
                try {
                    // Validate required fields
                    if (empty($productData['gtin']) || empty($productData['title'])) {
                        throw new \Exception('Missing required fields');
                    }

                    // Check if product exists
                    $product = Product::where('gtin', $productData['gtin'])->first();
                    // get category by name
                    if (isset($productData['category']) && !empty($productData['category'])) {
                        $category = Category::where('title', $productData['category'])->first();
                        if ($category) {
                            $productData['category'] = $category->id;
                        } else {
                            $productData['category'] = null; // or handle as needed
                        }
                    }

                    if ($product) {
                        // Update existing product
                        $product->update([
                            'title' => $productData['title'],
                            'stock' => $productData['stock'] ?? 0,
                            'price' => $productData['price'] ?? 0,
                            'category_id' => $productData['category'] ?? null,
                            'condition' => strtolower($productData['condition'] ?? 'new'),
                            'imageurl' => $productData['imageurl'] ?? null,
                            // 'bricklink_id' => $productData['bricklink_id'] ?? null
                        ]);
                    } else {
                        // Create new product
                        $productNew = Product::create([
                            'gtin' => $productData['gtin'],
                            'title' => $productData['title'],
                            'stock' => $productData['stock'] ?? 0,
                            'price' => $productData['price'] ?? 0,
                            'category_id' => $productData['category'] ?? null,
                            'condition' => strtolower($productData['condition'] ?? 'new'),
                            'imageurl' => $productData['imageurl'] ?? null,
                            // 'bricklink_id' => $productData['bricklink_id'] ?? null
                        ]);
                    }

                    $results[] = [
                        'gtin' => $productData['gtin'],
                        'title' => $productData['title'],
                        // add message
                        'message' => !empty($product) ? 'Product updated successfully' : 'Product created successfully',

                        'success' => true,
                        'error' => null
                    ];
                } catch (\Exception $e) {
                    $results[] = [
                        'gtin' => $productData['gtin'] ?? 'Unknown',
                        'title' => $productData['title'] ?? 'Unknown',
                        // add message
                        'message' => 'Error processing product',
                        'success' => false,
                        'error' => $e->getMessage()
                    ];
                }
            }

            return response()->json(['success' => true, 'message' => 'File Uploaded Successfully!', 'results' => $results]);
        } catch (\Exception $e) {
            return response()->json([
                ['gtin' => 'Error', 'title' => 'Processing Error', 'success' => false, 'error' => $e->getMessage()]
            ], 500);
        }
    }


    private function parseCsvFile($file)
    {
        $products = [];
        $handle = fopen($file->getPathname(), 'r');

        // Get headers
        $headers = fgetcsv($handle);

        while (($data = fgetcsv($handle)) !== false) {
            $row = array_combine($headers, $data);
            $products[] = $this->formatProductData($row);
        }

        fclose($handle);
        return $products;
    }

    private function parseExcelFile($file)
    {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getPathname());
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        $headers = array_shift($rows);
        $products = [];

        foreach ($rows as $row) {
            if (!empty(array_filter($row))) {
                $data = array_combine($headers, $row);
                $products[] = $this->formatProductData($data);
            }
        }

        return $products;
    }

    private function formatProductData($data)
    {
        return [
            'gtin' => str_pad($data['gtin'] ?? $data['ean'] ?? '', 13, '0', STR_PAD_LEFT),
            'title' => $data['title'] ?? $data['name'] ?? '',
            'stock' => (int)($data['quantity'] ?? $data['stock'] ?? 0),
            'price' => (float)($data['price'] ?? 0),
            'category' => $data['category_id'] ?? $data['category'] ?? null,
            'condition' => $data['condition'] ?? $data['condition'] ?? null,
            'imageurl' => $data['imageurl'] ?? $data['image_url'] ?? null,
            'bricklink_id' => $data['bricklink_id'] ?? null
        ];
    }

    public function bulkUpdateStock(Request $request)
    {
        try {
            $request->validate([
                'updates' => 'required|array',
                'updates.*.gtin' => 'required|string',
                'updates.*.stock' => 'required|integer|min:0',
            ]);

            $results = [];
            DB::beginTransaction();

            foreach ($request->updates as $update) {
                try {
                    $product = Product::where('gtin', $update['gtin'])->first();

                    if ($product) {
                        $oldStock = $product->stock;
                        $product->stock = $update['stock'];
                        $product->save();

                        $results[] = [
                            'gtin' => $update['gtin'],
                            'title' => $product->title,
                            'old_stock' => $oldStock,
                            'new_stock' => $update['stock'],
                            'success' => true,
                            'message' => 'Stock updated successfully'
                        ];
                    } else {
                        $results[] = [
                            'gtin' => $update['gtin'],
                            'success' => false,
                            'message' => 'Product not found'
                        ];
                    }
                } catch (\Exception $e) {
                    $results[] = [
                        'gtin' => $update['gtin'],
                        'success' => false,
                        'message' => 'Error updating stock: ' . $e->getMessage()
                    ];
                }
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Bulk stock update completed',
                'results' => $results
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error processing bulk update',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update_stock_from_overview_page(Request $request, $id)
    {
        // echo 'success';die;
        $product = Product::findOrFail($id);

        $amount = (int) $request->input('amount');
        $adjustmentType = $request->input('adjustmentType');

        $oldStock = $product->stock;

        switch ($adjustmentType) {
            case 'set':
                $product->stock = $amount;
                break;

            case 'add':
                $product->stock += $amount;
                break;

            case 'subtract':
                $product->stock -= $amount;
                if ($product->stock < 0) {
                    $product->stock = 0; // prevent negative stock
                }
                break;
        }

        $product->save();
        // echo 'Done';die;
        return redirect()->back();
        // return response()->json([
        //     'success' => true,
        //     'message' => "Stock updated successfully.",
        //     'product_id' => $product->id,
        //     'old_stock' => $oldStock,
        //     'new_stock' => $product->stock,
        // ]);
    }

    public function bulkUpdateLocation(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
            'location_id' => 'required|exists:stock_locations,id',
            // 'shelf_position' => 'nullable|string|max:50'
        ]);

        try {
            DB::beginTransaction();

            Product::whereIn('id', $request->product_ids)
                ->update([
                    'location_id' => $request->location_id,
                    // 'shelf_position' => $request->shelf_position
                ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Locations updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error updating locations: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getInvestmentItems(Request $request)
    {
        $query = Product::where('is_investment', true);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('gtin', 'like', "%{$search}%");
            });
        }

        return response()->json($query->get());
    }

    public function convertToRegular($id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'is_investment' => false,
            'investment_notes' => $product->investment_notes . "\nConverted to regular stock on " . now()->format('Y-m-d')
        ]);

        return response()->json([
            'message' => 'Product converted to regular stock successfully',
            'product' => $product
        ]);
    }

    public function updateInvestmentDetails(Request $request, $id)
    {
        $request->validate([
            'purchase_price' => 'nullable|numeric|min:0',
            'target_price' => 'nullable|numeric|min:0',
            'purchase_date' => 'nullable|date',
            'expected_list_date' => 'nullable|date|after:purchase_date',
            'investment_notes' => 'nullable|string'
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only([
            'purchase_price',
            'target_price',
            'purchase_date',
            'expected_list_date',
            'investment_notes'
        ]));

        return response()->json($product);
    }

    public function colors()
    {
        $colors = DB::table('colors')->where('bricklink_name', '!=', NULL)->get();
        return response()->json($colors);
    }

    public function phpinfo()
    {
        print_r(phpinfo());
    }

    public function scanFeature()
    {
        $colors = DB::table('colors')->where('bricklink_name', '!=', NULL)->get();
        $categories = DB::table('categories')->orderBy('title', 'asc')->get();
        return view('scan-feature/index', compact('colors', 'categories'));
    }

    public function scanFeatureSave(Request $request)
    {
        $validated = $request->validate([
            'modalTitle' => 'required|string|max:255',
            'modalItemNo' => 'required|string|max:100',
            'modalItemType' => 'nullable|string|max:100',
            'modalColorName' => 'nullable|string|max:100',
            'modalStock' => 'nullable|integer',
            'modalPrice' => 'nullable|numeric',
            'modalCondition' => 'nullable|string|max:50',
            'modalCompleteness' => 'nullable|string|max:255',
            'modalCategory' => 'nullable|string|max:255',
            'modalGTIN' => 'nullable|string|max:100',
            'modalSKU' => 'nullable|string|max:100',
            'modalUrl' => 'nullable|string|max:255',
            // 'modalImageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            // 'modalGallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // dd($request->all());

        $retain = $request->has('retain') ? 1 : 0;
        $isStockRoom = $request->has('isStockRoom') ? 1 : 0;
        $stockRoomId = $request->input('modalStockRoomId');

        $data_from_webhook = $this->sendToWebhook($validated['modalItemNo'], $validated['modalItemType']);

        $item = new Product();

        // ✅ Save main image if uploaded
        if ($request->hasFile('modalImageFile')) {
            $mainImage = $request->file('modalImageFile');
            $path = $mainImage->store('inventory_images', 'public');
            $item->main_image = '/public/storage/' . $path;
        }

        // ✅ Save gallery images if uploaded
        $_gallery = [];
        if ($request->hasFile('modalGallery')) {
            foreach ($request->file('modalGallery') as $galleryImage) {
                $galleryPath = $galleryImage->store('inventory_images', 'public');
                $_gallery[] = '/public/storage/' . $galleryPath;
            }
        }
        $item->gallery_images = $_gallery;

        // ✅ Save other fields
        $item->title = $validated['modalTitle'];
        $item->item_no = $validated['modalItemNo'];
        $item->item_type = isset($validated['modalItemType']) ? strtoupper($validated['modalItemType']) : null;
        $item->color_id = $validated['modalColorName'] ?? null;

        $color = DB::table('colors')->where('bricklink_id', $validated['modalColorName'])->get();
        $item->color_name = $color[0]->bricklink_name ?? null;

        $item->stock = $validated['modalStock'] ?? 0;

        $item->price = $validated['modalPrice'] ?? 0;
        // $item->price = $data_from_webhook['avg_price'] ?? 0;
        $item->condition = $validated['modalCondition'] ?? null;
        $item->completeness = $validated['modalCompleteness'] ?? null;


        $categoriesData = DB::table('categories')->where('id', $validated['modalCategory'])->first();
        $item->category = $categoriesData->title ?? null;
        // echo $categoriesData->title;die;

        // $category = DB::table('categories')->where('title', 'like', '%' . $validated['modalCategory'] . '%')->get();
        // $item->category_id = $category[0]->id ?? null;
        $item->category_id = $validated['modalCategory'] ?? null;

        $item->gtin = $validated['modalGTIN'] ?? null;
        $item->sku = $validated['modalSKU'] ?? null;
        $item->retain = $retain;
        $item->is_stock_room = $isStockRoom;
        $item->stock_room_id = $stockRoomId;
        $item->imageurl = $validated['modalUrl'] ?? null;

        // print_r($item);die;

        // Check if product exists
        $existingItem = Product::where('item_no', $item->item_no)
            ->where('color_id', $item->color_id)
            ->where('condition', $item->condition)
            ->first();

        if ($existingItem) {
            // Update existing item
            $existingItem->stock         += $item->stock;
            // $existingItem->stock         = $existingItem->stock + 1;

            if ($item->price > $existingItem->price) {
                $existingItem->price = $item->price;
            }

            $existingItem->updated_at = date('Y-m-d H:i:s');

            $existingItem->save();
        } else {
            // Insert new item
            $item->save();
        }


        return redirect()->back()->with('success', 'Item saved successfully!');
    }

    public function inichecking() {
        dd(
            ini_get('upload_max_filesize'),
            ini_get('post_max_size'),
            $_SERVER['CONTENT_LENGTH'] ?? null,
        );
    }
}
