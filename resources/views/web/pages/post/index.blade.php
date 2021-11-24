@php($title_page      = 'المدونة')
@php($title_seo       = 'المدونة')

@extends('web.master')

@section('breadcrumb')
    <li><a href="{{url('/')}}">الرئيسية</a></li>
    <li>المدونة</li>
@endsection
@section('content')
    <div class="container-indent">
        <div class="container">
            <h1 class="pt-title-subpages noborder">المدونة</h1>
            <div class="pt-blog-masonry">
                <div class="pt-filter-nav">
                    <div class="button active" data-filter="*">الكل</div>
                    @foreach($catsBlog as $cat)
                        <div class="button" data-filter=".{{$cat->slug}}">{{$cat->name}}</div>
                    @endforeach
                </div>
                <div class="pt-blog-init pt-grid-col-3 pt-listing-col pt-add-item pt-show">
                    @foreach($posts as $post)

                        @php($cat = $catsBlog->find($post->catBlog_id))

                        <div class="element-item {{$cat->slug}}">
                            <div class="pt-post">
                                <div class="pt-post-img">
                                    <a href="{{route("web.post.show" , $post->slug)}}">
                                        <img src="{{asset("assets/web/images/posts/min/medium_$post->img")}}" alt="{{$post->title}}">
                                    </a>
                                </div>
                                <div class="pt-post-content">
                                    <h2 class="pt-title"><a href="{{route("web.post.show" , $post->slug)}}">{{$post->title}}</a></h2>
                                    <div class="pt-description">{{$post->shortDescription}}</div>
                                    <div class="pt-meta text-uppercase">
                                        <div class="pt-autor d-inline-block">
                                             التاريخ : <span>{{$post->created_at->format('Y-m-d')}}</span>
                                        </div>
                                        <div class="pt-comments d-inline-block">
                                            <a href="{{route('web.post.cat' , $cat->slug)}}"><i class="pt-icon"></i>{{$cat->name}}</a>
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
