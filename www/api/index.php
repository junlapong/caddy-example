<?php

header("Content-Type: text/plain");

print_r("SERVER\t\t"  . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . "\n");
print_r("PATH_INFO\t" . $_SERVER['PATH_INFO'] . "\n");
print_r("PHP_SELF\t"  . $_SERVER['PHP_SELF'] . "\n");
print_r("\n");

print_r($_SERVER);

// EOF