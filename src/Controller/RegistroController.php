<?php

namespace App\Controller;

use App\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistroController extends AbstractController
{
    #[Route('/registro', name: 'app_registro')]
    public function registro(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {

        $registroForm = $this->createFormBuilder()
            ->add('email', TextType::class, ['label' => 'Usuario'])
            ->add('password', RepeatedType::class,[
                'type' => PasswordType::class,
                'required' => true,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Repetir Password']
            ])
            
            ->add('registrarse', SubmitType::class)
            ->getForm()
            ;

            $registroForm->handleRequest($request);
            
            //Cuando el registro se completa, es decir es true, guarda los datos en la base de datos
            if($registroForm->isSubmitted()){
                $datos = $registroForm->getData();
                $usuario = new Usuario();
                $usuario->setEmail($datos['email']);
                $usuario->setRoles(['ROLE_USER']);
                $usuario->setPassword(
                    $passwordHasher->hashPassword($usuario, $datos['password'])
                );

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($usuario);
                $entityManager->flush();

                return $this->redirect($this->generateUrl('home'));
            }

        return $this->render('registro/index.html.twig', [
            'registroForm' => $registroForm->createView()
        ]);
    }
}
