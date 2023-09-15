<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
    public function index()
    {
        $this->load->view('login');
        if ($this->session->userdata('login')) 
        {
            // Si el usuario ya está autenticado, redirígelo a su panel correspondiente
            $rol = $this->session->userdata('rol');
            
            switch ($rol) {
                case 'Administrador':
                    redirect('admin/panel', 'refresh');
                    break;
                case 'Encargado':
                    redirect('encargado/panel', 'refresh');
                    break;
                case 'Guía':
                case 'Fraterno':
                    redirect('usuario/panel', 'refresh');
                    break;
                default:
                    // Manejo de otros roles
                    break;
            }
        } 
        else 
        {
            $data['msg'] = $this->uri->segment(3);
            $this->load->view('login', $data);
        }
    }

    public function validarusuario()
    {
        $login = $_POST['login'];
        $password = md5($_POST['password']);

        // Supongo que tienes métodos para validar usuarios en tus modelos respectivos
        // Reemplaza 'usuario_model' por el modelo que corresponda a tu aplicación
        $usuario = $this->usuario_model->validar($login, $password);

        if ($usuario->num_rows() > 0) {
            $row = $usuario->row();
            $this->session->set_userdata('id', $row->id);
            $this->session->set_userdata('login', $row->login);
            $this->session->set_userdata('rol', $row->rol);
            
            switch ($row->rol) {
                case 'Administrador':
                    redirect('admin/panel', 'refresh');
                    break;
                case 'Encargado':
                    redirect('encargado/panel', 'refresh');
                    break;
                case 'Guía':
                case 'Fraterno':
                    redirect('usuario/panel', 'refresh');
                    break;
                default:
                    // Manejo de otros roles
                    break;
            }
        } else {
            redirect('usuarios/index/1', 'refresh'); // Redirige al login con un mensaje de error
        }
    }

    public function panel()
    {
        if ($this->session->userdata('login')) {
            $rol = $this->session->userdata('rol');
            switch ($rol) {
                case 'Administrador':
                    redirect('admin/panel', 'refresh');
                    break;
                case 'Encargado':
                    redirect('encargado/panel', 'refresh');
                    break;
                case 'Guía':
                case 'Fraterno':
                    // Redirige al panel de usuario
                    redirect('usuario/panel', 'refresh');
                    break;
                default:
                    // Manejo de otros roles
                    break;
            }
        } else {
            redirect('usuarios/index/2', 'refresh'); // Redirige al login con un mensaje de error
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('usuarios/index/3', 'refresh'); // Redirige al login con un mensaje de cierre de sesión
    }

    public function registrar() {
        // Cargar el modelo de usuarios
        $this->load->model('Usuario_model');

        // Recuperar los datos del formulario de registro
        $nombre = $this->input->post('nombre');
        $primerApellido = $this->input->post('primer_apellido');
        $segundoApellido = $this->input->post('segundo_apellido');
        $email = $this->input->post('email');
        $rol = $this->input->post('rol');

        // Llamar al método para registrar el usuario
        $this->Usuario_model->registrarNuevoUsuario($nombre, $primerApellido, $segundoApellido, $email, $rol);

        // Redireccionar o mostrar una vista de confirmación
        // Redirigir al usuario a una página de confirmación o mostrar un mensaje de éxito
    }
}
