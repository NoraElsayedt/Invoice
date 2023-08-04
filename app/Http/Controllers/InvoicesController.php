<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use App\Models\Sections ;
use App\Models\Invoices_attachments;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Invoices_details;
use App\Models\Products;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AddInvoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Exports\InvoicesExport;
use App\Notifications\Addinvoices;
use Maatwebsite\Excel\Facades\Excel;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices=Invoices::all();
        return view('invoices.invoices',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections=Sections::all();
       
        return view('invoices.addinvoices',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Invoices::create([
            
            'invoices_number'=>$request->invoice_number,
            'invoices_Date'=>$request->invoice_Date,
            'due_date'=>$request->Due_date,
            'product'=>$request->product,
            'section_id'=>$request->Section,
            'section'=>$request->Section,
            'Amount_collection'=>$request->Amount_collection,
            'Amount_commision'=>$request->Amount_Commission,
            'discount'=>$request->Discount,
            'rate_vat'=>$request->Rate_VAT,
            'value_vat'=>$request->Value_VAT,
            'total'=>$request->Total,
            'note'=>$request->note,
            'status'=>'not pain',
            'value_status'=>2,
            'user'=>(Auth::User()->name),
           
        ]);
        $invoices_id=Invoices::latest()->first()->id;

        Invoices_details::create([
            'id_invoices'=>$invoices_id,
            'invoices_number'=>$request->invoice_number,
            'product'=>$request->product,
            'section'=>$request->Section,
            'note'=>$request->note,
            'status'=>'not pain',
            'value_status'=>2,
            'user'=>(Auth::User()->name),
           
        ]);

        if ($request->hasFile('pic')) {

            $invoice_id = Invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new Invoices_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoices_number = $invoice_number;
            $attachments->createadd = Auth::user()->name;
            $attachments->id_invoices = $invoice_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }

        // $users=User::first();
        // Notification::send($users, new AddInvoice($invoices_id));
           

        $user = User::get();
        $Invoices=Invoices::latest()->first();
    
       // $user->notify(new Addinvoices($Invoices));
        Notification::send($user, new Addinvoices($Invoices));


        session()->flash('add', 'add invoices');
        return back();



  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice=Invoices::where('id',$id)->first();
        $sections=Sections::all();

        return view('invoices.statusinvoices',compact('invoice','sections'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $invoice=Invoices::where('id',$id)->first();

        $sections=Sections::all();

        return view('invoices.editinvoices',compact('invoice','sections'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $inv=Invoices::where('id',$request->invoices_id)->first();
        $id=Invoices::withTrashed()->where('id',$request->id)->restore();
        $id_page=$request->id_page;
        if(! $id_page==2){
         $inv->update([

            'invoices_number'=>$request->invoice_number,
            'invoices_Date'=>$request->invoice_Date,
            'due_date'=>$request->Due_date,
            'product'=>$request->product,
            'section_id'=>$request->Section,
            'section'=>$request->Section,
            'Amount_collection'=>$request->Amount_collection,
            'Amount_commision'=>$request->Amount_Commission,
            'discount'=>$request->Discount,
            'rate_vat'=>$request->Rate_VAT,
            'value_vat'=>$request->Value_VAT,
            'total'=>$request->Total,
            'note'=>$request->note,
           

         ]);

         session()->flash('edit', 'edit invoices');
         return redirect('/invoices');;
        }
        else{
            session()->flash('move', 'move invoices');
            return redirect('/invoices');
        }
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $inv=Invoices::where('id',$request->id)->first();
        $attachments=  Invoices_attachments::where('id_invoices',$request->id)->first();

        $id_page=$request->id_page;


        if(!$id_page==2){

        if(!empty($attachments->invoices_number)){
          
            Storage::disk('upload')->deleteDirectory($attachments->invoices_number);
        }
        $inv->forceDelete();
        session()->flash('delete', 'delete invoices');
        return redirect('/invoices');
    }
    else{
        $inv->Delete();
        session()->flash('archive', 'delete invoices');
        return redirect('/invoices');
    }
        

    }
    public function getsection($id){
        $products=DB::table('products')->where('section_id',$id)->pluck('product_name','id');
        return json_encode($products);
    }

    public function statusupdate($id, Request $request){

        

        $inv=Invoices::where('id',$id)->first();
        if($request->Status==='paid'){
            $inv->update([

                'value_status'=>1,
                'status'=>$request->Status,
               

            ]);
            Invoices_details::create([
                'id_invoices'=>$request->invoices_id,
                'invoices_number'=>$request->invoice_number,
                'product'=>$request->product,
                'section'=>$request->Section,
                'note'=>$request->note,
                'status'=>$request->Status,
                'value_status'=>1,
                'Payment_Date' => $request->Payment_Date,
                'user'=>(Auth::User()->name),
               
            ]);
           
        }

        else{

            $inv->update([

                'value_status'=>3,
                'status'=>$request->Status,
              

            ]);
            Invoices_details::create([
                'id_invoices'=>$request->invoices_id,
                'invoices_number'=>$request->invoice_number,
                'product'=>$request->product,
                'section'=>$request->Section,
                'note'=>$request->note,
                'status'=>$request->Status,
                'value_status'=>3,
                'Payment_Date' => $request->Payment_Date,
                'user'=>(Auth::User()->name),
               
            ]);
           

        }
        session()->flash('Status_Update');

        return redirect('/invoices');
    }
    public function paidinvoices()
    {
        $invoices=Invoices::where('value_status',1)->get();
        return view('invoices.paidinvoices',compact('invoices'));
    }
    public function haftinvoices()
    {
        $invoices=Invoices::where('value_status',3)->get();
        return view('invoices.haftinvoices',compact('invoices'));
        }
        public function unpaidinvoices()
        {
            $invoices=Invoices::where('value_status',2)->get();
            return view('invoices.unpaidinvoices',compact('invoices'));
            }

            public function archinvoices()
            {
                $invoices=Invoices::onlyTrashed()->get();
                return view('invoices.archinvoices',compact('invoices'));
                }

        public function printinv($id){
            $inv=Invoices::where('id',$id)->first();
            return view('invoices.print',compact('inv'));
        }

        public function export() 
        {
            
            return Excel::download(new InvoicesExport, 'invoices.xlsx');
        } 

        public function MarkAsRead_all(Request $request){
            $markas=auth()->user()->unreadNotifications;
            if($markas){
                $markas->MarkAsRead();
                return back();
            }
            
        }
}
