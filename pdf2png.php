<?php
try {
  $format = 'png';
  $pdf = 'test.pdf[0]';
  $image = new Imagick($pdf);
  $image->setResolution(200,200);
  $image->setImageFormat($format);
  $image->scaleImage(200,0);
  $image->setImageColorspace(Imagick::COLORSPACE_RGB);
  $image->setImageCompression(Imagick::COMPRESSION_BZIP);
  $image->setImageCompressionQuality(100);
  $image->stripImage();
  $image->writeImage('test.' . $format);
} catch (Exception $e) {
  print "inside catch";
  echo $e->getMessage();
}
