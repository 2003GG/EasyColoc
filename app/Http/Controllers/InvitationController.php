<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function index(){
        $invitations=Invitation::where('status','waiting');
        return view('invitations',compact('invitations'));
    }
    public function acceptInvitation(Invitation $userInvitation){
        $userInvitation->update([
            'status'=>'accepted',
            ]
        );
        return redirect()->route('invitation.index');

    }
      public function refuseInvitation(Invitation $userInvitation){
        $userInvitation->update([
            'status'=>'refused',
            ]
        );
        return redirect()->route('invitation.index');
    }
}
