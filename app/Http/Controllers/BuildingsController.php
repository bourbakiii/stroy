<?php

namespace App\Http\Controllers;

use App\Helpers\ResponsesHelper;
use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BuildingsController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'string',
            'address' => 'required|string',
            'due_to' => 'required|date'
        ]);
        if ($validator->fails()) return ResponsesHelper::validationErrors($validator->errors());
        $created_building = Building::create($request->all());
        return ResponsesHelper::success("Success", 200, $created_building['id']);
    }
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'string',
            'address' => 'required|string',
            'due_to' => 'required|date'
        ]);
        if ($validator->fails()) return ResponsesHelper::validationErrors($validator->errors());
        if(!$building = Building::where('id', $request->id)->first()) return ResponsesHelper::error('Building not founded', 404);
        $building->update($request->all());
        return ResponsesHelper::success("Success", 200, $building);
    }

    public function getAll(Request $request)
    {
        return ResponsesHelper::success("Success", 200, Building::get());
    }

    public function findById(Request $request)
    {
        if (!$building = Building::where('id', $request->id)->first())
            return ResponsesHelper::error('Building not founded', 404);
        return ResponsesHelper::success("Success", 200, $building);
    }
}
