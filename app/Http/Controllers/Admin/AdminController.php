<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Colocation;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
         $users = User::all()->where('role_id',2);
         $colocations=Colocation::count();
         $usersCount=User::where('role_id',2)->count();
         $banUser=User::where('condition','banne')->count();

        return view('admin', compact('users','banUser','usersCount','colocations'));
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
