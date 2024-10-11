<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Repositories\AuthUserRepository;


class RoleMiddleware
{
    public function __construct(AuthUserRepository $authUserRepository)
    {
        $this->authUserRepository = $authUserRepository;
    }

    public function handle($request, Closure $next, ...$roles)
    {


        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        $user_roles = $this->authUserRepository->getUserRoles($user->getAuthIdentifier())->toArray();
        $user_roles = array_column($user_roles, 'name');

        if ($user) {
            foreach ($roles as $role) {
                if (in_array($role, $user_roles)) {
                    return $next($request);
                }
            }
        }

        abort(403, 'Acceso denegado.');
    }
}
