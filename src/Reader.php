<?php

namespace Grayson\TaiwanAddress;

/**
 * Class Reader
 * @package Grayson\TaiwanAddress
 */
class Reader
{
    const CITY_AREA = 'county10603.csv';

    const VILLAGE = 'village10602.csv';

    const ROAD = 'road10603.csv';

    /* @var array */
    protected $cityArea = [];

    /* @var array */
    protected $village = [];

    /* @var array */
    protected $roads = [];

    /**
     * @return array
     */
    public function getCityArea(): array
    {
        if (!empty($this->cityArea)) {
            return $this->cityArea;
        }

        $this->cityArea = $this->openFile(self::CITY_AREA);

        return $this->cityArea;
    }

    /**
     * @param string $cityName
     * @return string
     */
    public function cityToEng(string $cityName): string
    {
        $cities = $this->getCities();

        return $cities[$cityName] ?? '';
    }

    /**
     * @param string $cityName
     * @return string
     */
    public function getPostCode(string $cityName): string
    {
        $counties = $this->getCityArea();

        $newCountry = array_combine(
            array_column($counties, 1),
            array_column($counties, 0)
        );

        return $newCountry[$cityName] ?? '';
    }

    /**
     * @param string $road
     * @return string
     */
    public function roadToEng(string $road): string
    {
        $roads = $this->getRodes();

        return $roads[$road] ?? '';
    }

    /**
     * @param string $cityArea
     * @return string
     */
    public function cityAreaToEng(string $cityArea): string
    {
        $counties = $this->getCityArea();

        $newCountry = array_combine(
            array_column($counties, 1),
            array_column($counties, 2)
        );

        return $newCountry[$cityArea] ?? '';
    }

    /**
     * @return array
     */
    public function getVillages(): array
    {
        if (!empty($this->village)) {
            return $this->village;
        }

        $village = $this->openFile(self::VILLAGE);

        $this->village = array_combine(
            array_column($village, 0),
            array_column($village, 1)
        );

        return $this->village;
    }

    /**
     * @return array
     */
    public function getRoadsInChinese(): array
    {
        return array_keys($this->getRodes());
    }

    /**
     * @return array
     */
    public function getVillagesInChinese(): array
    {
        return array_keys($this->getVillages());
    }

    /**
     * @return array
     */
    public function getCitiesInChinese(): array
    {
        return array_keys($this->getCities());
    }

    /**
     * @return array
     */
    public function getRodes(): array
    {
        if (!empty($this->roads)) {
            return $this->roads;
        }

        $roads = $this->openFile(self::ROAD);

        $this->roads = array_combine(
            array_column($roads, 0),
            array_column($roads, 1)
        );

        return $this->roads;
    }

    /**
     * @return array
     */
    public function getCityAreaInChinese(): array
    {
        return array_column($this->getCityArea(), 1);
    }

    /**
     * @param string $fileName
     * @return array
     */
    public function openFile(string $fileName): array
    {
        $newArray = [];
        $file = fopen(dirname(__DIR__) . '/src/Dataset/' . $fileName, 'r');
        while (!feof($file)) {
            $newArray[] = fgetcsv($file);
        }
        fclose($file);
        return $newArray;
    }

    /**
     * @return array
     */
    public function getCities(): array
    {
        return [
            '臺北市' => 'Taipei City',
            '台北市' => 'Taipei City',
            '基隆市' => 'Keelung City',
            '新北市' => 'New Taipei City',
            '台北縣' => 'New Taipei City',
            '臺北縣' => 'New Taipei City',
            '連江縣' => 'Lienchiang County',
            '宜蘭縣' => 'Yilan County',
            '釣魚台' => 'Diaoyutai',
            '新竹市' => 'Hsinchu City',
            '新竹縣' => 'Hsinchu County',
            '桃園市' => 'Taoyuan City',
            '苗栗縣' => 'Miaoli County',
            '臺中市' => 'Taichung City',
            '台中市' => 'Taichung City',
            '彰化縣' => 'Changhua City',
            '南投縣' => 'Nantou County',
            '嘉義市' => 'Chiayi City',
            '嘉義縣' => 'Chiayi County',
            '雲林縣' => 'Yunlin County',
            '臺南市' => 'Tainan City',
            '台南市' => 'Tainan City',
            '高雄市' => 'Kaohsiung City',
            '澎湖縣' => 'Penghu County',
            '澎湖' => 'Penghu County',
            '金門縣' => 'Kinmen County',
            '屏東縣' => 'Pingtung County',
            '臺東縣' => 'Taitung County',
            '台東縣' => 'Taitung County',
            '花蓮縣' => 'Hualien County'
        ];
    }
}