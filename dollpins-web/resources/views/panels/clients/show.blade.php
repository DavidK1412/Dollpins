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
        <h2>Detalle cliente</h2>

        <img alt="Company logo" class="logo" height="50" src="{{ asset('assets/logo.png') }}" width="50"/>

        <form id="createForm">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="id_type_client">Tipo Cliente</label>
                    <input name="id_type_client" class="form-control" placeholder="Tipo Cliente" type="text"
                        value="{{ $data['typeClient']->name }}" disabled/>

                </div>
                <div class="col-md-6">
                    <label for="document">Identificación</label>
                    <input name="document" class="form-control" placeholder="Identificacion" type="text"
                        value="{{ $data['client']->document }}" disabled/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="name">Nombre</label>
                    <input name="name" class="form-control" placeholder="Nombre" type="text"
                        value="{{ $data['client']->name }}" disabled/>

                </div>
                <div class="col-md-6">
                    <label for="address">Dirección</label>
                    <input name="address" class="form-control" placeholder="Dirección" type="text"
                        value="{{ $data['client']->address }}" disabled/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="cellphone">Teléfono</label>
                    <input name="cellphone" class="form-control" placeholder="Teléfono" type="text"
                        value="{{ $data['client']->cellphone }}" disabled/>

                </div>
                <div class="col-md-6">
                    <label for="postal_code">Código Postal</label>
                    <input name="postal_code" class="form-control" placeholder="Código Postal" type="text"
                        value="{{ $data['client']->postal_code }}" disabled/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="mail">Correo electrónico</label>
                    <input name="mail" class="form-control" placeholder="Correo electrónico" type="email"
                        value="{{ $data['client']->mail }}" disabled/>
                </div>
                <div class="col-md-6">
                    <label for="id_city">Ciudad</label>
                    <input name="id_city" class="form-control" placeholder="Ciudad" type="text"
                        value="{{ $data['city']->name }}" disabled/>
                </div>
            </div>
        </form>


        <a href="{{ route('clients.index') }}" class="btn btn-primary">Volver</a>


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
