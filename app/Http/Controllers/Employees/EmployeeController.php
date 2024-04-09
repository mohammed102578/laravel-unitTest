<?php

namespace App\Http\Controllers\Employees;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\EmployeeStoreRequest;
use App\Http\Requests\Employees\EmployeeUpdateRequest;
use App\Models\Employee;
use App\Repositories\EmployeeRepository;

class EmployeeController extends Controller
{

    public $employee;

    public function __construct(EmployeeRepository $employeeRepository)
    {

        $this->employee = $employeeRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  $this->employee->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->employee->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeStoreRequest $request)
    {
        return $this->employee->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $employee_id)
    {
        return $this->employee->show($employee_id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $employee_id)
    {
        return $this->employee->edit($employee_id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeUpdateRequest $request, string $employee_id)
    {
        return $this->employee->update($request, $employee_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $employee_id)
    {
        return $this->employee->destroy($employee_id);
    }

    public function getEmployees(Request $request)
    {
        return $this->employee->getEmployees($request);
    }
}
