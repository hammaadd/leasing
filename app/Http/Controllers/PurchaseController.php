<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Models\LedgerDetail;
use App\Models\Products;
use App\Models\Purchase;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(Request $request){
        return view('purchase.create');
    }

    public function create(Request $request){
        $purchase = new Purchase;
        $purchase->pdate = $request->date;
        $purchase->vendor_id = $request->vendors;
        $purchase->product_id = $request->products;
        $purchase->total_amount = $request->total;
        $purchase->paid = $request->paid;
        $purchase->remaining = $request->remaining;
        $purchase->save();

        $product = Products::find($request->products);
        if($request->atp == '1'){
            
            $product->purchase_price = $request->pprice;
            $product->sale_price = $request->sprice;
            $product->update();
        }
        $vendor = Vendor::find($purchase->vendor_id);
        if($vendor->ledger > 0){
            $ledger = Ledger::where('id','=',$vendor->ledger)->first();
            $ledger->j_amount = $ledger->j_amount+$purchase->total_amount;
            if($ledger->j_amount > $ledger->n_amount){
                $ledger->status = 'Jamah';
                $ledger->amount = $ledger->j_amount-$ledger->n_amount;
            }elseif($ledger->j_amount < $ledger->n_amount){
                $ledger->status = 'Name';
                $ledger->amount = $ledger->n_amount-$ledger->j_amount;
            }elseif($ledger->j_amount == $ledger->n_amount){
                $ledger->status = 'Clear';
                $ledger->amount = 0;
            }
            $ledger->update();

            $detail = new LedgerDetail;

            $detail->ledger_no = $vendor->ledger;
            $detail->type = 'Jamah';
            $detail->status = $ledger->status;
            $detail->amount = $request->total;
            $detail->description = 'Bill #'.$purchase->id.' on '.$purchase->pdate;
            $detail->created_by = Auth::id();
            $detail->save();

            $ledger = Ledger::where('id','=',$vendor->ledger)->first();
            $ledger->n_amount = $ledger->n_amount+$purchase->paid;
            if($ledger->j_amount > $ledger->n_amount){
                $ledger->status = 'Jamah';
                $ledger->amount = $ledger->j_amount-$ledger->n_amount;
            }elseif($ledger->j_amount < $ledger->n_amount){
                $ledger->status = 'Name';
                $ledger->amount = $ledger->n_amount-$ledger->j_amount;
            }elseif($ledger->j_amount == $ledger->n_amount){
                $ledger->status = 'Clear';
                $ledger->amount = 0;
            }
            $ledger->update();

            $detail = new LedgerDetail;

            $detail->ledger_no = $vendor->ledger;
            $detail->type = 'Name';
            $detail->status = $ledger->status;
            $detail->amount = $request->paid;
            $detail->description = 'Bill #'.$purchase->id.' paid '.$request->paid;
            $detail->created_by = Auth::id();
            $detail->save();


        }

        $ledger = Ledger::where('type','=','Investment')->first();
            $ledger->n_amount = $ledger->n_amount+$purchase->total_amount;
            if($ledger->j_amount > $ledger->n_amount){
                $ledger->status = 'Jamah';
                $ledger->amount = $ledger->j_amount-$ledger->n_amount;
            }elseif($ledger->j_amount < $ledger->n_amount){
                $ledger->status = 'Name';
                $ledger->amount = $ledger->n_amount-$ledger->j_amount;
            }elseif($ledger->j_amount == $ledger->n_amount){
                $ledger->status = 'Clear';
                $ledger->amount = 0;
            }
            $ledger->update();
            $product = Products::find($request->products);

            $detail = new LedgerDetail;

            $detail->ledger_no = $ledger->id;
            $detail->type = 'Name';
            $detail->status = $ledger->status;
            $detail->amount = $purchase->total_amount;
            $detail->description = 'Bought '.$product->name.' on '.$purchase->pdate;
            $detail->created_by = Auth::id();
            $res = $detail->save();
            if($res){
                $request->session()->flash('success','Purchase added successfully.');
            }else{
                $request->session()->flash('error','Unable to add purchase try later.');
            }
            return back();



    }

    public function all(Request $request){

    }


}
