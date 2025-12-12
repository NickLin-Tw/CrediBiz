<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RocIdNumber implements ValidationRule
{
    /**
     * 中華民國身分證字號驗證規則
     *
     * 驗證邏輯：
     * 1. 格式：1個大寫字母 + 1個數字(1或2) + 8個數字
     * 2. 字母對應數字表（A=10, B=11, ..., Z=35）
     * 3. 檢查碼驗證公式
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // 格式檢查：1個大寫字母 + 1個數字(1或2) + 8個數字
        if (!preg_match('/^[A-Z][12]\d{8}$/', $value)) {
            $fail('身分證字號格式錯誤（例如：A123456789）');
            return;
        }

        // 字母對應數字表
        $letterToNumber = [
            'A' => 10, 'B' => 11, 'C' => 12, 'D' => 13, 'E' => 14, 'F' => 15, 'G' => 16, 'H' => 17,
            'I' => 34, 'J' => 18, 'K' => 19, 'L' => 20, 'M' => 21, 'N' => 22, 'O' => 35, 'P' => 23,
            'Q' => 24, 'R' => 25, 'S' => 26, 'T' => 27, 'U' => 28, 'V' => 29, 'W' => 32, 'X' => 30,
            'Y' => 31, 'Z' => 33
        ];

        // 取得字母對應的數字
        $firstLetter = substr($value, 0, 1);
        $letterNum = $letterToNumber[$firstLetter];

        // 將字母數字拆成兩位數
        $n1 = floor($letterNum / 10);
        $n2 = $letterNum % 10;

        // 取得後面9個數字
        $digits = array_map('intval', str_split(substr($value, 1)));

        // 計算檢查碼
        // 公式：n1*1 + n2*9 + d1*8 + d2*7 + d3*6 + d4*5 + d5*4 + d6*3 + d7*2 + d8*1 + d9*1
        $sum = $n1 * 1 + $n2 * 9 +
               $digits[0] * 8 +
               $digits[1] * 7 +
               $digits[2] * 6 +
               $digits[3] * 5 +
               $digits[4] * 4 +
               $digits[5] * 3 +
               $digits[6] * 2 +
               $digits[7] * 1 +
               $digits[8] * 1;

        // 檢查碼應該要能被10整除
        if ($sum % 10 !== 0) {
            $fail('身分證字號檢查碼錯誤，請確認是否輸入正確');
        }
    }
}
