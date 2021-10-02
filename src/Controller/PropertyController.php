<?php

namespace App\Controller;
use App\Entity\Property;
use Cocur\Slugify\Slugify;
use App\Repository\PropertyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{

    /**
     * @var PropertyRepository
     */

    private $repository;

    /**
     * @var ObjectManager 
     */
    private $manager;

    public function __construct(PropertyRepository $repository, ManagerRegistry $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index(): Response
    {

    //     $property = new Property();
    //     $property->setTitle('Mon premier bien')
    //             ->setPrice(200000)
    //             ->setRooms(4)
    //             ->setBedrooms(3)
    //             ->setDescription('Une petite description')
    //             ->setSurface(65)
    //             ->setFloor(4)
    //             ->setHeat(1)
    //             ->setCity('Saint-Denis')
    //             ->setAddress("12 bis rue mechin")
    //             ->setPostalCode(39450);
    //    $em = $this->getDoctrine()->getManager();   
    //    $em->persist($property);
    //    $em->flush();    
    //   $repository =  $this->getDoctrine()->getRepository(Property::class);
    //   dump($repository);
    //   $repository->persist($repository);
    //   $repository->flush();



        
       
        return $this->render('property/index.html.twig', [
            'current_menu'=>'acheter'
        ]);
    }

    /**
     * 
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug":"[a-z0-9\-]*"})
     * @param Property  $property
     * @return Response
     */

    public function show(Property $property, string $slug): Response
    {
        if($property->getSlug() !== $slug)
        {
         return $this->redirectToRoute('property.show', [
                'id'=> $property->getId(),
                'slug'=> $property->getSlug()
            ], 301);
        }
        
        return $this->render('property/show.html.twig' ,[
            'property'=> $property,
            'current_menu'=>'properties'
        ]);

    }


}
