<?php
$archive = new archives();
$records = $archive->getArchive();
require_once('./html/archive.html');    


