<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 19/02/2018
 * Time: 11:43
 */

namespace App\DataFixtures;


use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\TrickGroup;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $trick = new Trick();
        $trick->setName('Indy');
        $trick->setDescription('An Indy grab, also known as an Indy air, is an aerial skateboarding, snowboarding and kitesurfing trick during which the rider grabs his/her back hand on the middle of his board, between his/her feet, on the side of the board where his toes are pointing, while turning backside. The Indy grab is a generic skateboarding trick that has been performed since the late 1970s. This trick is performed mainly while vert skating, e.g. on halfpipes. Although this move can be done on flat land, it is much easier on a ramp. The Indy grab is one of the basic tricks in vert skating and is usually combined with spins, kickflips and heelflips.
        The Indy air was originally called the Gunnair, which was invented by Gunnar Haugo in 1977. By 1980, the trick was renamed the Indy air, which was popularized by Duane Peters. The trick involves doing a backside air while gripping one\'s board on the toe side, between the feet with the trailing hand. If the board is grabbed during a frontside air, the trick is simply called a "frontside air", as opposed to a frontside Ollie, in which there is no grab. Many variations have come into existence as skaters push the limits of creativity and physical exertion. Two of the most popular variations are the kickflip Indy and Indy nosebone.
        The term Indy grab may also be misapplied to any aerial in which the rider grabs the toe side of his board with their trailing hand (as in snowboarding). This confusion is partly due to the name\'s being applied to all such grabs in the Tony Hawk\'s Pro Skater video game.');
        $trickGroup = new TrickGroup();
        $trickGroup->setName('Grabs');
        $trickGroup->addTrick($trick);
        $trick->setTrickGroup($trickGroup);
        $image = new Image();
        $image->setUrl('indy1.jpg');
        $image->setAlt('image d\'un Indy');
        $image->setTrick($trick);
        $image1 = new Image();
        $image1->setUrl('indy2.jpg');
        $image1->setAlt('image d\'un Indy');
        $image1->setTrick($trick);

        $manager->persist($trick);
        $manager->persist($trickGroup);
        $manager->persist($image);
        $manager->persist($image1);

        $trick = new Trick();
        $trick->setName('Mute');
        $trick->setDescription('Take your leading hand and grab hold of your toe edge anywhere between the bindings. Straighten both legs and you’re doing a ‘stiffie’, or straighten your front leg only (like Dom here) and you’re doing a mute nose poke. Two tricks for the price of one, eh?
        Ex turba vero imae sortis et paupertinae in tabernis aliqui pernoctant vinariis, non nulli velariis umbraculorum theatralium latent, quae Campanam imitatus lasciviam Catulus in aedilitate sua suspendit omnium primus; aut pugnaciter aleis certant turpi sono fragosis naribus introrsum reducto spiritu concrepantes; aut quod est studiorum omnium maximum ab ortu lucis ad vesperam sole fatiscunt vel pluviis, per minutias aurigarum equorumque praecipua vel delicta scrutantes.');
        $trickGroup->addTrick($trick);
        $trick->setTrickGroup($trickGroup);
        $image = new Image();
        $image->setUrl('mute2.jpg');
        $image->setAlt('image d\'un Mute');
        $image->setTrick($trick);
        $image1 = new Image();
        $image1->setUrl('mute1.jpg');
        $image1->setAlt('image d\'un Mute');
        $image1->setTrick($trick);

        $manager->persist($trick);
        $manager->persist($image);
        $manager->persist($image1);

        $trick = new Trick();
        $trick->setName('Stalefish');
        $trick->setDescription('Another classic – hold onto your heel edge between your bindings using your trailing hand. Tip: because it’s a stretch to reach behind your rear binding, push your back foot across at the same time. It’s extra stylee that way too.
        Ex turba vero imae sortis et paupertinae in tabernis aliqui pernoctant vinariis, non nulli velariis umbraculorum theatralium latent, quae Campanam imitatus lasciviam Catulus in aedilitate sua suspendit omnium primus; aut pugnaciter aleis certant turpi sono fragosis naribus introrsum reducto spiritu concrepantes; aut quod est studiorum omnium maximum ab ortu lucis ad vesperam sole fatiscunt vel pluviis, per minutias aurigarum equorumque praecipua vel delicta scrutantes.');
        $trickGroup->addTrick($trick);
        $trick->setTrickGroup($trickGroup);
        $image = new Image();
        $image->setUrl('stalefish1.jpg');
        $image->setAlt('image d\'un Stalefish');
        $image->setTrick($trick);
        $image1 = new Image();
        $image1->setUrl('stalefish2.jpg');
        $image1->setAlt('image d\'un Stalefish');
        $image1->setTrick($trick);

        $manager->persist($trick);
        $manager->persist($image);
        $manager->persist($image1);

        $trick = new Trick();
        $trick->setName('Japan');
        $trick->setDescription('To do this properly you’ll need to be very flexible. First, get the board sideways (like a method), and then reach around your tucked front knee with your leading hand, grabbing the toe edge between the bindings. Once you’ve got a good grip on the board, pull everything up and backwards, contorting yourself into an almighty beautiful shape.
        Ex turba vero imae sortis et paupertinae in tabernis aliqui pernoctant vinariis, non nulli velariis umbraculorum theatralium latent, quae Campanam imitatus lasciviam Catulus in aedilitate sua suspendit omnium primus; aut pugnaciter aleis certant turpi sono fragosis naribus introrsum reducto spiritu concrepantes; aut quod est studiorum omnium maximum ab ortu lucis ad vesperam sole fatiscunt vel pluviis, per minutias aurigarum equorumque praecipua vel delicta scrutantes.');
        $trickGroup->addTrick($trick);
        $trick->setTrickGroup($trickGroup);
        $image = new Image();
        $image->setUrl('japan1.jpg');
        $image->setAlt('image d\'un Japan');
        $image->setTrick($trick);
        $image1 = new Image();
        $image1->setUrl('japan2.jpg');
        $image1->setAlt('image d\'un Japan');
        $image1->setTrick($trick);

        $manager->persist($trick);
        $manager->persist($image);
        $manager->persist($image1);

        $trick = new Trick();
        $trick->setName('180');
        $trick->setDescription('A 180 is essentially spinning your snowboard, in the air, 180 degrees. You will start out facing one way down the mountain and end up facing the other way.
        Ex turba vero imae sortis et paupertinae in tabernis aliqui pernoctant vinariis, non nulli velariis umbraculorum theatralium latent, quae Campanam imitatus lasciviam Catulus in aedilitate sua suspendit omnium primus; aut pugnaciter aleis certant turpi sono fragosis naribus introrsum reducto spiritu concrepantes; aut quod est studiorum omnium maximum ab ortu lucis ad vesperam sole fatiscunt vel pluviis, per minutias aurigarum equorumque praecipua vel delicta scrutantes.');
        $trickGroup = new TrickGroup();
        $trickGroup->setName('Rotations');
        $trickGroup->addTrick($trick);
        $trick->setTrickGroup($trickGroup);
        $image = new Image();
        $image->setUrl('180rot1.jpg');
        $image->setAlt('image d\'un 180');
        $image->setTrick($trick);
        $image1 = new Image();
        $image1->setUrl('180rot2.jpg');
        $image1->setAlt('image d\'un 180');
        $image1->setTrick($trick);

        $manager->persist($trick);
        $manager->persist($trickGroup);
        $manager->persist($image);
        $manager->persist($image1);

        $trick = new Trick();
        $trick->setName('360');
        $trick->setDescription('The backside 360 is one of the easiest and safest spins to learn, and once nailed can be taken to just about any size of jump. Unlike 180s (where frontside is generally considered easier), when it comes to 360s you’re better to try the backside version first, because when you come around to the end of the trick you can see the landing clearly. The key is to commit to the manoeuvre 100%, and to initiate all the spin prior to leaving the ground. 
        Ex turba vero imae sortis et paupertinae in tabernis aliqui pernoctant vinariis, non nulli velariis umbraculorum theatralium latent, quae Campanam imitatus lasciviam Catulus in aedilitate sua suspendit omnium primus; aut pugnaciter aleis certant turpi sono fragosis naribus introrsum reducto spiritu concrepantes; aut quod est studiorum omnium maximum ab ortu lucis ad vesperam sole fatiscunt vel pluviis, per minutias aurigarum equorumque praecipua vel delicta scrutantes.');
        $trickGroup->addTrick($trick);
        $trick->setTrickGroup($trickGroup);
        $image = new Image();
        $image->setUrl('360rot2.jpg');
        $image->setAlt('image d\'un 360');
        $image->setTrick($trick);
        $image1 = new Image();
        $image1->setUrl('360rot1.jpg');
        $image1->setAlt('image d\'un 360');
        $image1->setTrick($trick);

        $manager->persist($trick);
        $manager->persist($trickGroup);
        $manager->persist($image);
        $manager->persist($image1);

        $fillDescription = 'Ex turba vero imae sortis et paupertinae in tabernis aliqui pernoctant vinariis, non nulli velariis umbraculorum theatralium latent, quae Campanam imitatus lasciviam Catulus in aedilitate sua suspendit omnium primus; aut pugnaciter aleis certant turpi sono fragosis naribus introrsum reducto spiritu concrepantes; aut quod est studiorum omnium maximum ab ortu lucis ad vesperam sole fatiscunt vel pluviis, per minutias aurigarum equorumque praecipua vel delicta scrutantes.';

        $trick = new Trick();
        $trick->setName('Rodeo');
        $trick->setDescription($fillDescription);
        $trickGroup = new TrickGroup();
        $trickGroup->setName('Rotations désaxées');
        $trickGroup->addTrick($trick);
        $trick->setTrickGroup($trickGroup);
        $image = new Image();
        $image->setUrl('rodeo1.jpg');
        $image->setAlt('image d\'un rodeo');
        $image->setTrick($trick);

        $manager->persist($trick);
        $manager->persist($trickGroup);
        $manager->persist($image);

        $trick = new Trick();
        $trick->setName('Misty');
        $trick->setDescription($fillDescription);
        $trickGroup->addTrick($trick);
        $trick->setTrickGroup($trickGroup);
        $image = new Image();
        $image->setUrl('misty1.jpg');
        $image->setAlt('image d\'un Misty');
        $image->setTrick($trick);

        $manager->persist($trick);
        $manager->persist($image);

        $trick = new Trick();
        $trick->setName('Back side air');
        $trick->setDescription($fillDescription);
        $trickGroup = new TrickGroup();
        $trickGroup->setName('Old school');
        $trickGroup->addTrick($trick);
        $trick->setTrickGroup($trickGroup);
        $image = new Image();
        $image->setUrl('bsa1.jpg');
        $image->setAlt('image d\'un back side air');
        $image->setTrick($trick);

        $manager->persist($trick);
        $manager->persist($trickGroup);
        $manager->persist($image);

        $trick = new Trick();
        $trick->setName('Method air');
        $trick->setDescription($fillDescription);
        $trickGroup->addTrick($trick);
        $trick->setTrickGroup($trickGroup);
        $image = new Image();
        $image->setUrl('method2.jpg');
        $image->setAlt('image d\'un method air');
        $image->setTrick($trick);
        $image1 = new Image();
        $image1->setUrl('method1.jpg');
        $image1->setAlt('image d\'un method air');
        $image1->setTrick($trick);

        $manager->persist($trick);
        $manager->persist($image);
        $manager->persist($image1);

        $manager->flush();
    }
}
