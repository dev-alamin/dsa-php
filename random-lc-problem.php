<?php
// Problem: Find longest common prefix from array of strings
// Strategy: Use first string as model, shrink prefix as we iterate
// Why it works: Common prefix reduces when mismatch found
function longestprefix( $str ) {
    $prefix = $str[0];
    
    foreach( $str as $char ) {
        $i = 0;
        $char = strtolower( $char );
        
        while( isset( $prefix[$i], $char[$i] ) && $prefix[$i] === $char[$i] ) {
            $i++;
        }
        
        $prefix = substr( $prefix, 0, $i );
        
        if( $prefix == '' ) break;
    }
    
    return $prefix;
}

print_r( longestprefix( ['shopify', 'Shopping', 'shopcart'] ) );

// Problem: Check if string is prefix of concatenated words
// 1961. Check If String Is a Prefix of Array

// Given a string s and an array of strings words, 
// determine whether s is a prefix string of words.
// A string s is a prefix string of words if s can be made by concatenating 
// the first k strings in words for some positive k no larger than words.length.
// Return true if s is a prefix string of words, or false otherwise.
function isPrefixString($s, $words) {
    $str = '';
    
    for( $i = 0; $i < count( $words ); $i++ ) {
        $str .= $words[$i];
        
        if( $str === $s ) {
            return true;
            break;
        }
    }
    
    return false;
}

$s = "a";
$words = ["aa","aaaa","banana"];

var_dump( isPrefixString($s, $words)  );

// 38. Count and Say
/**
 * @param Integer $n
 * @return String
 */
function countAndSay($n) {
    $result = "1";
    
    for ($i = 2; $i <= $n; $i++) {
        $current = "";
        $count = 1;
        $len = strlen($result);
        
        for ($j = 1; $j < $len; $j++) {
            if ($result[$j] == $result[$j - 1]) {
                $count++;
            } else {
                $current .= $count . $result[$j - 1];
                $count = 1;
            }
        }
        
        // Don't forget to add the last group
        $current .= $count . $result[$len - 1];
        $result = $current;
    }

    return $result;
}

// 2042. Check if Numbers Are Ascending in a Sentence
/**
 * @param String $s
 * @return Boolean
 */
function areNumbersAscending($s) {
    $number = preg_match_all( '/[0-9]+/', $s, $match );
    $arr = $match[0];
    
    for( $i = 1; $i < count( $arr ); $i++ ) {
        if( ( (int) $arr[$i-1] >= (int) $arr[$i] ) ){
            return false;
        }
    }
    
    return true;
}

// 2062. Count Vowel Substrings of a String
function countVowelSubstrings(string $word): int {
    $n = strlen($word);
    $count = 0;
    $vowels = ['a', 'e', 'i', 'o', 'u'];

    // Check all substrings
    for ($i = 0; $i < $n; $i++) {
        $vowelSet = [];
        for ($j = $i; $j < $n; $j++) {
            $char = $word[$j];
            if (!in_array($char, $vowels)) {
                break; // stop if non-vowel
            }
            $vowelSet[$char] = true;
            if (count($vowelSet) === 5) {
                $count++;
            }
        }
    }

    return $count;
}

// 2942. Find Words Containing Character
function findWordsContaining($words, $x) {
    $n = count($words);
    $val = [];

    for ($i = 0; $i < $n; $i++) {
        $word = $words[$i];
        $found = false;

        // Loop through each character in the word
        for ($j = 0; $j < strlen($word); $j++) {
            if ($word[$j] === $x) {
                $found = true;
                break; // No need to continue once found
            }
        }

        if ($found) {
            $val[] = $i;
        }
    }

    return $val;
}

$words = ["apple", "banana", "cherry", "date"];
$x = "a";
print_r(findWordsContaining($words, $x));

// 2131. Longest Palindrome by Concatenating Two Letter Words
/**
 * You are given an array of strings words. 
 * Each element of words consists of two lowercase English letters.
* 
* Create the longest possible palindrome by selecting some elements
* from words and concatenating them in any order. Each element can be selected at most once.
* 
* Return the length of the longest palindrome that you can create. 
* If it is impossible to create any palindrome, return 0.
* 
* A palindrome is a string that reads the same forward and backward.
 *
 * @param [type] $words
 * @return void
 */
