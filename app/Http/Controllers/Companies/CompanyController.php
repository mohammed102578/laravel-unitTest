<?php

namespace App\Http\Controllers\Companies;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\CompanyUpdateRequest;
use App\Http\Requests\Companies\CompanyStoreRequest;
use App\Models\Company;
use App\Repositories\CompanyRepository;

class CompanyController extends Controller
{

   public $company;

   public function __construct(CompanyRepository $companyRepository)
   {
      $this->company = $companyRepository;
   }
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      return  $this->company->index();
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
      return  $this->company->create();
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(CompanyStoreRequest $request)
   {

      return  $this->company->store($request);
   }

   /**
    * Display the specified resource.
    */
   public function show(string $company_id)
   {
      return  $this->company->show($company_id);
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(string $company_id)
   {
      return  $this->company->edit($company_id);
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(CompanyUpdateRequest $request, $company_id)
   {
      return  $this->company->update($request, $company_id);
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(string $company_id)
   {
      return  $this->company->destroy($company_id);
   }



   public function getCompanies(Request $request)
   {
      return  $this->company->getCompanies($request);
   }
}
