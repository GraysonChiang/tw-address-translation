<?php

namespace Grayson\TaiwanAddress;

/**
 * Class Cut.
 */
class Cut
{
    const MAX_ROAD_LENGTH = '14';

    const MAX_VILLAGE_LENGTH = '7';

    const MAX_CITY_LENGTH = '7';

    /* @var Reader */
    protected $reader;

    /**
     * @param string $address
     *
     * @return array
     */
    public function cutAll(string $address)
    {
        list($cityArea, $address) = $this->cutCityArea($address);

        $reader = $this->getReader();
        $code = $reader->getPostCode($cityArea);
        $cityArea = $reader->cityAreaToEng($cityArea);

        if (!$cityArea) {
            list($cityArea, $address) = $this->cutCity($address);
            $cityArea = $reader->cityToEng($cityArea);
        }

        list($village, $address) = $this->cutVillage($address);

        $village = $reader->villageToEng($village);

        list($road, $address) = $this->cutRoad($address);

        $road = $reader->roadToEng($road);

        $address = $this->parser($address);

        return [$code, $cityArea, $road, $village, $address];
    }

    /**
     * 最大匹配.
     *
     * @param string $string
     * @param int    $maxlength
     * @param array  $dataset
     *
     * @return array
     */
    public function maximumMatchSegment(string $string, int $maxlength, array $dataset)
    {
        foreach (range($maxlength, 0) as $i) {
            $str = mb_substr($string, 0, $i);

            if (in_array($str, $dataset)) {
                return [$str, mb_substr($string, $i, mb_strlen($string))];
            }
        }

        return ['', $string];
    }

    /**
     * @param string $address
     *
     * @return array
     */
    public function cutVillage(string $address)
    {
        $reader = $this->getReader();

        return $this->maximumMatchSegment(
            $address,
            self::MAX_VILLAGE_LENGTH,
            $reader->getVillagesInChinese()
        );
    }

    /**
     * @param string $address
     *
     * @return array
     */
    public function cutRoad(string $address)
    {
        $reader = $this->getReader();

        return $this->maximumMatchSegment(
            $address,
            self::MAX_ROAD_LENGTH,
            $reader->getRoadsInChinese()
        );
    }

    /**
     * @param string $address
     *
     * @return array
     */
    public function cutCity(string $address)
    {
        $reader = $this->getReader();

        return $this->maximumMatchSegment(
            $address,
            self::MAX_CITY_LENGTH,
            $reader->getCitiesInChinese()
        );
    }

    /**
     * @param string $address
     *
     * @return array
     */
    public function cutCityArea(string $address)
    {
        $reader = $this->getReader();

        return $this->maximumMatchSegment(
            $address,
            self::MAX_CITY_LENGTH,
            $reader->getCityAreaInChinese()
        );
    }

    /**
     * @param string $address
     *
     * @return string
     */
    public function getNumber(string $address): string
    {
        $pattern = '((\d+-\d+號|\d+號)+)';

        preg_match($pattern, $address, $aaa);

        return $aaa[0] ?? '';
    }

    /**
     * @param string $address
     *
     * @return array
     */
    public function parser(string $address): array
    {
        $result = ['巷' => '', '號' => '', '弄' => '', '樓' => '', '室' => ''];

        $pattern = '(\d+[巷弄室]+)';

        $address = $this->normalizeAddress($address);

        preg_match_all($pattern, $address, $matches);

        $matches = $matches[0];

        array_push($matches, $this->getNumber($address));

        if (empty($matches)) {
            return $result;
        }

        foreach ($matches as $match) {
            $len = mb_strlen($match);

            $type = mb_substr($match, $len - 1, $len);

            $number = mb_substr($match, 0, $len - 1);

            $address = str_replace($match, '', $address);

            $result[$type] = $number;
        }

        if ($address) {
            $result['樓'] = $address;
        }

        return $result;
    }

    /**
     * @param string $string
     *
     * @return string|string[]
     */
    public function normalizeAddress(string $string)
    {
        foreach ($this->getMapString() as $keyWord => $target) {
            $string = str_replace($keyWord, $target, $string);
        }

        return $string;
    }

    /**
     * @return Reader
     */
    private function getReader(): Reader
    {
        if ($this->reader) {
            return $this->reader;
        }

        $this->reader = new Reader();

        return $this->reader;
    }

    /**
     * @return array
     */
    public function getMapString(): array
    {
        return [
            '之' => '-',
            '樓' => 'F', '０' => '0',
            '１' => '1', '一' => '1',
            '２' => '2', '二' => '2',
            '３' => '3', '三' => '3',
            '４' => '4', '四' => '4',
            '５' => '5', '五' => '5',
            '６' => '6', '六' => '6',
            '７' => '7', '七' => '7',
            '８' => '8', '八' => '8',
            '９' => '9', '九' => '9',
        ];
    }
}
