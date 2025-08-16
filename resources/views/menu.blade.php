<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #003366;
            padding: 15px;
            text-align: center;
            color: #fff;
            font-size: 22px;
            font-weight: bold;
        }
        nav {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 30px;
            gap: 20px;
        }
        .menu-card {
            background-color: white;
            width: 220px;
            height: 140px;
            border-radius: 12px;
            text-align: center;
            padding: 25px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: #003366;
            font-weight: bold;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .menu-card:hover {
            background-color: #003366;
            color: white;
            transform: translateY(-5px);
            box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
        }
        footer {
            background-color: #003366;
            padding: 10px;
            text-align: center;
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <header>Menú Principal</header>

    <nav>
        <a href="{{ route('acuerdos.index') }}" class="menu-card">📜 Acuerdos</a>
        <a href="{{ route('asistencias.index') }}" class="menu-card">🗓 Asistencias</a>
        <a href="{{ route('permanencia.index') }}" class="menu-card">📈 Permanencia</a>
        <a href="{{ route('recepcion.documentos') }}" class="menu-card">📂 Recepción Documentos</a>
        <a href="{{ route('dashboard') }}" class="menu-card">📊 Dashboard</a>
    </nav>

    <footer>
        &copy; {{ date('Y') }} Sistema Judicial - Todos los derechos reservados
    </footer>

</body>
</html>
