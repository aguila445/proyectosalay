<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdministradorController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Agrega aquí la lógica de autenticación y verificación de roles
        // Por ejemplo, verifica si el usuario tiene el rol de administrador
        if (!$this->session->userdata('login') || $this->session->userdata('rol') !== 'Administrador') {
            redirect('login'); // Redirige al inicio de sesión si no está autenticado o no tiene el rol adecuado
        }

        // Carga el modelo de usuario
        $this->load->model('Usuario_model');
    }

    public function index()
    {
        // Lógica para la página de inicio del administrador
        // Por ejemplo, muestra un panel de control o estadísticas
    }

    public function crearUsuario()
    {
        // Verifica si el método de solicitud es POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Realiza las validaciones de datos recibidos por POST
            $this->form_validation->set_rules('nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('correo', 'Correo Electrónico', 'required|valid_email');
            // Agrega más reglas de validación según tus necesidades

            // Comprueba si todas las validaciones son exitosas
            if ($this->form_validation->run() === true) {
                // Procesa los datos y crea el usuario en la base de datos
                $nombre = $this->input->post('nombre');
                $correo = $this->input->post('correo');
                // Agrega aquí la lógica para crear el usuario con los datos proporcionados

                // Redirige o muestra un mensaje de éxito
            } else {
                // En caso de validación fallida, muestra los errores
                $this->load->view('formulario_creacion_usuario');
            }
        } else {
            // Muestra el formulario de creación de usuario
            $this->load->view('formulario_creacion_usuario');
        }
    }

    public function modificarUsuario($id)
    {
        // Verifica si el método de solicitud es POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Realiza las validaciones de datos recibidos por POST
            $this->form_validation->set_rules('nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('correo', 'Correo Electrónico', 'required|valid_email');
            // Agrega más reglas de validación según tus necesidades

            // Comprueba si todas las validaciones son exitosas
            if ($this->form_validation->run() === true) {
                // Procesa los datos y modifica el usuario en la base de datos
                $nombre = $this->input->post('nombre');
                $correo = $this->input->post('correo');
                // Agrega aquí la lógica para modificar el usuario con los datos proporcionados

                // Redirige o muestra un mensaje de éxito
            } else {
                // En caso de validación fallida, muestra los errores
                $this->load->view('formulario_modificacion_usuario');
            }
        } else {
            // Muestra el formulario de modificación de usuario
            $this->load->view('formulario_modificacion_usuario');
        }
    }

    public function habilitarUsuario($id)
    {
        // Lógica para habilitar un usuario
        $this->load->model('Usuario_model');
        $this->Usuario_model->cambiarEstadoUsuario($id, 'Habilitado');
        redirect('administrador'); // Redirige de nuevo a la página de administración
    }
    
    public function deshabilitarUsuario($id)
    {
        // Lógica para deshabilitar un usuario
        $this->load->model('Usuario_model');
        $this->Usuario_model->cambiarEstadoUsuario($id, 'Deshabilitado');
        redirect('administrador'); // Redirige de nuevo a la página de administración
    }
    
    public function eliminarUsuario($id)
    {
        // Lógica para eliminar un usuario
        $this->load->model('Usuario_model');
        $this->Usuario_model->eliminarUsuario($id);
        redirect('administrador'); // Redirige de nuevo a la página de administración
    }
    
    public function generarReporte()
    {
        // Lógica para generar reportes
        $this->load->model('Usuario_model');
        $data['usuarios'] = $this->Usuario_model->obtenerTodosUsuarios(); // Reemplaza esto con la lógica real para obtener usuarios
        // Agrega aquí la lógica para generar el reporte usando los datos obtenidos
        // Puedes utilizar bibliotecas de generación de reportes como TCPDF, FPDF, o cualquier otra según tus necesidades
    
        // Carga una vista con el reporte o realiza la acción correspondiente
    }
}
