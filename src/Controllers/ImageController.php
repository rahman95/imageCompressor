<?php

namespace RYounus\ImageCompression\Controllers;

use App\Http\Controllers\Controller;
use Tinify\Tinify;
use Illuminate\Http\UploadedFile;
use StdClass;

class ImageController extends Controller{

    private $tinify;
    public function __construct(Tinify $tinify)
    {
        $this->tinify = $tinify;
    }

    public function compress(UploadedFile $file)
	{
		try {
		    $response = new StdClass;
            $response->fileName = $file->getClientOriginalName();
            $response->originalSize = $file->getClientSize();
            $response->newSize = \Tinify\fromFile($file->getRealPath())->toFile($file->getRealPath());
            $response->compession = round(100 - ($response->newSize / $response->originalSize) * 100,2);
            $response->extension = $file->getClientOriginalExtension();
            $response->file = $file;
		} catch (\Exception $e) {
		    throw new $e;
        }

		return $response;
	}
}