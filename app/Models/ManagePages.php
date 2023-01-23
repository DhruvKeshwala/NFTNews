<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManagePages extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'fieldId',
        'image1',
        'image2',
        'name',
        'title',
        'metaTitle',
        'description',
        'keywords',
        'contents',
        'selectTemplate',
        'slug',
        'uploadSocialBanner',
        'image1_alt',
        'image2_alt',
        'social_banner_alt',
    ];
}