function longestPalindrome($words) {
    $count = [];
    $result = 0;
    $centerUsed = false;

    // Count frequencies
    foreach ($words as $word) {
        $count[$word] = ($count[$word] ?? 0) + 1;
    }

    foreach ($count as $word => $freq) {
        $rev = strrev($word);

        if ($word === $rev) {
            // Symmetric word like 'aa'
            $pair = intdiv($freq, 2);
            $result += $pair * 4;

            // Check if we can use one as the center
            if ($freq % 2 === 1 && !$centerUsed) {
                $result += 2;
                $centerUsed = true;
            }
        } elseif (strcmp($word, $rev) < 0 && isset($count[$rev])) {
            // Asymmetric and only count one direction to avoid double counting
            $pair = min($count[$word], $count[$rev]);
            $result += $pair * 4;
        }
    }

    return $result;
}

$words = ["lc","cl","gg"];
echo longestPalindrome($words); // Output: 6

// Find the maximum sum of subarray size of k
function maxSumSubarrayOfSizeK($arr, $k) {
    $maxSum = 0;
    $windowSum = 0;
    $start = 0;
    
    for( $i = 0; $i < count( $arr ); $i++ ) {
        $windowSum += $arr[$i];
        
        if( $i >= $k - 1 ) {
            $maxSum = max( $maxSum, $windowSum );
            
            $windowSum -= $arr[$start];
            
            $start++;
        }
    }
    
    return $maxSum;
}

// Test
$arr = [2, 1, 5, 1, 3, 2];
$k = 3;
echo maxSumSubarrayOfSizeK($arr, $k); // Output: 9

// 643. Maximum Average Subarray I
// Level: Easy, Topics: Sliding Window, Prefix Sum
function findMaxAverage($arr, $k) {
    $maxSum = PHP_INT_MIN;
    $windowSum = 0;
    $start = 0;

    for ($end = 0; $end < count($arr); $end++) {
        $windowSum += $arr[$end];

        if ($end >= $k - 1) {
            $maxSum = max($maxSum, $windowSum);
            $windowSum -= $arr[$start];
            $start++;
        }
    }

    return $maxSum / $k;
}


// Test
$nums = [8860,-853,6534,4477,-4589,8646,-6155,-5577,-1656,-5779,
-2619,-8604,-1358,-8009,4983,7063,3104,-1560,4080,2763,5616,-2375,
2848,1394,-7173,-5225,-8244,-809,8025,-4072,-4391,-9579,1407,6700,2421,
-6685,5481,-1732,-8892,-6645,3077,3287,-4149,8701,-4393,-9070,-1777,2237,
-3253,-506,-4931,-7366,-8132,5406,-6300,-275,-1908,67,3569,1433,-7262,-437,
8303,4498,-379,3054,-6285,4203,6908,4433,3077,2288,9733,-8067,3007,9725,9669,
1362,-2561,-4225,5442,-9006,-429,160,-9234,-4444,3586,-5711,-9506,-79,-4418,
-4348,-5891];
$k = 93;
echo findMaxAverage($nums, $k);

// 209. Minimum Size Subarray Sum
// Level: Medium, Topics: Sliding Window, Prefix Sum
/*
 * | Type                      | Use `for` only | Use `for` + `while` |
 * | ------------------------- | -------------- | ------------------- |
 * | Fixed window size         | ✅              | ❌                   |
 * | Dynamic window condition  | ❌              | ✅                   |
 * | Goal: max sum of size k   | ✅              | ❌                   |
 * | Goal: min length ≥ target | ❌              | ✅                   |
 *  */
function minSubArrayLen($target, $nums) {
    $n = count($nums);
    $minLength = PHP_INT_MAX;
    $windowSum = 0;
    $start = 0;
    
    for( $i = 0; $i < $n; $i++ ) {
        $windowSum += $nums[$i];
        
        while( $target <= $windowSum ) {
            $minLength = min($minLength, $i - $start + 1 );
            
            $windowSum -= $nums[$start];
            $start++;
        }
    }
    
    return $minLength === PHP_INT_MAX ? 0 : $minLength;
}

print_r( minSubArrayLen( 11, [1,1,1,1,1,1,1,1] ) );

// 5. Longest Palindromic Substring
// Given a string s, return the longest palindromic substring in s.

