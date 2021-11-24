<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\CatBlog;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function blog(){



        $posts = Post::select(['id' , 'title' , 'slug','shortDescription' ,'img' , 'catBlog_id' , 'created_at'])
            ->latest()
            ->paginate(9);


        $catsBlog = CatBlog::whereHas('posts')
            ->whereIn('id' , $posts->getCollection()->map->catBlog_id->all())
            ->select(['id' , 'name' , 'slug'])
            ->get();

        return view('web.pages.post.index')->with([

            'catsBlog' => $catsBlog,
            'posts' => $posts,
        ]);
    }


    public function showPost($slug){


        $post = Post::with('cat')
            ->where('slug' , $slug)
            ->firstOrFail();

        return view('web.pages.post.show' , compact('post'));
    }

    public function cat($slug){

        $catBlog = CatBlog::where('slug' , $slug)->firstOrFail();


        $posts = Post::where('catBlog_id' , $catBlog->id)
            ->select(['id' , 'title' , 'slug','shortDescription' ,'img' , 'catBlog_id' , 'created_at'])
            ->latest()
            ->paginate(9);

        return view('web.pages.post.cat' ,compact('posts' , 'catBlog'));
    }

    public function tag($tag){

        $posts = Post::where('tags' , 'like' , "%$tag%")
            ->select(['id' , 'title' , 'slug','shortDescription' ,'img' , 'catBlog_id' , 'created_at'])
            ->latest()
            ->paginate(9);

        if($posts->count() == 0){
            abort(404);
        };

        return view('web.pages.post.tag' , compact('posts' , 'tag'));
    }


    public function visits(){

        Post::where('id' , \request('post_id'))->update([

            'visits' => \DB::raw('visits + 1')
        ]);

        session()->push('post_id' , \request('post_id'));
    }
}
