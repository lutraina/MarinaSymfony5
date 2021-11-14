<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\CustomCredentials;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Repository\UtilisateurRepository;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Entity\Utilisateur;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
//'Symfony\Component\Security\Http\EventListener\UserProviderListener';
//'Symfony\Component\Security\Http\EventListener\CheckCredentialsListener';

class LoginFormAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;
    
    private  $utilisateurRepository;
    private  $router;
    
    public function __construct(UtilisateurRepository $utilisateurRepository, RouterInterface $router){
        $this->utilisateurRepository = $utilisateurRepository;
        $this->router = $router;
    }
    
    /*public function supports(Request $request): ?bool
    {
        return $request->getPathInfo() === '/login' && $request->isMethod('POST');
    }*/

    public function authenticate(Request $request): PassportInterface
    {
        //dd($request->request->get('_csrf_token'));
        $username = $request->request->get('_username');
        //dd($username);
        $password = $request->request->get('_password');
        //$csrfToken = $request->request->get('csrf_token');
        
        //dd($csrfToken);
        
        //dd($password);
        return new Passport(
            new UserBadge($username/*, function($userIdentifier){
                    $user = $this->utilisateurRepository->findOneBy(['username' => $userIdentifier]);
                    
                    if(!$user){
                        throw new UserNotFoundException();
                    }
                    
                    return $user;
            }*/),
            /*new CustomCredentials(
                function($credentials, Utilisateur $user){
                    return $credentials === 'tada';
            },*/
            new PasswordCredentials($password),
            
            [new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
            (new RememberMeBadge())->enable(),
            ]
            
        )/*)*/;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        //dd('entrou onAuthenticationSuccess');
        
        //dd($firewallName);
        //dd($this->getTargetPath($request->getSession(), $firewallName));
        
        if($target = $this->getTargetPath($request->getSession(), $firewallName)){
            //dd('entrou');
            return new RedirectResponse($target);
        }
        
        return new RedirectResponse(
            $this->router->generate('home')
        );
    }

    /*public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $request->getSession()->set(\Symfony\Component\Security\Core\Security::AUTHENTICATION_ERROR, $exception);
        
        //dd($request, $exception);
        return new RedirectResponse(
            $this->router->generate('connexion')
        );
    }*/

    /*public function start(Request $request, AuthenticationException $authException = null): Response
    {
        
        
        return new RedirectResponse(
            $this->router->generate('connexion')
        );
    }*/
    
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator::getLoginUrl()
     */
    protected function getLoginUrl(\Symfony\Component\HttpFoundation\Request $request): string
    {
        return $this->router->generate('home');
    }
 
}
