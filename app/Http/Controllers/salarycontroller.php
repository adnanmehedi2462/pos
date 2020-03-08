<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use App\customer;
use Redirect;


class salarycontroller extends Controller
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

  public function add_salary(){

      return view("add_advancedsalary");


  }


public function insert_advancedsalary(Request $request){
     $month=$request->month;
     $emp_id=$request->emp_id;

  $advanced=DB::table('salaries')
           ->where("month",$month)
           ->where("emp_id",$emp_id)
           ->first();
           if ($advanced === NULL) {
             $data=array();
       $data['emp_id']=$request->emp_id;
       $data['month']=$request->month;
       $data['advanced_salary']=$request->advanced_salary;
       $data['year']=$request->year;
       $advanced=DB::table('salaries')->insert($data);

    if ($advanced) {
                 $notification=array(
                 'messege'=>'Successfully salarie Inserted ',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification);                      
             }else{
              $notification=array(
                'messege'=>'error to add',
                'alert-type'=>'error'
                  );
             return Redirect()->back()->with($notification);
             } 
           }else{

              $notification=array(
                'messege'=>'Opps!!! advanced allready paid in this month.!!',
                'alert-type'=>'error'
                  );
                  return Redirect()->back()->with($notification);




           }

}

 public function all_salary(){

      $salary=DB::table("salaries")
              ->join('employees','salaries.emp_id','employees.id')
              ->select('salaries.*','employees.name','employees.photo','employees.salary')
              ->orderBy('id',"DESC")
              ->get();
              return view("all_advancedsalary",compact('salary'));


 }
public function pay_salary(){


    $employee=DB::table('employees')->get();
    return view("pay_salary",compact('employee'));


}





}
