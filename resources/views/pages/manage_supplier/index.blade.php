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
                <h6 class="br-section-label">All Supplier List</h6>
            </div>



            <div class="col-lg-2 offset-lg-4">
                <a href="{{route('supplier.create')}}" class="btn btn-primary" style:"margin-left: 100px ">Add New Supplier</a>
              </div>
          </div>

        </br>


          <div class=" table-wrapper">
                    <table id="datatable" class="table-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th class="wd-5p">Name</th>
                                <th class="wd-5p">Phone</th>
                                <th class="wd-5p">Email</th>
                                <th class="wd-5p">Type</th>
                                <th class="wd-5p">Action</th>
                            </tr>
                        </thead>

                    </table>
            </div><!-- table-wrapper -->

        </div>

        <div id="confirmModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2 class="modal-title">Confirmation</h2>
                    </div>
                    <div class="modal-body">
                        <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="DetailsModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <table id="moduleTable" class="table table-bordered table-colored table-dark">
                        <tbody>
                            <tr>
                                <td colspan="2" style="text-align:center"><strong>Supplier Details</strong></td>
                            </tr>
                            <tr>
                                <th class="wd-10p">Name</th>
                                <td id="supplier_name"></td>
                            </tr>
                            <tr>
                                <th class="wd-35p">Phone</th>
                                <td id="supplier_phone"></td>
                            </tr>
                            <tr>
                                <th class="wd-20p">Email</th>
                                <td id="supplier_email"></td>
                            </tr>
                            <tr>
                                <th class="wd-20p">Address</th>
                                <td id="supplier_address"></td>
                            </tr>

                            <tr>
                                <th class="wd-20p">Type</th>
                                <td id="supplier_type"></td>
                            </tr>
                            <tr>
                                <th class="wd-20p">Description</th>
                                <td id="description"></td>
                            </tr>
                            <tr>
                                <th class="wd-20p">Adding Date</th>
                                <td id="adding_date"><span id="aa"></span></td>

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
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function(){

        $('#datatable').DataTable({
        paging: true,
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: true,
        scrollCollapse: true,
        jQueryUI: true,
        dom: 'Bfrtip',
        buttons: [
        'print'
        ],
        ajax: {
        url: "{{ route('supplier.index') }}",
        },
        columns: [
        {
            data: 'supplier_name',
            name: 'supplier_name'
        },
        {
            data: 'supplier_phone',
            name: 'supplier_phone'
        },
        {
            data: 'supplier_email',
            name: 'supplier_email'
        },
        {
            data: 'supplier_type',
            name: 'supplier_type'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false
        }
        ]
        });


 var supplier_id;

 $(document).on('click', '.delete', function(){
  supplier_id = $(this).attr('id');
  $('#confirmModal').modal('show');
 });

 $('#ok_button').click(function(){
  $.ajax({
    url:"{{route('supplier.delete')}}",
    data: {supplier_id: supplier_id},
    beforeSend:function(){
    $('#ok_button').text('Deleting...');
   },
   success:function(data)
   {
    setTimeout(function(){
     $('#confirmModal').modal('hide');
     $('#datatable').DataTable().ajax.reload();
    });
   }
  })
 });



 $(document).on('click', '.details', function(){
  var uid = $(this).attr('id');
  $.ajax({
   url:"supplier/"+uid,
   dataType:"json",
   success:function(data)
   {
    $('#supplier_name').text(data.result.supplier_name);
    $('#supplier_phone').text(data.result.supplier_phone);
    $('#supplier_email').text(data.result.supplier_email);
    $('#supplier_address').text(data.result.supplier_address);
    $('#supplier_type').text(data.result.supplier_type);
    $('#description').text(data.result.description);
    $('#adding_date').text(data.result.adding_date);
    $('#DetailsModal').modal('show');
   }
  })

 });




 });

    </script>

    @endsection
