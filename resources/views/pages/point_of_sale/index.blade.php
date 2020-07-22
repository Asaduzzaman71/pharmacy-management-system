@extends('layouts.master')
@section('css')

@endsection

@section('content')
    <br>
    <div class="br-pagebody">
        <div class="br-section-wrapper" style="margin-left: 0px">

            @if(Session::has('message'))
                <div class="alert alert-danger" role="alert">
                    <strong></strong>{{Session::get('message')}}
                </div>
            @endif

            <div class="row">
                <h5 style="color: black">Point Of Sale</h5>

            </div>
            <hr>

            <div class="form-layout form-layout-1" style="margin-left: -20px">
                <form action="">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" style="color:black">Search By Medicine Name</label>
                                <input class="form-control" autocomplete="off" type="text" id="medicine_name_input"
                                       name="medicine_name_input" value="" placeholder="Insert medicine name to search">
                                <div id="medicine_list">
                                </div>
                            </div>
                        </div>

                    </div>
                </form>

                <br>
                <br>
                <div class="row">
                    <div class="col-lg-4">

                        <table class="table table-bordered table-colored table-dark" id="memo">
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
                                <th class="wd-20p">Price</th>
                                <td id="selling_price">$</td>
                            </tr>

                            <tr>
                                <th class="wd-20p">Available Qty</th>
                                <td id="quantity"></td>
                            </tr>
                            <tr>
                                <th class="wd-20p">Sell Qty</th>
                                <td>
                                    <form id="product" action="{{route('invoice.add')}}" method="post">
                                        @csrf
                                        <div class="form-group">

                                            <input type="hidden" name="medicine_id" id="medicine_id">
                                            <input class="form-control" type="number" min="1" id="sellQuantity"
                                                   name="sellQuantity" value="{{old('sellQuantity')}}"
                                                   placeholder="quantity">

                                        </div>
                                        <input type="submit" id="add_cart" class="btn btn-dark" value="Add to list">
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-8" style="margin-left:-0px">
                        <?php
                        $invoice_items = Cart::content();
                        $i = 0;
                        ?>
                        <div class="container">
                            <div class="row">
                                <table class="table table-bordered table-colored table-dark">
                                    <thead>
                                    <tr>
                                        <th class="wd-10p">SN</th>
                                        <th class="wd-35p">Medicine Name</th>
                                        <th class="wd-20p">Quantity</th>
                                        <th class="wd-20p">Unit Price</th>
                                        <th class="wd-20p">Sub Total</th>
                                        <th class="wd-20p">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($invoice_items as $items)
                                        <tr>
                                            <th scope="row">{{++$i}}</th>
                                            <td id="name_medicine">{{ $items->name}}</td>
                                            <td>{{ $items->qty}}</td>
                                            <td>{{ $items->price}}</td>
                                            <td>{{ $items->qty*$items->price}}</td>
                                            <td>
                                                <a class="cart_quantity_delete"
                                                   href="{{route('invoice.delete',$items->rowId)}}"><i
                                                        class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div id="memoSaveInvoice">
                                <div class="row">
                                    <div>
                                        <h6 style="color:black">Total : <span>{{Cart::total()}}tk</span></h6>
                                    </div>
                                </div>
                                <form id="invoice" action="{{ route('invoice.save') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" style="color:black">Insert vat(%)
                                                    amount</label>
                                                <input class="form-control" type="number" min="0" max="100" name="vat"
                                                       value="{{old('vat') ?? 0}}" placeholder="0">
                                            </div>
                                        </div>
                                        <div class="col col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" style="color:black">Insert Discount
                                                    amount</label>
                                                <input class="form-control" type="number" min="0" max="100"
                                                       name="discount"
                                                       value="{{old('discount') ?? 0}}" placeholder="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="saveInvoice">
                                        <input type="submit" id="submit" value="Save Invoice" class="btn btn-dark">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <br>

        @endsection

        @section('js')
            <script>
                $(document).ready(function () {

                    //Validation of form add cart to cart

                    $('#product').submit(function (event) {
                        if ($('#sellQuantity').val() != '' && $('#medicine_name').text() != '') {
                            return true;
                        } else {
                            event.preventDefault();
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            })

                        }
                    });

                    //Validation of form save invoice

                    $('#invoice').submit(function (event) {
                        if ($('#name_medicine').text() != '') {
                            return true;
                        } else {
                            event.preventDefault();
                            Swal.fire(
                                'Please Add product In Cart'
                            )
                        }


                    });

                    $('#medicine_name_input').keyup(function () {
                        var query = $(this).val();
                        if (query != '') {
                            var _token = $('input[name="_token"]').val();
                            $.ajax({
                                url: "{{ route('pointofsale.liveSearch') }}",
                                method: "POST",
                                data: {query: query, _token: _token},
                                success: function (data) {
                                    $('#medicine_list').fadeIn();
                                    $('#medicine_list').html(data);
                                }
                            });
                        }
                    });
                    $(document).on('click', 'li', function () {
                        $('#medicine_name_input').val($(this).text());
                        $('#medicine_list').fadeOut();

                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url: "{{route('pointofsale.searchMedicine')}}",
                            method: "POST",
                            data: {query: $(this).text(), _token: _token},
                            success: function (data) {
                                $('#medicine_id').val(data.result.id);
                                $('#medicine_name').text(data.result.medicine_name);
                                $('#category_name').text(data.result.category['category_name']);
                                $('#company_name').text(data.result.company_name);
                                $('#expire_date').text(data.result.expire_date);
                                $('#selling_price').text(data.result.selling_price);
                                $('#quantity').text(data.result.quantity);
                                // $("#memo").show();
                                $('#sellQuantity').attr('max', data.result.quantity);
                            }
                        });

                    });

                });

            </script>

@endsection
