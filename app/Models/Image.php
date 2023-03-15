<?php

namespace App\Models;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['path'];

    public static function getUrlByFilePath($filePath, $width = null, $height = null){
        if(!$width && !$height){
            return Storage::url($filePath);
        }

        $path = dirname($filePath);
        $filename = basename($filePath);
        $file = "{$path}/crop_{$width}x{$height}_{$filename}";

        return Storage::url($file);
    }

    public function announcement(){
        return $this->belongsTo(Announcement::class);
    }

    public function getUrl($width = null, $height = null){
        return Image::getUrlByFilePath($this->path, $width, $height);
    }

    
}
