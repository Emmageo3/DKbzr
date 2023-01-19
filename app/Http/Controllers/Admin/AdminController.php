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

    public function updateAdminPassword(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();


            if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
                if($data['confirm_password']==$data['new_password']){
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' =>
                    bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_message', 'Le mot de passe a été modifié avec succès.');
                }else{
                    return redirect()->back()->with('error_message', 'Les deux mots de passe ne matchent pas.');
                }
            }else{
                return redirect()->back()->with('error_message', 'Le mot de passe saisi est incorrect.');
            }
        }

        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_password')->with(compact('adminDetails'));
    }

    public function updateAdminDetails(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            Admin::where('id', Auth::guard('admin')->user()->id)->update(['name'=>$data['name'], 'mobile'=>$data['mobile']]);
            return redirect()->back()->with('success_message', 'Les informations ont été mis à jour avec succès.');
        }
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_details')->with(compact('adminDetails'));
    }

    public function checkAdminPassword(Request $request){
        $data = $request->all();
        if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)){
            return "true";
        }else{
            return "false";
        }
    }
}
