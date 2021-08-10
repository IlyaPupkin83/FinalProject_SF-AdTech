<?php

namespace Core;

interface PostConsts
{
	const NAMESPACE = __NAMESPACE__;
	const DIR = __DIR__;
	const PREFIX = '';
}

abstract class PostController implements PostConsts
{
	public function run($action)
	{
		$modelName = static::PREFIX . ucfirst($action) . 'Model';
		$modelFile = static::DIR . '/' . $modelName . '.php';
		if (file_exists($modelFile)) {
			include_once($modelFile);
			$modelClass = static::NAMESPACE . '\\' . $modelName;
			$model = new $modelClass;
			$model->run();
		}
	}
}
