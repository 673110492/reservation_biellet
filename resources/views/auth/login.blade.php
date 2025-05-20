<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion - Réservation Billets</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background: url('assets1/images/bus3.jpeg') no-repeat center center/cover;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .overlay {
      position: absolute;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.5);
      z-index: 0;
    }

    .container {
      position: relative;
      z-index: 1;
      width: 100%;
      max-width: 420px;
      background-color: #ffffff;
      padding: 2rem;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
      text-align: center;
    }

    .logo {
      width: 80px;
      height: 80px;
      object-fit: contain;
      margin-bottom: 1rem;
    }

    h2 {
      margin-bottom: 1.5rem;
      color: #222;
      font-weight: bold;
    }

    label {
      display: block;
      margin-bottom: 0.4rem;
      text-align: left;
      font-weight: 600;
      color: #444;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 10px;
    }

    .checkbox-label {
      font-size: 0.9rem;
      color: #4b5563;
      display: flex;
      align-items: center;
      text-align: left;
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
      color: #007bff;
      text-decoration: none;
    }

    .link:hover {
      text-decoration: underline;
    }

    button {
      background-color: #007bff;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      width: 100%;
      font-size: 1rem;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #0056b3;
    }

    .error {
      color: red;
      font-size: 0.8rem;
      text-align: left;
      margin-bottom: 1rem;
    }

    .status-message {
      background-color: #d1fae5;
      color: #065f46;
      padding: 0.75rem;
      border-radius: 10px;
      margin-bottom: 1rem;
      font-size: 0.9rem;
    }

    @media (max-width: 480px) {
      .container {
        padding: 1.5rem;
        margin: 1rem;
      }
    }
  </style>
</head>
<body>
  <div class="overlay"></div>
  <div class="container">
    <img src="https://cdn-icons-png.flaticon.com/512/2942/2942188.png" alt="Logo transport" class="logo">
    <h2>Connexion à votre compte</h2>

    @if (session('status'))
      <div class="status-message">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div>
        <label for="email">Adresse e-mail</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
        @error('email')
          <div class="error">{{ $message }}</div>
        @enderror
      </div>

      <div>
        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password" required autocomplete="current-password">
        @error('password')
          <div class="error">{{ $message }}</div>
        @enderror
      </div>

      <div class="checkbox-label">
        <input type="checkbox" name="remember" id="remember_me">
        <label for="remember_me">Se souvenir de moi</label>
      </div>

      <div class="actions">
        @if (Route::has('password.request'))
          <a class="link" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
        @endif
      </div>

      <button type="submit">Se connecter</button>
    </form>
  </div>
</body>
</html>
