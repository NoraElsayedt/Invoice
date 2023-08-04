<?php

namespace App\Http\Controllers;

use App\Models\Invoices_attachments;
use App\Models\Invoices;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DB;

class InvoicesAttachmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'file_name' => 'mimes:pdf,jpeg,png,jpg',
    
            ], [
                'file_name.mimes' => 'you must   pdf, jpeg , png , jpg',
            ]);

            $image = $request->file('file_name');
            $file_name = $image->getClientOriginalName();
            $attachments = new Invoices_attachments();
            $attachments->file_name = $file_name;
            $attachments->id_invoices = $request->invoice_id;
            $attachments->invoices_number = $request->invoice_number;
            $attachments->createadd = Auth::user()->name;
            $attachments->save();

            // move pic
            $imageName = $request->file_name->getClientOriginalName();
            $request->file_name->move(public_path('Attachments/' . $request->invoice_number), $imageName);
        


        
        session()->flash('add', 'add attachment');
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function show(Invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request)
    {
        $id=Invoices::withTrashed()->where('id',$request->id)->first();
        $id->forceDelete();
        session()->flash('delete', 'delete invoices');
        return redirect('/archinvoices');
    }
}
