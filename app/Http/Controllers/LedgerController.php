<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Models\LedgerDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class LedgerController extends Controller
{
    //

    public function index(Request $request){

        return view('ledger.all');
    }

    public function add(Request $request){
        $request->validate([
            'name' =>'required',
            'type' =>'required'
        ]);

        $ledger = new Ledger;
        $ledger->name = $request->input('name');
        $ledger->type = $request->input('type');
        $ledger->status = 'Clear';
        $ledger->created_by = Auth::id();
        $res = $ledger->save();

        if($res){
            $request->session()->flash('success','Ledger created successfully.');
        }else{
            $request->session()->flash('error','Unable to create Ledger. Try again later.');
        }

        return back();

    }

    public function getLedgers(Request $request){
        if ($request->ajax()) {
            $data = Ledger::all();
            return DataTables::of($data)
                    ->addColumn('details',function($row){
                        if($row->status=='Jamah'){
                            $status = 'جمع';
                        }elseif($row->status=='Name'){
                            $status = 'نام';
                        }else{
                            $status = 'Clear';
                        }
                        $detail = '<div class="card">
                        <div class="card-body">
                            <ul>
                                <li>Ledger name : '.$row->name.'</li>
                                <li>Type : '.$row->type.'</li>
                                <li>Status : '.$status.'</li>
                            </ul>
                        </div>
                    </div>';
                    return $detail;
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a href="" onclick="return confirm(\'Do you really want to delete the ledger?\');" class="btn btn-danger btn-sm" title="Delete"><i class="bi bi-trash"></i></a>
                            <a href="'.route('ledger.details',$row).'" title="View Ledger" class="btn btn-primary btn-sm" title="View"><i class="bi bi-eye"></i></a>';

                            return $btn;
                    })
                    ->rawColumns(['details','action'])
                    ->make(true);
        }


    }

    public function getLedgerEntries(Request $request,$id){
        if ($request->ajax()) {
            $data = LedgerDetail::where('ledger_no','=',$id)->get();
            return DataTables::of($data)
                ->addColumn('j_amount',function($row){
                    if($row->type == 'Jamah'){
                        return $row->amount;
                    }else{
                        return 0;
                    }
                })
                ->addColumn('n_amount',function($row){
                    if($row->type == 'Name'){
                        return $row->amount;
                    }else{
                        return 0;
                    }
                })

                    ->make(true);
        }
    }

    public function ledgerDetails(Request $request, Ledger $ledger){

        return view('ledger.details',compact('ledger'));
    }

    public function addEntry(Request $request,Ledger $ledger){
        $request->validate([
            'amount'=>'required',
            'type'=>'required',
        ]);

        if($request->input('type') == 'Jamah'){
            $ledger->j_amount = $ledger->j_amount+$request->input('amount');
        }elseif($request->input('type') == 'Name'){
            $ledger->n_amount = $ledger->n_amount+$request->input('amount');
        }
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

        $detail->ledger_no = $ledger->id;
        $detail->type = $request->input('type');
        $detail->status = $ledger->status;
        $detail->amount = $request->input('amount');
        $detail->description = $request->input('description');
        $detail->created_by = Auth::id();
        $res  = $detail->save();
        if($res){
            $request->session()->flash('success','Ledger Updated successfully.');
        }else{
            $request->session()->flash('error','Unable to update Ledger. Try again later.');
        }

        return back();

        }

    }
