defined('BASEPATH') or exit('No direct script access allowed');

class FraternoController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Agrega aquí la lógica de autenticación y verificación de roles
        // Por ejemplo, verifica si el usuario tiene el rol de fraterno
        if (!$this->session->userdata('login') || $this->session->userdata('rol') !== 'Fraterno') {
            redirect('login'); // Redirige al inicio de sesión si no está autenticado o no tiene el rol adecuado
        }
    }

    public function index()
    {
        // Lógica para la página de inicio del fraterno
    }

    public function registrarAsistencia()
    {
        // Lógica para registrar la asistencia a actividades y eventos
        // Aquí debes agregar la lógica para procesar el registro de asistencia
        // Valida los datos recibidos y realiza las operaciones necesarias en la base de datos
    }

    public function historialActividades()
    {
        // Lógica para ver el historial de actividades
    }

    public function verPagos()
    {
        // Lógica para ver los pagos realizados
    }

    // Agrega más acciones relacionadas con la gestión de fraternos aquí
}

