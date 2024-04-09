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
        // Initialize Faker with Arabic locale
        $faker = \Faker\Factory::create('ar_SA');
        $faker->addProvider(new \Faker\Provider\ar_SA\Company($faker));

        // Generate Arabic company names
        $name_ar = $faker->company;

        // Generate English company names
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