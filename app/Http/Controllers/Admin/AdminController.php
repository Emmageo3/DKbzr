<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
}
