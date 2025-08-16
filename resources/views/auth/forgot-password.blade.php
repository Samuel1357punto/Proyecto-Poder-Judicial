<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - Sistema Judicial</title>
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

        .forgot-container {
            width: 100%;
            max-width: 450px;
        }

        .forgot-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .forgot-header {
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

        .icon-lock {
            width: 70px;
            height: 70px;
            margin: 0 auto 15px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
        }

        .forgot-header h1 {
            font-size: 22px;
            font-weight: 300;
            margin-bottom: 5px;
        }

        .forgot-header p {
            font-size: 13px;
            opacity: 0.9;
        }

        .forgot-body {
            padding: 35px 30px;
        }

        .info-box {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 25px;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
        }

        .info-box.success {
            background: #e8f5e9;
            border-left-color: #4caf50;
            color: #2e7d32;
        }

        .info-box.warning {
            background: #fff3e0;
            border-left-color: #ff9800;
            color: #e65100;
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

        input[type="email"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: all 0.3s;
            background: #fafafa;
        }

        input[type="email"]:focus {
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

        .reset-btn {
            width: 100%;
            padding: 14px;
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
        }

        .reset-btn:hover {
            background: linear-gradient(135deg, #8a2037 0%, #6a1829 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(170, 43, 72, 0.3);
        }

        .reset-btn:active {
            transform: translateY(0);
        }

        .reset-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }

        .forgot-footer {
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #eee;
            text-align: center;
        }

        .login-link {
            color: #aa2b48;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .login-link:hover {
            color: #8a2037;
            text-decoration: underline;
        }

        .steps-info {
            background: #f5f5f5;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .steps-info h3 {
            font-size: 14px;
            color: #333;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .steps-info ol {
            padding-left: 20px;
            font-size: 13px;
            color: #555;
            line-height: 1.8;
        }

        .steps-info li {
            margin-bottom: 8px;
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

        @media (max-width: 480px) {
            .forgot-body {
                padding: 25px 20px;
            }
            
            .back-arrow {
                font-size: 20px;
                left: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="forgot-container">
        <div class="forgot-card">
            <div class="forgot-header">
                <a href="{{ route('login') }}" class="back-arrow">←</a>
                <div class="icon-lock">🔒</div>
                <h1>RECUPERAR CONTRASEÑA</h1>
                <p>Sistema de Gestión Judicial</p>
            </div>

            <div class="forgot-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        <strong>¡Correo enviado!</strong><br>
                        {{ session('status') }}
                    </div>
                @endif

                <div class="info-box">
                    <strong>¿Olvidaste tu contraseña?</strong><br>
                    No te preocupes. Ingresa tu correo electrónico registrado y te enviaremos un enlace para restablecer tu contraseña.
                </div>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Correo Electrónico Registrado</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus
                            class="{{ $errors->has('email') ? 'input-error' : '' }}"
                            placeholder="usuario@ejemplo.com"
                        >
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="reset-btn">
                        Enviar Enlace de Recuperación
                    </button>
                </form>

                <div class="steps-info">
                    <h3>¿Qué sucederá después?</h3>
                    <ol>
                        <li>Recibirás un correo en los próximos minutos</li>
                        <li>Haz clic en el enlace del correo</li>
                        <li>Crea una nueva contraseña segura</li>
                        <li>Inicia sesión con tu nueva contraseña</li>
                    </ol>
                </div>

                <div class="forgot-footer">
                    <a href="{{ route('login') }}" class="login-link">
                        <span>←</span>
                        Volver al inicio de sesión
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>