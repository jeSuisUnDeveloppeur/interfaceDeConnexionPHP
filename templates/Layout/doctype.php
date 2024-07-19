<?php
define('ROOTH_HTTP','http://localhost:3000/templates/');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOTH_HTTP?><?=$css_path?>" type="text/css">
    <script src="<?=ROOTH_HTTP?><?=$script?>" type="text/javascript"defer></script>
    <title><?=$title?></title>
</head>
<body>
    <?=$content?>
</body>
</html>