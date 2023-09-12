<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lista de paises</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Lista de Paises Descartados </h3>
                <br>
                <a href="<?php echo base_url(); ?>index.php/estudiante/indexlte">
                    <button type="button" class="btn btn-warning">Ver lista habilitados</button>
                </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- /todo depues del body -->
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>n°</th>
                        <th>Pais</th>
                        <th>Apellido</th>                    
                        <th>Habilitar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $indice=1;
                    foreach($pais->result() as $row)
                    {
                    ?>
                    <tr>
                        <td><?php echo $indice;?></td>
                        <td><?php echo $row->pais;?></td>
                        <td><?php echo $row->apellido;?></td>                      
                        <td>
                            <?php
                                echo form_open_multipart('estudiante/habilitarbd');
                            ?>
                                <input type="hidden" name="idPais" value="<?php echo $row->idPais; ?>">
                                <button type="submit" class="btn btn-warning">HABILITAR</button>        
                            <?php
                                echo form_close();
                            ?>        
                        </td>
                    </tr>
                    <?php
                    $indice++;
                    }
                    ?> 
                  </tbody>              
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

