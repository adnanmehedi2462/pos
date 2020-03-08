<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use App\customer;
use Redirect;
use App\supplier;

class suppliercontroller extends Controller
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
   // /////////////////////////////////////////////////////////////////{- | -}

public function add_supplier(){

	return view('add_supplier');
}

 public function insert_supplier(Request $request)
    {
        $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|unique:suppliers|max:255',
        'phone' => 'required|unique:suppliers|max:255',
        'address' => 'required',
        'photo' => 'required',
        'city' => 'required',
        ]);

    	$data=array();
    	$data['name']=$request->name;
    	$data['email']=$request->email;
    	$data['phone']=$request->phone;
    	$data['address']=$request->address;
    	$data['shop']=$request->shop;
    	$data['accountholder']=$request->accountholder;
    	$data['accountnumber']=$request->accountnumber;
    	$data['bankname']=$request->bankname;
    	$data['branchname']=$request->branchname;
    	$data['city']=$request->city;
    	$data['type']=$request->type;

        $image=$request->file('photo');
        if ($image) {
            $image_name= str_random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/supplier/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['photo']=$image_url;
                $customer=DB::table('suppliers')
                         ->insert($data);
              if ($customer) {
                 $notification=array(
                 'messege'=>'Successfully Supplier Inserted ',
                 'alert-type'=>'success'
                  );
                return Redirect()->route('all_supplier')->with($notification);                      
             }else{
              $notification=array(
                 'messege'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             }      
                
            }else{

              return Redirect()->back();
                
            }
        }else{
              return Redirect()->back();
        }
    	
    	
    }
  public function all_supplier()
    {
    	$supplier=supplier::all();
    	return view('all_supplier', compact('supplier'));
    }

    public function view_supplier($id)
    {
      $supplier=supplier::findorfail($id);
      return view('view_supplier', compact('supplier'));
    }
    // delete supplier/////////////////////////////////////////////////////////
     public function delete_supplier($id)
    {
       $delete=supplier::findorfail($id);
         $photo=$delete->photo;
         unlink($photo);
         $dltuser=supplier::findorfail($id)->delete();
                
         if ($dltuser) {
                 $notification=array(
                 'messege'=>'Successfully Supplier Deleted ',
                 'alert-type'=>'success'
                  );
                return Redirect()->route('all_supplier')->with($notification);                      
             }else{
              $notification=array(
                 'messege'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             }               

    }
      public function edit_supplier($id)
    {
        $sup=supplier::findorfail($id);
        return view('edit_supplier', compact('sup'));
    }
     public function update_supplier(Request $request, $id)
    {
        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['shop']=$request->shop;
        $data['accountholder']=$request->accountholder;
        $data['accountnumber']=$request->accountnumber;
        $data['bankname']=$request->bankname;
        $data['branchname']=$request->branchname;
        $data['city']=$request->city;
        $data['type']=$request->type;
        $image=$request->photo;

      if ($image) {
       $image_name=str_random(20);
       $ext=strtolower($image->getClientOriginalExtension());
       $image_full_name=$image_name.'.'.$ext;
       $upload_path='public/supplier/';
       $image_url=$upload_path.$image_full_name;
       $success=$image->move($upload_path,$image_full_name);
       if ($success) {
          $data['photo']=$image_url;
             $img=DB::table('suppliers')->where('id',$id)->first();
             $image_path = $img->photo;
             $done=unlink($image_path);
          $user=DB::table('suppliers')->where('id',$id)->update($data); 
         if ($user) {
                $notification=array(
                'messege'=>'Supplier Update Successfully',
                'alert-type'=>'success'
                 );
               return Redirect()->route('all_supplier')->with($notification);                      
            }else{
              return Redirect()->back();
             } 
          }
      }else{
        $oldphoto=$request->old_photo;
         if ($oldphoto) {
          $data['photo']=$oldphoto;  
          $user=DB::table('suppliers')->where('id',$id)->update($data); 
         if ($user) {
                $notification=array(
                'messege'=>'Supplier Update Successfully',
                'alert-type'=>'success'
                 );
               return Redirect()->route('all_supplier')->with($notification);                      
            }else{
              return Redirect()->back();
             } 
          }
       }
    }



}
