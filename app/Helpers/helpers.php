<?php

use Illuminate\Support\Str;

if (!function_exists('create_slug')) {
  /**
   * description
   *
   * @param string $str
   * @return string lowercase
   */
  function create_slug($string)
  {
    $t = $string;
    $specChars = array(
        ' ' => '-',    '!' => '',    '"' => '',
        '#' => '',    '$' => '',    '%' => '',
        '&' => 'and',    '\'' => '',   '(' => '',
        ')' => '',    '*' => '',    '+' => '',
        ',' => '',    '₹' => '',    '.' => '',
        '/-' => '',    ':' => '',    ';' => '',
        '<' => '',    '=' => '',    '>' => '',
        '?' => '',    '@' => '',    '[' => '',
        '\\' => '',   ']' => '',    '^' => '',
        '_' => '',    '`' => '',    '{' => '',
        '|' => '',    '}' => '',    '~' => '',
        '-----' => '-',    '----' => '-',    '---' => '-',
        '/' => '',    '--' => '-',   '/_' => '-',
    );
    foreach ($specChars as $k => $v) {
      $t = str_replace($k, $v, $t);
    }
    return Str::lower($t);
  }
}

// if (!function_exists('setting')) {
//   function setting($key = false, $defaultValue = false) {
//       $setting = app('Setting');
//       if ($key === false) {
//           return $setting;
//       }

//       $value = $setting->get($key);

//       return $value ? $value : $defaultValue;
//   }
// }

if (! function_exists('assetUrl')) {
  function assetUrl() {
    return asset('public/assets/backend/');
  }
}

if (! function_exists('uploadUrl')) {
  function uploadUrl() {
    return asset('public/uploads/');
  }
}
