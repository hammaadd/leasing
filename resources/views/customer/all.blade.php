@extends('layout.main')
@section('title','All Customers')
@section('heading','All Customers')
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
            <h4 class="card-title d-inline-block">All customer's data</h4>
            <a class="btn btn-success btn-sm d-inline-block " href="{{route('customer.add')}}" target="_blank">Add <i class="bi bi-plus"></i></a>
        </div>

        <div class="card-body">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>CNIC</th>
                        <th>Phone</th>
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
          ajax: "{{ route('customers.get') }}",
          columns: [
              {data:'id',name:'Id'},
              {data: 'name', name: 'Name'},
              {data: 'cnic', name: 'CNIC'},
              {data: 'phone', name: 3,},
              {data: 'action', name: 4, orderable: false, searchable: false},
          ]
      });

    });
  </script>
@endsection
