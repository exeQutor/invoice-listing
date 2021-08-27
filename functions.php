<?php
require_once 'BM/BM-Core.php';

foreach (glob(TEMPLATEPATH . '/BM/functions/*.php') as $file) {
	require_once $file;
}
