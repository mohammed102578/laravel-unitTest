<?php

namespace App\Repositories;

use App\Interfaces\CompanyInterface;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use App\Services\CompanyService;

class CompanyRepository implements CompanyInterface
{
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $companies = Company::paginate(10);

            return view('pages.Companies.companies', compact(['companies']));
        } catch (\Exception $e) {
            // Log the error or handle it as required
            toastr()->error('An error occurred while get the companies.');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        try {

            $data = $request->all();
            $company = new Company();
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('logos', $fileName, 'public');
                $company->logo  = $filePath;
            }
            $name = [
                'en' => $data['name_en'],
                'ar' => $data['name_ar']
            ];
            $company->setTranslations('name', $name);
            $company->email = $data['email'];
            $company->website = $data['website'];


            $company->save();

            //send mail to company
            $this->companyService->sendRegistrationEmail($company->email);

            toastr()->success(trans('messages.success'));
            return redirect()->route('companies.index');
        } catch (\Exception $e) {
            // Log the error or handle it as required
            toastr()->error('An error occurred while Storing the company.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($company_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($company_id)
    {

        try {
            $company = Company::find($company_id);
            return view('pages.Companies.EditCompany', compact(['company']));
        } catch (\Exception $e) {
            // Log the error or handle it as required
            toastr()->error('some thing went wrong.');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $company_id)
    {
        try {
            $company = Company::findOrFail($company_id);
            // Update the company data
            $company->name = $name = [
                'en' => $request['name_en'],
                'ar' => $request['name_ar']
            ];
            $company->setTranslations('name', $name);
            $company->email = $request->email;
            $company->website = $request->website;

            // Check if a new logo has been uploaded
            if ($request->hasFile('logo')) {
                // Delete the existing logo if it exists
                Storage::delete($company->logo);

                // Store the new logo
                $file = $request->file('logo');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('logos', $fileName, 'public');
                $company->logo = $filePath;
            }

            // Save the updated company data
            $company->save();

            toastr()->success(trans('messages.Update'));

            return redirect()->route('companies.index');
        } catch (\Exception $e) {
            // Log the error or handle it as required
            toastr()->error('An error occurred while updating the company.');
            return redirect()->back();
        }
    }
    /**
     * Remove the specified resource from storage.
     */ public function destroy($company_id)
    {
        try {
            $company = Company::findOrFail($company_id);
            $company->delete(); // Delete the company

            toastr()->success(trans('messages.Delete'));
            return redirect()->route('companies.index');
        } catch (\Exception $e) {
            // Log the error or handle it as required
            toastr()->error('An error occurred while deleting the company.');
            return redirect()->back();
        }
    }

    public function getCompanies($request)
    {
        try {
            // Query your data based on the DataTables request parameters
            $data = Company::query()
                ->offset($request->input('start'))
                ->limit($request->input('length'))
                ->get();

            // Return the data in the format expected by DataTables
            return response()->json([
                'draw' => $request->input('draw'),
                'recordsTotal' => Company::count(),
                'recordsFiltered' => Company::count(), // You might adjust this based on your filtering logic
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            // Log the error or handle it as required
            toastr()->error('An error occurred while get the company.');
            return redirect()->back();
        }
    }
}
