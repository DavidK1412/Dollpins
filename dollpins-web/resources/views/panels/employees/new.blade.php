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
        <h2>Agregar nuevo empleado</h2>

        <img alt="Company logo" class="logo" height="50" src="{{ asset('assets/logo.png') }}" width="50"/>

        <form action="{{route('employee.store')}}" method="POST" id="createForm"
        >
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <input name="document" class="form-control" placeholder="Identificacion" type="text"/>
                </div>
                <div class="col-md-6">
                    <select name="city" class="form-select" id="prepend-button-single-field" data-placeholder="Ciudad">
                        @foreach($data['cities'] as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
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
                    <input name="phone" class="form-control" placeholder="Teléfono" type="text"/>
                </div>
                <div class="col-md-6">
                    <select name="roles[]" class="form-control form-select" id="multiple-select-role" data-placeholder="Elige roles" multiple>
                        @foreach($data['roles'] as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <input name="email" class="form-control" placeholder="Correo electronico" type="email"/>
                </div>
                <div class="col-md-6">
                    <select name="positions[]" class="form-control form-select" id="multiple-select-position" data-placeholder="Elige los cargos" multiple>
                        @foreach($data['positions'] as $position)
                            <option value="{{$position->id}}">{{$position->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button class="btn btn-custom" type="submit">Agregar Empleado</button>
        </form>
    </div>
@endsection

@section('dashboard-scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $( '#multiple-select-role' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
        } );
        $( '#multiple-select-position' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
        } );
        $( '#prepend-button-single-field' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
        } );

        const form = document.getElementById('createForm');
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            const roles = $('#multiple-select-role').val();
            const positions = $('#multiple-select-position').val();
            formData.append('jsonRoles', JSON.stringify(roles)); // change value of the select to the array
            formData.append('jsonPositions', JSON.stringify(positions));

            form.submit();
        });
    </script>
@endsection
