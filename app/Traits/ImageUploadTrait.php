<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

trait ImageUploadTrait
{
    
    public function uploadImage(UploadedFile $file, string $path = 'images', int $quality = 90): string
    {
        $name = uniqid() . ".webp";
        
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file)->toWebp($quality);

        Storage::disk('public')->put("{$path}/{$name}", (string) $image);

        return $name;
    }

    
    public function deleteImage(?string $imageName, string $path = 'images'): bool
    {
        if ($imageName === null) {
            return false;
        }

        // Koristi Storage umesto File za storage disk
        $fullPath = "{$path}/{$imageName}";
        
        if (Storage::disk('public')->exists($fullPath)) {
            return Storage::disk('public')->delete($fullPath);
        }

        return false;
    }

 
    public function replaceImage(UploadedFile $file, ?string $oldImage, string $path = 'images', int $quality = 90): string
    {
        $this->deleteImage($oldImage, $path);
        
        return $this->uploadImage($file, $path, $quality);
    }
}