<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryHasRingtone extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id', 'ringtone_id'
    ];
    protected $table ='category_has_ringtones';
}
