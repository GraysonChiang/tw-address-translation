## 台灣地址英譯 Taiwan Address Convert To English

[![Build Status](https://travis-ci.com/GraysonChiang/tw-address.svg?branch=master)](https://travis-ci.com/GraysonChiang/tw-address)
[![Packagist](https://img.shields.io/packagist/v/graysonchiang/tw-address.svg?style=flat-square)](https://packagist.org/packages/graysonchiang/tw-address)
[![Total Downloads](https://img.shields.io/packagist/dt/GraysonChiang/tw-address.svg?style=flat-square)](https://packagist.org/packages/GraysonChiang/tw-address) 
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)



### Installation

```sh
composer require graysonchiang/tw-address
```

### Usage

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use Grayson\TaiwanAddress\Translator;

$translator = new Translator();

echo $translator->get('台北市信義區忠孝東路一段33號44樓');

```

### Data source

##### 郵局官方網站 -> [下載專區]('https://www.post.gov.tw/post/internet/Download/default.jsp?ID=22') -> 搜尋「中英」
   * 縣市鄉鎮中英對照Excel檔(漢語拼音,zip檔)
   * 村里文字巷中英對照Excel檔 106/02(漢語拼音)
   * 路街中英對照Excel檔 106/03(漢語拼音)
 





