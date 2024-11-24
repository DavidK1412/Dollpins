@extends('dashboard')
@section('dashboard-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
    <style>
        .table-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        th {
            background-color: #007bff;
            color: #fff;
            text-align: center;
        }
        td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
@endsection

@section('dashboard-panel')
    <!-- Muestra información del pago -->
    <div class="card text-center">
        <div class="alert alert-danger" role="alert">
            <b>Importante</b>, una vez se añada un adicional, este no se podrá eliminar ya que se contabiliza inmediatamente. Por ende, tener en cuenta que las <b>decisiones finales</b>.
        </div>
        <div class="card-header">
            <h1>
                Pago de nómina - Insertar adicional
            </h1>
        </div>
        <div class="card-body">
            <h5 class="card-title">
                Información pago
            </h5>

            <div class="row">
            <div class="table-container col-6">
                <h2>Pago de Nómina</h2>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Empleado (Fecha)</th>
                        <th>Valor Nómina</th>
                        <th>Adicionales</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $payroll->employee->name }} - {{ $payrollPayment->payment_date }}</td>
                        <td>${{ number_format($payroll->salary, 2) }}</td>
                        <td>${{ number_format($paymentAddons->sum('amount'), 2) }}</td>
                        <td>${{ number_format($payrollPayment->amount, 2) }}</td>
                    </tr>
                    </tbody>
                </table>
                <br>
                <h2>Adicionales</h2>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($paymentAddons as $paymentAddon)
                        <tr>
                            <td>{{ $paymentAddon->description }}</td>
                            <td>${{ number_format($paymentAddon->amount, 2) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
                <div class="addonForm col-6">
                    <h2>Adicionales</h2>
                    <form action="{{Route('payrolls.storePaymentAddon', ['payment_id' => $payrollPayment->id])}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="amount" class="form-label">Valor adicional</label>
                            <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>
                        <button type="submit" class="btn btn-success mt-3">
                            <i class="bi bi-plus
                            "></i>
                            Adicionar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{Route('payrolls.processPayment', [
                'payment_id' => $payrollPayment->id,
])}}" class="btn btn-primary">
                <i class="bi bi-save
                "></i>
                Finalizar
            </a>
        </div>
    </div>
@endsection

@section('dashboard-scripts')
@endsection


