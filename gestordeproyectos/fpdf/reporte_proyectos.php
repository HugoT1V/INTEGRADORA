<?php

require('./fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->Image('logo_sin_entrelazado.png', 9, 19, 100); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
        $this->Ln(6); // Salto de línea
        $this->SetFont('Arial', 'B', 30); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
        $this->Cell(125); // Movernos a la derecha
        $this->SetTextColor(0, 0, 0); //color
        //creamos una celda o fila
        $this->Cell(130, 15, utf8_decode('UNIVERSIDAD TECNOLÓGICA'), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
        $this->Cell(125); // Movernos a la derecha
        $this->Cell(130, 15, utf8_decode('DE LA SELVA'), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
        $this->Ln(8); // Salto de línea
        $this->SetTextColor(103); //color

        /* GENERADO 
        $this->Cell(8);  // mover a la derecha
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(96, 10, utf8_decode("Generado por : " . $_SESSION["nombre"]), 0, 0, '', 0);
        $this->Ln(15); */

        /* TITULO DE LA TABLA */
        //color
        $this->SetTextColor(228, 100, 0);
        $this->Cell(85); // mover a la derecha
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(100, 10, utf8_decode("REPORTE DE PROYECTOS DE INVESTIGACIÓN"), 0, 1, 'C', 0);
        $this->Ln(7);

        /* CAMPOS DE LA TABLA */
        //color
        $this->SetFillColor(228, 100, 0); //colorFondo
        $this->SetTextColor(255, 255, 255); //colorTexto
        $this->SetDrawColor(163, 163, 163); //colorBorde
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(20, 10, utf8_decode('ID'), 1, 0, 'C', 1);
        $this->Cell(103, 10, utf8_decode('NOMBRE'), 1, 0, 'C', 1);
        $this->Cell(35, 10, utf8_decode('FECHA DE INCIO'), 1, 0, 'C', 1);
        $this->Cell(117, 10, utf8_decode('DESCRIPCIÓN'), 1, 1, 'C', 1);
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15); // Posición: a 1,5 cm del final
        $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

        $this->SetY(-15); // Posición: a 1,5 cm del final
        $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
        $hoy = date('d/m/Y');
        $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
    }

    // Método para calcular el número de líneas necesarias para el texto en una celda de ancho dado
    function NbLines($w, $txt)
    {
        $cw = $this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }

    // Método para crear una celda con ajuste automático de altura
    function Row($data)
    {
        $nb = 0;
        $widths = [20, 103, 35, 117];
        for ($i = 0; $i < count($data); $i++) {
            $nb = max($nb, $this->NbLines($widths[$i], $data[$i]));
        }
        $h = 10 * $nb;
        $this->CheckPageBreak($h);
        for ($i = 0; $i < count($data); $i++) {
            $w = $widths[$i];
            $a = 'C';
            $x = $this->GetX();
            $y = $this->GetY();
            $this->Rect($x, $y, $w, $h);
            $this->MultiCell($w, 10, $data[$i], 0, $a);
            $this->SetXY($x + $w, $y);
        }
        $this->Ln($h);
    }

    // Verificar si es necesario un salto de página
    function CheckPageBreak($h)
    {
        if ($this->GetY() + $h > $this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }
}

//CADENA DE CONEXION
$con = mysqli_connect("localhost","root","","gestor");

$consulta = "SELECT id_proyecto_investigacion, nombre, fecha_inicio,
            descripcion FROM proyecto_investigacion";
  
$result = mysqli_query($con,$consulta);

$pdf = new PDF();
$pdf->AddPage("landscape"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

while ($row = mysqli_fetch_array($result)) {
    $fecha_inicio = $row['fecha_inicio'];
    $datetime = new DateTime($fecha_inicio);
    $fecha_formateada = $datetime->format('d/m/Y');

    $id = utf8_decode($row['id_proyecto_investigacion']);
    $nombre = utf8_decode($row['nombre']);
    $descripcion = utf8_decode($row['descripcion']);

    $pdf->Row([$id, $nombre, $fecha_formateada, $descripcion]);
}

mysqli_close($con);
  session_start();
  if(@$_SESSION['validada']==1){

  }else
  header("location: ../index.html");

$pdf->Output('Reporte Proyectos de Investigacion.pdf', 'I'); //nombreDescarga, Visor(I->visualizar - D->descargar)
?>
