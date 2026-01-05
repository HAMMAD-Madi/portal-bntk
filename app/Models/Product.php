<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use App\Events\productSaved;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductQuantityChange;
use GtinValidation\GtinValidator;

class Product extends Model
{
    use HasFactory, SoftDeletes, EagerLoadPivotTrait;

    #protected $metaTable = 'inventory.products_meta'; 
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'gtin',
        'brand',
        'stock',
        'condition',
        'stockSupplier',
        'main_image',
        'gallery_images',
        'price',
        'sell_price',
        'supplier',
        'page_url',
        'imageurl',
        'location_id',
        // 'shelf_position'
        'is_investment',
        'purchase_price',
        'purchase_date',
        'expected_list_date',
        'target_price',
        'investment_notes',
        
        'vinted_active',
        'vinted_item_id',
        'vinted_status',
        'vinted_main_image',
        'vinted_gallery_images'
    ];

    protected $attributes = [
        'condition' => 'new',
    ];

    protected $appends = ['is_trashed'];

    // Define the accessor
    public function getIsTrashedAttribute()
    {
        return $this->trashed();
    }

    public static function getNextProductEan() {
        $findEan = true;
        $tries = 0;
        while($findEan && $tries < 25) {
            $ean = self::randomEan();
            $findEan = Product::where('gtin', $ean)->first() ?? false;
            $tries++;
        }

        if($tries >= 25) {
            throw \Exception('max tries exceeded for generating ean');
            //throw new PcmanGtinGeneratorExceededException('Tries ('.$tries.') exceeded 25. Ean code: '.$ean.'. Returned last found: '. var_export($findEan, true));
        }
        //$ean = (int) DB::table('barcodes')->max('GTIN');
        return self::addCheck($ean);
    }

    private static function randomEan() {
        $result = '';
    
        for($i = 0; $i < 9; $i++) {
            $result .= mt_rand(0, 9);
        }
    
        return '2002' . $result;
    }

    public static function addCheck($digits)
    {



        //first change digits to a string so that we can access individual numbers
        $digits =(string)$digits;
        // $digits = $digits . 'a';

        // if(!is_numeric($digits)) {
        //     throw new PcmanGtinNumericException('gtin is not numeric');

        // }

        if(strlen($digits) > 12) {
            $digits = substr($digits, 0, 12);
        }

        $gtinValidator = new GtinValidator($digits);
        $gtinObject = $gtinValidator->getGtinObject();

        if(!$gtinObject->isValidFormat() ) {
            throw new \Exception('incorrect GTIN format');
        }

        // 1. Add the values of the digits in the even-numbered positions: 2, 4, 6, etc.
        $even_sum = $digits[1] + $digits[3] + $digits[5] + $digits[7] + $digits[9] + $digits[11];
        // 2. Multiply this result by 3.
        $even_sum_three = $even_sum * 3;
        // 3. Add the values of the digits in the odd-numbered positions: 1, 3, 5, etc.
        $odd_sum = $digits[0] + $digits[2] + $digits[4] + $digits[6] + $digits[8] + $digits[10];
        // 4. Sum the results of steps 2 and 3.
        $total_sum = $even_sum_three + $odd_sum;
        // 5. The check character is the smallest number which, when added to the result in step 4,  produces a multiple of 10.
        $next_ten = (ceil($total_sum/10))*10;
        $check_digit = $next_ten - $total_sum;

        $GTIN13 = $digits . $check_digit;

        $gtinValidator = new GtinValidator($GTIN13);
        $gtinObject = $gtinValidator->getGtinObject();
        if( $gtinObject->isValid()) {
            $type = $gtinObject->getType();
            if($type == 'GTIN-13') {
                return $GTIN13;
            } else {
                throw new Exception('Type: ' . $type . ' is not supported. Value is: ' . $digits);
            }
        } else {
            throw new \Exception($digits . ' not a valid GTIN-13 code');
        
        }
    
    }

    protected static function booted()
    {
        static::created(function ($product) {

            // This will be fired when a product is created.
            // ProductQuantityChange::create([
            //     'product_id' => $id,
            //     'user_id' => Auth::id(),  // Assumes the change is being made by an authenticated user
            //     'old_stock' => 0,
            //     'new_stock' => $product->stock ?? 0,
            //     'difference' => $product->stock ?? 0,
            // ]);
        });
    
        static::saving(function ($product) {

            // This will be fired when a product is about to be saved.
            // if ($product->isDirty('stock')) {
            //     ProductQuantityChange::create([
            //         'product_id' => 
            //         'user_id' => Auth::id(),  // Assumes the change is being made by an authenticated user
            //         'old_stock' => $product->getOriginal('stock'),
            //         'new_stock' => $product->stock,
            //         'difference' => $product->stock - $product->getOriginal('stock'),
            //     ]);
            // }
        });
    }
    

    // protected $dispatchesEvents = [
    //     'saved' => productSaved::class,
    // ];

protected $casts = [
    'gallery_images'        => 'array',
    'vinted_gallery_images' => 'array',   // ✅ MISSING LINE (CRITICAL)

    'notifyvalues' => 'array',
    'notifyselected' => 'array',
    'upgrades' => 'array',

    'condition' => 'string',
    'is_investment' => 'boolean',
    'purchase_price' => 'decimal:2',
    'target_price' => 'decimal:2',
    'purchase_date' => 'date',
    'expected_list_date' => 'date',
];


    protected function castAttribute($key, $value)
    {
        if ($this->getCastType($key) == 'array' && is_null($value)) {
            return [];
        }

        return parent::castAttribute($key, $value);
    }

    /**
     * Get the location of this product
     */
    public function location()
    {
        return $this->belongsTo(StockLocation::class, 'location_id');
    }
}
