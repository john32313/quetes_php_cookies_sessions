<?php
session_start();
session_destroy();

header('Location: http://quetes_php_cookies_sessions.test/');
