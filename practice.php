<?php
function findTarget( $nums, $target ) {
    $left = 0;
    $right = count( $nums ) - 1;

    while( $left <= $right ) {
        $mid = floor( ($right + $left) / 2 );

        if( $nums[$mid] == $target ) {
            return true;
        }
        
        if( $nums[$mid] < $target ) {
            $left = $mid + 1;
        }else{
            $right = $mid - 1;
        }
    }

    return false;
}

function bubbleSort( &$arr ) {
    $n = count($arr) -1;

    // Loop over the array
    for ( $i = 0; $i < $n; $i++ ) {
        for ( $j = 0; $j < $n - $i; $j++ ) {
            // Compare adjacent elements
            if ( $arr[$j] > $arr[$j + 1] ) {
                // Swap if elements are in the wrong order
                $temp        = $arr[$j];
                $arr[$j]     = $arr[$j + 1];
                $arr[$j + 1] = $temp;
            }
        }
    }
}

function findSecondLargest( $arr ) {
    $max = PHP_INT_MIN;
    $second_max = PHP_INT_MIN;

    foreach( $arr as $number ) {
        if( $max < $number ) {
            $second_max = $max;
            $max = $number;
        }elseif( $number > $second_max && $number < $max ) {
            $second_max = $number;
        }
    }

    return $second_max;
}

$second_large = [2,3,4,5,12];

echo findSecondLargest( $second_large );

function findNthLargest($arr, $n) {
    if (count($arr) < $n) {
        return "Array must contain at least $n elements.";
    }
    
    // Initialize an array to hold the top `n` largest elements
    $largest = array_fill(0, $n, PHP_INT_MIN);

    foreach ($arr as $num) {
        for ($i = 0; $i < $n; $i++) {
            if ($num > $largest[$i]) {
                // Shift smaller values down the array
                for ($j = $n - 1; $j > $i; $j--) {
                    $largest[$j] = $largest[$j - 1];
                }
                $largest[$i] = $num; // Insert the new number
                break;
            }
        }
    }
    
    return $largest[$n - 1]; // Return the nth largest element
}

// Example usage
$array = [4, 9, 5, 2, 8, 0, 3, 22];
echo findNthLargest($array, 1); // Output: 8

/**
 * Find the Nth position from an array
 *
 * @param [type] $arr
 * @param [type] $x
 * @return void
 */
function findExactLargeNumber($arr, $x){
    if( count( $arr ) < $x ) {
        return "Array must contain at least $x element";
    }

    $largest = array_fill(0, $x, PHP_INT_MIN);
    
    foreach( $arr as $num ) { // Loop all element
        for( $i = 0; $i < $x; $i++ ) { // Loop just the nth largest element
            if( $num > $largest[$i] ){ // Compare the largest number with current number
                for( $j = $x - 1; $j > $i; $j-- ) { // Downshift the number for descending order
                    $largest[$j] = $largest[$j-1];
                }
                $largest[$i] = $num; // Update the largest array with large number
                break; // Break the compare as the array is filled
            }
        }
    }

    return $largest[$x -1];
}

// echo findExactLargeNumber( [2,3,5,6], 2 );

function getAnotherNthNumber( array $arr, int $nth ) {
    if( count( $arr ) < $nth ) {
        return "Array must contain at least $nth element";
    }

    $largest = array_fill( 0, $nth, PHP_INT_MIN );

    foreach( $arr as $number ) {
        for($i = 0; $i < $nth; $i++){
            if( $number > $largest[$i] ) {
                for($j = $nth - 1; $j > $i; $j-- ) {
                    $largest[$j] = $largest[$j-1];
                }

                $largest[$i] = $number;
                break;
            }
        }
    }

    return $largest[$nth-1];
}

// echo getAnotherNthNumber([1,2,3,4],1);

/**
 * Counting Sort for Sorting an array
 *
 * @param [array] $arr
 * @return void
 */
function countingSort( array $array ) {

    if( count( $array ) < 2 ) {
        return $array;
    }

    $min = min( $array );
    $max = max( $array );
    $range = $max - $min + 1;

    $count = array_fill( 0, $range, 0 );
    $output = [];

    foreach( $array as $number ) {
        $count[$number - $min]++;
    }

    for( $i = 0; $i < $range; $i++ ) {
        while( $count[$i] < 0 ) {
            $output[] = $i + $min;
            $count[$i]--;
        }
    }

    return $output;
}

$numbers = [4, 3, 8];
countingSort( $numbers );

function twoSum(array $nums, int $target): array {
    $map = [];
    
    foreach ($nums as $index => $num) {
        $complement = $target - $num;
        
        if (isset($map[$complement])) {
            return [$map[$complement], $index];
        }

        $map[$num] = $index;
    }
    
    return [];
}

// Example usage
$nums = [2, 7, 11, 15];
$target = 18;
$result = twoSum($nums, $target);

if (!empty($result)) {
    echo "Indices: " . implode(", ", $result);
} else {
    echo "No two numbers add up to the target.";
}

