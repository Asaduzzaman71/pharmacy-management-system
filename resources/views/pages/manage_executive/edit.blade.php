@extends('layouts.master')
@section('css')

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
                    <h5>Edit Profile</h5>
                </div>
            </div>
            <hr>
            <br>

            <div class="form-layout form-layout-1">
                <form method="post" action="{{url('/executive/'.base64_encode($user->id))}}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Executive Name<span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="user_name"
                                       value="{{old('user_name') ?? $user->user_name}}" placeholder="executive name">
                                 <span class="text-danger">{{ $errors->first('user_name') }}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Executive Email<span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="email"
                                       value="{{old('email') ?? $user->email }}" placeholder="executive email">
                                 <span class="text-danger">{{ $errors->first('email') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Executive Phone<span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="user_phone"
                                       value="{{old('user_phone') ?? $user->user_phone}}" placeholder="executive phone">
                                <span class="text-danger">{{ $errors->first('user_phone') }}</span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Joining Date:<span class="tx-danger">*</span></label>
                                <input type="text" id="datepicker" autocomplete="off" value="{{old('joining_date',$user->joining_date)}}" width="400" name="joining_date" class="form-control" placeholder="yy/mm/dd">
                                <span class="text-danger">{{ $errors->first('joining_date') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">New Password<span class="tx-danger">*</span></label>
                                <input class="form-control" type="password" name="password"
                            value="" placeholder="New Password">
                                 <input class="form-control" type="hidden" name="old_password"
                                       value="{{$user->password}}" placeholder="password">
                                       <span class="text-danger">{{ $errors->first('password') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Address<span class="tx-danger"></span></label>
                                <input class="form-control" type="text" name="user_address"
                                       value="{{old('user_address') ?? $user->user_address}}" placeholder="address">
                                       <span class="text-danger">{{ $errors->first('user_address') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-6">
                            <label class="form-control-label">Image<span class="tx-danger">*</span></label>
                            <input type="file" name="image" value="{{old('image') ?? $user->image}}" accept="image/*"
                                   onchange="showMyImage(this)"/>
                            <input type="hidden" value="{{old('image') ?? $user->image}}" name="oldimage"/>
                            <br>
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                            <br/>
                            <img id="thumbnil" style="width:20%; margin-top:10px;" src="" alt="image"/>
                        </div>


                        <div class="col-lg-6" id ="status">
                        <input type="hidden" id="user_type" value="{{$user->user_type}}">
                            <label class="form-control-label">Account Status<span class="tx-danger">*</span></label>
                            <select class="form-control select" name="status" data-placeholder="Choose Account Status">
                                @if ($user->status == "1")
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                            </select>
                            @else
                                <option value="0">Deactive</option>
                                <option value="1">Active</option>
                                </select>
                            @endif

                        </div>
                    </div>
                    <br>

                    <div class="form-layout-footer">
                        <button class="btn btn-info">Update Information</button>

                    </div><!-- form-layout-footer -->
            </div><!-- form-layout -->

@endsection

@section('js')

<script>
        $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" });
</script>

<script>
$(document).ready(function(){

if($('#user_type').val() == 'admin')
{
     $("#status").hide();
}
else
{
    $("#status").show();
}

});
</script>

@endsection
