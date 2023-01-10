<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video_management extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $fillable = [
        'categoryId',
        'authorId',
        'title',
        'shortDescription',
        'fullDescription',
        'image1',
        'image2',
        'code',
        'videoType',
        'start_date',
        'end_date',
        'slug',
        'uploadSocialBanner',
        'orderIndex',
        'metaTitle',
        'description',
        'keywords',
    ];
    public function category()
    {
        return $this->hasOne(Category::class,'id','categoryId');
    }
    public function author()
    {
        return $this->hasOne(Author::class,'id','authorId');
    }
}
