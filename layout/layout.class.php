<?php

namespace hwhome\lib;


/*
- 레이아웃 분리 해야할 것
    ㄴ html,body 태그, 헤더(메타 분리), 푸터
- 레이아웃 클래스 레이아웃 메서드로 구분
  htmlStart($lang = "ko") -> html lang까지 선언
  head($title,$meta...) -> 인클루드 파일 첨부 <head></head>
  body($contentInc) -> <body> @content << 컨텐츠 인클루드 삽입 </body>
  htmlEnd() => </html>
 */

class layout
{
    public static function htmlStart(string $lang = "ko") : void
    {
        echo <<<STR
        <!doctype html>
        <html lang=$lang>
STR;
    }

    public static function head($title = 'Home', $fileArr = null) : void
    {
        echo <<<HTML
        <head>
            <meta charset="UTF-8">
            <meta name="viewport"
                  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>hw. | $title</title>
HTML;

        if (sizeof($fileArr)) {
            foreach($fileArr as $file) :
                echo $file;
            endforeach;
        }

        echo "</head>";
    }

    public static function layoutContent($content = null, $compact = null)
    {
        include_once $_SERVER['DOCUMENT_ROOT'] . 'hwhome/layout/common/header.inc.php';
        $compact = null ? '' : $compact;
        echo '<body>';
        include_once $_SERVER['DOCUMENT_ROOT'] . 'hwhome/' . $content . '.php';
        echo '</body>';
        include_once $_SERVER['DOCUMENT_ROOT'] . 'hwhome/layout/common/footer.inc.php';
    }

    public static function htmlEnd()
    {
        echo "</html>";
    }
}