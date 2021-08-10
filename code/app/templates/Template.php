<!DOCTYPE html>

<html lang="ru">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Площадка для сотрудничества компаний-рекламодателей и веб-мастеров, контроль трафика переходов по рекламным ссылкам" />
	<title>SF-AdTech</title>
	<link rel="icon" href="/assets/favicon.png" sizes="32x32" type="image/png">
	<link rel="stylesheet" href="/css/style.css" />
</head>

<body>
	<div class="container">
		<header class="header">
			<div class="header__logo">
				<h1><a href="/">SF-Adtech</a></h1>
			</div>
			<div class="header__message"><?php
													if ($_SESSION['message'] !== '') print_r($_SESSION['message']);
													$_SESSION['message'] = '';
													?></div>
			<div class="header__user">
				<div class="user__name"><span>Здравствуйте, </span><strong><?= $_SESSION['user'] ?></strong></div>
				<div class="user__role"><span>Ваша роль: </span><strong><?= $_SESSION['role'] ?></strong></div>
			</div>
		</header>
		<main class="content">
			<nav class="content__menu">
				<div class="menu__body"><?php @include($menu); ?></div>
				<div class="menu__cap">
					<div>М</div>
					<div>Е</div>
					<div>Н</div>
					<div>Ю</div>
				</div>
			</nav>
			<div class="content__page"><?php include($view); ?></div>
		</main>
		<footer class="footer">
			<p class="footer__copyright">(с) AdTech</p>
		</footer>
	</div>
	<script>
		<?php echo file_get_contents(TEMPLATES . 'scripts/' . $props['script']) ?>
	</script>
</body>

</html>