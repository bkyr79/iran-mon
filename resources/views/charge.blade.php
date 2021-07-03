@extends('layouts.typical')
@section('title', 'stripe決済')

@section('stylesheet')
  <link href="{{ asset('/css/loader_after_buy.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('body')
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <form action="{{ asset('charge') }}" method="POST" name="charge_form">
    {{ csrf_field() }}
      <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="{{ env('STRIPE_KEY') }}"
        data-amount="{{ $goods_price }}"
        data-name="Stripe Demo"
        data-label="はい"
        data-description="Online course about integrating Stripe"
        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
        data-locale="auto"
        data-currency="JPY">
      </script>
      
      <!-- 購入直後にローダーを表示させる -->
      <script>
        $(function(){
          setTimeout(function(){
            $("#loading").fadeIn();
          },10000);
        });
      </script>

  <button type="submit" class="stripe-button-el-dummy" id="stripe-button-el" style="visibility: visible;"><span style="display: block; min-height: 30px;">はい</span></button>
  
  <!-- ローダー -->
  <div id="loading" style="display: none"><img src="/storage/uploads/ajax-loader.gif"></div>

  <script>
    document.getElementsByClassName("stripe-button-el")[0].style.display = 'none';
    document.getElementsByClassName("stripe-button-el-dummy")[0].style.display = 'none';

    $(function() {
      document.getElementById("stripe-button-el").click();
    });
  </script>
  </form>
@endsection