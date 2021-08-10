<?php

namespace Get\Admin;

use Core\Defender;

class SystemModel
{
	public function run()
	{
		$props = [];
		$props['token'] = Defender::getToken();
		$props['viewFile'] = 'SystemView.php';
		$props['viewMenu'] = 'AdminMenu.php';
		$props['script'] = 'admin.js';

		return $props;
	}
}
