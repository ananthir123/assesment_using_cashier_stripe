@extends('layouts.main')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<style>
    body {
    margin: 0;
    font-family: Roboto,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
    font-size: .8125rem;
    font-weight: 400;
    line-height: 1.5385;
    color: #333;
    text-align: left;
    background-color: #2196F3;
}

.mt-50{

    margin-top: 50px;
}

.mb-50{

    margin-bottom: 50px;
}



.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: .1875rem;
}

.card-img-actions {
    position: relative;
}
.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem;
    text-align: center;
}

.card-img{

    width: 350px;
}

.star{
        color: red;
}

.bg-cart {
    background-color:orange;
    color:#fff;
}

.bg-cart:hover {

    color:#fff;
}

.bg-buy {
    background-color:green;
    color:#fff;
    padding-right: 29px;
}
.bg-buy:hover {

    color:#fff;
}

a{

    text-decoration: none !important;
}
.button {
  background-color: #08090867;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>
<div class="container d-flex justify-content-center mt-50 mb-50">

    <div class="row">
        @foreach($products as $product)
       <div class="col-md-4 mt-2">


            <div class="card">
                                <div class="card-body">
                                    <div class="card-img-actions">

                                            <img src="{{asset('images').'/'. $product->image }}" class="card-img img-fluid" width="96" height="350" alt="">


                                    </div>
                                </div>

                                <div class="card-body bg-light text-center">
                                    <div class="mb-2">
                                        <h6 class="font-weight-semibold mb-2">
                                            <a href="#" class="text-default mb-2" data-abc="true">{{ $product->name }}</a>
                                        </h6>

                                        <a href="#" class="text-muted" data-abc="true">Foot Wear & shoes</a>
                                    </div>

                                    <h3 class="mb-0 font-weight-semibold">${{ $product->price }}</h3>

                                    <div>
                                       <i class="fa fa-star star"></i>
                                       <i class="fa fa-star star"></i>
                                       <i class="fa fa-star star"></i>
                                       <i class="fa fa-star star"></i>
                                    </div>

                                    {{-- <a href="{{ url('buy-now').'/'.$product->id}}"><button type="button" class="btn bg-cart"><i class="fa fa-cart-plus mr-2"></i> Buy Now</button></a> --}}

                                 <a href="{{ url('buy-now').'/'.$product->id}}" class="button"><i class="fa fa-cart-plus mr-2"></i> Buy Now</a>

                                </div>
                            </div>




       </div>
       @endforeach


    </div>
</div>
