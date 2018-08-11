<?php
namespace Model {
	class Nested extends \PHPhoenix\ORM\Model
	{
		public $table = 'nested';
		public $connection = 'orm';
		protected $extensions = array(
			'nested' => '\PHPhoenix\ORM\Extension\Nested'
		);
	}
}