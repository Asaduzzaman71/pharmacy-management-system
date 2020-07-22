
@extends('layouts.master')
@section('css')



@endsection

@section('content')
<br>
   
      
      <div class="br-pagebody">
        <div class="br-section-wrapper">
       
          <div class="row">

            <div class="col-lg-3">
                <h5>New Expense Category</h5>
            </div> 
            <div class="col-lg-3 offset-lg-6">        
                <a href="{{route('expense-category.index')}}" class="btn btn-primary">All Expense Category List</a>
            </div>
        </div>
          <hr>
          <div class="row">
            <div cla></div>
          </div>

          <div class="form-layout form-layout-1">
            <form action="{{route('expense.store')}}" method="POST">
              @csrf
              <div class="row">
                <div class="col-lg-6">


                <div class="form-group">
                  <label class="form-control-label" for="title"> Title <span class="tx-danger">*</span></label>
                  <input class="form-control" id="title"  type="text" name="title" value="{{old('title')}}" placeholder="Enter Expense title">
                  <span class="text-danger">{{ $errors->first('title') }}
                </div>
                
              </div>

                   
  
              <div class="col-lg-6">
                 <div class="form-group">
                    <label  class="form-control-label">Choose Category</label>
                         <select class="chosen-select form-control" name="expense_category_id" id="form-field-select-3" data-placeholder="Choose a status">
                          @foreach($expense_categories as $expensecategory)
                               <option value="{{$expensecategory->id}}">{{$expensecategory->expense_category_name}}</option>
                          @endforeach
                          </select>
                                      
                   </div>
                
              </div>
             </div> 


             <div class="row">

              <div class ="col-lg-6">
                 <div class="form-group">
                  <label class="form-control-label"  for="amount">Amount<span class="tx-danger">*</span></label>
                  <input class="form-control" type="number" id="amount" name="expense_amount" value="{{old('expense_amount')}}" placeholder="amount">
                  <span class="text-danger">{{ $errors->first('expense_amount') }}
                </div>
              </div>

               <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Date<span class="tx-danger">*</span></label>
                            <input type="text" id="datepicker" value="{{old('expense_date')}}" width="400"
                                name="expense_date" class="form-control" placeholder="yy/mm/dd">
                                 <span class="text-danger">{{ $errors->first('expense_date') }}
                        </div>
              </div>


              

             </div>           

             <div class="form-group">
                      <label class="control-label"> Expense Category description <span class="tx-danger">*</span></label>
                      <div>
                          <textarea class="form-control" name="expense_description" cols="108" rows="5">
                              {{old('expense_description')}}
                          </textarea>
                          <span class="text-danger">{{ $errors->first('expense_description') }}
                                
                      </div>
             </div>


                

              <div class="form-layout-footer">
                <input type="submit" value="Save" class="btn btn-primary">
             
              </div><!-- form-layout-footer -->

             </form> 
            
                
           
           
            </div><!-- row -->

           
          </div><!-- form-layout -->
        </div>

@endsection

@section('js')
<script>
        $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" });
    </script>


@endsection
