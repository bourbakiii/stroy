<?php

namespace App\Http\Controllers;

use App\Models\Brigade;
use App\Models\BrigadesConnection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ResponsesHelper;

class BrigadesController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'workerIds' => 'array',
            'workerIds.*' => 'integer'
        ]);
        if ($validator->fails())
            return ResponsesHelper::validationErrors($validator->errors());

        $bridage = Brigade::create(['name' => $request->name]);
        for ($i = 0; $i < count($request->workerIds); $i++) {
            BrigadesConnection::create([
                'brigade_id' => $bridage->id,
                'worker_id' => $request->workerIds[$i],
            ]);
        }
        return ResponsesHelper::success("Success", 200, $bridage->id);
    }

    public function getAll(Request $request)
    {
        $brigades = Brigade::with('workers')->get();
        $formattedBrigades = $brigades->map(function ($brigade) {
            return [
                'brigade_name' => $brigade->name,
                'workers' => $brigade->workers->map(function ($worker) {
                    return $worker->only(['name', 'type_id', 'age', 'gender']);
                })
            ];
        });
        return ResponsesHelper::success("Success", 200, $brigades);
    }

    public function findById(Request $request)
    {
        if (!$brigade = Brigade::with('workers')->where('id', $request->id)->first())
            return ResponsesHelper::error('Worker not founded', 404);
        return ResponsesHelper::success("Success", 200, $brigade);
    }


    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brigade_id' => 'required|exists:brigades_connections',
            'name' => 'required|string',
            'workerIds' => 'array',
            'workerIds.*' => 'integer'
        ]);
        if ($validator->fails())
            return ResponsesHelper::validationErrors($validator->errors());
        $b_connection = BrigadesConnection::where('brigade_id', $request->brigade_id)->first();
        $the_brigade = Brigade::where('id', $b_connection->brigade_id)->first();
        $the_brigade->update(['name' => $request->name]);
        BrigadesConnection::where('brigade_id', $b_connection->brigade_id)->delete();
        for ($i = 0; $i < count($request->workerIds); $i++) {
            BrigadesConnection::create([
                'brigade_id' => $b_connection->brigade_id,
                'worker_id' => $request->workerIds[$i],
            ]);
        }
        return ResponsesHelper::success("Success", 200, $b_connection->brigade_id);


    }
}
