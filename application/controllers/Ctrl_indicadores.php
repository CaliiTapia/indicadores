<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_indicadores extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('modelo_indicadores');
	}

	public function index()
	{
		$data['indicadores'] = $this->modelo_indicadores->tiposindicadores();
		$this->load->view('indicadores', $data);
	}
	public function obtener_indicadores()
	{
		$tipo_indicador = $this->input->post('tipo_indicador');
		$valores_indicador = $this->modelo_indicadores->obtener_tipoindicador($tipo_indicador);
		$valores_indicador = (object)$valores_indicador;

		$data['tipo_indicador'] = $this->modelo_indicadores->obtener_tipoindicador($tipo_indicador);
		$url1 = 'https://mindicador.cl/api/'.$tipo_indicador.'/05-07-2021';
		$valor_1 = $this->obtener_datos($url1);// se llama a la función de la Api
		$valor_uno = $valor_1;
		$data['uno'] = $valor_uno;
		$valores_1 = (object)$valor_uno;
		
		//aqui se inserta el dato
		$existe_indicador1 = $this->modelo_indicadores->consultar_indicador($valores_indicador->id_tipo, '2021-07-05');
		if($existe_indicador1 == 0) //significa que no existe el dato, se hace el insert.
		{
			$this->insertar_indicadores($valores_indicador->id_tipo, $valores_1->valor, '2021-07-05');
		}

		$url2 = 'https://mindicador.cl/api/'.$tipo_indicador.'/06-07-2021';
		$valor_2 = $this->obtener_datos($url2);
		$valor_dos = $valor_2;
		$data['dos'] = $valor_dos;
		$valores_2 = (object)$valor_dos;
		$existe_indicador2 = $this->modelo_indicadores->consultar_indicador($valores_indicador->id_tipo, '2021-07-06');
		if($existe_indicador2 == 0) //significa que no existe el dato, se hace el insert.
		{
			$this->insertar_indicadores($valores_indicador->id_tipo, $valores_2->valor, '2021-07-06');
		}

		$url3 = 'https://mindicador.cl/api/'.$tipo_indicador.'/07-07-2021';
		$valor_3 = $this->obtener_datos($url3);
		$valor_tres = $valor_3;
		$data['tres'] = $valor_tres;
		$valores_3 = (object)$valor_tres;
		$existe_indicador3 = $this->modelo_indicadores->consultar_indicador($valores_indicador->id_tipo, '2021-07-07');
		if($existe_indicador3 == 0) //significa que no existe el dato, se hace el insert.
		{
			$this->insertar_indicadores($valores_indicador->id_tipo, $valores_3->valor, '2021-07-07');
		}

		$url4 = 'https://mindicador.cl/api/'.$tipo_indicador.'/08-07-2021';
		$valor_4 = $this->obtener_datos($url4);
		$valor_cuatro = $valor_4;
		$data['cuatro'] = $valor_cuatro;
		$valores_4 = (object)$valor_cuatro;
		$existe_indicador4 = $this->modelo_indicadores->consultar_indicador($valores_indicador->id_tipo, '2021-07-08');
		if($existe_indicador4 == 0) //significa que no existe el dato, se hace el insert.
		{
			$this->insertar_indicadores($valores_indicador->id_tipo, $valores_4->valor, '2021-07-08');
		}

		$url5 = 'https://mindicador.cl/api/'.$tipo_indicador.'/09-07-2021';
		$valor_5 = $this->obtener_datos($url5);
		$valor_cinco = $valor_5;
		$data['cinco'] = $valor_cinco;
		$valores_5 = (object)$valor_cinco;
		$existe_indicador5 = $this->modelo_indicadores->consultar_indicador($valores_indicador->id_tipo, '2021-07-09');
		if($existe_indicador5 == 0) //significa que no existe el dato, se hace el insert.
		{
			$this->insertar_indicadores($valores_indicador->id_tipo, $valores_5->valor, '2021-07-09');
		}

		$this->load->view('indicadores_graficos', $data);
	}

	public function obtener_datos($apiUrl) //función que obtiene datos de la Api mindicador
	{
		$curl = curl_init($apiUrl);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$json = curl_exec($curl);
		curl_close($curl);
		$resultado = json_decode($json);
		if (isset($resultado->serie[0])) {
			return $resultado->serie[0];
		}
		else{ 
			return '0'; //significa que no hay datos
		}
	}

	private function insertar_indicadores($tipo, $valor, $fecha) //función que inserta un indicador 
	{
		$data = array(
			'tipo_indicador' => $tipo,
			'valor' => $valor,
			'fecha' => $fecha
		);
		$this->modelo_indicadores->ingresar_indicador($data);
	}

	public function cargar_mantenedor() //función que carga la vista del mantenedor
	{
		$data['indicadores'] = $this->modelo_indicadores->tiposindicadores();
		$this->load->view('mantenedor_indicadores', $data);
	}

	public function cargar_tablamantenedor() //función que carga la tabla del mantenedor dado un tipo de indicador
	{
		$tipo_indicador = $this->input->post('tipo_indicador');
		$data['datos_indicadores'] = $this->modelo_indicadores->cargartabla_indicadores($tipo_indicador);
		$data['indicadores'] = $this->modelo_indicadores->tiposindicadores();
		$this->load->view('tabla_mantenedor', $data);
	}	

	public function actualizar_indicador()
	{
		$valor = $this->input->post('valor');
		$id_indicador = $this->input->post('id_indicador');
			$data = array(
			'valor' => $valor
		);
		$this->modelo_indicadores->actualizar_datosindicador($id_indicador, $data);
		return 1;
	}
}
