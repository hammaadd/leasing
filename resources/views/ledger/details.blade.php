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
                    <h4 class="card-title">Create entry</h4>
                </div>

                <div class="card-body">
                    <form action="{{route('ledger.entry.add',$ledger)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Amount</label>
                                        <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{old('amount')}}" min="1" required>
                                        @error('amount')
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
                                               <option value="Jamah">Jamah/جمع</option>
                                                <option value="Name">Name/نام</option>
                                           </select>
                                        </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description"></textarea>
                                    </div>
                                </div>

                                    <button class="btn btn-primary" type="submit"><i class="bi bi-plus-square"></i>Add Entry</button>

                            </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Entries of "{{$ledger->name}}"</h4>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Ledger Name</th>
                                <td>{{$ledger->name}}</td>
                                <th>Ledger Number</th>
                                <td>{{$ledger->id}}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><h4 class="text-warning">{{$ledger->status}}</h4></td>
                                <th>Amount</th>
                                <td>{{$ledger->amount}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-body">
                    <table class="table table-hover data-table table-striped">
                        <thead class="bg-primary text-light">
                            <tr>
                                <th>Entry#</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Jamah/جمع</th>
                                <th>Name/نام</th>
                                <th>Status/کیفیت</th>
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
          ajax: "{{route('ledger.entries.get',$ledger->id)}}",
          columns: [
              {data:'id',name:0},
              {data: 'description', name: 1},
              {data: 'amount', name: 2},
              {data: 'j_amount', name: 3},
              {data: 'n_amount', name: 4},
              {data: 'status',name:5}
          ],
          order:[
              [0,'DESC']
          ]
      });

    });
  </script>
@endsection
