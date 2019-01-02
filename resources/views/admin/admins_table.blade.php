@extends('admin.layouts.master')
@section('content')
    <section>
        <div class="jumbotron admins_parallax">
            <div class="dashboard_titles">
            <h1 class="admins_title">Admins</h1>
            </div>
        </div>
        @include('admin.parts.messages.success')
        @include('admin.parts.messages.error')
        @include('admin.parts.messages.custom_error')
        <div class="card">
            <div class="card-header">
                <div class="float-right ">
                    <button type="button" class="btn btn-primary btn-lg mr-2" data-toggle="modal" data-target="#addAdmin">
                        add Admin &nbsp; <i class="fas fa-user-plus"></i>
                    </button>
                </div>
                    <h4 class="admins_table_title mt-2"><u>Admins Table</u></h4>
            </div>
            <div class="card-body">
                <table class="data_table table table-bordered  table-responsive table-hover display">
                    <thead>
                    <tr class="bg-dark  text-white text-center">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody class="custom_table_admin">
                    @foreach($admins as $admin)
                    <tr>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->email}}</td>
                        <td>{{$admin->phone}}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#editAdmin-{{$admin->id}}">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                        <td><a href="/admin/admins/delete/{{$admin->id}}" class="btn btn-danger btn-lg" onclick=" return confirm('Are you sure you want to delete this Admin?')"><i class="fas fa-eraser"></i></a></td>

                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @include('admin.parts.modals.add.admin')
    @foreach($admins as $admin)
        @include('admin.parts.modals.edit.admin')
    @endforeach
    @endsection