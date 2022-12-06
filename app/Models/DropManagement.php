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
        'token',
        'blockChain',
        'priceOfSale',
        'saleDate',
        'discordLink',
        'twitterLink',
        'websiteLink',
    ];
    public function category()
    {
        return $this->hasOne(Category::class,'id','categoryId');
    }
}
