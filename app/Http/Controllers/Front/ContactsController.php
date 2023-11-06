<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Imports\ContactsImport;
use Maatwebsite\Excel\Facades\Excel;


class ContactsController extends Controller
{

    public function index(request $request)
    {
        toastr(__('site.contacts_added_successfully'));
        toastr()->success('Data saved successfully!', 'Success');

        $data['contacts'] = Contact::where(['user_id' =>auth()->id()])->get();

        if($request->ajax()) {
            $languages =  Contact::where(['user_id' =>auth()->id()])->get();

            return Datatables::of($languages)
                ->addColumn('action', function ($language) {
                    return '
                        <button type="button" data-id="' . $language->id . '" class="edit-table editBtn" data-bs-toggle="modal"
                                          >
                                        <i class="fa-solid fa-pen-to-square fa-lg ms-2"></i>
                                    </button>
                                  <button data-bs-toggle="modal"  data-id="' . $language->id . '" data-bs-target="#delete_modal" data-title="' . $language->name . '" class="edit-table delete-table">
                                       <i class="fa-solid fa-trash-can fa-lg"></i>
                                  </button>

                            </button>
                       ';
                })
                ->editColumn('email', function($languages) {
                    return $languages->email ?? '--';
                })
                ->escapeColumns([])
                ->make(true);
        }else{
            return view('front.contacts.contact',$data);
        }
    }


    public function create()
    {
        return view('front.contacts.parts.create');
    }

    public function store(Request $request)
    {
        $valiadate = $request->validate([
            'name'     => 'required',
            'phone'     => 'required',
        ]);
        $data = $request->except('_token');
        $data['user_id'] = auth()->id();
        Contact::create($data);
        return response()->json(['status' => 200]);
    }



    public function edit($id)
    {
        $find = Contact::find($id);
        return view('front.contacts.parts.edit',compact('find'));
    }



    public function update(Request $request, $id)
    {
        $language = Contact::find($id);
        $data = $request->except('_token','_method','id');


        $language->update($data);
        return response()->json(['status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $language = Contact::find($request->id);

        $language->delete();
        return response(['message'=>'تم الحذف بنجاح','status'=>200],200);
    }

    public function showExcel()
    {
        $data['contacts'] = Contact::where(['user_id' =>auth()->id()])->get();
        return view('front.show_excel.show_excel',$data);
    }

    public function import(Request $request)
    {
        Excel::import(new ContactsImport, $request->file);
        toastr(__('site.contacts_added_successfully'));
        toastr()->success('Data has been saved successfully!');

//        return response(['message'=>__('site.contacts_added_successfully'),'status'=>200],200);
        return redirect('/contact')->with('success', 'All good!');
    }
}
