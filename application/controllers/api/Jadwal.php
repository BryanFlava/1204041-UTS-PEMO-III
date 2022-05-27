<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
use Restserver\Libraries\REST_Controller;

class Jadwal extends REST_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jadwal_model', 'jadwal');
        
        $this->methods['index_get']['limit'] = 5;
        $this->methods['index_delete']['limit'] = 5;
        $this->methods['index_post']['limit'] = 5;
        $this->methods['index_put']['limit'] = 5;
    }
    public function index_get()
    {
        $id = $this->get('id_jadwal');
        if ($id === null) {
            $jadwal = $this->jadwal->getJadwal();
        } else {
            $jadwal = $this->jadwal->getJadwal($id);
        }
        
        if ($jadwal) {
            $this->response([
                'status' => true,
                'data' => $jadwal
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'ID tidak Ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }

        }

        public function index_delete()
        {
            $id = $this->delete('id_jadwal');

            if ($id === null){
                $this->response([
                    'status' => false,
                    'message' => 'Masukan ID'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }else {
                if( $this->jadwal->deleteJadwal($id) > 0) {
                    //Ada ID
                    $this->response([
                        'status' => true,
                        'id' => $id,
                        'message' => 'Data Terhapus'
                    ], REST_Controller::HTTP_OK);
                } else {
                    //Tidak ada ID
                    $this->response([
                        'status' => false,
                        'message' => 'ID Tidak Ditemukan'
                    ], REST_Controller::HTTP_BAD_REQUEST);
                }
            }
            }
          
    public function index_post()
    {
        $data = [
            'id_jadwal' => $this->post('id_jadwal'),
            'kode_matakuliah' => $this->post('kode_matakuliah'),
            'nip' => $this->post('nip'),
            'kode_ruangan_jadwal' => $this->post('kode_ruangan_jadwal'),
            'kode_jurusan' => $this->post('kode_jurusan'),
            'kode_jenjang' => $this->post('kode_jenjang'),
            'hari' => $this->post('hari'),
            'jam' => $this->post('jam')
        ];  
            //Berhasil Tambah Data
        if( $this->jadwal->createJadwal($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data Baru'
            ], REST_Controller::HTTP_CREATED);
        } else {
            //Tidak Berhasil Tambah Data
            $this->response([
                'status' => false,
                'message' => 'Data Tidak Ditambahkan'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
        

    public function index_put()
    {
        $id = $this->put('id_jadwal');
        $data = [
            'id_jadwal' => $this->put('id_jadwal'),
            'kode_matakuliah' => $this->put('kode_matakuliah'),
            'nip' => $this->put('nip'),
            'kode_ruangan_jadwal' => $this->put('kode_ruangan_jadwal'),
            'kode_jurusan' => $this->put('kode_jurusan'),
            'kode_jenjang' => $this->put('kode_jenjang'),
            'hari' => $this->put('hari'),
            'jam' => $this->put('jam')
        ];  
            //Berhasil Update Data
        if( $this->jadwal->updateJadwal($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data Berubah'
            ], REST_Controller::HTTP_OK);
        } else {
            //Tidak Berhasil Update Data
            $this->response([
                'status' => false,
                'message' => 'Data Tidak Berubah'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
        }
    
