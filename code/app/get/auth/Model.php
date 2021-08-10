<?php

namespace Get\Auth;

use Core\Model as CoreModel;
use Core\Defender;

class Model extends CoreModel
{
	public function run()
	{
		$props = [];
		$props['token'] = Defender::getToken();
		$props['viewFile'] = 'AuthView.php';
		$props['viewMenu'] = 'GuestMenu.php';
		$props['script'] = 'guest.js';

		return $props;
	}
}
