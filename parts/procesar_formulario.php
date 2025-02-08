<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $cedula = htmlspecialchars($_POST['cedula']);
    $telefono = htmlspecialchars($_POST['telefono']);

    // Validar y manejar el archivo adjunto
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        $archivoTmp = $_FILES['archivo']['tmp_name'];
        $archivoNombre = $_FILES['archivo']['name'];
        $archivoTipo = $_FILES['archivo']['type'];
        $archivoContenido = chunk_split(base64_encode(file_get_contents($archivoTmp)));
    } else {
        echo "Error al cargar el comprobante de pago.";
        exit;
    }

    // Configuración del correo
    $destinatario = "jose@turifaidealderwin.com	";
    $titulo = "Alguien ha comprado una rifa";
    $boundary = md5(time()); // Generar un identificador único para el correo

    // Cuerpo del correo
    $contenido = "Nombre: $nombre\n";
    $contenido .= "Correo: $email\n";
    $contenido .= "Cédula: $cedula\n";
    $contenido .= "Número de telefono: $telefono\n";



    // Cabeceras del correo
    $cabeceras = "From: $email\r\n";
    $cabeceras .= "Reply-To: $email\r\n";
    $cabeceras .= "MIME-Version: 1.0\r\n";
    $cabeceras .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

    // Mensaje con archivo adjunto
    $cuerpo = "--$boundary\r\n";
    $cuerpo .= "Content-Type: text/plain; charset=\"UTF-8\"\r\n";
    $cuerpo .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $cuerpo .= $contenido . "\r\n";
    $cuerpo .= "--$boundary\r\n";
    $cuerpo .= "Content-Type: $archivoTipo; name=\"$archivoNombre\"\r\n";
    $cuerpo .= "Content-Transfer-Encoding: base64\r\n";
    $cuerpo .= "Content-Disposition: attachment; filename=\"$archivoNombre\"\r\n\r\n";
    $cuerpo .= $archivoContenido . "\r\n";
    $cuerpo .= "--$boundary--";

    // Enviar el correo
    if (mail($destinatario, $titulo, $cuerpo, $cabeceras)) {
        header('Location: /'); // Redirige al home
        exit();
    } else {
        echo "Error al enviar el correo.";
    }
}
?>
