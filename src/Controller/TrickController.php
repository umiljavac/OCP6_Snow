<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 08/01/2018
 * Time: 13:30
 */

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Image;
use App\Entity\Trick;
use App\Entity\Video;
use App\Form\Type\CommentType;
use App\Form\Type\ImageType;
use App\Form\Type\TrickType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends Controller
{
    /**
     * @Route("/home", name="home")
     */
    public function indexAction()
    {
        $trickRepository = $this->getDoctrine()->getRepository(Trick::class);
        $trickList = $trickRepository->findAll();
        return $this->render('views/home.html.twig', array(
            'trickList' => $trickList
        ));
    }

    /**
     * @Route("/trick/{name}", name="trick_show")
     */
    public function showAction(Trick $trick, Request $request) // on utilise les annotations et le SensioFrameworkExtraBundle
    {
        if(!$trick)
        {
            throw $this->createNotFoundException('La figure n\'éxiste pas'); // équivaut à la ligne du dessous
            // throw new NotFoundHttpException('La figure n\'éxiste pas');
        }
        return $this->render('views/show.html.twig', array('trick' => $trick));
    }

    /**
     * @Route("/add", name="trick_add")
     * @Security("has_role('ROLE_USER')")
     */
    public function addTrickAction(Request $request)
    {
        $trick = new Trick();
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $imgList = $trick->getImages();
            foreach ($imgList as $image)
            {
                $image->setTrick($trick);
                $image->upload();
            }

            $videolist = $trick->getVideos();
            foreach ($videolist as $video)
            {
                $video->setTrick($trick);
            }

            $trick = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($trick);
            $em->flush();
            $this->addFlash('notice', 'La figure a bien été ajoutée');
            return $this->redirectToRoute('home');
        }
        return $this->render('views/add.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/trick/{name}/update", name="trick_update")
     */
    public function updateTrickAction()
    {

    }

    /**
     * @Route("/trick/{name}/delete", name="trick_delete")
     */
    public function deleteTrickAction(Trick $trick, Request $request)
    {
        if (null === $trick) {
            throw new NotFoundHttpException("La figure ".$trick->getName()." n'existe pas.");
        }
        $em = $this->getDoctrine()->getManager();
        // on va faire ça ici pr l'instant, il faudra créer un service pour nettoyer les fichiers de photos
        $imageList = $trick->getImages();
        foreach ($imageList as $image)
        {
            $ulpoadDir = $image->getUploadRootDir();
            unlink($ulpoadDir . '/' . $image->getUrl());
        }
        $em->remove($trick);
        $em->flush();

        $this->addFlash('notice', 'La figure a bien été supprimée');

        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/trick/{name}/comment", name="trick_comment")
     * @Security("has_role('ROLE_USER')")
     */
    public function addCommentAction(Trick $trick, Request $request)
    {
        $comment = new Comment();
        $content = htmlspecialchars($request->get('content'));
        if (!empty($content))
        {
            $comment->setContent($content);
            $comment->setTrick($trick);
            $comment->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            $this->addFlash('notice', 'Votre commentaire a bien été ajouté');
        }
       return $this->redirectToRoute('trick_show', array('name' => $trick->getName()));
    }
}
