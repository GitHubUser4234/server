<?php
OC_App::register(array(
  'order' => 20,
  'id' => 'gallery',
  'name' => 'Gallery'));

OC_App::addNavigationEntry( array(
 'id' => 'gallery_index',
 'order' => 20,
 'href' => OC_Helper::linkTo('gallery', 'index.php'),
 'icon' => OC_Helper::linkTo('', 'core/img/filetypes/image.png'),
 'name' => 'Gallery'));
?>
