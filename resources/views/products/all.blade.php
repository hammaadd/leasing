@extends('layout.main')
@section('title','Products')
@section('heading','Products')
@section('livewireStyles')
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('livewireScripts')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
@endsection

@section('content')
<section class="section">
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Product</h4>
                </div>

                <div class="card-body">
                    <form action="{{url('products/store')}}" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Product Name </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Category </label>

                                    <select name="category_id"  class="form-control">

                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Purchase Price </label>
                                    <input type="number" class="form-control"  name="purchase_price" value="{{old('purchase_price')}}" min='1' required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Sale Price </label>
                                    <input type="number" class="form-control"  name="sale_price" value="{{old('sale_price')}}" min='1' required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Date</label>
                                    <input type="date" class="form-control"  name="date" value="{{date('Y-m-d')}}" required>
                                </div>

                            </div>
                                <button class="btn btn-primary btn-block" type="submit"><i class="bi bi-plus-square"></i> Save Product Record</button>
                            </div>





                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Products</h4>
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
                                        <a href="{{url('products/edit/'.$product->id)}}" class="btn btn-sm btn-info"><i class="bi bi-pencil"></i></a>
                                        <a href="{{url('products/delete/'.$product->id)}}" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- <section class="section">
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
</section> --}}
@endsection

@section('scriptCode')
 <script type="text/javascript">
    $(document).ready(function () {

     var table = $('.data-table').DataTable({
    //       processing: true,
    //       serverSide: true,
    //       ajax: "{{ route('customers.get') }}",
    //       columns: [
    //           {data:'id',name:'Id'},
    //           {data: 'name', name: 'Name'},
    //           {data: 'cnic', name: 'CNIC'},
    //           {data: 'phone', name: 3,},
    //           {data: 'action', name: 4, orderable: false, searchable: false},
    //       ]
      });

    });
  </script>
@endsection
