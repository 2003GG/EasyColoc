<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
         $users = User::all()->where('role_id',2);

        return view('admin', compact('users'));
    }
    public function bannie(user $user){
        $user->update([
            'condition'=>'banne',
        ]);
       return redirect()->route('users.index');

    }

    public function Inbannie(User $user){
                $user->update([
            'condition'=>'notbanne',
        ]);
      return redirect()->route('users.index');

    }

}
