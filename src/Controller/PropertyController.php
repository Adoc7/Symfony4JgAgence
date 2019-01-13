<?php

namespace App\Controller;

// use App\Controller\PropertyController;
use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyController extends AbstractController
{

    /**
     *
     * @var [PropertyRepository]
     */
    private $repository;

    /**
     * @var [ObjectManager]
     */
    private $em;

    

    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index(): Response
    {
        // $property = $this->repository->findAllVisible();


        // $property[0]->setSold(true);
        // dump($property);
        // $this->em->flush();

        // $property = new Property();
        // $property->setTitle('Mon premier bien')
        //          ->setPrice(200000)
        //          ->setRooms(4)
        //          ->setBedrooms(3)
        //          ->setDescription('Une petite description')
        //          ->setSurface(60)
        //          ->setFloor(4)
        //          ->setHeat(1)
        //          ->setCity("Montpellier")
        //          ->setAddress('15 Boulevard Gambetta')
        //          ->setPostalCode('34000')
        //         ;
        // $em = $this->getDoctrine()->getManager();
        // $em->persist($property);
        // $em->flush();

        return $this->render("property/index.html.twig",[
            'current_menu' => 'properties'
        ]);
    }

    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     *
     * @return Response
     */
    public function show(Property $property, string $slug): Response
    {   
        if ($property->getSlug() !== $slug)
        {
            return $this->redirectToRoute('property.show', [
                'id'   => $property->getId(),
                'slug' => $property ->getSlug() 
            ], 301);
        }
        return $this->render("property/show.html.twig", [
            'property' => $property,
            'current_menu' => 'properties'
        ]);

    }

}


