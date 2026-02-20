<?php
if(preg_match('/\.(?:png|jpg|jpeg|gif|css|js|ico)$/',$_SERVER['REQUEST_URI'])) return false;
require __DIR__.'/index.php';