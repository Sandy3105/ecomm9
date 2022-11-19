<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\Admin;

class AdminController extends Controller
{

    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            $validated = $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);
            // echo "<pre>"; 
            // print_r($data);
            //  die;
             if(Auth::guard('admin')->attempt([ 'email'=>$data['email'],'password'=>$data['password'],'status'=>1 ])){
                return redirect('admin/dashboard');
             }else{
                return redirect()->back()->with('error_message','Invalid email or password');
             }
        }
        return view('admin.login');
    }

    
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function updateAdminPassword(Request $request){
        // echo "<pre>"; print_r(Auth::guard('admin')->user()); die;
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            // Check if current password is correct or not
            if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
                // check if new password is matching with the confirm password or not
                if($data['new_password'] == $data['confirm_password']){
                    Admin::where(['id' => Auth::guard('admin')->user()->id])->update(['password' => bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_message','Password updated successfully');
                }else{
                    return redirect()->back()->with('error_message','New Password and Confirm password not matching');
                }
            }else{
                return redirect()->back()->with('error_message','Your current password is incorrect');
            }
        }
        $admindetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_password')->with(compact('admindetails'));
    }

    public function updateAdminDetails(Request $request){

        if($request->isMethod('post')){
           $data = $request->all();
            // Update admin details

            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'mobile' => 'required|numeric|'
            ];

            $customMessages = [
                'name.required' => 'Name is required',
                'name.regex' => 'Valid name is required',
                'mobile.required' => 'Mobile is required',
                'mobile.numeric' => 'Mobile number should be numeric',
            ];

            $this->validate($request, $rules, $customMessages);

            Admin::where(['id' => Auth::guard('admin')->user()->id])->update(['name' => $data['name'] , 'mobile' => $data['mobile']]);
            return redirect()->back()->with('success_message','Details updated successfully');

        }
        $admindetails = Admin::where(['email'=> Auth::guard('admin')->user()->email])->first();
        return view('admin.settings.update_admin_details',[ 'admindetails' => $admindetails]);
    }

    public function checkAdminPassword(Request $request){
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;
        if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)) {
            return "true";
        }
        else{
            return "false";
        }      
       
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
