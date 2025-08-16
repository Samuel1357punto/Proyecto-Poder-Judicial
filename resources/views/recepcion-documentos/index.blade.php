<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calificaciones de Jueces - Sistema de Estímulos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary: #1e3c72;
            --primary-dark: #2a5298;
            --bg-beige: #d4c4a0;
            --bg-beige-light: #e8dcc0;
            --border-red: #c05060;
            --text-dark: #333;
            --success: #27ae60;
        }

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
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 20px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
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

        .header-subtitle {
            font-size: 13px;
            opacity: 0.9;
            margin-top: 3px;
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

        /* Container principal */
        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* Selector de Juez */
        .judge-selector {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .judge-selector h3 {
            color: var(--primary);
            margin-bottom: 15px;
            font-size: 18px;
        }

        .selector-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 15px;
            align-items: end;
        }

        .selector-grid select,
        .selector-grid input {
            padding: 10px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
        }

        .btn-load {
            background: var(--primary-dark);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-load:hover {
            background: var(--primary);
        }

        /* Grid principal */
        .main-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .left-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .right-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Secciones */
        .section {
            background: var(--bg-beige);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .section-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid rgba(0,0,0,0.1);
        }

        /* Inputs y campos calculados */
        input[type="number"],
        input[type="text"] {
            padding: 8px 12px;
            border: 1px solid #999;
            border-radius: 4px;
            width: 80px;
            font-size: 13px;
        }

        input[type="number"]:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(30, 60, 114, 0.1);
        }

        .readonly-field {
            background: white;
            border: 2px solid var(--border-red);
            padding: 8px 12px;
            border-radius: 4px;
            width: 80px;
            font-size: 13px;
            text-align: center;
            font-weight: 600;
            color: var(--primary);
        }

        /* Tabla de datos */
        .data-table {
            width: 100%;
            margin-top: 10px;
        }

        .data-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            font-size: 11px;
            color: var(--text-dark);
            font-weight: 600;
            text-align: center;
            padding: 8px 5px;
            border-bottom: 2px solid #999;
            background: rgba(255,255,255,0.5);
        }

        .data-table td {
            padding: 8px 5px;
            text-align: center;
        }

        .data-table .row-label {
            text-align: left;
            font-size: 12px;
            font-weight: 500;
            color: var(--text-dark);
        }

        /* Indicadores de cumplimiento */
        .indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-left: 5px;
        }

        .indicator.good {
            background: var(--success);
        }

        .indicator.warning {
            background: #f39c12;
        }

        .indicator.bad {
            background: #e74c3c;
        }

        /* Checkbox */
        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        /* Panel de totales */
        .totals-panel {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 25px;
            border-radius: 12px;
            margin-top: 20px;
        }

        .totals-panel h3 {
            font-size: 18px;
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.3);
            padding-bottom: 10px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .total-label {
            font-size: 14px;
        }

        .total-value {
            font-size: 20px;
            font-weight: 700;
        }

        .total-value.main {
            font-size: 28px;
            color: #ffd700;
        }

        /* Botones de acción */
        .actions {
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

        .btn-save {
            background: var(--success);
            color: white;
        }

        .btn-save:hover {
            background: #229954;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(39, 174, 96, 0.3);
        }

        .btn-calculate {
            background: var(--primary-dark);
            color: white;
        }

        .btn-calculate:hover {
            background: var(--primary);
        }

        /* Grid responsive */
        @media (max-width: 768px) {
            .main-grid {
                grid-template-columns: 1fr;
            }

            .selector-grid {
                grid-template-columns: 1fr;
            }

            input[type="number"],
            .readonly-field {
                width: 60px;
            }
        }

        /* Inline groups */
        .inline-group {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .inline-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .inline-item label {
            font-size: 12px;
            min-width: 80px;
            color: var(--text-dark);
        }

        /* Info message */
        .info-message {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 14px;
            color: #1565c0;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <div class="header-left">
                <div class="header-icon">📊</div>
                <div>
                    <h1 class="header-title">Calificaciones de Jueces</h1>
                    <p class="header-subtitle">Sistema de Estímulos y Evaluación del Desempeño</p>
                    
                </div>
            </div>
            <a href="{{ route('dashboard') }}" class="btn-dashboard">← Volver al Dashboard</a>
        </div>
    </div>

    <div class="container">
        <!-- Selector de Juez y Periodo -->
        <div class="judge-selector">
            <h3>Seleccionar Juez y Periodo de Evaluación</h3>
            <div class="selector-grid">
                <select id="select-juez">
                    <option value="">-- Seleccionar Juez --</option>
                    @if(isset($jueces))
                        @foreach($jueces as $juez)
                            <option value="{{ $juez->id }}">{{ $juez->name }}</option>
                        @endforeach
                    @endif
                </select>
                <input type="month" id="periodo" value="{{ date('Y-m') }}">
                <button class="btn-load" onclick="cargarDatos()">Cargar Datos</button>
            </div>
        </div>

        <div class="info-message">
            <strong>ℹ️ Información:</strong> Los campos con borde rojo se calculan automáticamente. 
            Si no existen datos previos, se mostrarán en 0.
        </div>

        <form id="formCalificaciones" action="{{ route('recepcion-documentos.store') }}" method="POST">
            @csrf
            <input type="hidden" name="juez_id" id="juez_id">
            <input type="hidden" name="periodo" id="periodo_hidden">

            <div class="main-grid">
                <!-- Columna Izquierda -->
                <div class="left-column">
                    <!-- Puntualidad y Permanencia -->
                    <div class="section">
                        <h3 class="section-title">Puntualidad y Permanencia</h3>
                        <div class="inline-group">
                            <div class="inline-item">
                                <label>Permanencia</label>
                                <input type="number" name="permanencia" id="permanencia" min="0" value="0">
                            </div>
                            <div class="inline-item">
                                <label>Puntualidad</label>
                                <input type="number" name="puntualidad" id="puntualidad" min="0" value="0">
                            </div>
                        </div>
                        <div class="inline-group" style="margin-top: 10px;">
                            <div class="inline-item">
                                <label>Puntos</label>
                                <input type="text" name="puntos_permanencia" class="readonly-field" id="puntos_permanencia" readonly value="0">
                            </div>
                            <div class="inline-item">
                                <label>Puntos</label>
                                <input type="text" name="puntos_puntualidad" class="readonly-field" id="puntos_puntualidad" readonly value="0">
                            </div>
                        </div>
                        <div style="text-align: right; margin-top: 15px;">
                            <label style="margin-right: 10px;">Suma Puntos</label>
                            <input type="text" name="puntos_total_permanencia" class="readonly-field" id="suma_puntos_pp" readonly style="width: 100px;" value="0">
                        </div>
                    </div>

                    <!-- Radicaciones, Sentencias, Órdenes y Recursos -->
                    <div class="section">
                        <h3 class="section-title">Radicaciones, Sentencias, Órdenes y Recursos</h3>
                        <div class="data-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Destiempo<br>Normal</th>
                                        <th>Dest.<br>Acumulado</th>
                                        <th>Total<br>Destiempo</th>
                                        <th>Total</th>
                                        <th>%Cumplimiento</th>
                                        <th>Puntos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="row-label">Radicaciones</td>
                                        <td><input type="number" name="radicaciones_dest_normal" id="rad_dn" min="0" value="0"></td>
                                        <td><input type="number" name="radicaciones_dest_acumulado" id="rad_da" min="0" value="0"></td>
                                        <td><input type="text" name="radicaciones_total_dest" class="readonly-field" id="rad_td" readonly value="0"></td>
                                        <td><input type="number" name="radicaciones_total" id="rad_total" min="0" value="0"></td>
                                        <td><input type="text" name="radicaciones_cumplimiento" class="readonly-field" id="rad_porc" readonly value="0%"></td>
                                        <td><input type="text" name="radicaciones_puntos" class="readonly-field" id="rad_puntos" readonly value="0"></td>
                                    </tr>
                                    <tr>
                                        <td class="row-label">Sentencias</td>
                                        <td><input type="number" name="sentencias_dest_normal" id="sen_dn" min="0" value="0"></td>
                                        <td><input type="number" name="sentencias_dest_acumulado" id="sen_da" min="0" value="0"></td>
                                        <td><input type="text" name="sentencias_total_dest" class="readonly-field" id="sen_td" readonly value="0"></td>
                                        <td><input type="number" name="sentencias_total" id="sen_total" min="0" value="0"></td>
                                        <td><input type="text" name="sentencias_cumplimiento" class="readonly-field" id="sen_porc" readonly value="0%"></td>
                                        <td><input type="text" name="sentencias_puntos" class="readonly-field" id="sen_puntos" readonly value="0"></td>
                                    </tr>
                                    <tr>
                                        <td class="row-label">Órdenes</td>
                                        <td><input type="number" name="ordenes_dest_normal" id="ord_dn" min="0" value="0"></td>
                                        <td><input type="number" name="ordenes_dest_acumulado" id="ord_da" min="0" value="0"></td>
                                        <td><input type="text" name="ordenes_total_dest" class="readonly-field" id="ord_td" readonly value="0"></td>
                                        <td><input type="number" name="ordenes_total" id="ord_total" min="0" value="0"></td>
                                        <td><input type="text" name="ordenes_cumplimiento" class="readonly-field" id="ord_porc" readonly value="0%"></td>
                                        <td><input type="text" name="ordenes_puntos" class="readonly-field" id="ord_puntos" readonly value="0"></td>
                                    </tr>
                                    <tr>
                                        <td class="row-label">Recursos</td>
                                        <td><input type="number" name="recursos_dest_normal" id="rec_dn" min="0" value="0"></td>
                                        <td><input type="number" name="recursos_dest_acumulado" id="rec_da" min="0" value="0"></td>
                                        <td><input type="text" name="recursos_total_dest" class="readonly-field" id="rec_td" readonly value="0"></td>
                                        <td><input type="number" name="recursos_total" id="rec_total" min="0" value="0"></td>
                                        <td><input type="text" name="recursos_cumplimiento" class="readonly-field" id="rec_porc" readonly value="0%"></td>
                                        <td><input type="text" name="recursos_puntos" class="readonly-field" id="rec_puntos" readonly value="0"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="text-align: right; margin-top: 15px;">
                            <label style="margin-right: 10px;">Suma Puntos</label>
                            <input type="text" name="puntos_total_radicaciones" class="readonly-field" id="suma_puntos_rad" readonly style="width: 100px;" value="0">
                        </div>
                    </div>

                    <!-- Resultados en Segunda Instancia -->
                    <div class="section">
                        <h3 class="section-title">Resultados en Segunda Instancia</h3>
                        <div style="display: flex; gap: 15px; align-items: center; margin-bottom: 15px;">
                            <label style="font-size: 12px;">Resoluciones</label>
                            <div style="display: flex; gap: 10px;">
                                <div>
                                    <label style="font-size: 11px;">Confirmadas</label>
                                    <input type="number" name="resoluciones_confirmadas" id="res_conf" min="0" value="0">
                                </div>
                                <div>
                                    <label style="font-size: 11px;">Modificadas</label>
                                    <input type="number" name="resoluciones_modificadas" id="res_mod" min="0" value="0">
                                </div>
                                <div>
                                    <label style="font-size: 11px;">Revocadas</label>
                                    <input type="number" name="resoluciones_revocadas" id="res_rev" min="0" value="0">
                                </div>
                                <div>
                                    <label style="font-size: 11px;">Tot. Resoluciones</label>
                                    <input type="text" name="total_resoluciones" class="readonly-field" id="res_total" readonly value="0">
                                </div>
                            </div>
                            <div style="margin-left: auto;">
                                <label style="font-size: 11px;">Suma de puntos</label>
                                <input type="text" name="puntos_resultados" class="readonly-field" id="suma_puntos_res" readonly value="0">
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 15px; align-items: center; margin-bottom: 10px;">
                            <label style="font-size: 12px;">%</label>
                            <input type="text" class="readonly-field" id="res_porc_conf" readonly value="0%" style="width: 60px;">
                            <label style="font-size: 11px; margin-left: 20px;">Resultados 2 Inst</label>
                        </div>

                        <div style="display: flex; gap: 15px; align-items: center; margin-top: 20px;">
                            <label style="font-size: 12px;">Amparos</label>
                            <div style="display: flex; gap: 10px;">
                                <div>
                                    <label style="font-size: 11px;">Neg o Sob</label>
                                    <input type="number" name="amparos_negados" id="amp_neg" min="0" value="0">
                                </div>
                                <div>
                                    <label style="font-size: 11px;">Concedidos</label>
                                    <input type="number" name="amparos_concedidos" id="amp_con" min="0" value="0">
                                </div>
                                <div>
                                    <label style="font-size: 11px;">Tot. Amparos</label>
                                    <input type="text" name="total_amparos" class="readonly-field" id="amp_total" readonly value="0">
                                </div>
                            </div>
                            <div style="margin-left: auto;">
                                <input type="text" class="readonly-field" id="puntos_amparos" readonly value="0">
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 15px; align-items: center; margin-top: 10px;">
                            <label style="font-size: 12px;">%</label>
                            <input type="text" class="readonly-field" id="amp_porc_neg" readonly value="0%" style="width: 60px;">
                            <label style="font-size: 11px; margin-left: 20px;">Calidad Amparos</label>
                            <input type="text" name="calidad_amparos" class="readonly-field" id="calidad_amparos" readonly value="0%" style="margin-left: 10px; width: 60px;">
                        </div>
                    </div>
                </div>

                <!-- Columna Derecha -->
                <div class="right-column">
                    <!-- Carga de trabajo -->
                    <div class="section">
                        <h3 class="section-title">Carga de Trabajo</h3>
                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <label style="font-size: 12px; width: 60px;">Categoría</label>
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <label style="font-size: 12px; width: 20px;">A</label>
                                <input type="number" name="categoria_a" id="cat_a" min="0" value="0">
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <label style="font-size: 12px; width: 20px;">B</label>
                                <input type="number" name="categoria_b" id="cat_b" min="0" value="0">
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <label style="font-size: 12px; width: 20px;">C</label>
                                <input type="number" name="categoria_c" id="cat_c" min="0" value="0">
                            </div>
                        </div>
                        <div style="text-align: right; margin-top: 15px;">
                            <label style="margin-right: 10px; font-size: 12px;">Suma Puntos</label>
                            <input type="text" name="puntos_carga_trabajo" class="readonly-field" id="suma_puntos_carga" readonly value="0">
                        </div>
                    </div>

                    <!-- Remisión de Listas de Acuerdo -->
                    <div class="section">
                        <h3 class="section-title">Remisión de Listas de Acuerdo</h3>
                        <div style="display: flex; gap: 10px; margin-bottom: 10px;">
                            <div>
                                <label style="font-size: 11px;">En tiempo</label>
                                <input type="number" name="listas_en_tiempo" id="listas_tiempo" min="0" value="0">
                            </div>
                            <div>
                                <label style="font-size: 11px;">Destiempo</label>
                                <input type="number" name="listas_dest_tiempo" id="listas_dest" min="0" value="0">
                            </div>
                            <div>
                                <label style="font-size: 11px;">Total</label>
                                <input type="text" name="listas_total" class="readonly-field" id="listas_total" readonly value="0">
                            </div>
                        </div>
                        <div style="margin-bottom: 10px;">
                            <label style="font-size: 11px;">%cumplimiento</label>
                            <input type="text" name="listas_cumplimiento" class="readonly-field" id="listas_porc" readonly style="width: 80px;" value="0%">
                        </div>
                        <div style="text-align: right;">
                            <label style="margin-right: 10px; font-size: 12px;">Suma Puntos</label>
                            <input type="text" name="listas_puntos" class="readonly-field" id="suma_puntos_listas" readonly value="0">
                        </div>
                    </div>

                    <!-- Percepción por Destino -->
                    <div class="section">
                        <h3 class="section-title">Percepción por Destino</h3>
                        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                            <label style="font-size: 12px;">Reside fuera de dom</label>
                            <input type="checkbox" name="reside_fuera_dom" id="reside_fuera" value="Sí">
                        </div>
                        <div style="text-align: right;">
                            <label style="margin-right: 10px; font-size: 12px;">Suma Puntos</label>
                            <input type="text" name="puntos_percepcion" class="readonly-field" id="suma_puntos_destino" readonly value="0">
                        </div>
                    </div>

                    <!-- Panel de Totales -->
                    <div class="totals-panel">
                        <h3>Evaluación Total</h3>
                        
                        <div class="total-row">
                            <span class="total-label">Total de Puntos:</span>
                            <span class="total-value main" id="total_puntos_display">0</span>
                            <input type="hidden" name="total_puntos" id="total_puntos" value="0">
                        </div>
                        
                        
                        
                        <div class="total-row">
                            <span class="total-label">Importe:</span>
                            <span class="total-value">$<span id="importe_display">0.00</span></span>
                            <input type="hidden" name="importe" id="importe" value="0">
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <script>
        // Función para cargar datos del juez seleccionado
        function cargarDatos() {
            const juezId = document.getElementById('select-juez').value;
            const periodo = document.getElementById('periodo').value;
            
            if (!juezId) {
                alert('Por favor seleccione un juez');
                return;
            }
            
            document.getElementById('juez_id').value = juezId;
            document.getElementById('periodo_hidden').value = periodo;
            
            // Mostrar indicador de carga
            const btnLoad = document.querySelector('.btn-load');
            btnLoad.textContent = 'Cargando...';
            btnLoad.disabled = true;
            
            // Hacer petición AJAX para cargar datos
            fetch('{{ route("calificaciones.cargar-datos") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    juez_id: juezId,
                    periodo: periodo
                })
            })
            .then(response => response.json())
            .then(data => {
                // Cargar datos de puntualidad y permanencia
                document.getElementById('puntualidad').value = data.puntualidad || 0;
                document.getElementById('permanencia').value = data.permanencia || 0;
                
                // Cargar listas de acuerdos
                document.getElementById('listas_tiempo').value = data.listas_en_tiempo || 0;
                document.getElementById('listas_dest').value = data.listas_destiempo || 0;
                
                // Si existe evaluación previa, cargar todos los campos
                if (data.evaluacion_existente) {
                    // Cargar todos los campos de la evaluación existente
                    for (let key in data.evaluacion_existente) {
                        const elemento = document.getElementById(key);
                        if (elemento) {
                            elemento.value = data.evaluacion_existente[key] || 0;
                        }
                    }
                    
                    // Mostrar mensaje de que se cargó una evaluación existente
                    alert('Se cargó una evaluación existente para este periodo. Puede modificarla si es necesario.');
                } else {
                    // Mensaje informativo
                    alert(`Datos cargados:\n` +
                          `- Puntualidad: ${data.puntualidad} de ${data.total_entradas} entradas\n` +
                          `- Permanencia: ${data.permanencia} de ${data.total_permanencias} verificaciones\n` +
                          `- Listas a tiempo: ${data.listas_en_tiempo}\n` +
                          `- Listas a destiempo: ${data.listas_destiempo}`);
                }
                
                // Recalcular todo
                calcularTodo();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al cargar los datos. Por favor intente nuevamente.');
            })
            .finally(() => {
                btnLoad.textContent = 'Cargar Datos';
                btnLoad.disabled = false;
            });
        }

        // Función para obtener valor numérico
        function getVal(id) {
            const val = parseFloat(document.getElementById(id).value) || 0;
            return val;
        }

        // Función para establecer valor
        function setVal(id, value) {
            const el = document.getElementById(id);
            if (el) {
                if (typeof value === 'number') {
                    el.value = isNaN(value) ? 0 : value.toFixed(2);
                } else {
                    el.value = value;
                }
            }
        }

        // Función principal de cálculo
        function calcularTodo() {
            // 1. Puntualidad y Permanencia
            const permanencia = getVal('permanencia');
            const puntualidad = getVal('puntualidad');
            const puntosPerm = permanencia * 1;
            const puntosPunt = puntualidad * 1;
            
            setVal('puntos_permanencia', puntosPerm);
            setVal('puntos_puntualidad', puntosPunt);
            setVal('suma_puntos_pp', puntosPerm + puntosPunt);

            // 2. Radicaciones, Sentencias, Órdenes y Recursos
            let sumaPuntosRad = 0;
            const items = ['rad', 'sen', 'ord', 'rec'];
            
            items.forEach(item => {
                const dn = getVal(item + '_dn');
                const da = getVal(item + '_da');
                const totalDest = dn + da;
                const total = getVal(item + '_total');
                
                setVal(item + '_td', totalDest);
                
                let porc = 0;
                if (total > 0 && totalDest > 0) {
                    porc = ((total - totalDest) / total) * 100;
                    if (porc < 0) porc = 0;
                } else if (total > 0 && totalDest === 0) {
                    porc = 100;
                }
                
                const puntos = Math.round(porc / 10);
                
                setVal(item + '_porc', porc.toFixed(1) + '%');
                setVal(item + '_puntos', puntos);
                sumaPuntosRad += puntos;
            });
            
            setVal('suma_puntos_rad', sumaPuntosRad);

            // 3. Carga de trabajo
            const catA = getVal('cat_a');
            const catB = getVal('cat_b');
            const catC = getVal('cat_c');
            const sumaCarga = catA + catB + catC;
            setVal('suma_puntos_carga', sumaCarga);

            // 4. Remisión de Listas
            const listasTiempo = getVal('listas_tiempo');
            const listasDest = getVal('listas_dest');
            const listasTotal = listasTiempo + listasDest;
            let listasPorc = 0;
            if (listasTotal > 0) {
                listasPorc = (listasTiempo / listasTotal) * 100;
            }
            const puntosListas = Math.round(listasPorc / 10);
            
            setVal('listas_total', listasTotal);
            setVal('listas_porc', listasPorc.toFixed(1) + '%');
            setVal('suma_puntos_listas', puntosListas);

            // 5. Percepción por Destino
            const resideFuera = document.getElementById('reside_fuera').checked;
            const puntosDestino = resideFuera ? 5 : 0;
            setVal('suma_puntos_destino', puntosDestino);

            // 6. Resultados en Segunda Instancia
            const resConf = getVal('res_conf');
            const resMod = getVal('res_mod');
            const resRev = getVal('res_rev');
            const resTotal = resConf + resMod + resRev;
            let resPorcConf = 0;
            if (resTotal > 0) {
                resPorcConf = (resConf / resTotal) * 100;
            }
            const puntosRes = Math.round(resPorcConf / 10);
            
            setVal('res_total', resTotal);
            setVal('res_porc_conf', resPorcConf.toFixed(1) + '%');
            setVal('suma_puntos_res', puntosRes);

            // 7. Amparos
            const ampNeg = getVal('amp_neg');
            const ampCon = getVal('amp_con');
            const ampTotal = ampNeg + ampCon;
            let ampPorcNeg = 0;
            let calidadAmparos = 0;
            if (ampTotal > 0) {
                ampPorcNeg = (ampNeg / ampTotal) * 100;
                calidadAmparos = 100 - ampPorcNeg;
            }
            const puntosAmparos = Math.round(ampPorcNeg / 10);
            
            setVal('amp_total', ampTotal);
            setVal('amp_porc_neg', ampPorcNeg.toFixed(1) + '%');
            setVal('calidad_amparos', calidadAmparos.toFixed(1) + '%');
            setVal('puntos_amparos', puntosAmparos);

            // 8. Total de puntos
            const totalPuntos = (puntosPerm + puntosPunt) + sumaPuntosRad + sumaCarga + 
                               puntosListas + puntosDestino + puntosRes + puntosAmparos;
            
            document.getElementById('total_puntos_display').textContent = totalPuntos;
            document.getElementById('total_puntos').value = totalPuntos;

            // 9. Importe (multiplicar por 100 como ejemplo)
            const importe = totalPuntos * 100;
            document.getElementById('importe_display').textContent = importe.toFixed(2);
            document.getElementById('importe').value = importe;

            // Mostrar mensaje de cálculo completado
            mostrarIndicadorCumplimiento(totalPuntos);
        }

        // Función para mostrar indicador visual de cumplimiento
        function mostrarIndicadorCumplimiento(puntos) {
            let mensaje = '';
            let color = '';
            
            if (puntos >= 80) {
                mensaje = '✅ Excelente desempeño';
                color = '#27ae60';
            } else if (puntos >= 60) {
                mensaje = '⚠️ Buen desempeño';
                color = '#f39c12';
            } else {
                mensaje = '❌ Necesita mejorar';
                color = '#e74c3c';
            }
            
            // Podrías mostrar un mensaje temporal
            console.log(mensaje);
        }

        // Función para resetear el formulario
        function resetearFormulario() {
            // Resetear todos los inputs a 0
            const inputs = document.querySelectorAll('input[type="number"]');
            inputs.forEach(input => {
                input.value = 0;
            });
            
            // Resetear campos calculados
            const readonlyFields = document.querySelectorAll('.readonly-field');
            readonlyFields.forEach(field => {
                field.value = field.id.includes('porc') || field.id.includes('calidad') ? '0%' : '0';
            });
            
            // Desmarcar checkbox
            document.getElementById('reside_fuera').checked = false;
            
            // Resetear displays
            document.getElementById('total_puntos_display').textContent = '0';
            document.getElementById('importe_display').textContent = '0.00';
        }

        // Event listeners al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            // Agregar listeners a los inputs numéricos para cálculo automático
            const inputs = document.querySelectorAll('input[type="number"]');
            inputs.forEach(input => {
                input.addEventListener('input', calcularTodo);
            });

            // Listener para el checkbox
            document.getElementById('reside_fuera').addEventListener('change', calcularTodo);

            // Listener para el formulario
            document.getElementById('formCalificaciones').addEventListener('submit', function(e) {
                const juezId = document.getElementById('juez_id').value;
                if (!juezId) {
                    e.preventDefault();
                    alert('Por favor seleccione un juez antes de guardar');
                    return false;
                }
                
                if (!confirm('¿Desea guardar la calificación del juez?')) {
                    e.preventDefault();
                    return false;
                }
            });

            // Calcular al cargar
            calcularTodo();
        });
    </script>
</body>
</html>