<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Control de Permanencias - Sistema de Estímulos</title>
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

        /* Header */
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

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-icon {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .header-title {
            font-size: 24px;
            font-weight: 500;
        }

        .btn-dashboard {
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-dashboard:hover {
            background: rgba(255,255,255,0.3);
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* Formulario de registro */
        .register-form {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .form-title {
            font-size: 18px;
            color: #2a5298;
            margin-bottom: 20px;
            font-weight: 600;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 10px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
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

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 10px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #2a5298;
            box-shadow: 0 0 0 3px rgba(42, 82, 152, 0.1);
        }

        .radio-group {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .radio-group label {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
            color: #333;
            font-weight: normal;
            text-transform: none;
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
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
        }

        /* Tabla de permanencias */
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
            font-size: 12px;
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

        .employee-number {
            background: #e3f2fd;
            color: #1976d2;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
        }

        .permanence-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .permanence-badge.si {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .permanence-badge.no {
            background: #ffebee;
            color: #c62828;
        }

        .juzgado-badge {
            background: #fff3e0;
            color: #f57c00;
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 11px;
        }

        .success-message {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #4caf50;
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
                <div class="header-icon">📊</div>
                <h1 class="header-title">Control de Permanencias</h1>
            </div>
            <a href="{{ route('dashboard') }}" class="btn-dashboard">← Volver al Dashboard</a>
        </div>
    </header>

    <div class="container">
        @if(session('success'))
            <div class="success-message">
                ✅ {{ session('success') }}
            </div>
        @endif

        <!-- Formulario de registro de permanencia -->
        <div class="register-form">
            <h3 class="form-title">📝 Registrar Nueva Verificación de Permanencia</h3>
            
            <form action="{{ route('permanencias.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nombre_juez">Nombre del Juez *</label>
                        <select name="nombre_juez" id="nombre_juez" required>
                            <option value="">Seleccionar juez...</option>
                            @if(isset($jueces))
                                @foreach($jueces as $juez)
                                    <option value="{{ $juez->name }}">{{ $juez->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="adscripcion">Adscripción (Juzgado) *</label>
                        <select name="adscripcion" id="adscripcion" required>
                            <option value="">Seleccionar juzgado...</option>
                            <option value="JUZGADO PRIMERO CIVIL">JUZGADO PRIMERO CIVIL</option>
                            <option value="JUZGADO SEGUNDO CIVIL">JUZGADO SEGUNDO CIVIL</option>
                            <option value="JUZGADO TERCERO CIVIL">JUZGADO TERCERO CIVIL</option>
                            <option value="JUZGADO CUARTO CIVIL">JUZGADO CUARTO CIVIL</option>
                            <option value="JUZGADO QUINTO CIVIL">JUZGADO QUINTO CIVIL</option>
                            <option value="JUZGADO PRIMERO FAMILIAR">JUZGADO PRIMERO FAMILIAR</option>
                            <option value="JUZGADO SEGUNDO FAMILIAR">JUZGADO SEGUNDO FAMILIAR</option>
                            <option value="JUZGADO TERCERO FAMILIAR">JUZGADO TERCERO FAMILIAR</option>
                            <option value="JUZGADO PRIMERO PENAL">JUZGADO PRIMERO PENAL</option>
                            <option value="JUZGADO SEGUNDO PENAL">JUZGADO SEGUNDO PENAL</option>
                            <option value="JUZGADO PRIMERO MENOR">JUZGADO PRIMERO MENOR</option>
                            <option value="JUZGADO SEGUNDO MENOR">JUZGADO SEGUNDO MENOR</option>
                            <option value="JUZGADO ESPECIALIZADO EN JUSTICIA PARA ADOLESCENTES">JUZGADO ESPECIALIZADO EN JUSTICIA PARA ADOLESCENTES</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fecha">Fecha de Verificación *</label>
                        <input type="date" name="fecha" id="fecha" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="form-group">
                        <label>¿El juez permanece en su lugar de trabajo? *</label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="permanencia" value="Sí" required>
                                <span>✅ Sí</span>
                            </label>
                            <label>
                                <input type="radio" name="permanencia" value="No" required>
                                <span>❌ No</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label for="observacion">Observaciones (Opcional)</label>
                        <textarea name="observacion" id="observacion" rows="3" 
                                  placeholder="Ingrese cualquier observación relevante..."></textarea>
                    </div>
                </div>

                <button type="submit" class="btn-register">
                    ✓ Registrar Permanencia
                </button>
            </form>
        </div>

        <!-- Tabla de registros -->
        <div class="table-container">
            <div class="table-header">
                <h3 class="table-title">📋 Registros de Permanencia</h3>
                <span style="font-size: 14px; color: #666;">
                    Total: {{ $registros->count() }} registros
                </span>
            </div>

            @if($registros->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>No. Emp</th>
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
                                <td>{{ $registro->nombre_juez }}</td>
                                <td>
                                    <span class="juzgado-badge">{{ $registro->adscripcion }}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y') }}</td>
                                <td>
                                    <span class="permanence-badge {{ strtolower($registro->permanencia) == 'sí' ? 'si' : 'no' }}">
                                        {{ $registro->permanencia }}
                                    </span>
                                </td>
                                <td>{{ $registro->observacion ?: '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <div style="font-size: 64px; margin-bottom: 20px;">📭</div>
                    <h3>No hay registros de permanencia</h3>
                    <p>Utiliza el formulario superior para registrar verificaciones de permanencia</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>