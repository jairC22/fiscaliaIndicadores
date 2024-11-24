<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Correo Electrónico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
        }
        .header {
            background-color: #1c2331;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        .header img {
            max-width: 70px;
        }
        .header h1 {
            margin: 10px 0;
            font-size: 22px;
        }
        .content {
            padding: 20px;
            text-align: left;
        }
        .content h2 {
            font-size: 18px;
            color: #333333;
        }
        .content p {
            font-size: 16px;
            color: #666666;
            line-height: 1.5;
        }
        .content a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #2535aa;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
        .content a:hover {
            background-color: #152B52;
        }
        .footer {
            background-color: #f4f4f4;
            padding: 15px;
            text-align: center;
            font-size: 14px;
            color: #666666;
        }
        .footer p {
            margin: 5px 0;
        }
        .footer a {
            color: #d32f2f;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="img/logo_fiscalia.png" alt="Ministerio Público">
            <h1>Ministerio Público - Fiscalía de la Nación</h1>
            <h2>Madre de Dios, Perú</h2>
        </div>
        <div class="content">
            <h2>Estimado(a): {{ $nombre }}</h2>
            <p>Correo registrado: <strong>{{ $gmail }}</strong></p>
            <p>Por medio del presente, le informamos que su cuenta ha sido registrada en el sistema del Ministerio Público - Fiscalía de la Nación.</p>
            <p>Para completar el proceso de validación y activar su cuenta, por favor haga clic en el botón a continuación:</p>
            <a href="{{ $verificationUrl }}">Confirmar Correo Electrónico</a>
            <p>Este enlace estará disponible hasta las 23:59 del <span id="fechaLimite"></span>.</p>
            <p>Si usted no solicitó este registro, por favor ignore este mensaje.</p>
            <p>Atentamente,<br>Ministerio Público - Fiscalía de la Nación<br>Madre de Dios, Perú</p>
        </div>
        <div class="footer">
            <p>Para más información, contáctenos:</p>
            <p>Teléfono: (51) 123-456-789 | Correo: soporte@fiscalia.gob.pe</p>
            <p>&copy; 2024 Ministerio Público - Fiscalía de la Nación, Madre de Dios.</p>
        </div>
    </div>
    <script>
        // Fecha límite para confirmar el correo
        const fechaLimite = new Date();
        fechaLimite.setDate(fechaLimite.getDate() + 2); // Agregar 2 días
        const opciones = { year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('fechaLimite').textContent = fechaLimite.toLocaleDateString('es-PE', opciones);
    </script>
</body>
</html>
