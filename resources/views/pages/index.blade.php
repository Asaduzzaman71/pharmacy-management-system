@extends('layouts.master')
@section('content')


    <br>
      <div class="br-pagebody">
          <div class ="br-section-wrapper">
        <div class="row row-sm">
          <div class="col-sm-6 col-xl-3">
            <div class="bg-info rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Medicine Category</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{$data['no_of_medicine_categories']}}</p>
                </div>
              </div>
              <div id="ch1" class="ht-50 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
            <div class="bg-purple rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Total medicine Items</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{$data['no_of_medicine_items']}}</p>
                </div>
              </div>
              <div id="ch3" class="ht-50 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="bg-teal rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Total Executives</p>
                <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{$data['no_of_executives']}}</p>

                </div>
              </div>
              <div id="ch2" class="ht-50 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="bg-primary rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Total Invoices</p>
                <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{$data['no_of_invoices']}}</p>

                </div>
              </div>
              <div id="ch4" class="ht-50 tr-y-1"></div>
            </div>
          </div><!-- col-3 -->

</div><!-- row -->
<br>
<br>
 <div class="row">
    <div class="col-lg-6">
        <h4 style="text-align: center;color: black">Medicine Sell</h4>
           <table class="table table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Today</th>
                <th scope="col">Week</th>
                <th scope="col">Month ({{now()->format('F')}})</th>
                <th scope="col">Year ({{now()->format('Y')}})</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>{{$data['today_sell_no_medicine_sell']}} piece</td>
                <td>{{$data['week_sell_no_medicine_sell']}} piece</td>
                <td>{{$data['month_sell_no_medicine_sell']}} piece</td>
                <td>{{$data['year_sell_no_medicine_sell']}} piece</td>
                </tr>
            </tbody>
            </table>
        </div>
    <div class="col-lg-6">
        <h4 style="text-align: center;color: black">Sell Amount</h4>
           <table class="table table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Today</th>
                <th scope="col">Week</th>
                <th scope="col">Month ({{now()->format('F')}})</th>
                <th scope="col">Year ({{now()->format('Y')}})</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>{{$data['today_sell_amount']}} ৳</td>
                <td>{{$data['week_sell_amount']}} ৳</td>
                <td>{{$data['month_sell_amount']}} ৳</td>
                <td>{{$data['year_sell_amount']}} ৳</td>
                </tr>
            </tbody>
            </table>
        </div>


    </div>
          </div>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
@endsection
