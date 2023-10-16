<?php

namespace App\Controller;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use function PHPUnit\Framework\isNull;

#[Route("/api")]
class LoginController extends AbstractController
{
    #[Route('/login', name: 'login', methods:["POST"])]
    public function index(Request $request, UserRepository $userRepository): Response
    {
        $data = json_decode($request->getContent());
        $user = $userRepository->findOneBy(["email"=>$data->username]);
        
        // TODO : 
        // verifier que le $user existe 
        // s'il existe alors verifier que le password de $user est le même que $data ($user->password)
       
        if (is_null($user)) {
            throw new BadRequestHttpException("User does not exist"); 
        } else { 
                if (password_verify($data->password,$user->getPassword())){
                return true;
            } else {
                return false;
            }
            //return $this->json("OK");
        }
        //if (password_verify($data->password, $user->password)) {
            // Le mot de passe correspond
            //echo "Le mot de passe est correct.";
        //} else {
            // Le mot de passe ne correspond pas
            //echo "Le mot de passe est incorrect.";
       // }
        }
    }
    //#[Route('/logout', name: 'logout')]
    //public function logout(){}
//}