function quickSort( array $array ) {
    if( count( $array ) < 2 ) {
        return $array;
    }

    $left = $right = [];
    $pivot = $array[0];

    for( $i = 1; $i < count( $array ); $i++ ) {
        if( $array[$i] <= $pivot ) {
            $left[] = $array[$i];
        }else{
            $right[] = $array[$i];
        }
    }

    return merge_array( quickSort( $left ), quickSort( $right ), $pivot );
}

function merge_array( $left, $right, $pivot ) {
    $sortedArray = [];

    foreach( $left as $lhn ) {
        $sortedArray[] = $lhn;
    }

    $sortedArray[] = $pivot;

    foreach( $right as $rhn ) {
        $sortedArray[] = $rhn;
    }

    return $sortedArray;
}

echo '<pre>';
print_r( quickSort([1,7,3,2] ) );

// 151. Reverse Words in a String
/**
 * Given an input string s, reverse the string word by word.
 * A word is defined as a sequence of non-space characters.
 * The input string does not contain leading or trailing spaces and the words are always separated by a single space.
 * The function returns the reversed string.
 * Time Complexity: O(n)
 * Space Complexity: O(n)
 * 
 * Strategy:
 * 1. Use preg_replace to replace multiple spaces with a single space.
 * 2. Initialize two empty strings: $revWords and $words.
 * 3. Loop through the string from the end to the beginning.
 * 4. If the character is not a space, prepend it to $words.
 * 5. If the character is a space, append $words to $revWords and reset $words.
 * 6. After the loop, append any remaining $words to $revWords.
 * 7. Return the trimmed $revWords.
 */
function reverseWords($s) {
    $s = preg_replace( '/\s+/', ' ', $s );
    
    $revWords = '';
    $words = '';
    
    for( $i = strlen( $s ) - 1; $i >= 0; $i-- ) {
        if( $s[$i] != ' ' ) {
            $words = $s[$i] . $words;
            
        }else{
            $revWords .= $words . ' ';
            $words = '';
        }
    }
    
    $revWords .= $words;
    
    return trim( $revWords );
}

$s = "  hello    world  ";
print_r( reverseWords( $s ) );

// 303. Range Sum Query - Immutable
class NumArray {
    private $prefixSum = [];

    /**
     * @param Integer[] $nums
     */
    function __construct(array $nums) {
        $this->prefixSum[0] = $nums[0];

        for( $i = 1; $i < count( $nums ); $i++ ) {
            $this->prefixSum[$i] = $this->prefixSum[$i-1] + $nums[$i];
        }
    }
  
    /**
     * @param Integer $left
     * @param Integer $right
     * @return Integer
     */
    function sumRange( $left, $right ) {
        if( $left == 0 ) {
            return $this->prefixSum[$right];
        }

        return $this->prefixSum[$right] - $this->prefixSum[$left-1];
    }
}

$prefixSum = new NumArray([2,3,5,5]);

echo 'Range sum queries';
echo '<pre>';
print_r( $prefixSum->sumRange(2,3) );
echo '</pre>';

// Recursive way fibonacchi
function RecursiveFibonacci( $n ) {
    if( $n == 0 ) return 0;
    if( $n == 1 ) return 1;

    return RecursiveFibonacci( $n -1 ) + RecursiveFibonacci( $n - 2 );
}

/**
 * Merge sorting best for large data set
 * and best time complexity
 */

function mergeSort($arr) {
    // Base case: If the array has one or no elements, it's already sorted.
    if (count($arr) <= 1) {
        return $arr;
    }

    // Split the array into two halves
    $middle = floor(count($arr) / 2);
    $left = array_slice($arr, 0, $middle);
    $right = array_slice($arr, $middle);

    // Recursively sort both halves
    $left = mergeSort($left);
    $right = mergeSort($right);

    // Merge the sorted halves
    return merge($left, $right);
}

function merge($left, $right) {
    $result = [];
    $i = $j = 0;

    // Compare elements from both halves and merge them in sorted order
    while ($i < count($left) && $j < count($right)) {
        if ($left[$i] <= $right[$j]) {
            $result[] = $left[$i];
            $i++;
        } else {
            $result[] = $right[$j];
            $j++;
        }
    }

    // Append any remaining elements from the left half
    while ($i < count($left)) {
        $result[] = $left[$i];
        $i++;
    }

    // Append any remaining elements from the right half
    while ($j < count($right)) {
        $result[] = $right[$j];
        $j++;
    }

    return $result;
}

// Example usage
$arr = [8, 3, 1, 7, 0, 10, 2];
$sortedArr = mergeSort($arr);

echo "Sorted Array: ";
print_r($sortedArr);

// 560. Subarray Sum Equals K
function subarraySum($nums, $k) {
    $prefixSumCount = [0 => 1]; // To handle cases where prefixSum == k
    $currentPrefixSum = 0;
    $count = 0;

    foreach ($nums as $num) {
        $currentPrefixSum += $num;

        // Check if (currentPrefixSum - k) exists in hashmap
        if ( isset( $prefixSumCount[$currentPrefixSum - $k] ) ) {
            $count += $prefixSumCount[$currentPrefixSum - $k];
        }

        // Update the prefixSum count
        // If currentPrefixSum is already in the map, increment its count
        // Otherwise, initialize it to 0 and then increment
        $prefixSumCount[$currentPrefixSum] = ($prefixSumCount[$currentPrefixSum] ?? 0) + 1;
    }

    return $count;
}

