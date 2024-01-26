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
			<table>
				<tr>
					<td>
						<table>
							<tr>
								<td rowspan="3" style="text-align: left;vertical-align: top;" width="150px"><img src="./images/LOGO_PJ.jpg" width="150px"></td>
								<td style="vertical-align: top;text-align: center;"><h3>PODER JUDICIAL DE LA CIUDAD DE MÉXICO</h3></td>
								{{--
								<td width="100px" style="text-align: right;font-size: 8px;font-style: italic;">
									{{ mb_strimwidth($parametros->cleyenda_anual_oficios, 0, strpos ( $parametros->cleyenda_anual_oficios, ",")) }} <br> 
									{{ mb_strimwidth($parametros->cleyenda_anual_oficios, 
														strpos ( $parametros->cleyenda_anual_oficios, ",") +1 ,
														strlen ( $parametros->cleyenda_anual_oficios )
													) 
									}} </td>--}}
								<td width="100px" style="text-align: right;font-size: 8px;font-style: italic;">
									{{ mb_strimwidth($parametros->cleyenda_anual_oficios, 0, 52) }} <br> 
									{{ mb_strimwidth($parametros->cleyenda_anual_oficios, 52,
														strlen ( $parametros->cleyenda_anual_oficios )
													) 
									}} </td>
							</tr>
							<tr>
								<td style="vertical-align: top;text-align: center;"><h4>CONTROL DE GESTIÓN DE LA OFICILÍA MAYOR</h4></td>
								<td rowspan="2" style="text-align: left;vertical-align: top;"><img src="./images/LOGO_OM.png" width="135px"></td>
							</tr>
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
								<th style="text-align: right;">Número de Folio:</th><td width="80px">{{ $documento->cfolio }}</td>
							</tr>
							<tr>
								<th style="text-align: right;">Fecha de Captura:</th><td width="80px">{{ date("d-m-Y", strtotime($documento->dfecha_recepcion)) }}</td>
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
								<td style="border: 1px solid; border-collapse: collapse;">
									<table>
										<tr>
											<th width="40px" style="vertical-align: top;">Asunto:</th>
											<td>{{ substr($documento->casunto,0,100) }}<br>
												{{ substr($documento->casunto,100,100) }}<br>
												{{ substr($documento->casunto,200,100) }}<br>
												{{ substr($documento->casunto,300,100) }}<br>
												{{ substr($documento->casunto,400,100) }}<br>
												{{ substr($documento->casunto,500,100) }}<br>
												{{ substr($documento->casunto,600,100) }}<br>
												{{ substr($documento->casunto,700,100) }}<br>
												{{ substr($documento->casunto,800,100) }}<br>
												{{ substr($documento->casunto,900,100) }}<br>
											</td>
										</tr>
										<tr>
											<td><br><br><br><br>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td><br>
								</td>
							</tr>
							<tr>
								<td>
									<table>
										<tr>
											<th width="40px">Procedencia:</th><td>{{ $personaRmte->adscripcion->cdescripcion_adscripcion }}</td>
										</tr>
										<tr>
											<td></td><td>{{ $personaRmte->cnombre_personal.' '.$personaRmte->cpaterno_personal.' '.$personaRmte->cmaterno_personal}}</td>
										</tr>
										<tr>
											<td></td><td>{{ $personaRmte->puesto->cdescripcion_puesto }}</td>
										</tr>
										<tr>
											<td><br></td>
										</tr>
									</table>
									<table>
										<tr>
											<th width="40px">Fecha del Documento:</th><td>{{ date("d-m-Y", strtotime($documento->dfecha_documento)) }}</td><th style="text-align: right;">No. de Documento:</th><td>{{ $documento->cnumero_documento }}</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td><br>
								</td>
							</tr>
							<tr>
								<td>
									<table>
										<tr>
											<th width="50%" style="text-align: left;">NOMBRE</th><th style="text-align: left;">CARGO</th>
										</tr>
										@foreach($pers_destAt as $indice=>$destAten)
											<tr>
												<td>{{ $destAten->cnombre_personal.' '.$destAten->cpaterno_personal.' '.$destAten->cmaterno_personal }}</td><td>{{ $destAten->puesto->cdescripcion_puesto }}<br></td>
											</tr>
										@endforeach
										@foreach($pers_destCon as $indice=>$destCon)
											<tr>
												<td>{{ $destCon->cnombre_personal.' '.$destCon->cpaterno_personal.' '.$destCon->cmaterno_personal }}</td><td>{{ $destCon->puesto->cdescripcion_puesto }}<br></td>
											</tr>
										@endforeach
										<tr>
											<td><br></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td><br>
								</td>
							</tr>
							<tr>
								<td>
									<table>
										<tr>
											<th>A T E N T A M E N T E</th>
										</tr>
										<tr>
											<td><br><br><br><br><br><br></td>
										</tr>
										<tr>
											<th>ING. VICTOR MANUEL ZARAGOZA LARA</th>
										</tr>
										<tr>
											<th>SUBDIRECTOR DE CONTROL DE GESTIÓN DE</th>
										</tr>
										<tr>
											<th>LA OFICILÍA MAYOR</th>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>