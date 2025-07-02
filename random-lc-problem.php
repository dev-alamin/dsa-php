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

class NumberToWord {
    private $below_twenty = [
        '','one', 'two', 'three',
        'four', 'five', 'six', 'seven',
        'eight', 'nine', 'ten', 'eleven',
        'twelve', 'thirteen', 'fourteen',
        'fifteen', 'sixteen', 'seventeen',
        'eighteen', 'nineteen'
    ];

    private $teens = [
        '', '', 'twenty', 'thirty', 'forty',
        'fifty', 'sixty', 'seventy', 'eighty', 'ninety'
    ];

    private $thousands = [
        '', 'thousand', 'millioin', 'billion'
    ];

    private function helper($n) {
        if( $n == 0 ) return '';
        if( $n < 20 ) return $this->below_twenty[$n] . " ";
        if( $n < 100 ) return $this->teens[intval($n/10)] . " " . $this->helper( $n % 10 );
        else return $this->below_twenty[intval($n/100)] . " hundred " . $this->helper( $n % 100 );
    } 

    public function convert( $n ){
        $i = 0;
        $res = '';

        while( $n > 0 ) {
            if( $n % 1000 != 0 ) {
                $res = $this->helper( $n % 1000 ) . $this->thousands[$i] . " " . $res;
            }

            $n = intval( $n / 1000 );
            $i++;
        }

        return $res;
    }
}

// 2068. Check Whether Two Strings are Almost Equivalent
// Two strings word1 and word2 are considered almost equivalent 
// if the differences between the frequencies of each letter from 'a' to 'z' between word1 and word2 is at most 3.
// Given two strings word1 and word2, each of length n, return true if word1 and word2 are almost equivalent, or false otherwise.
// The frequency of a letter x is the number of times it occurs in the string.
function checkAlmostEquivalent($word1, $word2) {
    $map1 = [];
    $map2 = [];
    
    for( $i = 0; $i < strlen( $word1 ); $i++ ) {
         $map1[$word1[$i]] = ( $map1[$word1[$i]] ?? 0 ) + 1;
    }
    
    
    for( $i = 0; $i < strlen( $word2 ); $i++ ) {
       $map2[$word2[$i]] = ($map2[$word2[$i]] ?? 0 ) + 1;
    }
    
    $allKeys = array_unique(array_merge(array_keys($map1), array_keys($map2))); // Get all unique characters from both maps

    // Check the frequency difference for each character
    // If the difference is greater than 3, return false
    // If the character is not present in one of the maps, its frequency is considered 0
    // This ensures we check all characters from both strings
    foreach ($allKeys as $char) {
        $freq1 = $map1[$char] ?? 0;
        $freq2 = $map2[$char] ?? 0;

        if (abs($freq1 - $freq2) > 3) {
            return false;
        }
    }
    
    return true;
}

$word1 = "aaaa";
$word2 = "bccb";

print_r( checkAlmostEquivalent($word1, $word2) );

