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
		<?php setlocale(LC_TIME, 'es_ES','es_ES.utf8'); ?>
		<form target="_blank">
			<table style="border: 0px solid;">
				<tr style="border: 0px solid;">
					<td style="border: 0px solid;">
						<table style="border: 0px solid;">
							<tr style="border: 0px solid;">
								<td rowspan="4" style="border: 0px solid;text-align: left;vertical-align: top;" width="150px"><img src="./images/LOGO_PJ.jpg" width="150px"></td>
								<td style="border: 0px solid;vertical-align: top;text-align: center;"><h3>PODER JUDICIAL DE LA CIUDAD DE MÉXICO</h3></td>
								{{--
								<td width="100px" style="border: 0px solid;text-align: right;font-size: 8px;font-style: italic;">
									{{ mb_strimwidth($parametros->cleyenda_anual_oficios, 0, strpos ( $parametros->cleyenda_anual_oficios, ",")) }} <br> 
									{{ mb_strimwidth($parametros->cleyenda_anual_oficios, 
														strpos ( $parametros->cleyenda_anual_oficios, ",") +1 ,
														strlen ( $parametros->cleyenda_anual_oficios )
													) 
									}} </td>--}}
								<td width="100px" style="border: 0px solid;text-align: right;font-size: 8px;font-style: italic;">
									{{ mb_strimwidth($parametros->cleyenda_anual_oficios, 0, 52) }} <br> 
									{{ mb_strimwidth($parametros->cleyenda_anual_oficios, 52, strlen ( $parametros->cleyenda_anual_oficios )) }} </td>
							</tr>
							<tr style="border: 0px solid;">
								<td style="border: 0px solid;vertical-align: top;text-align: center;"><h4>CONTROL DE GESTIÓN DE LA OFICILÍA MAYOR</h4></td>
								<td rowspan="2" style="border: 0px solid;text-align: left;vertical-align: top;"><img src="./images/LOGO_OM.png" width="135px"></td>
							</tr>
							<tr style="border: 0px solid;">
								<th style="border: 0px solid;">INFORME DE ASUNTOS PENDIENTES{{ $titulo }}</th>
							</tr>
							<tr style="border: 0px solid;">
								<th style="border: 0px solid;">PERIODO REPORTADO DEL: {{ strtoupper(strftime('%e de %B de %Y', strtotime($fecha_inicial))) }} AL {{ strtoupper(strftime('%e de %B de %Y', strtotime($fecha_final))) }}</th>
								<td style="border: 0px solid; text-align: right;">Página {{ $i }} de {{ $total_paginas }}<br></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr style="border: 0px solid;">
					<td style="border: 0px solid;">
						<table style="border: 0px solid;">
							<tr style="border: 0px solid;">
								<td style="border: 0px solid;">
									<table>
										<tr>
											<th>No.</th><th>Fecha</th><th>Folio</th><th>Oficio</th><th>Remitente</th><th>Asunto</th>
										</tr>
										{{ $j = $salto_paginas + 1; }}
										@foreach($pendientes as $indice=>$pndt)
											<tr>
												<th>{{ $j }}</th>
												<td>{{ strftime('%d/%m/%Y', strtotime($pndt->dfecha_recepcion)) }}</td>
												<td>{{ $pndt->cfolio }}</td>
												<td>{{ $pndt->cnumero_documento }}</td>
												@if ($solicitud_a > 0)
													<td>{{ $pndt->cnombre_personal.' '.$pndt->cpaterno_personal.' '.$pndt->cmaterno_personal.',' }}<br>{{ substr($pndt->cdescripcion_puesto,0,44) }}
																										@if(strlen($pndt->cdescripcion_puesto)>44)
																											<br>{{ substr($pndt->cdescripcion_puesto,44,44) }}
																										@endif
																										@if(strlen($pndt->cdescripcion_puesto)>88)
																											<br>{{ substr($pndt->cdescripcion_puesto,88,44) }}
																										@endif</td>
												{{--
												@elseif ($correspon_a > 0)
													<td>{{ $pndt->cnombre_personal.' '.$pndt->cpaterno_personal.' '.$pndt->cmaterno_personal.',' }}</td>
													--}}
												@else
													<td>{{ $pndt->personalremitente->cnombre_personal.' '.$pndt->personalremitente->cpaterno_personal.' '.$pndt->personalremitente->cmaterno_personal.',' }}<br>{{ substr($pndt->cdescripcion_puesto,0,44) }}
																										@if(strlen($pndt->cdescripcion_puesto)>44)
																											<br>{{ substr($pndt->cdescripcion_puesto,44,44) }}
																										@endif
																										@if(strlen($pndt->cdescripcion_puesto)>88)
																											<br>{{ substr($pndt->cdescripcion_puesto,88,44) }}
																										@endif</td>
												@endif
												<td>{{ substr($pndt->casunto,0,50) }}
													@if(strlen($pndt->casunto)>50)
														<br>{{ substr($pndt->casunto,50,50) }}
													@endif
													@if(strlen($pndt->casunto)>100)
														<br>{{ substr($pndt->casunto,100,50) }}
													@endif
													@if(strlen($pndt->casunto)>150)
														<br>{{ substr($pndt->casunto,150,50) }}
													@endif
													@if(strlen($pndt->casunto)>200)
														<br>{{ substr($pndt->casunto,200,50) }}
													@endif
													@if(strlen($pndt->casunto)>250)
														<br>{{ substr($pndt->casunto,250,50) }}
													@endif
													@if(strlen($pndt->casunto)>300)
														<br>{{ substr($pndt->casunto,300,50) }}
													@endif
													@if(strlen($pndt->casunto)>350)
														<br>{{ substr($pndt->casunto,350,50) }}
													@endif
													{{--
													@if(strlen($pndt->casunto)>400)
														<br>{{ substr($pndt->casunto,400,50) }}
													@endif
													@if(strlen($pndt->casunto)>450)
														<br>{{ substr($pndt->casunto,450,50) }}
													@endif
													--}}
												</td>
											</tr>
											{{ $j = $j + 1; }}
										@endforeach
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