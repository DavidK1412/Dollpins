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
        <h2>Editar empleado</h2>

        <img alt="Company logo" class="logo" height="50" src="{{ asset('assets/logo.png') }}" width="50"/>

        <form action="{{Route('employee.update', ['id' => $data['employee']->id])}}" method="POST" id="createForm"
        >
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <input value="{{$data['employee']->document}}" class="form-control" placeholder="Identificacion" type="text" disabled>
                </div>
                <div class="col-md-6">
                    <select name="city" class="form-select" id="prepend-button-single-field" data-placeholder="Ciudad" required>
                        @foreach($data['cities'] as $city)
                            @if( $city->id == $data['employee']->city_id)
                                <option value="{{$city->id}}" selected>{{$city->name}}</option>
                            @else
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <input name="name" value="{{$data['employee']->name}}" class="form-control" placeholder="Nombre" type="text" required/>
                </div>
                <div class="col-md-6">
                    <input name="address"  value="{{$data['employee']->address}}" class="form-control" placeholder="Dirección" type="text" required/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <input value="{{ $data['employee']->email }}" name="email" class="form-control" placeholder="Correo electronico" type="email" disabled required/>
                </div>
                <div class="col-md-6">
                    <select name="roles[]" class="form-control form-select" id="multiple-select-role" data-placeholder="Elige roles" multiple required>
                        @foreach($data['roles'] as $role)
                            @if(!$data['employeeRoles']->isEmpty())
                                @foreach($data['employeeRoles'] as $employeeRole)
                                    @if(strtoupper($role->name) == $employeeRole->name)
                                        <option value="{{$role->id}}" selected>{{$role->name}}</option>
                                    @else
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endif
                                @endforeach
                            @else
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <select name="positions[]" class="form-control form-select" id="multiple-select-position" data-placeholder="Elige los cargos" multiple required>

                        @foreach($data['positions'] as $position)
                            @if(!$data['employeePositions']->isEmpty())
                                @foreach($data['employeePositions'] as $employeePosition)
                                    @if($position->id == $employeePosition->position_id)
                                        <option value="{{$position->id}}" selected>{{$position->name}}</option>
                                    @else
                                        <option value="{{$position->id}}">{{$position->name}}</option>
                                    @endif
                                @endforeach
                            @else
                                <option value="{{$position->id}}">{{$position->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <br>
            <button class="btn btn-custom" type="submit">Editar Empleado</button>
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
