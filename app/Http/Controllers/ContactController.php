<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function getContacts() {
        $contacts = Contact::all();
        return $contacts;
    }

    public function setContacts(Request $request) {
        $contact = new Contact;

        if ($request->has('image') && !empty($request->image)) {
            $image_name = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/gallery'), $image_name);
            $path = ('public/images/gallery/' . $image_name);
            $contact->image = $path;
        }

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->designation = $request->designation;
        $contact->bio = $request->bio;
        $contact->contact_no = $request->contact_no;

        if ($contact->save()) {
            return response()->json(['status' => true, 'message' => 'Contact Added Successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'There is some problem. Pleas try again']);
        }
    }

    public function deleteContact($id) {
        //
    }
}
