<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('clientes_model');
                $this->load->helper('url_helper');
        }

        public function index(){
                $data['clientes'] = $this->clientes_model->get_clients();
                $data['title'] = 'Clientes';
                $data['crear'] = TRUE;
                $data['section'] ='clientes';
                $this->load->view('_template_header',$data);
        	    $this->load->view('listar_clientes',$data);
                $this->load->view('crear_editar_cliente',$data);
                $this->load->view('_template_footer');
                
        }

        public function crear_editar_cliente($id = NULL){

        	if (is_null($id)){
        		$data['crear'] = TRUE;
                $data['section'] ='clientes';
        		$this->load->view('crear_editar_cliente',$data);
        	} else {
        		$data['crear'] = FALSE;
                $data['section'] ='clientes';
        		$data['cliente'] = $this->clientes_model->get_clients($id);
        		$this->load->view('crear_editar_cliente',$data);
        	}
        	
        }


        public function guardar_cliente($id = NULL){
        	if (is_null($id)){
	        	if ($this->clientes_model->insert_clients()){
                    /*
	        		echo "cliente guardado correctamente<br>";
	        		echo "<a href=".site_url('').">Inicio</a><br>";
	        		echo "<a href=".site_url('clientes').">Clientes</a>";
	        	    */
                    redirect('Clientes/');
                } else {
	        		echo "hubo un f error :(";
	        	}
	        } else {
	        	if ($this->clientes_model->update_clients($id)){
	        		/*
                    echo "cliente editado correctamente<br>";
	        		echo "<a href=".site_url('').">Inicio</a><br>";
	        		echo "<a href=".site_url('clientes').">Clientes</a>";
                    */
                    redirect('Clientes/');
	        	} else {
	        		echo "hubo un f error :(";
	        	}
	        }
        }

        public function confirmar_borrar_cliente($id){
        	$data['cliente'] = $this->clientes_model->get_clients($id);
            $data['section'] ='clientes';
        	$this->load->view('confirmar_borrar_cliente',$data);
        }

        public function borrar_cliente($id){
        	$this->clientes_model->delete_clients($id);
        	redirect('clientes');
        }

         public function ajax_borrar_cliente(){
                $idCliente = $this->input->post('cliente_id');
                if ($idCliente!= null AND $idCliente!=''){
                        $this->clientes_model->delete_clients($idCliente);
                        $respuesta['result'] = "ok"; 
                        $respuesta['mensaje'] = "f yeah";
                } else {
                        $respuesta['result'] = "error"; 
                        $respuesta['mensaje'] = "Faltan parametros";
                         
                }
                //$result = array('result'=>"borrado");
                echo json_encode($respuesta);
                // exit;
         }

         public function ajax_editar_cliente(){
            $idCliente = $this->input->post('cliente_id');
            $nombreCliente = $this->input->post('cliente_nombre');
            $apellidoCliente = $this->input->post('cliente_apellido');
            $mailCliente = $this->input->post('cliente_mail');
            //podría también chequear por el resto de los parámetros..
            if ($idCliente!=null && $idCliente!="" ){
                $cliente = $this->clientes_model->update_clients($idCliente,$nombreCliente,$apellidoCliente,$mailCliente);
                if ($cliente != null){
                    $respuesta['result'] = "ok"; 
                    $respuesta['mensaje'] = ":D";
                    $respuesta['cliente'] = $cliente;
                } else {
                    $respuesta['result'] = "error"; 
                    $respuesta['message'] = "fallo algo al intentar actualizar?";
                    $respuesta['cliente'] = "";
                }
            } else {
                $respuesta['result'] = "error"; 
                $respuesta['message'] = "Faltan parametros";
                $respuesta['cliente'] = "";
            }

            echo json_encode($respuesta);
            
        }
}