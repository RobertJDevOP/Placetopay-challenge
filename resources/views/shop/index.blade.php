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

    <h1 class="title">Welcome to our awesome market</h1>


    @foreach($products->chunk(3) as $row => $content)
        <div class="columns">
            @foreach($content as $key => $value)
                <div class="column is-4">
                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-4by3">
                                <img src="{{$value->url_product_img}}" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="media">

                                <div class="media-content">
                                    <p class="title is-4">{{$value->product_name }}</p>
                                    <p class="subtitle is-6">{{$value->category->name_category }}</p>
                                </div>
                                <div class="media-right">
                                    <b-button rounded  type="is-dark" size="is-large"
                                              icon-right="cart-variant" />
                                </div>
                            </div>

                            <div class="content">
                               $ {{$value->list_price}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach


    {{ $products->render('partials.pagination.paginator') }}
@endsection
