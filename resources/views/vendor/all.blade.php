@extends('layout.main')
@section('title','Vendors')
@section('heading','Vendors')
@section('livewireStyles')
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('livewireScripts')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
@endsection
@section('content')
<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create Vendor</h4>
                </div>

                <div class="card-body">
                    <form action="{{route('vendor.add')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Vendor name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}">
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
                                        <input type="text" class="form-control" id="contact_no" data-inputmask="'mask': '9999-9999999'" name="contact" value="{{old('contact')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    .<div class="form-group">
                                        <label for="shop_name">Shop name</label>
                                        <textarea class="form-control " name="shop_name"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    .<div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea id="address" class="form-control" name="address"></textarea>
                                    </div>
                                </div>
                                    <button class="btn btn-primary" type="submit"><i class="bi bi-plus-square"></i> Add vendor</button>

                            </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All vendors</h4>
                </div>

                <div class="card-body">
                    <table class="table table-hover data-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Shop name</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Ledger #</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
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
<script type="text/javascript">
    $(document).ready(function () {

     var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{route('vendor.get')}}",
          columns: [
              {data:'id',name:0},
              {data: 'name', name: 1},
              {data: 'shop_name', name: 2},
              {data: 'address', name: 3},
              {data: 'contact_no', name: 4},
              {data: 'ledger', name: 5},
              {data: 'action', name: 6, orderable: false, searchable: false},
          ]
      });

    });
  </script>
@endsection
