<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected function authenticated(Request $request, $user)
{
    if ($user->hasRole('admin')) {
        return redirect()->route('dashboard'); // ta page admin
    }

    return redirect('/'); // autre redirection pour les utilisateurs normaux
}

}
