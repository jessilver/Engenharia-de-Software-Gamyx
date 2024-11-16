<?php
namespace core;

use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;


class OutputColors extends ConsoleOutput {

    public static function setColors()
    {
        $output = new ConsoleOutput();
        $output->getFormatter()->setStyle('success', new OutputFormatterStyle('green'));
        $output->getFormatter()->setStyle('error', new OutputFormatterStyle('red'));
        $output->getFormatter()->setStyle('warning', new OutputFormatterStyle('yellow'));
        $output->getFormatter()->setStyle('info', new OutputFormatterStyle('blue'));
        return $output;
    }

}