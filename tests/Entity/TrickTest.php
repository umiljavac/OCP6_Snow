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
        $trick->setName('jApAn Air');
        $name = $trick->getName();
        $this->assertEquals('japan-air', $name);
    }

    public function testGetUptadedDate()
    {
        $trick = new Trick();
        $trick->updated();
        $updateDate = $trick->getUpdateDate();
        $this->assertNotEquals(new \DateTime('now'), $updateDate);
    }

    public function testDbToName()
    {
        $trick = new Trick();
        $trick->setName('JumPin AiR One');
        $dbToName = $trick->dbToName();
        $this->assertEquals('Jumpin air one', $dbToName);
    }

}