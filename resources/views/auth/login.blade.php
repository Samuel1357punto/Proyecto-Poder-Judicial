<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Sistema Judicial</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e6d3aa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
        }

        .login-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .login-header {
            background: #aa2b48;
            background: linear-gradient(135deg, #aa2b48 0%, #8a2037 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .login-header h1 {
            font-size: 24px;
            font-weight: 300;
            margin-bottom: 5px;
        }

        .login-header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .login-body {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: all 0.3s;
            background: #fafafa;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #aa2b48;
            background: white;
            box-shadow: 0 0 0 3px rgba(170, 43, 72, 0.1);
        }

        .input-error {
            border-color: #f44336 !important;
            background: #ffebee !important;
        }

        .error-message {
            color: #f44336;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        .remember-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .remember-group input[type="checkbox"] {
            margin-right: 8px;
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .remember-group label {
            margin: 0;
            font-weight: normal;
            cursor: pointer;
            user-select: none;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background: #aa2b48;
            background: linear-gradient(135deg, #aa2b48 0%, #8a2037 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .login-btn:hover {
            background: linear-gradient(135deg, #8a2037 0%, #6a1829 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(170, 43, 72, 0.3);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .login-footer {
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #eee;
            text-align: center;
        }

        .login-links {
            display: flex;
            justify-content: space-between;
            gap: 15px;
        }

        .login-links a {
            color: #aa2b48;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
            flex: 1;
        }

        .login-links a:hover {
            color: #8a2037;
            text-decoration: underline;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #a5d6a7;
        }

        .alert-error {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ef9a9a;
        }

        .system-info {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 12px;
        }

        @media (max-width: 480px) {
            .login-body {
                padding: 30px 20px;
            }
            
            .login-links {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo">
                    <img src="{{ asset('images/logo_pjetam_v2.png') }}" alt="Logo">                
                </div>
                <h1>SUPREMO TRIBUNAL DE JUSTICIA</h1>
                <p>Sistema de Gestión Judicial</p>
            </div>

            <div class="login-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error">
                        Las credenciales proporcionadas no son correctas.
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus 
                            autocomplete="username"
                            class="{{ $errors->has('email') ? 'input-error' : '' }}"
                            placeholder="usuario@ejemplo.com"
                        >
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required 
                            autocomplete="current-password"
                            class="{{ $errors->has('password') ? 'input-error' : '' }}"
                            placeholder="••••••••"
                        >
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="remember-group">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Mantener sesión iniciada</label>
                    </div>

                    <button type="submit" class="login-btn">
                        Iniciar Sesión
                    </button>

                    
                </form>
            </div>
        </div>

        <div class="system-info">
            <p>© {{ date('Y') }} Supremo Tribunal de Justicia - Todos los derechos reservados</p>
            <p>Versión 1.0.0</p>
        </div>
    </div>
</body>
</html>