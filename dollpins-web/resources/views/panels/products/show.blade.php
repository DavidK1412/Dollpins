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
        <h2>Detalle producto</h2>

        <img alt="Company logo" class="logo" height="50" src="{{ asset('assets/logo.png') }}" width="50"/>

        <form id="createForm">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="category_id">Categoría</label>
                    <input name="category_id" class="form-control" placeholder="Categoría" type="text"
                           value="{{ $data['category']->name }}" disabled/>
                </div>
                <div class="col-md-6">
                    <label for="name">Nombre</label>
                    <input name="name" class="form-control" placeholder="Nombre" type="text"
                           value="{{ $data['product']->name }}" disabled/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="price">Precio</label>
                    <input name="price" class="form-control" placeholder="Precio" type="number"
                           value="{{ $data['product']->price }}" disabled/>
                </div>
                <div class="col-md-6">
                    <label for="stock">Stock</label>
                    <input name="stock" class="form-control" placeholder="Stock" type="number"
                           value="{{ $data['product']->stock }}" disabled/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="description">Descripción</label>
                    <textarea name="description" class="form-control" placeholder="Descripción" disabled>{{$data['product']->description}}</textarea>
                </div>
            </div>

            <a href="{{ route('products.index') }}" class="btn btn-custom" type="submit">Volver</a>
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
