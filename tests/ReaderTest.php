<?php

use App\Reader;
use PHPUnit\Framework\TestCase;

/**
 * Class ReaderTest
 */
class ReaderTest extends TestCase
{

    /**
     * @dataProvider getCountries
     * @param string $country
     * @param string $eng
     * @param string $postCode
     */
    public function testConvertPostCode(string $country, string $eng, string $postCode)
    {
        $reader = new Reader();

        $result = $reader->getPostCode($country);

        $this->assertTrue($result == $postCode);
    }

    /**
     * @dataProvider getCountries
     * @param string $country
     * @param string $eng
     */
    public function testConvertCountry(string $country, string $eng)
    {
        $reader = new Reader();

        $result = $reader->cityAreaToEng($country);

        $this->assertTrue($result == $eng);
    }

    public function getCountries()
    {
        return [
            ['臺北市大安區', 'Da’an Dist., Taipei City', '106'],
            ['臺北市萬華區', 'Wanhua Dist., Taipei City', '108'],
            ['臺北市信義區', 'Xinyi Dist., Taipei City', '110'],
            ['臺北市士林區', 'Shilin Dist., Taipei City', '111'],
        ];
    }

    /**
     * @dataProvider getCities
     * @param string $city
     * @param string $eng
     */
    public function testConvertCity(string $city, string $eng)
    {
        $reader = new Reader();

        $result = $reader->cityToEng($city);

        $this->assertTrue($result == $eng);
    }

    /**
     * @return array
     */
    public function getCities(): array
    {
        return [
            ['臺北市', 'Taipei City'],
            ['台北市', 'Taipei City'],
            ['基隆市', 'Keelung City'],
            ['新北市', 'New Taipei City'],
            ['台北縣', 'New Taipei City'],
            ['臺北縣', 'New Taipei City'],
            ['連江縣', 'Lienchiang County'],
            ['宜蘭縣', 'Yilan County'],
            ['釣魚台', 'Diaoyutai'],
            ['新竹市', 'Hsinchu City'],
            ['新竹縣', 'Hsinchu County'],
            ['桃園市', 'Taoyuan City'],
            ['苗栗縣', 'Miaoli County'],
            ['臺中市', 'Taichung City'],
            ['台中市', 'Taichung City'],
            ['彰化縣', 'Changhua City'],
            ['南投縣', 'Nantou County'],
            ['嘉義市', 'Chiayi City'],
            ['嘉義縣', 'Chiayi County'],
            ['雲林縣', 'Yunlin County'],
            ['臺南市', 'Tainan City'],
            ['台南市', 'Tainan City'],
            ['高雄市', 'Kaohsiung City'],
            ['澎湖縣', 'Penghu County'],
            ['澎湖', 'Penghu County'],
            ['金門縣', 'Kinmen County'],
            ['屏東縣', 'Pingtung County'],
            ['臺東縣', 'Taitung County'],
            ['台東縣', 'Taitung County'],
            ['花蓮縣', 'Hualien County']
        ];
    }

    public function testOpenFile()
    {
        $reader = new  Reader();

        $openFile = $reader->openFile('road10603.csv');

        $this->assertIsArray($openFile);
    }

    public function testCheckFile()
    {
        $this->assertFileExists(dirname(__DIR__) . '/src/Dataset/' . Reader::CITY_AREA);

        $this->assertFileExists(dirname(__DIR__) . '/src/Dataset/' . Reader::VILLAGE);

        $this->assertFileExists(dirname(__DIR__) . '/src/Dataset/' . Reader::ROAD);
    }

    public function testGetCounties()
    {
        $reader = new Reader();

        $this->assertIsArray($reader->getCityArea());
    }

    public function testGetVillage()
    {
        $reader = new Reader();

        $this->assertIsArray($reader->getVillages());
    }

    public function testGetRodes()
    {
        $reader = new Reader();

        $this->assertIsArray($reader->getRodes());
    }

    public function testGetCity()
    {
        $reader = new Reader();

        $this->assertIsArray($reader->getCities());
    }
}
