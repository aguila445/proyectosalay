<?php
class Usuario_model extends CI_Model {

    public function validar($login, $password) {
        // Consulta para validar el usuario y contraseña
        $query = $this->db->get_where('usuarios', array('login' => $login, 'password' => md5($password)));

        return $query;
    }

    public function registrarNuevoUsuario($nombre, $primerApellido, $segundoApellido, $correoElectronico, $rol) {
        // Generar un login a partir de nombre y apellidos
        $login = $this->generarLogin($nombre, $primerApellido, $segundoApellido);

        // Generar una contraseña aleatoria
        $password = $this->generarPassword();

        // Insertar los datos en la base de datos
        $data = array(
            'nombre' => $nombre,
            'primerApellido' => $primerApellido,
            'segundoApellido' => $segundoApellido,
            'correoElectronico' => $correoElectronico,
            'login' => $login,
            'password' => md5($password), // Hashear la contraseña
            'rol' => $rol,
            'estado' => 'Habilitado' // Opcional: Establecer el estado inicial
        );

        $this->db->insert('usuarios', $data);

        // Enviar el correo electrónico con las credenciales
        $this->enviarCredencialesPorCorreo($login, $password, $correoElectronico);
    }

    private function generarLogin($nombre, $primerApellido, $segundoApellido) {
        // Generar un login único a partir del nombre y apellidos (puedes personalizar esto)
        $nombre = strtolower($nombre);
        $primerApellido = strtolower($primerApellido);
        $segundoApellido = strtolower($segundoApellido);
        $login = $nombre . '_' . $primerApellido . '_' . $segundoApellido;
        // Puedes agregar lógica adicional para asegurarte de que el login sea único
        return $login;
    }

    private function generarPassword() {
        // Generar una contraseña segura (puedes personalizar esto)
        return bin2hex(random_bytes(8)); // Generar una contraseña de 16 caracteres hexadecimal
    }

    private function enviarCredencialesPorCorreo($login, $password, $correoElectronico) {
        // Implementa aquí la lógica para enviar un correo electrónico con las credenciales
        // Puedes utilizar la librería de envío de correo electrónico de CodeIgniter o alguna otra.
        // Asegúrate de configurar la función de envío de correo electrónico en tu aplicación.
    }
}
?>
