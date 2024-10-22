<?php

use Illuminate\Support\Facades\Auth;

use App\Models\Employee;

if (!function_exists('hasRole')) {
    function hasRole($roles)
    {
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        $authUserRepository = app(App\Repositories\AuthUserRepository::class);
        $user_roles = $authUserRepository->getUserRoles($user->getAuthIdentifier())->toArray();
        $user_roles = array_column($user_roles, 'name');

        if (is_array($roles)) {
            return count(array_intersect($roles, $user_roles)) > 0;
        }

        return in_array($roles, $user_roles);
    }
}

if (!function_exists('getEmployeeName')) {
    function getEmployeeName()
    {
        $id = Auth::user()->id;
        $employee = Employee::where('user_id', $id)->first();
        return $employee->name;
    }
}
