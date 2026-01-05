<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use \Illuminate\Database\Eloquent\ModelNotFoundException;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contacts = Contact::all();
        return Response()->json($contacts);  
    }

    public function store(Request $request)
    {
        $input = $request->input('contact');

        $contact = new Contact();
        $contact->fill($input);
        //$contact = Contact::where('id', $request->input('contact.id'))->first();
        $contact->save();
        return Response()->json($contact);  
    }

    public function update(Request $request)
    {
        $input = $request->input('contact');


        $contact = Contact::where('id', $request->input('contact.id'))->first();
        $contact->update($input);
        return Response()->json($contact);  
    }

    public function delete($id)
    {
        $contact = Contact::find($id);
        if($contact) {
            $contact->delete();
            return Response()->json(['status' => 'deleted']);  
        }
        return Response()->json(['status' => 'not_deleted']);  

    }
}
