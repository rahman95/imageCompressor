<?php

namespace RYounus\ImageCompression;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\UploadedFile;
use RYounus\ImageCompression\Controllers\ImageController;
use Tinify\Tinify;

class ImageServiceProvider extends ServiceProvider{

    private $tinify;
    public function boot()
    {
        $this->app->singleton(ImageController::class, function() {
            $this->tinify = new Tinify;
            $this->tinify->setKey($this->app->config['services.tinify']);
            return new ImageController($this->tinify);
        });
    }

    public function register(){
        UploadedFile::macro('compress', function() {
            $image = resolve(ImageController::class);
            return $image->compress($this);
        });
    }
}
