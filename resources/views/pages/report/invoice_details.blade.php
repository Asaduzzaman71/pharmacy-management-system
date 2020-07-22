
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
                 <h3 style="text-align: center;color: black">Far East Pharmacy Shop</h3>
              </div>
              <div >
                 <p style="text-align: center;color: black">  House #51, Road #18, Uttara - 11, Dhaka-1230</p>
                 <p style="text-align: center;color: black">Phone: +8801763346334</p>
                 <p style="text-align: center;color: black">Email: info@feits.co</p>



              </div>


               <div class="row">
                 <div class="col col-lg-3">
                   <strong style="color: black">Invoice Number:{{$invoice->invoice_number}}</strong><p> </p>
                 </div>
                 <div class="col col-lg-3">
                   <strong style="color: black">Date and Time:{{$invoice->created_at->format('d/m/Y')}}</strong><p> </p>

                 </div>
               </div>

                     <?php
                    $invoice_items=Cart::content();
                    $i=0;
                    ?>

               <br>
            <div class="bd bd-gray-300 rounded table-responsive">
            <table class="table table-striped mg-b-0">
              <thead>
                <tr>
                  <th>SN</th>
                  <th>Medicine Name</th>
                  <th>Qty</th>
                  <th>Rate</th>
                  <th>Sub Total</th>
                </tr>
              </thead>
              <tbody>
               @foreach($items as $item)
                <tr>
                  <th scope="row">{{++$i}}</th>
                  <td style="color: black">{{ $item->medicine->medicine_name}}</td>
                  <td style="color: black">{{ $item->medicine_quantity}}</td>
                  <td style="color: black">{{ $item->medicine_price_rate}}</td>
                  <td style="color: black">{{ $item->qty*$item->price}}</td>
                </tr>
                @endforeach


              </tbody>
            </table>
          </div><!-- bd -->
          <br>

          <div>
            <div>
              <span><strong style="color: black">Sub Total Amount: {{$invoice->subtotal}}</strong></span>
            </div>
            <div>
              <span><strong  style="color: black">Vat({{$invoice->vat}}% ) : {{($invoice->subtotal*$invoice->vat)/100}}</strong></span>
            </div>
            <div>
              <span><strong  style="color: black">Discount       : {{$invoice->discount}}</strong></span>
            </div>
            <div>
              <span><strong  style="color: black">Grand Total    : {{$invoice->grand_total}}</strong></span>
            </div>
          </div>
  <br>


  </div>
          <div id="button">
            <button class="btn btn-primary" id="print">Print Invoice</button>
          </div>



      </div>


        </div>









      @endsection

      @section('js')

<script >
    $(document).ready(function(){

    $('#print').click(function(){

        //$(".br-section-wrapper").show();
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
