@extends('layout.main')
@section('title','Add leasing info')
@section('heading','Add leasing info')
@section('livewireStyles')
@endsection
@section('content')
<style>
@media print {
    #instPlan {
        background-color: white;
        height: 100%;
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        margin: 0;
        padding: 15px;
        font-size: 14px;
        line-height: 18px;
    }
}</style>
<section class="section">
    <div class="card">


        <div class="card-body">
            <form action="{{route('leasing.create')}}" method="POST">
                @csrf
                    <fieldset>
                        <legend>Leasing information</legend>
                        <div class="row">
                            <div class="col-md-3 col-12">
                                <label for="date">Date</label>
                                <input class="form-control" type="date" name="date" id="date" value="{{date('Y-m-d')}}">
                            </div>
                            <div class="col-md-2 col-12">
                                <label for="acc">Acc#</label>
                                <input class="form-control" type="number" name="acc" id="acc" >
                            </div>
                            <div class="col-md-4 col-12">
                                <label for="customer">Customer</label>
                                <select class="form-control customer" id="customer" name="customer" required>
                                    <option></option>
                                </select>
                                <div class="d-flex justify-content-end">
                                    <button type="button" onclick="addCustomer()" class="btn btn-success btn-sm mt-1">Add Customer</button>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <label for="product">Product</label>
                                <select class="form-control product" id="product" name="product" required>
                                    <option></option>
                                </select>
                                <div class="d-flex justify-content-end">
                                    <button type="button" onclick="addProduct()" class="btn btn-success btn-sm mt-1">Add Product</button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Customer Information</legend>
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="name">Name of customer</label>
                                    <input type="text" class="form-control" id="name" disabled>

                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="CNIC">CNIC</label>
                                    <input type="text" class="form-control" id="cnic"  required data-inputmask="'mask': '99999-9999999-9'" disabled>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <input type="text" class="form-control" id="gender" disabled>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="father">Father / Husband</label>
                                    <input type="text" class="form-control" id="father" disabled>
                                </div>
                            </div>


                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="phone_no">Phone #</label>
                                    <input type="text" class="form-control" id="phone_no" data-inputmask="'mask': '9999-9999999'" disabled>
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="phone_no">Office #</label>
                                    <input type="text" class="form-control" id="office_no" disabled>
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="profession">Profession</label>
                                    <input type="text" class="form-control" id="profession" disabled>
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="designation">Designation</label>
                                    <input type="text" class="form-control" id="designation" disabled>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="cast">Cast</label>
                                    <input type="text" class="form-control" id="cast" disabled>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" disabled>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="office_address">Office Address</label>
                                    <input type="text" class="form-control" id="office_address" disabled>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Leasing / Payment / Bank  Information</legend>
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="advance">Advance</label>
                                    <input type="text" class="form-control" id="advance" name="advance" min="0" required value="0">
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="c_price">Current Price</label>
                                    <input type="text" class="form-control" id="c_price" name="c_price" required >
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="tenure" style="display: block !important;">Tenure</label>
                                    <input type="number" class="form-control w-50" id="tenure" name="tenure" onchange="calculateInstallments()" required style="display: inline !important;" >
                                    <select class="form-control" onchange="calculateInstallments()" id="tenure_in" name="tenure_in" required style="display: inline !important; width:40% !important;">
                                        <option value="Years">Years</option>
                                        <option value="Months">Months</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="installment">Monthly Installment</label>
                                    <input type="number" class="form-control" id="installment" name="installment" required >
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="plan">Plan</label>
                                    <select class="form-control" id="plan" name="plan" required onchange="calculateInstallments()">
                                        <option value="Monthly">Monthly</option>
                                        <option value="Daily">Daily</option>
                                        <option value="Weekly">Weekly</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="installment">Total Amount</label>
                                    <input type="number" class="form-control" id="total" name="total" disabled>
                                </div>
                            </div>

                            <div class="col-md-12 col-12 d-flex justify-content-end">
                                    
                                    <button type="button" id="calculate" class="btn btn-success" onclick="calculateInstallments()">Calculate</button>

                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="check_no">Check #</label>
                                    <input type="number" class="form-control" id="check_no" name="check_no"  >
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="bank_name">Bank name</label>
                                    <input type="text" class="form-control" id="bank_name" name="bank_name" >
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="check_amount">Check amount</label>
                                    <input type="number" class="form-control" id="check_amount" name="check_amount"  >
                                </div>
                            </div>
                            <div class="col-md-12 col-12" id="formBtn">
                                
                            </div>
                        </div>

                    </fieldset>
            </form>
            <div class="row">
                {{-- <div class="col-md-12 col-12">
                    <buttton class="btn btn-primary btn-sm" onclick="printDiv()">Print Plan</buttton>
                </div> --}}
                <div class="col-md-12 col-12 d-flex flex-column align-items-center" id="instPlan">
                    <h1>INSTALLMENT PLAN</h1>
                    <table class="table table-bordered">
                        <thead>
                            <th>Sr#</th>
                            <th>Date</th>
                            <th>Installment</th>
                        </thead>
                        <tbody id="planTable">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scriptCode')
