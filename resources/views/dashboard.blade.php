<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Sistema de Estímulos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 20px 0;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .logo img {
            width: 100%;
            height: 100%;
        }

        .header-titles h1 {
            font-size: 26px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .header-titles p {
            font-size: 14px;
            opacity: 0.9;
        }

        .user-section {
            text-align: right;
        }

        .user-name {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .user-role {
            background: rgba(255,255,255,0.2);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            display: inline-block;
            margin-bottom: 10px;
        }

        .logout-btn {
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
            padding: 8px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background: rgba(255,255,255,0.3);
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 30px;
        }

        /* Welcome Card */
        .welcome-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            border-left: 5px solid #2a5298;
        }

        .welcome-card h2 {
            color: #333;
            font-size: 28px;
            margin-bottom: 15px;
        }

        .welcome-card p {
            color: #666;
            line-height: 1.8;
            font-size: 15px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
            transition: all 0.3s;
            border-top: 4px solid #2a5298;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, rgba(42,82,152,0.1) 0%, rgba(42,82,152,0.2) 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #2a5298;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #666;
            font-size: 14px;
        }

        /* Modules Grid */
        .modules-section {
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 22px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title::before {
            content: '';
            width: 4px;
            height: 28px;
            background: linear-gradient(180deg, #2a5298, #1e3c72);
            border-radius: 2px;
        }

        .modules-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .module-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            text-decoration: none;
            color: #333;
            transition: all 0.3s;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .module-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #2a5298, #1e3c72);
            transform: scaleX(0);
            transition: transform 0.3s;
        }

        .module-card:hover::before {
            transform: scaleX(1);
        }

        .module-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            border-color: #2a5298;
        }

        .module-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, rgba(42,82,152,0.1) 0%, rgba(42,82,152,0.2) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .module-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }

        .module-description {
            font-size: 14px;
            color: #666;
            line-height: 1.5;
        }

        .module-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
        }

        /* Admin Section */
        .admin-section {
            background: linear-gradient(135deg, rgba(255,152,0,0.05) 0%, rgba(255,152,0,0.1) 100%);
            border: 2px solid rgba(255,152,0,0.3);
            border-radius: 15px;
            padding: 30px;
            margin-top: 40px;
        }

        .admin-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .admin-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }

        .admin-title {
            font-size: 20px;
            color: #e65100;
            font-weight: 600;
        }

        /* Alert */
        .alert-info {
            background: linear-gradient(135deg, rgba(33,150,243,0.1) 0%, rgba(33,150,243,0.15) 100%);
            border: 1px solid rgba(33,150,243,0.3);
            color: #1565c0;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        @media (max-width: 768px) {
            .modules-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <div class="logo-section">
                <div class="logo">
                    <img src="{{ asset('images/logo_pjetam_v2.png') }}" alt="Logo">
                </div>
                <div class="header-titles">
                    <h1>SUPREMO TRIBUNAL DE JUSTICIA</h1>
                    <p>Sistema de Estímulos y Evaluación del Desempeño</p>
                </div>
            </div>
            <div class="user-section">
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">ADMINISTRADOR DEL SISTEMA</div>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Cerrar Sesión</button>
                </form>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="welcome-card">
            <h2>Bienvenido al Panel de Administración 👋</h2>
            <p>
                Como <strong>Administrador del Sistema</strong>, tienes acceso completo para gestionar el Sistema de Estímulos y 
                Evaluación del Desempeño. Puedes supervisar las actividades de jueces y secretarios, registrar permanencias, 
                calificar el desempeño y generar los bonos de productividad correspondientes.
            </p>
        </div>

        <!-- Estadísticas -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📋</div>
                <div class="stat-value">{{ \App\Models\Acuerdo::count() ?? 0 }}</div>
                <div class="stat-label">Acuerdos Publicados</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">👨‍⚖️</div>
                <div class="stat-value">{{ \App\Models\User::where('role_id', 3)->count() ?? 0 }}</div>
                <div class="stat-label">Jueces Activos</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-value">{{ \App\Models\Permanencia::where('permanencia', 'Sí')->count() ?? 0 }}</div>
                <div class="stat-label">Permanencias Positivas</div>
            </div>
            <!-- Módulos no funcionando
            <div class="stat-card">
                <div class="stat-icon">💰</div>
                <div class="stat-value">${{ number_format(\App\Models\RecepcionDocumento::sum('importe') ?? 0, 2) }}</div>
                <div class="stat-label">Total en Estímulos</div>
            </div>
            -->
        </div>

        <!-- Módulos Principales -->
        <div class="modules-section">
            <h3 class="section-title">Módulos de Evaluación</h3>
            <div class="modules-grid">
                <a href="{{ route('permanencias.index') }}" class="module-card">
                    <span class="module-badge">Activo</span>
                    <div class="module-icon">📊</div>
                    <h4 class="module-title">Control de Permanencias</h4>
                    <p class="module-description">
                        Registra y monitorea la permanencia de jueces en sus lugares de trabajo. 
                        Sistema de verificación aleatoria según el documento oficial.
                    </p>
                </a>

                <a href="{{ route('recepcion-documentos.index') }}" class="module-card">
                    <span class="module-badge">Activo</span>
                    <div class="module-icon">📈</div>
                    <h4 class="module-title">Calificaciones de Jueces</h4>
                    <p class="module-description">
                        Evalúa el desempeño integral de los jueces: puntualidad, permanencia, 
                        resoluciones, sentencias y cálculo automático de estímulos.
                    </p>
                </a>

                <a href="{{ route('acuerdos.index') }}" class="module-card">
                    <div class="module-icon">📄</div>
                    <h4 class="module-title">Listas de Acuerdos</h4>
                    <p class="module-description">
                        Supervisa la liberación de listas de acuerdos por parte de los secretarios. 
                        Control de publicación en tiempo y forma.
                    </p>
                </a>

                <a href="{{ route('asistencias.index') }}" class="module-card">
                    <div class="module-icon">🕐</div>
                    <h4 class="module-title">Control de Asistencias</h4>
                    <p class="module-description">
                        Monitorea la puntualidad y asistencia del personal judicial. 
                        Registro mediante huella digital.
                    </p>
                </a>
            </div>
        </div>

        
    </div>
</body>
</html>