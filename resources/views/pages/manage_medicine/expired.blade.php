@extends('layouts.master')
@section('css')
    <link href="{{asset('public/user/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/highlightjs/styles/github.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}"
          rel="stylesheet">

@endsection
@section('content')
    <br>

    <div class="br-pagebody">
        <div class="br-section-wrapper">
            @include('include._message')
            <div class="row">
                <div class="col-lg-6">
                    <h6 class="br-section-label">Expired Medicine List</h6>
                </div>

            </div>

            </br>


            <div class="table-wrapper">
                <table id="datatable" class="table display responsive nowrap">
                    <thead>
                    <tr>
                        <th class="wd-15p">Medicine Name</th>
                        <th class="wd-20p">Company Name</th>
                        <th class="wd-20p">Selling Price</th>
                        <th class="wd-15p">Quantity</th>
                        <th class="wd-15p">Storing Area</th>
                        <th class="wd-15p">Expired Date</th>
                        <th class="wd-10p">Action</th>
                    </tr>
                    </thead>

                </table>
            </div><!-- table-wrapper -->
        </div>

        <div id="DetailsModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <table id="moduleTable" class="table table-bordered table-colored table-dark">
                        <tbody>
                            <tr>
                                <td colspan="2" style="text-align:center"><strong>Medicine Details</strong></td>
                            </tr>
                            <tr>
                                <th class="wd-10p">Medicine Name</th>
                                <td id="medicine_name"></td>
                            </tr>
                            <tr>
                                <th class="wd-35p">Medicine Code</th>
                                <td id="medicine_code"></td>
                            </tr>
                            <tr>
                                <th class="wd-20p">Medicine Category Name</th>
                                <td id="category_name"></td>
                            </tr>
                            <tr>
                                <th class="wd-20p">Selling Price</th>
                                <td id="selling_price"></td>
                            </tr>

                            <tr>
                                <th class="wd-20p">Purchase Price</th>
                                <td id="purchase_price"></td>
                            </tr>
                            <tr>
                                <th class="wd-20p">Quantity Avaiable</th>
                                <td id="quantity"></td>
                            </tr>
                            <tr>
                                <th class="wd-20p">Genearic Name</th>
                                <td id="generic_name"></span></td>
                            </tr>
                            <tr>
                                <th class="wd-20p">Storing Area</th>
                                <td id="storing_area"></span></td>
                            </tr>
                            <tr>
                                <th class="wd-20p">Expire Date</th>
                                <td id="expire_date"></span></td>
                            </tr>
                            <tr>
                                <th class="wd-20p">Effect</th>
                                <td id="effects"></span></td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Done</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')

    <script src="{{asset('public/user/lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/user/lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{asset('public/user/lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('public/user/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{asset('public/user/lib/select2/js/select2.min.js')}}"></script>


    <script>

        $(document).ready(function () {

            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('medicine.expired') }}",
                },
                columns: [
                    {
                        data: 'medicine_name',
                        name: 'medicine_name'
                    },
                    {
                        data: 'company_name',
                        name: 'company_name'
                    },
                    {
                        data: 'selling_price',
                        name: 'selling_price'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'storing_area',
                        name: 'storing_area'
                    },
                    {
                        data: 'expire_date',
                        name: 'expire_date'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ]
            });


     $(document).on('click', '.details', function(){
  var uid = $(this).attr('id');
  $('#DetailsModal').modal('show');
  $.ajax({
   url:"{{url('medicine/details')}}"+"/"+uid,
   dataType:"json",
   success:function(data)
   {
    $('#medicine_name').text(data.medicine.medicine_name);
    $('#medicine_code').text(data.medicine.medicine_code);
    $('#purchase_price').text(data.medicine.purchase_price);
    $('#selling_price').text(data.medicine.selling_price);
    $('#quantity').text(data.medicine.quantity);
    $('#expire_date').text(data.medicine.expire_date);
    $('#generic_name').text(data.medicine.generic_name);
    $('#effects').text(data.medicine.effects);
    $('#storing_area').text(data.medicine.storing_area);
    $('#category_name').text(data.category.category_name);
    $('#DetailsModal').modal('show');
   }
  })

 });


        });


    </script>



@endsection
