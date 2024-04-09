<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class EmployeeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function login_test()
    {
        $data = [
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'password'
        ];
        $admin = User::create($data);
        return $this->actingAs($admin);
    }


    public function testIndex()
    {
        $this->login_test();

        // Create some fake company data using the factory
        $company = Company::factory()->create();

        Employee::factory()->count(5)->create();

        // Call the index route
        $response = $this->get(route('employees.index'));

        // Assert that the response is a redirect
        $response->assertStatus(200);
    }






    public function testEdit()
    {
        $this->login_test();

        // Create a company instance for testing
        $company = Company::factory()->create();

        $employee = Employee::factory()->create();

        // Make a GET request to the edit route
        $response = $this->get(route('employees.edit', ['employee' => $employee->id]));

        // Assert that the response redirects (status 302)
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $this->login_test();

        $company = Company::factory()->create();
        // Mock the request data
        $requestData = [
            'first_name_en' => 'noor',
            'first_name_ar' => 'نور',
            'last_name_en' => 'majid',
            'last_name_ar' => 'ماجد',
            'email' => 'updated@example.com',
            'phone' => '+201038373',
            'company_id' => $company->id,
        ];

        $response = $this->post(route('employees.store'), $requestData);

        $response->assertStatus(302); // Assuming the store method redirects after successful creation

        // Get the newly created company instance from the database
        $employee = Employee::latest()->first();

        // Assert that the company data is stored in the database correctly
        $this->assertDatabaseHas('employees', [
            'id' => $employee->id,
            'first_name->en' => 'noor',
            'first_name->ar' => 'نور',
            'last_name->en' => 'majid',
            'last_name->ar' => 'ماجد',
            'email' => 'updated@example.com',
            'phone' => '+201038373',
            'company_id' => $company->id,
        ]);
    }

    public function testUpdate()
    {
        $this->login_test();

        $company = Company::factory()->create();
        $employee = Employee::create([
            'first_name' => [
                'en' => 'mohammed',
                'ar' => 'محمد'
            ],
            'last_name' => [
                'en' => 'adam',
                'ar' => 'ادم'
            ],
            'email' => 'stor@example.com',
            'phone' => '+201038373',
            'company_id' => $company->id,
        ]);

        // Mock the request data
        $requestData = [
            'first_name_en' => 'noor',
            'first_name_ar' => 'نور',
            'last_name_en' => 'majid',
            'last_name_ar' => 'ماجد',
            'email' => 'updated@example.com',
            'phone' => '+201038373',
            'company_id' => $company->id,
        ];

        // Make a PUT request to the update route
        $response = $this->put(route('employees.update', $employee->id), $requestData);

        // Assert that the response is a redirect
        $response->assertStatus(302);

        // Assert that the company data is updated in the database
        $this->assertDatabaseHas('employees', [
            'id' => $employee->id,
            'first_name->en' => 'noor',
            'first_name->ar' => 'نور',
            'last_name->en' => 'majid',
            'last_name->ar' => 'ماجد',
            'email' => 'updated@example.com',
            'phone' => '+201038373',
            'company_id' => $company->id,
        ]);
    }


    public function testDestroy()
    {
        $this->login_test();

        // Assuming $company is the company instance you want to delete
        $company = Company::factory()->create();
        $company = Employee::factory()->create();

        $response = $this->delete(route('employees.destroy', $company->id));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('employees', ['id' => $company->id]);
    }
}
