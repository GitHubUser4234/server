<?php
/**
* ownCloud
*
* @author Robin Appelman
* @copyright 2011 Robin Appelman icewind1991@gmail.com
*
* This library is free software; you can redistribute it and/or
* modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
* License as published by the Free Software Foundation; either
* version 3 of the License, or any later version.
*
* This library is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU AFFERO GENERAL PUBLIC LICENSE for more details.
*
* You should have received a copy of the GNU Affero General Public
* License along with this library.  If not, see <http://www.gnu.org/licenses/>.
*
*/

/**
 * Array mapping file extensions to mimetypes (in alphabetical order).
 *
 * The first index in the mime type array is the assumed correct mimetype
 * and the second is either a secure alternative or null if the correct
 * is considered secure.
 */
return array(
	'7z' => array('application/x-7z-compressed', null),
	'accdb' => array('application/msaccess', null),
	'ai' => array('application/illustrator', null),
	'avi' => array('video/x-msvideo', null),
	'bash' => array('text/x-shellscript', null),
	'blend' => array('application/x-blender', null),
	'bin' => array('application/x-bin', null),
	'bmp' => array('image/bmp', null),
	'cb7' => array('application/x-cbr', null),
	'cba' => array('application/x-cbr', null),
	'cbr' => array('application/x-cbr', null),
	'cbt' => array('application/x-cbr', null),
	'cbtc' => array('application/x-cbr', null),
	'cbz' => array('application/x-cbr', null),
	'cc' => array('text/x-c', null),
	'cdr' => array('application/coreldraw', null),
	'cpp' => array('text/x-c++src', null),
	'css' => array('text/css', null),
	'csv' => array('text/csv', null),
	'cvbdl' => array('application/x-cbr', null),
	'c' => array('text/x-c', null),
	'c++' => array('text/x-c++src', null),
	'deb' => array('application/x-deb', null),
	'doc' => array('application/msword', null),
	'docx' => array('application/vnd.openxmlformats-officedocument.wordprocessingml.document', null),
	'dot' => array('application/msword', null),
	'dotx' => array('application/vnd.openxmlformats-officedocument.wordprocessingml.template', null),
	'dv' => array('video/dv', null),
	'eot' => array('application/vnd.ms-fontobject', null),
	'epub' => array('application/epub+zip', null),
	'exe' => array('application/x-ms-dos-executable', null),
	'flac' => array('audio/flac', null),
	'flv' => array('video/x-flv', null),
	'gif' => array('image/gif', null),
	'gz' => array('application/x-gzip', null),
	'gzip' => array('application/x-gzip', null),
	'html' => array('text/html', 'text/plain'),
	'htm' => array('text/html', 'text/plain'),
	'ical' => array('text/calendar', null),
	'ics' => array('text/calendar', null),
	'impress' => array('text/impress', null),
	'jpeg' => array('image/jpeg', null),
	'jpg' => array('image/jpeg', null),
	'js' => array('application/javascript', 'text/plain'),
	'json' => array('application/json', 'text/plain'),
	'keynote' => array('application/x-iwork-keynote-sffkey', null),
	'kra' => array('application/x-krita', null),
	'm2t' => array('video/mp2t', null),
	'm4v' => array('video/mp4', null),
	'markdown' => array('text/markdown', null),
	'mdown' => array('text/markdown', null),
	'md' => array('text/markdown', null),
	'mdb' => array('application/msaccess', null),
	'mdwn' => array('text/markdown', null),
	'mkv' => array('video/x-matroska', null),
	'mobi' => array('application/x-mobipocket-ebook', null),
	'mov' => array('video/quicktime', null),
	'mp3' => array('audio/mpeg', null),
	'mp4' => array('video/mp4', null),
	'mpeg' => array('video/mpeg', null),
	'mpg' => array('video/mpeg', null),
	'msi' => array('application/x-msi', null),
	'numbers' => array('application/x-iwork-numbers-sffnumbers', null),
	'odg' => array('application/vnd.oasis.opendocument.graphics', null),
	'odp' => array('application/vnd.oasis.opendocument.presentation', null),
	'ods' => array('application/vnd.oasis.opendocument.spreadsheet', null),
	'odt' => array('application/vnd.oasis.opendocument.text', null),
	'oga' => array('audio/ogg', null),
	'ogg' => array('audio/ogg', null),
	'ogv' => array('video/ogg', null),
	'otf' => array('font/opentype', null),
	'pages' => array('application/x-iwork-pages-sffpages', null),
	'pdf' => array('application/pdf', null),
	'php' => array('application/x-php', null),
	'pl' => array('application/x-perl', null),
	'png' => array('image/png', null),
	'ppt' => array('application/mspowerpoint', null),
	'pptx' => array('application/vnd.openxmlformats-officedocument.presentationml.presentation', null),
	'psd' => array('application/x-photoshop', null),
	'py' => array('text/x-python', null),
	'rar' => array('application/x-rar-compressed', null),
	'reveal' => array('text/reveal', null),
	'sgf' => array('application/sgf', null),
	'sh-lib' => array('text/x-shellscript', null),
	'sh' => array('text/x-shellscript', null),
	'svg' => array('image/svg+xml', 'text/plain'),
	'swf' => array('application/x-shockwave-flash', 'application/octet-stream'),
	'tar' => array('application/x-tar', null),
	'tar.gz' => array('application/x-compressed', null),
	'tex' => array('application/x-tex', null),
	'tgz' => array('application/x-compressed', null),
	'tiff' => array('image/tiff', null),
	'tif' => array('image/tiff', null),
	'ttf' => array('application/x-font-ttf', null),
	'txt' => array('text/plain', null),
	'vcard' => array('text/vcard', null),
	'vcf' => array('text/vcard', null),
	'wav' => array('audio/wav', null),
	'webm' => array('video/webm', null),
	'woff' => array('application/font-woff', null),
	'wmv' => array('video/x-ms-asf', null),
	'xcf' => array('application/x-gimp', null),
	'xls' => array('application/msexcel', null),
	'xlsx' => array('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', null),
	'xml' => array('application/xml', 'text/plain'),
	'zip' => array('application/zip', null),
);
