@extends('layouts.main')
@section('title', 'Payment Form')
<style>
    .card {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
      max-width: 550px;
      margin: auto;
      text-align: center;
      font-family: arial;
    }

    .price {
      color: grey;
      font-size: 22px;
    }

    .card button {
      border: none;
      outline: 0;
      padding: 12px;
      color: white;
      background-color: #000;
      text-align: center;
      cursor: pointer;
      width: 100%;
      font-size: 18px;
    }

    .card button:hover {
      opacity: 0.7;
    }
    </style>
@section('content')

<div class="card">
    <center><img src="{{asset('images').'/'. $product->image }}" alt="Denim Jeans" style="width:200px; Height:250px;"></center>
    <h1>{{ $product->name }}</h1>
    <p class="price">${{ $product->price }}</p>
    <p>{{ $product->description }}</p>
    {{-- <p><button>Add to Cart</button></p> --}}
  </div>
<main>
    <div class="row">
        <aside class="col-sm-6 offset-3">
            <article class="card">
                <div class="card-body p-5">
                    @foreach (['danger', 'success'] as $status)
                    @if(Session::has($status))
                        <p class="alert alert-{{$status}}">{{ Session::get($status) }}</p>
                    @endif
                @endforeach
                    <ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#nav-tab-card">
                            <i class="fa fa-credit-card"></i> Credit Card</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="nav-tab-card">

                            <form role="form" method="POST" id="paymentForm" action="{{ url('/payment')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="username">Full name (on the card)</label>
                                    <input type="text" class="form-control" name="fullName" placeholder="Full Name">
                                </div>
                                <div class="form-group">
                                    <label for="cardNumber">Card number</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="cardNumber" placeholder="Card Number">
                                        <div class="input-group-append">
                                            <span class="input-group-text text-muted">
                                            <i class="fab fa-cc-visa fa-lg pr-1"></i>
                                            <i class="fab fa-cc-amex fa-lg pr-1"></i>
                                            <i class="fab fa-cc-mastercard fa-lg"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label><span class="hidden-xs">Expiration</span> </label>
                                            <div class="input-group">
                                                <select class="form-control" name="month">
                                                    <option value="">MM</option>
                                                    @foreach(range(1, 12) as $month)
                                                        <option value="{{$month}}">{{$month}}</option>
                                                    @endforeach
                                                </select>
                                                <select class="form-control" name="year">
                                                    <option value="">YYYY</option>
                                                    @foreach(range(date('Y'), date('Y') + 10) as $year)
                                                        <option value="{{$year}}">{{$year}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label data-toggle="tooltip" title=""
                                                data-original-title="3 digits code on back side of the card">CVV <i
                                                class="fa fa-question-circle"></i></label>
                                            <input type="number" class="form-control" placeholder="CVV" name="cvv">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="amount" value="{{ $product->price }}">
                                <button class="subscribe btn btn-primary btn-block" type="submit"> Confirm </button>
                            </form>
                        </div>
                    </div>
                </div>
            </article>
        </aside>
    </div>
</main>
@endsection
@section('scripts')
@parent
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/additional-methods.min.js') }}"></script>
    <script>
        $( "#paymentForm" ).validate({
            errorPlacement: function(){
                return false
            },
            rules: {
                fullName: {
                    required: true,
                    maxlength: 50
                },
                cardNumber: {
                    required: true,
                    creditcard: true
                },
                month: "required",
                year: "required",
                cvv: {
                    required: true,
                    minlength: 3,
                    maxlength: 3
                }
            }
        });
    </script>
@endsection
