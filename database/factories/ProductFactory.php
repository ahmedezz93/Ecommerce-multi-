<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name=fake()->name();
        return [
            'name' => $name,
            'store_id' => 1,
            'category_id' => 1,
            'slug' => Str::slug($name),
            'price' => rand(5),
        ];
    }
}
