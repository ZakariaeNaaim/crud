<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     //   $product = Product::all();
     $products = Product::latest()->paginate(4);
       return view('product.index', compact('products'));
    }

    public function trashedProducts()
    {
    //  $products = Product::withTrashed()->latest()->paginate(4);
    $products = Product::onlyTrashed()->latest()->paginate(4);
       return view('product.trash', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'detail'=>'required'
        ]);

        $product = Product::create($request->all());
         return redirect()->route('products.index')
         ->with('success','product added successfully') ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'))  ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'))  ;
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'detail'=>'required'
        ]);

        $product->update($request->all());
         return redirect()->route('products.index')
         ->with('success','product updated successfully') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
        ->with('success','product deleted successfully') ;
    }


    public function softDelete(  $id)
    {

        $product = Product::find($id)->delete();  // sir database o9alab 3la product b id oli lqitih mas7o
        return redirect()->route('products.index')
        ->with('success','product deleted successfully') ;
    }

    public function  deleteForEver(  $id)
    {
//kayna function smiytha withtrashed t afficher lik kulshy om3aha li mamso7in
        $product = Product::onlyTrashed()->where('id' , $id)->forceDelete();   //hadi t afficher lik li trashed
        return redirect()->route('product.trash')
        ->with('success','product deleted successfully') ;
    }


    public function backFromSoftDelete(  $id)
    {


        $product = Product::onlyTrashed()->where('id' , $id)->first()->restore() ;
      //  dd($product);

        return redirect()->route('products.index')
        ->with('success','product restored successfully') ;
    }


}
