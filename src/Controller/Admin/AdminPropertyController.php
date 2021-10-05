<?php
namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;




class AdminPropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(PropertyRepository $repository, EntityManagerInterface $em )
    {
        $this->repository = $repository;
        $this->em= $em;
    }

    /**
     * @Route("/admin", name="admin.property.index")
     * 
     *
     */
    public function index()
    {
      $properties =  $this->repository->findAll();
      return $this->render('admin/property/index.html.twig', compact('properties'));
    }
    /**
     * @Route("/admin/property/create", name="admin.property.new")
     *
     */
    public function new(Request $request)
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);
          if($form->isSubmitted() && $form->isValid())
          {
            $this->em->persist($property);
            $this->em->flush();
            $this->addFlash('success','Biens créé avec succés');

              return $this->redirectToRoute('admin.property.index');
          }
        return $this->render('admin/property/new.html.twig',[
          'property'=>$property,
          'form'=> $form->createView()
      ]);
    }

    /**
     * @Route("/admin/property/{id}", name="admin.property.edit",methods="GET|POST", requirements={"id":"\d+"})
     
     */
    public function edit(Property $property, Request $request)
    {
      $form = $this->createForm(PropertyType::class, $property);
      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid())
      {
         $this->em->flush();
         $this->addFlash('success','Biens modifier avec succés');
          return $this->redirectToRoute('admin.property.index');
      }
      return $this->render('admin/property/edit.html.twig',[
          'property'=>$property,
          'form'=> $form->createView()
      ]);
    }

    /**
     * @Route("/admin/property/{id}", name="admin.property.delete",methods="DELETE", requirements={"id":"\d+"})
     */
    public function delete(Property $property, Request $request)
    {
      if($this->isCsrfTokenValid('delete'. $property->getId(),$request->get('_token') ))
      {
        $this->em->remove($property);
        $this->em->flush();
        $this->addFlash('success','Biens supprimé avec succés');

      }
      return $this->redirectToRoute('admin.property.index');
    }
}