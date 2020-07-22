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

    <script>
        function showMyImage(fileInput) {
            var files = fileInput.files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var imageType = /image.*/;
                if (!file.type.match(imageType)) {
                    continue;
                }
                var img = document.getElementById("thumbnil");
                img.file = file;
                var reader = new FileReader();
                reader.onload = (function (aImg) {
                    return function (e) {
                        aImg.src = e.target.result;
                    };
                })(img);
                reader.readAsDataURL(file);
            }
        }
    </script>

@endsection

@section('content')
    <br>
    <div class="br-pagebody">
        <div class="br-section-wrapper">

       

            <div class="row">
                <div class="col-lg-3">
                    <h5>Add New Executive</h5>
                </div>
            </div>
            <hr>
            <br>

            <div class="form-layout form-layout-1">
                <form method="POST" action="{{route('executive.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Executive Name<span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="user_name" value="{{old('user_name')}}"
                                       placeholder="executive name">
                                <span class="text-danger">{{ $errors->first('user_name') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Executive Email<span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="email" value="{{old('email')}}"
                                       placeholder="executive email">
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Executive Phone<span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="user_phone" value="{{old('user_phone')}}"
                                       placeholder="executive phone">
                                <span class="text-danger">{{ $errors->first('user_phone') }}</span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Joining Date:<span class="tx-danger">*</span></label>
                            <input type="text" id="datepicker" value="{{old('joining_date')}}" width="400" name="joining_date" class="form-control" placeholder="yy/mm/dd">
                            <span class="text-danger">{{ $errors->first('joining_date') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Password<span class="tx-danger">*</span></label>
                                <input class="form-control" type="password" name="password" value="{{old('password')}}"
                                       placeholder="password">
                                       <span class="text-danger">{{ $errors->first('password') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Address<span class="tx-danger"></span></label>
                                <input class="form-control" type="text" name="user_address"
                                       value="{{old('user_address')}}" placeholder="address">
                                <span class="text-danger">{{ $errors->first('user_address') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <img style="width:20%; margin-top:10px;" id="thumbnil" name="thumbnil" src="" alt="image"/>
                            <br>
                            <input type="file" for="thumbnil" name="image" accept="image/*" onchange="showMyImage(this)"/>
                            <br>
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        </div>

                    </div>
                    <br>

                    <div class="form-layout-footer">
                        <button class="btn btn-info">Save Information</button>
                    </div><!-- form-layout-footer -->
            </div><!-- form-layout -->

@endsection

@section('js')
<script>
        $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" });
</script>
@endsection
