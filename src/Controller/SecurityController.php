<?php

namespace App\Controller;

use DateTime;
use App\Entity\InfoConnexionLog;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\InfoConnexionLogRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/security", name="security")
     */
    public function index(): Response
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

    /**
     * @Route("/security/login",name="user_login")
     * @Route("/",name="home")
     */
    public function login(AuthenticationUtils $authenticationUtils, UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager, UserRepository $userRepository): Response {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();  
        
        /* si tu veux l'utiliser à nouveau, refaire l'infoconnexionlog plus ajout repo dans la fonction
        if (!is_null($error)) {
            $pass = $error->getToken()->getCredentials();
        }

        $userlogs = '';
        $i = 0;
        $sumJour = 0;
        $jour = 33;
        $lock = 0;

        if (!empty($error)) {
            $userlogs = $infoConnexionLogRepository -> findBy(array('user' => $lastUsername), array('id' => 'DESC'),5);
            foreach ($userlogs as $value) {
                $create = $value->getCreatedAt();
                $jour = $create->format('d');
                $sumJour = $sumJour + $jour;
                $i++;
            }
            if ($sumJour / 5 == $jour && $jour != 33) {
                $user = $userRepository -> findOneBy(array('username' => $lastUsername), array('id' => 'DESC'));   
                $hash = rand(1,999);
                $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!-+*&@!-+*&@';
                $string = '';
                $limitChar = rand(8,12);
                for($i=0; $i<$limitChar; $i++){
                    $string .= $chars[rand(0, strlen($chars)-1)];
                }          
                $hash .= $string;
                $hash .= rand(1,999);                
                $string = '';
                $limitChar = rand(8,12);
                for($i=0; $i<$limitChar; $i++){
                    $string .= $chars[rand(0, strlen($chars)-1)];
                }          
                $hash .= $string;
                $hash = $encoder->encodePassword($user ,$user->getPassword());
                $role = array();
                $user -> setPassword($hash);
                $user -> setRoles($role);
                $manager -> persist($user);  
                $manager -> flush();
                $lock = 1;
            }


            $infoConnexion = new InfoConnexionLog();
            $infoConnexion -> setUser($lastUsername);
            $infoConnexion -> setPass($pass);
            $manager -> persist($infoConnexion);  
            $manager -> flush();
        }

        */
        return $this -> render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            //'userlogs' => $userlogs,
            //'lock' => $lock,
        ]);
    }
    
    /**
     * @Route("/security/logout",name="user_logout")
     */
    public function logout()
    {
        
    }
}
