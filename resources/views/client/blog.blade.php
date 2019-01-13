    @extends('client.layouts.master')
    @section('content')

        <div class="header_title_blue">
            <div class="inner_titl">
                <p class="text_title">Blogul MadreamsRent</p>
            </div>
        </div>

        <div class="content_w_title">
            <div class="container">
                <div class="row">
                    @foreach($blogs as $blog)
                    <div class="col-md-6">
                        <a href="/clients/blog/{{$blog->id}}">
                            <div class="blog_post">
                                <img src="{{asset("storage/pages_image/$blog->image")}}" class="img_blog">
                                <div class="right_part_blg">
                                    <p class="date_bl">{{\Carbon\Carbon::parse($blog->created_at)->format('d-m-Y')}}</p>
                                    <p class="blog_title">{{$blog->name}}</p>
                                    <p class="blog_text">
                                     {{str_limit($blog->content, 2000, '...')}}
                                    </p>
                                    <p class="all_blog">Citeste tot articolul...</p>
                                </div>
                            </div>
                        </a>
                    </div>
                        @endforeach

                </div>
            </div>
        </div>

    @endsection