echo subarraySum( [1,2,3,4,5,6], 4 );

function permute($nums) {
    $result = [];
    backtracks($nums, [], $result);
    return $result;
}

function backtracks($nums, $path, &$result) {
    if (count($path) == count($nums)) {
        $result[] = $path;
        return;
    }

    for ($i = 0; $i < count($nums); $i++) {
        if (!in_array($nums[$i], $path)) {
            backtracks($nums, array_merge($path, [$nums[$i]]), $result);
        }
    }
}

$nums = [1, 2, 3];
print_r(permute($nums));

// 1094. Car Pooling
/**
 * Given an array of trips where trips[i] = [numPassengers, from, to], 
 * and an integer capacity, return true if it is possible to pick up and drop off all passengers for all the given trips.
 * 
 * Approach:
 * 1. Create a timeline to track passenger changes at each location.
 * 2. Traverse the timeline and check if the number of passengers exceeds capacity at any point.
 */
function carPooling($trips, $capacity) {
    $timeline = [];

    // Step 1: Record changes in passengers at each location
    foreach ($trips as $trip) {
        [$numPassengers, $from, $to] = $trip;
        $timeline[$from] = ($timeline[$from] ?? 0) + $numPassengers; // Pick up passengers
        $timeline[$to] = ($timeline[$to] ?? 0) - $numPassengers;   // Drop off passengers
    }

    // Step 2: Traverse the timeline
    ksort($timeline); // Sort locations in ascending order
    $currentPassengers = 0;

    foreach ($timeline as $location => $change) {
        $currentPassengers += $change;
        if ($currentPassengers > $capacity) {
            return false;
        }
    }

    return true;
}

// Example usage
$trips = [
    [2, 1, 5],
    [3, 3, 7]
];
$capacity = 5;

echo '<pre>';
print_r( carPooling( $trips, $capacity ) );
echo '</pre>';


function findNthNumber( $num, $target ) {
    $heap = new SplMinHeap();

    foreach( $num as $n ) {
        $heap->insert($n);

        if( $heap->count() > $target ) {
            $heap->extract();
        }
    }

    return $heap->top();
}

echo findNthNumber([1,2,3], 1 ); // Output: 3

// 1422. Maximum Score After Splitting a String
function maxScore( $s ) {
    $maxScore    = 0;
    $count       = strlen( $s );
    $total_ones  = substr_count( $s, '1' );
    $zeroInLeft  = 0;
    $onesInRight = $total_ones;

    for( $i = 0; $i < $count - 1; $i++ ) {
        if( $s[$i] == 0 ) {
            $zeroInLeft++;
        }else{
            $onesInRight--;
        }

        $total_score = $zeroInLeft + $onesInRight;
        $maxScore = max( $maxScore, $total_score );
    }

    return $maxScore;
}

echo maxScore( "00110110" );

// 238. Product of Array Except Self
/**
 * Given an integer array nums, return an array answer such that answer[i] is equal to the product of all the elements of nums except nums[i].
 * The problem can be solved in O(n) time complexity and O(1) space complexity (excluding the output array).
 * The approach involves calculating the product of all elements to the left and right of each index.
 *
 * Approach:
 * 1. Initialize an array result of the same length as nums, filled with 1.
 * 2. Calculate the left product for each index and store it in result.
 * 3. Calculate the right product for each index and multiply it with the corresponding value in result.
 * 4. Return the result array.
 */
function productExceptSelf($nums) {
    $n = count($nums);
    
    // Initialize the result array
    $result = array_fill(0, $n, 1);
    $left = $right = 1;

    // Step 1: Compute the left product for each element
    for ($i = 0; $i < $n; $i++ ) {
        $result[$i] = $left;
        $left *= $nums[$i];
    }
    
    // Step 2: Compute the right product and update the result array
    for ($i = $n - 1; $i >= 0; $i--) {
        $result[$i] *= $right;
        $right *= $nums[$i];
    }
    
    return $result;
}

// Example usage:
$nums = [1, 2, 3, 4];
$result = productExceptSelf($nums);

echo '<pre>';
print_r( $result );
echo '</pre>';

function findMiddleIndex($nums) {
    $totalSum = array_sum( $nums );
    $lefSum = 0;

    for( $i = 0; $i < count( $nums ); $i++ ) {
        // Formula : $totalSum = $lefSum + $i + $rightSum;
        $rightSum = $totalSum - $lefSum - $nums[$i];

        if( $rightSum == $lefSum ) {
            return $i;
        }

        $lefSum += $nums[$i];
    }

    return -1;
}

echo '<pre>';
print_r( findMiddleIndex([2, 3, -1, 8, 4] ) );
echo '</pre>';

