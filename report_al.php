<?php
require('fpdf/fpdf.php');

class PDF extends FPDF{
// Cabecera de página
function Header(){

    $titulo = (!isset($_GET['id_per']))? "Datos del alumno":"Datos del personal";
    
    // Logo
    $this->Image('img/logo.png',30,5,20);
    // Arial bold 15
    $this->SetFont('Arial','I',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,$titulo,0,0,'C');
    // Salto de línea
    $this->Ln(20);
}


}

// Creación del objeto de la clase heredada

include_once 'conexion.php';


if(!isset($_GET['id_per'])){ 

    $id = $_GET['id'];

    $sql = "SELECT nombre, nombre2, apellido, apellido2, cedula, fecha_na, email, telefono, direccion, alumno.fecha_ini, catedra.cat_nombre  FROM persona INNER JOIN alumno INNER JOIN alum_cat INNER JOIN catedra ON persona.id_persona=alumno.id_persona AND alumno.id_alumno=alum_cat.id_alumno AND catedra.id_catedra=alum_cat.id_catedra WHERE persona.id_persona=$id";

    }else{

        $id_per = $_GET['id_per'];

        $sql = "SELECT * FROM persona WHERE id_persona=$id_per";
    };

$send_q = $conex->prepare($sql);
$send_q->execute();
$dat_alumno = $send_q->fetch();


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Cell(23);

$pdf->SetFont('Times','',12);

$pdf->Cell(80, 10, 'Nombres: '.$dat_alumno['nombre'].$dat_alumno['nombre2'], 0, 0, 'J', 0);
$pdf->Cell(80, 10, 'Apellidos: '.$dat_alumno['apellido'].$dat_alumno['apellido2'], 0, 1, 'J', 0);

//margen a la izquierda
$pdf->Cell(23);

$pdf->Cell(80, 10, 'C.I: '.$dat_alumno['cedula'], 0, 0, 'J', 0);
$pdf->Cell(80, 10, 'Fecha de nacimiento: '.$dat_alumno['fecha_na'], 0, 1, 'J', 0);

//margen a la izquierda
$pdf->Cell(23);

$pdf->Cell(90, 10, utf8_decode('Correo electrónico: ').$dat_alumno['email'], 0, 0, 'J', 0);
$pdf->Cell(80, 10, utf8_decode('Teléfono: ').$dat_alumno['telefono'], 0, 1, 'J', 0);

//margen a la izquierda
$pdf->Cell(23);

$pdf->Cell(160, 10, utf8_decode('Dirección: ').$dat_alumno['direccion'], 0, 1, 'J', 0);

if (!isset($_GET['id_per'])) {

    //margen a la izquierda
    $pdf->Cell(23);

    $pdf->Cell(80, 10, utf8_decode('Fecha de ingreso: ').$dat_alumno['fecha_ini'], 0, 0, 'J', 0);

    $pdf->Cell(80, 10, utf8_decode('Catedra: ').$dat_alumno['cat_nombre'], 0, 0, 'J', 0);
};



$pdf->Output();
