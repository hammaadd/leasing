@extends('layout.main')
@section('title','All Products')
@section('heading','All Products')
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
            <h4 class="card-title d-inline-block">All 's data</h4>
            <a class="btn btn-success btn-sm d-inline-block " href="{{url('products/add')}}" target="_blank">Add <i class="bi bi-plus"></i></a>
        </div>

        <div class="card-body">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>Sr</th>
                        <th>Product Name</th>
                        <th>Purchase Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->purchase_price}}</td>
                            <td>
                                <a href="{{url('products/edit/'.$product->id)}}" class="btn btn-info"><i class="bi bi-pencil"></i></a>
                                <a href="{{url('products/delete/'.$product->id)}}" class="btn btn-danger"><i class="bi bi-trash"></i></a>
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
              {data: 'cnic', name: 'CNIC'},
              {data: 'phone', name: 3,},
              {data: 'action', name: 4, orderable: false, searchable: false},
          ]
      });

    });
  </script> --}}
@endsection
