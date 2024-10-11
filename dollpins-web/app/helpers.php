<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('hasRole')) {
    function hasRole($roles)
    {
        // Obtén el usuario autenticado
        $user = Auth::user();

        // Si no está autenticado, devolver false
        if (!$user) {
            return false;
        }

        // Asumiendo que tienes un AuthUserRepository
        $authUserRepository = app(App\Repositories\AuthUserRepository::class);
        $user_roles = $authUserRepository->getUserRoles($user->getAuthIdentifier())->toArray();
        $user_roles = array_column($user_roles, 'name');

        // Verificar si el usuario tiene uno de los roles
        if (is_array($roles)) {
            return count(array_intersect($roles, $user_roles)) > 0;
        }

        return in_array($roles, $user_roles);
    }
}
