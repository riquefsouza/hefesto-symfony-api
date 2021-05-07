<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Service\AdmUserService;
use Firebase\JWT\JWT;
use App\Base\Models\TokenDTO;

class LoginController extends AbstractController
{
    /**
     * @var AdmUserService
     */
    private $service;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(
        AdmUserService $service,
        UserPasswordEncoderInterface $encoder
    ) {
        $this->service = $service;
        $this->encoder = $encoder;
    }

    /**
     * @Route("/auth", name="auth")
     */
    public function login(Request $request)
    {
        $dadosEmJson = json_decode($request->getContent());

        if (!is_null($dadosEmJson->login) && !is_null($dadosEmJson->password))
        {
            $user = $this->service->authenticate($dadosEmJson->login, $dadosEmJson->password);

            if (!is_null($user))
            {
                //create claims details based on the user information
                $token = JWT::encode([
                    'username' => $user->getLogin(),
                    'id' => strval($user->getId()),
                    'name' => $user->getName(),
                    'email' => $user->getEmail()
                ], '%env(string:JWT_SECRET)%', 'HS256');

                $tokenDTO = new TokenDTO($token, "Bearer");

                return new JsonResponse($tokenDTO);
            } else {
                return  new JsonResponse(['error' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
            }
        } else {
            return new JsonResponse(['error' => 'Send login and password'], Response::HTTP_BAD_REQUEST);
        }

    }
}
