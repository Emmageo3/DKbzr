<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Session;

class BrandController extends Controller
{
    public function brands(){
        Session::put('page','brands');
        $brands = Brand::get()->toArray();
        return view('admin.brands.brands')->with(compact('brands'));
    }

    public function updateBrandStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Brand::where('id', $data['brand_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'brand_id'=>$data['brand_id']]);
        }
    }

    public function deleteBrand($id){
        Brand::where('id', $id)->delete();
        $message = "La marque a été supprimée avec succès !";
        return redirect()->back()->with('success_message', $message);
    }

    public function addEditBrand(Request $request, $id=null){
        Session::put('page','brands');
        if($id==""){
            $title = "Ajouter une marque";
            $brand = new Brand;
            $message = "La marque a été ajoutée avec succès !";
        }else{
            $title = "Modifier la marque";
            $brand = Brand::find($id);
            $message = "La marque a été modifiée avec succès !";
        }

        if($request->isMethod('post')){
            $data = $request->all();

            $rules =[
                'brand_name' => 'required|regex:/^[\pL\s\-]+$/u'
            ];

            $customMessages = [
                'brand_name.required' => "Veuillez ajouter une marque",
                'brand_name.regex' => "Veuillez ajouter un nom valide"
            ];

            $this->validate($request,$rules,$customMessages);

            $brand->name = $data['brand_name'];
            $brand->status = 1;
            $brand->save();

            return redirect('admin/brands')->with('success_message', $message);
        }

        return view('admin.brands.add_edit_brand')->with(compact('title','brand'));

    }
}
