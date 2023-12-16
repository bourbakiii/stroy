<?php

namespace App\Http\Controllers;

use App\Helpers\ResponsesHelper;
use App\Models\Building;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkersController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'type_id' => 'required|exists:type_of_workers,id',
            'age' => 'required|int',
            'gender' => 'required|in:0,1'
        ]);
        if ($validator->fails()) return ResponsesHelper::validationErrors($validator->errors());

        return $worker = Worker::create($request->all());
    }
}
