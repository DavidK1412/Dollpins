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
        <h2>Información empleado</h2>

        <img alt="Company logo" class="logo" height="50" src="{{ asset('assets/logo.png') }}" width="50"/>

        <form action=""
        >
            <div class="row">
                <div class="col-md-6">
                    <label for="document">Identificación</label>
                    <input value="{{$data['employee']->document}}" class="form-control" placeholder="Identificacion" type="text" disabled>
                </div>
                <div class="col-md-6">
                    <label for="city">Ciudad</label>
                    <select name="city" class="form-select" id="prepend-button-single-field" data-placeholder="Ciudad" disabled>
                        @foreach($data['cities'] as $city)
                            @if( $city->id == $data['employee']->city_id)
                                <option value="{{$city->id}}" selected>{{$city->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="name">Nombre</label>
                    <input name="name" value="{{$data['employee']->name}}" class="form-control" placeholder="Nombre" type="text" disabled/>
                </div>
                <div class="col-md-6">
                    <label for="address">Dirección</label>
                    <input name="address"  value="{{$data['employee']->address}}" class="form-control" placeholder="Dirección" type="text" disabled/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="roles">Roles</label>
                    <select name="roles[]" class="form-control form-select" id="multiple-select-role" data-placeholder="Elige roles" multiple disabled>
                        @foreach($data['roles'] as $role)
                            @foreach($data['employeeRoles'] as $employeeRole)
                                @if(strtoupper($role->name) == $employeeRole->name)
                                    <option value="{{$role->id}}" selected>{{$role->name}}</option>
                                @endif
                            @endforeach
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="email">Correo electronico</label>
                    <input value="{{ $data['employee']->email }}" name="email" class="form-control" placeholder="Correo electronico" type="email" disabled/>
                </div>
                <div class="col-md-6">
                    <label for="positions">Cargos</label>
                    <select name="positions[]" class="form-control form-select" id="multiple-select-position" data-placeholder="Elige los cargos" multiple disabled>
                        @foreach($data['positions'] as $position)
                            @foreach($data['employeePositions'] as $employeePosition)
                                @if($position->id == $employeePosition->position_id)
                                    <option value="{{$position->id}}" selected>{{$position->name}}</option>
                                @endif
                            @endforeach
                        @endforeach
                    </select>
                </div>
            </div>
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
    </script>
@endsection
