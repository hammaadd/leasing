<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class CustomerController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addView(Request $request){
        return view('customer.add');
    }

    public function createCustomer(Request $request){
        $request->validate([
            'name'=>'required',
            'cnic'=>'required|unique:customers',
        ]);

        $data = array(
            'name'=>$request->input('name'),
            'cnic'=>$request->input('cnic'),
            'gender'=>$request->input('gender'),
            'father'=>$request->input('father'),
            'phone'=>$request->input('phone'),
            'office'=>$request->input('office'),
            'profession'=>$request->input('profession'),
            'designation'=>$request->input('designation'),
            'created_by'=>Auth::id()
        );
        $res = Customer::create($data);
        if($res){
            $request->session()->flash('success','Customer created successfully.');
        }else{
            $request->session()->flash('error','Unable to create customer. Try again later.');
        }

        return redirect()->route('customer.add');
        // dd($request);
    }

    public function allCustomers(Request $request){
        return view('customer.all');
    }

    public function getCustomers(Request $request){
        if ($request->ajax()) {
            $data = Customer::select('id','name','cnic','phone');
            return DataTables::of($data)
                    ->addColumn('action', function($row){

                           $btn = '<a href="'.route('customer.edit',$row).'" class="edit btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil" ></i></a>
                            <a href="'.route('customer.delete',$row).'" onclick="return confirm(\'Do you really want to delete the customer\');" class="btn btn-danger btn-sm" title="Delete"><i class="bi bi-trash"></i></a>
                            <a href="view#" class="btn btn-primary btn-sm" title="View"><i class="bi bi-eye"></i></a>';

                            return $btn;
                    })
                    ->make();
        }


    }

    public function edit(Request $request , Customer $customer){
        if($customer){
           return view('customer.edit',compact('customer'));
        }
        return back();
    }

    public function update(Request $request, Customer $customer){
        if($customer){
            $res = $customer->update($request->all());
            if($res):
                $request->session()->flash('success','Customer updated successfully.');
            else:
                $request->session()->flash('error','Unable to update customer. Try again later.');
            endif;
        }
        return back();
    }

    public function delete(Request $request , Customer $customer){
        if($customer){
            $res = $customer->delete();
            if($res):
                $request->session()->flash('success','Customer deleted successfully.');
            else:
                $request->session()->flash('error','Unable to delete customer. Try again later.');
            endif;
        }
        return back();
    }
}
