<?php

namespace Apitic\AnimalsBundle\Controller;

use Apitic\AnimalsBundle\Entity\Animals;
use Apitic\AnimalsBundle\Form\AnimalsType;
use Apitic\AnimalsBundle\Form\AnimalsEditType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AnimalsController extends Controller
{
  public function indexAction($page)
  {
    $nbPerPage = 5;

    $listAnimals = $this->getDoctrine()
      ->getManager()
      ->getRepository('ApiticAnimalsBundle:Animals')
      ->getAnimals($page, $nbPerPage)
    ;

    foreach ($listAnimals as $animal) {
        switch ($animal->getType()->getId()) {
          case 1: /*Reptile*/
            $animal->description = $this->hiss($animal);
            break;
          case 2: /*Mammifère*/
           $animal->description = $this->growl($animal);
            break;
          case 3: /*Oiseaux*/
            $animal->description = $this->tweet($animal);
            break;
        }
        
    }

    $nbPages = ceil(count($listAnimals)/$nbPerPage);

    return $this->render('ApiticAnimalsBundle:Animals:index.html.twig', array(
      'listAnimals' => $listAnimals,
      'nbPages'     => $nbPages,
      'page'        => $page
    ));
  }

  public function addAction(Request $request)
  {
    $animal = new Animals();
    $form = $this->createForm(new AnimalsType(), $animal);

    if ($form->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($animal);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Informations bien enregistrées.');

      return $this->redirect($this->generateUrl('apitic_animals_home'));
    }

    return $this->render('ApiticAnimalsBundle:Animals:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $animal = $em->getRepository('ApiticAnimalsBundle:Animals')->find($id);

    if ($animal == null) {
      throw $this->createNotFoundException("Les informations d'id ".$id." n'existent pas.");
    }

    $form = $this->createForm(new AnimalsEditType(), $animal);

    if ($form->handleRequest($request)->isValid()) {
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Informations modifiées.');

      return $this->redirect($this->generateUrl('apitic_animals_home'));
    }

    return $this->render('ApiticAnimalsBundle:Animals:edit.html.twig', array(
      'form'   => $form->createView(),
      'animal' => $animal
    ));
  }

  public function deleteAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $animal = $em->getRepository('ApiticAnimalsBundle:Animals')->find($id);

    if ($animal == null) {
      throw $this->createNotFoundException("Les informations d'id ".$id." n'existent pas.");
    }

    $form = $this->createFormBuilder()->getForm();

    if ($form->handleRequest($request)->isValid()) {
      $em->remove($animal);
      $em->flush();
      
      $request->getSession()->getFlashBag()->add('info', 'Informations bien supprimées.');

      return $this->redirect($this->generateUrl('apitic_animals_home'));
    }

    return $this->render('ApiticAnimalsBundle:Animals:delete.html.twig', array(
      'form'   => $form->createView(),
      'animal' => $animal
    ));
  }

  private function hiss($animal)
  {
    return "Le ".$animal->getName()." siffle.";
  }

  private function growl($animal)
  {
    return "Le ".$animal->getName()." grogne.";
  }

  private function tweet($animal)
  {
    return "Le ".$animal->getName()." chante.";
  }
}