// 523. Continuous Subarray Sum
/**
*Solution Approach
*The solution approach leverages the concept of prefix sums and modular arithmetic to identify a subarray sum that is a multiple of k. 
*Here is the step-by-step explanation of how the solution is implemented:

*Initialize a Variable to Store Cumulative Sum (s): We define a variable s that will hold the cumulative sum of the elements 
*as we iterate through the array.

*Create a Dictionary (mp) to Store Remainders and Their Earliest Index: 
*A Python dictionary mp is used to map each encountered remainder when dividing the cumulative sum by k to the lowest index 
*where this remainder occurs. The dictionary is initialized with {0: -1} which handles the edge case 
*wherein the cumulative sum itself is a multiple of k from the beginning of the array (i.e., the subarray starts at index 0).
*
*Iterate Through the Array: Using a for-loop, we iterate through the array while keeping track of the current index i and the element value v.

*Update Cumulative Sum: With each iteration, we update the cumulative sum s by adding the current element value v to it: s += v.

*Calculate Remainder: We calculate the remainder r of the current cumulative sum s when divided by k: r = s % k.

*Check for a Previously Encountered Remainder: If the remainder r has been seen before, and the index difference 
*i - mp[r] is greater than or equal to 2, we have found a "good subarray." This is because the equal remainders signify that the sum of elements 
*in between these two indices is a multiple of k. If such a condition is met, the function returns True.

*Store the Remainder and Index If Not Already Present: If the remainder r has not been previously encountered, 
*we store this remainder with its corresponding index i into the dictionary: mp[r] = i.

*Return False If No Good Subarray Is Found: If the for-loop completes without returning True, 
*it implies that no "good subarray" has been found. In this case, the function returns False.

*By using a hashmap to keep track of the remainders, the algorithm ensures a single-pass solution with O(n) time 
*complexity and O(min(n, k)) space complexity, since the number of possible remainders is bounded by k.
 */
function checkSubarraySum($nums, $k) {
    $prefixSum = 0;
    $remainderMap = [0 => -1 ];

    for( $i = 0; $i < count( $nums ); $i++ ) {
        $prefixSum += $nums[$i];

        if( $k != 0 ) {
            $remainder = $prefixSum % $k;
        }else{
            $remainder = $prefixSum;
        }

        if( isset( $remainderMap[$remainder] ) ) {
            if( $i - $remainderMap[$remainder] > 1 ) {
                return true;
            }
        }else{
            $remainderMap[$remainder] = $i;
        }
    }

    return false;
}

// 525. Contiguous Array
function findMaxLength($nums) {
    $hashmap    = [0 => -1];  // Initialize with sum 0 at index -1
    $maxLength  = 0;
    $runningSum = 0;

    foreach ($nums as $i => $num) {
        // Replace 0 with -1
        $runningSum += ($num == 0) ? -1 : 1;

        if (isset($hashmap[$runningSum])) {
            // Calculate the length of the subarray
            $maxLength = max($maxLength, $i - $hashmap[$runningSum]);
        } else {
            // Store the first occurrence of the running sum
            $hashmap[$runningSum] = $i;
        }
    }

    return $maxLength;
}

// Example usage
$nums = [0,1,0,1];
echo "Maximum length of contiguous array: " . findMaxLength($nums);

// 3. Longest Substring Without Repeating Characters
/**
 * Given a string s, find the length of the longest substring without repeating characters.
 * The function uses a sliding window approach with a hash map to keep track of the last seen index of each character.
 * It maintains two pointers: start and end, which represent the current substring.
 * The time complexity is O(n) and space complexity is O(min(n, m)), where n is the length of the string and m is the size of the character set.
 */
function lengthOfLongestSubstring($s) {
    $maxLen = 0;
    $start  = 0;
    $seen   = [];

    for( $end = 0; $end < strlen( $s ); $end++ ) {
        $char = $s[$end];

        if( isset( $seen[$char] ) && $seen[$char] >= $start ) {
            $start = $seen[$char] + 1;
        }

        $seen[$char] = $end; // Update the last seen index of the character

        $maxLen = max( $maxLen, $end - $start + 1 );
    }

    return $maxLen;
}

// 904. Fruit Into Baskets
function totalFruit( $fruits ) {
    $map = [];
    $maxLen = 0;
    $left = 0;

    for( $i = 0; $i < count( $fruits ); $i++ ) {
        $seen = $fruits[$i];

        if( ! isset( $map[$seen] ) ) {
            $map[$seen] = 0;
        }

        $map[$seen]++;

        while( count( $map ) > 2 ) {
            $map[$fruits[$left]]--;

            if( $map[$fruits[$left]] == 0 ) {
                unset( $map[$fruits[$left]]);
            }
            $left++;
        }

        $maxLen = max( $maxLen, $i - $left + 1 );

    }

    return $maxLen;
}

echo '<pre>';
print_r( totalFruit( [1,2,3,2,2] ) );

function numberSubstring( $array ) {
    $count = 0;

    for ($i = 0; $i < strlen($array); $i++) {
        $hash = array_fill(0, 3, 0 );

        for ($j = $i; $j < strlen($array); $j++) {
            $hash[ord($array[$j]) - ord('a')] = 1;

            if ($hash[0] + $hash[1] + $hash[2] == 3) {
                $count = $count + 1;
            }
        }
    }

    return $count;
}

