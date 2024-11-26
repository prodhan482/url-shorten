<?php

namespace Database\Factories;

use App\Models\URL;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\URL>
 */
class URLFactory extends Factory
{
    protected $model = URL::class;

    public function definition()
    {
        return [
            'long_url' => $this->faker->url,
            'short_code' => $this->faker->unique()->lexify('??????'), // Generates a 6-character short code
        ];
    }
}
