<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $flash = [
            'type' => null,
            'message' => null,
        ];
        if ($request->session()->has('success')) {
            $flash['type'] = 'success';
            $flash['message'] = $request->session()->get('success');
        } elseif ($request->session()->has('error')) {
            $flash['type'] = 'error';
            $flash['message'] = $request->session()->get('error');
        } elseif ($request->session()->has('warning')) {
            $flash['type'] = 'warning';
            $flash['message'] = $request->session()->get('warning');
        } elseif ($request->session()->has('info')) {
            $flash['type'] = 'info';
            $flash['message'] = $request->session()->get('info');
        }

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'flash' => $flash,
        ]);
    }
}
