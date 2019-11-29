<?php

use App\Reader;
use PHPUnit\Framework\TestCase;

/**
 * Class ReaderTest
 */
class ReaderTest extends TestCase
{

    public function test_openFile()
    {
        $reader = new  Reader();

        $openFile = $reader->openFile('road10603.csv');

        $this->assertIsArray($openFile);
    }

    public function test_checkFile()
    {
        $reader = new Reader();

        $this->assertTrue($reader->checkFile());
    }

    public function test_getCounties()
    {
        $reader = new Reader();

        $this->assertIsArray($reader->getCounties());
    }

    public function test_getVillage()
    {
        $reader = new Reader();

        $this->assertIsArray($reader->getVillage());
    }

    public function test_getRodes()
    {
        $reader = new Reader();

        $this->assertIsArray($reader->getRodes());
    }

    public function test_getCity()
    {
        $reader = new Reader();

        $this->assertIsArray($reader->getCities());
    }
}
