<?php

namespace App\Jobs;

use App\Models\Image;
use Illuminate\Bus\Queueable;
use Spatie\Image\Manipulations;
use Illuminate\Queue\SerializesModels;
use Spatie\Image\Image as SpatieImage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class AddLogoIcon implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    private $image_id;
    /**
     * Create a new job instance.
     */
    public function __construct($image_id)
    {
        $this->image_id = $image_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $imageInstance = Image::find($this->image_id);
        if(!$imageInstance){ return; }

        $srcPath = storage_path('app/public/'. $imageInstance->path);
        $image = file_get_contents($srcPath);

        $image = SpatieImage::load($srcPath);
        $image->watermark(base_path('resources/img/logo.jpg'))
                ->watermarkOpacity(50)
                ->watermarkWidth($image->getWidth()*0.15, Manipulations::UNIT_PIXELS)
                ->watermarkHeight($image->getHeight()*0.10, Manipulations::UNIT_PIXELS)
                ->watermarkFit(Manipulations::FIT_STRETCH)
                ->watermarkPosition(Manipulations::POSITION_CENTER);
        $image->save($srcPath);

    }
}
