@extends('layout.main')
@section('title','All Vendors')
@section('heading','All Vendors')
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
            <h4 class="card-title d-inline-block">All Vendor's data</h4>
            <a class="btn btn-success btn-sm d-inline-block " href="{{route('vendors.add')}}" target="_blank">Add <i class="bi bi-plus"></i></a>
        </div>

        <div class="card-body">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Shop Name</th>
                        <th>Address</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vendors as $vendor)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$vendor->name}}</td>
                            <td>{{$vendor->shop_name}}</td>
                            <td>{{$vendor->address}}</td>
                            <td>
                                <a href="{{route('vendors.edit',$vendor)}}" class="btn btn-info btn-xs"> <i class="bi bi-pencil"></i></a>
                                <a href="{{route('vendors.delete',$vendor)}}" class="btn btn-danger btn-xs"><i class="bi bi-trash"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection

@section('scriptCode')
{{-- <script type="text/javascript">
    $(document).ready(function () {

      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('customers.get') }}",
          columns: [
              {data:'id',name:'Id'},
              {data: 'name', name: 'Name'},
              {data: 'shop_name', name: 'Shop Name'},
              {data: 'address', name: 'Address'},
              {data: 'action', name: 4, orderable: false, searchable: false},
          ]
      });

    });
  </script> --}}
@endsection
