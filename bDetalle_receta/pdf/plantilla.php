<?php
	
	include 'fpdf/fpdf.php';

	
	class PDF extends FPDF
	{
		
		function header()
		{
			$this->Cell(30);
			$this->Image('images/logotipo.jpg', 5, 10, 60);
			$this->SetFont('Arial', 'B', 15);
			$this->Cell(30);
			$this->SetX(100);
			$this->Cell(100, 10, 'Reporte detalle receta', 8,0,'C');
			$this->Ln(30);

		}


		function footer()

		{
			$this->SetY(-15);
			$this->SetFont('Arial', 'I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
		}
	}

	

?>