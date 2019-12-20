<?php


namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageService
{
    protected $image;
    protected $width;
    protected $height;

    public function __construct($image, $width, $height)
    {
        $this->image = $image;
        $this->width = $width;
        $this->height = $height;
    }

    public function resizeImage($folder, $thumb = false): string
    {
        $thumb == true ? $pathFolder = "images/{$folder}/thumb/" : $pathFolder = "images/{$folder}/"; // verifica se é uma thumb

        $filenameThumb = Str::random(16) . '.'. $this->image->getClientOriginalExtension();
        Storage::drive('uploads')->makeDirectory($pathFolder);

        $pathThumb = $pathFolder . "{$filenameThumb}";
        Image::make($this->image)->resize($this->width, $this->height)->save(public_path($pathThumb));
        return $pathThumb;
    }
}
