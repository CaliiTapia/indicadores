<?php 
	if ($uno == '0' or $dos == '0' or $tres == '0' or $cuatro == '0' or $cinco == '0'){
		echo '<center><h1> No existen datos desde el 05/07/2021 al 09/07/2021! </h1></center>';
	} 
	else{

?>
<div id="grafico_barra"></div>

<script>
    Highcharts.chart('grafico_barra', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'Indicadores económicos desde el 05/07/2021 al 09/07/2021'
		},
		subtitle: {
			text: 'Fuente: mindicador.cl'
		},
		xAxis: {
			categories: [
				'<?php echo date("d-m-Y", strtotime($uno->fecha)); ?>',
				'<?php echo date("d-m-Y", strtotime($dos->fecha)); ?>',
				'<?php echo date("d-m-Y", strtotime($tres->fecha)); ?>',
				'<?php echo date("d-m-Y", strtotime($cuatro->fecha)); ?>',
				'<?php echo date("d-m-Y", strtotime($cinco->fecha)); ?>'
			],
			crosshair: true
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Unidad de Medida (<?php echo $tipo_indicador->unidad_medida; ?>)'
			}
		},
		tooltip: {
			headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
				'<td style="padding:0"><b>{point.y:.1f} <?php echo $tipo_indicador->unidad_medida; ?> </b></td></tr>',
			footerFormat: '</table>',
			shared: true,
			useHTML: true
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
		series: [{
			name: '<?php echo $tipo_indicador->descripcion; ?>',
			data: [<?php echo $uno->valor; ?>, <?php echo $dos->valor; ?>, <?php echo $tres->valor; ?>, 
				   <?php echo $cuatro->valor; ?>, <?php echo $cinco->valor; ?>]
		}]
	});
</script>
<?php }?>