<table id="tablaindicadores" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th></th>
                <th align="center">id indicador</th>
                <th align="center">Tipo indicador</th>
                <th align="center">Valor</th>
                <th align="center">Fecha</th>
                <th align="center">Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datos_indicadores as $di) {
                echo '<tr>
                        <td></td>
                        <td>'.$di->id_indicador.'</td>
                        <td>'.$di->descripcion.'</td>
                        <td>'.$di->valor.'</td>
                        <td>'.date("d-m-Y", strtotime($di->fecha)).'</td>
                        <td align="center"><a data-toggle="modal" onclick="Editar_datoindicador('.$di->id_indicador.',\''.$di->descripcion.'\',\''.$di->valor.'\',\''.date("d-m-Y", strtotime($di->fecha)).'\')"><button class="btn btn-info">Editar</button></a></td>
                    </tr>';
            }
            ?>
        </tbody>
    </table>

    <!-- Inicio ventana Modal editar indicador -->
    <div class="modal fade text-left" id="modal_editar" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h3 class="modal-title">
                    <i class="ft ft-edit"></i>
                    <span class="font-weight-bold">Editar Indicador </span>
                </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_actualizar">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <lavel>Tipo indicador</lavel>
                                <input type="text" class="form-control" id="tipo_indicador_modal" readonly></input>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <lavel>Fecha</lavel>
                                <input type="text" class="form-control" id="fecha" readonly></input>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <lavel>Valor</lavel>
                                <input type="number" class="form-control" name="valor" id="valor"></input>
                                <input type="hidden" name="id_indicador" id="id_indicador"></input>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="reset" class="btn btn-outline-secondary btn-sm" data-dismiss="modal" value="Cerrar">
                    <input type="button" class="btn btn-outline-primary btn-sm" onclick="actualizar_datos()" value="Actualizar">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fin ventana Modal -->

<!-- datatables -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

<script src="<?= base_url() ?>assets/bootstrap/js/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>  


<script type="text/javascript">
    $(document).ready(function() {
      $('#tablaindicadores').DataTable({
          "language": {
            "lengthMenu": "Mostrar _MENU_ Registros",
            "zeroRecords": "No hay Registros",
            "info": "Mostrando _PAGE_ de _PAGES_",
            "infoEmpty": "No se encotraron registros",
            "infoFiltered": "(filtrado de _MAX_ registros)",
            "sSearch":"Buscar : ",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            buttons: {
                colvis: 'Mostrar Columnas',
                copy: 'Copiar',
                print: 'Imprimir',
            }
        },
        "aoColumnDefs": [{ 
            "bVisible": false, 
            "aTargets": [0,0,0] 
        }],
        dom: 'Bfrtip',
        buttons: [
            'colvis','excel', 'print'
        ]
      });
  } );

function Editar_datoindicador(id, tipo, valor, fecha) {
    $('#id_indicador').val(id);
    $('#tipo_indicador_modal').val(tipo);
    $('#valor').val(valor); 
    $('#fecha').val(fecha);
    $('#modal_editar').modal('show');
}

function actualizar_datos()
{
    valor = $('#valor').val();

		if(valor == 0 || valor=="")
        {
            Swal.fire({
			icon: 'error',
			title: 'Error...',
			text: 'Debe ingresar un valor distinto de 0!'
			})
        }
        else{
            $.ajax({
                // envia informacion a DB
                type:"POST",
                url:"<?= base_url() ?>ctrl_indicadores/actualizar_indicador",
                data: $('#form_actualizar').serialize(),
                success: function(response){
                    Swal.fire({
                    icon: 'success',
                    title: 'Hecho',
                    text: 'Dato actualizado correctamente!',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }else{
                            location.reload();
                        }
                    })
                    
                },
                error: function(error){
                    console.log(error);
                    Swal.fire({
                    icon: 'error',
                    title: 'Error...',
                    text: 'Hay un error!!'
                    })
                }
            });
        }
}
</script>

