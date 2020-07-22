
 @extends('layouts.master')
 @section('css')
   <link href="{{asset('public/user/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/highlightjs/styles/github.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet">
  <style type="text/css">
    .textcolor{
      .color: black;

    }
  </style>


 @endsection
 @section('content')
 <br>
     <div class="br-pagebody">
        <div class="br-section-wrapper">

          <div class="container">


              <div >
                 <h3 style="text-align: center;color: black">Sales Items List</h3>
              </div>



               <br>
               <?php
                 $i=($salesitems->currentpage()-1)* $salesitems->perpage() + 1;
               ?>
            <div class="bd bd-gray-300 rounded table-responsive">
            <table class="table table-striped mg-b-0">
              <thead>
                <tr>
                  <th>SN</th>
                  <th>Invoice Number</th>
                  <th>Medicine Name</th>
                  <th>Medicine Price Rate</th>
                  <th>Quantity</th>
                  <th>Created By</th>
                  <th>Created At</th>


                </tr>
              </thead>
              <tbody>
               @foreach($salesitems as $salesitem)
                <tr>
                  <th scope="row">{{$i++}}</th>
                  <td style="color: black">{{ $salesitem->invoice_number}}</td>
                  <td style="color: black">{{ $salesitem->medicine->medicine_name}}</td>
                  <td style="color: black">{{ $salesitem->medicine_price_rate}}</td>
                  <td style="color: black">{{ $salesitem->medicine_quantity}}</td>
                  <td style="color: black">{{ $salesitem->created_by}}</td>
                  <td style="color: black">{{ $salesitem->created_at->format('d/m/Y')}}</td>

                </tr>
                @endforeach


              </tbody>
            </table>
          </div><!-- bd -->
            <br>
            <div class="row">
            <div class="col-6">
               {{$salesitems->links()}}
            </div>
            </div>
          <br>


  <br>


  </div>




      </div>


        </div>









      @endsection

      @section('js')

<script >


</script>


      @endsection
