@extends('layout.main')
@section('title','All Leasing Data')
@section('heading','All Leasing Data')
@section('livewireStyles')
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('livewireScripts')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title d-inline-block">All leasing data</h4>
            <a class="btn btn-success btn-sm d-inline-block " href="{{route('leasing.add')}}" target="_blank">Add <i class="bi bi-plus"></i></a>
        </div>

        <div class="card-body">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Acc#</th>
                        <th>Tenure</th>
                        <th>Plan</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
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
          ajax: "{{ route('leasing.get') }}",
          columns: [
              {data:'id',name:'Id'},
              {data: 'customer', name: 'Customer'},
              {data: 'product', name: 'Product'},
              {data: 'acc_no', name: 3,},
              {data: 'tenure_t', name: 4},
              {data: 'plan', name: 5},
              {data: 'action', name: 6, orderable: false, searchable: false},
          ]
      });

    });
  </script>
@endsection
