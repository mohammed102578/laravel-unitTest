<?php

namespace App\Interfaces;

interface CompanyInterface
{
    public function index();

    public function show($company_id);

    public function store(array $data);

    public function update(array $data, $company_id);

    public function destroy($company_id);

    public function getCompanies($request);


}
