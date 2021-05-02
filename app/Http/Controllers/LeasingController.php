<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Leasing;
use App\Models\LeasingDetail;
use App\Models\Ledger;
use App\Models\LedgerDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Object_;
use stdClass;
use Yajra\DataTables\DataTables;

class LeasingController extends Controller
{
    //

    public function add(Request $request){

        return view('leasing.add');
    }

    public function installmentPlan(Request $request){
        $ret = array();
        $advance = $request->advance;
        $tenure = $request->tenure;
        $tenure_in = $request->tenure_in;
        $date = $request->date;
        $cprice = $request->cprice;
        $plan = $request->plan;
        $total = $cprice - $advance;
        $total_installment = $advance;
        if($tenure_in == 'Years'){
            $months = $tenure * 12;
        }elseif($tenure_in == 'Months'){
            $months = $tenure;
        }
        $data = new stdClass();
            $data->plan = $plan;
            $data->total = $total;
            $data->advance = $advance;
            $data->tenure = $tenure;
            $data->tenure_in = $tenure_in;
        if($plan == 'Monthly'){
            $date_n =  Carbon::parse($date);
            // $installment = ceil(intval($total/$months) / 10) * 10;
            $installment = intval($total/$months);
            $data->plan_time = $months;
            $data->installment = $installment;
            $data->total_installment = $total_installment+($installment * $months);
            $ret[0]= $data;
            for($i=0;$i<$months;$i++){
                $date_n->addMonthsNoOverflow();
                $data = new stdClass();
                $data->date = $date_n->toDateString();
                $ret[1][]=$data;
            }

            $date_n = null;
        }elseif($plan == 'Weekly'){
            $weeks = intval($months * 4.33);
            $date_n =  Carbon::parse($date);
            // $installment = ceil(intval($total/$weeks) / 10) * 10;
            $installment = intval($total/$weeks);
            $data->plan_time = $weeks;
            $data->installment = $installment;
            $data->total_installment = $total_installment+($installment * $months);
            $ret[0]= $data;
            for($i=0;$i<$weeks;$i++){
                $date_n->addWeeks();
                $data = new stdClass();
                $data->date = $date_n->toDateString();
                $ret[1][]=$data;
            }

            $date_n = null;
        }elseif($plan == 'Daily'){
            $days = intval($months * 30);
            $date_n =  Carbon::parse($date);

            // $installment = ceil(intval($total/$days)/5)*5;
            $installment = intval($total/$days);
            $data->plan_time = $days;
            $data->installment = $installment;
            $data->total_installment = $total_installment+($installment * $months);
            $ret[0]= $data;
            for($i=0;$i<$days;$i++){
                $date_n->addDays();
                $data = new stdClass();
                $data->date = $date_n->toDateString();
                $ret[1][]=$data;
            }

            $date_n = null;
        }


       echo json_encode($ret);
    }

    // public function getInstallmentPlan($data[]){
        
    // }

