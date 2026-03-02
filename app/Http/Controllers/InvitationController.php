<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvitationRequest;
use App\Models\Colocation;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Email;

class InvitationController extends Controller
{
    public function index(){
        $invitations=Invitation::where('status','waiting')->get();
        return view('invitations',compact('invitations'));
    }

   public function sendInvitisation(InvitationRequest $request)
{
    $receiver = User::where('email', $request->email)->firstOrFail();

    if (!auth()->user()->colocation) {
        return back()->with('error', 'Vous n\'avez pas de colocation.');
    }

    Invitation::create([
        'from_user'     => auth()->id(),
        'to_user'       => $receiver->id,
        'colocation_id' => auth()->user()->colocation->id,
        'status'        => 'waiting',
    ]);

    return redirect()->route('invitation.index');
}
    public function acceptInvitation(Invitation $userInvitation,$colocationId){
        if(auth()->user()->colocation_id==null){
        $userInvitation->update([
            'status'=>'accepted',
            ]
        );
        auth()->user()->update([
            'colocation_id'=>$colocationId,
        ]);
        }
        else{
        return redirect()->route('invitation.index')->with('success', 'Vous avez rejoint la colocation !');
        }
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
