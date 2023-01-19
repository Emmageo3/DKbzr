<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Hash;
use Auth;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function login(Request $request){
        //echo $password = Hash::make('Mychoice12'); die;

        if($request->isMethod('post')){
            $data = $request->all();

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required'
            ];

            $customMessages =[
                'email.required' => 'Veuillez entrer votre adresse email',
                'email.email' => 'Veuillez entrer une adresse email valide',
                'password.required' => 'Veuillez entrer votre mot de passe'
            ];

            $this->validate($request, $rules, $customMessages);

            if(Auth::guard('admin')->attempt(['email'=>$data['email'], 'password'=>$data['password'], 'status'=>1])){
                return redirect('admin/dashboard');
            }else{
                return redirect()->back()->with('error_message', 'Adresse e-mail ou mot de passe incorrect.');
            }
        }
        return view('admin.login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function updateAdminPassword(){
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_password')->with(compact('adminDetails'));
    }
}
