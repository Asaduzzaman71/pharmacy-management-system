@extends('layouts.master')
@section('css')



@endsection

@section('content')
    <br>


    <div class="br-pagebody">
        <div class="br-section-wrapper">
         
            <div class="row">

                <div class="col-lg-3">
                    <h5>Edit Expense Category</h5>
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
                <form action="{{url('/expense-category/'.$expense_category->id)}}" method="post">
                    @method('PATCH')

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Expnese Category Name <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="expense_category_name"
                                       value="{{old('expense_category_name')  ?? $expense_category->expense_category_name}}"
                                       placeholder="Enter Medicine Category">
                                        <span class="text-danger">{{ $errors->first('expense_category_name') }}</span>


                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Choose Status</label>

                                <select class="chosen-select form-control" name="status" id="form-field-select-3"
                                        data-placeholder="Choose a status">

                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Category description <span class="tx-danger">*</span></label>
                        <div>
                          <textarea cols="108" rows="5" name="expense_category_description">
                              {{old('expense_category_description')  ?? $expense_category->expense_category_description}}
                          </textarea>

                        </div>
                        <span class="text-danger">{{ $errors->first('expense_category_description') }}</span>
                    </div>
                    <div class="form-layout-footer">
                        <input type="submit" value="Save" class="btn btn-primary">

                    </div><!-- form-layout-footer -->

                    @csrf

                </form>

            </div><!-- row -->

        </div><!-- form-layout -->
    </div>

@endsection

@section('js')

@endsection
