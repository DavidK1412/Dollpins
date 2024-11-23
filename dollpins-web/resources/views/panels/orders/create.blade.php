@extends('dashboard')
@section('dashboard-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
@endsection

@section('dashboard-panel')
    <!-- Tarjeta centrada para buscar un cliente -->
    <div class="card text-center">
        <div class="alert alert-danger" role="alert">
            <b>Importante</b>, una vez creada la orden, no se podrá modificar.
            Así mismo, si esta no se finaliza no se guardará ni se podrán reasignar productos.
            Importante, confirmar dos veces antes de confirmar cualquier acción.
            Es importante hacer este proceso con su respectiva atención y <b>decisiones finales</b>.
        </div>
        <div class="card-header">
            <h1>
                Crear orden
            </h1>
        </div>
        <div class="card-body">
            <h5 class="card-title
            ">Busca un cliente para crear una orden</h5>
            <p class="card-text">Puedes buscar un cliente por su nombre o identificación.</p>
            <form action="" method="POST">
                @csrf
                <!-- Select2 -->
                <select name="client_id" class="form-select" id="prepend-button-single-field" data-placeholder="Cliente">
                    @foreach($clients as $client)
                        <option value="{{$client->id}}">{{$client->name}} - {{$client->document}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-success mt-3">
                    <i class="bi bi-book bookmark-plus"></i>
                    Comenzar orden
                </button>
            </form>
        </div>
    </div>
@endsection

@section('dashboard-scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $( '#prepend-button-single-field').select2( {
            theme: "bootstrap-5",
            placeholder: $( this ).data( 'placeholder' ),
        } );
    </script>
@endsection

