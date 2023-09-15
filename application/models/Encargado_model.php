<?php
    class Estudiante_model extends CI_Model{
        public function listaestudiantes()
        {
            $this->db->select('*');
            $this->db->from('pais');
            $this->db->where('habilitado','1');
            return $this->db->get();
        }
        public function listaestudiantedeshabilitado()
        {
            $this->db->select('*');
            $this->db->from('pais');
           $this->db->where('habilitado','0');
            return $this->db->get();
        }

        public function agregarestudiante($data)
        {
            $this->db->insert('pais',$data); //$data es un array relacional, se contruye en agregabd
        }

        public function eliminarestudiante($idPais)
        {
            $this->db->where('idPais',$idPais);// El primero es de la base de datos
            $this->db->delete('pais');
            //$data es un array relacional, se contruye en agregabd
        }
        public function recuperarestudiante($idPais)
        {
            $this->db->select('*');
            $this->db->from('pais');
            $this->db->where('idPais',$idPais);// El primero es de la base de datos, el segundo se recibe del parametro
            return $this->db->get();
        }

        public function modificarestudiante($idPais,$data)
        {
            $this->db->where('idPais',$idPais);// El primero es de la base de datos, el segundo se recibe del parametro
            $this->db->update('pais',$data);
        }

    }