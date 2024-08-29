@extends('adminlte::page')

@section('preloader')
<div id="loader" class="loader">
    <div class="loader-content">
        <div class="wave-loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
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

/* Wave Loader */
.wave-loader {
    display: flex;
    justify-content: center;
    align-items: flex-end;
    height: 50px;
}

.wave-loader > div {
    width: 10px;
    height: 50px;
    margin: 0 5px;
    background-color: #8e44ad; /* Purple color */
    animation: wave 1s ease-in-out infinite;
}

.wave-loader > div:nth-child(2) {
    animation-delay: -0.9s;
}

.wave-loader > div:nth-child(3) {
    animation-delay: -0.8s;
}

.wave-loader > div:nth-child(4) {
    animation-delay: -0.7s;
}

.wave-loader > div:nth-child(5) {
    animation-delay: -0.6s;
}

@keyframes wave {
    0%, 100% {
        transform: scaleY(0.5);
    }
    50% {
        transform: scaleY(1);
    }
}
.status-active {
    color: rgb(255, 255, 255);
    border: 1px solid green;
    background-color: green;
    padding: 2px 4px;
    border-radius: 5px;
}

.status-inactive {
    color: rgb(255, 255, 255);
    border: 1px solid red;
    background-color: red;
    padding: 2px 4px;
    border-radius: 5px;
}


</style>
@stop
@section('content')
<br>
@if ($message = Session::get('success'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger">{{ $message }}</div>
                        @endif
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="card-title">Employee Details</h2>
                    <a href="{{ route('employees.index') }}" class="btn btn-primary btn-sm ml-auto"><i class="fas fa-list"></i> Back to List</a>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-3 text-center">
                            @if($employee->profile)
                                <img src="{{ asset('storage/' . $employee->profile) }}" alt="Profile Image" class="profile-img img-fluid rounded-circle mb-3" style="height: 150px; width: 150px;">
                            @else
                                <p>No profile image available</p>
                            @endif
                        </div>
                        <div class="col-md-9">
                            <h4 class="text-primary">{{ $employee->last_name }} {{ $employee->first_name }}, {{ $employee->middle_name }} {{ $employee->suffix }}</h4>
                            <p><strong>Email:</strong> {{ $employee->email_address }}</p>
                            <p><strong>Contact No.:</strong> {{ $employee->contact_no }}</p>
                            <p><strong>Gender:</strong> {{ $employee->gender->name }}</p>
                            <p><strong>Position:</strong> {{ $employee->position->name }}</p>
                            <p><strong>Employment Status:</strong> {{ $employee->employment_status }}</p>
                            <p>
                                <strong>Employee Status:</strong>
                                <span class="{{ $employee->employee_status === 'Active' ? 'status-active' : 'status-inactive' }}">
                                    {{ $employee->employee_status }}
                                </span>
                            </p>

                            <p>
                                <strong>Place of Birth:</strong>
                                {{ $employee->birth_place_barangay || $employee->birth_place_city || $employee->birth_place_province ?
                                    ($employee->birth_place_barangay ?? 'N/A') . ', ' .
                                    ($employee->birth_place_city ?? 'N/A') . ', ' .
                                    ($employee->birth_place_province ?? 'N/A') :
                                    'N/A' }}
                            </p>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-secondary mb-3">
                                <div class="card-header bg-secondary text-white">
                                    Personal Information
                                </div>
                                <div class="card-body">
                                    <p><strong>Company ID:</strong> {{ $employee->company_id }}</p>
                                    <p><strong>Birth Date:</strong> {{ \Carbon\Carbon::parse($employee->birth_date ?: 'N/A')->format('F j, Y') }}</p>
                                    <p><strong>Emergency Contact Name:</strong> {{ ucfirst($employee->emergency_name) }}</p>
                                    <p><strong>Emergency Contact No:</strong> {{ $employee->emergency_no }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-secondary mb-3">
                                <div class="card-header bg-secondary text-white">
                                    Hired Details
                                </div>
                                <div class="card-body">
                                    <p><strong>Date Hired:</strong> {{ \Carbon\Carbon::parse($employee->date_hired ?: 'N/A')->format('F j, Y') }}</p>
                                    <p><strong>Position:</strong> {{ $employee->position->name }}</p>
                                    <p><strong>Department:</strong> {{ $employee->department->name }} - <strong>Head:</strong> {{ $employee->department->head_name }}</p>
                                    <p><strong>Monthly Salary:</strong> &#8369;{{ number_format($employee->salary, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-secondary mb-3">
                                <div class="card-header bg-secondary text-white">
                                    School Attainment & Home Address
                                </div>
                                <div class="card-body">
                                    <p><strong>Elementary:</strong> {{ $employee->elementary ?: 'N/A'}}</p>
                                    <p><strong>Secondary:</strong> {{ $employee->secondary ?: 'N/A'}}</p>
                                    <p><strong>Tertiary:</strong> {{ $employee->tertiary ?: 'N/A'}}</p>
                                    <p><strong>Home Address:</strong> {{ $employee->barangay->name }}, {{ $employee->city->name }},  {{ $employee->province->name }}, {{ $employee->zip_code }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card border-secondary mb-3">
                                <div class="card-header bg-secondary text-white">
                                    Government ID's
                                </div>
                                <div class="card-body">
                                    <p><strong>TIN:</strong> {{ $employee->tin_no ?: 'N/A' }}</p>
                                    <p><strong>SSS:</strong> {{ $employee->sss_no ?: 'N/A'}}</p>
                                    <p><strong>PAGIBIG:</strong> {{ $employee->pagibig_no ?: 'N/A'}}</p>
                                    <p><strong>PHILHEALTH:</strong> {{ $employee->philhealth_no ?: 'N/A'}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                    <a href="{{ route('employees.index') }}" class="btn btn-primary btn-sm ml-auto"><i class="fas fa-list"></i> Back to List</a>
                    @if($employee->employee_status !== 'Resigned')
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#additionalDetailsModal"><i class="fas fa-balance-scale"></i>
                            Leave Balance
                        </button>
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to create a user for this employee?')"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="additionalDetailsModal" tabindex="-1" role="dialog" aria-labelledby="additionalDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="additionalDetailsModalLabel">Leave Balance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card border-secondary mb-3">
                        <!-- <div class="card-header bg-secondary text-white">
                            Additional Details
                        </div> -->
                        <div class="card-body">
                            <p><strong>Sick Leave:</strong> {{$employee->sick_leave}} Hours - is equivalent - {{($employee->sick_leave) / 24}} Day</p>
                            <p><strong>Vacation Leave:</strong> {{$employee->vacation_leave}} Hours - is equivalent - {{($employee->vacation_leave) / 24}} Day</p>
                            <p><strong>Emergency Leave:</strong> {{$employee->emergency_leave}} Hours - is equivalent - {{($employee->emergency_leave) / 24}} Day</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
