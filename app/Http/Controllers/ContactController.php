<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function getContacts() {
        $contacts = Contact::all();
        return $contacts;
    }

    public function setContact(Request $request) {
        $contact = new Contact;

        if ($request->has('image') && !empty($request->image)) {
            $image_name = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/gallery'), $image_name);
            $path = ('images/gallery/' . $image_name);
            $contact->image = $path;
        }

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->occupation = $request->occupation;
        $contact->bio = $request->bio;
        $contact->contact_no = $request->contact_no;

        if ($contact->save()) {
            return response()->json(['status' => true, 'message' => 'Contact Added Successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'There is some problem. Pleas try again']);
        }
    }

    public function updateContact(Request $request, $id) {

        $contact = Contact::where('id', $id)->first();

        if ($request->has('image') && !empty($request->image) && is_object($request->image)) {
            $image_name = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/gallery'), $image_name);
            $path = ('images/gallery/' . $image_name);
            $contact->image = $path;
        }

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->occupation = $request->occupation;
        $contact->bio = $request->bio;
        $contact->contact_no = $request->contact_no;

        if ($contact->save()) {
            return response()->json(['status' => true, 'message' => 'Contact Updated Successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'There is some problem. Pleas try again']);
        }
    }

    public function deleteContact($id) {
        $contact = Contact::find($id);
        if ($contact->delete()) {
            return response()->json(['status'=>true, 'message'=> 'Contact Deleted Successfully']);
        } else {
            return response()->json(['status'=>false, 'message'=> 'Something Went Wrong']);
        }
    }

    public function getContact($id) {
        $contact = Contact::find($id);
        return response()->json($contact);
    }
}
