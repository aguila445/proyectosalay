<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

class Estudiante extends CI_Controller
{
    public function indexlte()
    {
        if($this->session->userdata('login'))
        {
            $lista=$this->estudiante_model->listaestudiantes();
            $data['pais']=$lista;
    
            $this ->load->view('inclte/cabecera');
            $this ->load->view('inclte/menusuperior');
            $this ->load->view('inclte/menulateral');
            $this ->load->view('est_listalte',$data);
            $this ->load->view('inclte/pie');
        }
        else
        {
            redirect('usuarios/index','refresh');
        }
        
    }
    public function subirfoto()
    {
        if ($this->session->userdata('login')) {
            $data['idPais'] = $_POST['idPais'];
            $this->load->view('inclte/cabecera');
            $this->load->view('inclte/menusuperior');
            $this->load->view('inclte/menulateral');
            $this->load->view('subirform', $data);
            $this->load->view('inclte/pie');
        } else {
            redirect('usuarios/index/2', 'refresh');
        }
    }
    public function subir()
    {
        if ($this->session->userdata('login')) {
            $idPais = $_POST['idPais'];
            $nombreArchivo = $idPais . ".pdf";

            $config['upload_path'] = './uploads/estudiantes/';
            $config['file_name'] = $nombreArchivo;

            $direccion = "./uploads/estudiantes/" . $nombreArchivo;
            if (file_exists($direccion)) {
                unlink($direccion);
            }

            $config['allowed_types'] = 'pdf';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $data['error'] = $this->upload->display_errors();
            } else {
                $data['foto'] = $nombreArchivo;
                $this->estudiante_model->modificarestudiante($idPais, $data);
                $this->upload->data();
            }
            redirect('estudiante/indexlte', 'refresh');
        } else {
            redirect('usuarios/index/2', 'refresh');
        }
    }
    
    public function agregar()
    {
        //mostrar un formulario(vista) para agregar nuevo estudiante
        $this ->load->view('inclte/cabecera');
        $this ->load->view('inclte/menusuperior');
        $this ->load->view('inclte/menulateral');
        $this ->load->view('est_formulario');
        $this ->load->view('inclte/pie');
    }
    public function agregardb()// se construye $data
    {
        //$data es un array relacional
        // atrib. DB       Y   FORMULARIO
        $data['pais']=$_POST['pais'];
        $data['apellido']=$_POST['apellido'];// el primero es de la db y el segundo del formulario
        

        $this->estudiante_model->agregarestudiante($data);//invocamos el metodo

        redirect('estudiante/indexlte','refresh');
    }

    public function eliminardb()
    {
        $idPais=$_POST['idPais'];// tal como está en el formulario
        $this->estudiante_model->eliminarestudiante($idPais);
        redirect('estudiante/indexlte','refresh');
    }
   
    public function modificar()
    {
        $idPais=$_POST['idPais'];
        $data['infProducto']=$this->estudiante_model->recuperarestudiante($idPais);

        $this ->load->view('inclte/cabecera');
        $this ->load->view('inclte/menusuperior');
        $this ->load->view('inclte/menulateral');
        $this ->load->view('est_modificar',$data);
        $this ->load->view('inclte/pie');
    }

    public function modificardb()
    {
        $idPais=$_POST['idPais'];
        // el primero como en base
        $data['pais']=$_POST['pais'];
        $data['apellido']=$_POST['apellido'];
        $this->estudiante_model->modificarestudiante($idPais,$data);

        redirect('estudiante/indexlte','refresh');
    }
    public function deshabilitarbd()
    {
        $idPais=$_POST['idPais'];
        $data['habilitado']='0';

        $this->estudiante_model->modificarestudiante($idPais,$data);

        redirect('estudiante/indexlte','refresh');

    }
    public function deshabilitados()
	{
        $lista=$this->estudiante_model->listaestudiantedeshabilitado();
        $data['pais']=$lista;

        $this ->load->view('inclte/cabecera');
        $this ->load->view('inclte/menusuperior');
        $this ->load->view('inclte/menulateral');
		$this->load->view('est_listadeshabilitado',$data);
        $this ->load->view('inclte/pie');
		
	}
    public function habilitarbd()
    {
        $idPais=$_POST['idPais'];
        $data['habilitado']='1';

        $this->estudiante_model->modificarestudiante($idPais,$data);

        redirect('estudiante/deshabilitados','refresh');

    }
    public function invitadolte()
    {
        if ($this->session->userdata('login')) {
            $this ->load->view('inclte/cabecera');
            $this ->load->view('inclte/menusuperior');
            $this ->load->view('inclte/menulateral');
            $this->load->view('est_invitado');
            $this->load->view('inclte/pie');
        } else {
            redirect('usuarios/index/2', 'refresh');
        }
    }
}
