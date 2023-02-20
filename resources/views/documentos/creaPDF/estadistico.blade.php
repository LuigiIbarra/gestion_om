<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
		    body{
		        font-size: 12px;
		        font-family: "consolas",monospace;
		        font-style: normal;
		        /*font-weight: bold;*/
		    }
		    table{
		    	width: 100%;
		    	margin: 0 auto;
		    	border-collapse: collapse;
		    	border: 1px solid;
		    }
			td, tr, th{
				white-space: nowrap;
				border: 1px solid;
				text-align: center;
				border-collapse: collapse;
			}
			
		</style>
	</head>
	<body>
		<form target="_blank">
			<table style="border: 0px solid;">
				<tr style="border: 0px solid;">
					<td style="border: 0px solid;">
						<table style="border: 0px solid;">
							<tr style="border: 0px solid;">
								<td rowspan="3" style="border: 0px solid;text-align: left;vertical-align: top;" width="150px"><img src="./images/LOGO_PJ.jpg" width="150px"></td>
								<td style="border: 0px solid;vertical-align: top;text-align: center;"><h3>PODER JUDICIAL DE LA CIUDAD DE MÉXICO</h3></td>
								<td width="100px" style="border: 0px solid;text-align: right;font-size: 8px;font-style: italic;">
									{{ mb_strimwidth($parametros->cleyenda_anual_oficios, 0, strpos ( $parametros->cleyenda_anual_oficios, ",")) }} <br> 
									{{ mb_strimwidth($parametros->cleyenda_anual_oficios, 
														strpos ( $parametros->cleyenda_anual_oficios, ",") +1 ,
														strlen ( $parametros->cleyenda_anual_oficios )
													) 
									}} </td>
							</tr>
							<tr style="border: 0px solid;">
								<td style="border: 0px solid;vertical-align: top;text-align: center;"><h4>CONTROL DE GESTIÓN DE LA OFICILÍA MAYOR</h4></td>
								<td rowspan="2" style="border: 0px solid;text-align: left;vertical-align: top;"><img src="./images/LOGO_OM.png" width="135px"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr style="border: 0px solid;">
					<td style="border: 0px solid;"><br></td>
				</tr>
				<tr style="border: 0px solid;">
					<td style="border: 0px solid;">
						<table style="border: 0px solid;">
							<tr style="border: 0px solid;">
								<th style="border: 0px solid;">PERIODO REPORTADO DEL: 01 DE ENERO DE 2023 AL {{ $fecha }}</th>
							</tr>
						</table>
					</td>
				</tr>
				<tr style="border: 0px solid;">
					<td style="border: 0px solid;"><br></td>
				</tr>
				<tr style="border: 0px solid;">
					<td style="border: 0px solid;">
						<table style="border: 0px solid;">
							<tr style="border: 0px solid;">
								<td style="border: 0px solid;">
									<table>
										<tr>
											<th rowspan="2">ÁREA</th><th colspan="13">PENDIENTES POR ÁREA</th><th rowspan="2">CONCLUIDOS</th><th rowspan="2">AVANCE<br>POR ÁREA (%)</th><th rowspan="2">TOTAL 2023</th>
										</tr>
										<tr>
											<th>ENERO</th>
											<th>FEBRERO</th>
											<th>MARZO</th>
											<th>ABRIL</th>
											<th>MAYO</th>
											<th>JUNIO</th>
											<th>JULIO</th>
											<th>AGOSTO</th>
											<th>SEPT.</th>
											<th>OCT.</th>
											<th>NOV.</th>
											<th>DIC.</th>
											<th>TOTAL</th>
										</tr>
										<tr>
											<th style="text-align: left;">HUMANOS</th>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0.00%</td>
											<td>0</td>
										</tr>
										<tr>
											<th style="text-align: left;">FINANCIEROS</th>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0.00%</td>
											<td>0</td>
										</tr>
										<tr>
											<th style="text-align: left;">OBRAS</th>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0.00%</td>
											<td>0</td>
										</tr>
										<tr>
											<th style="text-align: left;">PLANEACIÓN</th>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0.00%</td>
											<td>0</td>
										</tr>
										<tr>
											<th style="text-align: left;">MATERIALES</th>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0.00%</td>
											<td>0</td>
										</tr>
										<tr>
											<th style="text-align: left;">GESTIÓN</th>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0.00%</td>
											<td>0</td>
										</tr>
										<tr>
											<th style="text-align: left;">DIRECCIÓN</th>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0.00%</td>
											<td>0</td>
										</tr>
										<tr>
											<th style="text-align: left;">SEGURIDAD</th>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0.00%</td>
											<td>0</td>
										</tr>
										<tr>
											<th style="text-align: right;">TOTALES</th>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td></td>
											<td>0</td>
										</tr>
										<tr style="border: 0px solid;">
											<td style="border: 0px solid;"></td>
											<td colspan="13" style="border: 1px solid;">LOS TOTALES REFLEJAN EL NÚMERO DE ATENCIONES PENDIENTES POR MES POR DIRECCIÓN EJECUTIVA</td>
											<td colspan="3" style="border: 0px solid;"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr style="border: 0px solid;">
								<td style="border: 0px solid;"><br></td>
							</tr>
							<tr style="border: 0px solid;">
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>