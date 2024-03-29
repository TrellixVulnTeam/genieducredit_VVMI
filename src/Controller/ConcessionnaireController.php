<?php

namespace App\Controller;

use App\Entity\Concessionnaire;
use App\Entity\Concessionnairemarchand;
use App\Entity\Medias;
use App\Form\ConcessionnaireType;
use App\Repository\ConcessionnaireRepository;
use App\Repository\ConcessionnairemarchandRepository;
use App\Repository\FabriquantRepository;
use App\Repository\MediasRepository;
use App\Repository\TypemediaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ConcessionnaireController extends AbstractController
{
    private MediasRepository $MR;
    private FabriquantRepository $fabriquantRepository;
    private EntityManagerInterface $objectManager;
    

    public function __construct(MediasRepository $MR,
     FabriquantRepository $fabriquantRepository,
     ObjectManager $om
     )
    {
        $this->MR = $MR;
        $this->om = $om;
        //ici on instancie le repo
        $this->fabriquantRepository = $fabriquantRepository;
        
    }

    #[Route('/concessionnaire', name: 'concessionnaire')]
    public function index(ConcessionnaireRepository $repository): Response
    {
        $concessionnaires = $repository -> findAll();
       
       
        return $this->render('concessionnaire/index.html.twig', [
            'concessionnaires' => $concessionnaires
        ]);
    }


    #[Route('/concessionnaire/{id}', name: 'suppression_concessionnaire', methods:'delete')]
    public function suppression(Concessionnaire $concessionnaires, Request $request){

      /* $om=$this->getDoctrine()->getManager();
        if($this->isCsrfTokenValid("SUP". $concessionnaires->getId(),$request->get('_token'))){
            $om->remove($concessionnaires);
            $om->flush();
            return $this->redirectToRoute("concessionnaire");
        */
        }
   //Ici tu a 2 routes ^^
    #[Route('/concessionnaire/creation', name: 'creation_concessionnaire')]
    #[Route('/concessionnaire/{id}', name: 'modification_concessionnaire', methods:'GET|POST')]
    public function ajout_modification(Concessionnaire $concessionnaires = null, TypemediaRepository $repository, Request $request)
    {

     
        if(!$concessionnaires){

            $concessionnaires = new Concessionnaire();
            
        }
        $om=$this->om;

       


        $medias = new Medias();

       

        $cr = $this->MR->findAll();
        //$medias->Concessionnairemarchand::class->getfabriquants()->setMedia($cr);

        //Ici on creeer un tableau
        $lienLogo = [];
        //On recupere tous les Fabs depuis le repo instancier dans le __construct()
        $fabs = $this->fabriquantRepository->findAll();

        //On creer une boucle sur tous les fabs
        foreach($fabs as $fab){
            //Pour chaque fab on recupere l'id et le liens du logo
            //Puis on l'enregistre dans le tableau
            //L'id ce met en KEY et le lien en VALUE

            $lienLogo[$fab->getId()] = $fab->getMedia()->getLien();
        }
        
        
       
        $form = $this->createForm(ConcessionnaireType::class, $concessionnaires);
        

        $form -> handleRequest($request);
       // $vendeurs = $form->getData('vendeurs');
        //($vendeurs);

        $vendeurs =$form->get('concessionnairemarchand')->get('vendeurs')->getData();
       // dd($vendeurs);
        if($form->isSubmitted() && $form->isValid()){


            //Ajoute la liste des vendeurs (non mapped)
            
            $concessionnaires->getConcessionnairemarchand()->addAgent($vendeurs);
            
            //$media = $form->getData()->getConcessionnairemarchand()->getAgents();
            
            //Récupère l'image
            $media = $form->getData()->getConcessionnairemarchand()->getMedia();
            if ($media) {
            //Récupère le fichier image
            $mediafile = $form->getData()->getConcessionnairemarchand()->getMedia()->getImageFile();
            //Ajouter le nom
            $name = $mediafile->getClientOriginalName();
            //Déplacer le fichier
            $lien = '/media/logos/'.$name;
            $mediafile->move('../public/media/logos', $name);
            
            //Définit les valeurs
            $media->setNom($name);
            $media->setLien($lien);
            }
            //Ajoute le type du média
           
            /* $type = 'photo';*/
            $type = $repository->gettype('photo');
           
            $media->setType($type);

           // $objectManager->persist($concessionnaires);
           $this->om->persist($concessionnaires);
            $om->flush();
            return $this->redirectToRoute("concessionnaire");
        }
        
        return $this->render('concessionnaire/modificationetajoutConcessionnaire.html.twig', [
            'concessionnaires' => $concessionnaires,
            'medias'=>$medias,
            'form' => $form->createView(),
            'isModification' => $concessionnaires->getId() !== null,
            'listeLogo'=>$lienLogo // On passe le tableau creer plus haut en param
        ]);
    }
}
 
 