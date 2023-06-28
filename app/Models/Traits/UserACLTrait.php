<?php

  namespace App\Models\Traits;

  trait UserACLTrait
  {
    public function hasPermission(string $permissionName): bool
    {
      return in_array($permissionName, $this->permissions());
    }

    public function permissions()
    {
      $tenant = $this->tenant()->first();
      $profiles = $tenant->profiles;

      $permissions = [];
      foreach ($profiles as $profile) {
        foreach ($profile->permissions as $permission) {
          array_push($permissions, $permission->name);
        }
      }
      return $permissions;
    }

    public function isAdmin(): bool
    {
      return in_array($this->email, config('acl.admins'));
    }

    public function isTenant(): bool
    {
      return !in_array($this->email, config('acl.admins'));
    }

  }