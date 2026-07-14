<?php
namespace  App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\AuthRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    /**
     * Login Form
     *
     * @return Factory|View
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Login Post
     *
     * @param AuthRequest $request
     * @return RedirectResponse
     */
    public function postLogin(AuthRequest $request): RedirectResponse
    {
        if(auth()->attempt($request->validated() + ['is_admin' => true])) {
            return redirect()->route('home');
        }
        return redirect()
            ->back()
            ->withInput($request->validated())
            ->withErrors(['status' => 'error']);
    }

    /**
     * Logout
     *
     * @return RedirectResponse
     */
    public function logout():RedirectResponse
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
