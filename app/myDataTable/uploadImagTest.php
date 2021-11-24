<?php


namespace App\myDataTable;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


trait uploadImagTest
{


    public $sizeImg = [

        'small_width'   => 300,
        'small_height'  => 300,
        'medium_width'  => 600,
        'medium_height' => 600,
    ];



    public function MDT_saveImageTest($file , $name , $custom_path=false ,  $width=700 , $height=897 , $quality=100){

        if ($file) {


            $pathSaveImag = $custom_path === false
                ? base_path("public/$this->path_img/min/")
                : $custom_path;

            File::isDirectory($pathSaveImag) ?: File::makeDirectory($pathSaveImag);

            $fileName = $name . '.jpg';

            $fileOld = Image::make($file);


            // resize min
            $fileOld->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $fileOld->save($pathSaveImag . $fileName, $quality);

            // resize small
            $fileOld->resize($this->sizeImg['small_width'] , $this->sizeImg['small_height'] ,  function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $fileOld->save($pathSaveImag . 'small_' . $fileName, $quality);

            // resize medium
            $fileOld->resize($this->sizeImg['medium_width'] , $this->sizeImg['medium_height'] ,  function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $fileOld->save($pathSaveImag . 'medium_' . $fileName, $quality);


            $fileNew = Image::make($pathSaveImag. $fileName);

            $fileSize = $fileNew->filesize();

            if ($fileSize > 153600) {


                if ($fileSize <= 204800) {
                    $q = 90;
                } elseif ($fileSize > 204800 && $fileSize <= 409600) {
                    $q = 85;
                } elseif ($fileSize > 409600 && $fileSize <= 768000) {
                    $q = 50;
                } else {
                    $q = 25;
                }

                // resize min

                $fileNew->save($pathSaveImag . $fileName, $q);

                // resize small
                $fileNew->resize($this->sizeImg['small_width'] , $this->sizeImg['small_height'] ,  function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $fileNew->save($pathSaveImag . 'small_' . $fileName, $q);

                // resize medium
                $fileOld->resize($this->sizeImg['medium_width'] , $this->sizeImg['medium_height'] ,  function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $fileOld->save($pathSaveImag . 'medium_' . $fileName, $q);

            }


            return $fileName;
        }

        return  null;
    }

    public function MDT_saveMultiImage($files, $name , $alt, $fk_id=['nameKey' , 'id'] , $custom_path=false ,$width=600 , $height=800  , $quality=100){

        $pathSaveImag = $custom_path === false
            ?  base_path("public/$this->path_img/gallery/$name/")
            :  $custom_path;


        $saveNameFile = [];
        $count = 0;

        foreach (explode('|' , $files) as $file){

            $rand = rand(10000000 , 90000000);

            File::isDirectory($pathSaveImag) ?: File::makeDirectory($pathSaveImag);

            $fileName = $name . '.jpg';

            $fileOld = Image::make($file);


            // resize min
            $fileOld->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $fileOld->save($pathSaveImag.$rand.'_'.$fileName , $quality);

            // resize small

            $fileOld->resize($this->sizeImg['small_width'] , $this->sizeImg['small_height'] ,  function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $fileOld->save($pathSaveImag.'small_'.$rand.'_'.$fileName , $quality);

            // resize medium

            $fileOld->resize($this->sizeImg['medium_width'] , $this->sizeImg['medium_height'] ,  function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $fileOld->save($pathSaveImag.'/medium_'.$rand.'_'.$fileName , $quality);


            $fileNew = Image::make($pathSaveImag.$rand.'_'.$fileName);

            $fileSize = $fileNew->filesize();

            if ($fileSize > 153600) {


                if ($fileSize <= 204800){$q = 90;}
                elseif ($fileSize > 204800 && $fileSize <= 409600){$q = 85;}
                elseif ($fileSize > 409600 && $fileSize <= 768000){$q = 50;}
                else{$q = 25;}

                // resize min

                $fileOld->save($pathSaveImag.$rand.'_'.$fileName , $q);

                // resize small
                $fileNew->resize($this->sizeImg['small_width'] , $this->sizeImg['small_height'] ,  function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $fileOld->save($pathSaveImag.'small_'.$rand.'_'.$fileName , $q);

                // resize medium
                $fileOld->resize($this->sizeImg['medium_width'] , $this->sizeImg['medium_height'] ,  function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $fileOld->save($pathSaveImag.'/medium_'.$rand.'_'.$fileName , $q);

            }


            $saveNameFile[$count]['src'] = $rand.'_'.$fileName;
            $saveNameFile[$count]['alt'] = $alt;
            $saveNameFile[$count][$fk_id[0]]=$fk_id[1];
            $count++;
        }
        return $saveNameFile;
    }


}
