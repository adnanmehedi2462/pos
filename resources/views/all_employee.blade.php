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
      <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Datatable</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                       
                                                            <th>Phone</th>
                                                            <th>Address</th>
                                                     
                                                            <th>Image</th>
                                                            <th>Salary</th>
                                                            <th>action</th>


                                                        </tr>
                                                    </thead>

                                             
                                                    <tbody>
                                                    @foreach($employees as $row)
                                                        <tr>
                                                            <td>{{$row->name}}</td>
                                                            <td>{{$row->address}}</td>
                                                            <td>{{$row->phone}}</td>
                                                            <td>{{$row->salary}}</td>
                                                            <td><img src="{{$row->photo}}" style="height: 80px;width: 80px; border-radius: 80px;"></td>
                                                            <td>
                                                                <a href="{{URL::to('edit_info/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                                                                 <a href="{{URL::to('view_employee/'.$row->id)}}" class="btn btn-sm btn-primary">view</a>
                                                                <a href="{{URL::to('delete_employee/'.$row->id)}}" id="delete" class="btn btn-sm btn-danger">Delete</a>

                                                            </td>
                                                            
                                                            
                                                            
                                                            
                                                            
                                                           
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        </div> 
        <!-- End row-->



@endsection