echo '<pre>';
print_r( numberSubstring( 'abcabc' ) );

// 121. Best Time to Buy and Sell Stock
function maxProfit($prices) {
    $minPrice = PHP_INT_MAX;
    $maxProfit = 0;

    foreach ($prices as $price) {

        if ($price < $minPrice) { // Buy
            $minPrice = $price;
        } else { // Sell
            $maxProfit = max($maxProfit, $price - $minPrice);
        }
    }

    return $maxProfit;
}

// Brute Force
function maxProfitBruteForce($prices) {
    $maxProfit = 0;
    $n = count($prices);

    for ($i = 0; $i < $n; $i++) {
        for ($j = $i + 1; $j < $n; $j++) {
            if ($prices[$j] > $prices[$i]) { // Buy at i and sell at j
                $maxProfit = max($maxProfit, $prices[$j] - $prices[$i]);
            }
        }
    }

    return $maxProfit;
}

// Reverse String

// 3. Reverse String
// Given a character array s, reverse the array in-place.
// The reversal must be done in-place, meaning you must do this using only constant extra space.
// You must do it in-place without allocating extra space for another array.
function reverseStrin( &$s ) {
    $left = 0;
    $right = count( $s ) - 1;

    while( $left < $right ) { // Swap the characters
        // Swap the characters at left and right indices
        // Using a temporary variable to hold one of the characters
        // This is a common technique to swap two variables in PHP
        // without using a third variable
        $temp = $s[$left];
        $s[$left] = $s[$right];
        $s[$right] = $temp;

        $left++;
        $right--;
    }
}

// Example usage
$s = ['h', 'e', 'l', 'l', 'o'];
reverseStrin( $s );
echo '<pre>';
print_r( $s );
echo '</pre>';

// Is Anagram
/**
 * @param String $s
 * @param String $t
 * @return Boolean
 * This function checks if two strings are anagrams of each other.
 * An anagram is a word or phrase formed by rearranging the letters of a different word or phrase,
 * typically using all the original letters exactly once.
 * The function uses a hash map to count the occurrences of each character in both strings.
 * If the counts match for all characters, the strings are anagrams.
 * The time complexity of this function is O(n), where n is the length of the strings.
 * The space complexity is O(1) since the hash map will contain at most 26 characters (assuming only lowercase letters).
 */
function isAnagram($s, $t) {
    if (strlen($s) !== strlen($t)) {
        return false;
    }
    $count = [];
    
    for( $i = 0; $i < strlen( $s ); $i++ ) {
        if( ! isset( $count[$s[$i]] ) ) {
            $count[$s[$i]] = 0;
        }
        
        $count[$s[$i]]++;
    }
    
    for( $i = 0; $i < strlen( $t ); $i++ ) {

        if( ! isset( $count[$t[$i]] ) ) {
            return false;
        }
        
        $count[$t[$i]]--;
        
        if( $count[$t[$i]] < 0 ) {
            return false;
        }
    }
    
    return true;
}

// 438. Find All Anagrams in a String
function findAnagrams($s, $p) {
    $sLen = strlen($s);
    $pLen = strlen($p);
    
    if ($pLen > $sLen) return [];

    $pCount = $sCount = [];

    // Initialize count of p
    for ($i = 0; $i < $pLen; $i++) {
        $pCount[$p[$i]] = ($pCount[$p[$i]] ?? 0) + 1;
        $sCount[$s[$i]] = ($sCount[$s[$i]] ?? 0) + 1;
    }

    if ($pCount == $sCount) {
        $result[] = 0;
    }

    // Slide window
    for ($i = $pLen; $i < $sLen; $i++) {
        $startChar = $s[$i - $pLen]; // character to remove
        $newChar = $s[$i];           // character to add

        // Remove old char from window
        $sCount[$startChar]--;
        if ($sCount[$startChar] == 0) {
            unset($sCount[$startChar]); // clean up zero entries
        }

        // Add new char
        $sCount[$newChar] = ($sCount[$newChar] ?? 0) + 1;

        // Compare
        if ($sCount == $pCount) {
            $result[] = $i - $pLen + 1;
        }
    }

    return $result;
}

// 226 . Invert Binary Tree
class TreeNode {
    public $val = null;
    public $left = null; 
    public $right = null; 
    
    public function __construct($val = null, $left = null, $right = null) {
        $this->val = $val;
        $this->left = $left;
        $this->right = $right;
    }
}

class Solution {
    public function invertTree($root) {
        if ($root === null) {
            return null;
        }
        
        // Recursively invert left and right
        $left = $this->invertTree($root->left);
        $right = $this->invertTree($root->right);
        
        // Swap them
        $root->left = $right;
        $root->right = $left;
        
        return $root; // <-- ✅ You forgot to return the root!
    }
}

// Example usage
function printInorder($node) {
    if ($node === null) return;

    printInorder($node->left);
    echo $node->val . " ";
    printInorder($node->right);
}

