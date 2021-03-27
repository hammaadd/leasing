@extends('layout.main')
@section('title','Edit Category')
@section('heading','Edit Category')
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><a class="btn btn-secondary btn-sm mr-2" title="Go back" href="{{route('category.add')}}"><i class="bi bi-arrow-left"></i>Go back</a>Update Category</h4>
        </div>

        <div class="card-body">
            <form action="{{url('category/update/'.$categories->id)}}" method="POST" enctype="multipart/form-data">
                <div class="row">
                    @csrf
                    <div class="col-md-6 offset-md-3">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$categories->name}}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="type">Type</label>
                               <select name="type" id="" class="form-control">
                                   <option value="Product" @if ($categories->type=='Product')
                                       selected
                                   @endif>Product</option>
                               </select>
                            </div>
                        <button class="btn btn-secondary btn-block" type="submit"><i class="bi bi-plus-square"></i> Update Cateogry record</button>
                    </div>




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
