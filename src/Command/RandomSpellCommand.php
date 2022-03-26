<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RandomSpellCommand extends Command
{
    
    public function __construct($requireTitle = true){
        
        $this->requireTitle = $requireTitle;
        parent::__construct();
    }
    
    protected static $defaultName = 'app:random-spell';
    protected static $defaultDescription = 'Add a short description for your command';

    protected function configure(): void
    {
        if($this->requireTitle){
            $io = new SymfonyStyle($input, $output);
            $io->success($this->requireTitle . 'Success. Pass --help to see your options.');
        }
        
        $this
            ->setDescription('Cast a ramdom spell')
            //->addArgument('your-name', $this->requireTitle ? InputArgument::OPTIONAL : InputArgument::REQUIRED, 'Your name')
            ->addArgument('your-name', InputArgument::OPTIONAL, 'Your name')
            ->addOption('yell', null, InputOption::VALUE_NONE, 'Scream the spell')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $yourName = $input->getArgument('your-name');
        

        if ($yourName) {
            $io->note(sprintf('Hello %s', $yourName));
        }

        if ($input->getOption('yell')) {
            $io->note(sprintf('Yell! %s', $input));
        }
 
        if($this->requireTitle){
            $io->success($this->requireTitle . 'Success. Pass --help to see your options.');
        }
        
       
        return Command::SUCCESS;
    }
}
