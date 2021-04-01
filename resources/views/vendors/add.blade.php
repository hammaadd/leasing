@extends('layout.main')
@section('title','Add Vendor')
@section('heading','Add Vendor')
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Vendor form</h4>
        </div>

        <div class="card-body">
            <form action="{{route('create.vendor')}}" method="POST" enctype="multipart/form-data">
                <div class="row">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name of Vendor</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="CNIC">Shop Name</label>
                            <input type="text" class="form-control @error('shop_name') is-invalid @enderror" id="shop_name" name="shop_name" required  value="{{old('shop_name')}}">
                            @error('cnic')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gender">Address</label>
                            <input type="text" class="form-control" name="address">
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="father">Contact No </label>
                            <input type="text" class="form-control" id="contact_no" name="contact_no" value="{{old('contact_no')}}" data-inputmask="'mask': '9999-9999999'">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="father">Ledger </label>
                            <select name="ledger" id="" class="form-control">
                                <option value="">Select Ledger</option>
                                @foreach ($ledgers as $ledger)
                                    <option value="{{$ledger->id}}">{{$ledger->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    
                    <button class="btn btn-primary" type="submit"><i class="bi bi-plus-square"></i> Save Vendor record</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@section('scriptCode')
<script src="{{asset('assets/inputmask/dist/jquery.inputmask.js')}}"></script>
<script>
    $(document).ready(function(){
  $(":input").inputmask();

});
</script>
@endsection