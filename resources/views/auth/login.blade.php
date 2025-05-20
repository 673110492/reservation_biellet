<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(to right, #667eea, #764ba2);
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 1rem;
            border: 3px solid #4f46e5;
        }

        h2 {
            margin-bottom: 2rem;
            color: #333;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            text-align: left;
            color: #333;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .checkbox-label {
            font-size: 0.9rem;
            color: #4b5563;
            text-align: left;
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .checkbox-label input {
            margin-right: 5px;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .link {
            font-size: 0.9rem;
            color: #4f46e5;
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }

        button {
            background-color: #4f46e5;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
        }

        button:hover {
            background-color: #4338ca;
        }

        .error {
            color: red;
            font-size: 0.8rem;
            margin-top: -0.5rem;
            margin-bottom: 1rem;
            text-align: left;
        }

        .status-message {
            background-color: #d1fae5;
            color: #065f46;
            padding: 0.75rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Logo/avatar -->
        <img src="https://i.pravatar.cc/80?img=12" alt="Logo" class="logo">
        <h2>Connexion</h2>

        <!-- Affichage du statut de session -->
        @if (session('status'))
            <div class="status-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div>
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Se souvenir de moi -->
            <div class="checkbox-label">
                <input type="checkbox" name="remember" id="remember_me">
                <label for="remember_me">Se souvenir de moi</label>
            </div>

            <!-- Lien + bouton -->
            <div class="actions">
                @if (Route::has('password.request'))
                    <a class="link" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                @endif
            </div>

            <button type="submit">Connexion</button>
        </form>
    </div>

</body>
</html>
