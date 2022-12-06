<?php

namespace App\Services;

use App\Repositories\FileRepository;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{

    public function __construct(private FileRepository $fileRepository)
    {}

    public function storeFile(UploadedFile $file)
    {
        $name = $file->hashName();
 
        Storage::put("files/{$name}", $file);

        $data['filename'] =  $file->getClientOriginalName();
        $data['mime_type'] = $file->getClientMimeType();
        $data['path'] = "files/{$name}";
        $data['size'] = $file->getSize();
        $data['user_id'] = Auth::user()->id;

        $this->fileRepository->create($data);

        return $name;
    }
}