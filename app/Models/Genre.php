<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $primaryKey = 'genre_id';

    protected $fillable = ['genre_name'];

    public function songs() {
        return $this->hasMany(Song::class);
    }
    public function users() {
        return $this->belongsToMany(User::class, 'recommend_point', 'genre_id', 'user_id')->withPivot('language_id','point')->withTimestamps();
    }
    
}
