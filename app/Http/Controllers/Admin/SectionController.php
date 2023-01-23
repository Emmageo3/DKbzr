<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use Session;

class SectionController extends Controller
{
    public function sections(){
        Session::put('page','sections');
        $sections = Section::get()->toArray();
        return view('admin.sections.sections')->with(compact('sections'));
    }

    public function updateSectionStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Section::where('id', $data['section_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'section_id'=>$data['section_id']]);
        }
    }

    public function deleteSection($id){
        Section::where('id', $id)->delete();
        $message = "La catégorie a été supprimée avec succès !";
        return redirect()->back()->with('success_message', $message);
    }

    public function addEditSection(Request $request, $id=null){
        Session::put('page','sections');
        if($id==""){
            $title = "Ajouter une catégorie";
            $section = new Section;
            $message = "La catégorie a été ajoutée avec succès !";
        }else{
            $title = "Modifier la catégorie";
            $section = Section::find($id);
            $message = "La catégorie a été modifiée avec succès !";
        }

        if($request->isMethod('post')){
            $data = $request->all();

            $rules =[
                'section_name' => 'required|regex:/^[\pL\s\-]+$/u'
            ];

            $customMessages = [
                'section_name.required' => "Veuillez ajouter une catégorie",
                'section_name.regex' => "Veuillez ajouter un nom valide"
            ];

            $this->validate($request,$rules,$customMessages);

            $section->name = $data['section_name'];
            $section->status = 1;
            $section->save();

            return redirect('admin/sections')->with('success_message', $message);
        }

        return view('admin.sections.add_edit_section')->with(compact('title','section'));

    }
}
