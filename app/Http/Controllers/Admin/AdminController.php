<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePassword;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //user logout
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $noti = [
            "error"=>false,
            "message"=>"User logout successful",
        ];
        return redirect('/login')->with($noti);
    }
    //end

    //user profile
    public function profile(){
        $id = Auth::id();
        $user = User::findOrFail($id);
        return view('admin.admin_profile_view',compact('user'));
    }
    //end

    //edit profile
    public function editProfile(){
        $id = Auth::id();
        $edituser = User::findOrFail($id);
        return view('admin.admin_profile_edit',compact('edituser'));
    }
    //end

    //store profile
    public function storeProfile(Request $request){
        $id = Auth::id();
        $storeprofile = User::find($id);

        $storeprofile->name = $request->name;
        $storeprofile->email = $request->email;
        
        //store image to database
        if($request->hasFile('image')){
            $newimage = "profile_image.".$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$newimage);
            $storeprofile->profile_image = $newimage;
        }
        $storeprofile->save();

        //send message

        $noti = [
            "error"=>false,
            "message"=>"Admin profile update successful.",
        ];
        return redirect()->route('admin.profile')->with($noti);
    }
    //end

    //admin change password view
    public function changePassword(){
        return view('admin.admin_change_psw');
    }
    //end

    //update password

    public function updatePassword(UpdatePassword $request){
        $validator = $request->validated();
          if(Hash::check($validator['oldpassword'] , auth()->user()->password)) {
            if(!Hash::check( $validator['oldpassword'], auth()->user()->password)) {
               $user = User::find(auth()->id());
               $user->update([
                   'password' => bcrypt($validator['password'])
               ]);
               session()->flash('message','Password updated successfully!');
               return redirect()->route('dashboard');
            }
            session()->flash('message','New password can not be the old password!');
            return redirect()->back();
        }
        session()->flash('message','Old password does not matched!');
        return redirect()->back();
    
    }
}
