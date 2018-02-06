<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * @ORM\Entity(repositoryClass="App\Repository\AvatarRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Avatar
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $alt;

    private $file;

    private $tempFile;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * @param string $alt
     */
    public function setAlt($alt): void
    {
        $this->alt = $alt;
    }

    /**
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        if (null !== $this->url)
        {
            $this->tempFile = $this->url;
            $this->url = null;
            $this->alt = null;
        }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function upload()
    {
            $fileName = md5(uniqid()) . '.' . $this->file->guessExtension();
            $this->url = $fileName;
            $this->alt = 'avatar d\'un utilisateur'; // à revoir !
            $this->file->move($this->getUploadRootDir(), $fileName);
    }

    /**
     * @ORM\PostUpdate()
     */
    public function postUpload()
    {
        $fileToRemove = $this->tempFile;
        unlink($this->getUploadRootDir() . '/' . $fileToRemove );
    }

    public function getUploadRootDir()
    {
        return __DIR__.'/../../public/'. $this->getUploadDir();
    }

    public function getUploadDir()
    {
        return 'uploads/avatar';
    }
}
