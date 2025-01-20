@extends('layouts.main')

@push('style')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        body {
            font-size: 13px;
        }

        .chart-container {
            position: relative;
            width: 200px;
            height: 200px;
            margin: 0 auto;
        }

        .chart-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #666;
        }

        .card-gradient {
            background: linear-gradient(45deg, #e9fcff, #ddffe5);
            border: none;

        }

        .card-gradient h5 {
            font-weight: 700;
        }

        .card-gradient .h3 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #36A2EB;

        }

        table .btn {
            font-size: 10px;
            border: none;
            border-radius: 20px 20px 20px 20px;
        }


        .circle-icon {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            color: #000;
            font-size: 1rem;
            border: 1px solid #666;
        }

        .dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 8px;
        }

        .card-header {
            height: 40px;
        }
    </style>
       <script>
        const year = {{ $year }};
        const month = {{ $month }};
        const day = {{ $day }};
    </script>
@endpush

@section('content')
    <div class="container-fluid mt-1">
        <h5>Overview Dashboard</h5>
        <p style="font-size: 11px; margin-top: -5px;">Hi, POSE Intelligence, Look at how your sales are going.</p>

        <div class="row g-1">
            {{-- Row 1 --}}

            @include('overviewDashboard.row1.index')

            {{-- Row 2 --}}
            @include('overviewDashboard.row2.index')


            {{-- Row 3 --}}
            @include('overviewDashboard.row3.index')

            {{-- Row 4 --}}
            @include('overviewDashboard.row4.index')


        </div>
    </div>


    @push('script')
     
    @endpush
@endsection
