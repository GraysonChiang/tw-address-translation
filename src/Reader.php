<?php

namespace App;

/**
 * Class Reader
 * @package App
 */
class Reader
{
    const COUNTY = 'county10603.csv';

    const VILLAGE = 'village10602.csv';

    const ROAD = 'road10603.csv';

    /**
     * @return array
     */
    public function getCounties(): array
    {
        return $this->openFile(self::COUNTY);
    }

    /**
     * @return array
     */
    public function getVillage(): array
    {
        return $this->openFile(self::VILLAGE);
    }

    public function getRodes(): array
    {
        return $this->openFile(self::ROAD);
    }

    /**
     * @param string $fileName
     * @return array
     */
    public function openFile(string $fileName): array
    {
        $newArray = [];
        $file = fopen('../src/Dataset/' . $fileName, 'r');
        while (!feof($file)) {
            $newArray[] = fgetcsv($file);
        }
        fclose($file);
        return $newArray;
    }

    /**
     * @return bool
     */
    public function checkFile()
    {
        if (!file_exists('../src/Dataset/' . self::COUNTY)) {
            return false;
        }
        if (!file_exists('../src/Dataset/' . self::VILLAGE)) {
            return false;
        }
        if (!file_exists('../src/Dataset/' . self::ROAD)) {
            return false;
        }
        return true;
    }

    /**
     * @return array
     */
    public function getCities(): array
    {
        return [
            '臺北市' => 'Taipei City',
            '基隆市' => 'Keelung City',
            '新北市' => 'New Taipei City',
            '連江縣' => 'Lienchiang County',
            '宜蘭縣' => 'Yilan County',
            '釣魚台' => 'Diaoyutai',
            '新竹市' => 'Hsinchu City',
            '新竹縣' => 'Hsinchu County',
            '桃園市' => 'Taoyuan City',
            '苗栗縣' => 'Miaoli County',
            '臺中市' => 'Taichung City',
            '彰化縣' => 'Changhua City',
            '南投縣' => 'Nantou County',
            '嘉義市' => 'Chiayi City',
            '嘉義縣' => 'Chiayi County',
            '雲林縣' => 'Yunlin County',
            '臺南市' => 'Tainan City',
            '高雄市' => 'Kaohsiung City',
            '澎湖縣' => 'Penghu County',
            '金門縣' => 'Kinmen County',
            '屏東縣' => 'Pingtung County',
            '臺東縣' => 'Taitung County',
            '花蓮縣' => 'Hualien County'
        ];
    }
}