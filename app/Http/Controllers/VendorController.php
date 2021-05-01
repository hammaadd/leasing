<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class VendorController extends Controller
{
    //

    public function index(){

        return view('vendor.all');
    }

    public function add(Request $request){
        $request->validate([
            'name' =>'required',
        ]);

        $ledger = new Ledger();
        $ledger->name = $request->input('name')." -- ".$request->input('shop_name');
        $ledger->type = 'Vendor';
        $ledger->status = 'Clear';
        $ledger->created_by = Auth::id();
        $ledger->save();

        $vendor  = new Vendor();
        $vendor->name = $request->input('name');
        $vendor->shop_name = $request->input('shop_name');
        $vendor->address = $request->input('address');
        $vendor->contact_no = $request->input('contact');
        $vendor->created_by = Auth::id();
        $vendor->ledger = $ledger->id;
        $res = $vendor->save();

        if($res){
            $request->session()->flash('success','Vendor created successfully.');
        }else{
            $request->session()->flash('error','Unable to create vemdor. Try again later.');
        }

        return back();

    }


    public function getVendors(Request $request){
        if ($request->ajax()) {
            $data = Vendor::all();
            return DataTables::of($data)
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('vendor.delete',$row).'" onclick="return confirm(\'Do you really want to delete the vendor?\');" class="btn btn-danger btn-sm" title="Delete"><i class="bi bi-trash"></i></a>
                            <a href="'.route('vendor.edit',$row).'" title="Edit vendor" class="btn btn-warning btn-sm"><i class="bi bi-pen"></i></a>';

                            return $btn;
                    })
                    ->addColumn('ledger', function($row){
                        $btn = '<a href="'.route('ledger.details',$row->ledger).'" title="View ledger">'.$row->ledger.'</a>';
                        return $btn;
                    })
                    ->rawColumns(['action','ledger'])
                    ->make(true);
        }


    }

    public function editVendor(Request $request,Vendor $vendor){

        return view('vendor.edit',compact('vendor'));
    }

    public function updateVendor(Request $request, Vendor $vendor){
        $request->validate([
            'name' =>'required',
        ]);

        $vendor->name = $request->input('name');
        $vendor->shop_name = $request->input('shop_name');
        $vendor->address = $request->input('address');
        $vendor->contact_no = $request->input('contact');
        $vendor->created_by = Auth::id();
        $res = $vendor->update();

        if($res){
            $request->session()->flash('success','Vendor updated successfully.');
        }else{
            $request->session()->flash('error','Unable to update vendor. Try again later.');
        }

        return back();
    }

    public function deleteVendor(Request $request,Vendor $vendor){

        $res= $vendor->delete();

        if($res){
            $request->session()->flash('success','Vendor deleted successfully.');
        }else{
            $request->session()->flash('error','Unable to delete vendor. Try again later.');
        }

        return back();
    }

    public function dataAjax(Request $request)
    {
    	$data = [];

        if($request->has('q')){
            $search = $request->q;
            $data =Vendor::select("id","name","shop_name")
            		->where('name','LIKE',"%$search%")
            		->get();
        }else{
            $search = $request->q;
            $data =Vendor::select("id","name","shop_name")
            		->where('name','LIKE',"%$search%")
            		->latest()->limit(10)->get();
        }
        return response()->json($data);
    }

}
