<?php
/**
 * Permission patches
 */
class ilPermissionPatches
{
	/**
	 * Copy Permissions from MediaCast to Interactive Video
	 */
	public function initInteractiveVideo()
	{
		$pu = new ilPermissionUtils(true);

		$pu->copyDefaultPermission('mcst','visible',			'xvid','visible');
		$pu->copyDefaultPermission('mcst','read',				'xvid','read');
		$pu->copyDefaultPermission('mcst','write',				'xvid','write');
		$pu->copyDefaultPermission('mcst','delete',				'xvid','delete');
		$pu->copyDefaultPermission('mcst','edit_permission',	'xvid','edit_permission');

		$pu->copyDefaultPermissions(
			array('cat','crs','grp','fold'), array(
			array('create_mcst', 'create_xvid')
		));
		$pu->copyPermissions(
			array('cat','crs','grp','fold'), array(
			array('create_mcst', 'create_xvid')
		));
	}
}