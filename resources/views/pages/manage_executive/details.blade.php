@extends('layouts.master')
@section('css')
    <style>
        hr {
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            margin-left: auto;
            margin-right: auto;
            border-style: inset;
            border-width: 1px;
        }
    </style>

@endsection

@section('content')
    <br>
    <div class="br-pagebody">
        <div class="br-section-wrapper">


            <div class="row">
                <div class="col-lg-3">
                    <h5>Executive Details</h5>
                </div>
            </div>
            <hr>
            <br>

            <div class="form-layout form-layout-1">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="{{URL::asset($user->image)}}" alt="profile Pic" height="200" width="200">
                    </div>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Exeutive Name: <span
                                    class="tx-danger">{{$user->user_name}}</span></label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Phone: <span
                                    class="tx-danger">{{$user->user_phone}}</span></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Exeutive Email: <span
                                    class="tx-danger">{{$user->email}}</span></label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Joining Date: <span
                                    class="tx-danger">{{$user->joining_date}}</span></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Address: <span
                                    class="tx-danger">{{$user->user_address}}</span></label>
                        </div>
                    </div>
                </div>

                <br>

            </div><!-- form-layout-footer -->
        </div><!-- form-layout -->

@endsection

@section('js')

@endsection