// Create nodes
$node2 = new TreeNode(2);
$node3 = new TreeNode(3);
$root = new TreeNode(1, $node2, $node3);

echo "Before invert: ";
printInorder($root); // Output: 2 1 3

$solution = new Solution();
$solution->invertTree($root);

echo "\nAfter invert: ";
printInorder($root); // Output: 3 1 2

// 232. Implement Queue using Stacks
class MyQueue {
    private $stack1;
    private $stack2;

    public function __construct() {
        $this->stack1 = [];
        $this->stack2 = [];
    }

    public function push($x) {
        array_push($this->stack1, $x);
    }

    public function pop() {
        if (empty($this->stack2)) {
            while (!empty($this->stack1)) {
                array_push($this->stack2, array_pop($this->stack1));
            }
        }
        return array_pop($this->stack2);
    }

    public function peek() {
        if (empty($this->stack2)) {
            while (!empty($this->stack1)) {
                array_push($this->stack2, array_pop($this->stack1));
            }
        }
        return end($this->stack2);
    }

    public function empty() {
        return empty($this->stack1) && empty($this->stack2);
    }
}

// Example usage
$queue = new MyQueue();
$queue->push(1);
$queue->push(2);

// 169. Majority Element
// Given an array nums of size n, return the majority element.
// The majority element is the element that appears more than n / 2 times. You may assume that the majority element always exists in the array.
// Boyer-Moore Voting Algorithm
// Time Complexity: O(n)
// Space Complexity: O(1)

function majorityElement($nums) {
    $count = 0;
    $candidate = null;

    foreach ($nums as $num) {
        if ($count == 0) {
            $candidate = $num;
        }
        $count += ($num == $candidate) ? 1 : -1;
    }

    return $candidate;
}

/** 57. Insert Interval
 * Given a set of non-overlapping intervals, insert a new interval into the intervals (merge if necessary).
 * You may assume that the intervals were initially sorted according to their start times.
 * =============================
 * Time Complexity: O(n)
 * Space Complexity: O(n)
 * Example: intervals = [[1,3],[6,9]], newInterval = [2,5]
 * Output: [[1,5],[6,9]]
 * =============================
 * Approach:
 * ==================================================================================
 *  Let's say this is a meeting schedule and we want to add a new meeting.
 *  So we need to check if the new meeting overlaps with any of the existing meetings.
 * ===================================================================================
 * 1. Initialize an empty result array.
 * 2. Add all intervals that come before the new interval.
 * 3. Merge overlapping intervals.
 * 4. Add the merged interval.
 * 5. Add remaining intervals.
 * 6. Return the result array.
 */ 

function insert($intervals, $newInterval) {
    $result = [];
    $i = 0;
    $n = count($intervals);

    // Add all intervals that come before the new interval
    while ($i < $n && $intervals[$i][1] < $newInterval[0]) {
        $result[] = $intervals[$i];
        $i++;
    }

    // Merge overlapping intervals
    while ($i < $n && $intervals[$i][0] <= $newInterval[1]) {
        $newInterval[0] = min($newInterval[0], $intervals[$i][0]);
        $newInterval[1] = max($newInterval[1], $intervals[$i][1]);
        $i++;
    }
    
    // Add the merged interval
    $result[] = $newInterval;

    // Add remaining intervals
    while ($i < $n) {
        $result[] = $intervals[$i];
        $i++;
    }

    return $result;
}

// Example usage
$intervals = [[1, 3], [6, 9]];
$newInterval = [2, 5];
$result = insert($intervals, $newInterval);
echo '<pre>';
print_r($result);
echo '</pre>';

// 15. 3Sum
// Given an integer array nums, return all the triplets [nums[i], nums[j], nums[k]] such that i != j, i != k, and j != k,
// nums[i] + nums[j] + nums[k] == 0.
// Notice that the solution set must not contain duplicate triplets.
// Approach:
// 1. Sort the array.
// 2. Iterate through the array and use two pointers to find pairs that sum to the negative of the current element.
// 3. Skip duplicates to avoid repeated triplets.
// 4. Return the result.
// Time Complexity: O(n^2)
// Space Complexity: O(1)

function threeSum($nums) {
    sort($nums);
    $result = [];

    for ($i = 0; $i < count($nums) - 2; $i++) {
        if ($i > 0 && $nums[$i] == $nums[$i - 1]) continue; // Skip duplicates

        $left = $i + 1;
        $right = count($nums) - 1;

        while ($left < $right) {
            $sum = $nums[$i] + $nums[$left] + $nums[$right];

            if ($sum == 0) {
                $result[] = [$nums[$i], $nums[$left], $nums[$right]];
                while ($left < $right && $nums[$left] == $nums[$left + 1]) $left++; // Skip duplicates
                while ($left < $right && $nums[$right] == $nums[$right - 1]) $right--; // Skip duplicates
                $left++;
                $right--;
            } elseif ($sum < 0) {
                $left++;
            } else {
                $right--;
            }
        }
    }

    return $result;
}
// Example usage
$nums = [-1, 0, 1, 2, -1, -4];
$result = threeSum($nums);
echo '<pre>';
print_r($result);
echo '</pre>';

