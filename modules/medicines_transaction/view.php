

<section class="content-header">
  <h1>
    <i class="fa fa-sign-in icon-title"></i> Registro de medicamentos

    <a class="btn btn-primary btn-social pull-right" href="?module=form_medicines_transaction&form=add" title="Agregar" data-toggle="tooltip">
      <i class="fa fa-plus"></i> Entradas
    </a>
  </h1>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">

    <?php  

    if (empty($_GET['alert'])) {
      echo "";
    } 

    elseif ($_GET['alert'] == 1) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Exito!</h4>
              Datos de medicamentos han sido registrado correctamente.
            </div>";
    }
    ?>

      <div class="box box-primary">
        <div class="box-body table-responsive">
         
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
           
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">Codigo de Transación</th>
                <th class="center">Fecha</th>
                <th class="center">Codigo</th>
                <th class="center">Medicamento</th>
                <th class="center">Tipo</th>
                <th class="center">Cant.</th>
                <th class="center">Unidad</th>
                <th class="center">Fecha Venc.</th>
              </tr>
            </thead>
         
            <tbody>
            <?php  
            $no = 1;
           
            $query = mysqli_query($mysqli, "SELECT a.tipo_transaccion, a.codigo_transaccion,a.fecha,a.codigo,a.numero,b.codigo,b.nombre,b.unidad,
                                            a.fecha_vencimiento
                                            FROM transaccion_medicamentos as a INNER JOIN medicamentos as b ON a.codigo=b.codigo ORDER BY codigo_transaccion DESC")
                                            or die('error '.mysqli_error($mysqli));

           
            while ($data = mysqli_fetch_assoc($query)) { 
              $fecha         = $data['fecha'];
              $exp             = explode('-',$fecha);
              $fecha2   = $exp[2]."-".$exp[1]."-".$exp[0];

                if($data['fecha_vencimiento'] == "" || $data['fecha_vencimiento'] == null || $data['fecha_vencimiento'] == "0000-00-00"){
                    $lafecha_ven = "";
                }else{
                    $lafecha_ven = date("d/m/Y", strtotime($data['fecha_vencimiento']));
                }
              echo "<tr>
                      <td width='30' class='center'>$no</td>
                      <td width='100' class='center'>$data[codigo_transaccion]</td>
                      <td width='80' class='center'>$fecha</td>
                      <td width='80' class='center'>$data[codigo]</td>
                      <td width='200'>$data[nombre]</td>
					  <td width='80' class='center'>$data[tipo_transaccion]</td>
                      <td width='100' align='right'>$data[numero]</td>
                      <td width='80' class='center'>$data[unidad]</td>
                      <td width='80' class='center'>".$lafecha_ven."</td>
                    </tr>";
              $no++;
            }
            ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content