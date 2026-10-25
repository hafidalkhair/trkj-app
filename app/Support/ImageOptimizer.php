<?php

namespace App\Support;

use GdImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageOptimizer
{
    /**
     * Convert an uploaded image to WebP and store it, so every photo the
     * site serves is already in a lightweight format.
     */
    public static function storeAsWebp(UploadedFile $file, string $directory, string $disk = 'public', int $quality = 82): string
    {
        $filename = Str::uuid() . '.webp';
        $path = trim($directory, '/') . '/' . $filename;

        $image = static::readImage($file->getRealPath(), $file->getClientOriginalExtension());

        if (! $image instanceof GdImage) {
            // GD couldn't decode this file (corrupt or unsupported format) —
            // fall back to storing the original rather than losing the upload.
            return $file->storeAs($directory, Str::uuid() . '.' . $file->getClientOriginalExtension(), $disk);
        }

        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);

        ob_start();
        imagewebp($image, null, $quality);
        $data = ob_get_clean();
        imagedestroy($image);

        Storage::disk($disk)->put($path, $data);

        return $path;
    }

    protected static function readImage(string $path, string $extension): ?GdImage
    {
        $extension = strtolower($extension);

        $image = match (true) {
            in_array($extension, ['jpg', 'jpeg'], true) => @imagecreatefromjpeg($path),
            $extension === 'png' => @imagecreatefrompng($path),
            $extension === 'gif' => @imagecreatefromgif($path),
            $extension === 'webp' => @imagecreatefromwebp($path),
            $extension === 'bmp' => @imagecreatefrombmp($path),
            default => @imagecreatefromstring((string) file_get_contents($path)),
        };

        return $image instanceof GdImage ? $image : null;
    }
}
