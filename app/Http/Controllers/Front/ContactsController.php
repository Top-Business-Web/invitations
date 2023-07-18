<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Imports\ContactsImport;
use Maatwebsite\Excel\Facades\Excel;

class ContactsController extends Controller
{
    public function index()
    {
        return view('front.contacts.contact');
    }

    public function showExcel()
    {
        return view('front.show_excel.show_excel');
    }

    public function import(Request $request)
    {
        Excel::import(new ContactsImport(), $request->file);

        return redirect('/contacts/show_excel')->with('success', 'All good!');
    }
}
