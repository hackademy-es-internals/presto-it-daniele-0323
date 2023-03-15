<?php

namespace App\Jobs;

use Spatie\Image\Image;
use Spatie\Image\Manipulations;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ResizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $filename, $path, $width, $height;
    /**
     * Create a new job instance.
     */
    public function __construct($filePath, $width, $height)
    {
        $this->filename = basename($filePath);
        $this->path = dirname($filePath);
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $w = $this->width;
        $h = $this->height;
        $srcPath = storage_path().'/app/public/'.$this->path.'/'.$this->filename;
        $destPath = storage_path().'/app/public/'.$this->path."/crop_{$w}x{$h}_".$this->filename;
        $croppedImage = Image::load($srcPath)
                        ->crop(Manipulations::CROP_CENTER, $w, $h)
                        ->save($destPath);
    }
}
