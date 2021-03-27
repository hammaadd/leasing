@extends('layout.main')
@section('title','Categories')
@section('heading','Categories')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Categories</h4>
                </div>

                <div class="card-body">
                    <form action="{{url('category/store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                    <div class="form-group">
                                        <label for="name">Type</label>
                                       <select name="type" id="" class="form-control">
                                           <option value="Product">Product</option>
                                       </select>
                                    </div>
                                <button class="btn btn-primary btn-block" type="submit"><i class="bi bi-plus-square"></i> Create</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Categories</h4>
                </div>

                <div class="card-body">
                    <table class="table table-hover data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->type}}</td>
                                    <td>
                                        <a href="{{url('category/edit/'.$category->id)}}" class="btn btn-info btn-sm"><i class="bi bi-pencil"></i></a>
                                        <a href="{{url('category/delete/'.$category->id)}}" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
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
@endsection
@section('scriptCode')
<script>

</script>
@endsection
