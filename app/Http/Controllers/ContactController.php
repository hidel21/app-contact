<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CompanyRepository;
use App\Models\Contact;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactController extends Controller
{
    public function __construct(protected CompanyRepository $company)
    {
        
    }

    public function index(CompanyRepository $company, Request $request)
    {
        // dd($request->sort_by);
        // $companies = [
        //     1 => ['name' => 'Company One', 'contacts' => 3],
        //     2 => ['name' => 'Company Two', 'contacts' => 5],
        // ];
        $companies = $company->pluck();

        $contacts = Contact::latest()->where(function ($query)
        {
            if ($companyId = request()->query("company_id")){
                $query->where("company_id", $companyId);
            }
        });


        $contactsCollection = Contact::latest()->get();
        
        $perPage = 10;
        
        $currentPage = request()->query('page', 1);
        
        $items = $contactsCollection->slice(($currentPage * $perPage)-$perPage, $perPage);
        
        $total = $contactsCollection->count();
        
        $contacts = new LengthAwarePaginator($items, $total, $perPage, $currentPage, [
            'path' => request()->url(),
            'query' => request()->query()
        ]);
        
        
        return view('contacts.index', compact('contacts', 'companies'));
    
    }

public function create()
{
    return view('contacts.create');
}

public function show(Request $request, $id)
    {
    $contact = Contact::findOrFail('id');
    return view('contacts.show')->with('contact', $contact);
    }

}
