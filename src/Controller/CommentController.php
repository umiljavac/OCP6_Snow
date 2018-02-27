<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 06/02/2018
 * Time: 21:13
 */

namespace App\Controller;

use App\Form\Type\CommentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Entity\Trick;
use App\Entity\Comment;

class CommentController extends Controller
{
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

            $this->addFlash('notice', 'Et un commentaire, un ! Good job !');
        }
        return $this->redirectToRoute('trick_show', array('name' => $trick->getName()));
    }

    /**
     * @param Comment $comment
     * @Route("/trick/{name}/delete/comment/{id}", name="delete_comment")
     * @Security("has_role('ROLE_USER')")
     */
    public function deleteAction(Trick $trick, $id)
    {
        $comment = $this->getDoctrine()->getRepository(Comment::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();
        $this->addFlash('notice', 'Commentaire supprimé !');

        return $this->redirectToRoute('trick_show', array('name' => $trick->getName()));
    }
}
