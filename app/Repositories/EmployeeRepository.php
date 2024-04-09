<?php

namespace App\Repositories;

use App\Interfaces\EmployeeInterface;
use App\Models\Company;
use App\Models\Employee;

class EmployeeRepository implements EmployeeInterface
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $companies = Company::all();

            return view('pages.Employees.employees', compact(['companies']));
        } catch (\Exception $e) {
            // Log the error or handle it as required
            toastr()->error('An error occurred while get the employees.');
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
            $employee = new Employee();

            $translations_first_name = [
                'en' => $data['first_name_en'],
                'ar' => $data['first_name_ar']
            ];
            $translations_last_name = [
                'en' => $data['last_name_en'],
                'ar' => $data['last_name_ar']
            ];
            $employee->setTranslations('first_name', $translations_first_name);
            $employee->setTranslations('last_name', $translations_last_name);
            $employee->phone = $data['phone'];
            $employee->email = $data['email'];
            $employee->company_id = $data['company_id'];
            $employee->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('employees.index');
        } catch (\Exception $e) {
            // Log the error or handle it as required
            toastr()->error('some thing went wrong');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($employee_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($employee_id)
    {
        try {
            $employee = Employee::find($employee_id);
            $companies = Company::all();

            return view('pages.Employees.EditEmployee', compact(['employee', 'companies']));
        } catch (\Exception $e) {
            // Log the error or handle it as required
            toastr()->error('some thing went wrong');
            return redirect()->back();
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update($request, $employee_id)
    {
        try {
            $employee = Employee::findOrFail($employee_id);

            $employee->first_name = [
                'en' => $request->first_name_en,
                'ar' => $request->first_name_ar
            ];
            $employee->last_name = [
                'en' => $request->last_name_en,
                'ar' => $request->last_name_ar
            ];
            $employee->phone = $request->phone;
            $employee->email = $request->email;
            $employee->company_id = $request->company_id;
            $employee->save();

            toastr()->success(trans('messages.Update'));

            return redirect()->route('employees.index');
        } catch (\Exception $e) {
            // Log the error or handle it as required
            toastr()->error('some thing went wrong');
            return redirect()->back();
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($employee_id)
    {
        try {
            $employee = Employee::findOrFail($employee_id);

            if ($employee) {

                $employee = $employee->delete();
                toastr()->success(trans('messages.Delete'));
                return redirect()->route('employees.index');
            } else {

                toastr()->error(trans('Grades_trans.delete_Employee_Error'));
                return redirect()->route('employees.index');
            }
        } catch (\Exception $e) {
            // Log the error or handle it as required
            toastr()->error('some thing went wrong');
            return redirect()->back();
        }
    }

    public function getEmployees($request)
    {
        try {
            // Query your data based on the DataTables request parameters
            $data = Employee::with('company')
                ->offset($request->input('start'))
                ->limit($request->input('length'))
                ->get();

            // Return the data in the format expected by DataTables
            return response()->json([
                'draw' => $request->input('draw'),
                'recordsTotal' => Employee::count(),
                'recordsFiltered' => Employee::count(), // You might adjust this based on your filtering logic
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            // Log the error or handle it as required
            toastr()->error('some thing went wrong');
            return redirect()->back();
        }
    }
}
