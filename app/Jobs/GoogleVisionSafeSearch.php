<?php

namespace App\Jobs;

use App\Models\Image;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class GoogleVisionSafeSearch implements ShouldQueue
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
        $image = Image::find($this->image_id);
        if(!$image){ return; }

        $imageString = file_get_contents(storage_path('app/public/'. $image->path));

        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credentials.json'));

        $imageAnnotator = new ImageAnnotatorClient();
        $response = $imageAnnotator->safeSearchDetection($imageString);
        $imageAnnotator->close();

        $safe = $response->getSafeSearchAnnotation();

        $adult = $safe->getAdult();
        $medical = $safe->getMedical();
        $spoof = $safe->getSpoof();
        $violence = $safe->getViolence();
        $racy = $safe->getRacy();

        $likelihoodName = [ 'text-secondary fas fa-circle', 'text-success fas fa-circle', 
                            'text-success fas fa-circle', 'text-warning fas fa-circle',
                            'text-warning fas fa-circle', 'text-danger fas fa-circle',];

        $image->adult = $likelihoodName[$adult];
        $image->medical = $likelihoodName[$medical];
        $image->spoof = $likelihoodName[$spoof];
        $image->violence = $likelihoodName[$violence];
        $image->racy = $likelihoodName[$racy];
        $image->save();

    }
}
