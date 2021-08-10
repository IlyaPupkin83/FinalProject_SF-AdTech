<?php

namespace Post\Advertiser\Offers;

use Core\Database;
use Core\Utils;
use Intervention\Image\ImageManager as Image;

class OffersNewModel
{
	private function loadImage($offerId)
	{
		$filename = $_SESSION['userID'] . '/' . $offerId . '.png';
		$image = new Image();
		$file = $image->make(($_FILES['image']['tmp_name']));
		$file->resize(null, 100, function ($constraint) {
			$constraint->aspectRatio();
		});
		if ($file->width() > 200) {
			$file->resize(200, null, function ($constraint) {
				$constraint->aspectRatio();
			});
		}

		if (!file_exists(IMAGES . $_SESSION['userID'])) mkdir(IMAGES . $_SESSION['userID']);

		$file->save(IMAGES . $filename, 80, 'png');

		return $filename;
	}

	public function run()
	{
		$title = $_POST['title'];
		$link = $_POST['link'];
		$cost = $_POST['cost'];
		$tematics = $_POST['tematics'];

		if (!$title) {
			Utils::message('Введите наименование');
			return;
		}

		if (!$link || !get_headers($link, 1)) {
			Utils::message('Ссылка недействительная');
			return;
		}

		if (!$cost || !is_numeric($cost) || (float)$cost <= 0) {
			Utils::message('Неверная стоимость');
			return;
		}

		if (empty($tematics)) {
			Utils::message('Выберите тематику');
			return;
		}

		if ($_FILES['image']['tmp_name']) {
			if ($_FILES['image']['size'] > UPLOAD_IMAGE_SIZE) {
				Utils::message('Размер файла больше 3 Мб');
				return;
			}

			if (!in_array($_FILES['image']['type'], UPLOAD_IMAGE_TYPES)) {
				Utils::message('Разрешенные типы файлов: ' . implode(', ', UPLOAD_IMAGE_TYPES));
				return;
			}
		}

		$db = new Database;

		$sqlOffer = <<<CREATE_OFFER
        INSERT INTO Offers(author_id, title, cost, link)
        VALUES (:userid, :title, :cost, :link)
CREATE_OFFER;

		$values = [
			':userid' => $_SESSION['userID'],
			':title' => $title,
			':cost' => $cost,
			':link' => $link
		];

		$result = $db->update($sqlOffer, $values);

		if ($result) {
			$id = $db->lastInsertId();

			$sqlTematic = <<<OFFER_TEMATIC
            INSERT INTO Offers_Tematic(offer_id, tematic_id)
            VALUES 
OFFER_TEMATIC;
			foreach ($tematics as $tematic) {
				$values = "('$id', '$tematic'),";
				$sqlTematic .= $values;
			}

			$sqlTematic = substr($sqlTematic, 0, -1);
			$db->update($sqlTematic);

			$filename = isset($_FILES['image']) ? $this->loadImage($id) : false;

			if ($filename) {
				$sqlImage = <<<OFFER_IMAGE
                UPDATE Offers
                SET Image = '$filename'
                WHERE id = '$id'
OFFER_IMAGE;
				$db->update($sqlImage);
			}
		}

		Utils::message("Оффер $title создан");
	}
}
