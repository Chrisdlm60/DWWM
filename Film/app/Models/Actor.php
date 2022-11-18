<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $visible = ['name'];

    public function films(){
        return $this->morphToMany(Film::class, 'filmable');
    }
}
