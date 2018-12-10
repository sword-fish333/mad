@extends('admin.layouts.master')

@section('content')
    <div class="card col-md-8 offset-2" style="margin-top: 80px;">
        <div class="card-body">
            <h4 class="card-title custom_title"><u>Register Admin</u> <i class="fas fa-registered"></i></h4>
                @include('admin.parts.messages.success')
                @include('admin.parts.messages.error')

            <form class="form-material m-t-40" action="{{route('adminRegister')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" id="name" name="name" placeholder="Name" value="{{old('name')}}" class="form-control" >
                </div>
                <div class="form-group">
                    <input type="email" id="email" name="email" class="form-control" value="{{old('email')}}" placeholder="Email">
                </div>

                <div class="form-group">
                    <input type="number" min="0" id="phone" name="phone" class="form-control" value="{{old('phone')}}" placeholder="Phone">
                </div>

                <div class="form-group">
                    <input type="password" placeholder="Password" name="password" class="form-control" >
                </div>
                <div class="form-group">

                    <input type="password" placeholder="Confirm Password" class="form-control" name="confirm_password">

                </div>

                <div class="form-group">
                    <button type="submit"  class="btn btn-block btn-primary btn-lg">Save <i class="fas fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection