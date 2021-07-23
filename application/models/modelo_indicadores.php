<?php
class modelo_indicadores extends CI_Model 
{ 
   public function __construct() 
   {
      parent::__construct();
   }

   public function tiposindicadores() //función que obtiene los diferentes tipos de indicadores
   {
        $tipoindicador = $this->db->get('tipo_indicador');
        if($tipoindicador->num_rows()>0) {
            return $tipoindicador->result();
        }
   }

   public function obtener_tipoindicador($tipo_indicador) //función que obtiene un tipo de indicador específico
   {
      $this->db->select('*');
      $this->db->from('tipo_indicador');
      $this->db->where('cod_mindicador',$tipo_indicador);
      $consulta = $this->db->get();
      $resultado = $consulta->row();
      return $resultado;
   }

   public function consultar_indicador($tipo_indicador, $fecha) // función que indica si existe o no un indicador en una fecha.
   {
      $this->db->select('*');
      $this->db->from('indicador indi');
      $this->db->where('indi.tipo_indicador',$tipo_indicador);
      $this->db->where('indi.fecha',$fecha);
      $consulta = $this->db->get();
      $resultado = $consulta->row();
      if($resultado == null or $resultado == '') 
      {
         return 0;
      }
      else{
         return 1;
      }
   }

   public function ingresar_indicador($data)
   {
      return $this->db->insert('indicador',$data);
   }

   public function cargartabla_indicadores($tipo_indicador) //función que obtiene los indicadores dado un tipo
   {
      $consulta=$this->db->query('SELECT indi.id_indicador, tip.descripcion, indi.valor, indi.fecha
                                 from indicador indi, tipo_indicador tip
                                 WHERE indi.tipo_indicador = tip.id_tipo
                                 and tip.cod_mindicador = "'.$tipo_indicador.'"
                                 order by indi.fecha');
      $resultado=$consulta->result();
      return $resultado;

   }

   public function actualizar_datosindicador($id_indicador, $data)
   {
      $this->db->where('id_indicador', $id_indicador);
      $this->db->update('indicador', $data);
   }
}