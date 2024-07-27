<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Sistema Financeiro</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/login.css" type="text/css" />
	</head>
	<body>
        <div class="loginArea">
            <form method="POST">
                <div class="logoCompany"><img src="<?php echo BASE_URL; ?>/assets/images/logo.png" alt="logo"></div>
                <label for="email">Email: *</label>
                <input type="email" name="email" id="email">
                <label for="password">Senha: *</label>
                <input type="password" name="password" id="password">

                <input type="submit" name="sendLogin" id="sendLogin" value="Logar"><br/>
                <?php if(isset($error) && !empty($error)): ?>
                    <div class="warning"><?= $error; ?></div>
                <?php endif; ?>
            </form>
        </div>
    </body>
</html>