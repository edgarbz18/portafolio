<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $opcion = $_POST['opcion'];
    $numero_oc = $_POST['numero_oc'];
    $nombre_doc = $_POST['nombre_doc'];
    
    // Verifica si se ha subido un archivo
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        // Ruta de la carpeta donde se guardará todo
        $ruta_carpeta = "\\\\192.168.11.60\\evidencias\\$opcion-$numero_oc";
        
        // Crea la carpeta si no existe
        if (!file_exists($ruta_carpeta)) {
            mkdir($ruta_carpeta, 0777, true);
        }

        // Ruta del archivo subido
        $ruta_imagen = $ruta_carpeta . "/foto.jpeg";
        move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_imagen);

        // Convertir la imagen a PDF
        require('fpdf.php'); // Asegúrate de descargar FPDF y colocarlo en tu proyecto

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        //$pdf->Cell(40, 10, 'Documento: ' . $nombre_doc);
        $pdf->Ln(20);

        // Añade la imagen tomada
        $pdf->Image($ruta_imagen, 10, 30, 100, 100);
        
        // Guarda el PDF en la carpeta
        $ruta_pdf = $ruta_carpeta . "/$numero_oc-$nombre_doc.pdf";
        $pdf->Output('F', $ruta_pdf);
        
        // Redirigir o mostrar mensaje de éxito
        echo "El PDF se ha guardado correctamente en la carpeta: $ruta_carpeta";
    } else {
        echo "Error al subir la imagen";
    }
}
?>
