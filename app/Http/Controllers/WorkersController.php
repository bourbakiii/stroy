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
            'gender' => 'required|in:0,1',
        ]);
        if ($validator->fails()) return ResponsesHelper::validationErrors($validator->errors());

        return $worker = Worker::create($request->all());
    }

    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'type_id' => 'required|exists:type_of_workers,id',
            'age' => 'required|int',
            'gender' => 'required|in:0,1',
        ]);
        if ($validator->fails()) return ResponsesHelper::validationErrors($validator->errors());

        if(!$worker = worker::where('id', $request->id)->first()) return ResponsesHelper::error('Worker not founded', 404);
        $worker->update($request->all());
        return ResponsesHelper::success("Success", 200, $worker);
    }
    public function getAll(Request $request){
        return ResponsesHelper::success("Success", 200, Worker::with('typeOfWorker')->get());
    }
    public function findById(Request $request)
    {
        if (!$worker = Worker::where('id', $request->id)->first())
            return ResponsesHelper::error('Worker not founded', 404);
        return ResponsesHelper::success("Success", 200, $worker);
    }
}