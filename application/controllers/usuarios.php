defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('login')) {
            redirect('usuarios/panel', 'refresh');
        } else {
            $data['msg'] = $this->uri->segment(3);
            $this->load->view('login', $data);
        }
    }

    public function validarusuario()
    {
        $login = $_POST['login'];
        $password = md5($_POST['password']);

        // Aquí debes implementar la lógica para validar al usuario
        // Utiliza los modelos y funciones correspondientes para verificar las credenciales

        $consulta = $this->usuario_model->validar($login, $password);

        if ($consulta->num_rows() > 0) {
            foreach ($consulta->result() as $row) {
                $this->session->set_userdata('idusuario', $row->idUsuario);
                $this->session->set_userdata('login', $row->login);
                $this->session->set_userdata('tipo', $row->rol);

                // Redirige según el rol del usuario (administrador, encargado, guía, fraterno)
                if ($row->rol == 'Administrador') {
                    redirect('admin/panel', 'refresh');
                } elseif ($row->rol == 'Encargado') {
                    redirect('encargado/panel', 'refresh');
                } elseif ($row->rol == 'Guía') {
                    redirect('guia/panel', 'refresh');
                } elseif ($row->rol == 'Fraterno') {
                    redirect('fraterno/panel', 'refresh');
                }
            }
        } else {
            redirect('usuarios/index/1', 'refresh'); // Error de inicio de sesión
        }
    }

    public function panel()
    {
        if ($this->session->userdata('login')) {
            $tipo = $this->session->userdata('tipo');

            // Redirige según el rol del usuario
            if ($tipo == 'Administrador') {
                redirect('admin/panel', 'refresh');
            } else {
                redirect('usuario/panel', 'refresh');
            }
        } else {
            redirect('usuarios/index/2', 'refresh'); // Usuario no autenticado
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('usuarios/index/3', 'refresh'); // Usuario cerró sesión
    }
}
