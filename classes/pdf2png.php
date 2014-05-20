<?php
namespace HID;
use Imagick, Exception;


class Pdf2pngException extends Exception {}

class Pdf2png {
  function __construct($pdfFile = Null, $pngFile = Null) {
    try {
      if (!class_exists('Imagick')) {
        throw new Pdf2pngException("Missing Imagick library.");
      }
      if (strtolower(substr($pdfFile,-3)) != 'pdf') {
        throw new Pdf2pngException("Source document $pdfFile is not a pdf.");
      }
      if ($pdfFile === Null) {
        throw new Pdf2pngException('Missing source pdf document.');
      }
      if ($pngFile === Null) {
        throw new Pdf2pngException('Missing destination png image.');
      }
      if (!file_exists($pdfFile)) {
        throw new Pdf2pngException("Source document $pdfFile does not exist.\n");
      }
      $format = 'png';
      $extension = '.' . $format;
      if ((strlen($pngFile) < 5) || (strtolower(substr($pngFile,-4)) != $extension)) {
        $pngFile .= $extension;
      }
      $pdf = $pdfFile . '[0]';
      $image = new Imagick($pdf);
      $image->setResolution(200,200);
      $image->setImageFormat($format);
      $image->scaleImage(200,0);
      $image->setImageColorspace(Imagick::COLORSPACE_RGB);
      $image->setImageCompression(Imagick::COMPRESSION_BZIP);
      $image->setImageCompressionQuality(100);
      $image->stripImage();
      $image->writeImage($pngFile);
    } catch (Exception $e) {
      if (function_exists(drupal_set_message)) {
        drupal_set_message($e->getMessage(), 'error');
      } else {
        echo $e->getMessage();
      }
      return false;
    } //try..catch
  } //func __construct
} //class
