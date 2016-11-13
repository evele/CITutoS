<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrdenCompra extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('ordencompra_model');
                $this->load->model('clientes_model');
                $this->load->model('cosas_model');
                $this->load->helper('url_helper');
        }

        public function index(){
        	$data['ordenesCompra'] = $this->ordencompra_model->get_ordenCompraFull();
                //acá calcular el importe total de cada OC y ver cómo catso insertarlo bien
        	$data['title'] = 'Órdenes de Compra';
                $data['section'] ='compras';
                $this->load->view('_template_header',$data);
                $this->load->view('listar_ordenesCompra',$data);
                $this->load->view('_template_footer',$data);
        }

        public function crear_orden_compra(){
                //le paso los clientes pal select
                $data['clientes'] = $this->clientes_model->get_clients();
                $data['title'] = 'Crear Orden de Compra';
                $data['section'] ='compras';
                $this->load->view('_template_header',$data);
                $this->load->view('crear_ordenCompra',$data);
                $this->load->view('_template_footer',$data);
        }


        public function guardar_orden_compra(){
        	if ($this->ordencompra_model->insert_ordenCompra()){
        		//redirect('editar_orden_compra');
        	       //inserted_id
                } else {
        		echo "hubo un f error :(";
        	}
        }

        public function editar_orden_compra($id){
                //esta vista permitirá agregar ítems
                $data['ordenCompra'] = $this->ordencompra_model->get_ordenCompraFull($id);
                $data['items'] = $this->ordencompra_model->get_ItemsOrdenCompra($id);
                $data['cosas'] = $this->cosas_model->get_cosas();
                $data['title'] = 'Editar Orden de Compra';
                $data['section'] ='compras';
                $this->load->view('_template_header',$data);
                $this->load->view('editar_ordenCompra',$data);
                $this->load->view('_template_footer',$data);
        }

        public function confirmar_borrar_orden_compra($id){
        	$data['ordenCompra'] = $this->ordencompra_model->get_ordenCompra($id);
                $data['section'] ='compras';
        	$this->load->view('confirmar_borrar_ordenCompra',$data);
        }

        public function borrar_orden_compra($id){
        	$this->clientes_model->delete_ordenCompra($id);
        	redirect('ordenCompra');
        }

        public function agregar_item_orden_compra($id){
                $idCosa = $this->input->post('cosaId');
                $cantidad = $this->input->post('cosaCantidad');
                $this->ordencompra_model->insert_ordenCompraItem($id,$idCosa,$cantidad);
                //$this->load->view('editar_ordenCompra',$data); 
                redirect('OrdenCompra/editar_orden_compra/'.$id);             
        }

        public function confirmar_borrar_item($id){
                $data['ordenCompraItem'] = $this->ordencompra_model->get_ordenCompraItem($id);
                $data['section'] ='compras';
                // aca una vueltin para traer la OC $data['OrdenCompra'] = $this->ordencompra_model->get_ordenCompraItem($id);
                $this->load->view('confirmar_borrar_item_orden_compra',$data);       
        }

        public function borrar_item($id){
                $this->ordencompra_model->delete_ordenCompraItem($id); 
                // a la OC redirect()      
        }

        public function ajax_borrar_orden_compra_item(){
                $id = $this->input->post('orden_compra_item_id');
                if ($id != null && $id !=''){
                        $this->ordencompra_model->delete_ordenCompraItem($id); 
                        $respuesta['result'] = "ok";
                        $respuesta['mensaje'] = "la cosa se borró";
                } else {
                        $respuesta['result'] = "error";
                        $respuesta['mensaje'] = "no llegaron bien los parámetros";
                }
                echo json_encode($respuesta);
        }

        public function ajax_borrar_orden_compra(){
                $id = $this->input->post('orden_compra_id');
                if ($id != null && $id !=''){
                        $this->ordencompra_model->delete_ordenCompra($id); 
                        $respuesta['result'] = "ok";
                        $respuesta['mensaje'] = "la orden de compra se borró";
                } else {
                        $respuesta['result'] = "error";
                        $respuesta['mensaje'] = "no llegaron bien los parámetros";
                }
                echo json_encode($respuesta);    
        }

        public function ajax_insertar_orden_compra_item(){
                $idOrdenCompra = $this->input->post('orden_compra_id');
                $idItem = $this->input->post('item_id');
                $cantidad = $this->input->post('cantidad');
                $OrdenCompraItem = $this->ordencompra_model->insert_ordenCompraItem($idOrdenCompra,$idItem,$cantidad);
                if ($OrdenCompraItem != null && $OrdenCompraItem != ""){
                        $respuesta['result'] = "ok";
                        $respuesta['mensaje'] = "de a poco va";        
                        $respuesta['orden_compra_item'] = $OrdenCompraItem;
                } else {
                        $respuesta['result'] = "error";
                        $respuesta['mensaje'] = "no se insertó correctamente";        
                        $respuesta['orden_compra_item'] = 0;
                }
                echo json_encode($respuesta); 
        }


}