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
                <h3 class="card-title"> productos habilitados </h3>
                <br>
                <a href="<?php echo base_url();?>index.php/estudiante/agregar">
                    <button type="button" class="btn btn-primary">Crear Pais</button>
                </a>
                <a href="<?php echo base_url(); ?>index.php/estudiante/deshabilitados">
                  <button type="button" class="btn btn-warning">Ver lista descartados</button>
                </a>
                <a href="<?php echo base_url(); ?>index.php/usuarios/logout">
                  <button type="button" class="btn btn-warning">Cerrar sesion</button>
                </a>
<br>
<h3>
  login:<?php echo $this->session->userdata('login');?><br>
  id:<?php echo $this->session->userdata('idusuario');?><br>
  tipo:<?php echo $this->session->userdata('tipo');?><br>
</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>n°</th> 
                      <th>Nombre</th>
                      <th>Apellido</th>                   
                      <th>Creacion</th>
                      <th>Curriculo</th>
                      <th>Modificar</th>
                      <th>Eliminar</th>
                      <th>desabilitar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $indice=1;//CONTADOR CORRELATIVO
                        foreach($pais->result()as $row)
                        { 
                            //Debe coincidir los nombres de la tabla en la BD
                            //El id nunca debe mostrarse  
                    ?>
                        <tr>
                          <td><?php echo $indice;?></td>
                          <td><?php echo $row->pais;?></td>
                          <td><?php echo $row->apellido;?></td>
                          <td><?php echo formatearFecha($row->creado);?></td>
                          <!--Se ocupa subir fotos-->
                          <td>
                                    <?php
                                    $foto = $row->foto;
                                    if ($foto == "") {
                                    ?>
                                        <img width="100" src="<?php echo base_url(); ?>uploads/estudiantes/default.png">
                                    <?php
                                    } else {
                                    ?>
                                        <a href="<?php echo base_url(); ?>uploads/estudiantes/<?php echo $foto; ?>" target="_blank">
                                         <img width="100" src="<?php echo base_url(); ?>uploads/estudiantes/pdficon.png">
                                        </a>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    echo form_open_multipart('estudiante/subirfoto');
                                    ?>
                                    <input type="hidden" name="idPais" value="<?php echo $row->idPais; ?>">
                                    <button type="submit" class="btn btn-warning">
                                        Subir
                                    </button>
                                    <?php
                                    echo form_close();
                                    ?>
                                </td>
                                <!--final para fotos-->
                          <td>
                                <?php
                                    echo form_open_multipart('estudiante/modificar')
                                ?>
                                    <input type="hidden" name="idPais" value="<?php echo $row->idPais;?>">
                                    <!--Se ocupa el tipo hidden para ocultar los id en la página-->

                                    <button type="submit" class="btn btn-primary">Modificar</button>
                                <?php
                                    echo form_close()
                                ?> 
                          </td>
                          <td>
                                <?php
                                    echo form_open_multipart('estudiante/eliminardb')
                                ?>
                                    <input type="hidden" name="idPais" value="<?php echo $row->idPais;?>">
                                    <!--Se ocupa el tipo hidden para ocultar los id en la página-->
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                <?php
                                    echo form_close()
                                ?> 
                          </td>
                          <td>
                                <?php
                                    echo form_open_multipart('estudiante/deshabilitarbd');
                                ?>
                                  <input type="hidden" name="idPais" value="<?php echo $row->idPais; ?>">
                                  <button type="submit" class="btn btn-warning">DESHABILITAR</button>        
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