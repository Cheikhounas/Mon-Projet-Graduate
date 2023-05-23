<?php

namespace App\Gestion;

interface ImageGestionInterface
{

    /**
     * save   saves  uploaded  image
     *
     * @param  mixed $image
     * @return void
     */
    public function save($image): bool;

    /**
     * update change the old image to a new one 
     *
     * @param  mixed $image
     * @param  mixed $oldImage
     * @return bool
     */
    public function update($image, $oldImage = null): bool;

    /**
     * delete  delete contact image when contact is delete
     *
     * @param  mixed $path
     * @return bool
     */
    public function delete($path): bool;
}
