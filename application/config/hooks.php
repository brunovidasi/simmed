<?php defined('BASEPATH') OR exit('No direct script access allowed');

$hook['post_controller_constructor'][] = array(
	'class' => '',
	'function' => 'acesso',
	'filename' => 'acesso.php',
	'filepath' => 'hooks',
	'params' => array()
);