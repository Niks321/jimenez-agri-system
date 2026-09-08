<?php

require_once __DIR__ . '/../backend/security/SessionSecurity.php';
call_user_func(['SessionSecurity', 'preventCaching']);
call_user_func(['SessionSecurity', 'destroy']);

header('Location: login.php?logged_out=1', true, 303);
exit;
