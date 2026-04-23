<?php
function Convertnumber2english($srting)
{

    $srting = str_replace('۰', '0', $srting);
    $srting = str_replace('۱', '1', $srting);
    $srting = str_replace('۲', '2', $srting);
    $srting = str_replace('۳', '3', $srting);
    $srting = str_replace('۴', '4', $srting);
    $srting = str_replace('۵', '5', $srting);
    $srting = str_replace('۶', '6', $srting);
    $srting = str_replace('۷', '7', $srting);
    $srting = str_replace('۸', '8', $srting);
    $srting = str_replace('۹', '9', $srting);

    return $srting;
}

function Convertnumber2arabic($srting)
{
    $srting = str_replace('0', '۰', $srting);
    $srting = str_replace('1', '۱', $srting);
    $srting = str_replace('2', '۲', $srting);
    $srting = str_replace('3', '۳', $srting);
    $srting = str_replace('4', '۴', $srting);
    $srting = str_replace('5', '۵', $srting);
    $srting = str_replace('6', '۶', $srting);
    $srting = str_replace('7', '۷', $srting);
    $srting = str_replace('8', '۸', $srting);
    $srting = str_replace('9', '۹', $srting);

    return $srting;
}
?>