<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Installment Plan</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">

</head>
<style>
    *{
        box-sizing: border-box;
        font-family: 'Courier New', Courier, monospace;
    }
    @page {
  bleed: 1cm;
  size: A4 portrait;
  size:  auto;   /* auto is the initial value */
  margin-bottom: 50pt;
  margin-top: .5cm;
  font-size: 12pt;

  #content, #page {
  width: 100%;
  margin: 0;
  float: none;
  }

}


@media print {
  .page {
    border: initial;
    border-radius: initial;
    width: initial;
    min-height: initial;
    box-shadow: initial;
    background: initial;
    page-break-after: always;
  }

  table{
    page-break-inside: auto;
  }

  tr.last-row {
      background-color: #555!important;
  }

  tr.last-row > th, tr.last-row > td {
    background-color: unset!important;
  }

  div.page-break{
    page-break-before: auto;
  }
}
.customer-info > div{
    border: 1px solid;
    border-radius: 5px;
    padding: 5px 5px;
    margin: 2px 0;
}
.signature{
  font-size: 15px;
}

    </style>
<body>
    <div class="container">
        <div class="row invoice-header px-3 py-2 d-flex justify-content-between">
          <div class="col-8 col-md-8">
            <p>Haris Traders</p>
            <h3>Leasing and Installment Plan</h3>
          </div>
          <div class="col-4 col-md-4">
              <img src="{{asset('assets/images/logo/logo.png')}}" alt="Logo" width="200">
          </div>
        </div>
        <div class="row customer-info px-3 py-2 d-flex justify-content-around">
            <div class="col-5 col-md-4">
              <h5>Customer Information</h5>
                <div><strong>Name: </strong><small> {{$leasing->customer->name}}</small></div>
                <div><strong>CNIC: </strong><small> {{$leasing->customer->cnic}}</small></div>
                <div><strong>Father/Husband: </strong><small> {{$leasing->customer->father}}</small></div>
                <div><strong>Phone: </strong><small> {{$leasing->customer->phone}}</small></div>
                <div><strong>Address: </strong><small> {{$leasing->customer->address}}</small></div>
                <div><strong>Profession: </strong><small> {{$leasing->customer->profession}}</small> </div>
                <div><strong>Designation: </strong><small> {{$leasing->customer->designation}}</small></div>
              </div>
            <div class="col-5 col-md-4">
              <h5>Product/Lease Information</h5>
                <div><strong>Product: </strong><small>{{$leasing->product->name}}</small></div>
                <div><strong>Lease Date: </strong><small>{{$leasing->date}}</small></div>
                <div><strong>Acc#: </strong><small>{{$leasing->acc_no}}</small></div>
                <div><strong>Advance: </strong><small>{{$leasing->advance}}</small></div>
                <div><strong>Total Payment: </strong><small>{{$leasing->total}}</small></div>
                <div><strong>Tenure: </strong><small>{{$leasing->tenure}} {{$leasing->tenure_in}}</small></div>
                <div><strong>Plan: </strong><small>{{$leasing->plan}}</small></div>
                <div><strong>Installment: </strong><small>{{$leasing->installment}}</small></div>
                <div><strong>Bank Name: </strong><small>{{$leasing->bank_name}}</small></div>
                <div><strong>Check #: </strong><small>{{$leasing->check}}</small></div>
            </div>
            
        </div>
       
      
        <div class="row mt-5">
          <div class="col-12 invoice-table pt-1">
            <table class="table table-sm table-bordered table-striped">
                  <thead class="thead splitForPrint">
                    <tr>
                      <th scope="col gray-ish">NO.</th>
                      <th scope="col gray-ish">Date</th>
                      <th scope="col gray-ish">Installment</th>
                      <th scope="col gray-ish">Received</th>
                      <th scope="col gray-ish">Rec. on</th>
                      <th scope="col gray-ish">Rec. Amount</th>
                      <th class="text-right" scope="col gray-ish">Rec. By</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($leasing->details as $det)
                    <tr>
                      <th scope="row" style="border: 1px solid;">{{$loop->iteration}}</th>
                      <td class="item text-center" style="border: 1px solid;">{{$det->date}}</td>
                      <td style="border: 1px solid;" class="text-center">{{$leasing->installment}}</td>
                      <td style="border: 1px solid;"> </td>
                      <td style="border: 1px solid;"></td>
                      <td style="border: 1px solid;"></td>
                      <td style="border: 1px solid;" class="text-right"></td>
                    </tr>
                    @empty
                    <p>No Data to show</p>
                    @endforelse
                    
                  </tbody>
                </table>
          </div>
        </div>
      <div class="row invoice_details">
              <div class="offset-7 col-5 mb-3 pr-4 sub-table">
                <table class="table table-borderless">
                  <tbody>
                    
                    <tr class="">
                        <th scope="row"><h4>Total</h4></th>
                        <td class="text-right"><h4><span class="currency">PKR.</span> {{$leasing->total}}</h4></td>
                    </tr>
                  </tbody>
                </table>
              </div>
         </div>
         <div class="row">
          <p class="text-right pb-3 signature">Customer Signature :_______________________________</p>
         </div>
        
        <!-- <p class="text-right pb-3"><em> Documents is verified and all installments is valid</em> Customer Signature :_______________________________</p> -->
      </div>
</body>
</html>