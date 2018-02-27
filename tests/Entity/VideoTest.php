<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 21/02/2018
 * Time: 04:07
 */

namespace App\Tests\Entity;

use App\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class VideoTest extends TestCase
{
    public function testYouTubeLink()
    {
        $video = new Video();
        $video->setLink('https://www.youtube.com/watch?v=saN1BwlxJxA');
        $link = $video->getLink();
        $this->assertEquals('https://www.youtube.com/embed/saN1BwlxJxA', $link);
    }

    public function testDailyMotionLink()
    {
        $video = new Video();
        $video->setLink('https://www.dailymotion.com/video/x2pqf70');
        $link = $video->getLink();
        $this->assertEquals('https://www.dailymotion.com/embed/video/x2pqf70', $link);
    }
}
