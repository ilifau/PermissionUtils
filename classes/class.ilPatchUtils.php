<?php
/**
 * Utilites for applying patches
 */
class ilPatchUtils
{
	/** @var  ilCronStartUp $cron */
	protected $cron;

	/**
	 * Initialize and login
	 */
	public function login()
	{
		// set error reporting
		error_reporting (E_ALL ^E_STRICT ^E_NOTICE);
		ini_set("display_errors","on");

		if($_SERVER['argc'] < 4)
		{
			die("Usage: apply.php username password client\n");
		}

		// initialize like a cron job
		include_once './Services/Cron/classes/class.ilCronStartUp.php';
		$this->cron = new ilCronStartUp($_SERVER['argv'][3], $_SERVER['argv'][1], $_SERVER['argv'][2]);

		try
		{
			$this->cron->initIlias();
			$this->cron->authenticate();
		}
		catch(Exception $e)
		{
			$this->cron->logout();

			echo $e->getMessage()."\n";
			exit(1);
		}
	}

	/**
	 * Logout
	 */
	public function logout()
	{
		$this->cron->logout();
	}

	/**
	 * Apply a patch given by its function name
	 *
	 * @param	string 	$a_patch 	patch identifier (class.method)
	 * @param	mixed	$a_params 	parameters (single oder array)
	 */
	public function applyPatch($a_patch, $a_params = null)
	{
		$start = time();
		echo "Apply " . $a_patch . " ... \n";

		$class = substr($a_patch, 0, strpos($a_patch, '.'));
		$method = substr($a_patch, strpos($a_patch, '.') + 1);

		// get the patch class
		require_once (__DIR__ ."/../patches/class.".$class.".php");
		$object = new $class;

		// call the patch method
		$error = $object->$method($a_params);

		// output the result and remember success
		if ($error != "")
		{
			echo $error . " Failed.\n";
		}
		else
		{
			echo "Done.\n";
		}

		echo "Time (s): " .(time() - $start) . "\n\n";
	}
} 