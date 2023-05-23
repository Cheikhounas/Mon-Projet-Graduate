<?php

namespace App\Gestion;

use App\Gestion\ImageGestionInterface;
use Illuminate\Support\Str;

class ImageGestion implements ImageGestionInterface
{


    /**
     * imagePath
     *
     * @var string 
     */
    public $imagePath;

    /**
     * save saves  uploaded  image
     *
     * @param  mixed $image
     * @return bool
     */
    public function save($image): bool
    {
        if ($image->isValid()) {
            $path = config("images.path");
            $extension = $image->getClientOriginalName();
            do {
                $name = Str::random(10) . "." . $extension;
            } while (file_exists($path . "/" . $name));

            $this->imagePath = $path . "/" . $name;
            $image->move($path, $name);
            return true;
        }
        return false;
    }

    /**
     * update  change the old image to a new one 
     *
     * @param  mixed $image
     * @param  mixed $oldImage
     * @return void
     */
    public function update($image, $oldImage = null): bool
    {
        if ($oldImage !== null) {
            unlink($oldImage);
        }
        if ($this->save($image)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * delete delete contact image when contact is delete
     *
     * @param  mixed $path
     * @return bool
     */
    public function delete($path): bool
    {
        if (unlink($path)) {
            return true;
        } else {
            return false;
        }
    }
}
