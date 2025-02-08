<?php

namespace App\Modules\Shared\Services;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorageService
{
    public function store(UploadedFile $file, string $folder = 'uploads'): string
    {
        return $file->store($folder, 'public');
    }

    public function delete(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    public function update(UploadedFile $newFile, ?string $oldPath, string $folder = 'uploads'): string
    {
        $newPath = $this->store($newFile, $folder);
        $this->delete($oldPath);
        return $newPath;
    }
}
