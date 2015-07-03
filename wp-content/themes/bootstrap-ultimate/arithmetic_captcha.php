<?php
session_start();

$nr1 = mt_rand(1,10); //mt_rand($min, $max)
$nr2 = mt_rand(1,10);
if( $nr1 > $nr2 ) {
	$math = "$nr1 - $nr2";
	$_SESSION['answer'] = $nr1 - $nr2;
} else {
	$math = "$nr1 + $nr2";
	$_SESSION['answer'] = $nr1 + $nr2;
}
