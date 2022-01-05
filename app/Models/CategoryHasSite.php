<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryHasSite extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id', 'site_id'
    ];
    protected $table ='categories_has_site';
}
