<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guide extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'category',
        'question',
        'answer',
        'slug',
    ];

    // Guide model
    public function guides()
    {
        return $this->hasMany(Guide::class,'id');
    }
}
