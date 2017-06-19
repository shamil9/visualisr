<?php

namespace App\Services;

use App\Helpers\Utility;

class Visual
{
    private $imagePath;
    private $name;

    function __construct($imagePath, $name)
    {
        $this->imagePath = $imagePath;
        $this->name = $name;
    }

    public function storeImage()
    {
        $dir = storage_path('app/public/visuals/' . auth()->user()->id);
        Utility::createDirectory($dir);
        $image = \Image::make($this->imagePath);
        $image->backup();

        // full size image
        $image->save($dir . '/' . $this->name);

        // thumbnail
        $image->resize(410, null, function ($constraint) {
            $constraint->aspectRatio();
        })
            ->save($dir . '/' . 'thumb_' . $this->name)
            ->reset();

        // twitter banner
        $image->resize(1500, null, function ($constraint) {
            $constraint->aspectRatio();
        })
            ->save($dir . '/' . 'twitter_' . $this->name)
            ->reset();

        //facebook banner
        $image->resize(828, null, function ($constraint) {
            $constraint->aspectRatio();
        })
            ->save($dir . '/' . 'fb_' . $this->name);
    }
}
