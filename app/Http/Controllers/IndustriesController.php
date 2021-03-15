<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use Illuminate\Http\Request;

class IndustriesController extends Controller
{
    public function getIndustries() {
        $industries = Industry::all();
        return $industries;
    }

    public function setIndustry(Request $request) {
        $industry = new Industry;

        if ($request) {
            $industry->name = $request->name;
        }

        if ($industry->save()) {
            return response()->json(['status' => true, 'message' => 'Industry Added Successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'There is some problem. Pleas try again']);
        }
    }

    public function updateIndustry(Request $request, $id) {
        $industry = Industry::where('id', $id)->first();

        $industry->name = $request->name;

        if ($industry->save()) {
            return response()->json(['status' => true, 'message' => 'Industry Updated Successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'There is some problem. Pleas try again']);
        }
    }

    public function deleteIndustry($id) {
        $industry = Industry::find($id);
        if ($industry->delete()) {
            return response()->json(['status'=>true, 'message'=> 'Industry Deleted Successfully']);
        } else {
            return response()->json(['status'=>false, 'message'=> 'Something Went Wrong']);
        }
    }
}
