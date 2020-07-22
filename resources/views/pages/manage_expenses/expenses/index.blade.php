@extends('layouts.master')
 @section('css')
    <link href="{{asset('public/user/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/highlightjs/styles/github.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet">

 @endsection
 @section('content')
 <br>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
            @include('include._message')
          <div class="row">
              <div class="col-lg-6">
                <h6 class="br-section-label">All Expense List</h6>
              </div>



              <div class="col-lg-2 offset-lg-4">
                  <a href="{{route('expense.create')}}" class="btn btn-primary" style:"margin-left: 100px ">Add New Expense</a>
              </div>
          </div>

        </br>


          <div class="table-wrapper">
            <table id="datatable" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">Title</th>
                  <th class="wd-15p">Amount</th>
                  <th class="wd-15p">Date</th>
                  <th class="wd-10p">Action</th>
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

 </div>

    @endsection

    @section('js')


   <script src="{{asset('public/user/lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/user/lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{asset('public/user/lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('public/user/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{asset('public/user/lib/select2/js/select2.min.js')}}"></script>


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
        ajax: {
        url: "{{ route('expense.index') }}",
        },
        columns: [
        {
            data: 'title',
            name: 'title'
        },

        {
            data: 'expense_amount',
            name: 'expense_amount'
        },
        {
            data: 'expense_date',
            name: 'expense_date'
        },

        {
            data: 'action',
            name: 'action',
            orderable: false
        }
        ]
        });


 });


</script>

 @endsection
