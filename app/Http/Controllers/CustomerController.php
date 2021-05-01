<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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

            $customer = new Customer;
            $customer->name=$request->input('name');
            $customer->cnic=$request->input('cnic');
            $customer->gender=$request->input('gender');
            $customer->father=$request->input('father');
            $customer->phone=$request->input('phone');
            $customer->office=$request->input('office');
            $customer->profession=$request->input('profession');
            $customer->designation=$request->input('designation');
            $customer->address=$request->input('address');
            $customer->address_office=$request->input('office_address');
            $customer->cast=$request->input('cast');

            if($request->file('cnic_photo')){
                $img = new Image;
                $file = $request->file('cnic_photo');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $imgname = uniqid() . $filename;
                $destinationPath = public_path('/cnic');
                $file->move($destinationPath, $imgname);
                $img->name = $imgname;
                $img->created_by = Auth::id();
                $img->alt = $request->input('name');
                // $customer->cnic_photo= $imgname;
                $img->save();
                $customer->cnic_image = $img->id;
                }
            

            $customer->created_by=Auth::id();
        $res = $customer->save();
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
        $update_array = array(
            'name'=>$request->input('name'),
            'cnic'=>$request->input('cnic'),
            'gender'=>$request->input('gender'),
            'father'=>$request->input('father'),
            'phone'=>$request->input('phone'),
            'office'=>$request->input('office'),
            'profession'=>$request->input('profession'),
            'designation'=>$request->input('designation'),
            'address'=>$request->input('address'),
            'address_office'=>$request->input('office_address'),
            'cast'=>$request->input('cast'),
        );
       $res = Customer::where('id',$customer->id)->update($update_array);
            if($request->file('cnic_photo')){
                $file = $request->file('cnic_photo');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $imgname = uniqid() . $filename;
                $destinationPath = public_path('/cnic');
                $file->move($destinationPath, $imgname);
                if(null!=$request->input('cnic_image_id')){
                    $imag = Image::find($request->input('cnic_image_id'));
                    $image_path = "cnic/".$imag->name;  // Value is not URL but directory file path
                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                    $res = $imag->delete();
                }
                $img = new Image;
                $img->name = $imgname;
                $img->created_by = Auth::id();
                $img->alt = $request->input('name');
                // $customer->cnic_photo= $imgname;
                $img->save();
                $update_image = array(
                    'cnic_image'=>$img->id,

                    );
                    Customer::where('id',$customer->id)->update($update_image);
                }

            if($res):
                $request->session()->flash('success','Customer updated successfully.');
            else:
                $request->session()->flash('error','Unable to update customer. Try again later.');
            endif;

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

    public function deleteCnicImage(Request $request, $imgId){
        if($imgId){
            $img = Image::find($imgId);
            $image_path = "cnic/".$img->name;  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $res = $img->delete();
            if($res):
                $request->session()->flash('success','CNIC deleted successfully.');
            else:
                $request->session()->flash('error','Unable to delete CNIC. Try again later.');
            endif;
        }else{
            $request->session()->flash('error','Unable to delete CNIC. Try again later.');
        }

        return back();
    }
}
