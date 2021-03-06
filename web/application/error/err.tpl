<?php

if (!function_exists('general_err_exit')) {
	function general_err_exit($code, $msg)
	{
		header('content-type:application/json');
		echo json_encode([
			'code'	=> '500',
			'msg'	=> "{$msg}"
		]);
		exit();
	}
}

if(!\think\App::$debug)
	general_err_exit($code, $message);
else
	require_once THINK_PATH . 'tpl' . DS . 'think_exception.tpl';