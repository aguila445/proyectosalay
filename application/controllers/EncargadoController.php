<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EncargadoController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Agrega aquí la lógica de autenticación y verificación de roles
        // Por ejemplo, verifica si el usuario tiene el rol de encargado
        if (!$this->session->userdata('login') || $this->session->userdata('rol') !== 'Encargado') {
            redirect('login'); // Redirige al inicio de sesión si no está autenticado o no tiene el rol adecuado
        }
    }

    public function index()
    {
        // Lógica para la página de inicio del encargado
        // Puedes cargar una vista con el panel de control del encargado
        $this->load->view('encargado_panel');
    }

    public function crearFraterno()
    {
        // Verifica si el método de solicitud es POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Realiza las validaciones de datos recibidos por POST
            $this->form_validation->set_rules('nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('correo', 'Correo Electrónico', 'required|valid_email');
            // Agrega más reglas de validación según tus necesidades

            // Comprueba si todas las validaciones son exitosas
            if ($this->form_validation->run() === true) {
                // Procesa los datos y crea el fraterno en la base de datos
                // Lógica para crear nuevos fraternos en la sucursal
                $this->load->model('Fraterno_model');
                $nombre = $this->input->post('nombre');
                $correo = $this->input->post('correo');
                // Agrega aquí la lógica para crear un nuevo fraterno
                // Utiliza el modelo Fraterno_model para interactuar con la base de datos
                // Después de crear al fraterno, puedes redirigirlo a la página de gestión de fraternos
                redirect('encargado/gestionarFraternos');
            } else {
                // En caso de validación fallida, muestra los errores
                $this->load->view('formulario_creacion_fraterno');
            }
        } else {
            // Muestra el formulario de creación de fraternos
            $this->load->view('formulario_creacion_fraterno');
        }
    }

    public function modificarFraterno($id)
    {
        // Verifica si el método de solicitud es POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Realiza las validaciones de datos recibidos por POST
            $this->form_validation->set_rules('nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('correo', 'Correo Electrónico', 'required|valid_email');
            // Agrega más reglas de validación según tus necesidades

            // Comprueba si todas las validaciones son exitosas
            if ($this->form_validation->run() === true) {
                // Procesa los datos y modifica el fraterno en la base de datos
                // Lógica para modificar un fraterno existente
                $this->load->model('Fraterno_model');
                $nombre = $this->input->post('nombre');
                $correo = $this->input->post('correo');
                // Agrega aquí la lógica para modificar al fraterno con el ID proporcionado
                // Utiliza el modelo Fraterno_model para interactuar con la base de datos
                // Después de modificar al fraterno, puedes redirigirlo a la página de gestión de fraternos
                redirect('encargado/gestionarFraternos');
            } else {
                // En caso de validación fallida, muestra los errores
                $this->load->view('formulario_modificacion_fraterno');
            }
        } else {
            // Muestra el formulario de modificación de fraterno
            $this->load->view('formulario_modificacion_fraterno');
        }
    }

    public function eliminarFraterno($id)
    {
        // Lógica para eliminar un fraterno
        $this->load->model('Fraterno_model');
        // Agrega aquí la lógica para eliminar al fraterno con el ID proporcionado
        // Utiliza el modelo Fraterno_model para interactuar con la base de datos
        // Después de eliminar al fraterno, puedes redirigirlo a la página de gestión de fraternos
        redirect('encargado/gestionarFraternos');
    }

    public function gestionarEventos()
    {
        // Lógica para la gestión de eventos
        // Puedes cargar una vista con el panel de gestión de eventos del encargado
        $this->load->view('encargado_gestion_eventos');
    }
}
?>

