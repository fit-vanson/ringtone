<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorFavorite extends Model
{
    use HasFactory;
    protected $fillable = [
        'visitor_id', 'ringtone_id'
    ];
    protected $table ='visitor_favorites';
}
