<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\User;
    
class AuthController extends Controller
{
    /**
     * @Route("/", name="login")
     */
    public function loginAction(Request $request)
    {
        $user = new User;
        
        $form = $this->createFormBuilder($user)
            ->add('loginName', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('passwd', PasswordType::class, array('attr' => array('class' => 'form-control')))
            ->add('login', SubmitType::class, array('attr' => array('class' => 'btn btn-primary')))
            ->getForm();

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $login = $form['loginName']->getData();
            $passwd = $form['passwd']->getData();
            
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if($login == 'root' && $passwd == 'root') {
                    $_SESSION["authenticated"] = 'true';
                    return $this->redirectToRoute('auth');
                }
                else {
                    echo " YOU SHALL NOT PASS!";
                }
            }
        }
        
        // replace this example code with whatever you need
        return $this->render('auth/index.html.twig', array('form' => $form->createView()));
    }
    
    /**
     * @Route("/auth", name="auth")
     */
    public function authAction(Request $request)
    {   
        if(empty($_SESSION["authenticated"]) ||         $_SESSION["authenticated"] != 'true') {
            session_destroy();
            return $this->redirectToRoute('login');
        }
        // replace this example code with whatever you need
        session_destroy();
        return $this->render('auth/auth.html.twig');
    }
}