    public function createLeasing(Request $request){
        
        $ret = array();
        $advance = $request->advance;
        $tenure = $request->tenure;
        $tenure_in = $request->tenure_in;
        $date = $request->date;
        $cprice = $request->c_price;
        $plan = $request->plan;
        $total = $cprice - $advance;
        $total_installment = $advance;
        if($tenure_in == 'Years'){
            $months = $tenure * 12;
        }elseif($tenure_in == 'Months'){
            $months = $tenure;
        }
        $data = new stdClass();
            $data->plan = $plan;
            $data->total = $total;
            $data->advance = $advance;
            $data->tenure = $tenure;
            $data->tenure_in = $tenure_in;
        if($plan == 'Monthly'){
            $date_n =  Carbon::parse($date);
            // $installment = ceil(intval($total/$months) / 10) * 10;
            $installment = intval($total/$months);
            $data->plan_time = $months;
            $data->installment = $installment;
            $data->total_installment = $total_installment+($installment * $months);
            $ret[0]= $data;
            for($i=0;$i<$months;$i++){
                $date_n->addMonthsNoOverflow();
                $data = new stdClass();
                $data->date = $date_n->toDateString();
                $ret[1][]=$data;
            }

            $date_n = null;
        }elseif($plan == 'Weekly'){
            $weeks = intval($months * 4.33);
            $date_n =  Carbon::parse($date);
            // $installment = ceil(intval($total/$weeks) / 10) * 10;
            $installment = intval($total/$weeks);
            $data->plan_time = $weeks;
            $data->installment = $installment;
            $data->total_installment = $total_installment+($installment * $months);
            $ret[0]= $data;
            for($i=0;$i<$weeks;$i++){
                $date_n->addWeeks();
                $data = new stdClass();
                $data->date = $date_n->toDateString();
                $ret[1][]=$data;
            }

            $date_n = null;
        }elseif($plan == 'Daily'){
            $days = intval($months * 30);
            $date_n =  Carbon::parse($date);

            // $installment = ceil(intval($total/$days)/5)*5;
            $installment = intval($total/$days);
            $data->plan_time = $days;
            $data->installment = $installment;
            $data->total_installment = $total_installment+($installment * $months);
            $ret[0]= $data;
            for($i=0;$i<$days;$i++){
                $date_n->addDays();
                $data = new stdClass();
                $data->date = $date_n->toDateString();
                $ret[1][]=$data;
            }

            $date_n = null;
            
        }
        // dd($ret);

        DB::beginTransaction();

        try {
            //Add to leasing
            $id = DB::table('leasings')->insertGetId([
                'date' => $request->date,
                'acc_no'=>$request->acc,
                'customer_id'=>$request->customer,
                'product_id'=>$request->product,
                'advance'=>$request->advance,
                'current_price'=>$request->c_price,
                'total'=>$ret[0]->total_installment,
                'tenure'=>$request->tenure,
                'tenure_in'=>$request->tenure_in,
                'installment'=>$request->installment,
                'plan'=>$request->plan,
                'check'=>$request->check_no,
                'bank_name'=>$request->bank_name,
                'check_amount'=>$request->check_amount,
                'created_by'=>Auth::id()
            ]);
            $installments = $ret[1];
            for($i=0;$i<count($installments);$i++){
                DB::table('leasing_details')->insert([
                    'leasing_id'=>$id,
                    'date'=>$installments[$i]->date,
                    'created_by'=>Auth::id()
                ]);
            }

            $customer = Customer::find($request->customer);
            $ledger = Ledger::find($customer->ledger);
            $ledger->n_amount = $ledger->n_amount+$ret[0]->total_installment;
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

            DB::table('ledger_details')->insert([
                'ledger_no'=>$ledger->id,
                'type'=>'Name',
                'status'=>$ledger->status,
                'amount'=>$ret[0]->total_installment,
                'description'=>'Product given on installment (Lease Id '.$id.')',
                'created_by'=>Auth::id()
            ]);

            if($request->advance > 0){
                $ledger = Ledger::find($customer->ledger);
                $ledger->j_amount = $ledger->j_amount+$request->advance;
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

                DB::table('ledger_details')->insert([
                    'ledger_no'=>$ledger->id,
                    'type'=>'Jamah',
                    'status'=>$ledger->status,
                    'amount'=>$request->advance,
                    'description'=>'Advance paid for installment (Lease Id '.$id.')',
                    'created_by'=>Auth::id()
                ]);
            }
            
            DB::table('products')->where('id','=',$request->product)->update(['in_stock'=>'0']);
            

            DB::commit(); 
            $request->session()->flash('success','Leasing Form Data Added Successfully.');
            return back();
            
        } catch (\Exception $e) {
            DB::rollback();
            $request->session()->flash('error','Unable to add leasing data try later.');
            
        }
        return back();


    }

    public function invoice(){
        return view('leasing.leaseinvoice');
    }

    public function all(Request $request){

        return view('leasing.all');
    }

    public function getLeasing(Request $request){
        if ($request->ajax()) {
            $data = Leasing::all();
            return DataTables::of($data)
                    ->addColumn('customer', function($row){

                           $dt = '<a href="'.route('customer.all').'">'.$row->customer->name.'</a>';

                            return $dt;
                    })
                    ->addColumn('product', function($row){

                        $dt = '<a href="'.route('product.all').'">'.$row->product->name.'</a>';

                         return $dt;
                    })
                    ->addColumn('tenure_t', function($row){

                        $dt = $row->tenure.' '.$row->tenure_in;

                         return $dt;
                    })
                    ->addColumn('action', function($row){

                        $dt = '<a class="btn btn-primary btn-sm" href="'.route('leasing.view',$row).'" title="View Leasing Details"><i class="bi bi-eye"></i></a>
                        <a class="btn btn-warning btn-sm" href="'.route('leasing.edit',$row).'" title="Edit Leasing Application"><i class="bi bi-pen"></i></a>
                        <a class="btn btn-danger btn-sm" href="#" title="Delete this leasing." onclick="return confirm(\'Do you really want to delete this data\');"><i class="bi bi-trash"></i></a>';

                         return $dt;
                    })
                    ->rawColumns(['customer','product','tenure_t','action'])
                    ->make(true);
        }
    }

    public function view(Request $request, Leasing $leasing){

        return view('leasing.leaseinvoice',compact('leasing'));
    }

