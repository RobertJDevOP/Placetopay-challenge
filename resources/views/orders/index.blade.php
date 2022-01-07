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
        <h1 class="title">Products</h1><br><br>
    </div>


    <b-button tag="a"  href="product/create"    type="is-warning is-light"> Create a new product</b-button><br><br>

    <table class="table is-narrow is-hoverable is-fullwidth">
        <thead>
        <tr>
            <th scope="col" class="has-text-centered">Purchase Order</th>
            <th scope="col" class="has-text-centered">Quantity</th>
            <th scope="col" class="has-text-centered">Total</th>
            <th scope="col" class="has-text-centered">Created at</th>
            <th scope="col" class="has-text-centered">Update at</th>
            <th scope="col" class="has-text-centered">Status</th>
            <th scope="col" class="has-text-centered">Options</th>
        </tr>
        </thead>
        <tbody>

        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->qty }}</td>
                <td>{{ $product->total }}</td>
                <td>{{ $product->crated_formatted }}</td>
                <td>{{ $product->update_formatted }}</td>
                <td>{{ $product->status }}</td>
                <td>
                    <b-button tag="a"  href="product/{{$product->id}}/edit"  size="is-small"  type="is-warning is-light"> <span class="icon is-small"><i class="mdi mdi-pencil-outline"></i></span> Edit product</b-button>
                    &nbsp;
                    <form action="product/{{$product->id}}/status" method="POST">
                        @csrf
                        @method('PUT')
                        <b-button  size="is-small"  name="validation" value="{{$product->status}}" type="is-info is-light" native-type="submit">
                            Change status
                        </b-button>
                    </form>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $products->render('partials.pagination.paginator') }}
@endsection
