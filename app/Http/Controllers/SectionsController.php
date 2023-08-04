<?php

namespace App\Http\Controllers;

use App\Models\Sections;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DB;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
   
    $this->middleware('permission:add section', ['only' => ['index','create','store']]);
    $this->middleware('permission:edit section', ['only' => ['edit','update']]);
    $this->middleware('permission:delete section', ['only' => ['destroy']]);
    }



    public function index()
    {
        $sections=Sections::all();
        return view('invoices.department',compact('sections'));
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


        $validated = $request->validate([
            'section_name' => 'required|unique:sections|max:999',
            'description' => 'required',
        ]);

        // $input=$request->all();
        // $bexists= Sections::Where('section_name','=',$input['section_name'])->exists();
        // if($bexists){

        //     session()->flash('Error',"error section");
        //     return redirect('/department');
        // }
        // else{
            Sections::create([
            
                'section_name'=>$request->section_name,
                'description'=>$request->description,
                'createadd'=>(Auth::User()->name),
               
            ]);

        // }

        session()->flash('add',"add section");
        return redirect('/department');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(Sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(Sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request)
    {
        $id=$request->id;
        $validated = $request->validate([
            'section_name' => 'required|unique:sections,section_name',$id,
            'description' => 'required',
        ]);
        $sec=Sections::find($id);
        $sec->update([
            'section_name'=>$request->section_name,
            'description'=>$request->description,
            
           
        ]);

    

    session()->flash('edit',"edit section");
    return redirect('/department');
            
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->id;
      
        $sec=Sections::find($id)->delete();
     

    

    session()->flash('delete',"delete section");
    return redirect('/department');
            
       
    }
}
