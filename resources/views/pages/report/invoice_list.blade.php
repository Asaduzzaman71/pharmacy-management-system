@extends('layouts.master')
@section('css')
    <link href="{{asset('public/user/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/highlightjs/styles/github.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}"
          rel="stylesheet">
    <style type="text/css">
        .textcolor {
        . color: black;

        }
    </style>


@endsection
@section('content')
    <br>
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <div class="container">
                <h2 style="color: black"></i>Date Wise Invoice Lists</h2>
                <hr>
                <?php
                $i = 0;
                ?>
                <div>
                    <form action="{{route('datewise.Invoices')}}" method="GET">

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">From<span class="tx-danger">*</span></label>
                                <input type="text" id="datepicker1" value="" width="400"
                                           name="starting_date" class="form-control" placeholder="yy/mm/dd" required=""
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">To<span class="tx-danger">*</span></label>
                                    <input type="text" id="datepicker2" value="" width="400"
                                           name="ending_date" class="form-control" placeholder="yy/mm/dd" required=""
                                           autocomplete="off">
                                </div>
                            </div>

                        <div class="col-lg-4">
                        <div class="form-group" style="margin: 28px">
                            <input type="submit" class="btn btn-primary" value="Create Report">
                          </div>
                        </div>
                 </div>
                    </form>
                </div>

                <br>
                <br>
                <div class="bd bd-gray-300 rounded table-responsive">
                    <table class="table table-striped mg-b-0">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Invoice Number</th>
                            <th>Discount</th>
                            <th>Vat</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <th scope="row">{{++$i}}</th>
                                <td style="color: black">{{ $invoice->invoice_number}}</td>
                                <td style="color: black">{{ $invoice->discount}}</td>
                                <td style="color: black">{{ $invoice->vat}}</td>
                                <td style="color: black">{{ $invoice->created_by}}</td>
                                <td style="color: black">{{ $invoice->created_at->format('d/m/Y')}}</td>
                                <td><a href="{{ route('invoice.details',$invoice->invoice_number) }}">
                                        <button class="details btn btn-info btn-sm">Details</button>
                                    </a></td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- bd -->
                <br>
                <div class="row">
                    <div class="col-6">
                        {{$invoices->links()}}
                    </div>
                </div>
                <br>
                <br>

            </div>

        </div>

    </div>

@endsection

@section('js')
    <script>
        $("#datepicker1").datepicker({dateFormat: "yy-mm-dd"});
        $("#datepicker2").datepicker({dateFormat: "yy-mm-dd"});
    </script>
@endsection
