<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Film as FilmResource;
use Illuminate\Support\Str;

class Film extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title'=>$this->name,
            'year'=>$this->year,
            'description'=>Str::words($this->description,10),
            'categories'=>$this->categories,
            'actors'=>$this->actors,
        ];
    }

    public function show(Film $film){
        return new FilmResource($film);
    }
}
