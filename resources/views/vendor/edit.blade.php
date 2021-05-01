@extends('layout.main')
@section('title','Update Vendor')
@section('heading','Update Vendor')
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">

            <h4 class="card-title"><a class="btn btn-secondary btn-sm mr-2" title="Go back" href="{{route('vendor.all')}}"><i class="bi bi-arrow-left"></i>Go back</a> Update Vendor</h4>
        </div>

        <div class="card-body">
            <form action="{{route('vendor.update',$vendor)}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Vendor name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$vendor->name}}">
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
                            <label for="phone_no">Contact #</label>
                            <input type="text" class="form-control" id="contact_no" data-inputmask="'mask': '9999-9999999'" name="contact" value="{{$vendor->contact_no}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        .<div class="form-group">
                            <label for="shop_name">Shop name</label>
                            <textarea class="form-control " name="shop_name">{{$vendor->shop_name}}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        .<div class="form-group">
                            <label for="address">Address</label>
                            <textarea id="address" class="form-control" name="address">{{$vendor->address}}</textarea>
                        </div>
                    </div>
                        <button class="btn btn-primary" type="submit"><i class="bi bi-plus-square"></i> Update vendor</button>

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
