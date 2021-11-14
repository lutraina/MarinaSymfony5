<?php

namespace App\Service;


use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use App\Repository\ContenuPagesRepository;
use App\Repository\ImagesRepository;

class ImagesService
{
    private $repo;
    
    public function __construct(ImagesRepository $imagesRepo){
        $this->repo = $imagesRepo;
    }
    
    public function getContenuHeader(string $page, $section): array{
        return $this->repo->findByPageBlock($page, $section);
    }
    
    
}