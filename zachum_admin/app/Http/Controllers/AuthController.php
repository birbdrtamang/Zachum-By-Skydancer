<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Manager;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    function loginPost(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $email = $request->input('email');

        $user = User::where('email', $email)->first();
        $credentials = $request->only('email','password');


        if(Auth::attempt($credentials) && $user->role=='Admin'){
            $currentUser = $user->name;
            Session::put('currentUser', $currentUser);

            $manager = Manager::get();
            return redirect()->route('dashboard',compact('manager'))->with('success','Login Successful!');
        }
        if(!$user){
            return redirect()->route('login')->with("error", "Please enter a valid phone number.");
        }else{
            return redirect()->route('login')->with("error", "Please enter a correct password.");
        }
    }

     // logout
     function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }


    // create data
    public function createManager(Request $request){
        $request->validate([
                'name'=>'required',
                'email' => ['required', 'email', 'unique:users', 'regex:/@gmail\.com$/i'],
                'phoneNo'=>['required', 'regex:/^(17|77)\d{6}$/', 'size:8','unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
            ],
            [
                'email.regex' => 'The email must be in the format "@gmail.com"',
                'phoneNo.regex' => 'Please enter a valid phone number',
            ]
        );  

        $user['name'] = $request->name;
        $user['email'] = $request->email;
        $user['phoneNo'] = $request->phoneNo;
        $user['password'] = Hash::make($request->password);
        $user['role'] = 'Manager';
        
        $user = User::create($user);

        $newUser = User::where('phoneNo', $request->phoneNo)->first();
        
        $data['manager_id'] = $newUser->id;
        $data['name'] = $newUser->name;
        $data['email'] = $newUser->email;
        $data['phoneNo'] = $newUser->phoneNo;
        $data['password'] = $newUser->password;

        $manager = Manager::create($data);


        if($user && $manager){
            return redirect(route('dashboard'))->with("success", "Manager Created Successful!");
        } else {
            return redirect()->back()->with('error', 'Failed to create Manager, please try again.');
        }
    }

    function profile(){
        return view('profile');
    }

    public function deleteManager($id){
        $item = Manager::where('manager_id', $id)->first();
        $user = User::where('id',$id)->first();
        if ($item && $user) {
            $item->delete();
            $user->delete();
            return redirect(route('dashboard'))->with('success','Manager deleted successfully!');
        } else {
            return redirect()->back()->with('error','Manager not found!');
        }
    }

    // update user 
    function updateUser($id,Request $request){
        $user = User::find($id);

        $request->validate([
            'name'=> 'required',
            'email'=> 'required',
            'phoneNo'=> 'required',
            'password'=> 'required'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phoneNo = $request->phoneNo;
        $user->password = Hash::make($request->password);

        $user->save();
        return redirect()->back()->with('success','Profile updated successfully!');
    }

    function forgetPassword(){
        return view('forgetpassword');
    }

    function forgetPasswordPost(Request $request) {
        $request->validate([
            'phoneNo' => 'required',
        ]);
    
        $data = $request->input('phoneNo');
        $phoneNo = encrypt($data);
    
        $user = User::where('phoneNo', $data)
                    ->where('role', 'Admin')
                    ->first();
    
        if (!$user) {
            return redirect()->back()->with("error", "Incorrect phone number. Please try again.");
        } else {
            return redirect(route('resetPassword', ['phoneNo' => $phoneNo]));
        }
    }

    function resetPassword($phoneNo){
        return view('resetPassword',compact('phoneNo'));
    }

    function resetPasswordPost(Request $request, $phoneNo){
        $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
        ]);
    
        $newPassword = $request->input('password');
        $decryptedData = decrypt($phoneNo);
    
        $user = User::where('phoneNo', $decryptedData)->first();
    
    
        if (!$user) {
            return redirect()->back()->with("error", "Phone number not found. Please try again.");
        }
    
        if ($user) {
            $user->password = Hash::make($newPassword);
            $user->save();
        }
        return redirect()->route('login')->with('success', 'Password reset successful!');
    }

} 
