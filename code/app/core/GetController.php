<?php

namespace Core;

interface GetConsts
{
	const NAMESPACE = __NAMESPACE__;
	const DIR = __DIR__;
}

abstract class GetController implements GetConsts
{
	public function run($action = '')
	{
		$modelName = ucfirst($action) . 'Model';
		$modelFile = static::DIR . '/' . $modelName . '.php';

		if (file_exists($modelFile)) {
			require_once($modelFile);
			$modelClass = static::NAMESPACE . '\\' . $modelName;
			$model = new $modelClass;
			$props = $model->run();
		}

		if ($_SESSION['userStatus'] == 1 && $_SESSION['role'] != 'Guest') {
			$view = TEMPLATES . 'NoAuthView.php';
			$menu = TEMPLATES . 'menu/NoAuthMenu.php';
		} elseif ($_SESSION['userStatus'] == 0 && $_SESSION['role'] != 'Guest') {
			$view = TEMPLATES . 'YouBannedView.php';
			$menu = TEMPLATES . 'menu/NoAuthMenu.php';
		} else {
			$view = (array_key_exists('viewFile', $props)) ? $props['viewFile'] : ucfirst($action) . 'View.php';
			$view = static::DIR . '/' . $view;
			$menu = (array_key_exists('viewMenu', $props)) ? TEMPLATES . 'menu/' . $props['viewMenu'] : '';
		}

		if (Utils::isAjax()) {
			ob_start();
			require_once($view);
			$body = ob_get_contents();
			ob_end_clean();

			Utils::responseAjax($body);
		} else {
			require_once(TEMPLATES . 'Template.php');
		}
	}
}
