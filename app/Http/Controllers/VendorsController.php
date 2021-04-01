<?php

namespace App\Http\Controllers;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ledger;
class VendorsController extends Controller
{
  //

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function addView(Request $request){
    $ledgers = Ledger::all();
      return view('vendors.add',compact('ledgers'));
  }

  public function createVendor(Request $request){
    

          $vendor = new Vendor;
          $vendor->name = $request->input('name');
          $vendor->shop_name = $request->input('shop_name');
          $vendor->address =  $request->input('address');
          $vendor->contact_no =  $request->input('contact_no');
          $vendor->ledger =  $request->input('ledger');
          $vendor->created_by=Auth::id();
      $res = $vendor->save();
      if($res){
          $request->session()->flash('success','Vendor created successfully.');
      }else{
          $request->session()->flash('error','Unable to create Vendor. Try again later.');
      }

      return redirect()->route('vendors.add');
      // dd($request);
  }

  public function allvendors(Request $request){
      $vendors = Vendor::all();
      return view('vendors.all',compact('vendors'));
  }

//   public function getVendors(Request $request){
//       if ($request->ajax()) {
//           $data = Vendor::select('id','name','shop_name','address');
//           return DataTables::of($data)
//                   ->addColumn('action', function($row){

//                          $btn = '<a href="'.route('customer.edit',$row).'" class="edit btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil" ></i></a>
//                           <a href="'.route('customer.delete',$row).'" onclick="return confirm(\'Do you really want to delete the customer\');" class="btn btn-danger btn-sm" title="Delete"><i class="bi bi-trash"></i></a>
//                           <a href="view#" class="btn btn-primary btn-sm" title="View"><i class="bi bi-eye"></i></a>';

//                           return $btn;
//                   })
//                   ->make();
//       }


//   }

  public function edit(Request $request , Vendor $vendors){
      if($vendors){
        $ledgers = Ledger::all();
        
         return view('vendors.edit',compact('vendors','ledgers'));
      }
      return back();
  }

  public function update(Request $request, Vendor $vendor){
    $update_vendor = array(
    'name' => $request->input('name'),
    'shop_name' => $request->input('shop_name'),
    'address' =>  $request->input('address'),
    'contact_no' =>  $request->input('contact_no'),
    'ledger' =>  $request->input('ledger'),
);
Vendor::where('id',$vendor->id)->update($update_vendor);
if($res){
    $request->session()->flash('success','Vendor updated successfully.');
}else{
    $request->session()->flash('error','Unable to update Vendor. Try again later.');
}

return redirect()->route('vendors.add');
  }

  public function delete(Request $request , Vendor $vendors){
      if($vendors){
         
        
          $res = $vendors->delete();
          if($res):
              $request->session()->flash('success','Vendor deleted successfully.');
          else:
              $request->session()->flash('error','Unable to delete vendor. Try again later.');
          endif;
      }
      return back();
  }

  
}
