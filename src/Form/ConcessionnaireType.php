<?php

namespace App\Form;

use App\Entity\Concessionnaire;
use App\Entity\Utilisateur;
use App\Entity\Concessionnairemarchand;
use App\Entity\Fabriquant;
use App\Form\UtilisateurType;

use Doctrine\Migrations\Configuration\Connection\ConfigurationFile;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConcessionnaireType extends AbstractType
{
    
   
   

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

       

        $builder

         
         ->add('concessionnairemarchand', ConcessionnairemarchandType::class, ['label' => false ]);
        
         
        
        /* ->add('concessionnairemarchand',ConcessionnairemarchandType::class,[
                'class'=>Concessionnairemarchand ::class,
                'choice_label'=>function(Concessionnairemarchand $fabriquant){
                    return $fabriquant->getFabriquants()->getValues();
                    },
                    'multiple'=>false,
                    'required'=>true

                ])
*/
                 /*  ->add('Utilisateur',EntityType::class,[
                'class'=>Utilisateur ::class,
                'choice_label'=>function(Utilisateur $utilisateur){
                    return $utilisateur->getNom() ;
                    },
                    'multiple'=>false,
                    'required'=>true,
                    'mapped'=>false

                ])*/

               // ->add('utilisateur', UtilisateurType::class, ['mapped' => false, 'label' => false ])
               // ->add('actif', ConcessionnairemarchandType::class, ['mapped' => false,'label' => false ])
              
               
               /*->add('fabriquants', CollectionType::class, [
                    'entry_type' => ConcessionnairemarchandType::class,
                    'entry_options' => ['label' => false],
                ]);
*/
              /*->add('Concessionnairemarchand',EntityType::class,[
                'class'=>Concessionnairemarchand ::class,
                'choice_label'=>function(Concessionnairemarchand $utilisateur){
                    return $utilisateur->getActif() ;
                    },
                    'multiple'=>false,
                    'required'=>true,
                    'mapped'=>false

                ])*/
              //->add('actif', ConcessionnairemarchandType::class, ['mapped' => false])

               

               /* ->add('Utilisateur',EntityType::class,[
                    'class'=>Utilisateur::class,
                    'label'=>false,
                    'choice_label'=>function(Utilisateur $user){
                    return $user->getNom();
                    },
                    'multiple'=>false,
                    'required'=>true,
                    'mapped'=>false
                ])*/
              /*  ->add('courriel', UtilisateurType::class)*/
              
           /* ->add('courriel', UtilisateurType::class, ['mapped' => false])
            ->add('telephone', UtilisateurType::class, ['mapped' => false])
            ->add('nomutilisateur', UtilisateurType::class, ['mapped' => false])
            ->add('motdepasse', UtilisateurType::class, ['mapped' => false])
          
           
            ->add('actif', ConcessionnairemarchandType::class, ['mapped' => false])
            ->add('siteweb', ConcessionnairemarchandType::class, ['mapped' => false])
            ->add('liendealertrack', ConcessionnairemarchandType::class, ['mapped' => false])
            ->add('description', ConcessionnairemarchandType::class, ['mapped' => false])
            
            ->add('media', ConcessionnairemarchandType::class, ['mapped' => false])
            */
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Concessionnaire::class,
          
        ]);
    }

    
}
