<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use core\OutputColors;

class ExampleTest extends TestCase
{
    public function testAddition(){
        $output = OutputColors::setColors();

        $output->write('<info>'."\n".'Calling ExampleTest: </info>');
        $this->assertEquals(4, 2 + 2);
        $output->writeln('<success>Pass successful</success>');
    }
}