<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\CatBlog;
use App\Models\Post;
use App\myDataTable\methodAction;
use App\myDataTable\uploadImag;
use Illuminate\Http\Request;

class PostController extends Controller
{

    use uploadImag;
    use methodAction;

    public $path_img = "assets/web/images/posts";



    public function index()
    {

        $catsBlog  = CatBlog::latest()->get(['name' , 'id']);

        return myDataTable_query(
            Post::class ,
            'admin.pages.post.index',
            false,
            [
                'columns' => ['id' , 'title' , 'slug' , 'img' , 'catBlog_id' ,'visits' , 'updated_at' , 'created_at'],
                'with-view' => ['cats' => $catsBlog->pluck('name' , 'id' )]
            ]);
    }


    public function create()
    {

        $catBlog = CatBlog::all();

        return  view('admin.pages.post.create')->with('catBlog' , $catBlog);
    }


    public function store(PostRequest $request)
    {

        $this->sizeImg = [
            'small_width'   => 300,
            'small_height'  => 300,
            'medium_width'  => 800  ,
            'medium_height' => 600,
        ];
        $img = $this->MDT_saveImage($request->file('img'), $request->slug);

        $description = $request->description;
        $descriptionText = mb_split('\s' , strip_tags($description));
        $descriptionText = join(' ' , array_filter($descriptionText));
        $descriptionText = str_replace(["&nbsp;" , '&ntilde' , '&uuml;'] ,  ' ' , $descriptionText);

        Post::create([

            'title' => $request->title,
            'slug' => $request->slug,
            'subtitle' => $request->subtitle,
            'img' => $img,
            'description' => $request->description,
            'shortDescription' => mb_substr($descriptionText,0,255, "utf-8"),
            'tags' => $request->tags,
            'catBlog_id' => $request->catBlog_id,

            'seo_title'         => $request->seo_title != null ? $request->seo_title : $request->title,
            'meta_description'  => $request->meta_description != null  ? $request->meta_description : mb_substr($descriptionText,0,255, "utf-8"),

        ]);

        return  back()->with('success' , 'تم اضافة المقالة بنجاح');
    }


    public function show($id)
    {

        $catsBlog  = CatBlog::latest()->get(['name' , 'id']);

        $post = Post::with('cat')->withTrashed()->findOrFail($id);

        return  view('admin.pages.post.show')->with([
            'post' => $post ,
            'catBlog' => $catsBlog ,
        ]);

    }


    public function edit($id)
    {

    }


    public function update(PostUpdateRequest $request, $id)
    {


        $post = Post::withTrashed()->findOrFail($id);

        $img = $post->img;

        if ($request->has('img')) {

            $this->MDT_deleteImage(false , $post->img);

            $img = $this->MDT_saveImage($request->file('img'), $request->slug);
        }



        if ($request->ajax()) {

            $post->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'img' => $img,
                'visits' => $request->visits,

            ]);

            return response([
                'status' => 'success' ,
                'message' => 'تم تعديل المقالة بنجاح' ,
                'url' => ['img' => asset("$this->path_img/min/small_$post->img")]
            ]);

        }else{

            $description = $request->description;
            $descriptionText = mb_split('\s' , strip_tags($description));
            $descriptionText = join(' ' , array_filter($descriptionText));
            $descriptionText = str_replace(["&nbsp;" , '&ntilde' , '&uuml;'] ,  ' ' , $descriptionText);

            $post->update([

                'title' => $request->title,
                'slug' => $request->slug,
                'subtitle' => $request->subtitle,
                'img' => $img,
                'description' => $request->description,
                'shortDescription' => mb_substr($descriptionText,0,255, "utf-8"),
                'tags' => $request->tags,

                'catBlog_id' => $request->catBlog_id,

                'seo_title'         => $request->seo_title != null ? $request->seo_title : $request->title,
                'meta_description'  => $request->meta_description != null  ? $request->meta_description : mb_substr($descriptionText,0,255, "utf-8"),

            ]);

            return  back()->with(['status' => 'success' , 'message' => 'تم تعديل المقالة بنجاح']);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->MDT_delete(Post::class , $id);
    }

    public function trash()
    {

        return myDataTable_query(

            Post::class ,
            'admin.pages.post.trash',
            true
        );
    }

    public function restore($id)
    {

        return $this->MDT_restore(Post::class , $id);
    }

    public function finalDelete($id)
    {

        return $this->MDT_finalDelete(Post::class , $id);
    }
}
