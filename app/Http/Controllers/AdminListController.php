<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;

class AdminListController extends Controller
{

    public function index(){
        $admins = Admin::all();
        return view('admin.admin-list', compact('admins'));
    }

    public function userlist(){
        $users = User::all();
        return view('admin.user-list', compact('users'));
    }
}
