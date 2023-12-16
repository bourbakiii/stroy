<?php

namespace App\Http\Controllers;

use App\Helpers\ResponsesHelper;
use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BuildingsController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'address' => 'required|string',
            'due_to' => 'required|date'
        ]);
        if ($validator->fails()) return ResponsesHelper::validationErrors($validator->errors());

        return $created_building = Building::create($request->all());
    }
}
