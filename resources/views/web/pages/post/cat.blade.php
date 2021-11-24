@php($title_page      = 'المدونة')
@php($title_seo       = 'المدونة')

@extends('web.master')

@section('breadcrumb')
    <li><a href="{{url('/')}}">الرئيسية</a></li>
    <li><a href="{{route('web.blog')}}">المدونة</a></li>
    <li>{{$catBlog->name}}</li>
@endsection
@section('content')
    <div class="container-indent">
        <div class="container">
            <h1 class="pt-title-subpages noborder" style="direction: rtl">المدونة > التصنيفات > {{$catBlog->name}}</h1>
            <div class="pt-blog-masonry">
                <div class="pt-blog-init pt-grid-col-3 pt-listing-col pt-add-item pt-show">
                    @foreach($posts as $post)


                        <div class="element-item ">
                            <div class="pt-post">
                                <div class="pt-post-img">
                                    <a href="{{route("web.post.show" , $post->slug)}}">
                                        <img src="{{asset("assets/web/images/posts/min/$post->img")}}" alt="{{$post->title}}">
                                    </a>
                                </div>
                                <div class="pt-post-content">
                                    <h2 class="pt-title"><a href="{{route("web.post.show" , $post->slug)}}">{{$post->title}}</a></h2>
                                    <div class="pt-description">{{$post->shortDescription}}</div>
                                    <div class="pt-meta text-uppercase">
                                        <div class="pt-autor d-inline-block">
                                            التاريخ : <span>{{$post->created_at->format('Y-m-d')}}</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="pt-pagination pt-pagination-center">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
@endsection
