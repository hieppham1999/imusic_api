<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Composer extends Model
{
    use HasFactory;

    protected $primaryKey = 'composer_id';

    protected $fillable = ['composer_name'];

    public function songs() {
        return $this->belongsToMany(Song::class, 'composers_songs', 'composer_id', 'song_id')->withTimestamps();
    }
}
