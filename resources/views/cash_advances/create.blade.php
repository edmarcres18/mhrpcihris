<!-- Modal -->
<div class="modal fade" id="loanModal" tabindex="-1" role="dialog" aria-labelledby="loanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loanModalLabel">Apply for Cash Advance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cash_advances.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="employee_id">Employee</label>
                        <select name="employee_id" id="employee_id" class="form-control" required>
                            <option value="" selected disabled>Select Employee</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->last_name }} {{ $employee->first_name }}, {{ $employee->middle_name ?? ' '}} {{ $employee->suffix ?? ' ' }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cash_advance_amount">Cash Advance Amount (PHP)</label>
                        <input type="number" name="cash_advance_amount" id="cash_advance_amount" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="repayment_term">Repayment Term (Months)</label>
                        <input type="number" name="repayment_term" id="repayment_term" class="form-control" min="1" max="24" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Apply Loan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
