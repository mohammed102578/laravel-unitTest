<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class CompanyControllerTest extends TestCase
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
        Company::factory()->count(5)->create();

        // Call the index route
        $response = $this->get(route('companies.index'));

        // Assert that the response is a redirect
        $response->assertStatus(200);
    }






    public function testEdit()
    {
        $this->login_test();

        // Create a company instance for testing
        $company = Company::factory()->create();

        // Make a GET request to the edit route
        $response = $this->get(route('companies.edit', ['company' => $company->id]));

        // Assert that the response redirects (status 302)
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $this->login_test();

        $requestData = [
            'name_en' => 'Updated English Name',
            'name_ar' => 'Updated Arabic Name',
            'email' => 'updated@example.com',
            'website' => 'http://updated.example.com',
            'logo' => UploadedFile::fake()->image('logo.jpg'),
        ];

        $response = $this->post(route('companies.store'), $requestData);

        $response->assertStatus(302); // Assuming the store method redirects after successful creation

        // Get the newly created company instance from the database
        $company = Company::latest()->first();

        // Assert that the company data is stored in the database correctly
        $this->assertDatabaseHas('companies', [
            'name->en' => 'Updated English Name',
            'name->ar' => 'Updated Arabic Name',
            'email' => 'updated@example.com',
            'website' => 'http://updated.example.com',
        ]);

        // Assert that the new logo is stored in the storage
        Storage::disk('public')->assertExists($company->logo);
    }


    public function testUpdate()
    {
        $this->login_test();

        // Create a company
        $company = Company::factory()->create();

        // Mock the request data
        $requestData = [
            'name_en' => 'Updated English Name',
            'name_ar' => 'Updated Arabic Name',
            'email' => 'updated@example.com',
            'website' => 'http://updated.example.com',
            'logo' => UploadedFile::fake()->image('logo.jpg'),
        ];

        // Make a PUT request to the update route
        $response = $this->put(route('companies.update', $company->id), $requestData);

        // Assert that the response is a redirect
        $response->assertStatus(302);

        // Assert that the company data is updated in the database
        $this->assertDatabaseHas('companies', [
            'id' => $company->id,
            'name->en' => 'Updated English Name',
            'name->ar' => 'Updated Arabic Name',
            'email' => 'updated@example.com',
            'website' => 'http://updated.example.com',
        ]);

        // Assert that the new logo is stored in the storage
        Storage::disk('public')->assertExists($company->fresh()->logo);
    }

    public function testDestroy()
    {
        $this->login_test();

        // Assuming $company is the company instance you want to delete
        $company = Company::factory()->create();

        $response = $this->delete(route('companies.destroy', $company->id));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('companies', ['id' => $company->id]);
    }
}