// 39. Combination Sum

/**
 * @param array $candidates
 * @param int $target
 * @return array
 * This function finds all unique combinations of candidates that sum to the target.
 * It uses backtracking to explore all possible combinations.
 * The function starts with an empty combination and iteratively adds candidates to it.
 * If the sum of the combination exceeds the target, it backtracks.
 * If the sum equals the target, it adds the combination to the result.
 * The function continues until all candidates have been considered.
 * The time complexity is O(2^n) in the worst case, where n is the number of candidates.
 * The space complexity is O(n) for the recursion stack.
 */
function combinationSum( $candidate, $target ) {
    $result = [];
    $combination = [];
    backtrack( $candidate, $target, $combination, 0, $result );
    return $result;
}

/**
 * Backtracking function to find combinations
 * @param array $candidates
 * @param int $target
 * @param array $combination
 * @param int $start
 * @param array $result
 */
function backtrack( $candidates, $target, &$combination, $start, &$result ) : void {
    if( $target === 0 ) {
        $result[] = $combination;
        return;
    }
    
    for( $i = $start; $i < count( $candidates ); $i++ ) {
        if( $candidates[$i] > $target ) {
            continue;
        }
        
        $combination[] = $candidates[$i];
        backtrack( $candidates, $target - $candidates[$i], $combination, $i, $result );
        array_pop( $combination );
    }
}

// Example usage
$candidates = [2, 3, 6, 7];
$target = 7;
$result = combinationSum($candidates, $target);
echo '<pre>';
print_r($result);
echo '</pre>';

//409. Longest Palindrome
/**
 * Given a string s which consists of lowercase or uppercase letters, return the length of the longest palindromic 
 * substring in s.
 * A palindrome is a string that reads the same backward as forward.
 * The function uses a hash map to count the occurrences of each character in the string.
 * It then calculates the length of the longest palindrome that can be formed using these characters.
 * The time complexity is O(n), where n is the length of the string.
 * The space complexity is O(1) since we are using a fixed-size hash map for character counts.
 */
function longestPalindrome($s) {
    $charCount = [];
    $length = 0;
    $hasOdd = false;

    // Count the occurrences of each character
    foreach( str_split( $s ) as $char ) {
        if( ! isset( $charCount[$char] ) ) {
            $charCount[$char] = 0;
        }
        $charCount[$char]++;
    }

    // Calculate the length
    foreach ($charCount as $count) {
        if ($count % 2 == 0) {
            $length += $count;
        } else {
            $length += $count - 1;
            $hasOdd = true;
        }
    }

    // If there was any odd count, we can put one odd character in the center
    if ($hasOdd) {
        $length += 1;
    }

    return $length;
}

// Example usage
$s = "abccccdd";
$result = longestPalindrome($s);
echo '<pre>';
print_r($result);
echo '</pre>';

// 56. Merge Intervals
function mergeIntervals( $intervals ) {
    if( empty( $intervals ) ) return [];
    $n = count( $intervals );

    usort( $intervals, function( $a, $b){
        return $a[0] <=> $b[0];
    });

    $merged = [];
    $merged[] = $intervals[0];

    for( $i = 0; $i < $n; $i++ ) {
        $current = $intervals[$i];
        $lastMerged = &$merged[count( $merged) - 1 ];

        if( $current[0] <= $lastMerged[1] ) {
            $lastMerged[1] = max( $lastMerged[1], $current[1] );
        }else{
            $merged[] = $current;
        }
    }

    return $merged;
}

// Example usage
$intervals = [[1,3],[2,6],[8,10],[15,18],[17,20]];
$result = mergeIntervals($intervals);
echo '<pre>';
print_r($result);
echo '</pre>';

// 8. String to Integer (atoi)
function myAtoi($s) {
    $n = strlen($s);
    $i = 0;
    $sign = 1;
    $result = 0;
    $INT_MAX = 2147483647;
    $INT_MIN = -2147483648;

    // Skip leading whitespaces
    while ($i < $n && $s[$i] === ' ') {
        $i++;
    }

    // Check for sign
    if ($i < $n && ($s[$i] == '+' || $s[$i] == '-')) {
        $sign = ($s[$i] == '-') ? -1 : 1;
        $i++;
    }

    // Convert digits to integer
    while ($i < $n && ctype_digit($s[$i])) {
        $digit = ord($s[$i]) - ord('0');
        if ($result > ($INT_MAX - $digit) / 10) {
            return ($sign == 1) ? $INT_MAX : $INT_MIN;
        }
        $result = $result * 10 + $digit;
        $i++;
    }

    return $result * $sign;
}
// Example usage
$s = "   -42";
$result = myAtoi($s);
echo '<pre>';
print_r($result);
echo '</pre>';

// 110. Balanced Binary Tree
// Use classical same Node template class
// class TreeNode {
//     public $val = null;
//     public $left = null; 
//     public $right = null; 
    
