<?php

namespace Grayson\TaiwanAddress;

/**
 * Class Translator.
 */
class Translator
{
    /**
     * @param array $result
     *
     * @return string
     */
    public function toEnglish(array $result): string
    {
        list($code, $cityArea, $road, $village, $address) = $result;

        $result = [$road, $village, ($cityArea.' '.$code), 'Taiwan'];

        $others = ['巷' => 'Ln. ', '弄' => 'Aly. ', '號' => 'No. ', '樓' => '', '室' => 'Room. '];

        foreach ($others as $other => $prefix) {
            if (!isset($address[$other]) || empty($address[$other])) {
                continue;
            }
            array_unshift($result, $prefix.$address[$other]);
        }

        return implode(',', array_filter($result, function ($item) {
            return !empty($item);
        }));
    }

    /**
     * @param string $address
     *
     * @return string
     */
    public function get(string $address)
    {
        $result = $this->getCut()->cutAll($address);

        return $this->toEnglish($result);
    }

    /**
     * @return Cut
     */
    private function getCut()
    {
        return new Cut();
    }
}
