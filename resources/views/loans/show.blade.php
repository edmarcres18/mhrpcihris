<!-- resources/views/loans/show.blade.php -->
@extends('adminlte::page')

@section('title', 'Loans Details')

@section('preloader')
<div id="loader" class="loader">
    <div class="loader-content">
        <div class="mhr-loader">
            <div class="spinner"></div>
            <div class="mhr-text">MHR</div>
        </div>
        <h4 class="mt-4 text-dark">Loading...</h4>
    </div>
</div>
<style>
    /* Loader */
    .loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.9);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: opacity 0.5s ease-out;
    }

    .loader-content {
        text-align: center;
    }

    /* MHR Loader */
    .mhr-loader {
        position: relative;
        width: 100px;
        height: 100px;
    }

    .spinner {
        position: absolute;
        width: 100%;
        height: 100%;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #8e44ad;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    .mhr-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 24px;
        font-weight: bold;
        color: #8e44ad;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Info Box Overlay */
    .info-box {
        position: relative;
        overflow: hidden;
        height: 120px; /* Set a consistent height for info boxes */
    }

    .info-box-overlay {
        position: absolute;
        bottom: 0;
        right: 10px; /* Margin to the right of the box */
        width: 100px; /* Adjust width as needed */
        height: 100px; /* Adjust height as needed */
        z-index: 1;
        opacity: 0.3;
        pointer-events: none;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .info-box-overlay img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain; /* Ensure the image fits within the overlay */
    }
</style>
@stop

@section('content')
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Loan Information</h3>
                    <div class="card-tools">
                        @can('loan-edit')
                            <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-sm btn-info mr-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        @endcan
                        @can('loan-delete')
                            <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this loan?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-box bg-light">
                                <span class="info-box-icon"><i class="far fa-id-card"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Employee</span>
                                    <span class="info-box-number">{{ $loan->employee->company_id }} {{ $loan->employee->last_name }} {{ $loan->employee->first_name }} {{ $loan->employee->middle_name ?? ' '}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box bg-light">
                                <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Date</span>
                                    <span class="info-box-number">{{ $loan->date }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <div class="info-box bg-info">
                                <span class="info-box-icon"><i class="fas fa-money-bill-wave"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">SSS loan</span>
                                    <span class="info-box-number">&#8369; {{ number_format($loan->sss_loan, 2) }}</span>
                                    <div class="info-box-overlay">
                                        <img src="{{ asset('vendor/adminlte/dist/img/sss.png') }}" alt="SSS Logo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="info-box bg-warning">
                                <span class="info-box-icon"><i class="fas fa-home"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Pag-IBIG</span>
                                    <span class="info-box-number">&#8369; {{ number_format($loan->pagibig_loan, 2) }}</span>
                                    <div class="info-box-overlay">
                                        <img src="{{ asset('vendor/adminlte/dist/img/pagibig.png') }}" alt="Pag-IBIG Logo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="info-box bg-danger">
                                <span class="info-box-icon"><i class="fas fa-receipt"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">CASH ADVANCE</span>
                                    <span class="info-box-number">&#8369; {{ number_format($loan->cash_advance, 2) }}</span>
                                    <div class="info-box-overlay">
                                        <img src="{{ asset('vendor/adminlte/dist/img/cashadvance.png') }}" alt="Philippine Paper Bill">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('loans.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .info-box-number {
        font-size: 1.2rem;
    }
    .info-box-text {
        font-size: 0.9rem;
    }
    .card-title {
        font-size: 1.25rem;
    }
</style>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Hide the loader when the page is fully loaded
        $('#loader').fadeOut();
    });
</script>
@stop
