<!DOCTYPE html>
<html class="loading" lang="es" data-textdirection="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="theme-color" content="#6640b2">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Indicadores">
  <meta name="keywords" content="Indicadores">
  <meta name="author" content="Carla Tapia">

  <title>Mantenedor Indicadores</title>

  <link rel="apple-touch-icon" href="<?= base_url() ?>assets/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>app-assets/images/ico/favicon.ico">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- font-awesome-->
  <link rel="stylesheet" href="<?= base_url() ?>assets/font-awesome/css/font-awesome.min.css">

  <!-- highcharts-->
  <script src="https://code.highcharts.com/highcharts.js"></script>

</head>

<div class="content container">
    <div class="alert alert-primary" role="alert"><center><h1>Mantenedor Indicadores</h1></center></div>
    <div class="row">
        <form id="form_indicadores" name="form_indicadores">
            <div class="col-md-12 form-row">
                <div class="col">
                        <select class="form-control" id="tipo_indicador" name="tipo_indicador">
                            <option value="">Seleccione tipo indicador</option>
                            <?php foreach ($indicadores as $tipoindi) {
                                echo '<option value="'.$tipoindi->cod_mindicador.'">'.$tipoindi->descripcion.'</option>';
                            } ?>
                        </select>
                </div>
                <div class="col" align="right">
                    <button type="button" class="btn btn-outline-info" onclick="buscar_datostabla()">Buscar Datos</button>
                </div>
            </div>
        </form>
    </div>
<div id="tabla_mantenedor"></div>

</div>                                   
<!-- Button -->
<div class="form-group">
    <div class="col" align="center">
        <a href="index" class="btn btn-outline-dark">Volver</a>
    </div>
</div>

<!-- datatables -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

<script src="<?= base_url() ?>assets/bootstrap/js/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	function buscar_datostabla()
	{
		tipo_indicador = $('#tipo_indicador').val();

		if(tipo_indicador == null || tipo_indicador=="")
        {
            Swal.fire({
			icon: 'error',
			title: 'Error...',
			text: 'Debe seleccionar el tipo de indicador!'
			})
        }
        else{
            $.ajax({
                // envia informacion a DB
                type:"POST",
                url:"<?= base_url() ?>ctrl_indicadores/cargar_tablamantenedor",
                data: $('#form_indicadores').serialize(),
                beforeSend: function () {
                  $("#tabla_mantenedor").html('<center><i class="fa fa-spinner fa-spin" style="font-size:200px"></i> <br> Cargando información...</center>');
                },
                success: function(response){
                  $('#tabla_mantenedor').html(response);
                },
                error: function(error){
                    console.log(error);
                    alert("Hay un Error");
                }
            });
        }
	}
</script>