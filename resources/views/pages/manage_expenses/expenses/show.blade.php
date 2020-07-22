
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



<br>
    <div class="br-pagebody">
        <div class="br-section-wrapper" style="background-color:powderblue">


            <div class="row">
                <div class="col-lg-3">
                    <h5 style="color: black">Executive Details</h5>
                </div>
            </div>
            <hr>
                <br>
                <br>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Expense Category :<span
                                    class="tx-danger">{{$expense->expensecategory->expense_category_name}}</span></label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Expense For: <span
                                    class="tx-danger">{{$expense->title}}</span></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Expense Amount: <span
                                    class="tx-danger">{{$expense->expense_amount}}</span></label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Expense Date: <span
                                    class="tx-danger">{{$expense->expense_date}}</span></label>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Address: <span
                                    class="tx-danger">{{$expense->expense_description}}</span></label>
                        </div>
                    </div>

                </div>

                <br>

            </div><!-- form-layout-footer -->
        </div><!-- form-layout -->


         
            
              
    
        

@endsection

@section('js')

@endsection