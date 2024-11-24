@extends('dashboard')

@section('dashboard-panel')
    <h1>
        Hola {{ getEmployeeName() }},
    </h1>
    <h2>
        Nómina - {{ $payroll->employee->name }} C.C {{ $payroll->employee->document }}
    </h2>
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ Route('payrolls.newPayment',
    ['payroll_id' => $payroll->id]
)  }}" class="btn btn-success" style="background-color: #8fd6c8 !important;"><i class="bi bi-bookmark-plus"></i> Registrar nuevo pago. </a>
    <table id="example" class="table table-bordered table-hover nowrap" style="width:100%">
        <thead>
        <tr>
            <th>Fecha</th>
            <th>Valor total</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->payment_date }}</td>
                <td>{{ $payment->amount }}</td>
                <td>
                    <a href="{{Route('payrolls.detailPayment', ['payment_id' => $payment->id])}}" class="btn btn-info"><i class="bi bi-eye"></i></a>
                </td>
            </tr>
        @endforeach


        </tbody>
    </table>

@endsection

@section('dashboard-scripts')
    <script>
        new DataTable('#example',{
                responsive: true,
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            }
        );

    </script>


@endsection
