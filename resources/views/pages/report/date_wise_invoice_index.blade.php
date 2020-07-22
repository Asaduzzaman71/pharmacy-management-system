 @extends('layouts.master')
 @section('css')



 @endsection
 @section('content')

     <br>


      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h2 style="color: black"></i>Date Wise Invoice Lists</h2>
          <hr>
          <form  action="{{route('datewise.Invoices')}}" method="post">
           @csrf

          <div class="row">
              <div class="col-lg-4">
                    <div class="form-group">
                    <label class="form-control-label">From<span class="tx-danger">*</span></label>
                    <input type="text" id="datepicker1" value="{{old('expire_date')}}" width="400"
                      name="starting_date" class="form-control" placeholder="yy/mm/dd" required="" autocomplete="off">
                    </div>
              </div>
              <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">To<span class="tx-danger">*</span></label>
                        <input type="text" id="datepicker2" value="{{old('expire_date')}}" width="400"
                           name="ending_date" class="form-control" placeholder="yy/mm/dd" required="" autocomplete="off">
                    </div>
             </div>
          </div>
          <div>
            <input type="submit" class="btn btn-primary" value="Create Report">
          </div>

          </form>


         <br>
 </div>

          </div><!-- bd -->

      @endsection

      @section('js')
  <script>
        $("#datepicker1").datepicker({ dateFormat: "yy-mm-dd" });
         $("#datepicker2").datepicker({ dateFormat: "yy-mm-dd" });
    </script>


      @endsection


