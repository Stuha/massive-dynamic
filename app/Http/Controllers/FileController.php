<?php

namespace App\Http\Controllers;

use App\Enums\PermissionEnum;
use App\Http\Requests\FileUploadRequest;
use App\Repositories\FileRepository;
use App\Services\FileUploadService;
use App\Services\PermissionService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function __construct(
        private FileUploadService $service,
        private FileRepository $fileRepository,
        private PermissionService $permissionService
        
    ){
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

    public function assignFile(Request $request)
    {
        $hasPermissions = $this->permissionService->checkPermissions(PermissionEnum::Edit->value);
       
        if ($hasPermissions) {
            $data['id'] = $request->id;
            $data['assigned'] = $request->assigned;
    
            $this->fileRepository->update($data);
        }

        return redirect()->back();
    }
}
