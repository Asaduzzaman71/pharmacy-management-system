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
                <h5>Update Medicine</h5>
            </div>
         
        </div>
        <hr>
        <br>

        <div class="form-layout form-layout-1">
            <form method="POST" action="{{url('/medicine-quantity-update/'.$medicine->id)}}">
                @csrf
                <div class="row">

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Medicine Name<span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="medicine_name"
                                value="{{ $medicine->medicine_name}}" readonly="">
                                  
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Quantity<span class="tx-danger">*</span></label>
                            <input class="form-control" type="number" name="quantity"
                                value="{{old('quantity') ?? $medicine->quantity}}">
                                  <p style="color:red">{{ $errors->first('quantity') }}</p>
                        </div>
                    </div>
                   
                
                </div>

                <div class="row">
                    
                   <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Purchase Price<span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="purchase_price"
                                value="{{old('purchase_price') ?? $medicine->purchase_price}}">
                                  <p style="color:red">{{ $errors->first('purchase_price') }}</p>
                        </div>
                    </div>
                    

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Selling Price<span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="selling_price"
                                value="{{old('selling_price') ?? $medicine->selling_price}}">
                                  <p style="color:red">{{ $errors->first('selling_price') }}</p>
                        </div>
                    </div>

                </div>

                <div class="row">
                    
                    

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Expire Date<span class="tx-danger">*</span></label>
                            <input type="text" id="datepicker" value="{{old('expire_date',$medicine->expire_date)}}"
                                width="400" name="expire_date" class="form-control" placeholder="yy/mm/dd">
                                 <p style="color:red">{{ $errors->first('expire_date') }}</p>
                        </div>
                    </div>
                </div>

              

        </div><!-- row -->

        <br>

        <div class="form-layout-footer">
            <button class="btn btn-info">Svae Information</button>

        </div><!-- form-layout-footer -->
    </div><!-- form-layout -->

    @endsection

    @section('js')

    <script>
        $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" });
    </script>

    @endsection
