<?php
require_once __DIR__.'/lib/school.php';
$admin = new Admin();
require_once __DIR__.'/parts/head.php';
if ($admin->user == -1) {
require_once __DIR__.'/login.php';
} else {
    require_once __DIR__.'/interface/data_index.php';
}
require_once __DIR__.'/parts/foot.php';
?>