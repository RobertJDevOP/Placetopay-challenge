@extends('layouts.auth')
@section('auth-content')

    <div class="container">
    <div class="card">
        <div class="card-content">
                            <caption>Sign up</caption>
            <form action="{{"/register"}}" method="POST">
                @csrf

                    <div class="columns">
                        <div class="column is-6">
                            <b-field label='Names' type="{{ $errors->has('name') ? 'is-danger' : null }}" message="{{ $errors->first('name') }}">
                                <b-input type="text" name="name" id="name" maxlength="255"  required></b-input>
                            </b-field>
                        </div>
                        <div class="column is-6">
                            <b-field label='Surnames' type="{{ $errors->has('surnames') ? 'is-danger' : null }}" message="{{ $errors->first('surnames') }}">
                                <b-input type="text" name="surnames"  maxlength="255"  required></b-input>
                            </b-field>
                        </div>
                    </div>


                <div class="columns">
                    <div class="column is-6">
                        <b-field label="Document type">
                            <b-select name="document_type" placeholder="Select a document type">
                                <option value="CC">CC-Cédula de ciudadanía</option>
                                <option value="CE">CE-Cédula de extranjería</option>
                                <option value="TI">TI-Tarjeta de identidad</option>
                                <option value="NIT">NIT-Número de Identificación Tributaria</option>
                                <option value="RUT">RUT-Registro único tributario</option>
                            </b-select>
                        </b-field>
                    </div>
                    <div class="column is-6">
                        <b-field label='Write the document number' type="{{ $errors->has('number_document') ? 'is-danger' : null }}" message="{{ $errors->first('number_document') }}">
                            <b-input type="number" name="number_document" maxlength="255"  required></b-input>
                        </b-field>
                    </div>
                </div>


                <div class="columns">
                    <div class="column is-6">
                        <b-field label='Email' type="{{ $errors->has('email') ? 'is-danger' : null }}" message="{{ $errors->first('email') }}">
                            <b-input type="email" name="email"  maxlength="255"  required></b-input>
                        </b-field>
                    </div>
                    <div class="column is-6">
                        <b-field label='Cell phone' type="{{ $errors->has('cell_phone') ? 'is-danger' : null }}" message="{{ $errors->first('cell_phone') }}">
                            <b-input type="number" name="cell_phone"  maxlength="255"   required></b-input>
                        </b-field>
                    </div>
                </div>


                <div class="columns">
                    <div class="column is-12">
                    <b-field label='Residence address' type="{{ $errors->has('user_street') ? 'is-danger' : null }}" message="{{ $errors->first('user_street') }}">
                        <b-input type="text" name="user_street"   maxlength="255"  required></b-input>
                    </b-field>
                    </div>

                </div>

                <div class="columns">
                    <div class="column is-6">
                        <b-field label='Password' type="{{ $errors->has('password') ? 'is-danger' : null }}" message="{{ $errors->first('password') }}">
                            <b-input type="password" name="password" id="password"  maxlength="255" icon="lock" required></b-input>
                        </b-field>
                    </div>
                    <div class="column is-6">
                        <b-field label='Password confirmation'  type="{{ $errors->has('password_confirmation') ? 'is-danger' : null }}" message="{{ $errors->first('password_confirmation') }}">
                            <b-input type="password" name="password_confirmation" id="password_confirmation"  maxlength="255" icon="lock" required></b-input>
                        </b-field>
                    </div>
                </div>



                    <button type="submit" class="button is-warning is-fullwidth"> <b-icon pack="fas" icon="save"></b-icon>&nbsp;
                        Sign up
                    </button>
            </form>

   </div>
 </div>
</div>
@endsection
