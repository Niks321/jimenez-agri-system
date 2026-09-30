<?php

/** The five supported workspace identities: one administrator and four departments. */
final class DepartmentIdentity
{
	public const DEPARTMENTS = [
		'crop' => 'Crop',
		'vegetables' => 'Vegetables',
		'livestock' => 'Livestock',
		'fishery' => 'Fisheries',
	];

	public static function isValid(string $role, mixed $department): bool
	{
		if ($role === 'administrator') {
			return $department === null || $department === '';
		}

		return $role === 'staff'
			&& is_string($department)
			&& array_key_exists($department, self::DEPARTMENTS);
	}

	public static function allows(string $department): bool
	{
		return array_key_exists($department, self::DEPARTMENTS);
	}
}
