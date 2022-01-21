<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace EasyCI20220121\Symfony\Component\Console\Event;

use EasyCI20220121\Symfony\Component\Console\Command\Command;
use EasyCI20220121\Symfony\Component\Console\Input\InputInterface;
use EasyCI20220121\Symfony\Component\Console\Output\OutputInterface;
/**
 * @author marie <marie@users.noreply.github.com>
 */
final class ConsoleSignalEvent extends \EasyCI20220121\Symfony\Component\Console\Event\ConsoleEvent
{
    /**
     * @var int
     */
    private $handlingSignal;
    public function __construct(\EasyCI20220121\Symfony\Component\Console\Command\Command $command, \EasyCI20220121\Symfony\Component\Console\Input\InputInterface $input, \EasyCI20220121\Symfony\Component\Console\Output\OutputInterface $output, int $handlingSignal)
    {
        parent::__construct($command, $input, $output);
        $this->handlingSignal = $handlingSignal;
    }
    public function getHandlingSignal() : int
    {
        return $this->handlingSignal;
    }
}
