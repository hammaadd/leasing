@extends('layout.main')
@section('title','Add Product')
@section('heading','Add Product')
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Product form</h4>
        </div>

        <div class="card-body">
            <form action="{{url('products/update/'.$product->id)}}" method="POST" enctype="multipart/form-data">
                <div class="row">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Product Name </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$product->name}}" required>
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
                            <label for="name">Category </label>
                            
                            <select name="category_id"  class="form-control">
                                
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" @if ($category->id==$product->category_id)
                                        selected
                                    @endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Purchase Price </label>
                            <input type="number" class="form-control"  name="purchase_price" value="{{$product->purchase_price}}" min='1' required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Sale Price </label>
                            <input type="number" class="form-control"  name="sale_price" value="{{$product->sale_price}}" min='1' required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Date</label>
                            <input type="date" class="form-control"  name="date" value="{{$product->date}}" required>
                        </div>
                    </div>
                        <button class="btn btn-primary btn-block" type="submit"><i class="bi bi-pencil"></i> Update Product record</button>
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
