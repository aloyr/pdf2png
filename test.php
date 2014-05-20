<?php
include_once('classes/pdf2png.php');

try {
	$dir = 'pdfs/';
	$objDir = opendir($dir);
	while (($file = readdir($objDir)) !== False) {
		$pdfFile = $dir . $file;
		// echo "filename: $pdfFile : filetype: " . filetype($pdfFile) . "\n";
	 	if (is_file($pdfFile) && (strtolower(substr($pdfFile,-3)) == 'pdf')) {
		  $image = 'output/' . substr($file,0,-3) . 'png';
		  print $image . "\n";
		  $objP2P = new Pdf2png($pdfFile, $image);
		  print_r($objP2P);
		}
	}
} catch (Exception $e) {
	echo $e->getMessage() . "\n";
}

