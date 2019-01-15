    @extends('client.layouts.master')
    @section('content')

        <div class="header_title_blue">
            <div class="inner_titl">
                <p class="text_title"> MadreamsRent Blog</p>
            </div>
        </div>

        <div class="content_w_title">
            <div class="container">
                <div class="row">
                    @include('admin.parts.messages.success')
                    @include('admin.parts.messages.error')
                    @foreach($articles as $article)
                    <div class="col-md-6">
                        <a href="/clients/blog/{{$article->id}}">
                            <div class="blog_post" >
                                <img src="{{asset("storage/pages_image/$article->image")}}" class="img_blog">
                                <div class="right_part_blg" style="padding-left: 25px;">
                                    <p class="date_bl">{{\Carbon\Carbon::parse($article->created_at)->format('d-m-Y')}}</p>
                                    <p class="blog_title">{{$article->name}}</p>
                                    <p class="blog_text">
                                     {{str_limit($article->content, 2000, '...')}}
                                    </p>
                                    <p class="all_blog">Citeste tot articolul...</p>
                                </div>
                            </div>
                        </a>
                    </div>
                        @endforeach
                </div>
                <div class="row">
                    {{ $articles->links('client.layouts.parts.pagination') }}
                </div>
            </div>
        </div>
    @endsection