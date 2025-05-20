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