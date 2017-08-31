<?php
/**
 * Apply patches
 *
 * called from console: apply.php username password client_id
 */

chdir(__DIR__. "/../..");

require_once(__DIR__."/classes/class.ilPatchUtils.php");
require_once(__DIR__."/classes/class.ilPermissionUtils.php");

$p = new ilPatchUtils();
$p->login();

/********************
 * Permission Patches
 ********************/

//$p->applyPatch('ilPermissionPatches.initInteractiveVideo');
