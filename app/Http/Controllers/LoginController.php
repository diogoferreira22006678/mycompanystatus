<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected function guard()
    {
        return Auth::guard('alt');
    }

    public function username()
    {
    return 'user_name';
    }

    public function login(Request $request)
    {
        // if user is already logged in, log them out
        if (User::getCurrent()) {
            User::logout();
        }

         $requestUser = User::where('user_email', $request->input('email'))->first();

        if ($requestUser) {
            if (Hash::check($request->input('password'), $requestUser->user_pass)) {
                // The passwords match...
                // Manually log in the user
                User::setCurrent($requestUser);
                return redirect()->route('homePage');
            }
        }
        // The credentials do not match...
        return redirect()->back()->withErrors(['credentials' => 'The provided credentials do not match our records.']);
    }

    public function logout()
    {
        User::logout();
        return redirect()->route('loginPage');
    }

    public function register(Request $request){


        if($request->input('password') != $request->input('password_repeat')){
            return redirect()->back()->withErrors(['credentials' => 'The provided passwords do not match.']);
        }
        if(User::where('user_email', $request->input('email'))->first()){
            return redirect()->back()->withErrors(['credentials' => 'The provided email is already taken.']);
        }

        $user = new User();
        $user->user_name = $request->input('first_name') . ' ' . $request->input('last_name');
        $user->user_email = $request->input('email');
        $user->user_pass = Hash::make($request->input('password'));
        $user->user_super = 0;	// 0 = not admin, 1 = admin
        $user->save();

        return redirect()->route('loginPage');
    }

    public function usersAlterPhoto(Request $request){
        
        // Get id of the user logged in
        $user = User::getCurrent();
        $id = $user->user_id;

        // Get the photo from the request
        $photo = $request->file('photo');

        // Get the extension of the photo and check if it is valid
        $extension = $photo->getClientOriginalExtension();
        if($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png'){
            return redirect()->back()->withErrors(['credentials' => 'The provided photo is not valid.']);
        }

        // if user already has a photo in the storage/app/public/profile-photos folder, delete it, file can be found in some formats: id.jpg, id.jpeg, id.png
        if(file_exists(storage_path('app/public/profile-photos/' . $id . '.jpg'))){
            unlink(storage_path('app/public/profile-photos/' . $id . '.jpg'));
        }
        if(file_exists(storage_path('app/public/profile-photos/' . $id . '.jpeg'))){
            unlink(storage_path('app/public/profile-photos/' . $id . '.jpeg'));
        }
        if(file_exists(storage_path('app/public/profile-photos/' . $id . '.png'))){
            unlink(storage_path('app/public/profile-photos/' . $id . '.png'));
        }

        // Path is in the storage/app/public/profile-photos folder
        $photo->storeAs('public/profile-photos', $id . '.' . $extension);
        
        return redirect()->back()->withErrors(['message' => 'The photo was successfully uploaded. You may need to refresh the page to see the changes.']);
        
    }

    public function usersGetPhoto(Request $request){
        $id = $request->user_id;

        // Check in the storage if the user has a photo, if not, return the default photo
        if(file_exists(storage_path('app/public/profile-photos/' . $id . '.jpg'))){
            // return the file name as a response not the file itself
            return response()->json(['photo' => $id . '.jpg']);
        }
        // Check in the other formats
        if(file_exists(storage_path('app/public/profile-photos/' . $id . '.jpeg'))){
            return response()->json(['photo' => $id . '.jpeg']);
        }
        if(file_exists(storage_path('app/public/profile-photos/' . $id . '.png'))){
            return response()->json(['photo' => $id . '.png']);
        }
        // else return the default photo
        return response()->json(['photo' => 'default.png']);
    }

    public function usersAlterSettings(Request $request){

        $user = User::getCurrent();
        $id = $user->user_id;

        // Check if the email is already taken
        if(User::where('user_email', $request->input('email'))->where('user_id', '!=', $id)->first()){
            return redirect()->back()->withErrors(['credentials' => 'The provided email is already taken.']);
        }

        // if first_name or last_name is null, it means that the user is not changing them, so we don't need to update them
        if($request->input('first_name') != null && $request->input('last_name') != null){
            $user->user_name = $request->input('first_name') . ' ' . $request->input('last_name');
        }
        
        if($request->input('first_name') == null){
            $temp = explode(' ', $user->user_name);
            $user->user_name = $temp[0] . ' ' . $request->input('last_name');
        }

        if($request->input('last_name') == null){
            $temp = explode(' ', $user->user_name);
            $user->user_name = $request->input('first_name') . ' ' . $temp[1];
        }

        $user->user_email = $request->input('email');

        $user->save();

        return redirect()->back()->withErrors(['message' => 'The settings were successfully updated.']);
    }
}

