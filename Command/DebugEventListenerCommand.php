<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pro )
 */
declare(strict_types=1);

namespace DawBed\UserBundle\Command;

use DawBed\UserBundle\Event\Events;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class DebugEventListenerCommand extends Command
{
    private $eventDispatcher;

    public function __construct($name = null, EventDispatcherInterface $eventDispatcher)
    {
        parent::__construct($name);
        $this->eventDispatcher = $eventDispatcher;
    }

    protected function configure()
    {
        $this
            ->setName('dawbed:debug:event_listener')
            ->setDescription('Check if you have all registered listeners');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $outputCount = 0;

        foreach (Events::ALL as $name => $necessaryLevel) {
            if (!$this->eventDispatcher->hasListeners($name)) {
                if($necessaryLevel !== Events::REQUIRED) {
                    $io->caution(sprintf('%s is not registered', $name));
                }
                else {
                    $io->error(sprintf('%s is not registered and is required !', $name));
                }
                $outputCount++;
            }
        }
        if (!$outputCount) {
            $io->success('');
        }
    }
}