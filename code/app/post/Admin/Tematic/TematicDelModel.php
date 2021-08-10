<?php

namespace Post\Admin\Tematic;

use Core\Database;
use Core\Utils;

class TematicDelModel
{
	public function run()
	{
		$tematicsId = $_POST['tematics'];

		if (!$tematicsId) {
			Utils::message('Вы ничего не выбрали');
			return;
		}

		$tematicsId = "'" . implode("', '",  $tematicsId) . "'";

		$db = new Database;

		$sql = <<<DELETE_TEMATICS
        DELETE IGNORE
        FROM Tematic
        WHERE 
            id IN ($tematicsId)
DELETE_TEMATICS;

		$db->update($sql);

		return true;
	}
}
