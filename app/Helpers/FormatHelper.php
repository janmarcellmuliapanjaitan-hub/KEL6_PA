<?php

namespace App\Helpers;

class FormatHelper
{
    public static function parseManualFormat($text)
    {
        if (!$text) return '';
        
        // Konversi **teks** menjadi <strong>teks</strong>
        $text = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text);
        
        // Konversi # Judul menjadi <h1>Judul</h1>
        $text = preg_replace('/^# (.*?)$/m', '<h1>$1</h1>', $text);
        
        // Konversi ## Sub Judul menjadi <h2>Sub Judul</h2>
        $text = preg_replace('/^## (.*?)$/m', '<h2>$1</h2>', $text);
        
        // Konversi - bullet point menjadi <li>
        $lines = explode("\n", $text);
        $inList = false;
        $result = [];
        
        foreach ($lines as $line) {
            if (preg_match('/^- (.*?)$/', $line, $matches)) {
                if (!$inList) {
                    $result[] = '<ul>';
                    $inList = true;
                }
                $result[] = '<li>' . $matches[1] . '</li>';
            } else {
                if ($inList) {
                    $result[] = '</ul>';
                    $inList = false;
                }
                $result[] = $line;
            }
        }
        
        if ($inList) {
            $result[] = '</ul>';
        }
        
        $text = implode("\n", $result);
        
        // Konversi <br> menjadi tag <br>
        $text = str_replace('<br>', '<br>', $text);
        
        return $text;
    }
}