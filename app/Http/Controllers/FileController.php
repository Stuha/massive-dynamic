<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Services\FileUploadService;

class FileController extends Controller
{
    public function __construct(private FileUploadService $service)
    {
        $this->middleware('auth');
    }

    public function upload(FileUploadRequest $request)
    {
        $file = $request->file('file');
        
        $name = $this->service->storeFile($file);

   
        return redirect()->back()
            ->with('success','You have successfully upload file.')
            ->with('file', $name);
    }

}
