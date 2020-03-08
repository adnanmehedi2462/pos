
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
                                    <div class="panel-heading"><h3 class="panel-title"> View Customer</h3></div>
                                    <div class="panel-body">
                                    
                                            <div class="form-group">
                                                <label for="">Name</label>
                                               <p>{{$views->name}}</p>
                                            </div>
                                             <div class="form-group">
                                                <label for="">Email address</label>
                                                <p>{{$views->email}}</p>
                                            </div>
                                             <div class="form-group">
                                                <label for=""> Address</label>
                                                 <p>{{$views->address}}</p>
                                            </div>
                                             <div class="form-group">
                                                <label for="">City</label>
                                                 <p>{{$views->city}}</p>
                                            </div>
                                             <div class="form-group">
                                                <label for="">Account holder</label>
                                                  <p>{{$views->account_holder}}</p>
                                            </div>
                                             <div class="form-group">
                                                <label for="">Phone</label>
                                                 <p>{{$views->phone}}</p>
                                            </div>
                                             
                                             <div class="form-group">
                                                <label for="">Account number</label>
                                                   <p>{{$views->account_number}}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Bank name</label>
                                                 <p>{{$views->bank_name}}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Bank branch</label>
                                                 <p>{{$views->bank_branch}}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Shop name</label>
                                                 <p>{{$views->shopname}}</p>
                                            </div>

			                                 <div class="form-group">
			                              
			                                    <label for="exampleInputPassword11">Photo</label>
			                                   <p><img src="{{URL::to($views->photo)}}" style="height: 100px;width: 100px;">
			                                </div>
                                      
                                     
                                    </div><!-- panel-body -->
                                </div> <!-- panel -->
                            </div> <!-- col-->
        </div> 
        <!-- End row-->

        </div> <!-- end row -->

    </div> <!-- container -->
               
</div> <!-- content -->

@endsection