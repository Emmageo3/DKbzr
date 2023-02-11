<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Section;
use App\Models\Brand;
use App\Models\Category;
use Session;
use Auth;
use Image;

class ProductController extends Controller
{
    public function products(){
        Session::put('page','products');
        $products = Product::with(['section'=>function($query){
            $query->select('id','name');
        },'category'=>function($query){
            $query->select('id','category_name');
        }])->get()->toArray();
        return view('admin.products.products')->with(compact('products'));
    }

    public function updateProductStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'product_id'=>$data['product_id']]);
        }
    }

    public function deleteProduct($id){
        Product::where('id', $id)->delete();
        $message = "Le prodduit a été supprimée avec succès !";
        return redirect()->back()->with('success_message', $message);
    }

    public function addEditProduct(Request $request, $id=null){
            Session::put('page','products');
            if($id==""){
                $title = "Ajouter un produit";
                $product = new Product;
                $message = "Le produit a été ajouté avec succès !";
            }else{
                $title = "Modifier le produit";
                $product = Product::find($id);
                $message = "Le produit a été modifié avec succès !";
            }

            if($request->isMethod('post')){
                $data = $request->all();

                if($data['product_color']==""){
                    $data['product_color'] = "";
                }

                $categoryDetails = Category::find($data['category_id']);
                $product->section_id = $categoryDetails['section_id'];
                $product->category_id = $data['category_id'];
                $product->brand_id = $data['brand_id'];

                $adminType = Auth::guard('admin')->user()->type;
                $vendor_id = Auth::guard('admin')->user()->vendor_id;
                $admin_id = Auth::guard('admin')->user()->id;

                $product->admin_type = $adminType;
                $product->admin_id = $admin_id;
                if($adminType == "vendor"){
                    $product->vendor_id = $vendor_id;
                }else{
                    $product->vendor_id = 0;
                }

                if($request->hasFile('product_image')){
                    $image_tmp = $request->file('product_image');
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $imageName = rand(111, 99999).'.'.$extension;
                        $smallImagePath = 'front/images/product_images/small/'.$imageName;
                        $mediumImagePath = 'front/images/product_images/medium/'.$imageName;
                        $largeImagePath = 'front/images/product_images/large/'.$imageName;
                        Image::make($image_tmp)->resize(1000,1000)->save($largeImagePath);
                        Image::make($image_tmp)->resize(500,500)->save($mediumImagePath);
                        Image::make($image_tmp)->resize(250,250)->save($smallImagePath);

                        $product->product_image = $imageName;
                    }
                }else if(!empty($data['current_image'])){
                    $imageName = $data['current_image'];
                }else{
                    $imageName = "";
                }

                $rules =[
                    'category_id' => 'required',
                    'product_name' => 'required',
                    'product_image' => 'required',
                    'product_price' => "required|numeric",
                ];

                $customMessages = [
                    'product_name.required' => "Veuillez saisir le nom du produit",
                    'product_image.required' => "Veuillez insérer une image du produit en question",
                    'product_price.required' => "Veuillez saisir le prix du produit,",
                    'product_price.numeric' => "Veuillez saisir un prix valide (exemple: 10000)"
                ];

                $this->validate($request,$rules,$customMessages);

                $product->product_name = $data['product_name'];
                $product->product_code = $data['product_code'];
                $product->product_color = $data['product_color'];
                $product->product_price = $data['product_price'];
                $product->product_discount = $data['product_discount'];
                $product->product_weight = $data['product_weight'];
                $product->description = $data['description'];
                $product->meta_title = $data['meta_title'];
                $product->meta_description = $data['meta_description'];
                $product->meta_keywords = $data['meta_keywords'];
                if(!empty($data['is_featured'])){
                    $product->is_featured = $data['is_featured'];
                }else{
                    $product->is_featured = "no";
                }
                $product->status = 1;
                $product->save();

                return redirect('admin/products')->with('success_message',$message);
            }



            $categories = Section::with('categories')->get()->toArray();

            $brands = Brand::where('status',1)->get()->toArray();

        return view('admin.products.add_edit_product')->with(compact('title','categories','brands', 'product'));
    }

    public function deleteProductImage($id){
        $productImage = Product::select('product_image')->where('id',$id)->first();

        $small_image_path = 'front/images/product_images/small/';
        $medium_image_path = 'front/images/product_images/medium/';
        $large_image_path = 'front/images/product_images/large/';

        if(file_exists($small_image_path.$productImage->product_image)){
            unlink($small_image_path.$productImage->product_image);
        }

        if(file_exists($medium_image_path.$productImage->product_image)){
            unlink($medium_image_path.$productImage->product_image);
        }

        if(file_exists($large_image_path.$productImage->product_image)){
            unlink($large_image_path.$productImage->product_image);
        }

        Product::where('id',$id)->update(['product_image'=>'']);

        $message="L'image a été supprimée avec succès";
        return redirect()->back()->with('success_message',$message);
    }

    public function addAttributes(Request $request, $id){
        $product = Product::find($id);

        if($request->isMethod('post')){
            $data = $request->all();
            echo "<pre>"; print_r($data); die;
        }

        return view('admin.attributes.add_edit_attributes')->with(compact('product'));
    }
}
