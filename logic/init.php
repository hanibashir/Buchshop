<?php

// Your custom class dir
const CLASS_DIR = 'classes/';

set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
spl_autoload_extensions('.class.php');

// Use default autoload implementation
spl_autoload_register();
