@extends('layout.main')
@section('title','Add Category')
@section('heading','Add Category')
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Category form</h4>
        </div>

        <div class="card-body">
            <form action="{{url('category/store')}}" method="POST" enctype="multipart/form-data">
                <div class="row">
                    @csrf
                    <div class="col-md-6 offset-md-3">
                        <div class="form-group">
                            <label for="name">Name of Category</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Category type</label>
                               <select name="type" id="" class="form-control">
                                   <option value="Product">Product</option>
                               </select>
                            </div>
                        <button class="btn btn-primary btn-block" type="submit"><i class="bi bi-plus-square"></i> Save Cateogry record</button>
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
