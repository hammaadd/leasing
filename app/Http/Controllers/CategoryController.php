<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $categories = Category::all();
        return view('categories/all',['categories'=>$categories]);
    }
    public function create()
    {
        return view('categories/add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:categories',
            
        ]);
        $category = new Category;
        $category->name = $request->input('name');
        $category->type = $request->input('type');
        $category->created_by = Auth::id();
        $res = $category->save();
        if($res){
            $request->session()->flash('success','Category created successfully.');
        }else{
            $request->session()->flash('error','Unable to create Category. Try again later.');
        }

        return redirect('category/all');
    }
    public function edit($id)
    {
        $categories = Category::find($id);
        return view('categories/edit',['categories'=>$categories]);
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=>'required'
            
        ]);
       $update_category = array(
        'name' => $request->input('name'),
        'type' => $request->input('type'),
      
       );
       $res = Category::where('id',$id)->update($update_category);
        if($res){
            $request->session()->flash('success','Category updated successfully.');
        }else{
            $request->session()->flash('error','Unable to update Category. Try again later.');
        }

        return redirect('category/all');
    
    }
    public function delete($id, Request $request)
    {
        $res = Category::where('id',$id)->delete();
        if($res){
            $request->session()->flash('success','Category deleted successfully.');
        }else{
            $request->session()->flash('error','Unable to delete Category. Try again later.');
        }

        return redirect('category/all');
    }
}
