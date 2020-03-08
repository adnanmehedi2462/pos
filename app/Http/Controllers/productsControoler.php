<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Illuminate\Validation\Validator;
use Redirect;
use App\product;
class productsControoler extends Controller
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
    // //////////////////////////////////////////////////////////////////////////////////////////

    public function add_product(){
     return view("add_product");
    }
public function insert_product(Request $request){
	$validatedData = $request->validate([
        'product_code' => 'required|unique:products|max:255',


    ]);
       $data=array();
    	$data['product_name']=$request->product_name;
    	$data['product_code']=$request->product_code;
    	$data['cat_id']=$request->cat_id;
    	$data['sup_id']=$request->sup_id;
    	$data['product_garage']=$request->product_garage;
    	$data['product_route']=$request->product_route;
    	$data['buy_date']=$request->buy_date;
    	$data['expire_date']=$request->expire_date;
    	$data['buying_price']=$request->buying_price;
    	$data['selling_price']=$request->selling_price;
    	 $image=$request->file('product_image');
        if ($image) {
            $image_name= str_random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/Products/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['product_image']=$image_url;
                $product=DB::table('products')
                         ->insert($data);
              if ($product) {
                 $notification=array(
                 'messege'=>'Successfully Product Inserted ',
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
                
            }else{

              return Redirect()->back();
                
            }
        }else{
              return Redirect()->back();
        }
}


public function all_product(){
  $product=product::all();
  return view("all_product",compact('product'));


}

public function delete_product($id){
    $delete=product::findorfail($id);
     $photo=$delete->product_image;
     unlink($photo);
     $all=product::findorfail($id)->delete();

 if ($delete) {
                 $notification=array(
                 'messege'=>'Successfully Product Delete ',
                 'alert-type'=>'success'
                  );
                return Redirect()->route('all_product')->with($notification);                      
             }else{
              $notification=array(
                 'messege'=>'error ',
                 'alert-type'=>'success'
                  );
                 return Redirect()->back()->with($notification);
             }         
}

public function view_product($id){
    $prod=DB::table('products')
             ->join('categories','products.cat_id','categories.id')
             ->join('suppliers','products.sup_id','suppliers.id')
             ->select('categories.cat_name','products.*','suppliers.name')
             ->where('products.id',$id)
             ->first();
        return view('view_product', compact('prod')); 



}

 public function edit_product($id){

   $prods=product::findorfail($id);
   return view('edit_product',compact('prods'));




 }
 public function update_product(Request $request,$id)
    {
       $data=array();
        $data['product_name']=$request->product_name;
        $data['product_code']=$request->product_code;
        $data['cat_id']=$request->cat_id;
        $data['sup_id']=$request->sup_id;
        $data['product_garage']=$request->product_garage;
        $data['product_route']=$request->product_route;
        $data['buy_date']=$request->buy_date;
        $data['expire_date']=$request->expire_date;
        $data['buying_price']=$request->buying_price;
        $data['selling_price']=$request->selling_price;

        $image=$request->file('product_image');

      if ($image) {
       $image_name=str_random(20);
       $ext=strtolower($image->getClientOriginalExtension());
       $image_full_name=$image_name.'.'.$ext;
       $upload_path='public/Products/';
       $image_url=$upload_path.$image_full_name;
       $success=$image->move($upload_path,$image_full_name);
       if ($success) {
          $data['product_image']=$image_url;
             $img=DB::table('products')->where('id',$id)->first();
             $image_path = $img->product_image;
             $done=unlink($image_path);
          $product=DB::table('products')->where('id',$id)->update($data); 
         if ($product) {
                $notification=array(
                'messege'=>'Product Update Successfully',
                'alert-type'=>'success'
                 );
               return Redirect("all_product")->with($notification);                      
            }else{
              return Redirect()->back();
             } 
          }
      }else{
        $oldphoto=$request->old_photo;
         if ($oldphoto) {
          $data['product_image']=$oldphoto;  
          $user=DB::table('products')->where('id',$id)->update($data); 
         if ($user) {
                $notification=array(
                'messege'=>'Product Update Successfully',
                'alert-type'=>'success'
                 );
               return Redirect("all_product")->with($notification);                      
            }else{
              return Redirect()->back();
             } 
          }
       }
    }



}