//     public function __construct($val = null, $left = null, $right = null) {
//         $this->val = $val;
//         $this->left = $left;
//         $this->right = $right;
//     }
// }
function checkBalance($node) {
    if ($node === null) return 0;

    $left = checkBalance($node->left);
    if ($left === -1) return -1;

    $right = checkBalance($node->right);
    if ($right === -1) return -1;

    if (abs($left - $right) > 1) return -1;

    return max($left, $right) + 1;
}

function isBalanced($root) {
    return checkBalance($root) !== -1;
}

// Create tree: [1,2,3,4]
$root = new TreeNode(1);
$root->left = new TreeNode(2);
$root->right = new TreeNode(3);
$root->left->left = new TreeNode(4);

// Test
echo isBalanced($root) ? "Balanced\n" : "Not Balanced\n";

// 75. Sort Colors
/**
 * Given an array nums with n objects colored red, white, or blue, sort them in-place so that objects of the same color are adjacent,
 * with the colors in the order red, white, and blue.
 * This function uses the Dutch National Flag algorithm to sort the colors in a single pass.
 * The time complexity is O(n) and the space complexity is O(1).
 * 
 * This is called the Dutch National Flag problem, which is a classic problem in computer science.
 * The algorithm uses three pointers: low, mid, and high.
 * - low points to the next position to place a red (0).
 * - mid points to the current element being examined.
 * - high points to the next position to place a blue (2).
 * The algorithm iterates through the array and swaps elements as needed:
 * - If the current element is 0 (red), swap it with the element at low and increment both low and mid.
 * - If the current element is 1 (white), just increment mid.
 * - If the current element is 2 (blue), swap it with the element at high and decrement high.
 * The process continues until mid exceeds high.
 * This algorithm is efficient and works in a single pass, making it suitable for sorting colors in an array.
 * The function modifies the input array in place and does not return anything.
 */
function sortColors(&$nums) {
    $low = 0;
    $mid = 0;
    $high = count( $nums ) - 1;
    
    while( $mid <= $high ) {
        if( $nums[$mid] == 0 ) {
            $temp = $nums[$low];
            $nums[$low] = $nums[$mid];
            $nums[$mid] = $temp;
            
            $low++;
            $mid++;
        }elseif( $nums[$mid] == 1 ) {
            $mid++;
        }else{
            $temp = $nums[$mid];
            $nums[$mid] = $nums[$high];
            $nums[$high] = $temp;
            
            $high--;
        }
    }

    // Another good and simple solution || This is good for limited number of colors
    // 
    // $k = 0;
    // $pushes = 0;
    // while($k < 3){
    //     for($i = 0; $i < count($nums); $i++){
    //         if($nums[$i] == $k){
    //             $nums[$i] = $nums[$pushes];
    //             $nums[$pushes] = $k;
    //             $pushes++;
    //         }
    //     }
    //     $k++;
    // }

    // return $nums;
}

$nums = [1,2,0,1,2,2,0];
sortColors( $nums );
print_r( $nums );

class Solu {
    private $mapping = [
        '2' => 'abc',
        '3' => 'def',
        '4' => 'ghi',
        '5' => 'jkl',
        '6' => 'mno',
        '7' => 'pqrs',
        '8' => 'tuv',
        '9' => 'wxyz'
    ];

    public function letterCombinations($digits) {
        $result = [];

        if (empty($digits)) return $result;

        $this->backtrack(0, '', $digits, $result);
        return $result;
    }

    private function backtrack($index, $currentCombination, $digits, &$result) {
        // Base case: if the current index is equal to the length of digits
        // This is the main logic of the backtracking and recursion
        // If the index is equal to the length of digits,
        // it means we have reached the end of the digits string
        // it means we have a complete combination
        // Add it to the result
        if ($index === strlen($digits)) {
            $result[] = $currentCombination; // Add the current combination to the result
            return;
        }

        // Recursive case: iterate through the letters corresponding to the current digit
        $letters = $this->mapping[$digits[$index]];
        for ($i = 0; $i < strlen($letters); $i++) {
            // For each letter, append it to the current combination
            // and call backtrack recursively for the next digit
            // This is the main logic of the backtracking and recursion
            $this->backtrack($index + 1, $currentCombination . $letters[$i], $digits, $result);
        }
    }
}

// Example usage:
$sol = new Solu();
print_r($sol->letterCombinations("23"));

// 46. Permutations
/**
 * Given an array nums of distinct integers, return all the possible permutations.
 * You can return the answer in any order.
 * The function uses backtracking to generate all permutations of the input array.
 * The time complexity is O(n!), where n is the length of the input array.
 * The space complexity is O(n) for the recursion stack.
 */
function permute(array $nums): array {
    $result = [];

    $backtrack = function(array $path, array $remaining) use (&$result, &$backtrack) {
        if (empty($remaining)) {
            $result[] = $path;
            return;
        }

        for ($i = 0; $i < count($remaining); $i++) {
            $newPath = $path;
            $newPath[] = $remaining[$i];

            $newRemaining = $remaining;
            array_splice($newRemaining, $i, 1);

            $backtrack($newPath, $newRemaining);
        }
    };

    $backtrack([], $nums);
    return $result;
}

// Example usage
$input = [1, 2, 3];
$output = permute($input);
print_r($output);
