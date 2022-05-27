<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
use Restserver\Libraries\REST_Controller;

class Nilai extends REST_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Nilai_model', 'nilai');

        $this->methods['index_get']['limit'] = 5;
        $this->methods['index_delete']['limit'] = 5;
        $this->methods['index_post']['limit'] = 5;
        $this->methods['index_put']['limit'] = 5;
    }
    public function index_get()
    {
        $id = $this->get('id_nilai');
        if ($id === null) {
            $nilai = $this->nilai->getNilai();
        } else {
            $nilai = $this->nilai->getNilai($id);
        }
        
        if ($nilai) {
            $this->response([
                'status' => true,
                'data' => $nilai
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
            $id = $this->delete('id_nilai');

            if ($id === null){
                $this->response([
                    'status' => false,
                    'message' => 'Masukan ID'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }else {
                if( $this->nilai->deleteNilai($id) > 0) {
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
                    'id_nilai' => $this->post('id_nilai'),
                    'nim' => $this->post('nim'),
                    'kode_jurusan' => $this->post('kode_jurusan'),
                    'kode_matakuliah' => $this->post('kode_matakuliah'),
                    'nilai' => $this->post('nilai')
                ];  
                    //Berhasil Tambah Data
                if( $this->nilai->createNilai($data) > 0) {
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
                $id = $this->put('id_nilai');
                $data = [
                    'id_nilai' => $this->put('id_nilai'),
                    'nim' => $this->put('nim'),
                    'kode_jurusan' => $this->put('kode_jurusan'),
                    'kode_matakuliah' => $this->put('kode_matakuliah'),
                    'nilai' => $this->put('nilai')
                ];  
                    //Berhasil Update Data
                if( $this->nilai->updateNilai($data, $id) > 0) {
                    $this->response([
                        'status' => true,
                        'message' => 'Data Berubah'
                    ], REST_Controller::HTTP_OK);
                } else {
                    //Tidak Berhasil Update Data
                    $this->response([
                        'status' => false,
                        'message' => 'Data TidaK Berubah'
                    ], REST_Controller::HTTP_BAD_REQUEST);
                }
            }
                }
            
