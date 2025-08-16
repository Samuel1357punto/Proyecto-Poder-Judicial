<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Nuevo Acuerdo - Sistema Judicial</title>
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

        .header {
            background: linear-gradient(135deg, #aa2b48 0%, #8a2037 100%);
            color: white;
            padding: 20px 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-title {
            font-size: 24px;
            font-weight: 500;
        }

        .btn-back {
            background: rgba(255,255,255,0.15);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-back:hover {
            background: rgba(255,255,255,0.25);
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .form-card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .form-title {
            font-size: 28px;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
        }

        input[type="text"],
        select,
        textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #aa2b48;
            box-shadow: 0 0 0 3px rgba(170, 43, 72, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 40px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #aa2b48 0%, #8a2037 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(170, 43, 72, 0.3);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .error-message {
            color: #f44336;
            font-size: 12px;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <h1 class="header-title">📋 Crear Nuevo Acuerdo</h1>
            <a href="{{ route('acuerdos.index') }}" class="btn-back">
                ← Volver a Acuerdos
            </a>
        </div>
    </header>

    <div class="container">
        <div class="form-card">
            <h2 class="form-title">Registro de Nuevo Acuerdo Judicial</h2>

            @if ($errors->any())
                <div style="background: #ffebee; color: #c62828; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('acuerdos.store') }}" method="POST">
                @csrf
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="municipio">Municipio *</label>
                        <select name="municipio" id="municipio" required>
                            <option value="">Seleccionar municipio...</option>
                            <option value="Victoria">Victoria</option>
                            <option value="Tampico">Tampico</option>
                            <option value="Reynosa">Reynosa</option>
                            <option value="Matamoros">Matamoros</option>
                            <option value="Nuevo Laredo">Nuevo Laredo</option>
                            <option value="Ciudad Madero">Ciudad Madero</option>
                            <option value="Altamira">Altamira</option>
                            <option value="Río Bravo">Río Bravo</option>
                        </select>
                        @error('municipio')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="clave_juzgado">Clave del Juzgado *</label>
                        <input type="text" name="clave_juzgado" id="clave_juzgado" 
                               value="{{ old('clave_juzgado') }}" 
                               placeholder="Ej: JUZ-001" required>
                        @error('clave_juzgado')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="juzgado">Nombre del Juzgado *</label>
                    <input type="text" name="juzgado" id="juzgado" 
                           value="{{ old('juzgado') }}" 
                           placeholder="Ej: Juzgado Primero Civil" required>
                    @error('juzgado')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="materia">Materia *</label>
                    <select name="materia" id="materia" required>
                        <option value="">Seleccionar materia...</option>
                        <option value="Civil">Civil</option>
                        <option value="Familiar">Familiar</option>
                        <option value="Penal">Penal</option>
                        <option value="Mercantil">Mercantil</option>
                        <option value="Laboral">Laboral</option>
                        <option value="Administrativo">Administrativo</option>
                    </select>
                    @error('materia')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="acuerdo">Descripción del Acuerdo *</label>
                    <textarea name="acuerdo" id="acuerdo" 
                              placeholder="Ingrese la descripción completa del acuerdo..." required>{{ old('acuerdo') }}</textarea>
                    @error('acuerdo')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">
                        ✅ Guardar Acuerdo
                    </button>
                    <a href="{{ route('acuerdos.index') }}" class="btn btn-secondary" style="text-decoration: none; display: inline-flex; align-items: center;">
                        ❌ Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>