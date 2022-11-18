<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
    use HasFactory, SoftDeletes;
    //relation 1:n
    //protected $fillable = ['title', 'year', 'description', 'category_id'];
    //relation n:n
    //protected $fillable = ['title','year','description'];

    protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at'];


    // public function category(){
        //relation1:n
        //return $this->belongsTo(Category::class);
    // }

    public function categories()
    {
        //relation n:n
        // return $this->belongsToMany(Category::class);

        //relation polymorph
        return $this->morphedByMany(Category::class, 'filmable');
    }
    public function actors(){
        return $this->morphedByMany(Actor::class, 'filmable');
    }
}
