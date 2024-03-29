<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $primaryKey = 'language_id';

    protected $fillable = ['language_name'];

    public function songs() {
        return $this->hasMany(Song::class);
    }
}
