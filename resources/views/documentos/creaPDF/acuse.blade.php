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
		    	/*border-collapse: collapse;*/
		    	/*border: 1px solid;*/
		    }
			td, tr, th{
				white-space: nowrap;
				/*border: 1px solid;*/
				/*text-align: center;	*/

			}
			
		</style>
	</head>
	<body>
		<form target="_blank">
			<table style="border: 2px solid;">
				<tr>
					<td>
						<table>
							<tr>
								<td rowspan="3" style="text-align: left;vertical-align: top;" width="150px"><img src="./images/LOGO_PJ.jpg" width="150px"></td>
								<td style="vertical-align: top;text-align: center;"><h3>PODER JUDICIAL DE LA CIUDAD DE MÉXICO</h3></td>
								<td width="100px" style="text-align: right;font-size: 8px;font-style: italic;">
									{{ mb_strimwidth($parametros->cleyenda_anual_oficios, 0, strpos ( $parametros->cleyenda_anual_oficios, ",")) }} <br> 
									{{ mb_strimwidth($parametros->cleyenda_anual_oficios, 
														strpos ( $parametros->cleyenda_anual_oficios, ",") +1 ,
														strlen ( $parametros->cleyenda_anual_oficios )
													) 
									}} </td>
							</tr>
							<tr>
								<td style="vertical-align: top;text-align: center;"><h4>CONTROL DE GESTIÓN DE LA OFICILÍA MAYOR</h4></td>
								<td rowspan="2" style="text-align: left;vertical-align: top;"><img src="./images/LOGO_OM.png" width="135px"></td>
							</tr>
							<tr><td style="vertical-align: top;text-align: center;"><h3>ACUSE</h3></td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td><br></td>
				</tr>
				<tr>
					<td>
						<table>
							<tr>
								<th>FOLIO</th><th colspan="3">CONCEPTO</th>
							</tr>
							<tr>
								<td style="border: 2px solid; text-align: center">{{ $documento->cfolio }}</td><td colspan="3" style="border: 1px solid;">{{ $documento->casunto }}</td>
							</tr>
							<tr>
								<td></td>
								<td style="border: 2px solid;"><h4>NÚMERO DE OFICIO</h4></td>
								<td style="border: 1px solid;">{{ $documento->cnumero_documento }}</td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td style="border: 2px solid;"><h4>RECEPCIÓN</h4></td>
								<td style="border: 1px solid;">{{ $documento->dfecha_recepcion }}</td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td style="border: 2px solid;"><h4>ASIGNACIÓN</h4></td>
								<td style="border: 1px solid;">{{ $documento->dfecha_recepcion }}</td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td style="border: 2px solid;"><h4>ÁREA ASIGNADA</h4></td>
								<td style="border: 1px solid;">{{ $asignada->adscripcion->cdescripcion_adscripcion }}</td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td style="border: 2px solid;"><h4>TIPO ARCHIVO</h4></td>
								<td style="border: 1px solid;">DIRECCIÓN EJECUTIVA DE RECURSOS FINANCIEROS</td>
								<td></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>