    public function edit(Request $request, Leasing $leasing){


        return view('leasing.edit',compact('leasing'));
    }
    public function update(Request $request, Leasing $leasing)
    {
        
        $ret = array();
        $advance = $request->advance;
        $tenure = $request->tenure;
        $tenure_in = $request->tenure_in;
        $date = $request->date;
        $cprice = $request->c_price;
        $plan = $request->plan;
        $total = $cprice - $advance;
        $total_installment = $advance;
        if($tenure_in == 'Years'){
            $months = $tenure * 12;
        }elseif($tenure_in == 'Months'){
            $months = $tenure;
        }
        $data = new stdClass();
            $data->plan = $plan;
            $data->total = $total;
            $data->advance = $advance;
            $data->tenure = $tenure;
            $data->tenure_in = $tenure_in;
        if($plan == 'Monthly'){
            $date_n =  Carbon::parse($date);
            // $installment = ceil(intval($total/$months) / 10) * 10;
            $installment = intval($total/$months);
            $data->plan_time = $months;
            $data->installment = $installment;
            $data->total_installment = $total_installment+($installment * $months);
            $ret[0]= $data;
            for($i=0;$i<$months;$i++){
                $date_n->addMonthsNoOverflow();
                $data = new stdClass();
                $data->date = $date_n->toDateString();
                $ret[1][]=$data;
            }

            $date_n = null;
        }elseif($plan == 'Weekly'){
            $weeks = intval($months * 4.33);
            $date_n =  Carbon::parse($date);
            // $installment = ceil(intval($total/$weeks) / 10) * 10;
            $installment = intval($total/$weeks);
            $data->plan_time = $weeks;
            $data->installment = $installment;
            $data->total_installment = $total_installment+($installment * $months);
            $ret[0]= $data;
            for($i=0;$i<$weeks;$i++){
                $date_n->addWeeks();
                $data = new stdClass();
                $data->date = $date_n->toDateString();
                $ret[1][]=$data;
            }

            $date_n = null;
        }elseif($plan == 'Daily'){
            $days = intval($months * 30);
            $date_n =  Carbon::parse($date);

            // $installment = ceil(intval($total/$days)/5)*5;
            $installment = intval($total/$days);
            $data->plan_time = $days;
            $data->installment = $installment;
            $data->total_installment = $total_installment+($installment * $months);
            $ret[0]= $data;
            for($i=0;$i<$days;$i++){
                $date_n->addDays();
                $data = new stdClass();
                $data->date = $date_n->toDateString();
                $ret[1][]=$data;
            }

            $date_n = null;
            
        }
        // dd($ret);

        DB::beginTransaction();

        try {
            //Add to leasing
            $id = DB::table('leasings')
            ->where('id',$leasing->id)
            ->update([
                'date' => $request->date,
                'acc_no'=>$request->acc,
                'advance'=>$request->advance,
                'current_price'=>$request->c_price,
                'total'=>$ret[0]->total_installment,
                'tenure'=>$request->tenure,
                'tenure_in'=>$request->tenure_in,
                'installment'=>$request->installment,
                'plan'=>$request->plan,
                'check'=>$request->check_no,
                'bank_name'=>$request->bank_name,
                'check_amount'=>$request->check_amount,
                'created_by'=>Auth::id()
            ]);
            
            $installments = $ret[1];
            for($i=0;$i<count($installments);$i++){
                DB::table('leasing_details')->insert([
                    'leasing_id'=>$$leasing->id,
                    'date'=>$installments[$i]->date,
                    'created_by'=>Auth::id()
                ]);
            }

            $customer = Customer::find($request->customer);
            $ledger = Ledger::find($customer->ledger);
            $ledger->n_amount = $ledger->n_amount+$ret[0]->total_installment;
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

            DB::table('ledger_details')->insert([
                'ledger_no'=>$ledger->id,
                'type'=>'Name',
                'status'=>$ledger->status,
                'amount'=>$ret[0]->total_installment,
                'description'=>'Product given on installment (Lease Id '.$id.')',
                'created_by'=>Auth::id()
            ]);

            if($request->advance > 0){
                $ledger = Ledger::find($customer->ledger);
                $ledger->j_amount = $ledger->j_amount+$request->advance;
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

                DB::table('ledger_details')->insert([
                    'ledger_no'=>$ledger->id,
                    'type'=>'Jamah',
                    'status'=>$ledger->status,
                    'amount'=>$request->advance,
                    'description'=>'Advance paid for installment (Lease Id '.$id.')',
                    'created_by'=>Auth::id()
                ]);
            }
            
            DB::table('products')->where('id','=',$request->product)->update(['in_stock'=>'0']);
            

            DB::commit(); 
            $request->session()->flash('success','Leasing Form Data Added Successfully.');
            return back();
            
        } catch (\Exception $e) {
            DB::rollback();
            $request->session()->flash('error','Unable to add leasing data try later.');
            
        }
        return back();


    }
}
