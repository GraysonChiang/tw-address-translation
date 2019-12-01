## 台灣地址英譯 Taiwan Address Convert To English

[![Build Status](https://travis-ci.com/GraysonChiang/tw-address.svg?branch=master)](https://travis-ci.com/GraysonChiang/tw-address)
[![Packagist](https://img.shields.io/packagist/v/graysonchiang/tw-address.svg?style=flat-square)](https://packagist.org/packages/graysonchiang/tw-address)
[![Total Downloads](https://img.shields.io/packagist/dt/GraysonChiang/tw-address.svg?style=flat-square)](https://packagist.org/packages/GraysonChiang/tw-address) 
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)


## Installation

```sh
composer require graysonchiang/tw-address
```

## Usage

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use Grayson\TaiwanAddress\Translator;

$translator = new Translator();

echo $translator->get('台北市信義區忠孝東路一段33號44樓');

```

## Correct example address
```
台北市信義區忠孝東路一段33號44樓
44F,No. 33,Sec. 1, Zhongxiao E. Rd.,Xinyi Dist., Taipei City 110,Taiwan

臺北市信義區忠孝東路五段55號5樓5室
5,5F,No. 55,Sec. 5, Zhongxiao E. Rd.,Xinyi Dist., Taipei City 110,Taiwan

台北市北投區翠嶺路5之88號
No. 5-88,Cuiling Rd.,Beitou Dist., Taipei City 112,Taiwan

台北市北投區翠嶺路88-1號
No. 88-1,Cuiling Rd.,Beitou Dist., Taipei City 112,Taiwan

新北市板橋區莊敬路5號34樓
34F,No. 5,Zhuangjing Rd.,Banqiao Dist., New Taipei City 220,Taiwan

台北市萬華區中華路二段000之6號6樓之9
6F-9,No. 000-6,Sec. 2, Zhonghua Rd.,Wanhua Dist., Taipei City 108,Taiwan

台南市南區國民路16巷11弄11號
No. 11,Aly. 11,Ln. 16,Guomin Rd.,South Dist., Tainan City 702,Taiwan

```


## Incorrect example address
```
中華路2段

忠孝東路1段

```


## Data source

#### 郵局官方網站 -> [下載專區]('https://www.post.gov.tw/post/internet/Download/default.jsp?ID=22') -> 搜尋「中英」
   * 縣市鄉鎮中英對照Excel檔(漢語拼音,zip檔)
   * 村里文字巷中英對照Excel檔 106/02(漢語拼音)
   * 路街中英對照Excel檔 106/03(漢語拼音)
 





