<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function GetRoleId($role_code){
        $role = Role::where('role_code', $role_code)->first();

        if($role){
            return $role->id;
        }
        return null;
    }
}
