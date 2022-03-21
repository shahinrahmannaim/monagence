<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param  PropertyRepository $repository
     * @return Response
     */
    public function index(PropertyRepository $repository): Response
    {
        $property = $repository->findLatest();
        return $this->render('page/home.html.twig', [
            'current_menu' => 'home',
            'properties' => $property,
        ]);
    }
    /**
     * @Route("/about", name="about")
     * @param  PropertyRepository $repository
     * @return Response
     */
    public function about(PropertyRepository $repository): Response
    {
        $property = $repository->findLatest();
        return $this->render('about/about.html.twig', [
            'current_menu' => 'about',
            'properties' => $property,
        ]);
    }
    /**
     * @Route("/blogs", name="blogs")
     * @param  PropertyRepository $repository
     * @return Response
     */
    public function blogs(): Response
    {
        // $property = $repository->findLatest();
        return $this->render('blogs/blogs.html.twig', [
            'current_menu' => 'blog',
            // 'properties' => $property,
        ]);
    }
    /**
     * @Route("/blogdetail", name="blogdetail")
     * @param  PropertyRepository $repository
     * @return Response
     */
    public function blogdetail(): Response
    {
        // $property = $repository->findLatest();
        return $this->render('blogs/showblog.html.twig', [
            'current_menu' => 'blogdetail',
            // 'properties' => $property,
        ]);
    }

    /**
     * @Route("/contact", name="contacts")
     * @param  PropertyRepository $repository
     * @return Response
     */
    public function contact(): Response
    {
        // $property = $repository->findLatest();
        return $this->render('contacts/contact.html.twig', [
            'current_menu' => 'contacts',
            // 'properties' => $property,
        ]);
    }
}
