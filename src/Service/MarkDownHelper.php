<?php

namespace App\Service;
 

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Contracts\Cache\CacheInterface;

class MarkDownHelper
{
    private $markDownParser;
    private $cache;
    private $is_debug;
    
    public function __construct(MarkdownParserInterface $markDownParser, CacheInterface $cache, bool $is_debug){
        dump($is_debug);
        $this->cache = $cache;
        $this->is_debug = $is_debug;
        $this->markDownParser = $markDownParser;
    }
    
    public function parse(string $source): string{
        
        if($this->is_debug){
            return $this->markDownParser->transformMarkdown($source);
        }
        return $this->cache->get('markdown_' . md5($source), function() use ($source) {
            return $this->markDownParser->transformMarkdown($source);
        });
        
    }

}