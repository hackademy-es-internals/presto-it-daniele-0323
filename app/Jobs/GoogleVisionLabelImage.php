<?php

namespace App\Jobs;

use App\Models\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class GoogleVisionLabelImage implements ShouldQueue
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
        $response = $imageAnnotator->labelDetection($imageString);
        $labels = $response->getLabelAnnotations();
        

        if($labels){
            $result = [];
            foreach ($labels as $label) {
                $result[] = $label->getDescription();
            }
            
            $image->labels = $result;
            $image->save();
        }

       

        $imageAnnotator->close();
    }
}
