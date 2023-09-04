<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobFile;

class FileController extends Controller
{
    public function showUploadForm()
    {
        return view('upload');
    }

    public function uploadFile(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('files');

            // Retrieve selected job ID from the form
            $selectedJobId = $request->input('job_id');

            JobFile::create([
                'job_id' => $selectedJobId,
                'user_id' => auth()->user()->id,
                'file_name' => $fileName,
                'file_path' => $filePath,
                'file_status' => 1,
            ]);

            return redirect()->back()->with('success', 'File uploaded successfully.');
        }

        return redirect()->back()->with('error', 'No file selected.');
    }
}
