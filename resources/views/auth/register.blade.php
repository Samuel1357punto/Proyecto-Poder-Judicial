<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Sistema Judicial</title>
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

        .register-container {
            width: 100%;
            max-width: 500px;
        }

        .register-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .register-header {
            background: #aa2b48;
            background: linear-gradient(135deg, #aa2b48 0%, #8a2037 100%);
            color: white;
            padding: 25px 30px;
            text-align: center;
            position: relative;
        }

        .back-arrow {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            text-decoration: none;
            font-size: 24px;
            transition: transform 0.3s;
        }

        .back-arrow:hover {
            transform: translateY(-50%) translateX(-3px);
        }

        .logo {
            width: 70px;
            height: 70px;
            margin: 0 auto 10px;
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

        .register-header h1 {
            font-size: 22px;
            font-weight: 300;
            margin-bottom: 5px;
        }

        .register-header p {
            font-size: 13px;
            opacity: 0.9;
        }

        .register-body {
            padding: 35px 30px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 18px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: #333;
            font-weight: 500;
            font-size: 13px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: all 0.3s;
            background: #fafafa;
        }

        input[type="text"]:focus,
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
            font-size: 12px;
            margin-top: 4px;
            display: block;
        }

        .password-requirements {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
            padding: 8px;
            background: #f5f5f5;
            border-radius: 4px;
            line-height: 1.4;
        }

        .register-btn {
            width: 100%;
            padding: 13px;
            background: #aa2b48;
            background: linear-gradient(135deg, #aa2b48 0%, #8a2037 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 10px;
        }

        .register-btn:hover {
            background: linear-gradient(135deg, #8a2037 0%, #6a1829 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(170, 43, 72, 0.3);
        }

        .register-btn:active {
            transform: translateY(0);
        }

        .register-footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            text-align: center;
        }

        .login-link {
            color: #aa2b48;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        .login-link:hover {
            color: #8a2037;
            text-decoration: underline;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ef9a9a;
        }

        .terms-group {
            margin: 20px 0;
            padding: 12px;
            background: #f9f9f9;
            border-radius: 5px;
            font-size: 13px;
            color: #555;
            line-height: 1.5;
        }

        .terms-group input[type="checkbox"] {
            margin-right: 8px;
            vertical-align: middle;
        }

        @media (max-width: 480px) {
            .register-body {
                padding: 25px 20px;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .back-arrow {
                font-size: 20px;
                left: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <a href="{{ route('login') }}" class="back-arrow">←</a>
                <div class="logo">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f1/Escudo_de_Tamaulipas.svg/1200px-Escudo_de_Tamaulipas.svg.png" alt="Logo">
                </div>
                <h1>CREAR NUEVA CUENTA</h1>
                <p>Sistema de Gestión Judicial</p>
            </div>

            <div class="register-body">
                @if ($errors->any())
                    <div class="alert alert-error">
                        Por favor, corrige los errores indicados en el formulario.
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nombre Completo *</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}" 
                            required 
                            autofocus 
                            autocomplete="name"
                            class="{{ $errors->has('name') ? 'input-error' : '' }}"
                            placeholder="Ej: Juan Pérez García"
                        >
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico *</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autocomplete="username"
                            class="{{ $errors->has('email') ? 'input-error' : '' }}"
                            placeholder="usuario@ejemplo.com"
                        >
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="password">Contraseña *</label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                required 
                                autocomplete="new-password"
                                class="{{ $errors->has('password') ? 'input-error' : '' }}"
                                placeholder="••••••••"
                            >
                            @error('password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Contraseña *</label>
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                required 
                                autocomplete="new-password"
                                class="{{ $errors->has('password_confirmation') ? 'input-error' : '' }}"
                                placeholder="••••••••"
                            >
                            @error('password_confirmation')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="password-requirements">
                        <strong>Requisitos de la contraseña:</strong><br>
                        • Mínimo 8 caracteres<br>
                        • Se recomienda usar mayúsculas, minúsculas y números
                    </div>

                    

                    <button type="submit" class="register-btn">
                        Crear Cuenta
                    </button>

                    <div class="register-footer">
                        <p style="color: #666; font-size: 14px; margin-bottom: 10px;">
                            ¿Ya tienes una cuenta?
                        </p>
                        <a href="{{ route('login') }}" class="login-link">
                            Iniciar Sesión
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>