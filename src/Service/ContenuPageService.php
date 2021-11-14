<?php

namespace App\Service;


use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use App\Repository\ContenuPagesRepository;
use Psr\Log\LoggerInterface;

class ContenuPageService
{
    private $mardownHelper;
    private $is_debug;
    private $repo;
    private $is_visible;
    private $logger;
    
    public function __construct(ContenuPagesRepository $repo, MarkDownHelper $mardownHelper, LoggerInterface $contenuPageLogger, bool $is_visible){
        $this->mardownHelper = $mardownHelper;
        $this->repo = $repo;
        $this->is_visible = $is_visible;
        $this->logger = $contenuPageLogger;
    }
    
    public function markdown($source){
        return $this->mardownHelper->parse($source);
    }
    
    public function getContenuHeader(string $page, $section): array{
        return $this->repo->findOneByPageAndSection($page, $section);   
    }
    
    public function getHeaderTitre(string $page, $section): string{
        return $this->markdown($this->getContenuHeader($page, $section)[0]->getTitre());
    }
    
    public function getHeaderText(string $page, $section): string{
        return $this->markdown($this->getContenuHeader($page, $section)[0]->getContenuText());
    }
    
    public function getHeader(string $page, $section): array{
        $this->logger->info(__METHOD__ . ' : retourne le contenu du header');
        
        if($this->is_visible){
            $arrayRes = [];
            $contenuPage = $this->getContenuHeader($page, $section);
            
            $arrayRes['titre'] = $this->markdown($contenuPage[0]->getTitre());
            $arrayRes['contenu_text'] = $this->markdown($contenuPage[0]->getContenuText());
            
            return $arrayRes;
        }
        
        $arrayRes['titre'] = 'Conteudo nao visivel';
        $arrayRes['contenu_text'] = 'Conteudo nao visivel';
        
        return $arrayRes;
        
    }
    
}