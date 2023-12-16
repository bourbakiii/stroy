<?php

namespace App\Http\Controllers;

use App\Helpers\ResponsesHelper;
use App\Models\TypeOfUsers;
use Illuminate\Http\Request;

class TypesController extends Controller
{
    public function getTypesOfUsers(Request $request)
    {
        return ResponsesHelper::success('Success', 200, ['type_of_users' => TypeOfUsers::get()]);
    }
}
