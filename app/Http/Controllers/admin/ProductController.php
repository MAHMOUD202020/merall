<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateAjaxRequest;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\Section;
use App\Models\SizeChart;
use App\Models\Size;
use App\myDataTable\methodAction;
use App\myDataTable\uploadImag;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    use uploadImag;
    use methodAction;

    public $path_img = "assets/web/images/products";

    public function index()
    {
        $product  = Section::latest()->get(['name' , 'id']);

        return myDataTable_query(
            Product::class ,
            'admin.pages.product.index',
            false,
            [
                'with-view' => ['sections' => $product->pluck('name' , 'id' )],
                'columns' =>['id', 'name', 'slug', 'img', 'alt' ,  'price', 'discount', 'available', 'premium'  , 'updated_at', 'created_at']
            ]
        );
    }


    public function create()
    {

        $colors_all  = Color::where('custom' , 0)->latest()->take(30)->get();

        $colors_custom  = Color::where('custom' , 1)->latest()->take(30)->get();

        $sections  = Section::with('cats')->latest()->get(['name' , 'id']);

        $sizeCharts = SizeChart::all();

        $sizes = Size::all();

        return  view('admin.pages.product.create')->with([
            'sections' => $sections ,
            'colors_all' => $colors_all ,
            'colors_custom' => $colors_custom ,
            'sizeCharts' => $sizeCharts ,
            'sizes' => $sizes ,
        ]);
    }


    public function store(ProductRequest $request)
    {


        \DB::transaction(function () use ($request){

            $price  =  (double) $request->price;
            $discount = (double) $request->discount;
            $difference = $price - $discount;


            $img = $this->MDT_saveImage($request->get('img'), $request->slug);

            $description = $request->description;
            $descriptionText = mb_split('\s' , strip_tags($description));
            $descriptionText = join(' ' , array_filter($descriptionText));
            $descriptionText = str_replace(["&nbsp;" , '&ntilde' , '&uuml;'] ,  ' ' , $descriptionText);

            $product = Product::create([
                'name'              => $request->name,
                'slug'              => $request->slug,
                'img'               => $img,
                'alt'               => $request->has('alt') ? $request->alt : $request->name,
                'price'             => $price,
                'discount'          => $discount,
                'percentage'        => $discount <= 0 ? 0 : round(($difference / $price) * 100),
                'description'       => $description,
                'size_id'           => $request->size,
                'sizeChart_id'      => $request->sizeChart,
                'shortDescription'  => mb_substr($descriptionText,0,150, "utf-8"),
                'premium'           => $request->has('premium') ? 1 : 0,
                'available'         => $request->has('available') ? 0 : 1,
                'seo_title'         => $request->seo_title != null ? $request->seo_title : $request->name,
                'meta_description'  => $request->meta_description != null  ? $request->meta_description : mb_substr($descriptionText,0,255, "utf-8"),
                'keyword_tag'       => $request->keyword_tag != null ? $request->keyword_tag : str_replace(' ' , ',' , mb_substr($descriptionText,0,255, "utf-8")),

            ]);

            $alt = $request->has('alt_images') ? $request->alt_images : $request->name;

            if ($request->has('images')) {

                $images = $this->MDT_saveMultiImage($request->get('images'), $request->slug , $alt , ['product_id' , $product->id]);

                $product->images()->insert($images);
            }

            $product->colors()->attach($request->colors);

            $product->cats()->attach($request->cats);

            $product->sizes()->attach($request->sizes);
        });




        return  back()->with('success' , 'تم اضافة المنتج بنجاح');
    }



    public function show($id)
    {

        $product = Product::findOrFail($id);

        $colors_checked = Color::whereHas('products' , function ($q) use ($product){
            return $q->where('product_id' , $product->id);
        })->latest()->get();

        $colors_all  = Color::whereDoesntHave('products' , function ($q) use ($product){
            return $q->where('product_id' , $product->id);
        })->where('custom' , 0)->latest()->take(30)->get();

        $colors_custom  = Color::whereDoesntHave('products' , function ($q) use ($product){
            return $q->where('product_id' , $product->id);
        })->where('custom' , 1)->latest()->take(30)->get();


        $sections  = Section::with('cats')->latest()->get(['name' , 'id']);

        $sizeCharts = SizeChart::all();

        $sizes = Size::all();

        return  view('admin.pages.product.show')->with([
            'product' => $product ,
            'sections' => $sections ,
            'colors_checked' => $colors_checked ,
            'colors_all' => $colors_all ,
            'colors_custom' => $colors_custom ,
            'sizeCharts' => $sizeCharts ,
            'sizes' => $sizes ,
        ]);
    }

    public function fullUpdate(ProductRequest $request , $id)
    {


        $product = Product::findOrFail($id);

        \DB::transaction(function () use ($request , $product) {

            $price  = $request->price;
            $discount = $request->discount;
            $difference = $price - $discount;


            $img = $product->img;

            if ($request->has('img')) {

                $this->MDT_deleteImage(false , $product->img);

                $img = $this->MDT_saveImage($request->get('img'), $request->slug);
            }

            $description = $request->description;
            $descriptionText = mb_split('\s' , strip_tags($description));
            $descriptionText = join(' ' , array_filter($descriptionText));
            $descriptionText = str_replace(["&nbsp;" , '&ntilde' , '&uuml;'] , ' ' , $descriptionText);

            $this->if_is_replace_slug($request  , $product);

            $product->update([
                'name'              => $request->name,
                'slug'              => $request->slug,
                'img'               => $img,
                'alt'               => $request->has('alt') ? $request->alt : $request->name,
                'price'             => $price,
                'discount'          => $discount,
                'sizeChart_id'      => $request->sizeChart,
                'percentage'        => round(($difference / $price) * 100),
                'description'       => $request->description,
                'shortDescription'  => mb_substr($descriptionText,0,150, "utf-8"),
                'premium'           => $request->has('premium') ? 1 : 0,
                'available'         => $request->has('available') ? 0 : 1,
                'seo_title'         => $request->seo_title != null ? $request->seo_title : $request->name,
                'meta_description'  => $request->meta_description != null  ? $request->meta_description : mb_substr($descriptionText,0,255, "utf-8"),
                'keyword_tag'       => $request->keyword_tag != null ? $request->keyword_tag : str_replace(' ' , ',' , mb_substr($descriptionText,0,255, "utf-8")),

            ]);

            $alt = $request->get('alt_images') ? $request->alt_images : $request->name;


            $oldImages = $request->get('oldImg') ? $request->oldImg : [];
            $deleteImages = $product->images()->whereNotIn('id' , $oldImages);
            $deleteImages->delete();

            foreach ($deleteImages->get() as $img){

                $this->MDT_deleteImage(false , $img->src);
            }


            if ($request->get('images')) {

                $images = $this->MDT_saveMultiImage($request->get('images'), $request->slug , $alt , ['product_id' , $product->id]);

                $product->images()->insert($images);
            }


            $product->colors()->sync($request->colors);

            $product->cats()->sync($request->cats);

            $product->sizes()->sync($request->sizes);
        });




        return  back()->with('success' , 'تم تعديل المنتج بنجاح');
    }

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateAjaxRequest $request, $id)
    {

        $product = Product::withTrashed()->findOrFail($id);

        $price  = $request->price;
        $discount = $request->discount;
        $difference = $price - $discount;

        $img = null;

        if ($request->get('img')) {

            $this->MDT_deleteImage("$this->path_img/min" , $product->img);

            $img = $this->MDT_saveImage($request->get('img'), $request->slug);
        }

        $this->if_is_replace_slug($request  , $product);


        $product->update([
            'name'              => $request->name,
            'slug'              => $request->slug,
            'img'               => $img ? $img : $product->img,
            'alt'               => $request->get('alt') ? $request->alt : $request->name,
            'price'             => $price,
            'discount'          => $discount,
            'percentage'        => round(($difference / $price) * 100),
            'premium'           => $request->premium,
            'available'         => $request->available,
        ]);

        return response([
            'status' => 'success' ,
            'message' => 'تم تعديل المنتج بنجاح' ,
            'url' => ['img' => asset("$this->path_img/min/small_$product->img")]
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->MDT_delete(Product::class , $id);
    }

    public function trash()
    {
        $product  = Section::latest()->get(['name' , 'id']);

        return myDataTable_query(
            Product::class ,
            'admin.pages.product.trash',
            true,
            [
                'with-view' => ['sections' => $product->pluck('name' , 'id' )],
                'columns' =>['id', 'name', 'slug', 'img', 'alt' ,  'price', 'discount', 'available', 'premium'  , 'updated_at', 'created_at']
            ]
        );
    }

    public function restore($id)
    {

        return $this->MDT_restore(Product::class , $id);
    }

    public function finalDelete($id)
    {
        return $this->MDT_finalDelete(Product::class , $id , "$this->path_img/min/" , 'img');
    }

    private function if_is_replace_slug($request , $oldProduct){

        if ($oldProduct->slug != $request->slug) {

            \File::moveDirectory( base_path("public/$this->path_img/gallery/$oldProduct->slug") , base_path("public/$this->path_img/gallery/$request->slug"));
        }
    }
}

