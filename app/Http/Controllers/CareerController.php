<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Career;
use App\Models\Hiring;
use Illuminate\Support\Facades\Mail;

class CareerController extends Controller
{
    //             /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // function __construct()
    // {
    //     $this->middleware(['permission:career-list|career-create|career-edit|career-delete'], ['only' => ['index', 'show']]);
    //     $this->middleware(['permission:career-create'], ['only' => ['create', 'store']]);
    //     $this->middleware(['permission:career-edit'], ['only' => ['edit', 'update']]);
    //     $this->middleware(['permission:career-delete'], ['only' => ['destroy']]);
    // }

    public function index()
    {
        $hirings = Hiring::all();
        return view('careers', compact('hirings'));
    }

    public function apply(Request $request)
    {
        $validatedData = $request->validate([
            'hiring_id' => 'required|exists:hirings,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'linkedin' => 'nullable|url|max:255',
            'experience' => 'required|string|in:0-1,1-3,3-5,5+',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'nullable|string|max:5000',
            'agree_terms' => 'required|accepted',
        ]);

        // Check if the email has already applied for this hiring_id
        $existingApplication = Career::where('email', $validatedData['email'])
            ->where('hiring_id', $validatedData['hiring_id'])
            ->first();

        if ($existingApplication) {
            return redirect()->route('careers')->with('error', 'You have already applied for this position.');
        }

        // Store the resume file
        $resumePath = $request->file('resume')->store('resumes', 'public');

        // Create and save the Career model
        $application = new Career();
        $application->hiring_id = $validatedData['hiring_id'];
        $application->first_name = $validatedData['first_name'];
        $application->last_name = $validatedData['last_name'];
        $application->email = $validatedData['email'];
        $application->phone = $validatedData['phone'];
        $application->linkedin = $validatedData['linkedin'];
        $application->experience = $validatedData['experience'];
        $application->resume_path = $resumePath;
        $application->cover_letter = $validatedData['cover_letter'];
        $application->agree_terms = true;
        $application->save();

        // Send detailed email to the applicant
        $this->sendApplicationConfirmationEmail($application);

        // After successful processing
        return redirect()->route('careers')->with('success', 'Your application has been submitted successfully!');
    }

    private function sendApplicationConfirmationEmail(Career $application)
    {
        $hiringDetails = $application->hiring;
        $emailContent = "
            Dear {$application->first_name} {$application->last_name},

            Thank you for submitting your application for the position of {$hiringDetails->position} at our company.

            Application Details:
            - Position: {$hiringDetails->position}
            - Email: {$application->email}
            - Phone: {$application->phone}
            - Experience: {$application->experience} years
            - LinkedIn: {$application->linkedin}

            We have received your resume and cover letter. Our hiring team will review your application and get back to you if your qualifications match our requirements.

            If you have any questions, please don't hesitate to contact us.

            Best regards,
            MHRPCI Hiring Team
        ";

        Mail::to($application->email)->send(new \App\Mail\ApplicationConfirmation($emailContent));
    }

    public function getAllCareers()
    {
        $careers = Career::all();
        return view('all-careers', compact('careers'));
    }

    public function show($id)
    {
        $career = Career::with('hiring')->findOrFail($id);
        $this->markAsRead($career);
        return view('showApplicant', compact('career'));
    }

    private function markAsRead(Career $career)
    {
        if (!$career->is_read) {
            $career->is_read = true;
            $career->read_at = now();
            $career->save();
        }
    }

    public function scheduleInterview(Request $request, $id)
    {
        $validatedData = $request->validate([
            'interview_date' => 'required|date_format:Y-m-d\TH:i',
        ]);

        $career = Career::findOrFail($id);
        $career->interview_date = $validatedData['interview_date'];
        $career->save();

        // Send email notification to the applicant
        $this->sendInterviewScheduleEmail($career);

        return response()->json(['message' => 'Interview scheduled successfully']);
    }

    private function sendInterviewScheduleEmail(Career $career)
    {
        $emailContent = "
            Dear {$career->first_name} {$career->last_name},

            We are pleased to inform you that an interview has been scheduled for your application.

            Interview Details:
            - Position: {$career->hiring->position}
            - Date and Time: " . $career->interview_date->format('F j, Y, g:i A') . "

            Please make sure to be available at the scheduled time. If you need to reschedule or have any questions, please contact us as soon as possible.

            Best regards,
            MHRPCI Hiring Team
        ";

        Mail::to($career->email)->send(new \App\Mail\InterviewScheduled($emailContent));
    }

}