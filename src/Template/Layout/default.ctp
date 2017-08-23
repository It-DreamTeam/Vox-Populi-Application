<?=$this->Html->docType();?>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moodify - <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('app.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?=$this->Html->script('https://apis.google.com/js/api:client.js');?>

    <meta name="google-signin-client_id" content="724346200475-sj3iure20vb2mse5m6ogjtsg9kb5qma2.apps.googleusercontent.com">
</head>
<body>
    <?= $this->fetch('content') ?>
</body>
</html>
