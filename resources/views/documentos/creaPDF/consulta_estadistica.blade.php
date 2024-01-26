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
									{{ mb_strimwidth($parametros->cleyenda_anual_oficios, 52,
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
								<th style="border: 0px solid;">ESTADÍSTICA POR ÁREA Y ESTATUS</th>
							</tr>
							<tr style="border: 0px solid;">
								<th style="border: 0px solid;">PERIODO REPORTADO DEL: {{ strtoupper(strftime('%e de %B de %Y', strtotime($fecha_inicial))) }} AL {{ strtoupper(strftime('%e de %B de %Y', strtotime($fecha_final))) }}</th>
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
											<th>ÁREA</th><th>PENDIENTES</th><th>EN PROCESO</th><th>CONCLUIDOS</th><th>CONOCIMIENTO</th><th>TOTALES</th>
										</tr>
										<tr>
											<th style="text-align: left;">DIRECCIÓN EJECUTIVA DE RECURSOS HUMANOS</th>
											<td>{{ $derh_pend }}</td>
											<td>{{ $derh_proc }}</td>
											<td>{{ $derh_conc }}</td>
											<td>{{ $derh_cncmt}}</td>
											<td>{{ $derh_pend + $derh_proc + $derh_conc + $derh_cncmt}}</td>
										</tr>
										<tr>
											<th style="text-align: left;">DIRECCIÓN EJECUTIVA DE RECURSOS FINANCIEROS</th>
											<td>{{ $derf_pend }}</td>
											<td>{{ $derf_proc }}</td>
											<td>{{ $derf_conc }}</td>
											<td>{{ $derf_cncmt}}</td>
											<td>{{ $derf_pend + $derf_proc + $derf_conc + $derf_cncmt}}</td>
										</tr>
										<tr>
											<th style="text-align: left;">DIRECCIÓN EJECUTIVA DE OBRAS, MANTTO. Y SERVICIOS</th>
											<td>{{ $deoms_pend }}</td>
											<td>{{ $deoms_proc }}</td>
											<td>{{ $deoms_conc }}</td>
											<td>{{ $deoms_cncmt}}</td>
											<td>{{ $deoms_pend + $deoms_proc + $deoms_conc + $deoms_cncmt}}</td>
										</tr>
										<tr>
											<th style="text-align: left;">DIRECCIÓN EJECUTIVA DE PLANEACIÓN</th>
											<td>{{ $dep_pend }}</td>
											<td>{{ $dep_proc }}</td>
											<td>{{ $dep_conc }}</td>
											<td>{{ $dep_cncmt}}</td>
											<td>{{ $dep_pend + $dep_proc + $dep_conc + $dep_cncmt}}</td>
										</tr>
										<tr>
											<th style="text-align: left;">DIRECCIÓN EJECUTIVA DE RECURSOS MATERIALES</th>
											<td>{{ $derm_pend }}</td>
											<td>{{ $derm_proc }}</td>
											<td>{{ $derm_conc }}</td>
											<td>{{ $derm_cncmt}}</td>
											<td>{{ $derm_pend + $derm_proc + $derm_conc + $derm_cncmt}}</td>
										</tr>
										<tr>
											<th style="text-align: left;">DIRECCIÓN EJECUTIVA DE GESTIÓN TECNOLÓGICA</th>
											<td>{{ $degt_pend }}</td>
											<td>{{ $degt_proc }}</td>
											<td>{{ $degt_conc }}</td>
											<td>{{ $degt_cncmt}}</td>
											<td>{{ $degt_pend + $degt_proc + $degt_conc + $degt_cncmt}}</td>
										</tr>
										<tr>
											<th style="text-align: left;">DIRECCIÓN ADMINISTRATIVA</th>
											<td>{{ $dacj_pend }}</td>
											<td>{{ $dacj_proc }}</td>
											<td>{{ $dacj_conc }}</td>
											<td>{{ $dacj_cncmt}}</td>
											<td>{{ $dacj_pend + $dacj_proc + $dacj_conc + $dacj_cncmt}}</td>
										</tr>
										<tr>
											<th style="text-align: left;">DIRECCIÓN DE SEGURIDAD</th>
											<td>{{ $ds_pend }}</td>
											<td>{{ $ds_proc }}</td>
											<td>{{ $ds_conc }}</td>
											<td>{{ $ds_cncmt}}</td>
											<td>{{ $ds_pend + $ds_proc + $ds_conc + $ds_cncmt}}</td>
										</tr>
										<tr>
											<th style="text-align: left;">OTROS</th>
											<td>{{ $otro_pend }}</td>
											<td>{{ $otro_proc }}</td>
											<td>{{ $otro_conc }}</td>
											<td>{{ $otro_cncmt}}</td>
											<td>{{ $otro_pend + $otro_proc + $otro_conc + $otro_cncmt}}</td>
										</tr>
										<tr>
											<th style="text-align: right;">TOTALES</th>
											<td>{{ $derh_pend + $derf_pend + $deoms_pend + $dep_pend + $derm_pend + $degt_pend + $dacj_pend + $ds_pend + $otro_pend }}</td>
											<td>{{ $derh_proc + $derf_proc + $deoms_proc + $dep_proc + $derm_proc + $degt_proc + $dacj_proc + $ds_proc + $otro_proc }}</td>
											<td>{{ $derh_conc + $derf_conc + $deoms_conc + $dep_conc + $derm_conc + $degt_conc + $dacj_conc + $ds_conc + $otro_conc }}</td>
											<td>{{ $derh_cncmt + $derf_cncmt + $deoms_cncmt + $dep_cncmt + $derm_cncmt + $degt_cncmt + $dacj_cncmt + $ds_cncmt + $otro_cncmt }}</td>
											<td></td>
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