<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    const RESUME_DISK = 'public';

    public function upload(UploadedFile $file) : string
    {
        return Storage::disk(self::RESUME_DISK)->put('', $file);
    }

    public function download(string $path)
    {
        return Storage::disk(self::RESUME_DISK)->download($path);
    }

    public function delete(string $path)
    {
        if(Storage::disk(self::RESUME_DISK)->exists($path)) {
            Storage::disk(self::RESUME_DISK)->delete($path);
        }
    }
}