<?php



namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ContenuPageService;
use App\Service\ImagesService;
use Psr\Log\LoggerInterface;
use App\Entity\ContenuPages;
use App\Entity\Pages;
use App\Repository\PagesRepository;
use App\Repository\ImagesRepository;

class MetodologiaController extends AbstractController
{
    const
    NOM_PAGE = 'home',
    SECTION_HEADER = 'header';
    
    private $is_debug;
    private $is_online;
    private $logger;
    
    
    public function __construct(/*bool $is_online, bool $is_debug,*/ LoggerInterface $logger){
      //  $this->is_debug = $is_debug;
        //s$this->is_online = $is_online;
        $this->logger = $logger;
    }
    
    /**
     * @Route("/oleosessenciais", name="oleosessenciais")
     */
    public function index(PagesRepository $pagesRepo, ImagesService $imagesService, ContenuPageService $contenuPage): Response
    {
        $pages = $pagesRepo->findAll();
        $images = $imagesService->getContenuHeader("accueil","highlights");
        $pageHeader = $contenuPage->getHeader(122, 3);
        
        
        return $this->render('metodologia/index.html.twig', [
            'pages' => $pages,
            'images' => $images,
            'header' => $pageHeader,
            'controller_name' => 'MetodologiaController',
        ]);
    }
}