<script>
function addCustomer() {
  var newWin = window.open('{{route("customer.add")}}', 'Add Customer', 'width=600,height=400');
}
function addProduct() {
  var newWin = window.open('{{route("product.all")}}', 'Add Product', 'width=600,height=400');
}
function printDiv() {
     var printContents = document.getElementById('instPlan').innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

function calculateInstallments(){
    advance = $('#advance').val();
    cprice = $('#c_price').val();
    tenure = $('#tenure').val();
    date = $('#date').val();
    tenure_in = $('#tenure_in').val();
    plan = $('#plan').val();
    if(advance >=0 && cprice > 0 && tenure > 0){
        $.ajax({
            url:'{{route("installment.plan")}}',
            method:'GET',
            dataType:'json',
            data:{advance:advance, cprice:cprice, tenure:tenure, date:date,tenure_in:tenure_in, plan:plan},
            success:function (data){
            html ='';
            ins_info = data[0];
            ins = data[1] ;

            for(i=0;i<ins.length;i++){
                item = ins[i];
                html+=`<tr>
                        <th>${i+1}</th>
                        <th>${item.date}</th>
                        <th>${ins_info.installment}</th>
                    </tr>`;
            }
            $('#total').val(ins_info.total_installment);
            $('#installment').val(ins_info.installment);
            $('#formBtn').html('<button class="btn btn-primary btn-sm" type="submit">Add Leasing Info</button>');
            $('#planTable').html(html);
            toastr.success("Installment Plan Calculated Successfully");
        }
        });
    }else{
        toastr.error("Please add advance payment , Current price, Or Tenure information");
    }
}
$(document).ready(function() {
  $('.customer').select2({
  placeholder: 'Select customer',
  ajax: {
    url: '{{route("customer.selectAjax")}}',
    dataType: 'json',
    delay: 250,
    processResults: function (data) {
      return {
        results:  $.map(data, function (item) {
              return {
                  text: item.name+' || '+item.cnic,
                  id: item.id
              }
          })
      };
    },
    complete:function(xhr,status){

    },
    cache: true
  }
});

$('.product').select2({
  placeholder: 'Select product',
  ajax: {
    url: '{{route("product.selectAjax")}}',
    dataType: 'json',
    delay: 250,
    processResults: function (data) {
      return {
        results:  $.map(data, function (item) {
              return {
                  text: item.name,
                  id: item.id
              }
          })
      };
    },
    complete:function(xhr,status){

    },
    cache: true
  }
});

$(".product").on('change',function(){
    product_id = $('.product').find(':selected').val();
    $.ajax({
        url:'{{route("product.getProductById")}}',
        dataType:'json',
        method:'GET',
        data:{id:product_id},
        success: function (data) {

            $("input[name='c_price']").val(data.sale_price);

        }
    });
});



//Will be called when customer is selected
$(".customer").on('change',function(){
    id = $('.customer').find(':selected').val();
    $.ajax({
        url:'{{route("customer.getCustomerById")}}',
        dataType:'json',
        method:'GET',
        data:{id:id},
        success: function (data) {
            $('#name').val(data.name);
            $('#cnic').val(data.cnic);
            $('#gender').val(data.gender);
            $('#father').val(data.father);
            $('#phone_no').val(data.phone);
            $('#office_no').val(data.office);
            $('#profession').val(data.profession);
            $('#designation').val(data.designation);
            $('#cast').val(data.cast);
            $('#address').val(data.address);
            $('#office_address').val(data.address_office);

        }
    });
});
});
</script>
@endsection
