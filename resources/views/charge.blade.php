@extends('layouts.typical')
@section('title', 'stripe決済')

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
      
  <button type="submit" class="stripe-button-el-dummy" id="stripe-button-el" style="visibility: visible;"><span style="display: block; min-height: 30px;">はい</span></button>
  <script>
    document.getElementsByClassName("stripe-button-el")[0].style.display = 'none';
    document.getElementsByClassName("stripe-button-el-dummy")[0].style.display = 'none';

    $(function() {
      document.getElementById("stripe-button-el").click();
    });
  </script>
  </form>
@endsection