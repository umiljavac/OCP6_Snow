<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 25/01/2018
 * Time: 10:44
 */

namespace App\Service;

use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Trick;

class UploadedImgCleaner
{
    public function getOldImgUrls(Trick $trick)
    {
        $oldImgUrls = new ArrayCollection();

        foreach ($trick->getImages() as $oldImg)
        {
            $oldImgUrls->add($oldImg->getUrl());
        }
        return $oldImgUrls;
    }

    public function cleanImgFile($oldImgUrls, Trick $trick)
    {
        $newImgUrls = new ArrayCollection();
        foreach ($trick->getImages() as $image)
        {
            $newImgUrls->add($image->getUrl());
        }

        foreach ($oldImgUrls as $oldImgUrl)
        {
            if (false === $newImgUrls->contains($oldImgUrl))
            {
                unlink('uploads/img/' . $oldImgUrl);
            }
        }
    }

    public function deleteTrickImg(Trick $trick)
    {
        $imageList = $trick->getImages();
        foreach ($imageList as $image)
        {
            $uploadDir = $image->getUploadRootDir();
            unlink($uploadDir . '/' . $image->getUrl());
        }
    }
}