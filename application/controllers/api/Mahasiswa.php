<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
use Restserver\Libraries\REST_Controller;

class Mahasiswa extends REST_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mahasiswa_model', 'mahasiswa');

        $this->methods['index_get']['limit'] = 5;
        $this->methods['index_delete']['limit'] = 5;
        $this->methods['index_post']['limit'] = 5;
        $this->methods['index_put']['limit'] = 5;
    }
    public function index_get()
    {
        $id = $this->get('nim');
        if ($id === null) {
            $mahasiswa = $this->mahasiswa->getMahasiswa();
        } else {
            $mahasiswa = $this->mahasiswa->Mahasiswa($id);
        }
        
        if ($mahasiswa) {
            $this->response([
                'status' => true,
                'data' => $mahasiswa
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
            $id = $this->delete('nim');

            if ($id === null){
                $this->response([
                    'status' => false,
                    'message' => 'Masukan NIM'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }else {
                if( $this->mahasiswa->deleteMahasiswa($id) > 0) {
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
                    'nim' => $this->post('nim'),
                    'nama_mahasiswa' => $this->post('nama_mahasiswa'),
                    'tanggal_lahir' => $this->post('tanggal_lahir'),
                    'jk' => $this->post('jk'),
                    'no_telp' => $this->post('no_telp'),
                    'alamat' => $this->post('alamat'),
                    'kode_jurusan' => $this->post('kode_jurusan'),
                    'kode_jenjang' => $this->post('kode_jenjang')
                ];  
                    //Berhasil Tambah Data
                if( $this->mahasiswa->createMahasiswa($data) > 0) {
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
                $id = $this->put('nim');
                $data = [
                    'nim' => $this->put('nim'),
                    'nama_mahasiswa' => $this->put('nama_mahasiswa'),
                    'tanggal_lahir' => $this->put('tanggal_lahir'),
                    'jk' => $this->put('jk'),
                    'no_telp' => $this->put('no_telp'),
                    'alamat' => $this->put('alamat'),
                    'kode_jurusan' => $this->put('kode_jurusan'),
                    'kode_jenjang' => $this->put('kode_jenjang')
                ];  
                    //Berhasil Update Data
                if( $this->mahasiswa->updateMahasiswa($data, $id) > 0) {
                    $this->response([
                        'status' => true,
                        'message' => 'Data Terupdate'
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
            
