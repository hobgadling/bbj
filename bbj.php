<?php

$wordsize = 16;
$memory = [];
$memsize = pow(2,$wordsize)/$wordsize;
for($i = 0; $i < $memsize; $i++){
    $memory[$i] = sprintf("%016d",decbin(random_int(0,65535)));
}

bitBitJump(0);

function bitBitJump($ip) {
    global $memory, $wordsize;
    $loc = $memory[$ip];
    $val = getBitAt(bindec($loc));
    setBitAt(bindec($memory[$ip+1]),$val);
    $ip = intdiv(bindec($memory[$ip+2]),$wordsize);
    return $ip;
}

function getBitAt($loc){
    echo $loc . "\n";
    global $wordsize, $memory;
    $word_loc = intdiv($loc,$wordsize);
    $bit_loc = $loc%$wordsize;
    $word = $memory[$word_loc];
    $bit = substr($word,$bit_loc,1);
    return $bit;
}

function setBitAt($loc,$val){
    global $wordsize, $memory;
    $word_loc = intdiv($loc,$wordsize);
    $bit_loc = $loc%$wordsize;
    $word = $memory[$word_loc];
    $new_word = substr($word,0,$bit_loc) . $val . substr($word,$bit_loc + 1);
    $memory[$word_loc] = $new_word;
}

function print_memory(){
    global $memory;
    $sq = sqrt(count($memory));
    for($i = 0; $i < count($memory); $i++){
        echo $memory[$i] . ' ';
        if(($i+1)%$sq == 0){
            echo "\n";
        }
    }
}
