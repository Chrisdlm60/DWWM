<?php

namespace App\Helpers;
use Michelf\MarkdownExtra;

class MarkdownService {
    public static function parse($file) {
        $file = file_get_contents(public_path('md').'/'.$file);

        if ($file) {
          $parser = new MarkdownExtra();
          $parser->code_class_prefix = "language-";
          $parser->code_attr_on_pre = true;
          $html = $parser->transform($file);
          return $html;
        } else {
          return $file."<br>";
        }
    }
}
