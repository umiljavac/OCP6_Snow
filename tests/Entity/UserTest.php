<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 21/02/2018
 * Time: 03:58
 */

namespace App\Tests\Entity;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use App\Entity\Trick;

class UserTest extends TestCase
{
    public function testGetRoles()
    {
        $user = new User();
        $role = $user->getRoles();
        $this->assertEquals(['ROLE_USER'], $role);
    }

    public function testIsEnabled()
    {
        $user = new User();
        $isActive = $user->isEnabled();
        $this->assertEquals(false, $isActive);
    }
}