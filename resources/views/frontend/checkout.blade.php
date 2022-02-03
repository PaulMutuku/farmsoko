@extends('layouts.front')

@section('title')
    Checkout
@endsection

@section('content')
<div class="py-3 mb-4 shadow-sm  border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('/')}}">
                Home
            </a> 
            
           <!-- <a href="{{url('checkout')}}">
               Checkout
            </a> -->
            
        </h6>
    </div>
</div>
    <div class="container mt-3">
        <form action="{{url('place-order')}}" method="POST">
            {{csrf_field() }}
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h6>Basic Details</h6>
                            <hr>
                            <div class="row checkout-form">
                            
                                    <input type="hidden" class="form-control" value="{{Auth::user()->id}}" name="id" placeholder="Enter First Name">
                               
                                <div class="col-md-6">
                                    <label for="">Fisrt Name</label>
                                    <input type="text" required class="form-control firstname" value="{{Auth::user()->name}}" name="fname" placeholder="Enter First Name">
                                    <span id="fname_error " class="text-danger"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="">Last Name</label>
                                    <input type="text" required class="form-control lastname" value="{{Auth::user()->lname}}" name="lname" placeholder="Enter Last Name">
                                    <span id="lname_error" class="text-danger"></span>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Email </label>
                                    <input type="text" required class="form-control email" value="{{Auth::user()->email}}" name="email" placeholder="Enter Email">
                                    <span id="email_error " class="text-danger"></span>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Phone Number</label>
                                    <input type="text" required class="form-control phone" value="{{Auth::user()->phone}}" name="phone" placeholder="Enter Phone Number">
                                    <span id="phone_error " class="text-danger"></span>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Address 1</label>
                                    <input type="text" required class="form-control address1" value="{{Auth::user()->address1}}" name="address1" placeholder="Enter Address 1">
                                    <span id="address1_error " class="text-danger"></span>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Address 2</label>
                                    <input type="text" required class="form-control address2" value="{{Auth::user()->address2}}" name="address2" placeholder="Enter Address 2">
                                    <span id="address2_error " class="text-danger"></span>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">City</label>
                                    <input type="text" required class="form-control city" value="{{Auth::user()->city}}" name="city" placeholder="Enter City">
                                    <span id="city_error " class="text-danger"></span>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="">Country</label>
                                    <input type="text" required class="form-control country" value="{{Auth::user()->country}}" name="country" placeholder="Enter Country">
                                    <span id="country_error " class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>Order Details</h6>
                            <hr>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartitems as $item)
                                    <tr>
                                        <td>{{ $item->products->name }}</td>
                                        <td>{{ $item->prod_qty }}</td>
                                        <td>{{ $item->products->selling_price }}</td>
                                    
                                    </tr>
                                    @endforeach                               
                                </tbody>
                            </table>
                            <hr>
                            <button type="submit" class="btn btn-success w-100">Place Order</button>
                            <!--<button type = "button "class="btn btn-primary w-100 mt-3 razorpay_btn">Pay with Razorpay</button>-->
                        
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@endsection