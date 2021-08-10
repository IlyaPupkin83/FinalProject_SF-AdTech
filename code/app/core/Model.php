<?php

namespace Core;

interface ModelRun
{
	public function run();
}

abstract class Model implements ModelRun
{
	public function run()
	{
		$props = [];
		$props['viewFile'] = TEMPLATES . 'page404.php';
		return $props;
	}
}
