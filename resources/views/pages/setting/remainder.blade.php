@extends('layouts.master')
@section('css')

@endsection

@section('content')
<br>
<div class="br-pagebody">
    <div class="br-section-wrapper">

        @include('include._message')

        <div class="row">
            <div class="col-lg-3">
                <h5>Remainder Setteings </h5>
            </div>

        </div>
        <hr>
        <br>

        <div class="form-layout form-layout-1">
        <form method="POST" action="{{route('setting.update')}}">
                @csrf
                        <div class="form-group">
                            <label class="form-control-label">Expire Date Setting<span class="tx-danger">*</span></label>
                            <input class="form-control" type="number" name="setting_day"
                                value="{{$setting->setting_day}}" placeholder="Days">
                        </div>


                        <div class="form-group">
                            <label class="form-control-label">Quantity Setting<span class="tx-danger">*</span></label>
                            <input class="form-control" type="number" name="settings_quantity"
                        value="{{$setting->settings_quantity}}" placeholder="Qunatity pieces">
                        </div>
                            <div class="form-layout-footer">
                                <button class="btn btn-info">Change Settings</button>
                            </div><!-- form-layout-footer -->
                    </div>

                </form>
                </div>
            </div>

    <br>

    @endsection

    @section('js')

    <script>
        $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" });
    </script>

    @endsection
