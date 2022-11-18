<?php

namespace Database\Factories;

use App\Models\Actor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ActorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Actor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            //
        ];
    }
}

// use App\Actor;
// use Faker\Generator as Faker;
// use Illuminate\Support\Str;

// $factory->define(Actor::class, function (Faker $faker) {
//     $name = $this->faker->name();
//     return [
//         'name' => $name,
//         'slug' => Str::slug($name),
//     ];
// });
