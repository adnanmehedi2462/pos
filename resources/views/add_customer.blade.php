@extends('layouts.app')

@section('content')
<div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Welcome !</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="#">Moltran</a></li>
                                    <li class="active">Dashboard</li>
                                </ol>
                            </div>
                        </div>

        <!-- Start Widget -->
        <div class="row">
    <!-- Basic example --><div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h3 class="panel-title"> Add Customer</h3></div>
                                                                          
                                      @if ($errors->any())
                                          <div class="alert alert-danger">
                                              <ul>
                                                  @foreach ($errors->all() as $error)
                                                      <li>{{ $error }}</li>
                                                  @endforeach
                                              </ul>
                                          </div>
                                      @endif

                                    <div class="panel-body">
                                        <form role="form" action="{{url('/insert_customer')}}" method="post" enctype="multipart/form-data">
                                        	@csrf
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" class="form-control" id="" name="name" placeholder="Enter  name" required>
                                            </div>
                                             <div class="form-group">
                                                <label for="">Email address</label>
                                                <input type="email" class="form-control" id="" name="email" placeholder="Enter email">
                                            </div>
                                             <div class="form-group">
                                                <label for=""> Address</label>
                                                <input type="text" class="form-control" id="" name="address" placeholder="Enter Address" required>
                                            </div>
                                             <div class="form-group">
                                                <label for="">City</label>
                                                <input type="text" class="form-control" name="city" id="" placeholder="Enter  city" required>
                                            </div>
                                             <div class="form-group">
                                                <label for="">Shop name</label>
                                                <input type="text" name="shopname" class="form-control" id="" placeholder="Enter  shopname">
                                            </div>
                                             <div class="form-group">
                                                <label for="">Phone</label>
                                                <input type="text" class="form-control" name="phone" id="" placeholder="Enter number" required>
                                            </div>
                                             
                                             <div class="form-group">
                                                <label for="">Account holder</label>
                                                <input type="text" class="form-control" name="account_holder" id="" placeholder="Enter account holder" >
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Account number</label>
                                                <input type="text" class="form-control" name="account_number" id="" placeholder="Account number" >
                                            </div>
                                             <div class="form-group">
                                                <label for="exampleInputPassword1">Bank name </label>
                                                <input type="text" class="form-control" name="bank_name" id="" placeholder="Bank name" >
                                            </div>
                                             <div class="form-group">
                                                <label for="exampleInputPassword1">Bank branch</label>
                                                <input type="text" class="form-control" name="bank_branch" id="" placeholder="Bank branch " >
                                            </div>
			                                 <div class="form-group">
			                                	<img id="image" src="#" />
			                                    <label for="exampleInputPassword11">Photo</label>
			                                    <input type="file"  name="photo" accept="image/*"  required onchange="readURL(this);" >
			                                </div>
                                            <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
                                        </form>
                                    </div><!-- panel-body -->
                                </div> <!-- panel -->
                            </div> <!-- col-->
        </div> 
        <!-- End row-->

        </div> <!-- end row -->

    </div> <!-- container -->
               
</div> <!-- content -->
<script type="text/javascript">
	function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#image')
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>
@endsection