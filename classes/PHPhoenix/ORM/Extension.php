<?php 
namespace PHPhoenix\ORM;

/**
 * Abstract extension for the ORM Model.
 * Actual extensions should extend this class.
 *
 * @package ORM
 */
abstract class Extension {

	/**
	 * Phoenix Dependancy Container
	 * @var \PHPhoenix\Phoenix
	 */
	protected $phoenix;
	
	/**
	 * Associated ORM Model
	 * @var \PHPhoenix\ORM\Model
	 */
	protected $model;
	
	/**
	 * Initializes the extension.
	 *
	 * @param \PHPhoenix\Phoenix $phoenix Phoenix dependency container
	 */
	public function __construct($phoenix, $model) {
		$this->phoenix = $phoenix;
		$this->model = $model;
	}
	
}