<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AccountabilityController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\OverTimePayController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ItInventoryController;
use App\Http\Controllers\CredentialController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\HiringController;
use App\Http\Controllers\SssController;
use App\Http\Controllers\PagibigController;
use App\Http\Controllers\PhilhealthController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\SubsidiaryController;
use App\Models\Subsidiary;
use App\Http\Controllers\BackupController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
    Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
    Route::get('/home', function () {
        notify()->success('Welcome to MHRPCI - HRIS');
        return view('home');
        });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/employees/birthdays', [EmployeeController::class, 'birthdays'])->name('employees.birthdays');
    // Our resource routes
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('genders', GenderController::class);
    Route::resource('positions', PositionController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('provinces', ProvinceController::class);
    Route::resource('city', CityController::class);
    Route::resource('barangay', BarangayController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('leaves', LeaveController::class);
    Route::resource('contributions', ContributionController::class);
    Route::resource('loans', LoanController::class);
    Route::resource('types', TypeController::class);
    Route::resource('inventory', ItInventoryController::class);
    Route::resource('overtime', OverTimePayController::class);
    Route::resource('posts', PostController::class);
    Route::resource('holidays', HolidayController::class);
    Route::resource('tasks', TaskController::class);
    Route::resource('credentials', CredentialController::class);
    Route::resource('hirings', HiringController::class);
    Route::resource('pagibig', PagibigController::class);
    Route::resource('properties', PropertyController::class);
    Route::resource('accountabilities', AccountabilityController::class);
    Route::resource('policies', PolicyController::class);
    Route::resource('subsidiaries', SubsidiaryController::class);
    Route::get('/subsidiaries/{id}', [SubsidiaryController::class, 'show'])->name('subsidiaries.show');

    Route::put('/leaves/{id}/status', [LeaveController::class, 'updateStatus'])->name('leaves.updateStatus');
    Route::get('/leaves/detail/{id}', [LeaveController::class, 'detail'])->name('leaves.detail');
    Route::get('/leaves/print', [LeaveController::class, 'print'])->name('leaves.print');
    Route::get('/leaves-employees', [LeaveController::class, 'allEmployees'])->name('leaves.all_employees');
    Route::get('/leaves-report', [LeaveController::class, 'report'])->name('leaves.report');
    Route::get('leaves-employees/{employee_id}/leaves', [LeaveController::class, 'employeeLeaves'])->name('leaves.employee_leaves');
    Route::get('attendances/auto-mark-absent', [AttendanceController::class, 'autoMarkAbsent'])->name('attendances.autoMarkAbsent');
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::get('/notifications/all', [NotificationsController::class, 'showAllNotifications'])->name('notifications.all');
    Route::post('/employees/import', [EmployeeController::class, 'import'])->name('employees.import');
    Route::post('/employees/export', [EmployeeController::class, 'export'])->name('employees.export');
    Route::get('/employees/filter', [EmployeeController::class, 'filter'])->name('employees.filter');
    Route::post('employees/{employee}/update-status', [EmployeeController::class, 'updateStatus'])->name('employees.updateStatus');
    Route::patch('employees/{employee}/disable', [EmployeeController::class, 'disable'])->name('employees.disable');
    });
    Route::get(
    'notifications/get',
    [NotificationsController::class, 'getNotificationsData']
    )->name('notifications.get');

    Route::get('/timesheets', [AttendanceController::class, 'generateTimesheets'])->name('attendances.timesheets');
    Route::get('/employee/attendance/{employee_id}', [AttendanceController::class, 'showEmployeeAttendance'])->name('employee.attendance');
    Route::post('/employees/{employee}/create-user', [EmployeeController::class, 'createUser'])->name('employees.createUser');
    Route::get('/my-timesheet', [AttendanceController::class, 'checkUserAndShowTimesheet'])->name('attendances.my-timesheet');
    Route::get('/leave-balance/{employeeId}', [LeaveController::class, 'showLeaveBalance'])->name('leaves.balance');
    Route::get('/check-attendance', [AttendanceController::class, 'checkAttendance']);
    Route::get('/fetch-leaves', [HomeController::class, 'fetchLeavesByAuthUserFirstName']);
    Route::get('/attendances/print', [AttendanceController::class, 'printAttendance'])->name('attendances.print');
    Route::get('attendances/import', [AttendanceController::class, 'showImportForm'])->name('attendances.import.form');
    Route::post('attendances/import', [AttendanceController::class, 'import'])->name('attendances.import');
    Route::get('attendances/export', [AttendanceController::class, 'export'])->name('attendances.export');
    route::get('/payroll/{id}/download-pdf', [PayrollController::class, 'downloadPdf'])->name('payroll.download-pdf');
    Route::delete('/payroll/{id}', [PayrollController::class, 'destroy'])->name('payroll.destroy');
    Route::get('/my-contributions', [ContributionController::class, 'myContributions'])->name('contributions.my');
    // routes/web.php
    Route::get('/overtime-hours/{employeeId}', [OverTimePayController::class, 'getOvertimeHours'])->name('overtime.hours');

    Route::get('/server-time', function() {
        return response()->json(['server_time' => now()->toIso8601String()]);
    });

    Route::get('/employees/{id}/status', [EmployeeController::class, 'getStatus']);
    Route::get('/tasks', [TaskController::class, 'checkUserAndShowTasks'])->name('checkUserAndShowTasks');
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/my-tasks', [TaskController::class, 'myTasks'])->name('tasks.myTasks');
    Route::post('/my-tasks', [TaskController::class, 'myTasks'])->name('myTasks');

    Route::get('/contributions-employee/{employee_id}', [ContributionController::class, 'employeeContributions'])->name('contributions.employee');
    Route::get('/contributions-employees-list', [ContributionController::class, 'allEmployeesContribution'])->name('contributions.employees-list');

    // Payroll routes
    Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
    Route::get('/payroll/create', [PayrollController::class, 'create'])->name('payroll.create');
    Route::post('/payroll', [PayrollController::class, 'store'])->name('payroll.store');
    Route::get('/payroll/{id}', [PayrollController::class, 'show'])->name('payroll.show');
    Route::post('inventory/import', [ItInventoryController::class, 'import'])->name('inventory.import');

    Route::get('/payroll-employees-with-payroll', [PayrollController::class, 'employeesWithPayroll'])->name('payroll.employeesWithPayroll');
    Route::get('/payroll/{payroll}/payslip', [PayrollController::class, 'generatePayslip'])->name('payroll.payslip');
    //slugs
    Route::get('/employees/{slug}', [EmployeeController::class, 'show']);
    Route::get('employees/{slug}/edit', [EmployeeController::class, 'edit']);

    Route::get('/my-payrolls', [PayrollController::class, 'myPayrolls'])->name('payroll.myPayrolls');
    Route::get('payroll/download-pdf/{id}', [PayrollController::class, 'downloadPdf'])->name('payroll.downloadPdf');

    Route::get('/my-leave-sheet', [LeaveController::class, 'myLeaveSheet'])->name('leaves.my_leave_sheet');
    Route::get('/my-leave-detail/{id}', [LeaveController::class, 'myLeaveDetail'])->name('leaves.myLeaveDetail');

    Route::get('/careers', [CareerController::class, 'index'])->name('careers');
    Route::get('/applicants/{id}', [CareerController::class, 'showApplicant'])->name('showApplicant');
    Route::post('/careers/apply', [CareerController::class, 'apply'])->name('careers.apply');
    Route::get('/all-careers', [CareerController::class, 'getAllCareers'])->name('careers.all');
    Route::get('/careers/{id}', [CareerController::class, 'show'])->name('careers.show');
    Route::post('/careers/{id}/schedule-interview', [CareerController::class, 'scheduleInterview'])->name('careers.schedule-interview');
    Route::get('/saved-jobs', [CareerController::class, 'savedJobs'])->name('saved.jobs');
    Route::post('/toggle-save-job', [CareerController::class, 'toggleSaveJob'])->name('toggle.save.job');

    Route::resource('sss', SssController::class)->except(['edit', 'update']);
    Route::resource('pagibig', PagibigController::class)->except(['edit', 'update']);
    Route::resource('philhealth', PhilhealthController::class)->except(['edit', 'update']);
    Route::post('/sss/destroy-multiple', [SssController::class, 'destroyMultiple'])->name('sss.destroy.multiple');
    Route::get('/related-jobs/{hiring}', [HiringController::class, 'relatedJobs'])->name('related.jobs');

    Route::get('auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
    Route::post('auth/google/logout', [GoogleAuthController::class, 'logout'])->name('google.logout');

    Route::get('/properties/{id}/details', [PropertyController::class, 'showDetails'])->name('properties.details');
    Route::get('/posts/show/{id}', [PostController::class, 'showPostById'])->name('posts.showById');
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/holidays', [CalendarController::class, 'getHolidays'])->name('calendar.holidays');
    Route::get('/policies-page', [PolicyController::class, 'showPolicy'])->name('policies.show-page');
    Route::get('/subsidiaries/{subsidiary}/details', [WelcomeController::class, 'showDetails'])->name('subsidiaries_details');

    Auth::routes();
