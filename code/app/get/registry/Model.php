<?php

namespace Get\Registry;

use Core\Model as CoreModel;
use Core\Defender;

class Model extends CoreModel
{
	public function run()
	{
		$props = [];
		$props['token'] = Defender::getToken();
		$props['viewFile'] = 'RegistryView.php';
		$props['viewMenu'] = 'GuestMenu.php';
		$props['script'] = 'guest.js';

		return $props;
	}
}
