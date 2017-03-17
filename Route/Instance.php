<?php
/*
 * Doit être importé après la création de $app. Ne créé rien.
 */
$app->get('/instance/reset_token', '\App\Components\Instance\ResetToken\Controller:get')->setName('resetToken');
