<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Permanencias - Sistema Judicial</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e6d3aa 0%, #f4e8d0 100%);
            min-height: 100vh;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #aa2b48 0%, #8a2037 100%);
            color: white;
            padding: 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-icon {
            width: 50px;
            height: 50px;
            background: rgba(255,255,255,0.15);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            backdrop-filter: blur(10px);
        }

        .header-text h1 {
            font-size: 24px;
            font-weight: 500;
            margin-bottom: 3px;
        }

        .header-text p {
            font-size: 13px;
            opacity: 0.9;
        }

        .header-actions {
            display: flex;
            gap: 15px;
        }

        .btn-header {
            background: rgba(255,255,255,0.15);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            backdrop-filter: blur(10px);
        }

        .btn-header:hover {
            background: rgba(255,255,255,0.25);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        /* Container principal */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px;
        }

        /* Card de información */
        .info-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            border: 1px solid rgba(170, 43, 72, 0.1);
        }

        /* Botón flotante de agregar (solo admin) */
        @if(auth()->user() && auth()->user()->isAdmin())
        .fab-add {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #aa2b48 0%, #8a2037 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(170, 43, 72, 0.4);
            transition: all 0.3s;
            text-decoration: none;
            z-index: 100;
        }

        .fab-add:hover {
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 8px 25px rgba(170, 43, 72, 0.5);
        }
        @endif

        .card-header {
            text-align: center;
            padding-bottom: 25px;
            border-bottom: 2px solid rgba(170, 43, 72, 0.1);
            margin-bottom: 25px;
        }

        .logo-container {
            width: 90px;
            height: 90px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, rgba(170, 43, 72, 0.1) 0%, rgba(138, 32, 55, 0.1) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(170, 43, 72, 0.15);
        }

        .logo-container img {
            width: 60px;
            height: 60px;
        }

        .institution-title {
            font-size: 22px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .department-title {
            font-size: 18px;
            color: #aa2b48;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .period-badge {
            display: inline-block;
            background: linear-gradient(135deg, rgba(33, 150, 243, 0.1) 0%, rgba(33, 150, 243, 0.15) 100%);
            color: #1565c0;
            padding: 10px 25px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid rgba(33, 150, 243, 0.3);
        }

        /* Estadísticas */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(170, 43, 72, 0.03) 0%, rgba(138, 32, 55, 0.05) 100%);
            padding: 20px;
            border-radius: 12px;
            border: 1px solid rgba(170, 43, 72, 0.1);
            text-align: center;
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(170, 43, 72, 0.15);
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: #aa2b48;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 13px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Tabla principal */
        .table-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            border: 1px solid rgba(170, 43, 72, 0.1);
        }

        .table-header {
            background: linear-gradient(135deg, rgba(170, 43, 72, 0.05) 0%, rgba(138, 32, 55, 0.08) 100%);
            padding: 20px 25px;
            border-bottom: 2px solid rgba(170, 43, 72, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .record-count {
            background: linear-gradient(135deg, #aa2b48 0%, #8a2037 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Controles de filtro */
        .filter-controls {
            display: flex;
            gap: 15px;
            padding: 20px 25px;
            background: rgba(170, 43, 72, 0.02);
            border-bottom: 1px solid rgba(170, 43, 72, 0.1);
        }

        .search-box {
            flex: 1;
            max-width: 400px;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .search-input:focus {
            outline: none;
            border-color: #aa2b48;
            box-shadow: 0 0 0 3px rgba(170, 43, 72, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        /* Tabla */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        thead {
            background: linear-gradient(135deg, rgba(170, 43, 72, 0.03) 0%, rgba(138, 32, 55, 0.05) 100%);
        }

        th {
            padding: 15px 20px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid rgba(170, 43, 72, 0.1);
            position: sticky;
            top: 0;
            background: inherit;
        }

        td {
            padding: 14px 20px;
            color: #555;
            font-size: 14px;
            border-bottom: 1px solid #f0f0f0;
        }

        tbody tr {
            transition: all 0.3s;
        }

        tbody tr:hover {
            background: rgba(170, 43, 72, 0.02);
        }

        .employee-number {
            background: linear-gradient(135deg, #aa2b48 0%, #8a2037 100%);
            color: white;
            padding: 4px 10px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 12px;
        }

        .name-cell {
            font-weight: 500;
            color: #333;
        }

        .department-badge {
            background: rgba(33, 150, 243, 0.1);
            color: #1565c0;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
        }

        .date-cell {
            font-family: 'Courier New', monospace;
            font-weight: 500;
        }

        .permanence-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .permanence-badge.si {
            background: linear-gradient(135deg, rgba(76, 175, 80, 0.15) 0%, rgba(76, 175, 80, 0.2) 100%);
            color: #2e7d32;
            border: 1px solid rgba(76, 175, 80, 0.3);
        }

        .permanence-badge.no {
            background: linear-gradient(135deg, rgba(244, 67, 54, 0.15) 0%, rgba(244, 67, 54, 0.2) 100%);
            color: #c62828;
            border: 1px solid rgba(244, 67, 54, 0.3);
        }

        .observation-text {
            color: #666;
            font-size: 13px;
            font-style: italic;
        }

        /* Paginación */
        .table-footer {
            padding: 20px 25px;
            background: linear-gradient(135deg, rgba(170, 43, 72, 0.02) 0%, rgba(138, 32, 55, 0.04) 100%);
            border-top: 2px solid rgba(170, 43, 72, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .showing-info {
            color: #666;
            font-size: 14px;
        }

        .pagination {
            display: flex;
            gap: 8px;
        }

        .page-btn {
            padding: 8px 12px;
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            color: #666;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
            font-weight: 500;
        }

        .page-btn:hover {
            border-color: #aa2b48;
            color: #aa2b48;
        }

        .page-btn.active {
            background: linear-gradient(135deg, #aa2b48 0%, #8a2037 100%);
            color: white;
            border-color: #aa2b48;
        }

        /* Botones de acción */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-action {
            padding: 12px 30px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
        }

        .btn-back {
            background: white;
            color: #aa2b48;
            border: 2px solid #aa2b48;
        }

        .btn-back:hover {
            background: linear-gradient(135deg, #aa2b48 0%, #8a2037 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(170, 43, 72, 0.3);
        }

        .btn-export {
            background: linear-gradient(135deg, #4caf50 0%, #45a049 100%);
            color: white;
        }

        .btn-export:hover {
            background: linear-gradient(135deg, #45a049 0%, #3d8b40 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }

        .btn-print {
            background: linear-gradient(135deg, #2196f3 0%, #1976d2 100%);
            color: white;
        }

        .btn-print:hover {
            background: linear-gradient(135deg, #1976d2 0%, #1565c0 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(33, 150, 243, 0.3);
        }

        /* Estado vacío */
        .empty-state {
            padding: 80px 20px;
            text-align: center;
        }

        .empty-icon {
            font-size: 72px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .empty-title {
            font-size: 24px;
            color: #666;
            margin-bottom: 10px;
        }

        .empty-message {
            font-size: 14px;
            color: #999;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .stats-row {
                grid-template-columns: 1fr;
            }

            .filter-controls {
                flex-direction: column;
            }

            .search-box {
                max-width: 100%;
            }

            table {
                font-size: 12px;
            }

            th, td {
                padding: 10px;
            }

            .table-footer {
                flex-direction: column;
                gap: 15px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-action {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <div class="header-left">
                <div class="header-icon">📊</div>
                <div class="header-text">
                    <h1>Control de Permanencias</h1>
                    <p>Sistema de Gestión Judicial</p>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('dashboard') }}" class="btn-header">
                    <span>🏠</span> Dashboard
                </a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-header">
                        <span>🚪</span> Salir
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Container principal -->
    <div class="container">
        <!-- Card de información -->
        <div class="info-card">
            <div class="card-header">
                <div class="logo-container">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f1/Escudo_de_Tamaulipas.svg/1200px-Escudo_de_Tamaulipas.svg.png" alt="Logo">
                </div>
                <h2 class="institution-title">SUPREMO TRIBUNAL DE JUSTICIA</h2>
                <h3 class="department-title">Registro de Permanencias</h3>
                <div class="period-badge">
                    📅 Periodo: 1 de enero del 2011 - 23 de agosto de 2012
                </div>
            </div>

            <!-- Estadísticas -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-number">{{ $registros->count() }}</div>
                    <div class="stat-label">Total Registros</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $registros->where('permanencia', 'Sí')->count() }}</div>
                    <div class="stat-label">Con Permanencia</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $registros->where('permanencia', 'No')->count() }}</div>
                    <div class="stat-label">Sin Permanencia</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $registros->unique('numero_empleado')->count() }}</div>
                    <div class="stat-label">Jueces Únicos</div>
                </div>
            </div>
        </div>

        @if(auth()->user()->isAdmin())
        <!-- Botón de agregar para administradores -->
        <div style="margin-bottom: 20px; text-align: right;">
            <a href="{{ route('permanencia.create') }}" class="btn-search" style="display: inline-flex; text-decoration: none;">
                <span>➕</span> Agregar Nueva Permanencia
            </a>
        </div>
        @endif

        <!-- Tabla principal -->
        <div class="table-container">
            <div class="table-header">
                <div class="table-title">
                    <span>📋</span>
                    <span>Listado de Permanencias</span>
                    <span class="record-count">{{ $registros->count() }} registros</span>
                </div>
            </div>

            <!-- Controles de filtro -->
            <div class="filter-controls">
                <div class="search-box">
                    <span class="search-icon">🔍</span>
                    <input type="text" class="search-input" placeholder="Buscar por nombre, número o adscripción..." id="searchInput">
                </div>
            </div>

            <!-- Tabla -->
            <div style="overflow-x: auto;">
                @if($registros->count() > 0)
                    <table id="permanenciasTable">
                        <thead>
                            <tr>
                                <th>No. Empleado</th>
                                <th>Nombre del Juez</th>
                                <th>Adscripción</th>
                                <th>Fecha</th>
                                <th>Permanencia</th>
                                <th>Observación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registros as $registro)
                                <tr>
                                    <td>
                                        <span class="employee-number">{{ $registro->numero_empleado }}</span>
                                    </td>
                                    <td class="name-cell">{{ $registro->nombre_juez }}</td>
                                    <td>
                                        <span class="department-badge">{{ $registro->adscripcion }}</span>
                                    </td>
                                    <td class="date-cell">
                                        {{ \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        <span class="permanence-badge {{ strtolower($registro->permanencia) == 'sí' ? 'si' : 'no' }}">
                                            {{ $registro->permanencia }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="observation-text">{{ $registro->observacion ?? '-' }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">📭</div>
                        <div class="empty-title">No hay registros de permanencia</div>
                        <div class="empty-message">Los registros aparecerán aquí cuando se agreguen al sistema</div>
                    </div>
                @endif
            </div>

            @if($registros->count() > 0)
                <div class="table-footer">
                    <div class="showing-info">
                        Mostrando {{ $registros->count() }} de {{ $registros->count() }} registros
                    </div>
                    <div class="pagination">
                        <button class="page-btn">←</button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn">→</button>
                    </div>
                </div>
            @endif
        </div>

        <!-- Botones de acción -->
        <div class="action-buttons">
            <a href="{{ route('dashboard') }}" class="btn-action btn-back">
                <span>←</span> Volver al Dashboard
            </a>
        </div>
    </div>
</body>
</html>