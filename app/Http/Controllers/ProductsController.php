<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Sections;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     function __construct()
     {
    
     $this->middleware('permission:add product', ['only' => ['index','create','store']]);
     $this->middleware('permission:edit product', ['only' => ['edit','update']]);
     $this->middleware('permission:delete product', ['only' => ['destroy']]);
     }
 



    public function index()
    {
        $products=Products::all();
        $sections=Sections::all();
    
        return view('invoices.category',compact('sections','products'));
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
            'product_name' => 'required|unique:products|max:999',
            'name'=>'required',
            'description' => 'required',
        ]);

        Products::create([
            
            'product_name'=>$request->product_name,
            'description'=>$request->description,
            'section_id'=>$request->name,
           
        ]);

    // }

    session()->flash('add',"add product");
    return redirect('/category');
}

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id=$request->id;
        $validated = $request->validate([
            'section_name' => 'required|unique:products,product_name',$id,
            'description' => 'required',
        ]);
        $sec=Products::find($id);
        $sec->update([
            'product_name'=>$request->section_name,
            'description'=>$request->description,
            'section_id'=>$request->name
            
           
        ]);

    

    session()->flash('edit',"edit product");
    return redirect('/category');
    
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->id;
      
        $sec=Products::find($id)->delete();
     

    

    session()->flash('delete',"delete section");
    return redirect('/category');
    
 
}
}
