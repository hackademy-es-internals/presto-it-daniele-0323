<?php

namespace App\Jobs;

use App\Models\Image;
use Spatie\Image\Image as SpatieImage;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Spatie\Image\Manipulations;

class RemoveFaces implements ShouldQueue
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

        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credentials.json'));

        $imageAnnotator = new ImageAnnotatorClient();
        $response = $imageAnnotator->faceDetection($image);
        $faces = $response->getFaceAnnotations();

        foreach ($faces as $face) {
            $vertices = $face->getBoundingPoly()->getVertices();
            
            $bounds = [];
            foreach ($vertices as $vertex) {
                $bounds[] = [$vertex->getX(), $vertex->getY()];
            }

            $width = $bounds[2][0] - $bounds[0][0];
            $height = $bounds[2][1] - $bounds[0][1];

            $image = SpatieImage::load($srcPath);
            $image->watermark(base_path('resources/img/gigachad.png'))
                    ->watermarkPosition('top-left')
                    ->watermarkPadding($bounds[0][0], $bounds[0][1])
                    ->watermarkWidth($width, Manipulations::UNIT_PIXELS)
                    ->watermarkHeight($height, Manipulations::UNIT_PIXELS)
                    ->watermarkFit(Manipulations::FIT_STRETCH);
            $image->save($srcPath);
        }
        $imageAnnotator->close();
    }
}
