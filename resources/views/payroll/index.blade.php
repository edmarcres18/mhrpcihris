@extends('layouts.app')

@section('content')
<br>
<div class="container-fluid">
    <!-- Enhanced professional-looking link buttons -->
<div class="mb-4">
    <div class="contribution-nav" role="navigation" aria-label="Contribution Types">
        <a href="{{ route('payroll.index') }}" class="contribution-link {{ request()->routeIs('payroll.index') ? 'active' : '' }}">
            <div class="icon-wrapper">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="text-wrapper">
                <span class="title">Payroll</span>
                <small class="description">Payroll List</small>
            </div>
        </a>
        @can('payroll-create')
        <a href="{{ route('payroll.create') }}" class="contribution-link {{ request()->routeIs('payroll.create') ? 'active' : '' }}">
            <div class="icon-wrapper">
                <i class="fas fa-plus"></i>
            </div>
            <div class="text-wrapper">
                <span class="title">Create Payroll</span>
                <small class="description">Generate Payroll</small>
            </div>
        </a>
        @endcan
        <a href="{{ route('overtime.index') }}" class="contribution-link {{ request()->routeIs('overtime.index') ? 'active' : '' }}">
            <div class="icon-wrapper">
                <i class="fas fa-clock"></i>
            </div>
            <div class="text-wrapper">
                <span class="title">Overtime</span>
                <small class="description">Employee overtime records</small>
            </div>
        </a>
    </div>
</div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Payroll Records</h3>
                    <div class="card-tools">
                        <!-- Download Payrolls Form -->
                        <form action="{{ route('payroll.index') }}" method="GET" class="form-inline">
                            <div class="input-group input-group-sm mr-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Start Date</span>
                                </div>
                                <input type="date" name="start_date" id="start_date" class="form-control" required>
                            </div>
                            <div class="input-group input-group-sm mr-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">End Date</span>
                                </div>
                                <input type="date" name="end_date" id="end_date" class="form-control" required readonly>
                            </div>
                            <input type="hidden" name="download" value="1">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-download"></i> Download Payrolls
                            </button>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">{{ $message }}</div>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger">{{ $message }}</div>
                    @endif
                    <table id="payroll-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Employee Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Gross Salary</th>
                                <th>Net Salary</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payrolls as $payroll)
                            <tr>
                                <td>{{ $payroll->id }}</td>
                                <td>{{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($payroll->start_date)->format('F j, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($payroll->end_date)->format('F j, Y') }}</td>
                                <td>{{ number_format($payroll->gross_salary, 2) }}</td>
                                <td>{{ number_format($payroll->net_salary, 2) }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('payroll.show', ['id' => $payroll->id]) }}">
                                                <i class="fas fa-eye"></i>&nbsp;View
                                            </a>
                                            @can('payroll-delete')
                                            <form action="{{ route('payroll.destroy', $payroll->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this payroll?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
                                            </form>
                                        @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#payroll-table').DataTable();

        // Function to set end date based on start date
        function setEndDate(startDateInput, endDateInput) {
                var startDate = new Date(startDateInput.val());
                var endDate = new Date(startDate);

                if (startDate.getDate() >= 11 && startDate.getDate() <= 25) {
                    endDate.setDate(25);
                } else if (startDate.getDate() >= 26 || startDate.getDate() <= 10) {
                    if (startDate.getDate() >= 26) {
                        endDate.setMonth(startDate.getMonth() + 1);
                    }
                    endDate.setDate(10);
                }

                var formattedEndDate = endDate.toISOString().split('T')[0];
                endDateInput.val(formattedEndDate);
            }

            // Set end date for main form
            $('#start_date').change(function() {
                setEndDate($('#start_date'), $('#end_date'));
            });

            // Set end date for modal form
            $('#modal_start_date').change(function() {
                setEndDate($('#modal_start_date'), $('#modal_end_date'));
            });
    });
</script>
@endsection
