    @extends('client.layouts.master')
    @section('content')
        <div class="header_title_blue">
            <div class="inner_titl">
                <p class="text_title">MadreamRent Blog</p>
            </div>
        </div>
        <div class="content_w_title">
            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <p class="blog_title">{{$blog->name}}</p>
                        <p class="date_bl">{{\Carbon\Carbon::parse($blog->created_at)->format('d-m-Y')}}</p>
                        <hr class="hr_header">
                        <p class="blog_text">
                            {{wordwrap($blog->content,2000,'<br><br>')}}

                        </p>
                        <img src="{{asset("storage/pages_image/$blog->image")}}" class="img_blog_post">

                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>


    @endsection