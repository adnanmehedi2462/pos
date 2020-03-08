@extends('layouts.app')
@section('content')
<div class="content-page">
  <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title">Welcome !</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="#">Echobvel</a></li>
                        <li class="active">IT</li>
                    </ol>
                </div>
            </div>

            <!-- Start Widget -->
            <div class="row">
               <!-- Basic example -->
               <div class="col-md-2"></div>
                <div class="col-md-8 ">
                    <div class="panel panel-info">
                        <div class="panel-heading"><h3 class="panel-title text-white">Update category </h3>

                        </div>
                        <a href="{{ route('all_category') }}" class="pull-right btn btn-danger btn-sm" style="margin-top: -40px;">All category</a>
                    
                        <div class="panel-body">
                            <form role="form" action="{{ url('/update_category/'.$edit_category->id) }}" method="post">
                                @csrf
                          
                                <div class="form-group">
                                    <label for="exampleInputPassword12">Category</label>
                                    <input type="text" name="cat_name" placeholder="category name" class="form-control" value="{{$edit_category->cat_name}}">                                </div>
                            
                                <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                            </form>
                        </div><!-- panel-body -->
                    </div> <!-- panel -->
                </div> <!-- col-->

            </div>
        </div> <!-- container -->
                   
    </div> <!-- content -->
</div>


@endsection