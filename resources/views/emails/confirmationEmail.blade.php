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
            background-color: #f7faff;
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
            background-color: #d72b34;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        .header img {
            max-width: 50px;
        }
        .header h1 {
            margin: 10px 0 0 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .content img {
            max-width: 300px;
            margin: 20px 0;
        }
        .content h2 {
            font-size: 20px;
            color: #333333;
        }
        .content p {
            font-size: 16px;
            color: #666666;
            line-height: 1.5;
        }

        .content p span{
            font-size: 16px;
            color: #E62D37;
            line-height: 1.5;
        }
        .content a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #ea5058;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }

        .content a:hover {
            background-color: #E62D37;
            color: #ffffff;
            box-shadow: #333333 2px 2px 2px
            
        }
        .footer {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #666666;
        }
        .footer a {
            color: #E62D37;
            text-decoration: none;
        }
        .footer .social-icons img {
            max-width: 24px;
            margin: 0 10px;
        }
    </style>
</head>


<body>
    <div class="email-container">
        <div class="header">
            <img src="logo" alt="Education Online">
            <h1>Education Online</h1>
        </div>
        <div class="content">
            <img src="https://cachimbo.pe/wp-content/uploads/2022/11/1-8-1024x413.jpg" alt="vehiculo unamad">
            <h2>CONFIRMACIÓN DE CORREO ELECTRÓNICO</h2>
            <p>HOLA, {{  $user->nombre }}</p>
            <p>Su cuenta esta en estado: <span>{{ $mensaje }}</span>  </p>
        </div>
        <div class="footer">
            <p>Síguenos:</p>
            <div class="social-icons">
                <a href="#"><img src="facebook.png" alt="Facebook"></a>
                <a href="#"><img src="twitter.png" alt="Twitter"></a>
                <a href="#"><img src="instagram.png" alt="Instagram"></a>
                <a href="#"><img src="youtube.png" alt="YouTube"></a>
                <a href="#"><img src="linkedin.png" alt="LinkedIn"></a>
            </div>
            <p>Contáctanos: 123456789 | tu@correo.com</p>
            <p><a href="#">Cantar más fuerte</a> | <a href="#">Blog</a> | <a href="#">Sobre nosotros</a></p>
            <p>Este boletín diario fue enviado a info@name.com desde el nombre de la empresa porque usted se suscribió. Si no desea recibir este correo electrónico, cancele su suscripción <a href="#">aquí</a>.</p>
        </div>
    </div>
</body>

</html>
