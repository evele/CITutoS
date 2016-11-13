<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cosas extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('Cosas_model');
                $this->load->helper('url_helper');
        }

        public function index(){
        	$data['cosas'] = $this->Cosas_model->get_cosas();
        	$data['title'] = 'Cosas';
            $data['section'] ='cosas';
                $this->load->view('_template_header',$data);
                $this->load->view('listar_cosas',$data);
                $this->load->view('_template_footer');
        }

        public function crear_editar_cosa($id = NULL){

        	if (is_null($id)){
        		$data['crear'] = TRUE;
                $data['section'] ='cosas';
        		$this->load->view('crear_editar_cosa',$data);
        	} else {
        		$data['crear'] = FALSE;
        		$data['cosa'] = $this->Cosas_model->get_cosas($id);
                $data['section'] ='cosas';
        		$this->load->view('crear_editar_cosa',$data);
        	}
        	
        }


        public function guardar_cosa($id = NULL){
        	if (is_null($id)){
	        	if ($this->Cosas_model->insert_cosa()){
	        		echo "Cosa guardada correctamente<br>";
	        		echo "<a href=".site_url('').">Inicio</a><br>";
	        		echo "<a href=".site_url('cosas').">Cosas</a>";
	        	} else {
	        		echo "hubo un f error :(";
	        	}
	        } else {
	        	if ($this->Cosas_model->update_cosa($id)){
	        		echo "Cosa editada correctamente<br>";
	        		echo "<a href=".site_url('').">Inicio</a><br>";
	        		echo "<a href=".site_url('cosas').">Cosas</a>";
	        	} else {
	        		echo "hubo un f error :(";
	        	}
	        }
        }

        public function confirmar_borrar_cosa($id){
        	$data['cosa'] = $this->Cosas_model->get_cosas($id);
            $data['section'] ='cosas';
        	$this->load->view('confirmar_borrar_cosa',$data);
        }

        public function borrar_cosa($id){
        	$this->Cosas_model->delete_cosa($id);
        	redirect('cosas');
        }

        public function ajax_borrar_cosa(){
                $idCosa = $this->input->post('cosa_id');
                if($idCosa != NULL && $idCosa !=''){
                        $this ->Cosas_model->delete_cosa($idCosa);
                        $respuesta['result'] = "ok";
                        $respuesta['mensaje'] = "todo liso";
                } else {
                        $respuesta['result'] = "error"; 
                        $respuesta['mensaje'] = "Faltan parametros";
                         
                }
                echo json_encode($respuesta);
        }

         public function ajax_guardar_cosa(){
                $cosaDescripcion = $this->input->post('cosa_descripcion');
                $cosaPrecio =  $this->input->post('cosa_precio');
                $cosa = $this->Cosas_model->insert_cosa($cosaDescripcion,$cosaPrecio);
               
                if($cosa != NULL){
                        $respuesta['result'] = "ok";
                        $respuesta['mensaje'] = "todo liso";
                        $respuesta['cosa'] = $cosa;
                } else {
                        $respuesta['result'] = "error"; 
                        $respuesta['mensaje'] = "algo falló";
                        $respuesta['cosa'] = "no hay cosa";
                         
                }
                echo json_encode($respuesta);
        }

        public function ajax_load_cosas(){
            $cosas =$this->Cosas_model->get_cosas();
            if ($cosas != null){
                $respuesta['result'] = "ok";
                $respuesta['mensaje'] = "todo reee liso";
                $respuesta['lista_cosas'] = $cosas;
            } else {
                $respuesta['result'] = "error";
                $respuesta['mensaje'] = "no sé qué pasó";
                $respuesta['lista_cosas'] = "no hay cosas";
            }
            echo json_encode($respuesta);
        }


}