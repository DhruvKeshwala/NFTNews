<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CryptoJournal extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'shortDescription',
        'fullDescription',
        'image',
        'pdf',
        'slug',
        'metaTitle',
        'description',
        'keywords',
        'uploadSocialBanner',
        'orderIndex',
        'image_alt',
        'social_banner_alt',
        'publish_date'
    ];
}
