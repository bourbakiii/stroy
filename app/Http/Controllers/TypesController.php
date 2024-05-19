<?php

namespace App\Http\Controllers;

use App\Helpers\ResponsesHelper;
use App\Models\TypeOfUsers;
use App\Models\TypeOfWorkers;
use Illuminate\Http\Request;

class TypesController extends Controller
{
    public function getTypesOfUsers(Request $request)
    {
        return ResponsesHelper::success('Success', 200, ['type_of_users' => TypeOfUsers::get()]);
    }
    public function getTypesOfWorkers(Request $request)
    {
        return ResponsesHelper::success('Success', 200, ['type_of_workers' => TypeOfWorkers::get()]);
    }
}
