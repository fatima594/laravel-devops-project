<?php

namespace App\Http\Services\Image;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageService extends ImageToolsService
{
    /**
     * Resolve full filesystem path inside storage/app/public
     */
    protected function storagePublicPath(string $relativePath): string
    {
        // example: $relativePath = 'posts/abc.webp'
        return storage_path('app/public/' . ltrim($relativePath, '/'));
    }

    /**
     * Make sure a directory exists on the "public" disk
     */
    protected function ensurePublicDirectory(string $dir): void
    {
        $dir = trim($dir, '/');
        if ($dir !== '') {
            Storage::disk('public')->makeDirectory($dir);
        }
    }

    /**
     * Save image as webp (default) into storage/app/public/posts
     * Returns relative path like: posts/filename.webp
    public function save($image)
{
    // set image
    $this->setImage($image);

    // execute provider
    $this->provider();

    // relative path stored in DB
    $relativePath = 'posts/' . $this->finalImageName;

    // full path inside public_html/growthawakening/storage/posts
    $postsDirectory = base_path('../public_html/growthawakening/storage/posts');

    // create directory if not exists
    if (!file_exists($postsDirectory)) {
        mkdir($postsDirectory, 0777, true);
    }

    // full image path
    $path = $postsDirectory . '/' . $this->finalImageName;

    // save image
    $result = Image::make($image->getRealPath())
        ->encode('webp', 80)
        ->save($path);

    // return relative path to store in DB
    return $result ? $relativePath : false;
}



/**
 * Fit + Save into public_html/growthawakening/storage/posts
 * Returns relative path like: posts/filename.webp
 */
/**
 * Fit + Save into public_html/growthawakening/storage/posts
 * Returns relative path like: posts/filename.webp
 */
public function fitAndSave($image, $width = 600, $height = 400, $quality = 70)
{
    // set image
    $this->setImage($image);

    // execute provider
    $this->provider();

    // relative path stored in DB
    $relativePath = 'posts/' . $this->finalImageName;

    // full path inside public_html/growthawakening/storage/posts
    $postsDirectory = base_path('../public_html/growthawakening/storage/posts');

    // create directory if not exists
    if (!file_exists($postsDirectory)) {
        mkdir($postsDirectory, 0777, true);
    }

    // full image path
    $path = $postsDirectory . '/' . $this->finalImageName;

    // save resized image with optimized quality (70)
    $result = Image::make($image->getRealPath())
        ->fit($width, $height)
        ->encode('webp', $quality) // ✅ تقليل الجودة لـ 70 يوفر مساحة ضخمة
        ->save($path);

    // return relative path to store in DB
    return $result ? $relativePath : false;
}

    /**
     * Create index images (multiple sizes) and save them into storage/app/public
     * IMPORTANT: This method depends on ImageToolsService::getImageAddress() output.
     * We will save to storage/app/public/{imageAddress}
     */
    public function createIndexAndSave($image)
    {
        // get data from config
        $imageSizes = Config::get('image.index-image-sizes');

        // set image
        $this->setImage($image);

        // set directory (relative)
        $this->getImageDirectory() ?? $this->setImageDirectory(date("Y") . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . date('d'));
        $this->setImageDirectory($this->getImageDirectory() . DIRECTORY_SEPARATOR . time());

        // set name
        $this->getImageName() ?? $this->setImageName(time());
        $imageName = $this->getImageName();

        $indexArray = [];

        foreach ($imageSizes as $sizeAlias => $imageSize) {

            // create and set this size name
            $currentImageName = $imageName . '_' . $sizeAlias;
            $this->setImageName($currentImageName);

            // execute provider (sets format/extension/address)
            $this->provider();

            // get relative address from your ImageToolsService (example: "images/2025/..../name.webp")
            $relativeAddress = ltrim($this->getImageAddress(), '/');

            // ensure directory exists (extract dir from relative address)
            $dir = trim(dirname($relativeAddress), '.');
            $this->ensurePublicDirectory($dir);

            // save image into storage/app/public/{relativeAddress}
            $result = Image::make($image->getRealPath())
                ->fit($imageSize['width'], $imageSize['height'])
                ->save($this->storagePublicPath($relativeAddress), null, $this->getImageFormat());

            if ($result) {
                $indexArray[$sizeAlias] = $relativeAddress; // store relative
            } else {
                return false;
            }
        }

        $images['indexArray'] = $indexArray;
        $images['directory'] = ltrim($this->getFinalImageDirectory(), '/'); // relative directory
        $images['currentImage'] = Config::get('image.default-current-index-image');

        return $images;
    }

    /**
     * Delete a single image.
     * Accepts either:
     * - relative path like "posts/abc.webp" or "images/2025/..../x.webp"
     * - full absolute path (we'll try to unlink it)
     */
    public function deleteImage($imagePath)
    {
        if (!$imagePath) {
            return;
        }

        // If it's an absolute path, delete directly
        if (str_starts_with($imagePath, '/')) {
            if (file_exists($imagePath)) {
                @unlink($imagePath);
            }
            return;
        }

        // Otherwise treat as relative to disk "public"
        $relative = ltrim($imagePath, '/');
        if (Storage::disk('public')->exists($relative)) {
            Storage::disk('public')->delete($relative);
        }
    }

    /**
     * Delete index images directory recursively from storage/app/public
     */
    public function deleteIndex($images)
    {
        if (!isset($images['directory'])) {
            return;
        }

        $relativeDir = ltrim($images['directory'], '/');

        if (Storage::disk('public')->exists($relativeDir)) {
            Storage::disk('public')->deleteDirectory($relativeDir);
        }
    }

    /**
     * (Optional) Keep for compatibility, but now deletes from storage disk.
     */
    public function deleteDirectoryAndFiles($directory)
    {
        if (!$directory) {
            return false;
        }

        // If absolute directory, delete manually (dangerous) - keep minimal
        if (str_starts_with($directory, '/')) {
            if (!is_dir($directory)) {
                return false;
            }

            $files = glob($directory . DIRECTORY_SEPARATOR . '*', GLOB_MARK);
            foreach ($files as $file) {
                if (is_dir($file)) {
                    $this->deleteDirectoryAndFiles($file);
                } else {
                    @unlink($file);
                }
            }
            return @rmdir($directory);
        }

        // If relative, delete from disk public
        $relativeDir = ltrim($directory, '/');
        if (Storage::disk('public')->exists($relativeDir)) {
            return Storage::disk('public')->deleteDirectory($relativeDir);
        }

        return false;
    }
}
