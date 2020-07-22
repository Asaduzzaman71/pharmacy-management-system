
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

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">
  tinymce.init({
    forced_root_block : "",
    selector: '#mytextarea'
  });

  </script>
@endsection

@section('content')
<br>
      <div class="br-pagebody">
        <div class="br-section-wrapper">


@include('include._message')

          <div class="row">
            <div class="col-lg-3">
                <h5>Medicine Details</h5>
            </div>
        </div>
          <hr>
          <br>

          <div class="form-layout form-layout-1">
          <div class="row">

            <div class="col-lg-6">
               <div class="form-group">
                  <label class="form-control-label">Medicine Name<span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="mname" value="{{old('mname') ?? $medicine->medicine_name}}" readonly >
                </div>
            </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Medicine Code<span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="mcode" value="{{old('mcode') ?? $medicine->medicine_code}}" readonly>
                </div>
              </div>
          </div>

            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                <label  class="form-control-label">Medicine Category</label>
                <select class="chosen-select form-control" name="mcategory" id="form-field-select-3" data-placeholder="Choose a status"  readonly>
                    <option value="{{$category->id}}">{{$category->category_name}}</option>

                </select>
                </div>
              </div>

            <div class="col-lg-6">
                 <div class="form-group">
                  <label class="form-control-label">Purchase Price<span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="pprice" value="{{old('price') ?? $medicine->purchase_price}}" readonly>
                  </div>
            </div>

          </div>

            <div class="row">
                <div class ="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Selling Price<span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="sprice" value="{{old('sprice') ?? $medicine->selling_price}}"  readonly>
                 </div>
              </div>
                <div class ="col-lg-6">
                 <div class="form-group">
                  <label class="form-control-label">Quantity<span class="tx-danger">*</span></label>
                  <input class="form-control" type="number" name="quantity" value="{{old('quantity') ?? $medicine->quantity}}" readonly>
                </div>
                </div>
            </div>

           <div class="row">
              <div class ="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Generic Name<span class="tx-danger"></span></label>
                  <input class="form-control" type="text" name="gname" value="{{old('gname') ?? $medicine->generic_name}}" readonly>
                </div>
              </div>

              <div class ="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Medicine Class<span class="tx-danger"></span></label>
                  <input class="form-control" type="text" name="mclass" value="{{old('mclass') ?? $medicine->medicine_class}}"  readonly>
                </div>
              </div>
          </div>

          <div class="row">
            <div class ="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Company Name<span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="cname" value="{{old('cname') ?? $medicine->company_name}}" readonly>
                </div>
            </div>

            <div class ="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Expire Date<span class="tx-danger">*</span></label>
                  <input class="form-control" type="Date" name="edate" value="{{old('sarea') ?? $medicine->expire_date}}"  readonly>
                </div>
            </div>

            <div class ="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Storing Area<span class="tx-danger"></span></label>
                  <input class="form-control" type="text" name="sarea" value="{{old('sarea') ?? $medicine->storing_area}}" readonly>
                </div>
            </div>
          </div>


                <div class="form-group">
                      <label class="control-label">Effect<span class="tx-danger"></span></label>
                      <div>
                          <textarea name="effect" rows="10" cols="122" readonly>
                              {!! old('effect')??$medicine->effect !!}
                          </textarea>
                      </div>
                </div>





            </div><!-- row -->

            <br>

            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->

@endsection

@section('js')

@endsection
