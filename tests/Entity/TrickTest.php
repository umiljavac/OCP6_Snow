<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 20/02/2018
 * Time: 18:27
 */
namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use App\Entity\Trick;

class TrickTest extends TestCase
{

    public function testGetName()
    {
        $trick = new Trick();
        $trick->setName('jApÄn Air');
        $this->assertEquals('japan-air', $trick->getName());
    }

    public function testGetUptadedDate()
    {
        $trick = new Trick();
        $trick->updated();
        $this->assertNotEquals(new \DateTime('now'), $trick->getUpdateDate());
    }

    public function testDbToName()
    {
        $trick = new Trick();
        $trick->setName('JumPin AiR One');
        $this->assertEquals('Jumpin air one', $trick->dbToName());
    }
}
