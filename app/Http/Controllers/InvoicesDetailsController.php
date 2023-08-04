<?php

namespace App\Http\Controllers;

use App\Models\Invoices_details;
use App\Models\Invoices;
use App\Models\Sections ;
use Illuminate\Support\Facades\Storage;
use App\Models\Invoices_attachments;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Products;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class InvoicesDetailsController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function show(Invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoices=Invoices::where('id',$id)->first();
        $invoices_details=Invoices_details::where('id_invoices',$id)->get();
        $invoice=Invoices_attachments::where('id_invoices',$id)->get();
     
        return view('invoices.invoicesdetails',compact('invoices','invoices_details','invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        $invoices = invoices_attachments::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('upload')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('delete', 'delete sucessful');
        return back();
        
    }
    public function open_file($invoices_number,$file_name){
       $st="Attachments";
        $file=public_path($st.'/'.$invoices_number.'/'.$file_name);
        return response()->file($file);
    }
    public function download($invoices_number,$file_name){
        
        $st="Attachments";
        $file=public_path($st.'/'.$invoices_number.'/'.$file_name);
        return response()->download($file);
     }
}
