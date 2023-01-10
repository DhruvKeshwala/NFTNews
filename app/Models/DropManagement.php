<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DropManagement extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'categoryId',
        'name',
        'email',
        'token',
        'blockChain',
        'priceOfSale',
        'saleDate',
        'saleTime',
        'saleEndDate',
        'location',
        'phone',
        'skype',
        'projectName',
        'shortDescription',
        'collectionName',
        'collectionItem',
        'contractAddress',
        'metaData',
        'discordLink',
        'twitterLink',
        'websiteLink',
        'image',
        'image2',
        'logo',
        'nftType',
        'nftStatus',
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
}
