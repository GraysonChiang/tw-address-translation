<?php

use Grayson\TaiwanAddress\Cut;
use PHPUnit\Framework\TestCase;

/**
 * Class CutTest.
 */
class CutTest extends TestCase
{
    /**
     * @dataProvider addressCityProvider
     *
     * @param string $fullAddress
     */
    public function testCutAll(string $fullAddress)
    {
        $cut = new Cut();

        $address = $cut->cutAll($fullAddress);

        var_dump($address);

        $this->assertIsArray($address);
    }

    /**
     * @return array
     */
    public function addressCityProvider(): array
    {
        return [
            ['臺北市信義區興雅里忠孝東路五段55號5樓5室', '臺北市'],
            ['台北市北投區興昌村翠嶺路5之88號', '台北市'],
            ['新北市板橋區莊敬路5號34樓', '新北市'],
            ['台北市萬華區中華路二段000之6號6樓之9', '台北市'],
            ['台南市南區國民路16巷11弄11號', '台南市'],
        ];
    }

    /**
     * @dataProvider villageProvider
     *
     * @param string $fullAddress
     * @param string $exceptVillage
     */
    public function testVillage(string $fullAddress, string $exceptVillage)
    {
        $cut = new Cut();

        list($village, $address) = $cut->cutVillage($fullAddress);

        $this->assertEquals(
            mb_strlen($fullAddress),
            mb_strlen($address) + mb_strlen($village)
        );

        $this->assertEquals($exceptVillage, $village);
    }

    /**
     * @return array
     */
    public function villageProvider(): array
    {
        return [
            ['國光里民德路25巷5弄1號3樓', '國光里'],
            ['昇平里1鄰昇平街24號', '昇平里'],
        ];
    }

    /**
     * @dataProvider roadsAddressProvider
     *
     * @param string $fullAddress
     * @param string $exceptRoad
     */
    public function testCutRoad(string $fullAddress, string $exceptRoad)
    {
        $cut = new Cut();

        list($road, $address) = $cut->cutRoad($fullAddress);

        $this->assertEquals(
            mb_strlen($fullAddress),
            mb_strlen($address) + mb_strlen($road)
        );

        $this->assertEquals($exceptRoad, $road);
    }

    /**
     * @return array
     */
    public function roadsAddressProvider()
    {
        return [
            ['忠孝東路五段55號5樓5室', '忠孝東路五段'],
            ['翠嶺路5之88號', '翠嶺路'],
            ['莊敬路5號34樓', '莊敬路'],
            ['大勇街55之5號', '大勇街'],
            ['寶元路二段23巷11號55樓', '寶元路二段'],
        ];
    }

    /**
     * @dataProvider addressCityProvider
     *
     * @param string $fullAddress
     * @param string $expectCity
     */
    public function testCutCity(string $fullAddress, string $expectCity)
    {
        $cut = new Cut();

        list($city, $address) = $cut->cutCity($fullAddress);

        $this->assertEquals(
            mb_strlen($fullAddress),
            mb_strlen($address) + mb_strlen($city)
        );

        $this->assertEquals($expectCity, $city);
    }

    /**
     * @dataProvider addressCountryProvider
     *
     * @param string $fullAddress
     * @param string $expectCity
     */
    public function testCutCountry(string $fullAddress, string $expectCity)
    {
        $cut = new Cut();

        list($country, $address) = $cut->cutCityArea($fullAddress);

        $this->assertTrue($country == $expectCity);

        $this->assertEquals(
            mb_strlen($fullAddress),
            mb_strlen($address) + mb_strlen($country)
        );

        $this->assertEquals($expectCity, $country);
    }

    /**
     * @return array
     */
    public function addressCountryProvider(): array
    {
        return [
            ['臺北市信義區忠孝東路五段55號5樓5室', '臺北市信義區'],
            ['台北市北投區翠嶺路5之88號', '台北市北投區'],
            ['台南市南區國民路16巷11弄11號', '台南市南區'],
            ['高雄市左營區光興街55號55樓之55', '高雄市左營區'],
            ['新北市板橋區莊敬路5號34樓', '新北市板橋區'],
            ['台北市中山區明水路46號14樓', '台北市中山區'],
        ];
    }

    /**
     * @dataProvider parserDataProvider
     *
     * @param string $address
     * @param int    $count
     */
    public function testParser(string $address, int $count)
    {
        $cut = new Cut();

        $parser = $cut->parser($address);

        $parserCount = array_filter($parser, function ($value) {
            return !empty($value);
        });

        $this->assertEquals($count, count($parserCount));
    }

    public function parserDataProvider()
    {
        return [
            ['55巷11號4樓5室', '4'],
            ['55巷11號4樓之155', '3'],
            ['444號31弄1樓之1', '3'],
        ];
    }

    /**
     * @dataProvider getMaximumMatchSegment
     *
     * @param string $addresses
     * @param array  $city
     * @param $len
     */
    public function testMaximumMatchSegment(string $addresses, int $len, array $city)
    {
        $cut = new Cut();

        list($str1, $str2) = $cut->maximumMatchSegment($addresses, $len, $city);

        $this->assertEquals(
            mb_strlen($addresses),
            mb_strlen($str1) + mb_strlen($str2)
        );
    }

    /**
     * @return array
     */
    public function getMaximumMatchSegment(): array
    {
        return [
            ['台北市信義區忠孝東路五段', '7', ['台北市信義區']],
            ['臺北市信義區忠孝東路五段', '7', ['臺北市']],
            ['忠孝東路五段55號333樓', '14', ['忠孝東路五段']],
        ];
    }

    /**
     * @dataProvider getNormalizeAddress
     *
     * @param string $address
     * @param string $target
     */
    public function testNormalizeAddress(string $address, string $target)
    {
        $cut = new Cut();

        $normalizeAddress = $cut->normalizeAddress($address);

        $this->assertEquals($target, $normalizeAddress);
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
            ['臺北信義區忠孝東路一段111號5樓之1', '臺北信義區忠孝東路1段111號5F-1'],
        ];
    }
}
