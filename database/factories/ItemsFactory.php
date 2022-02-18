<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Items;

class ItemsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Items::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->regexify('[A-Za-z0-9]{200}'),
            'cost' => $this->faker->regexify('[A-Za-z0-9]{200}'),
            'expire_date' => $this->faker->dateTime(),
        ];
    }
}
