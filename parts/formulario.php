<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con Archivo y WhatsApp</title>
</head>
<body>
    <section class="contacto_section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="mb-4 formulario">Envíanos tu datos y comprobante de pago</h3>
                 <form id="miFormulario" method="POST" action="/wp-content/themes/turifaideal/parts/procesar_formulario.php" enctype="multipart/form-data">
        <label for="nombre">Tu nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="email">Tu correo electrónico:</label>
        <input type="email" id="email" name="email" placeholder="ejemplo@gmail.com" required><br><br>

        <label for="asunto">Cédula:</label>
        <input type="number" id="cedula" name="cedula" required><br><br>
        
        <label for="numero">Número de telefono:</label>
        <input type="number" id="telefono" name="telefono" required><br><br>

        <label for="archivo">Adjunta el comprobante de pago:</label>
        <input type="file" id="archivo" name="archivo" accept="image/*" required><br><br>


        <button type="submit">Enviar</button>
    
                </form>   
                </div>
            </div>
        </div>
    </section>
