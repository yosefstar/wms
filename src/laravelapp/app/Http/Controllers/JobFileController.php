<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobFile;
use App\Models\Job;
use Illuminate\Support\Facades\Storage;

class JobFileController extends Controller
{
    public function showUploadForm()
    {
        $jobs = Job::all(); // Retrieve all jobs
        return view('upload', compact('jobs'));
    }

    public function edit(Job $job)
    {
        // $job = Job::all(); // Retrieve all jobs
        return view('jobs.edit', compact('job'));
    }

    public function uploadFile_1(Request $request)
    {
        // Rest of the code

        // Retrieve selected job ID from the form
        $selectedJobId = $request->job_id;
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('public/files'); // Assuming 'files' is your storage directory


        JobFile::create([
            'job_id' => $selectedJobId,
            'user_id' => auth()->user()->id,
            'file_name' => $fileName,
            'file_path' => $filePath,
            'file_status' => 1,
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function uploadFile_2(Request $request)
    {
        // Rest of the code

        // Retrieve selected job ID from the form
        $selectedJobId = $request->job_id;
        $files = $request->file('file');
        foreach ($files as $file) {
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('public/files'); // Assuming 'files' is your storage directory

            JobFile::create([
                'job_id' => $selectedJobId,
                'user_id' => auth()->user()->id,
                'file_name' => $fileName,
                'file_path' => $filePath,
                'file_status' => 2,
            ]);
        }

        return redirect()->back()->with('success', 'Files uploaded successfully.');
    }

    public function downloadFile($id)
    {
        $file = JobFile::findOrFail($id);

        // Assuming the file path is stored in the 'file_path' column
        $filePath = $file->file_path;

        return Storage::download($filePath, $file->file_name);
    }

    public function deleteFile($id)
    {
        $file = JobFile::findOrFail($id);

        // Delete the file from storage
        Storage::delete($file->file_path);

        // Delete the record from the database
        $file->delete();

        return redirect()->back()->with('success', 'File deleted successfully.');
    }
}
