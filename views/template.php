<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Sistema - <?= $viewData["companyName"]; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/template.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/font-awesome.min.css" />
		<script type="text/javascript" src="<?= BASE_URL; ?>/assets/js/jquery.min.js"></script>
		<script type="text/javascript">var BASE_URL = '<?=BASE_URL;?>';</script>
	</head>
	<body>
		<div class="leftMenu">
			<div class="companyName">
				<?= $viewData["companyName"]; ?>
			</div>
			<div class="menuArea">
				<ul>
					<li><a href="<?= BASE_URL; ?>"><i class="fa fa-home"></i> Home</a></li>
					<li><a href="<?= BASE_URL; ?>/permissions"><i class="fa fa-key"></i> Permissões</a></li>
					<li><a href="<?= BASE_URL; ?>/users"><i class="fa fa-user"></i> Usuarios</a></li>
					<li><a href="<?= BASE_URL; ?>/clients"><i class="fa fa-users"></i> Clientes</a></li>
					<li><a href="<?= BASE_URL; ?>/inventory"><i class="fa fa-cubes"></i> Estoque</a></li>
					<li><a href="<?= BASE_URL; ?>/sales"><i class="fa fa-shopping-cart"></i> Vendas</a></li>
				</ul>
			</div>
		</div>
		<div class="container">
			<div class="topMenu">
				<div class="topRight"><a href="<?php echo BASE_URL.'/login/logout';?>">Sair</a></div>	
				<div class="topRight"><?php echo $viewData["userEmail"]; ?></div>
			</div>
			<div class="areaTemplate">
				<?php $this->loadViewInTemplate($viewName, $viewData); ?>
			</div>
		</div>

		
		<script type="text/javascript" src="<?= BASE_URL; ?>/assets/js/script.js"></script>
	</body>
</html>