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
        <h1 class="title">Update product</h1><br>
    </div>
    <div class="card">
        <div class="card-content">

            <form action="/product/{{$product->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')


                <div class="columns">
                    <div class="column is-8">
                        <b-field label='Product name'  type="{{ $errors->has('product_name') ? 'is-danger' : null }}" message="{{ $errors->first('product_name') }}">
                            <b-input type="text"  value="{{$product->product_name}}" name="product_name"  maxlength="255" ></b-input>
                        </b-field>

                    </div>
                    <div class="column is-4">
                        <label class="label" >Category</label>
                        <div  class="select {{ $errors->has('category_id') ? 'is-danger' : null }}">
                            <select name="category_id">
                                <option  value="{{$product->id}}">{{$product->category->name_category}}</option>
                                @foreach($candies as $row)
                                        @if($row->id==$product->category_id)
                                        @else
                                         <option value="{{$row->id}}">{{$row->name_category}}</option>
                                        @endif
                                @endforeach
                            </select>
                        </div>
                        <p class="{{ $errors->has('category_id') ? 'help is-danger' : null }}">{{ $errors->first('category_id') }}</p>
                    </div>
                </div>



                <div class="columns">
                    <div class="column is-6">
                        <b-field label='Price' type="{{ $errors->has('price') ? 'is-danger' : null }}" message="{{ $errors->first('price') }}">
                            <b-input type="number" value="{{$product->price}}"  name="price"></b-input>
                        </b-field>

                    </div>
                    <div class="column is-6">
                        <b-field label='List price' type="{{ $errors->has('list_price') ? 'is-danger' : null }}" message="{{ $errors->first('list_price') }}">
                            <b-input type="number" value="{{$product->list_price}}"  name="list_price"></b-input>
                        </b-field>
                    </div>
                </div>

                <div class="columns">
                    <div class="column is-12">
                        <label class="label" >Actually product image</label>
                        <img  width="140px" height="160px" src="{{$product->image}}"/>
                    </div>
                </div>

                <div class="columns">
                    <div class="column is-12">
                        <label class="label">Update product picture</label>
                        <p>Only format .jpg,.png,.bmp is allowed and the maximum size allowed is 2000 kilobytes </p>
                        <div class="file is-{{ $errors->has('url_product_img') ? 'danger' : 'warning' }} has-name">
                            <label class="file-label">
                                <input class="file-input" type="file" name="url_product_img">
                                <span class="file-cta">
                                  <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                  </span>
                                  <span class="file-label">
                                    Choose file
                                  </span>
                                </span>
                                <span class="file-name">
                                 productPicture.png
                                </span>
                            </label>
                        </div>

                        <p class="{{ $errors->has('url_product_img') ? 'help is-danger' : null }}">{{ $errors->first('url_product_img') }}</p>
                    </div>
                </div>

                <br>
                <div class="columns">
                    <div class="column is-6">
                        <a type="is-link" href="/products" class="button button is-fullwidth is-danger is-light">
                            Cancel
                        </a>

                    </div>
                    <div class="column is-6">

                        <button type="submit" class="button button is-fullwidth is-warning is-light">
                            Update product
                        </button>
                    </div>
                </div>


            </form>

        </div>
    </div>

@endsection
