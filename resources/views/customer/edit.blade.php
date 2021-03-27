@extends('layout.main')
@section('title','Update Customer')
@section('heading','Update Customer')
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><a class="btn btn-sm btn-secondary mx-2" href="{{route('customer.all')}}">Back</a>Customer edit form</h4>
        </div>

        <div class="card-body">
            <form action="{{route('customer.update',$customer)}}" method="POST" enctype="multipart/form-data">
                <div class="row">
                    @csrf
                  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name of customer</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$customer->name}}" required>
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
                            <label for="CNIC">CNIC</label>
                            <input type="text" class="form-control @error('cnic') is-invalid @enderror" id="cnic" name="cnic" required data-inputmask="'mask': '99999-9999999-9'" value="{{$customer->cnic}}">
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
                            <label for="gender">Gender</label>
                            <select class="form-control" name="gender">
                                <option value="Male" @if($customer->gender=='Male') selected @endif>Male</option>
                                <option value="Female" @if($customer->gender=='Female') selected @endif>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="father">Father / Husband</label>
                            <input type="text" class="form-control" id="father" name="father" value="{{$customer->father}}">
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone_no">Phone #</label>
                            <input type="text" class="form-control" id="phone_no" data-inputmask="'mask': '9999-9999999'" name="phone" value="{{$customer->phone}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone_no">Office #</label>
                            <input type="text" class="form-control" id="office_no" name="office" value="{{$customer->office}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="profession">Profession</label>
                            <input type="text" class="form-control" id="profession" name="profession" value="{{$customer->profession}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation" value="{{$customer->designation}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cast">Cast</label>
                            <input type="text" class="form-control" id="cast" name="cast" value="{{$customer->cast}}">
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{$customer->address}}">
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="office_address">Office Address</label>
                            <input type="text" class="form-control" id="office_address" name="office_address" value="{{$customer->address_office}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cnic_photo">CNIC Photo</label>
                            <input type="file" class="form-control" id="cnic_photo" name="cnic_photo" value="{{old('cnic_photo')}}">
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit"><i class="bi bi-plus-square"></i> Save customer record</button>
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
