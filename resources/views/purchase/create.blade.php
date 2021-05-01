@extends('layout.main')
@section('title','Create Purchase')
@section('heading','Create Purchase')
@section('livewireStyles')
@endsection
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Purchases</h4>
        </div>

        <div class="card-body">
            <form action="{{route('purchase.create')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="date">Purchase Date</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{date('Y-m-d')}}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="date">Vendor</label>
                        <select class="form-control vendors" id="vendors" name="vendors" required>
                            <option></option>
                        </select>
                        <div class="d-flex justify-content-end">
                            <button type="button" onclick="addVendor()" class="btn btn-success btn-sm mt-1">Add Vendor</button>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <label for="atp">Add to product</label>
                        <select class="form-control" name="atp" >
                            <option value="1" selected>Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="date">Product</label>
                        <select class="form-control products" id="products" name="products" required>
                            <option></option>
                        </select>
                        <div class="d-flex justify-content-end">
                            <button type="button" onclick="addProduct()" class="btn btn-success btn-sm mt-1">Add Product</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="price">Purchase Price</label>
                        <input type="number" name="pprice" id="pprice" oninput="setTotalValue()" class="form-control" min="0" required >
                    </div>
                    <div class="col-md-4">
                        <label for="sprice">Sale Price</label>
                        <input type="number" name="sprice" id="sprice" class="form-control" min="0" required>
                    </div>
                </div>
                <div class="row d-flex justify-content-end">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="total">Total</label>
                            <input type="number" name="total" id="total" class="form-control" min="0" required >
                        </div>
                        <div class="form-group">
                            <label for="paid">Paid</label>
                            <input type="number" name="paid" id="paid" class="form-control" min="0" required oninput="updateRemaining()">
                        </div>
                        <div class="form-group">
                            <label for="remaining">Remaining</label>
                            <input type="number" name="remaining" id="remaining" class="form-control" min="0" required>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-sm">Create Purchase</button>
                </div>


            </form>
        </div>
    </div>
</section>
@endsection
@section('scriptCode')
<script>
$(document).ready(function() {
  $('.vendors').select2({
  placeholder: 'Select vendor',
  ajax: {
    url: '{{route("vendor.selectAjax")}}',
    dataType: 'json',
    delay: 250,
    processResults: function (data) {
      return {
        results:  $.map(data, function (item) {
              return {
                  text: item.name+' || '+item.shop_name,
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

$('.products').select2({
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
});

function addVendor() {
  var newWin = window.open('{{route("vendor.all")}}', 'Add Vendor', 'width=600,height=400');
}
function addProduct() {
  var newWin = window.open('{{route("product.all")}}', 'Add Product', 'width=600,height=400');
}

function setTotalValue(){
    $('#total').val($("input[name='pprice']").val());
}

function updateRemaining(){
    if($('#total').val()>0 && $('#paid').val()<=$('#total').val()){
        $('#remaining').val($('#total').val()-$('#paid').val());
    }
}

$(".products").on('change',function(){
    product_id = $('.products').find(':selected').val();
    $.ajax({
        url:'{{route("product.getProductById")}}',
        dataType:'json',
        method:'GET',
        data:{id:product_id},
        success: function (data) {
            console.log(data.id);
            $("input[name='sprice']").val(data.sale_price);
            $("input[name='pprice']").val(data.purchase_price);
            setTotalValue();
        }
    });
});




</script>
@endsection
