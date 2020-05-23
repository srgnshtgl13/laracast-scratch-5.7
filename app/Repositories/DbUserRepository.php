<?php

namespace App\Repositories;

class DbUserRepository implements UserRepository
{
	public function create($attributes)
	{
		// User::create(['name'=>"User", ... ]);
		$object = array();
		foreach ($attributes as $key => $value) {
			array_push($object, $value);
		}
		dd($object);
	}
}