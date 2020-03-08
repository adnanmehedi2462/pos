<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use App\employee;
use Redirect;
class employeecontroller extends Controller
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


// employeep routes are here!!!!!!!!!'''''''''''''
public function add_employee(){

 return view("add_employee");



}


// add_employee/////////////////////////////////
public function insert_employee(Request $request){

     $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|unique:employees|max:255',
        'address' => 'required',
        'city' => 'required',
        'experience' => 'required',
        'phone' => 'required|max:13',
       'photo'=> 'required',
        'salary' => 'required',
        'vacation' => 'required',


    ]);

       // if($validator->fails()){
       //      return redirect()->back()->withErrors($validator)->withInput();
       //  }
        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['address']=$request->address;
        $data['city']=$request->city;
        $data['experience']=$request->experience;
        $data['phone']=$request->phone;
        $data['salary']=$request->salary;
        $data['vacation']=$request->vacation;
         $image=$request->file('photo');

        if ($image) {
            $image_name= str_random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/employee/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['photo']=$image_url;
                $employee=DB::table('employees')
                         ->insert($data);
              if ($employee) {
                 $notification=array(
                 'messege'=>'Successfully Employee Inserted ',
                 'alert-type'=>'success'
                  );
                return Redirect()->route('add_employee')->with($notification);                      
             }else{
              $notification=array(
                'messege'=>'error to add',
                'alert-type'=>'error'
                  );
             return Redirect()->route('add_employee')->with($notification);
             }      
                
            }else{

              return Redirect()->back();
                
            }
        }else{
              return Redirect()->back();
        }

}

// all employeee///////////////////////////////////////


public function all_employee(){

$employees=employee::all();
return view("all_employee",compact('employees'));




}

// view employee

public function view_employee($id){

   // $views=DB::table('employees')
   // ->where("id",$id)
   // ->first()
    $views=employee::findorfail($id);
   return view("view_employee",compact('views'));
}

// delete employee

public function delete_employee($id){

    $delete=employee::findorfail($id);
    $photo=$delete->photo;
    unlink($photo);
      $all=employee::findorfail($id)->delete();
       if ($delete) {
                 $notification=array(
                 'messege'=>'Successfully Employee Delete ',
                 'alert-type'=>'success'
                  );
                return Redirect()->route('all_employee')->with($notification);                      
             }else{
              $notification=array(
                 'messege'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             }             
    return Redirect::to('/all_employee');
}
// edit info///////////////////////////////////////////////////////////
public function edit_info($id){
  $edit=employee::findorfail($id);
return view('edit_employee',compact('edit'));
}

// update employee///////////////////////////////////////////////////////
public function update_employee(Request $request,$id){

$validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|max:255',
        'address' => 'required',
        'city' => 'required',
        'experience' => 'required',
        'phone' => 'required|max:13',
        'salary' => 'required',
        'vacation' => 'required',


    ]);
  $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['address']=$request->address;
        $data['city']=$request->city;
        $data['experience']=$request->experience;
        $data['phone']=$request->phone;
        $data['salary']=$request->salary;
        $data['vacation']=$request->vacation;
          $image=$request->photo;

      if ($image) {
       $image_name=str_random(20);
       $ext=strtolower($image->getClientOriginalExtension());
       $image_full_name=$image_name.'.'.$ext;
       $upload_path='public/employee/';
       $image_url=$upload_path.$image_full_name;
       $success=$image->move($upload_path,$image_full_name);
       if ($success) {
          $data['photo']=$image_url;
             $img=DB::table('employees')->where('id',$id)->first();
             $image_path = $img->photo;
             $done=unlink($image_path);
          $user=DB::table('employees')->where('id',$id)->update($data); 
         if ($user) {
                $notification=array(
                'messege'=>'Employee Update Successfully',
                'alert-type'=>'success'
                 );
               return Redirect()->route('all_employee')->with($notification);                      
            }else{
              return Redirect()->back();
             } 
          }
      }else{
         $oldphoto=$request->old_photo;
         if ($oldphoto) {
          $data['photo']=$oldphoto;  
          $user=DB::table('employees')->where('id',$id)->update($data); 
         if ($user) {
                $notification=array(
                'messege'=>'Employee Update Successfully',
                'alert-type'=>'success'
                 );
               return Redirect()->route('all_employee')->with($notification);                      
            }else{
              return Redirect()->back();
             } 
          }
       }
    }
}

