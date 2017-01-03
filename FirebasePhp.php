<?php

namespace DCTBFirebasePHP;

use DCTBFirebasePHP\Firebase as DCTBFB;

require 'vendor/autoload.php';

class Firebase{
	private static $configs = array(
		'DEFAULT_URL'   => '',
		'DEFAULT_TOKEN' => '');

	public static $firebase;
	private static $instance = null;

	public static function getInstance(){
		if (!isset(self::$instance) && is_null(self::$instance)) {
			$c = __CLASS__;
			self::$instance = new $c;
		}
		return self::$instance;
	}

	private function __construct(){}

	public function start(){
		$this->firebase = new \Firebase\FirebaseLib(DCTBFB::$configs['DEFAULT_URL'], DCTBFB::$configs['DEFAULT_TOKEN']);
	}

	public function get($path){
		return $this->firebase->get($path);
	}

	public function set($path, $value){
		$this->firebase->set($path, $value);
	}
}

$fphp = DCTBFB::getInstance();
$fphp->start();
$data = json_decode($fphp->get('mural'));
echo "<pre>";
print_r($data);

$save = array('msg' => 'php', 'name' => 'php');
$next = count($data);
$fphp->set('mural/'.$next, $save);