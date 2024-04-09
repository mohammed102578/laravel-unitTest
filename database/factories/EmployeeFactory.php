<?php
namespace Database\Factories;

use App\Models\Company;
use App\Models\Employee;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Initialize Faker with Arabic locale
        $faker = \Faker\Factory::create('ar_SA');
        $faker->addProvider(new \Faker\Provider\ar_SA\Person($faker));

        // Generate Arabic names
        $first_name_ar = $faker->firstName;
        $last_name_ar = $faker->lastName;

        // Generate English names
        $first_name_en = $this->faker->company;
        $last_name_en = $this->faker->company;

        // Get a random company ID
        $company_id = Company::inRandomOrder()->value('id');
        if (is_null($company_id)) {
            $company_id = $this->faker->numberBetween(1, 100);
        }

        return [
            'first_name' => Arr::wrap([
                'ar' => $first_name_ar,
                'en' => $first_name_en,
            ]),
            'last_name' => Arr::wrap([
                'ar' => $last_name_ar,
                'en' => $last_name_en,
            ]),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'company_id' => $company_id,
        ];
    }
}

?>