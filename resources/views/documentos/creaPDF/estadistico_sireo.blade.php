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
								<th style="border: 0px solid;">OFICIOS RECIBIDOS POR SIREO</th>
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
											<th rowspan="2">ÁREA</th><th colspan="13">DISTRIBUCIÓN DE TRABAJO POR DIRECCIÓN EJECUTIVA (ACUERDOS PENDIENTES POR MES)</th><th rowspan="2">ACUERDOS<br>CONCLUIDOS</th><th rowspan="2">AVANCE<br>POR ÁREA<br>(%)</th><th rowspan="2">TOTAL DE<br>ACUERDOS<br>{{$anio_consulta}}<br>recibidos<br>al año</th>
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
											<td>{{$derh_pend_ene}}</td>
											<td>{{$derh_pend_feb}}</td>
											<td>{{$derh_pend_mzo}}</td>
											<td>{{$derh_pend_abr}}</td>
											<td>{{$derh_pend_may}}</td>
											<td>{{$derh_pend_jun}}</td>
											<td>{{$derh_pend_jul}}</td>
											<td>{{$derh_pend_ago}}</td>
											<td>{{$derh_pend_sep}}</td>
											<td>{{$derh_pend_oct}}</td>
											<td>{{$derh_pend_nov}}</td>
											<td>{{$derh_pend_dic}}</td>
											<td>{{$derh_pend}}</td>
											<td>{{$derh_conc}}</td>
											@if(($derh_pend + $derh_conc) > 0)
												<td>{{number_format(($derh_conc * 100 / ($derh_pend + $derh_conc)), 2, '.', '')}}%</td>
											@else
												<td>0.00%</td>
											@endif
											<td>{{$derh_pend + $derh_conc}}</td>
										</tr>
										<tr>
											<th style="text-align: left;">FINANCIEROS</th>
											<td>{{$derf_pend_ene}}</td>
											<td>{{$derf_pend_feb}}</td>
											<td>{{$derf_pend_mzo}}</td>
											<td>{{$derf_pend_abr}}</td>
											<td>{{$derf_pend_may}}</td>
											<td>{{$derf_pend_jun}}</td>
											<td>{{$derf_pend_jul}}</td>
											<td>{{$derf_pend_ago}}</td>
											<td>{{$derf_pend_sep}}</td>
											<td>{{$derf_pend_oct}}</td>
											<td>{{$derf_pend_nov}}</td>
											<td>{{$derf_pend_dic}}</td>
											<td>{{$derf_pend}}</td>
											<td>{{$derf_conc}}</td>
											@if(($derf_pend + $derf_conc) > 0)
												<td>{{number_format(($derf_conc * 100 / ($derf_pend + $derf_conc)), 2, '.', '')}}%</td>
											@else
												<td>0.00%</td>
											@endif
											<td>{{$derf_pend + $derf_conc}}</td>
										</tr>
										<tr>
											<th style="text-align: left;">OBRAS</th>
											<td>{{$deoms_pend_ene}}</td>
											<td>{{$deoms_pend_feb}}</td>
											<td>{{$deoms_pend_mzo}}</td>
											<td>{{$deoms_pend_abr}}</td>
											<td>{{$deoms_pend_may}}</td>
											<td>{{$deoms_pend_jun}}</td>
											<td>{{$deoms_pend_jul}}</td>
											<td>{{$deoms_pend_ago}}</td>
											<td>{{$deoms_pend_sep}}</td>
											<td>{{$deoms_pend_oct}}</td>
											<td>{{$deoms_pend_nov}}</td>
											<td>{{$deoms_pend_dic}}</td>
											<td>{{$deoms_pend}}</td>
											<td>{{$deoms_conc}}</td>
											@if(($deoms_pend + $deoms_conc) > 0)
												<td>{{number_format(($deoms_conc * 100 / ($deoms_pend + $deoms_conc)), 2, '.', '')}}%</td>
											@else
												<td>0.00%</td>
											@endif
											<td>{{$deoms_pend + $deoms_conc}}</td>
										</tr>
										<tr>
											<th style="text-align: left;">PLANEACIÓN</th>
											<td>{{$dep_pend_ene}}</td>
											<td>{{$dep_pend_feb}}</td>
											<td>{{$dep_pend_mzo}}</td>
											<td>{{$dep_pend_abr}}</td>
											<td>{{$dep_pend_may}}</td>
											<td>{{$dep_pend_jun}}</td>
											<td>{{$dep_pend_jul}}</td>
											<td>{{$dep_pend_ago}}</td>
											<td>{{$dep_pend_sep}}</td>
											<td>{{$dep_pend_oct}}</td>
											<td>{{$dep_pend_nov}}</td>
											<td>{{$dep_pend_dic}}</td>
											<td>{{$dep_pend}}</td>
											<td>{{$dep_conc}}</td>
											@if(($dep_pend + $dep_conc) > 0)
												<td>{{number_format(($dep_conc * 100 / ($dep_pend + $dep_conc)), 2, '.', '')}}%</td>
											@else
												<td>0.00%</td>
											@endif
											<td>{{$dep_pend + $dep_conc}}</td>
										</tr>
										<tr>
											<th style="text-align: left;">MATERIALES</th>
											<td>{{$derm_pend_ene}}</td>
											<td>{{$derm_pend_feb}}</td>
											<td>{{$derm_pend_mzo}}</td>
											<td>{{$derm_pend_abr}}</td>
											<td>{{$derm_pend_may}}</td>
											<td>{{$derm_pend_jun}}</td>
											<td>{{$derm_pend_jul}}</td>
											<td>{{$derm_pend_ago}}</td>
											<td>{{$derm_pend_sep}}</td>
											<td>{{$derm_pend_oct}}</td>
											<td>{{$derm_pend_nov}}</td>
											<td>{{$derm_pend_dic}}</td>
											<td>{{$derm_pend}}</td>
											<td>{{$derm_conc}}</td>
											@if(($derm_pend + $derm_conc) > 0)
												<td>{{number_format(($derm_conc * 100 / ($derm_pend + $derm_conc)), 2, '.', '')}}%</td>
											@else
												<td>0.00%</td>
											@endif
											<td>{{$derm_pend + $derm_conc}}</td>
										</tr>
										<tr>
											<th style="text-align: left;">GESTIÓN</th>
											<td>{{$degt_pend_ene}}</td>
											<td>{{$degt_pend_feb}}</td>
											<td>{{$degt_pend_mzo}}</td>
											<td>{{$degt_pend_abr}}</td>
											<td>{{$degt_pend_may}}</td>
											<td>{{$degt_pend_jun}}</td>
											<td>{{$degt_pend_jul}}</td>
											<td>{{$degt_pend_ago}}</td>
											<td>{{$degt_pend_sep}}</td>
											<td>{{$degt_pend_oct}}</td>
											<td>{{$degt_pend_nov}}</td>
											<td>{{$degt_pend_dic}}</td>
											<td>{{$degt_pend}}</td>
											<td>{{$degt_conc}}</td>
											@if (($degt_pend + $degt_conc) > 0)
												<td>{{number_format(($degt_conc * 100 / ($degt_pend + $degt_conc)), 2, '.', '')}}%</td>
											@else
												<td>0.00%</td>
											@endif
											<td>{{$degt_pend + $degt_conc}}</td>
										</tr>
										<tr>
											<th style="text-align: left;">DIR. ADMVA.</th>
											<td>{{$dacj_pend_ene}}</td>
											<td>{{$dacj_pend_feb}}</td>
											<td>{{$dacj_pend_mzo}}</td>
											<td>{{$dacj_pend_abr}}</td>
											<td>{{$dacj_pend_may}}</td>
											<td>{{$dacj_pend_jun}}</td>
											<td>{{$dacj_pend_jul}}</td>
											<td>{{$dacj_pend_ago}}</td>
											<td>{{$dacj_pend_sep}}</td>
											<td>{{$dacj_pend_oct}}</td>
											<td>{{$dacj_pend_nov}}</td>
											<td>{{$dacj_pend_dic}}</td>
											<td>{{$dacj_pend}}</td>
											<td>{{$dacj_conc}}</td>
											@if (($dacj_pend + $dacj_conc) > 0)
												<td>{{number_format(($dacj_conc * 100 / ($dacj_pend + $dacj_conc)), 2, '.', '')}}%</td>
											@else
												<td>0.00%</td>
											@endif
											<td>{{$dacj_pend + $dacj_conc}}</td>
										</tr>
										<tr>
											<th style="text-align: left;">SEGURIDAD</th>
											<td>{{$dseg_pend_ene}}</td>
											<td>{{$dseg_pend_feb}}</td>
											<td>{{$dseg_pend_mzo}}</td>
											<td>{{$dseg_pend_abr}}</td>
											<td>{{$dseg_pend_may}}</td>
											<td>{{$dseg_pend_jun}}</td>
											<td>{{$dseg_pend_jul}}</td>
											<td>{{$dseg_pend_ago}}</td>
											<td>{{$dseg_pend_sep}}</td>
											<td>{{$dseg_pend_oct}}</td>
											<td>{{$dseg_pend_nov}}</td>
											<td>{{$dseg_pend_dic}}</td>
											<td>{{$dseg_pend}}</td>
											<td>{{$dseg_conc}}</td>
											@if (($dseg_pend + $dseg_conc) > 0)
												<td>{{number_format(($dseg_conc * 100 / ($dseg_pend + $dseg_conc)), 2, '.', '')}}%</td>
											@else
												<td>0.00%</td>
											@endif
											<td>{{$dseg_pend + $dseg_conc}}</td>
										</tr>
										<tr>
											{{ $pend_ene = $derh_pend_ene + $derf_pend_ene + $deoms_pend_ene + $dep_pend_ene + $derm_pend_ene + $degt_pend_ene + $dacj_pend_ene + $dseg_pend_ene; }}
											{{ $pend_feb = $derh_pend_feb + $derf_pend_feb + $deoms_pend_feb + $dep_pend_feb + $derm_pend_feb + $degt_pend_feb + $dacj_pend_feb + $dseg_pend_feb; }}
											{{ $pend_mzo = $derh_pend_mzo + $derf_pend_mzo + $deoms_pend_mzo + $dep_pend_mzo + $derm_pend_mzo + $degt_pend_mzo + $dacj_pend_mzo + $dseg_pend_mzo; }}
											{{ $pend_abr = $derh_pend_abr + $derf_pend_abr + $deoms_pend_abr + $dep_pend_abr + $derm_pend_abr + $degt_pend_abr + $dacj_pend_abr + $dseg_pend_abr; }}
											{{ $pend_may = $derh_pend_may + $derf_pend_may + $deoms_pend_may + $dep_pend_may + $derm_pend_may + $degt_pend_may + $dacj_pend_may + $dseg_pend_may; }}
											{{ $pend_jun = $derh_pend_jun + $derf_pend_jun + $deoms_pend_jun + $dep_pend_jun + $derm_pend_jun + $degt_pend_jun + $dacj_pend_jun + $dseg_pend_jun; }}
											{{ $pend_jul = $derh_pend_jul + $derf_pend_jul + $deoms_pend_jul + $dep_pend_jul + $derm_pend_jul + $degt_pend_jul + $dacj_pend_jul + $dseg_pend_jul; }}
											{{ $pend_ago = $derh_pend_ago + $derf_pend_ago + $deoms_pend_ago + $dep_pend_ago + $derm_pend_ago + $degt_pend_ago + $dacj_pend_ago + $dseg_pend_ago; }}
											{{ $pend_sep = $derh_pend_sep + $derf_pend_sep + $deoms_pend_sep + $dep_pend_sep + $derm_pend_sep + $degt_pend_sep + $dacj_pend_sep + $dseg_pend_sep; }}
											{{ $pend_oct = $derh_pend_oct + $derf_pend_oct + $deoms_pend_oct + $dep_pend_oct + $derm_pend_oct + $degt_pend_oct + $dacj_pend_oct + $dseg_pend_oct; }}
											{{ $pend_nov = $derh_pend_nov + $derf_pend_nov + $deoms_pend_nov + $dep_pend_nov + $derm_pend_nov + $degt_pend_nov + $dacj_pend_nov + $dseg_pend_nov; }}
											{{ $pend_dic = $derh_pend_dic + $derf_pend_dic + $deoms_pend_dic + $dep_pend_dic + $derm_pend_dic + $degt_pend_dic + $dacj_pend_dic + $dseg_pend_dic; }}
											{{ $tot_pend = $derh_pend + $derf_pend + $deoms_pend + $dep_pend + $derm_pend + $degt_pend + $dacj_pend + $dseg_pend; }}
											{{ $tot_conc = $derh_conc + $derf_conc + $deoms_conc + $dep_conc + $derm_conc + $degt_conc + $dacj_conc + $dseg_conc;}}
											<th style="text-align: right;">TOTALES</th>
											<td>{{$pend_ene}}</td>
											<td>{{$pend_feb}}</td>
											<td>{{$pend_mzo}}</td>
											<td>{{$pend_abr}}</td>
											<td>{{$pend_may}}</td>
											<td>{{$pend_jun}}</td>
											<td>{{$pend_jul}}</td>
											<td>{{$pend_ago}}</td>
											<td>{{$pend_sep}}</td>
											<td>{{$pend_oct}}</td>
											<td>{{$pend_nov}}</td>
											<td>{{$pend_dic}}</td>
											<td>{{$tot_pend}}</td>
											<td>{{$tot_conc}}</td>
											@if (($tot_pend + $tot_conc) > 0)
												<td>{{number_format(($tot_conc * 100 / ($tot_pend + $tot_conc)), 2, '.', '')}}%</td>
											@else
												<td>0.00%</td>
											@endif
											<td>{{$tot_pend + $tot_conc}}</td>
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
								<td style="border: 0px solid;"><br><br><br></td>
							</tr>
							<tr style="border: 0px solid;">
								<td>
									<table style="border: 0px solid;">
										<tr>
											<td width="83px" rowspan="4"></td>
											<th colspan="13">ACUERDOS RECIBIDOS POR LA OFICIALÍA MAYOR, PENDIENTES POR MES</th>
											<td width="238px" rowspan="4"></td>
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
											{{ $tot_pend_om = $om_pend_ene + $om_pend_feb + $om_pend_mzo + $om_pend_abr + $om_pend_may + $om_pend_jun + $om_pend_jul + $om_pend_ago + $om_pend_sep + $om_pend_oct + $om_pend_nov + $om_pend_dic; }}
											<td>{{$om_pend_ene}}</td>
											<td>{{$om_pend_feb}}</td>
											<td>{{$om_pend_mzo}}</td>
											<td>{{$om_pend_abr}}</td>
											<td>{{$om_pend_may}}</td>
											<td>{{$om_pend_jun}}</td>
											<td>{{$om_pend_jul}}</td>
											<td>{{$om_pend_ago}}</td>
											<td>{{$om_pend_sep}}</td>
											<td>{{$om_pend_oct}}</td>
											<td>{{$om_pend_nov}}</td>
											<td>{{$om_pend_dic}}</td>
											<td rowspan="2">{{$tot_pend_om}}</td>
										</tr>
										<tr>
											<td colspan="2" style="text-align: center;">1er. Trim.</td>
											<td>{{$om_pend_ene + $om_pend_feb + $om_pend_mzo}}</td>
											<td colspan="2" style="text-align: center;">2do. Trim.</td>
											<td>{{$om_pend_abr + $om_pend_may + $om_pend_jun}}</td>
											<td colspan="2" style="text-align: center;">3er. Trim.</td>
											<td>{{$om_pend_jul + $om_pend_ago + $om_pend_sep}}</td>
											<td colspan="2" style="text-align: center;">4to. Trim.</td>
											<td>{{$om_pend_oct + $om_pend_nov + $om_pend_dic}}</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr style="border: 0px solid;">
								<td style="border: 0px solid;"><br><br></td>
							</tr>
							<tr style="border: 0px solid;">
								<td>
									<table>
										<tr>
											<td width="245px" rowspan="3"></td>
											<td colspan="6" style="text-align: left;">TOTAL DE ACUERDOS RECIBIDOS:</td>
											<td width="50px">{{$tot_pend_om + $tot_conc_om}}</td>
											<td width="50px">100%</td>
											<td width="370px" rowspan="3"></td>
										</tr>
										<tr>
											<td colspan="6" style="text-align: left;">TOTAL DE ACUERDOS CONCLUÍDOS:</td>
											<td>{{$tot_conc_om}}</td>
											@if(($tot_pend_om + $tot_conc_om) > 0)
												<td>{{number_format(($tot_conc_om * 100 / ($tot_pend_om + $tot_conc_om)), 2, '.', '')}}%</td>
											@else
												<td>0.00%</td>
											@endif
										</tr>
										<tr>
											<td colspan="6" style="text-align: left;">TOTAL DE ACUERDOS PENDIENTES:</td>
											<td>{{$tot_pend_om}}</td>
											@if(($tot_pend_om + $tot_conc_om) > 0)
												<td>{{number_format(($tot_pend_om * 100 / ($tot_pend_om + $tot_conc_om)), 2, '.', '')}}%</td>
											@else
												<td>0.00%</td>
											@endif
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