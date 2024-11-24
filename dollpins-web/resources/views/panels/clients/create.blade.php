@extends('dashboard')

@section('dashboard-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
    <link rel="stylesheet" href="{{asset('css/panels/employees/new.css')}}">
@endsection

@section('dashboard-panel')
    <div class="form-container">
        <h2>Agregar nuevo cliente</h2>

        <img alt="Company logo" class="logo" height="50" src="{{ asset('assets/logo.png') }}" width="50"/>

        <form action="{{ route('clients.store') }}" method="POST" id="createForm">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <select name="id_type_client" class="form-select" id="prepend-button-single-field" data-placeholder="Tipo Cliente">
                        @foreach($data['typeClients'] as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <input name="document" class="form-control" placeholder="Identificacion" type="text"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <input name="name" class="form-control" placeholder="Nombre" type="text"/>
                </div>
                <div class="col-md-6">
                    <input name="address" class="form-control" placeholder="Dirección" type="text"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <input name="cellphone" class="form-control" placeholder="Teléfono" type="text"/>
                </div>
                <div class="col-md-6">
                    <input name="postal_code" class="form-control" placeholder="Código Postal" type="text"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <input name="mail" class="form-control" placeholder="Correo electrónico" type="email"/>
                </div>
                <div class="col-md-6">
                    <select name="id_city" class="form-select" id="prepend-button-single-field1" data-placeholder="Tipo Cliente">
                        @foreach($data['cities'] as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button class="btn btn-custom" type="submit">Agregar Cliente</button>
        </form>
    </div>
@endsection

@section('dashboard-scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>

        $( '#prepend-button-single-field' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
        } );
        $( '#prepend-button-single-field1' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
        } );

    </script>
@endsection
