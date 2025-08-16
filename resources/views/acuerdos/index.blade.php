<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Estímulos - Lista de Acuerdos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f0f0;
            min-height: 100vh;
        }

        /* Header oficial */
        .header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 20px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
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
            border-radius: 10px;
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
            font-size: 14px;
            margin-bottom: 5px;
        }

        .user-role {
            background: rgba(255,255,255,0.2);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            display: inline-block;
        }

        .logout-btn {
            margin-top: 10px;
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background: rgba(255,255,255,0.3);
        }

        /* Container principal */
        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* Panel de registro rápido */
        .quick-register {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .panel-title {
            font-size: 18px;
            color: #2a5298;
            margin-bottom: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .panel-title::before {
            content: '';
            width: 4px;
            height: 24px;
            background: #2a5298;
            border-radius: 2px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .form-group select {
            padding: 10px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
            background: white;
            cursor: pointer;
            transition: all 0.3s;
        }

        .form-group select:focus {
            outline: none;
            border-color: #2a5298;
            box-shadow: 0 0 0 3px rgba(42, 82, 152, 0.1);
        }

        .btn-register {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
        }

        /* Tabla de acuerdos */
        .table-container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .table-header {
            background: #f8f9fa;
            padding: 20px 25px;
            border-bottom: 2px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .table-date {
            font-size: 14px;
            color: #666;
            background: #e8f4f8;
            padding: 5px 15px;
            border-radius: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #2a5298;
            color: white;
        }

        th {
            padding: 12px 15px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
            color: #333;
        }

        tbody tr:hover {
            background: #f8f9fa;
        }

        .municipio-tag {
            background: #e3f2fd;
            color: #1976d2;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
        }

        .clave-tag {
            background: #fff3e0;
            color: #f57c00;
            padding: 4px 8px;
            border-radius: 4px;
            font-family: monospace;
            font-size: 12px;
        }

        .materia-tag {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
        }

        .acuerdo-count {
            background: #f3e5f5;
            color: #7b1fa2;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Indicador de estado */
        .status-indicator {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 5px;
        }

        .status-indicator.active {
            background: #27ae60;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(39, 174, 96, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(39, 174, 96, 0); }
            100% { box-shadow: 0 0 0 0 rgba(39, 174, 96, 0); }
        }

        /* Mensaje cuando no hay acuerdos */
        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: #999;
        }

        .empty-icon {
            font-size: 64px;
            margin-bottom: 20px;
        }

        /* Stats cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-left: 4px solid #2a5298;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #2a5298;
        }

        .stat-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .header-content {
                flex-direction: column;
                text-align: center;
            }
            
            .user-info {
                margin-top: 20px;
                text-align: center;
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
            <div class="user-info">
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">SECRETARIO DE ACUERDOS</div>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Cerrar Sesión</button>
                </form>
            </div>
        </div>
    </header>

    <div class="container">
        <!-- Estadísticas -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value">{{ $acuerdos->count() }}</div>
                <div class="stat-label">Acuerdos del día</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $acuerdos->where('created_at', '>=', now()->startOfDay())->count() }}</div>
                <div class="stat-label">Publicados hoy</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">100%</div>
                <div class="stat-label">Cumplimiento</div>
            </div>
        </div>

        <!-- Panel de registro rápido -->
        <div class="quick-register">
            <h3 class="panel-title">
                <span class="status-indicator active"></span>
                Liberación de Lista de Acuerdos - Registro Rápido
            </h3>
            
            <form action="{{ route('acuerdos.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label for="municipio">MUNICIPIO</label>
                        <select name="municipio" id="municipio" required>
                            <option value="">Seleccionar...</option>
                            <option value="VICTORIA">VICTORIA</option>
                            <option value="ALTAMIRA">ALTAMIRA</option>
                            <option value="CIUDAD MADERO">CIUDAD MADERO</option>
                            <option value="TAMPICO">TAMPICO</option>
                            <option value="REYNOSA">REYNOSA</option>
                            <option value="RÍO BRAVO">RÍO BRAVO</option>
                            <option value="MATAMOROS">MATAMOROS</option>
                            <option value="NUEVO LAREDO">NUEVO LAREDO</option>
                            <option value="VALLE HERMOSO">VALLE HERMOSO</option>
                            <option value="SAN FERNANDO">SAN FERNANDO</option>
                            <option value="EL MANTE">EL MANTE</option>
                            <option value="GONZÁLEZ">GONZÁLEZ</option>
                            <option value="XICOTÉNCATL">XICOTÉNCATL</option>
                            <option value="LLERA">LLERA</option>
                            <option value="TULA">TULA</option>
                            <option value="SOTO LA MARINA">SOTO LA MARINA</option>
                            <option value="JAUMAVE">JAUMAVE</option>
                            <option value="PADILLA">PADILLA</option>
                            <option value="HIDALGO">HIDALGO</option>
                            <option value="VILLAGRÁN">VILLAGRÁN</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="clave_juzgado">CVE JUZGADO</label>
                        <select name="clave_juzgado" id="clave_juzgado" required>
                            <option value="">Seleccionar...</option>
                            @for($i = 1; $i <= 200; $i++)
                                <option value="{{ $i }}">{{ str_pad($i, 3, '0', STR_PAD_LEFT) }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="juzgado">JUZGADO</label>
                        <select name="juzgado" id="juzgado" required>
                            <option value="">Seleccionar...</option>
                            <option value="JUZGADO PRIMERO CIVIL">JUZGADO PRIMERO CIVIL</option>
                            <option value="JUZGADO SEGUNDO CIVIL">JUZGADO SEGUNDO CIVIL</option>
                            <option value="JUZGADO TERCERO CIVIL">JUZGADO TERCERO CIVIL</option>
                            <option value="JUZGADO CUARTO CIVIL">JUZGADO CUARTO CIVIL</option>
                            <option value="JUZGADO QUINTO CIVIL">JUZGADO QUINTO CIVIL</option>
                            <option value="JUZGADO SEXTO CIVIL">JUZGADO SEXTO CIVIL</option>
                            <option value="JUZGADO PRIMERO FAMILIAR">JUZGADO PRIMERO FAMILIAR</option>
                            <option value="JUZGADO SEGUNDO FAMILIAR">JUZGADO SEGUNDO FAMILIAR</option>
                            <option value="JUZGADO TERCERO FAMILIAR">JUZGADO TERCERO FAMILIAR</option>
                            <option value="JUZGADO CUARTO FAMILIAR">JUZGADO CUARTO FAMILIAR</option>
                            <option value="JUZGADO PRIMERO PENAL">JUZGADO PRIMERO PENAL</option>
                            <option value="JUZGADO SEGUNDO PENAL">JUZGADO SEGUNDO PENAL</option>
                            <option value="JUZGADO TERCERO PENAL">JUZGADO TERCERO PENAL</option>
                            <option value="JUZGADO PRIMERO MENOR">JUZGADO PRIMERO MENOR</option>
                            <option value="JUZGADO SEGUNDO MENOR">JUZGADO SEGUNDO MENOR</option>
                            <option value="JUZGADO TERCERO MENOR">JUZGADO TERCERO MENOR</option>
                            <option value="JUZGADO CUARTO MENOR">JUZGADO CUARTO MENOR</option>
                            <option value="JUZGADO QUINTO MENOR">JUZGADO QUINTO MENOR</option>
                            <option value="JUZGADO ESPECIALIZADO EN JUSTICIA PARA ADOLESCENTES">JUZGADO ESPECIALIZADO EN JUSTICIA PARA ADOLESCENTES</option>
                            <option value="JUZGADO DE EJECUCIONES SANCIONES">JUZGADO DE EJECUCIONES SANCIONES</option>
                            <option value="SALA REGIONAL ALTAMIRA">SALA REGIONAL ALTAMIRA</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="materia">MATERIA</label>
                        <select name="materia" id="materia" required>
                            <option value="">Seleccionar...</option>
                            <option value="CIVIL">CIVIL</option>
                            <option value="FAMILIAR">FAMILIAR</option>
                            <option value="PENAL">PENAL</option>
                            <option value="MIXTO">MIXTO</option>
                            <option value="ADOLESCENTES">ADOLESCENTES</option>
                            <option value="EJECUCIONES">EJECUCIONES</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="juez_id">JUEZ RESPONSABLE</label>
                        <select name="juez_id" id="juez_id">
                            <option value="">Seleccionar juez...</option>
                            @if(isset($jueces))
                                @foreach($jueces as $juez)
                                    <option value="{{ $juez->id }}">{{ $juez->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="estado_tiempo">ESTADO DE PUBLICACIÓN</label>
                        <select name="estado_tiempo" id="estado_tiempo" required>
                            <option value="A_TIEMPO">✓ A TIEMPO (Antes de las 15:00)</option>
                            <option value="DESTIEMPO">✗ DESTIEMPO (Después de las 15:00)</option>
                        </select>
                    </div>
                

                    
                    


                </div>

                <!-- Campo oculto para el número de acuerdo (se generará automáticamente) -->
                <input type="hidden" name="acuerdo" value="{{ date('Y-m-d H:i:s') }}">

                <button type="submit" class="btn-register">
                    <span>✓</span> Liberar Lista de Acuerdos
                </button>
            </form>
        </div>

        <!-- Tabla de acuerdos publicados -->
        <div class="table-container">
            <div class="table-header">
                <h3 class="table-title">Total de Acuerdos Publicados</h3>
                <div class="table-date">
                    Fecha de Impresión: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
                </div>
            </div>

            @if($acuerdos->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>MUNICIPIO</th>
                            <th>CVE JUZGADO</th>
                            <th>JUZGADO</th>
                            <th>MATERIA</th>
                            <th>ESTADO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($acuerdos as $acuerdo)
                            <tr>
                                <td><span class="municipio-tag">{{ $acuerdo->municipio }}</span></td>
                                <td><span class="clave-tag">{{ str_pad($acuerdo->clave_juzgado, 3, '0', STR_PAD_LEFT) }}</span></td>
                                <td>{{ $acuerdo->juzgado }}</td>
                                <td><span class="materia-tag">{{ $acuerdo->materia }}</span></td>
                                <td>
                                    @if($acuerdo->estado_tiempo == 'A_TIEMPO')
                                        <span style="color: #27ae60; font-weight: 600;">✓ A TIEMPO</span>
                                    @else
                                        <span style="color: #e74c3c; font-weight: 600;">✗ DESTIEMPO</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <div class="empty-icon">📋</div>
                    <h3>No hay acuerdos publicados</h3>
                    <p>Utiliza el formulario superior para liberar la lista de acuerdos del día</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>