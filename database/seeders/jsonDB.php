<?php

namespace Database\Seeders;

use App\Models\Cat;
use App\Models\Color;
use App\Models\Product;
use App\Models\Section;
use App\myDataTable\uploadImagTest;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class jsonDB extends Seeder
{

    use uploadImagTest;
    public $path_img = "assets/web/images/products";


    public function run()
    {
        $jsonString = file_get_contents(base_path('public/assets/jsonFile/product.json'));
        $data = json_decode($jsonString, true);

        foreach ($data as $attr){


            \DB::transaction(function () use ($attr) {

                $price = floatval(strlen($attr['Price']) > 0 ? $attr['Price'] : 0);
                $discount = floatval(strlen($attr['Sale Price']) > 0 ? $attr['Sale Price'] : 0);

                $difference = $discount <= 0 ? 0 : $price - $discount;

                $slug = Str::slug($attr['Product Name']);
                $description = strlen($attr['Excerpt']) > 0 ? $attr['Excerpt'] : "";


                // img;
                $imgName = '';
                if (array_key_exists('Featured Image', $attr) && strlen($attr['Featured Image'] > 1)) {

                    $url = $attr['Featured Image'];
                    $newUrl = str_replace('https://meralll.com/wp-content/', public_path('assets/'), $url);

                    $imgName = $this->MDT_saveImageTest($newUrl , Str::slug($attr['Product Name']));
                }

                $descriptionText = mb_split('\s' , strip_tags($description));
                $descriptionText = join(' ' , array_filter($descriptionText));
                $descriptionText = str_replace("&nbsp;" , ' ' , $descriptionText);

                $product = Product::create([
                    'name' => $attr['Product Name'],
                    'slug' => $slug,
                    'img' => $imgName,
                    'alt' => $attr['Product Name'],
                    'price' => $price,
                    'discount' => $discount,
                    'percentage' => round(($difference / $price) * 100),
                    'description' => $description,
                    'shortDescription' => mb_substr($descriptionText,0,150, "utf-8"),
                    'seo_title' => trim($attr['WordPress SEO - SEO Title'] , '%%title%% %%page%% %%sep%% %%sitename%%'),
                    'meta_description' => $attr["WordPress SEO - Meta Description"],
                    'keyword_tag' =>  str_replace(' ' , ',' , mb_substr($descriptionText,0,250, "utf-8")),
                ]);


                // gallery
                if (array_key_exists('Product Gallery', $attr) && strlen($attr['Product Gallery'] > 1)) {

                    $url = $attr['Featured Image'];
                    $newUrl = str_replace('https://meralll.com/wp-content/', public_path('assets/'), $url);


                    $images = $this->MDT_saveMultiImage($newUrl, $slug, $imgName, ['product_id', $product->id]);

                    $product->images()->insert($images);
                }

                // colors

                $color_attr_name = "Attribute: Color";
                $colorsId = [];

                if (array_key_exists($color_attr_name, $attr)) {

                    $typeColors = gettype($attr[$color_attr_name]) === "array" ? count($attr[$color_attr_name]) > 0 : strlen($attr[$color_attr_name]) > 1;

                    if ($typeColors) {

                        $colorRemoveNumeric = preg_replace('/\d+/u', '', $attr[$color_attr_name]);

                        $colorArray = array_unique(explode('|' , $colorRemoveNumeric));

                        foreach ($colorArray as $colorIndex) {

                            $color = Color::where('name', $colorIndex)->first();

                            if ($color) {


                                $colorsId[] = $color->id;

                            }else{

                                $color = Color::create([

                                    'name' => $colorIndex,
                                    'slug' => Str::slug($colorIndex),
                                    'alt' => $colorIndex,
                                    'custom' => 1
                                ]);

                                $colorsId[] = $color->id;
                            }

                        }
                    }
                }

                $product->colors()->attach($colorsId);

                //end colors

                // cats

                $catsId = [];
                foreach(explode("|" , $attr['Category']) as $section){

                    $cat = explode(">" , $section);

                    if (count($cat) == 2) {

                        $catDB = Cat::where("name" , $cat[1])->first();

                        if ($catDB) {

                            $catsId[]= $catDB->id;

                        }else{


                            $sectionDB = Section::where("name" , $cat[0])->first();

                            if ($sectionDB) {

                                $newCat = Cat::create([
                                    "name" => $cat[1],
                                    "slug" => Str::slug($cat[1]),
                                    'section_id' => $sectionDB->id
                                ]);

                                $catsId[]= $newCat->id;

                            }else{

                                $newSection = Cat::create([

                                    "name" => $cat[0],
                                    "slug" => Str::slug($cat[0]),
                                ]);

                                $newCat = Cat::create([
                                    "name" => $cat[1],
                                    "slug" => Str::slug($cat[1]),
                                    'section_id' => $newSection->id
                                ]);

                                $catsId[]= $newCat->id;
                            }
                        }
                    }
                }

                $product->cats()->attach($catsId);

                //end cats
            });


        }
    }
}
