<?php

namespace App\Interfaces;

interface EmployeeInterface
{
    public function index();

    public function show($employee_id);

    public function store(array $data);

    public function update(array $data, $employee_id);

    public function destroy($employee_id);

    public function getEmployees($request);


}
