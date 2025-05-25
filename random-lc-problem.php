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