// 345. Reverse Vowels of a String
// Level: Easy, Topics: Two Pointers, String
// Given a string s, reverse only all the vowels in the string and return it.
// The vowels are 'a', 'e', 'i', 'o', and 'u', and they can appear in both lower and upper cases, more than once.
function reverseVowels($s) {
    $vowels = array_flip( ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'] );    
    $l = 0;
    $r = strlen( $s ) - 1;
    
    while( $l < $r ) {
        // this is because we need to cehck if only vowels are present
        // if not, we need to skip the character
        if( ! array_key_exists( $s[$l], $vowels ) ) {
            $l++;
            continue;
        }
        
        if( ! array_key_exists( $s[$r], $vowels ) ) {
            $r--;
            continue;
        }

        /** 
        * Swap the vowels
        * We use list destructuring to swap the values in a single line
        * This is a shorthand way to swap two variables in PHP
        * It is equivalent to:
        * $temp = $s[$l];
        * $s[$l] = $s[$r];
        * $s[$r] = $temp;
        * But more concise and readable
        * It also avoids the need for a temporary variable
        * This is a common pattern in PHP to swap two values
        * It is a good practice to use list destructuring when swapping values
        * It makes the code cleaner and easier to understand
        * It is also more efficient than using a temporary variable
        */
        [$s[$l], $s[$r]] = [$s[$r], $s[$l] ];

        $l++;
        $r--;
    }
    
    return $s;
}

echo reverseVowels("leetcode"); // Output: "leotcede"

// 383. Ransom Note
// Level: Easy, Topics: Hash Table String Counting
// Given two strings ransomNote and magazine, return true 
// if ransomNote can be constructed by using the letters from magazine and false otherwise.
// Each letter in magazine can only be used once in ransomNote.
function canConstruct($ransomNote, $magazine) {
    $magazineMap = [];

    // Count letters in magazine
    foreach (str_split($magazine) as $char) {
        $magazineMap[$char] = ( $magazineMap[$char] ?? 0 ) + 1;
    }

    // Check if ransomNote can be built
    foreach (str_split($ransomNote) as $char) {

        // The (inventory) runs out when we decrement the count to zero
        // If we try to decrement a character that is not present in the magazine, it will return false
        if (empty($magazineMap[$char])) {
            return false;
        }
        // Important things here is
        // we are decrementing the count of the character
        // This ensures that we do not use the same character more than it appears in the magazine
        // For example, if magazine has "a" only once, we cannot use it twice in ransomNote
        // This is common technique in problems where we need to check if one string can be formed from another
        $magazineMap[$char]--;
    }

    return true;
}

$ransomNote = "aa";
$magazine = "aab";
print_r( canConstruct($ransomNote, $magazine) ); // Output: true

// 434. Number of Segments in a String
// Level: Easy, Topics: String, Counting
// Given a string s, return the number of segments in the string.
// A segment is defined to be a contiguous sequence of non-space characters.
function countSegments($s) {
    $rgx = preg_replace( '/\s+/', ' ', $s );
    if( $rgx === " " ) return 0;
    
    $n = strlen( $rgx );
    $sentence = [];
    $word = '';
    
    for( $i = 0; $i < $n; $i++ ) {
        // var_dump(  $rgx[$i] == ' ' );
        
        if( $rgx[$i] != ' ' ) {
        $word .= $rgx[$i];
        }else{
            $sentence[] = $word;
            $word = '';
            // echo 'No space';
        }
    }
    
    if( $word != '' ) {
        $sentence[] = $word;
    }
    
    $count = 0;
    foreach( $sentence as $word ) {
        if( ! empty( $word ) ) {
            $count++;
        }
    }
    
    return $count;
}
 /**
 * 1002. Find Common Characters
 * Given a string array words, return an array of all characters 
 * --that show up in all strings within the words (including duplicates). 
 * --You may return the answer in any order.
 */
function commonChars($words) {
    $freq = array_count_values( str_split( $words[0] ) );
    
    for( $i = 1; $i < count( $words ); $i++ ) {
        $currentFreq = array_count_values( str_split( $words[$i] ) );
        
        foreach( $freq as $char => $count ) {
            if( isset( $currentFreq[$char] ) ) {
                /**
                * Update the frequency to the minimum count found so far
                * --This ensures that we only keep characters that are present in all strings
                * --------------------------------------------------------------------------
                * For example, if 'a' appears 3 times in the first string and 2 times in the second string,
                * --we will keep it 2 times in the result
                * --This is because we want to find common characters, so we take the minimum count
                * --This is a common technique in problems where we need to find common elements in multiple arrays
                */
                $freq[$char] = min($count, $currentFreq[$char]);
            }else{
                /**
                 * If the character is not present in the current string,
                 * we remove it from the frequency array
                 * This ensures that we only keep characters that are present in all strings
                 */
                unset($freq[$char]);
            }
        }
    }
    
    /**
     * We need to return the characters in the frequency array
     * This is done by iterating over the frequency array
     * and adding each character to the result array
     * This is because we need to return the characters in the same order as they appear in the frequency array
     * This is a common technique in problems where we need to return elements based on their frequency
     * This is also known as "expanding" the frequency array into a result array
     * For example, if the frequency array is ['a' => 2, 'b' => 3],
     * --we will return ['a', 'a', 'b', 'b', 'b']
     */
    $res = [];
    foreach( $freq  as $char => $count ) {
        for( $i = 0; $i < $count; $i++ ) {
            $res[] = $char;
        }
    }
    
    return $res;
}

$words = ["bella","label","roller"];

print_r( commonChars($words) ); // Output: ["e","l","l"]

/**
 * 228. Summary Ranges
 * Given a sorted integer array without duplicates,
 * return the summary of its ranges.
 * A range [a,b] is represented as a string "a->b" if a != b,
 * or "a" if a == b.
 * SumaryRanges
 *
 * @param Array $nums
 * @return array
 */
function summaryRanges( $nums ) : array
{
    $res = [];
    $n = count( $nums );
    $start = $nums[0];
    
    /**
    * Iterate through the array to find ranges
    * We use a for loop to iterate through the array
    * We have checked <= $n to ensure we don't go out of bounds
    */
    for( $i = 1; $i <= $n; $i++ ) {
        /**
        * If we reach the end of the array or the current number is not consecutive
        * ---We check if the current number is not equal to the previous number + 1
        * ---If it is not, we have found a range
        * We then set the end of the range to the previous number
        * We then check if the start and end are the same
        * ---If they are the same, we add the start to the result
        * ---If they are not the same, we add the range in the format "start->end"
        */
        if( $i === $n || $nums[$i] != $nums[$i-1]+1 ) {
            $end = $nums[$i-1];
            
            if( $start === $end ) {
                $res[] = (string)$start; // This is an individual number, not a range
            }else{
                $res[] = "$start->$end"; // This is a range, e.g. "1->5"
            }
            
            // If we haven't reached the end, set new start for next range
            // This is to ensure that we start a new range from the current number
            if( $i < $n ) {
                $start = $nums[$i];
            }
        }
        
    }
    return $res;
}

print_r( summaryRanges( [0,1,2,4,5,7] ) );

/**
 * 1984. Find the Maximum Possible Difference Between Two Elements in an Array
 * Given an array of integers nums, find the maximum possible difference between two elements in the array.
 * The maximum possible difference is defined as the absolute difference between two elements in the array.
 * If the array contains less than two elements, return -1.
 * * Example:
 * Input: nums = [1,5,3,9,2]
 * Output: 8
 *
 * @param array $nums
 * @return int
 */
function maximumDifference($nums) : int {
    $minVal = $nums[0];
    $maxDiff = -1;

    for ($i = 1; $i < count($nums); $i++) {
        if ($nums[$i] > $minVal) {
            $maxDiff = max($maxDiff, $nums[$i] - $minVal);
        } else {
            $minVal = $nums[$i];
        }
    }

    return $maxDiff;
}

// 9. Palindrome Number
function isPalindrome($x) {
    if ($x < 0) return false;

    $str = strval($x);
    return $str === strrev($str);
}

// Example:
var_dump(isPalindrome(121));  // true
var_dump(isPalindrome(-121)); // false
var_dump(isPalindrome(10));   // false

// 2591. Distribute Money to Maximum Children
// Level: Easy, Topics: Greedy, Math

/** * You are given an integer money, the total amount of money you have to distribute.
 * You are also given an integer children, the number of children you need to distribute the money to.
 * You need to distribute the money according to the following rules:
 * 1. Each child gets at least 1 dollar.
 * 2. Each child gets at most 8 dollars.
 * 3. You cannot give any child more than 8 dollars.
 * Return the maximum number of children who can receive exactly 8 dollars.
 * If it is not possible to distribute the money according to the rules, return -1.
 * @param int $money
 * @param int $children
 * @return int
 */
function distMoney($money, $children) {
    $money -= $children;
    if ($money < 0){
        return -1;
    }

    $mc = floor($money / 7);
    $mca = $money % 7;

    /**
     * If we have exactly 3 children and the money left is 0,
     * we can give each child 8 dollars, so we return the number of children.
     * This is because we can give each child at least 1 dollar.
     * If we have 3 children and the money left is 0, we can give
     * each child 8 dollars, so we return the number of children.
     * This is a special case where we have exactly 3 children and the money left is 0.
     * We need to handle this case separately because it is not possible to give
     * each child more than 8 dollars.
     * This is a common technique in problems where we need to handle special cases separately
     * This is also known as "edge case" handling
     * It is important to handle edge cases separately because they can cause unexpected behavior
     * If we don't handle edge cases separately, we can end up with incorrect results
     */
    if ($mc == $children && $mca == 0){
        return $children;
    }

    /**
     * If we have exactly 3 children and the money left is 3,
     * we cannot give them 8 dollars each, so we return -1.
     * This is because we cannot give any child more than 8 dollars.
     * If we have 3 children and the money left is 3, we can give
     * 2 children 8 dollars each and 1 child 3 dollars.
     * This is because we can give each child at least 1 dollar.
     * So we return 1 in this case.
     * This is a special case where we have exactly 3 children and the money left is 3.
     * We need to handle this case separately because it is not possible to give
     */
    if (($mc) == ($children - 1) && $mca == 3){
        return $children - 2;
    }

    return min($children - 1, $mc);
}

$money = 20;
$children = 3;
print_r( distMoney($money, $children) );

class Play {
    // This function is like trying all possible ways to arrange the given choices
    public function backtrack( array $path, array $choices ) {
        
        // If no choices left, we have formed one complete path — print it
        if( count( $choices ) === 0 ) {
            print_r( $path );  // Think of it like "I found one full combination!"
            return;
        }

        // Loop through each available choice
        for( $i = 0; $i < count( $choices ); $i++ ) {

            // Make a copy of current path and add one choice to it
            // Like: "Let me try picking this option next"
            $newPath = $path;
            $newPath[] = $choices[$i];

            // Make a copy of choices and remove the one we just picked
            // So that we don't pick the same one again in this path
            $newChoices = $choices;
            array_splice( $newChoices, $i, 1 );

            // Go deeper with new path and reduced choices
            // Like: "Okay, what's next after picking this one?"
            $this->backtrack( $newPath, $newChoices );
        }
    }

    public function subsets($nums, $path = [], $index = 0) {
        print_r($path); // print the current subset

        for ($i = $index; $i < count($nums); $i++) {
            $path[] = $nums[$i];           // choose
            $this->subsets($nums, $path, $i + 1); // explore
            array_pop($path);              // backtrack
        }
    }
}

$numbers = [1,2,3];
(new Play())->backtrack( [], $numbers );

// 2099. Find Subsequence of Length K With the Largest Sum
/**
 * MaxSubsequence
*
* You are given an integer array nums and an integer k. 
* You want to find a subsequence of nums of length k that has the largest sum.
* 
* Return any such subsequence as an integer array of length k.
* 
* A subsequence is an array that can be derived from another array 
* by deleting some or no elements without changing the order of the remaining elements.
**/
function maxSubsequence($nums, $k) {
    if( $k === count( $nums ) ) return $nums;
    
    $copy = $nums;
    rsort( $copy );
    
    $freq = array_count_values( array_splice( $copy, 0, $k ) );
    
    $res = [];
    foreach( $nums as $num ) {
        if( isset( $freq[$num] ) && $freq[$num] > 0 ) {
            $res[] = $num;
            $freq[$num]--;
        }
    }
    
    return $res;
}

// Example usage:
$nums = [3, 2, 5, 1, 6, 4];
$k = 3;
print_r(maxSubsequence($nums, $k)); // Output: [5, 6, 4] or any other subsequence of length 3 with the largest sum

// 1498. Number of Subsequences That Satisfy the Given Sum Condition
/** * Given an array of integers nums and an integer target, 
 * return the number of non-empty subsequences of nums such that the sum of the minimum and maximum element on it is less or equal to target.
 * Since the answer may be too large, return it modulo 109 + 7
 * @param array $nums
 * @param int $target
 * @return int
 */
function numSubseq($nums, $target) {
    sort($nums);
    $mod = 1e9 + 7;
    $n = count($nums);
    
    // Precompute powers of 2
    $pow = array_fill(0, $n, 1);
    for ($i = 1; $i < $n; $i++) {
        $pow[$i] = ($pow[$i - 1] * 2) % $mod;
    }

    $left = 0;
    $right = $n - 1;
    $res = 0;

    while ($left <= $right) {
        if ($nums[$left] + $nums[$right] <= $target) {
            $res = ($res + $pow[$right - $left]) % $mod;
            $left++;
        } else {
            $right--;
        }
    }

    return $res;
}

// Example usage:
$nums = [3, 5, 6, 7];
$target = 9;
print_r(numSubseq($nums, $target)); // Output: 4

// 557. Reverse Words in a String III
// Level: Easy, Topics: String, Two Pointers
/**
 * Given a string s, reverse the order of characters in each word within a sentence while still preserving whitespace and initial word order.
 * @param string $s
 * @return string
 */
function reverseWords($s) {
    $arr = explode(' ', $s);
    $res = [];
    foreach ($arr as $index => $word) {
        $letter = str_split($word);
        for ($i = count($letter) - 1; $i >= 0; $i--) {
            $res[] = $letter[$i];
        }
        if ($index < count($arr) - 1) {
            $res[] = ' ';
        }
    }
    return implode("", $res);
}

// Example usage:
$example = "Let's take LeetCode contest";
print_r(reverseWords($example)); // Output: "s'teL ekat


// Problem: 455. Assign Cookies
// Level: Easy, Topics: Greedy, Sorting
/** * Assume you are an awesome parent and want to give your children some cookies.
 * But, you should give each child at most one cookie.
 * Each child i has a greed factor g[i],
 * which is the minimum size of a cookie that the child will be content with;
 * and each cookie j has a size s[j].
 * If s[j] >= g[i], we can assign the cookie j to the child i
 * The goal is to maximize the number of your content children and output the maximum number.
 * @param array $g // greed factor of children
 * @param array $s // size of cookies
 * @return int // maximum number of content children
 */
function findContentChildren($g, $s) {
    sort($g); // greed list
    sort($s); // cookie sizes

    $i = 0; // kid index
    $j = 0; // cookie index

    while ($i < count($g) && $j < count($s)) {
        if ($s[$j] >= $g[$i]) {
            $i++; // kid is happy, go to next kid
        }
        $j++; // try next cookie anyway
    }

    return $i; // number of happy kids
}

// Example usage:
$g = [1, 2, 3]; // greed factors of children
$s = [1, 1]; // sizes of cookies
print_r(findContentChildren($g, $s)); // Output: 1 (only one child can be content with the available cookies)

// 349. Intersection of Two Arrays
// Level: Easy, Topics: Hash Table, Two Pointers
/** * Given two integer arrays nums1 and nums2, return an array of their intersection.
 * Each element in the result must be unique and you may return the result in any order.
 * @param array $nums1
 * @param array $nums2
 * @return array
 */
function intersection($nums1, $nums2) {
    $set1 = array_flip($nums1);
    $seen = [];

    foreach ($nums2 as $num) {
        if (isset($set1[$num])) {
            $seen[$num] = true;
        }
    }

    return array_keys($seen);
}
// Example usage:
$nums1 = [1, 2, 2, 1];
$nums2 = [2, 2];
print_r(intersection($nums1, $nums2)); // Output: [2]

// 392. Is Subsequence
// Level: Easy, Topics: Two Pointers, String
/** * Given two strings s and t, return true if s is a subsequence of t,
 * or false otherwise.
 * A subsequence of a string is a new string that is formed from the original string by
 * deleting some (can be none) of the characters without disturbing the relative positions of the remaining characters.
 * (i.e., "ace" is a subsequence of "abcde" while "aec" is not).
 * @param string $s
 * @param string $t
 * @return bool
 */
function isSubsequence($s, $t) {
    $sIdx = 0;
    $tIdx = 0;
    while ($sIdx < strlen($s) && $tIdx < strlen($t)) {
        if ($s[$sIdx] === $t[$tIdx]) {
            $sIdx++;
        }
        $tIdx++;
    }
    return $sIdx === strlen($s);
}
// Example usage:
$s = "abc";
$t = "ahbgdc";
print_r(isSubsequence($s, $t)); // Output: true

// 179. Largest Number
// Level: Medium, Topics: Sorting, Greedy
/** * Given a list of non-negative integers nums, arrange them such that they form the largest
 * possible number and return it as a string.
 * Since the result may be very large, you need to return a string instead of an integer
 * @param array $nums
 * @return string
 */
function largestNumber($nums) {
    // Convert numbers to strings for concatenation
    $strs = array_map('strval', $nums);

    // Custom sort using concatenation
    usort($strs, function($a, $b) {
        return strcmp($b . $a, $a . $b);
    });

    // Edge case: if the highest number is "0", all are zero
    if ($strs[0] === "0") {
        return "0";
    }

    return implode('', $strs);
}

// Example usage:
$nums = [10, 2];
print_r(largestNumber($nums)); // Output: "210"

