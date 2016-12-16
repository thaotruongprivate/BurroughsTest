<?php
/**
 * Created by PhpStorm.
 * User: thaotruong
 * Date: 16.12.16
 * Time: 17:58
 */

$classesDir = 'classes/';

function __autoload($className) {
	global $classesDir;
	
	if (file_exists($classesDir . $className . '.php')) {
		require_once ($classesDir . $className . '.php');
		return;
	}
}
