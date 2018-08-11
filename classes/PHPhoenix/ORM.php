<?php

namespace PHPhoenix;

/**
 * ORM Module for PHPhoenix
 *
 * This module allows you to instantly turn your tables 
 * into Models and specify their relations in a simple way.
 *
 * @see \PHPhoenix\DB\Query
 * @package    DB
 */
class ORM {
	
	/**
	 * Phoenix Dependency Container
	 * @var \PHPhoenix\Phoenix
	 */
	public $phoenix;
	
	/**
	 * Cache of ORM tables columns
	 * @var array
	 */
	public $column_cache = array();
	
	/**
	 * Initializes the ORM module
	 * 
	 * @param \PHPhoenix\Phoenix $phoenix Phoenix dependency container
	 */
	public function __construct($phoenix) {
		$this->phoenix = $phoenix;
	}
	
	/**
	 * Initializes ORM model by name, and optionally fetches an item by id
	 *
	 * @param string  $name Model name
	 * @param mixed $id   If set ORM will try to load the item with this id from the database
	 * @return \PHPhoenix\ORM\Model   ORM model, either empty or preloaded
	 */
	public function get($name, $id = null)
	{
		$name = explode('_', $name);
		$name = array_map('ucfirst', $name);
		$name = implode("\\", $name);
		$model = $this->phoenix->app_namespace."Model\\".$name;
		$model = new $model($this->phoenix);
		if ($id != null)
		{
			$model = $model->where($model->id_field, $id)->find();
			$model->values(array($model->id_field => $id));
		}
		return $model;
	}
	
	/**
	 * Initializes an ORM Result with which model to use and which result to
	 * iterate over
	 *
	 * @param string          $model  Model name
	 * @param \PHPhoenix\DB\Result $dbresult Database result
	 * @param array           $with Array of rules for preloaded relationships
	 * @return \PHPhoenix\ORM\Result Initialized Result
	 */
	public function result($model, $dbresult, $with = array()) {
		return new \PHPhoenix\ORM\Result($this->phoenix, $model, $dbresult, $with);
	}
	
	/**
	 * Initializes an ORM Model Extension.
	 *
	 * @param string $class  Extension class name
	 * @param \PHPhoenix\ORM\Model $model Associated Model
	 * @return \PHPhoenix\ORM\Extension Initialized Extension
	 */
	public function extension($class, $model) {
		return new $class($this->phoenix, $model);
	}
}
