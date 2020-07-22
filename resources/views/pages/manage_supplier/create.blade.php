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

            @include('include._message')

            <div class="row">
                <div class="col-lg-3">
                    <h5>Add New Supplier</h5>
                </div>
            </div>
            <hr>
            <br>

            <div class="form-layout form-layout-1">
                <form method="POST" action="{{route('supplier.store')}}" >
                    @csrf

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Supplier Name<span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="supplier_name" value="{{old('supplier_name')}}"
                                       placeholder="Full Name" required>
                                <span class="text-danger">{{ $errors->first('supplier_name') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Supplier Phone<span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="supplier_phone" value="{{old('supplier_phone')}}"
                                       placeholder="Phone" required>
                                <span class="text-danger">{{ $errors->first('supplier_phone') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Supplier Email<span
                                        class="tx-danger"></span></label>
                                <input class="form-control" type="email" name="supplier_email" value="{{old('supplier_email')}}"
                                       placeholder="Email">
                                <span class="text-danger">{{ $errors->first('supplier_email') }}</span>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Supplier Address<span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="supplier_address" value="{{old('supplier_address')}}"
                                       placeholder="Address" required>
                                 <span class="text-danger">{{ $errors->first('supplier_address') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Supplier Type<span class="tx-danger"></span>*</label>
                                <input class="form-control" type="text" name="supplier_type" value="{{old('supplier_type')}}"
                                       placeholder="Type" required>
                                        <span class="text-danger">{{ $errors->first('supplier_type') }}</span>
                            </div>
                        </div>

                     <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Description<span class="tx-danger"></span></label>
                            <div>
                                <textarea name="description" class="form-control">
                            {{old('description')}}
                          </textarea>
                           <span class="text-danger">{{ $errors->first('description') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                    <br>
                    <div class="form-layout-footer">
                        <button class="btn btn-info">Save Information</button>
                    </div><!-- form-layout-footer -->
            </div><!-- form-layout -->

@endsection

@section('js')

@endsection
