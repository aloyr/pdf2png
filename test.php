<?php
include_once('classes/pdf2png.php');

$file = 'pdfs/test.pdf';
$image = 'output/test.png';

$objP2P = new Pdf2png($file, $image);

print_r($objP2P);
