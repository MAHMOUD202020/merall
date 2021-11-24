<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatBlog extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['_token'];

    public function posts(){

        return $this->hasMany(Post::class , 'catBlog_id' , 'id');
    }
}
