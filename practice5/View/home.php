<!doctype html>
<html>
<head>
    <title>Test auth</title>
    <?php use \Config\Consts; ?>
</head>
<body>
<script async src="https://telegram.org/js/telegram-widget.js?22" data-telegram-login="<?php echo Consts::TELEGRAM_NAME; ?>" data-size="large" data-radius="20" data-auth-url="<?php echo /*Consts::HOST .*/ '/auth/telegram'; ?>" data-request-access="write"></script>
</body>
</html>