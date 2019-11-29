<?php

use App\Cut;
use PHPUnit\Framework\TestCase;

class CutTest extends TestCase
{
    /**
     * @dataProvider getMaximumMatchSegment
     * @param string $addresses
     * @param array $city
     * @param $len
     */
    public function testMaximumMatchSegment(string $addresses, int $len, array $city)
    {
        $cut = new Cut();

        list($str1, $str2) = $cut->maximumMatchSegment($addresses, $len, $city);

        $this->assertTrue(mb_strlen($addresses) == mb_strlen($str1) + mb_strlen($str2));
    }

    /**
     * @dataProvider getNormalizeAddress
     * @param string $address
     * @param string $target
     */
    public function testNormalizeAddress(string $address, string $target)
    {
        $cut = new Cut();

        $normalizeAddress = $cut->normalizeAddress($address);

        $this->assertTrue($normalizeAddress == $target);
    }

    /**
     * @return array
     */
    public function getNormalizeAddress(): array
    {
        return [
            ['台北市信義區忠孝東路五段', '台北市信義區忠孝東路5段'],
            ['臺北信義區忠孝東路一段', '臺北信義區忠孝東路1段'],
            ['臺北信義區忠孝東路一段111號5樓', '臺北信義區忠孝東路1段111號5F'],
            ['臺北信義區忠孝東路一段111號5樓之1', '臺北信義區忠孝東路1段111號5F-1']
        ];
    }

    /**
     * @return array
     */
    public function getMaximumMatchSegment(): array
    {
        return [
            ['台北市信義區忠孝東路五段', '7', ['台北市']],
            ['臺北信義區忠孝東路五段', '7', ['台北市']]
        ];
    }

}
