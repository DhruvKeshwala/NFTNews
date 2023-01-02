<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PressRelease extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'categoryId',
        'authorId',
        'shortDescription',
        'fullDescription',
        'image',
        'article_1',
        'article_2',
        'pressType',
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