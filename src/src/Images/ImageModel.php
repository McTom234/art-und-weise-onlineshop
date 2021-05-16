<?php

namespace Images;

class ImageModel
{
    public $base64;

    public function getImage(){
        return base64_encode($this->image_base64);
    }

}
