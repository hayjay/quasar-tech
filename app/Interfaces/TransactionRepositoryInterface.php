<?php
namespace App\Interfaces;

interface TransactionRepositoryInterface
{
	public function all();
	public function findByName($name);

}

 ?>