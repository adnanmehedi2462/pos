<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use App\customer;
use Redirect;


class customercontroller extends Controller
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

   
public function add_customer(){

   return view('add_customer');



}


// add_employee/////////////////////////////////
public function insert_customer(Request $request){
       $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|unique:customers|max:255',
        'phone' => 'required|unique:customers|max:255',
        'address' => 'required',
        'photo' => 'required',
        'city' => 'required',
        ]);

     
        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['address']=$request->address;
        $data['city']=$request->city;
        $data['shopname']=$request->shopname;
        $data['phone']=$request->phone;
        $data['account_holder']=$request->account_holder;
        $data['account_number']=$request->account_number;
        $data['bank_branch']=$request->bank_branch;
        $data['bank_name']=$request->bank_name;

         $image=$request->file('photo');

        if ($image) {
            $image_name= str_random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/customer/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['photo']=$image_url;
                $customer=DB::table('customers')
                         ->insert($data);
              if ($customer) {
                 $notification=array(
                 'messege'=>'Successfully customer Inserted ',
                 'alert-type'=>'success'
                  );
                return Redirect()->route('add_customer')->with($notification);                      
             }else{
              $notification=array(
                'messege'=>'error to add',
                'alert-type'=>'error'
                  );
             return Redirect()->route('add_customer')->with($notification);
             }      
                
            }else{

              return Redirect()->back();
                
            }
        }else{
              return Redirect()->back();
        }

}
public function all_customer(){

$customers=customer::all();
return view("all_customer",compact('customers'));




}

public function delete_customer($id){

    $delete=customer::findorfail($id);
    $photo=$delete->photo;
    unlink($photo);
      $all=customer::findorfail($id)->delete();
       if ($delete) {
                 $notification=array(
                 'messege'=>'Successfully customer Delete ',
                 'alert-type'=>'success'
                  );
                return Redirect()->route('all_customer')->with($notification);                      
             }else{
              $notification=array(
                 'messege'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             }             
    return Redirect::to('/all_customer');
}

// view custome

public function view_customer($id){

   // $views=DB::table('employees')
   // ->where("id",$id)
   // ->first()
    $views=customer::findorfail($id);
   return view("view_customer",compact('views'));
}


public function edit_customer($id){

  $edit=customer::findorfail($id);
  return view('edit_customer',compact('edit'));


}
// update customer///////////////////////////////////////////////////////
public function update_customer(Request $request,$id){


     
        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['address']=$request->address;
        $data['city']=$request->city;
        $data['shopname']=$request->shopname;
        $data['phone']=$request->phone;
        $data['account_holder']=$request->account_holder;
        $data['account_number']=$request->account_number;
        $data['bank_branch']=$request->bank_branch;
        $data['bank_name']=$request->bank_name;
       $image=$request->file('photo');
      if ($image) {
       $image_name=str_random(20);
       $ext=strtolower($image->getClientOriginalExtension());
       $image_full_name=$image_name.'.'.$ext;
       $upload_path='public/customer/';
       $image_url=$upload_path.$image_full_name;
       $success=$image->move($upload_path,$image_full_name);
       if ($success) {
          $data['photo']=$image_url;
             $img=DB::table('customers')->where('id',$id)->first();
             $image_path = $img->photo;
             $done=unlink($image_path);
          $user=DB::table('customers')->where('id',$id)->update($data); 
         if ($user) {
                $notification=array(
                'messege'=>'customer Update Successfully',
                'alert-type'=>'success'
                 );
               return Redirect()->route('all_customer')->with($notification);                      
            }else{
              return Redirect()->back();
             } 
          }
      }else{
         $oldphoto=$request->old_photo;
         if ($oldphoto) {
          $data['photo']=$oldphoto;  
          $user=DB::table('customers')->where('id',$id)->update($data); 
         if ($user) {
                $notification=array(
                'messege'=>'customer Update Successfully',
                'alert-type'=>'success'
                 );
                 return Redirect()->route('all_customer')->with($notification);                      
            }else{
              return Redirect()->back();
             } 
          }
       }
    }
}
