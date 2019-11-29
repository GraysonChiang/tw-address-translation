<?php

namespace App;


class Cut
{

    protected $format = [
        'County' => ['County', ['code', 'cht', 'eng']]
    ];

    /*
     * def mms_cut(s):
        city, s = _maximum_match_segment(s, 7, data.county)
        if not city:
            city, s = _maximum_match_segment(s, 7, data.city)
            code = ''
        if isinstance(city, data.County):
            code = city.code
            city = city.eng
        road, s = _maximum_match_segment(s, 14, data.road)
        village, s = _maximum_match_segment(s, 7, data.village)
        address = parse(s)
        # print(address)

        return code, city, road, village, address
     * */
    public function mmsCut()
    {

    }

    /**
     * 最大匹配
     *
     * @param string $string
     * @param int $maxlength
     * @param array $dataset
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

    /*
     *
     * def parse(s):
    result = {'巷': '', '弄': '', '號': '', '樓': '', '室': ''}

    s = _normalize_address(s)

    # Match 巷號弄室
    pattern = '(\d+[巷號弄室])'
    match = re.findall(pattern, s)
    left = re.sub(pattern, '', s)
    for i in match:
        result[i[-1]] = str(i[:-1]).strip()
    if left:
        result['樓'] = left
    return result

    */
    public function Parser()
    {

    }

    /*
     * def _normalize_address(s):
    for key in REPLACE_MAP:
        s = s.replace(key, REPLACE_MAP[key])
    return s
     * */
    public function normalizeAddress(string $string)
    {
        foreach ($this->getMapString() as $keyWord => $target) {
            $string = str_replace($keyWord, $target, $string);
        }

        return $string;
    }

    /**
     * @return array
     */
    public function getMapString(): array
    {
        return [
            '之' => '-',
            '樓' => 'F',
            '１' => '1',
            '２' => '2',
            '３' => '3',
            '４' => '4',
            '５' => '5',
            '６' => '6',
            '７' => '7',
            '８' => '8',
            '９' => '9',
            '０' => '0',
            '一' => '1',
            '二' => '2',
            '三' => '3',
            '四' => '4',
            '五' => '5',
            '六' => '6',
            '七' => '7',
            '八' => '8',
            '九' => '9'
        ];
    }
}