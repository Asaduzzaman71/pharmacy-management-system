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
                <h6 class="br-section-label">Activity Log</h6>
            </div>
        </div>
        </br>

        <div class="table-wrapper">
            <table id="datatable" class="table display responsive nowrap">
                <thead>
                    <tr>
                        <th class="wd-20p">Name</th>
                        <th class="wd-20p">Activity</th>
                        <th class="wd-15p">Date</th>
                        <th class="wd-15p">Time</th>
                        <th class="wd-15p">Login IP</th>
                    </tr>
                </thead>

            </table>
        </div><!-- table-wrapper -->

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
        processing: true,
        serverSide: true,
        ajax: {
        url: "{{ route('setting.activity') }}",
        },
        columns: [

        {
             data:'user_name',
             name:'user_name'
        },
        {
            data: 'activity',
            name: 'activity'
        },
        {
            data: 'activity_date',
            name: 'activity_date'
        },
        {
            data: 'time',
            name: 'time'
        },
        {
            data: 'login_ip',
            name: 'login_ip'
        }

        ]
        });

 });

</script>

@endsection
