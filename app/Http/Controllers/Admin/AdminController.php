<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\VendorsBusinessDetail;
use Hash;
use Auth;
use Image;

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

            if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999).'.'.$extension;
                    $imagePath = 'admin/images/photos/'.$imageName;
                    Image::make($image_tmp)->save($imagePath);
                }
            }else if(!empty($data['current_image'])){
                $imageName = $data['current_image'];
            }else{
                $imageName = "";
            }

            Admin::where('id', Auth::guard('admin')->user()->id)->update(['name'=>$data['name'], 'mobile'=>$data['mobile'], 'image'=>$imageName]);
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

    public function updateVendorDetails($slug, Request $request){
        if($slug=="personal"){
            if($request->isMethod('post')){
                $data = $request->all();

                if($request->hasFile('image')){
                    $image_tmp = $request->file('image');
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $imageName = rand(111, 99999).'.'.$extension;
                        $imagePath = 'admin/images/photos/'.$imageName;
                        Image::make($image_tmp)->save($imagePath);
                    }
                }else if(!empty($data['current_image'])){
                    $imageName = $data['current_image'];
                }else{
                    $imageName = "";
                }

                Admin::where('id', Auth::guard('admin')->user()->id)->update(['name'=>$data['vendor_name'], 'mobile'=>$data['vendor_mobile'], 'image'=>$imageName]);
                Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->update(['name'=>$data['vendor_name'],
                'mobile'=>$data['vendor_mobile'],'address'=>$data['address'], 'country'=>$data['country'], 'city'=>$data['city'], 'pincode'=>$data['pincode']]);


                return redirect()->back()->with('success_message', 'Les informations ont été mis à jour avec succès.');
            }
            $vendorDetails = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();

        }else if($slug == "business"){
            if($request->isMethod('post')){
                $data = $request->all();

                if($request->hasFile('address_proof_image')){
                    $image_tmp = $request->file('address_proof_image');
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $imageName = rand(111, 99999).'.'.$extension;
                        $imagePath = 'admin/images/proofs/'.$imageName;
                        Image::make($image_tmp)->save($imagePath);
                    }
                }else if(!empty($data['address_proof_image'])){
                    $imageName = $data['address_proof_image'];
                }else{
                    $imageName = "";
                }

                VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update(['shop_name'=>$data['shop_name'],
                'shop_address'=>$data['shop_address'],'shop_city'=>$data['shop_city'], 'shop_country'=>$data['shop_country'], 'shop_pincode'=>$data['shop_pincode'],
                 'shop_mobile'=>$data['shop_mobile'], 'shop_website'=>$data['shop_website'], 'shop_email'=>$data['shop_email'], 'address_proof'=>$data['address_proof'],
                  'address_proof_image'=>$imageName]);


                return redirect()->back()->with('success_message', 'Les informations ont été mis à jour avec succès.');
            }
            $vendorDetails = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        }else if($slug == "bank"){

        }
        return view('admin.settings.update_vendor_details')->with(compact('slug', 'vendorDetails'));
    }
}
