<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraint as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrickRepository")
 */
class Trick
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TrickGroup", inversedBy="tricks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trickGroup;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(name="creation_date", type="date")
     */
    private $date;

    /**
     * @ORM\Column(name="update_date", type="date", nullable=true)
     */
    private $updateDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="trick", cascade={"persist"}, orphanRemoval=true)
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Video", mappedBy="trick", cascade={"persist"}, orphanRemoval=true)
     */
    private $videos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="trick", orphanRemoval=true)
     */
    private $comments;

    public function __construct()
    {
        $this->date = new \DateTime();
        $this->images = new ArrayCollection();
        $this->videos = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name): void
    {
        $this->name = $this->nameToDb($name);
    }

    /**
     * @return TrickGroup
     */
    public function getTrickGroup()
    {
        return $this->trickGroup;
    }

    /**
     * @param TrickGroup $trickGroup
     */
    public function setTrickGroup(TrickGroup $trickGroup): void
    {
        $this->trickGroup = $trickGroup;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * @param \DateTime $updateDate
     */
    public function setUpdateDate( \DateTime $updateDate): void
    {
        $this->updateDate = $updateDate;
    }

    /**
     * @return ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param Image $image
     */

    public function addImage(Image $image)
    {
        $this->images[] = $image;
       // $image->setTrick($this);
    }

    public function getVideos()
    {
        return $this->videos;
    }

    public function addVideo(Video $video)
    {
        $this->videos[] = $video;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function addComment($comments): void
    {
        $this->comments[] = $comments;
    }

    public function nameToDb($name)
    {
        return strtolower(str_replace(' ', '-', $name));
    }

    public function dbToName()
    {
        return ucfirst(str_replace('-', ' ', $this->name));
    }
}
