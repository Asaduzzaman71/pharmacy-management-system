@extends('layouts.master')
@section('css')

@endsection

@section('content')
<br>
<div class="br-pagebody">
    <div class="br-section-wrapper" style="margin-left: 0px">

        @include('include._message')

        <div class="row">
            <h5 style="color: black">Purchase Medicine</h5>

        </div>
        <hr>

        <div class="form-layout form-layout-1" style="margin-left: -20px">
            <form action="">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" style="color:black">Search By Medicine Name</label>
                            <input class="form-control" type="text" id="medicine_name_input" autocomplete="off" name="medicine_name_input" value=""
                                placeholder="Insert medicine name to search">
                            <div id="medicine_list">
                            </div>
                        </div>
                    </div>
                    
                </div>
            </form>

            <br>
            <br>
            <div class="row" >
                <div class="col-lg-4">

                    <table class="table table-bordered table-colored table-dark" id ="memo">
                        <tbody>
                            <tr>
                                <th class="wd-10p">Name</th>
                                <td id="medicine_name"></td>
                            </tr>
                            <tr>
                                <th class="wd-35p">Category</th>
                                <td id="category_name"></td>
                            </tr>
                            <tr>
                                <th class="wd-35p">Company</th>
                                <td id="company_name"></td>
                            </tr>
                            <tr>
                                <th class="wd-20p">Expire Date</th>
                                <td id="expire_date"></td>
                            </tr>
                            <tr>
                                <th class="wd-20p">Expire Date</th>
                                <td id="expire_date"></td>
                            </tr>

                            <tr>
                                <th class="wd-20p">Selling Price</th>
                                <td id="selling_price"></td>
                            </tr>


                            <tr>
                                <th class="wd-20p">Purchase Quantity</th>
                                <td>
                                <form id="purchase" action="" method="post">
                                    @csrf
                                        <div class="form-group">

                                            <input type="hidden" name="medicine_id" id="medicine_id">
                                            <input class="form-control" type="number" min="1" id="purchaseQuantity"  name="sellQuantity"
                                                value="{{old('sellQuantity')}}" placeholder="quantity">
                                        </div>
                                </td>
                            </tr>

                            <tr>
                                
                                <th class="wd-20p">Purchase Price</th>
                                <td>
                                        <div class="form-group">
                                            <input class="form-control" type="number" min="1" id="purchase_price"  name="purchase_price"
                                                value="{{old('purchase_price')}}" placeholder="Purchase Price">
                                        </div>

                                        <input type="submit" class="btn btn-dark" value="Add to list">
                                </td>
                            </tr>

                            </form>
                        </tbody>
                    </table>
              </div>

 
</div>
</div>  

<br>

@endsection

@section('js')

<script>
$(document).ready(function(){


$("#memo").hide();
//$("#memoSaveInvoice").hide();

// $( "#product" ).submit(function( event ) {
//     event.preventDefault();
//     var x = $('#quantity').text();
//     var y = $('#sellQuantity').val();
//     if(y!== undefined)
//     {
//         event.submit();
//     }
//     else{

//         alert( "Input a valid quantity" );
//     }


// });

 $('#medicine_name_input').keyup(function(){
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('purchase.liveSearch') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
           $('#medicine_list').fadeIn();
                    $('#medicine_list').html(data);
          }
         });
        }
    });
    $(document).on('click', 'li', function(){
        $('#medicine_name_input').val($(this).text());
        $('#medicine_list').fadeOut();

        var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{route('purchase.searchMedicine')}}",
          method:"POST",
          data:{query:$(this).text(), _token:_token},
          success:function(data){
            $('#medicine_id').val(data.result.id);
            $('#medicine_name').text(data.result.medicine_name);
            $('#category_name').text(data.result.category['category_name']);
            $('#company_name').text(data.result.company_name);
            $('#expire_date').text(data.result.expire_date);
            $('#selling_price').text(data.result.selling_price);
            $('#quantity').text(data.result.quantity);
            $("#memo").show();
            $('#sellQuantity').attr('max',data.result.quantity);
          }
         });

    });

    });

</script>

@endsection
