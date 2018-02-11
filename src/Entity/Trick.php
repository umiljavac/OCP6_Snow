<?php

namespace App\Entity;

use App\Service\StringConverter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\TrickRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields="name", message="une figure éxiste déjà avec ce nom !")
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
     * @Assert\Length(min="2")
     * @Assert\NotBlank(message="Un p'tit nom pour la figure ?")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TrickGroup", inversedBy="tricks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trickGroup;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Et la description ? bah Alors ?!")
     */
    private $description;

    /**
     * @ORM\Column(name="creation_date", type="date")
     * @Assert\DateTime()
     */
    private $date;

    /**
     * @ORM\Column(name="update_date", type="date", nullable=true)
     * @Assert\DateTime()
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
        $this->name = $this->nameToDb(new StringConverter(), $name);
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
        $image->setTrick($this);
    }

    /**
     * @param Image $image
     */
    public function removeImage(Image $image)
    {
        $this->images->removeElement($image);
    }

    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * @param Video $video
     */
    public function addVideo(Video $video)
    {
        $this->videos[] = $video;
        $video->setTrick($this);
    }

    /**
     * @param Video $video
     */
    public function removeVideo(Video $video)
    {
        $this->videos->removeElement($video);
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

    public function nameToDb(StringConverter $stringConverter, $name)
    {
        $name = $stringConverter->stringToLowerNoAccent($name);
        return str_replace(' ', '-', $name);
    }

    public function dbToName()
    {
        return ucfirst(str_replace('-', ' ', $this->name));
    }

    public function updated()
    {
        $this->setUpdateDate(new \DateTime());
    }
}
