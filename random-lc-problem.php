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