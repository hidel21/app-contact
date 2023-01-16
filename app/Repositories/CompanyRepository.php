<?php
namespace app\Repositories;
use App\Models\Company;

class CompanyRepository
{   
    
    public function pluck()
    {
    return Company::orderBy('name')->pluck('name','id');

    // $data = [];
    // $companies = Company::orderBy('name')->get();
    // foreach ($companies as $company){
    //   $data[$company->id] = $company->name . " (" . $company->contacts() . ") ";
    //   }
    //   return $data;
    return Company::orderBy('name')->pluck('name', 'id');
   }
}