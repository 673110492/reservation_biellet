<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inscription</title>
    <style>
        /* Style général */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background: white;
            padding: 2.5rem 3rem 3rem;
            border-radius: 12px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
            width: 100%;
            max-width: 420px;
            text-align: center;
            position: relative;
        }
        /* Avatar/logo */
        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
            border: 3px solid #6366f1;
            background-color: #e0e7ff;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2.5rem;
            color: #6366f1;
            user-select: none;
        }
        form div {
            margin-bottom: 1.25rem;
            text-align: left;
        }
        label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.4rem;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            font-size: 1rem;
            border-radius: 8px;
            border: 1.5px solid #d1d5db;
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 6px rgba(99, 102, 241, 0.5);
        }
        .mt-4 {
            margin-top: 1rem !important;
        }
        .flex {
            display: flex;
        }
        .items-center {
            align-items: center;
        }
        .justify-end {
            justify-content: flex-end;
        }
        .underline {
            text-decoration: underline;
        }
        .text-sm {
            font-size: 0.875rem;
        }
        .text-gray-600 {
            color: #4b5563;
        }
        .hover\:text-gray-900:hover {
            color: #111827;
        }
        a {
            cursor: pointer;
        }
        .ms-4 {
            margin-left: 1rem;
        }
        button {
            background-color: #6366f1;
            color: white;
            font-weight: 600;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 1rem;
            min-width: 120px;
        }
        button:hover {
            background-color: #4f46e5;
        }
        .mt-2 {
            margin-top: 0.5rem !important;
            color: #dc2626; /* rouge pour erreurs */
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Avatar/logo : tu peux remplacer le texte par une image si tu veux -->
        <div class="avatar" aria-label="Logo">🔐</div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</body>
</html>
