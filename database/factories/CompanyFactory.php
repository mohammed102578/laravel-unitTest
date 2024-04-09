<?php
namespace Database\Factories;


use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name_ar = $this->faker->company;
        $name_en = $this->faker->company;

        return [
            'name' => Arr::wrap([
                'ar' => $name_ar,
                'en' => $name_en,
            ]),
            'email' => $this->faker->unique()->safeEmail,
            'logo' => 'path/to/default/logo.png', // Set a default logo path if needed
            'website' => $this->faker->url,
        ];
    }
}

?>