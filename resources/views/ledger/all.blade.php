@extends('layout.main')
@section('title','Ledgers')
@section('heading','Ledgers')
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
                    <h4 class="card-title">Create Ledger</h4>
                </div>

                <div class="card-body">
                    <form action="{{route('ledger.add')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name of ledger</label>
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
                                            <label for="name">Type</label>
                                           <select name="type" id="" class="form-control">
                                               {{-- <option value="Customer">Customer</option>
                                               <option value="Vendor">Vendor</option>
                                               <option value="Investment">Investment</option> --}}
                                               <option value="Other">Other</option>

                                           </select>
                                        </div>

                                </div>

                                    <button class="btn btn-primary" type="submit"><i class="bi bi-plus-square"></i> Create Ledger</button>

                            </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Ledgers</h4>
                </div>

                <div class="card-body">
                    <table class="table table-hover data-table">
                        <thead>
                            <tr>
                                <th>Ledger#</th>
                                <th>Details</th>
                                <th>Amount</th>
                                <th>Jamah</th>
                                <th>Name</th>
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
<script type="text/javascript">
    $(document).ready(function () {

     var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{route('ledger.get')}}",
          columns: [
              {data:'id',name:0},
              {data: 'details', name: 1},
              {data: 'amount', name: 2},
              {data: 'j_amount', name: 3},
              {data: 'n_amount', name: 4},
              {data: 'action', name: 5, orderable: false, searchable: false},
          ]
      });

    });
  </script>
@endsection
