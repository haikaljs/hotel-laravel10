<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function Index(){
        return view('frontend.index');
    }

    public function UserProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('frontend.dashboard.edit_profile', compact('profileData'));
    }

    public function UserProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $data->photo = $filename;
        }
        $data->save();

        $notification = [
            'message' => 'User profile updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);

    }

    public function UserLogout(Request $request)
    {
        $username = Auth::user()->name;
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = [
            'message' => "User $username logout successfully",
            'alert-type' => 'success'
        ];

        return redirect('/login')->with($notification);
    }

    public function UserChangePassword(){
        return view('frontend.dashboard.user_change_password');
    }

    public function PasswordChangeStore(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if(!Hash::check($request->old_password, Auth::user()->password)){
            $notification = [
                'message' => 'Old password does not match!',
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }

        // update new password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = [
            'message' => 'Password changed successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);

    }
}
