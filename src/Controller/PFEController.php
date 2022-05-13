<?php

namespace App\Controller;

use App\Entity\PFE;
use App\Form\PFEType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/pfe')]
class PFEController extends AbstractController
{
    private $manager;
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->manager = $doctrine->getManager();
    }
    #[Route('/ajout', name: 'add_pfe')]
    public function ajout(Request $request): Response
    {
        $pfe = new PFE();
        $form= $this->createForm (PFEType::class,$pfe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
                $this->manager->persist($pfe);
                $this->manager->flush();
                $this->addFlash("success","The pfe ".$pfe." is successfully added" );
                return $this->redirectToRoute('pfe',["id"=>$pfe->getId()]);}
        return $this->render('pfe/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/list',name: "list_pfes")]
    public function list(): Response
    {
        $this->addFlash("success","Nombre de Pfe par entreprise" );
        $result = $this->manager->getRepository("App\Entity\Entreprise")->findAll();
        return $this->render('pfe/list.html.twig', [
            'entreprises' => $result,
        ]);
    }
    #[Route('/{id}',name: "pfe")]
    public function pfe(PFE $pfe): Response
    {

        return $this->render('pfe/pfe.html.twig', [
            'pfe' => $pfe,
        ]);
    }
}
