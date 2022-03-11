<script type="text/javascript">
    function imprimir(){
        print();
    }
</script> 
<section class="content-header">
  <h1>
    <!--<i class="fa fa-file-text-o icon-title"></i> Medicamentos Proximos a Expirar-->
    <!--<a class="btn btn-primary btn-social pull-right" href="modules/expiration_report/print.php" target="_blank">
      <i class="fa fa-print"></i> Imprimir
    </a>-->
    <a class="btn btn-primary btn-social pull-right" onclick="imprimir()" target="_blank">
      <i class="fa fa-print"></i> Imprimir
    </a>
  </h1>

</section>
<div id="title" class="text-center">
    <h2>
        Medicamentos Proximos a Expirar
    </h2>
</div>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body">
        
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
          
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">Codigo</th>
                <th class="center">Cod. compra</th>
                <th class="center">Nombre de Medicamento</th>
                <th class="center">Categoria</th>
                <th class="center">Precio de compra</th>
                <th class="center">Precio de venta</th>
                <th class="center">Stock</th>
                <th class="center">Unidad</th>
                <th class="center">Vencimiento</th>
              </tr>
            </thead>
          
            <tbody>
            <?php  
            $no = 1;
            $fecha_actual = date("Y-m-d");
            $new_fecha = date("Y-m-d",strtotime($fecha_actual."+ 2 days"));//2 días antes muestra los mediacamentos a vencer
            $query = mysqli_query($mysqli, "SELECT m.*, tm.fecha_vencimiento, tm.codigo_transaccion
                                            from transaccion_medicamentos tm 
                                            left join medicamentos m on tm.codigo = m.codigo 
                                            where tm.fecha_vencimiento <= '$new_fecha' ORDER BY m.nombre ASC")
                                            or die('Error: '.mysqli_error($mysqli));

           
            while ($data = mysqli_fetch_assoc($query)) { 
              $precio_compra = format_rupiah($data['precio_compra']);
              $precio_venta = format_rupiah($data['precio_venta']);
             
              echo "<tr>
                      <td width='30' class='center'>$no</td>
                      <td width='80' class='center'>$data[codigo]</td>
                      <td width='80' class='center'>$data[codigo_transaccion]</td>
                      <td width='180'>$data[nombre]</td>
                      <td width='50'>$data[categoria]</td>
                      <td width='100' align='right'>Bs. $precio_compra</td>
                      <td width='100' align='right'>Bs. $precio_venta</td>
                      <td width='80' align='right'>$data[stock]</td>
                      <td width='80' class='center'>$data[unidad]</td>
                      <td width='80' class='center'>$data[fecha_vencimiento]</td>
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