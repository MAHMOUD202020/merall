@php($title_page      = $post->title)
@php($title_seo       = $post->seo_title)
@php($description_seo = $post->meta_description)

@extends('web.master')

@section('breadcrumb')
    <li><a href="{{url('/')}}">الرئيسية</a></li>
    <li><a href="{{route('web.blog')}}">المدونة</a></li>
    <li>{{$post->title}}</li>
@endsection
@section('content')
    <div class="container-indent">
        <div class="container container-fluid-custom-mobile-padding">
            <div class="pt-post-single">
                <h1 class="pt-title">{{$post->title}}</h1>
                <div class="pt-autor" style="direction: rtl">
                    التصنيف:  <a href="{{route('web.post.cat' , $post->cat->slug)}}"><span>{{$post->cat->name}}</span></a> -
                    بتاريخ:  <span>{{$post->created_at->format('Y-m-d')}}</span>
                </div>
                <div class="pt-post-content">
                    <div class="row">
                        <div class="col-12 text-center">
                            <img src="{{asset("assets/web/images/posts/min/$post->img")}}" alt="">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-10 col-xl-8">
                            <h2 class="pt-title">{{$post->subtitle}}</h2>
                            {!! $post->description !!}
                        </div>
                    </div>
                    @if ($post->tags)
                        <div class="row justify-content-center">
                        <div class="col-12 col-lg-10 col-xl-8">
                            <div class="post-meta" style="direction: rtl;text-align: right">
                                <span class="item">الوسوم:</span>
                                <span>
                                    @foreach(explode(',' , $post->tags) as $tag)
                                        <h3>
                                            <a class="active" href="{{route('web.post.tag' , $tag)}}" title="Show articles tagged Vintage">{{$tag}}</a>
                                        </h3>
                                    @endforeach
								</span>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(function (){
            @php(!session('post_id') ? session()->push('post_id' , 0) : '')
            @if (!in_array($post->id , session('post_id')))
                $.ajax({
                    method:'post',
                    url:'{{route('web.post.visits')}}',
                    data:{'post_id':'{{$post->id}}'}
                })
            @endif

        })
    </script>
@endsection
