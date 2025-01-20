@extends('dashboard')

@section('dashboard-styles')
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('dashboard-panel')
    <h1>
        Hola {{ getEmployeeName() }},
    </h1>
    <h2>
        Estadisticas
    </h2>


    <div class="container px-4 mx-auto">

        <div class="p-6  bg-white rounded shadow">
            {!! $chart->container() !!}
        </div>

        <!-- if chart2 is not null, show it -->
        @if($chart2)
            <div class="p-6  bg-white rounded shadow">
                {!! $chart2->container() !!}
            </div>
        @endif

    </div>


@endsection

@section('dashboard-scripts')
    <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }}
    @if($chart2)
        <script src="{{ $chart2->cdn() }}"></script>

        {{ $chart2->script() }}
    @endif

@endsection
