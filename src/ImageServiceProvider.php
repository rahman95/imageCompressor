<?php

namespace RYounus\ImageCompression;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\UploadedFile;
use RYounus\ImageCompression\Controllers\ImageController;

class ImageServiceProvider extends ServiceProvider{

    public function boot()
    {
        //
    }

    public function register(){
        UploadedFile::macro('index', function() {
            $image = resolve(ImageController::class);
            return $image->index();
        });
    }
}
