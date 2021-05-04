<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecommendPoint extends Model
{
    use HasFactory;

    protected $table = 'recommend_point';

    protected $primaryKey = 'recommend_id';

    protected $fillable = ['user_id', 'genre_id', 'language_id', 'point'];

    public function users() {
        return $this->belongsTo(User::class, 'recommend_id', 'user_id');
    }

}
