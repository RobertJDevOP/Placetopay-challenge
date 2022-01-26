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
        <h1 class="title">Create a new product</h1><br>
    </div>
    <div class="card">
        <div class="card-content">

            <form action="{{route('product.register')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="columns">
                    <div class="column is-4">
                        <b-field label='Reference' type="{{ $errors->has('code') ? 'is-danger' : null }}" message="{{ $errors->first('code') }}">
                            <b-input type="text"  name="code"  maxlength="10" ></b-input>
                        </b-field>

                    </div>
                    <div class="column is-4">
                        <b-field label='Product name' type="{{ $errors->has('product_name') ? 'is-danger' : null }}" message="{{ $errors->first('product_name') }}">
                            <b-input type="text"  name="product_name"  maxlength="255" ></b-input>
                        </b-field>

                    </div>
                    <div class="column is-4">
                        <label class="label" >Category</label>
                            <div  class="select {{ $errors->has('category_id') ? 'is-danger' : null }}">
                                <select name="category_id">
                                    <option >Select the product category</option>
                                    @foreach($candies as $row)
                                        <option value="{{$row->id}}">{{$row->name_category}}</option>
                                    @endforeach
                                </select>
                            </div>
                        <p class="{{ $errors->has('category_id') ? 'help is-danger' : null }}">{{ $errors->first('category_id') }}</p>
                    </div>
                </div>



                <div class="columns">
                    <div class="column is-6">
                        <b-field label='Price' type="{{ $errors->has('price') ? 'is-danger' : null }}" message="{{ $errors->first('price') }}">
                            <b-input type="number"  name="price"></b-input>
                        </b-field>

                    </div>
                    <div class="column is-6">
                        <b-field label='List price' type="{{ $errors->has('list_price') ? 'is-danger' : null }}" message="{{ $errors->first('list_price') }}">
                            <b-input type="number"  name="list_price"></b-input>
                        </b-field>
                    </div>
                </div>



                <div class="columns">
                    <div class="column is-12">
                        <label class="label">Product picture</label>
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
                            Create product
                         </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection


<script type="application/javascript">

    document.addEventListener('DOMContentLoaded', () => {
        // 1. Display file name when select file
        let fileInputs = document.querySelectorAll('.file.has-name')
        for (let fileInput of fileInputs) {
            let input = fileInput.querySelector('.file-input')
            let name = fileInput.querySelector('.file-name')
            input.addEventListener('change', () => {
                let files = input.files
                if (files.length === 0) {
                    name.innerText = 'No file selected'
                } else {
                    name.innerText = files[0].name
                }
            })
        }

        // 2. Remove file name when form reset
        let forms = document.getElementsByTagName('form')
        for (let form of forms) {
            form.addEventListener('reset', () => {
                console.log('a')
                let names = form.querySelectorAll('.file-name')
                for (let name of names) {
                    name.innerText = 'No file selected'
                }
            })
        }
    })

</script>
