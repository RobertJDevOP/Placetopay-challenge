@extends('layouts.admin')
@section('content')
    @if (\Session::has('success'))
        <b-message
            title="Success"
            type="is-success"
            aria-close-label="Close message">
            {!! \Session::get('success') !!}
        </b-message>
    @endif

    <div class="level-left">
        <h1 class="title">Purchase order #  {{ $purchaseOrder->id  }}  </h1><br>
    </div>
    <div class="card">
        <div class="card-content">

            the current status of the purchase order is  {{ $purchaseOrder->status  }},
            Please go to the purchase order history module to retry the payment or know the current status, keep in mind that this process may take a few minutes

            <br>  <br>
            <div class="columns">
                <div class="column is-6">
                    <a type="is-link" href="/orders" class="button button is-fullwidth is-success is-light">
                        Go to history purchase order
                    </a>

                </div>
                <div class="column is-6">

                </div>
            </div>
        </div>
    </div>

@endsection