function longestPalindrome2($s) {
    $n = strlen($s);
    if ($n < 2) return $s;

    $start = 0;
    $maxLen = 1;

    for ($i = 0; $i < $n; $i++) {
        // Odd length palindrome
        expandAroundCenter($s, $i, $i, $start, $maxLen);

        // Even length palindrome
        expandAroundCenter($s, $i, $i + 1, $start, $maxLen);
    }

    return substr($s, $start, $maxLen);
}

function expandAroundCenter($s, $left, $right, &$start, &$maxLen) {
    $n = strlen($s);
    while ($left >= 0 && $right < $n && $s[$left] === $s[$right]) {
        $left--;
        $right++;
    }

    $len = $right - $left - 1;
    if ($len > $maxLen) {
        $start = $left + 1;
        $maxLen = $len;
    }
}


$s = "babad";

print_r( longestPalindrome2($s) );

function addStrings($num1, $num2) {
    $i = strlen($num1) - 1;
    $j = strlen($num2) - 1;
    $carry = 0;
    $result = '';

    while ($i >= 0 || $j >= 0 || $carry > 0) {
        $digit1 = $i >= 0 ? ord($num1[$i]) - ord('0') : 0;
        $digit2 = $j >= 0 ? ord($num2[$j]) - ord('0') : 0;

        $sum = $digit1 + $digit2 + $carry;
        $carry = intdiv($sum, 10);
        $digit = $sum % 10;

        $result = $digit . $result;

        $i--;
        $j--;
    }

    return $result;
}

echo addStrings("11", "123"); // Output: "134"
echo addStrings("456", "77"); // Output: "533"
echo addStrings("0", "0");    // Output: "0"

// 273. Integer to English Words
// Level: Hard, Topics: Math, String, Recursion
// Convert a non-negative integer num to its English words representation
function numberToWords($num) {
    if ($num == 0) return "Zero";

    // We put an empty string at the start to make indexing easier
    // e.g. $below_20[1] will give "One", $below_20[2] will give "Two"
    $below_20 = [
        "", "One", "Two", "Three", 
        "Four", "Five", "Six", "Seven", "Eight", 
        "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
        "Fourteen", "Fifteen", "Sixteen", 
        "Seventeen", "Eighteen", "Nineteen"
    ];
    
    // We put two empty elements at the start to make indexing easier
    // e.g. $tens[2] will give "Twenty", $tens[3] will give "Thirty"
    $tens = [
        "", "", "Twenty", "Thirty", "Forty", 
        "Fifty", "Sixty", "Seventy", "Eighty", 
        "Ninety"
    ];

    // We put an empty string at the start to make indexing easier
    // e.g. $thousands[1] will give "Thousand", $thousands[2] will give "Million"
    $thousands = ["", "Thousand", "Million", "Billion"];

    /**
     * Helper function to convert numbers less than 1000 to words
     * @param int $n
     * @return string
     * This function recursively converts numbers to words
     * It handles numbers from 0 to 999
     * It uses the $below_20 and $tens arrays to map numbers to words
     * It returns a string representation of the number
     * It handles hundreds, tens, and units separately
     * It trims any extra space before returning the result
     */
    $helper = function ($n) use (&$helper, $below_20, $tens) {
        if ($n == 0) return "";
        elseif ($n < 20) return $below_20[$n] . " "; // Single digit or teens e.g. 7 -> "Seven", 15 -> "Fifteen"
        elseif ($n < 100) return $tens[intval($n / 10)] . " " . $helper($n % 10); // Tens e.g. 42 -> "Forty Two"
        else return $below_20[intval($n / 100)] . " Hundred " . $helper($n % 100); // Hundreds e.g. 123 -> "One Hundred Twenty Three
    };

    $res = "";
    $i = 0;

    // Process the number in groups of three digits
    // How it becomes three digits: is by dividing the number by 1000
    // e.g. 1234567 becomes 1234 (first iteration) and then 1 (second iteration)
    // The loop continues until the number is reduced to 0
    // The $i variable keeps track of the current group of three digits
    // e.g. 0 -> "", 1 -> "Thousand", 2 -> "Million", 3 -> "Billion"
    while ($num > 0) {
        
        if ($num % 1000 != 0) {
            $res = $helper($num % 1000) . $thousands[$i] . " " . $res; // Process each group of three digits
        }
        
        $num = intval($num / 1000); // Remove the last three digits, e.g 1234567 becomes 1234
        $i++;
    }

    return trim(preg_replace('/\s+/', ' ', $res));
}

$num = 1234567;
print_r( numberToWords( $num ) );