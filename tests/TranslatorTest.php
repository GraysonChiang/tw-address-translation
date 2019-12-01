<?php

use Grayson\TaiwanAddress\Translator;
use PHPUnit\Framework\TestCase;

/**
 * Class TranslatorTest.
 */
class TranslatorTest extends TestCase
{
    /**
     * @dataProvider resultArray
     *
     * @param array $result
     */
    public function testToEng(array $result)
    {
        $translator = new Translator();

        $translator->toEnglish($result);

        $this->assertTrue(true);
    }

    public function resultArray()
    {
        return [
            [[
                0 => '110',
                1 => '台北市信義區',
                2 => '忠孝東路五段',
                3 => '',
                4 => [
                    '巷' => '555',
                    '號' => '55',
                    '弄' => '555',
                    '樓' => '555',
                    '室' => '',
                ],
            ],
            ],
        ];
    }

    /**
     * @dataProvider addressCityProvider
     *
     * @param string $address
     */
    public function testGet(string $address)
    {
        $translator = new Translator();

        $translator->get($address);

        $this->assertTrue(true);
    }

    /**
     * @return array
     */
    public function addressCityProvider(): array
    {
        return [
            ['台北市南京東路二段99號'],
            ['新北市板橋區莊敬路59號9樓之44'],
            ['新北市莊敬路59號9樓之44'],
            ['臺北市中華路二段597號6樓之11'],
            ['臺北市萬華區中華路二段597號6樓之11'],
            ['臺北市中山區明水路465巷3弄5號43樓之55'],
            ['臺北市明水路465巷3弄5號43樓之55'],
            ['臺北市萬華區中華路二段597之1號55樓之4'],
            ['新北市永和區中山路一段219號21樓'],
            ['臺北市大安區仁愛路四段425號55樓'],
            ['新北市新店區寶橋路2325巷6弄21號96樓'],
            ['新北市新莊區公園一路237號2樓'],
            ['臺南市南區國民路1645巷241弄16號'],
            ['高雄市左營區光興街62-44號517樓之1'],
            ['新北市蘆洲區光榮路651巷29號'],
            ['新北市中和區大勇街361之35號'],
            ['新北市新店區寶元路二段166巷195號55樓'],
        ];
    }
}
