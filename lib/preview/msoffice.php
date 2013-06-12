<?php
/**
 * Copyright (c) 2013 Georg Ehrke georg@ownCloud.com
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */
namespace OC\Preview;

class DOC extends Provider {

	public function getMimeType() {
		return '/application\/msword/';
	}

	public function getThumbnail($path, $maxX, $maxY, $scalingup, $fileview) {
		
	}

}

\OC\Preview::registerProvider('OC\Preview\DOC');

class DOCX extends Provider {

	public function getMimeType() {
		return '/application\/vnd.openxmlformats-officedocument.wordprocessingml.document/';
	}

	public function getThumbnail($path, $maxX, $maxY, $scalingup, $fileview) {
		require_once('phpdocx/classes/TransformDoc.inc');

		$tmpdoc = $fileview->toTmpFile($path);

		$transformdoc = new \TransformDoc();
		$transformdoc->setStrFile($tmpdoc);
		$transformdoc->generatePDF($tmpdoc);

		$pdf = new \imagick($tmpdoc . '[0]');
		$pdf->setImageFormat('jpg');

		unlink($tmpdoc);

		$image = new \OC_Image($pdf);

		return $image->valid() ? $image : false;
	}

}

\OC\Preview::registerProvider('OC\Preview\DOCX');

class MSOfficeExcel extends Provider {

	public function getMimeType() {
		return null;
	}

	public function getThumbnail($path, $maxX, $maxY, $scalingup, $fileview) {
		require_once('PHPExcel/Classes/PHPExcel.php');
		require_once('PHPExcel/Classes/PHPExcel/IOFactory.php');
		//require_once('mpdf/mpdf.php');

		$abspath = $fileview->toTmpFile($path);
		$tmppath = \OC_Helper::tmpFile();

		$rendererName = \PHPExcel_Settings::PDF_RENDERER_DOMPDF;
		$rendererLibraryPath = \OC::$THIRDPARTYROOT . '/3rdparty/dompdf';

		\PHPExcel_Settings::setPdfRenderer($rendererName, $rendererLibraryPath);

		$phpexcel = new \PHPExcel($abspath);
		$excel = \PHPExcel_IOFactory::createWriter($phpexcel, 'PDF');
		$excel->save($tmppath);

		$pdf = new \imagick($tmppath . '[0]');
		$pdf->setImageFormat('jpg');

		unlink($abspath);
		unlink($tmppath);

		$image = new \OC_Image($pdf);

		return $image->valid() ? $image : false;
	}

}

class XLS extends MSOfficeExcel {

	public function getMimeType() {
		return '/application\/vnd.ms-excel/';
	}

}

\OC\Preview::registerProvider('OC\Preview\XLS');

class XLSX extends MSOfficeExcel {

	public function getMimeType() {
		return '/application\/vnd.openxmlformats-officedocument.spreadsheetml.sheet/';
	}

}

\OC\Preview::registerProvider('OC\Preview\XLSX');

class MSOfficePowerPoint extends Provider {

	public function getMimeType() {
		return null;
	}

	public function getThumbnail($path, $maxX, $maxY, $scalingup, $fileview) {
		//require_once('');
		//require_once('');

		$abspath = $fileview->toTmpFile($path);
		$tmppath = \OC_Helper::tmpFile();

		$excel = PHPPowerPoint_IOFactory::createWriter($abspath, 'PDF');
		$excel->save($tmppath);

		$pdf = new \imagick($tmppath . '[0]');
		$pdf->setImageFormat('jpg');

		unlink($abspath);
		unlink($tmppath);

		return $image->valid() ? $image : false;
	}

}

class PPT extends MSOfficePowerPoint {

	public function getMimeType() {
		return '/application\/vnd.ms-powerpoint/';
	}

}

\OC\Preview::registerProvider('OC\Preview\PPT');

class PPTX extends MSOfficePowerPoint {

	public function getMimeType() {
		return '/application\/vnd.openxmlformats-officedocument.presentationml.presentation/';
	}

}

\OC\Preview::registerProvider('OC\Preview\PPTX');