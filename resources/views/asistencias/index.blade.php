<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Control de Asistencias - Sistema de Estímulos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
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
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .header-titles p {
            font-size: 14px;
            opacity: 0.9;
        }

        .user-info {
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
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 30px;
        }

        /* Registro de asistencia */
        .check-in-card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            text-align: center;
        }

        .clock-display {
            font-size: 48px;
            font-weight: 300;
            color: #2a5298;
            margin-bottom: 10px;
            font-family: 'Courier New', monospace;
        }

        .date-display {
            font-size: 18px;
            color: #666;
            margin-bottom: 30px;
        }

        .fingerprint-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, rgba(42,82,152,0.1) 0%, rgba(42,82,152,0.2) 100%);
            border-radius: 50%;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .check-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .btn-check {
            padding: 15px 40px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-entrada {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            color: white;
        }

        .btn-entrada:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(39,174,96,0.3);
        }

        .btn-salida {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
        }

        .btn-salida:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(231,76,60,0.3);
        }

        /* Tabla de asistencias */
        .attendance-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .card-header {
            background: linear-gradient(135deg, rgba(42,82,152,0.05) 0%, rgba(42,82,152,0.1) 100%);
            padding: 20px 30px;
            border-bottom: 2px solid #e0e0e0;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .period-badge {
            background: #e3f2fd;
            color: #1976d2;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f8f9fa;
        }

        th {
            padding: 15px 20px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 15px 20px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
        }

        tbody tr:hover {
            background: #f8f9fa;
        }

        .date-badge {
            background: #e3f2fd;
            color: #1976d2;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
        }

        .type-badge {
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .type-badge.entrada {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .type-badge.salida {
            background: #ffebee;
            color: #c62828;
        }

        .time-display {
            font-family: 'Courier New', monospace;
            font-weight: 600;
            color: #333;
            font-size: 15px;
        }

        /* Estadísticas */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-mini {
            background: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        }

        .stat-mini-value {
            font-size: 28px;
            font-weight: 700;
            color: #2a5298;
            margin-bottom: 5px;
        }

        .stat-mini-label {
            font-size: 13px;
            color: #666;
            text-transform: uppercase;
        }

        .success-message {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: #999;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <div class="header-left">
                <div class="logo">
                    <img src="{{ asset('images/logo_pjetam_v2.png') }}" alt="Logo">
                </div>
                <div class="header-titles">
                    <h1>CONTROL DE ASISTENCIAS</h1>
                    <p>Sistema de Estímulos y Evaluación del Desempeño</p>
                </div>
            </div>
            <div class="user-info">
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">JUEZ</div>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Cerrar Sesión</button>
                </form>
            </div>
        </div>
    </header>
    
    <div class="container">
        @if(session('success'))
        <div class="success-message">
            <span style="font-size: 20px;">✅</span>
            {{ session('success') }}
        </div>
        @endif
        
        <!-- Tarjeta de registro -->
        @auth
            @if(auth()->user()->is_admin)
                <a href="{{ route('dashboard') }}" class="btn-dashboard">← Volver al Dashboard</a>
            @endif
        @endauth
        <div class="check-in-card">
            <div class="clock-display" id="clock">00:00:00</div>
            <div class="date-display">{{ \Carbon\Carbon::now()->locale('es_MX')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}</div>
            
            <div class="fingerprint-icon">👆</div>
            
            <h2 style="margin-bottom: 20px; color: #333;">Registro de Asistencia - Huella Digital</h2>
            <p style="color: #666; margin-bottom: 30px;">Coloque su dedo en el lector o use los botones para simular el registro</p>
            
            <div class="check-buttons">
                <form action="{{ route('asistencias.store') }}" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="tipo" value="E">
                    <input type="hidden" name="empleado" value="{{ auth()->user()->name }}">
                    <input type="hidden" name="fecha" value="{{ date('Y-m-d') }}">
                    <input type="hidden" name="hora" value="{{ date('H:i:s') }}">
                    <input type="hidden" name="municipio_id" value="1">
                    <button type="submit" class="btn-check btn-entrada">
                        <span>✓</span> Registrar Entrada
                    </button>
                </form>
                
                <form action="{{ route('asistencias.store') }}" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="tipo" value="S">
                    <input type="hidden" name="empleado" value="{{ auth()->user()->name }}">
                    <input type="hidden" name="fecha" value="{{ date('Y-m-d') }}">
                    <input type="hidden" name="hora" value="{{ date('H:i:s') }}">
                    <input type="hidden" name="municipio_id" value="1">
                    <button type="submit" class="btn-check btn-salida">
                        <span>✗</span> Registrar Salida
                    </button>
                </form>
            </div>
        </div>

        <!-- Estadísticas del mes -->
        <div class="stats-row">
            <div class="stat-mini">
                <div class="stat-mini-value">{{ $asistencias->where('tipo', 'E')->count() ?? 0 }}</div>
                <div class="stat-mini-label">Entradas del Mes</div>
            </div>
            <div class="stat-mini">
                <div class="stat-mini-value">{{ $asistencias->where('tipo', 'S')->count() ?? 0 }}</div>
                <div class="stat-mini-label">Salidas del Mes</div>
            </div>
            <div class="stat-mini">
                <div class="stat-mini-value">
                    @php
                        $puntualidad = $asistencias->where('tipo', 'E')->filter(function($a) {
                            return \Carbon\Carbon::parse($a->hora)->lt(\Carbon\Carbon::parse('08:00:00'));
                        })->count();
                        $total = $asistencias->where('tipo', 'E')->count();
                        $porcentaje = $total > 0 ? round(($puntualidad / $total) * 100) : 0;
                    @endphp
                    {{ $porcentaje }}%
                </div>
                <div class="stat-mini-label">Puntualidad</div>
            </div>
            <div class="stat-mini">
                <div class="stat-mini-value">{{ $asistencias->count() }}</div>
                <div class="stat-mini-label">Total Registros</div>
            </div>
        </div>

        <!-- Tabla de asistencias -->
        <div class="attendance-card">
            <div class="card-header">
                <div class="card-title">
                    <span>📋 Historial de Asistencias</span>
                    <span class="period-badge">{{ \Carbon\Carbon::now()->format('F Y') }}</span>
                </div>
            </div>
            
            @if($asistencias->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Empleado</th>
                            <th>Fecha</th>
                            <th>Día</th>
                            <th>Tipo</th>
                            <th>Hora</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($asistencias->sortByDesc('fecha') as $asistencia)
                            <tr>
                                <td>{{ $asistencia->empleado }}</td>
                                <td>
                                    <span class="date-badge">
                                        {{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($asistencia->fecha)->locale('es')->dayName }}</td>
                                <td>
                                    <span class="type-badge {{ $asistencia->tipo == 'E' ? 'entrada' : 'salida' }}">
                                        {{ $asistencia->tipo == 'E' ? 'Entrada' : 'Salida' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="time-display">{{ $asistencia->hora }}</span>
                                </td>
                                <td>
                                    @if($asistencia->tipo == 'E')
                                        @if(\Carbon\Carbon::parse($asistencia->hora)->lte(\Carbon\Carbon::parse('08:00:00')))
                                            <span style="color: #2e7d32;">✓ A tiempo</span>
                                        @else
                                            <span style="color: #f57c00;">⚠ Retardo</span>
                                        @endif
                                    @else
                                        <span style="color: #666;">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <div style="font-size: 64px; margin-bottom: 20px;">📅</div>
                    <h3>No hay registros de asistencia</h3>
                    <p>Use los botones superiores para registrar su entrada o salida</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Reloj en tiempo real
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
        }
        
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>
</html>