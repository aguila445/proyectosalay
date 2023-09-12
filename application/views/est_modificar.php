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
                <h3 class="card-title"> Modificar pais </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <!-- /todo depues del body -->
                <?php
                foreach($infProducto->result()as $row)
                {
                    echo form_open_multipart('estudiante/modificardb')
                ?>
                    <input type="hidden" name="idPais" id=""class="form-control" value="<?php echo $row->idPais;?>">
                    <input type="text" name="pais" id="" placeholder="Escriba el pais" class="form-control" value="<?php echo $row->pais;?>">
                    <input type="text" name="apellido" id="" placeholder="Escriba la apellido" class="form-control" value="<?php echo $row->apellido;?>">
                    <button type="submit" class="btn btn-primary">Modificar</button>
                <?php
                  echo form_close();
                }
                ?>
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