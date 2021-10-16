<?php

namespace App\Helpers;

class NumberFormatHelper
{
    public static function formatInteger(int $number): string
    {
        return number_format($number, 0, ",", ".");
    }

    public static function formatIntegerToShortForm(int $number): string
    {
        if ($number < 1e3) {
            return "$number";
        }

        if ($number < 1e6) {
            $division = $number / 1e3;
            $termination = "mil";
        } elseif ($number < 1e9) {
            $division = $number / 1e6;
            $termination = "mi";
        } elseif ($number < 1e12) {
            $division = $number / 1e9;
            $termination = "bi";
        } else {
            $division = $number / 1e12;
            $termination = "tri";
        }

        $result = floor($division * 10) / 10;
        $shortForm = str_replace(".", ",", "$result $termination");

        return $shortForm;
    }
}
