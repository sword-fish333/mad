@extends('admin.layouts.master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <style>

        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            margin-left: 100px;
            margin-top: 20px;
            height: 300px;
            width: 500px;
        }
        .edit_map{
            margin-left: 100px;
            margin-top: 20px;
            height: 300px;
            width: 500px;
        }
    </style>
    <section>
        <div class="jumbotron pages_parallax">
            <div class="dashboard_titles">
                <h1 class="apartments_title">MadreamRent Pages</h1>
            </div>
        </div>
        @include('admin.parts.messages.success')
        @include('admin.parts.messages.error')
        @include('admin.parts.messages.custom_error')
        <div class="card">
            <div class="card-header">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addStaticPage">
                    add Page &nbsp;<i class="fas fa-plus"></i>
                </button>
                <h4 class="apartments_table_title"><u>Pages Table</u>&nbsp;&nbsp;</h4>
            </div>
        </div>
        <table class=" data_table table table-hover  table-bordered" >
            <thead>
            <tr class="bg-dark custom_apartments_table_head  text-center"  >
                <th>#</th>
                <th>Title </th>
                <th>Content</th>
                <th>Image</th>
                <th>Url Rewrite</th>
                <th>Parent Theme</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody class="text-center">
            @php
                $increment=1
            @endphp
            @foreach($pages as $page)
                <tr>
                    <td>{{$increment}}</td>
                    <td>{{$page->name}}</td>
                    <td>{{$page->content}}</td>
                    <td>
                        @if($page->image)
                        <img src="{{asset("storage/pages_image/$page->image")}}" class="" style="width:120px !important; height: auto;">
                    @else
                            <p>there is no image available</p>
                        @endif
                    </td>
                    <td>
                        {{$page->url_rewrite}}
                    </td>
                    <td>

                        @php
                        $parent_page=\App\Blog::where('id' ,$page->parent_id)->first();
                        @endphp
                        @if($parent_page)
                       <strong>{{$parent_page->name}}</strong>
                            @else
                            <p class=" text-danger">This is the main theme</p>
                            @endif
                    </td>



                    <td><!-- Button trigger modal for edit apartment -->
                        <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#editPage{{$page->id}}">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                    <td><a href="/admin/pages/delete/{{$page->id}}" class="btn btn-danger btn-lg" onclick=" return confirm('Are you sure you want to delete this  Page?')"><i class="fas fa-eraser"></i></a></td>
                </tr>

                @php
                    $increment++;
                @endphp
            @endforeach
            </tbody>
        </table>


    </section>

    @foreach($pages as $page)
        @include('admin.parts.modals.edit.page')
    @endforeach
    @include('admin.parts.modals.add.page')


@endsection