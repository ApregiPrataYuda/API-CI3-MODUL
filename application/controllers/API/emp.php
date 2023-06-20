<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class emp extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('emp_model','m');
        $this->methods['index_get']['limit'] = 5;
    }

    public function index_get()
    {
        $id = $this->get('emp_id');
        $count = $this->m->counter();
  
        if ($id === null) {
            $data =  $this->m->get();
        }else {
            $data =  $this->m->get($id);
        }
        if ($data) {
            $this->response( [
                'page' => "API EMP DATA",
                'total data' => $count,
                'status' => true,
                'data' => $data
            ], RestController::HTTP_OK );

        }else {
            $this->response( [
                'status' => false,
                'message' => 'Data Tidak Ditemukan'
            ], RestController::HTTP_NOT_FOUND );
        } 

     
    }

    public function index_delete(){
        $id = $this->delete('emp_id');
        
        if ($id === null) {
            $this->response( [
                'status' => false,
                'message' => 'Request Response Tidak Ditemukan'
            ], RestController::HTTP_BAD_REQUEST );
        }else {
            #id ada
            if ($this->m->delete($id) > 0) {
                $this->response( [
                    'status' => true,
                    'id' => $id,
                    'message' => 'Delete' 
                ], RestController::HTTP_OK);
            }else {
            #id not found
            $this->response( [
                'status' => false,
                'message' => 'ID Tidak Ditemukan'
            ], RestController::HTTP_BAD_REQUEST );
            }
        }
    }

    public function index_post() {
       
        $data = [
            'name' => $this->post('name'),
            'email' => $this->post('email'),
        ];

        if($this->m->created($data) > 0){
            $this->response( [
                'status' => true,
                'data' => $data,
                'message' => 'created success'
            ], RestController::HTTP_OK);
        }else {
            $this->response([
                'status' => false,
                'message' => 'created gagal'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }


    public function index_put() {
        $id = $this->put('emp_id');
        $data = [
            'name' => $this->put('name'),
            'email' => $this->put('email')
        ];

        if($this->m->updated($data, $id) > 0){
            $this->response( [
                'status' => true,
                'data' => $data,
                'message' => 'modifed success'
            ], RestController::HTTP_OK);
        }else {
            $this->response([
                'status' => false,
                'message' => 'modifed gagal'
            ], RestController::HTTP_BAD_REQUEST);
        }
        }
}