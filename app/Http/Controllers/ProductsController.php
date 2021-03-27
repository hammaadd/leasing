<?php

namespace App\Http\Controllers;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Category;

use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $products = Products::all();
        return view('products/all',['products'=>$products]);
    }
    public function create()
    {
        $categories = Category::all();
        
        return view('products/add',['categories'=>$categories]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'category_id' =>'required',
            'purchase_price' =>'required',
            'sale_price' =>'required',
            'date' =>'required',
        ]);
        $products = new Products;
        $products->name = $request->input('name');
        $products->category_id = $request->input('category_id');
        $products->purchase_price = $request->input('purchase_price');
        $products->sale_price = $request->input('sale_price');
        $products->date = $request->input('date');
        $products->created_by = Auth::id();
        $res = $products->save();
        if($res){
            $request->session()->flash('success','Prodcut created successfully.');
        }else{
            $request->session()->flash('error','Unable to create Prodcut. Try again later.');
        }

        return redirect('products/all');
    }
    public function edit($id)
    {
        $categories = Category::all();
        $product = Products::find($id);
        return view('products/edit',['product'=>$product,'categories'=>$categories]);
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=>'required',
            'category_id' =>'required',
            'purchase_price' =>'required',
            'sale_price' =>'required',
            'date' =>'required',
        ]);
        $update_prodcuts = array(
        'name' => $request->input('name'),
        'category_id' => $request->input('category_id'),
        'purchase_price' => $request->input('purchase_price'),
        'sale_price' => $request->input('sale_price'),
        'date' => $request->input('date'),
        
        );
        $res = Products::where('id',$id)->update($update_prodcuts);
        if($res){
            $request->session()->flash('success','Prodcut updated successfully.');
        }else{
            $request->session()->flash('error','Unable to update Prodcut. Try again later.');
        }

       
        return redirect('products/all');
    
    }
    public function delete($id, Request $request)
    {
        $res = Products::where('id',$id)->delete();
        if($res){
            $request->session()->flash('success','Category deleted successfully.');
        }else{
            $request->session()->flash('error','Unable to delete Category. Try again later.');
        }

        return redirect('category/all');
    }
}
