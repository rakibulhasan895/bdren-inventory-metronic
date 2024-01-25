<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function children()
    {
        return $this->hasMany(Category::class, 'parents'); // you may use self::class instead of Category::class
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parents'); // you may use self::class instead of Category::class
    }
    
}
