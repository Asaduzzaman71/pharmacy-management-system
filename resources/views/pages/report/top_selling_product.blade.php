
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


              <div>
                 <h3 style="text-align: center;color: black">Top Selling Medicine </h3>
              </div>
              <div id="button" class="row">

                  <div class="col-lg-2 offset-lg-10">
                   <button class="btn btn-dark" id="print">Print List</button>
                  </div>
              </div>



               <br>
               <?php
                 $i=0;
               ?>
            <div class="bd bd-gray-300 rounded table-responsive">
            <table class="table table-striped mg-b-0">
              <thead>
                <tr>
                  <th>SL</th>
                  <th>Medicine Name</th>
                  <th>Generic Name</th>
                  <th>Selling Quantity</th>
                  <th>Price per Unit</th>
                  <th>Company Name</th>
                </tr>
              </thead>
              <tbody>
        @foreach($items as $item)
                <tr>
                  <th scope="row">{{++$i}}</th>
                <td style="color: black">{{ $item->medicine_name }}</td>
                  <td style="color: black">{{ $item->generic_name }}</td>
                <td style="color: black">{{$item->medicine_quantity_sum}}</td>
                  <td style="color: black">{{$item->selling_price}}</td>
                  <td style="color: black">{{$item->company_name}}</td>
                </tr>
        @endforeach
              </tbody>
            </table>
          </div><!-- bd -->
            <br>
            <div class="row">
            <div class="col-6">
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
$(document).ready(function(){

    $('#print').click(function(){

        $("#button").hide();
        $(".br-footer").hide();
        $(".br-header").hide();
        window.print();
        $("#button").show();
        $(".br-footer").show();
        $(".br-header").show();
        });

 });

</script>
@endsection
