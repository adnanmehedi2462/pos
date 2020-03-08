<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use App\category;
use Redirect;


class categorycontroller extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ////////////////////////////////////////////////////////////////////////////////////
    // category controller here////////////////////////////////////////////////////////////////
public function add_category(){


  return view("add_category");


}

    public function insert_category(Request $request)
    {
      $data=array();
   $data['cat_name']=$request->cat_name;
   $cat=DB::table('categories')->insert($data);
       if ($cat) {
                 $notification=array(
                 'messege'=>'Successfully Category Inserted ',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification);                      
             }else{
              $notification=array(
                 'messege'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             } 
   

    }

public function all_category(){

$category=category::all();

  return view("all_category",compact('category'));
}
 public function delete_category($id){

    $delete_category=category::findorfail($id)->delete();
        if ($delete_category) {
                 $notification=array(
                 'messege'=>'Successfully Category Delete ',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification);                      
             }else{
              $notification=array(
                 'messege'=>'error ',
                 'alert-type'=>'error '
                  );
                 return Redirect()->back()->with($notification);
             } 

 }

public function edit_category($id){
	$edit_category=category::findorfail($id);
return view("edit_category",compact('edit_category'));



}


public function update_category(Request $request,$id){

$data=array();
$data['cat_name']=$request->cat_name;
$update_category=category::findorfail($id)->update($data);
  if ($update_category) {
                 $notification=array(
                 'messege'=>'Successfully Category Update ',
                 'alert-type'=>'success'
                  );
                return Redirect('all_category')->with($notification);                      
             }else{
              $notification=array(
                 'messege'=>'error ',
                 'alert-type'=>'error '
                  );
                 return Redirect()->back()->with($notification);
             } 





}
}
