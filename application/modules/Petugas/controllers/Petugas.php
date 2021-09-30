<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(null);

class Petugas extends Ptgs_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->head = array(
            assets_url . "app-assets/css/vendors.css",
            assets_url . "app-assets/css/app.css",
            assets_url . "app-assets/css/core/menu/menu-types/vertical-menu-modern.css",
            assets_url . "app-assets/css/core/colors/palette-gradient.css",
            // assets_url . "assets/css/style.css",
        );
        $this->foot = array(
            assets_url . "app-assets/js/core/app-menu.js",
            assets_url . "app-assets/js/core/app.js",
            assets_url . "app-assets/js/scripts/customizer.js",
        );
    }

    public function index()
    {
        $this->head[] = assets_url . "app-assets/fonts/simple-line-icons/style.css";
        $header['css'] = $this->head;
        $footer['js'] = $this->foot;
        $menu['active'] = '1';     
        
        $select         = "COUNT(id_order) jml";
        $where          = "date(tgl_order) = date(now())";
        $lapHarian      = $this->MasterData->getWhereData($select, 'tbl_order', $where)->row()->jml;
        $where          = "YEARWEEK(tgl_order) = YEARWEEK(NOW())";
        $lapMingguan    = $this->MasterData->getWhereData($select, 'tbl_order', $where)->row()->jml;
        $where          = "MONTH(tgl_order) = MONTH(now()) AND YEAR(tgl_order) = YEAR(now())";
        $lapBulanan     = $this->MasterData->getWhereData($select, 'tbl_order', $where)->row()->jml;
        $where          = "YEAR(tgl_order) = YEAR(now())";
        $lapTahunan     = $this->MasterData->getWhereData($select, 'tbl_order', $where)->row()->jml;
        // ============================================
        $cont = array(
            'lapHarian'    => $lapHarian,
            'lapMingguan'   => $lapMingguan,
            'lapBulanan'    => $lapBulanan,
            'lapTahunan'    => $lapTahunan,
        );

        $data = array(
            'header' => $header,
            'menu'   => $menu,
            'konten' => 'pages/dashboard',
            'footer' => $footer,
            'cont'   => $cont,
        );

        $this->load->view("view_master_petugas", $data);
    }

    public function addOrder()
    {
        // $this->head[] = assets_url . "app-assets/vendors/css/forms/icheck/icheck.css";
        // $this->head[] = assets_url . "app-assets/vendors/css/forms/icheck/custom.css";
        $this->head[] = assets_url . "app-assets/vendors/css/forms/selects/select2.min.css";
        $this->head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css";
        $this->head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/style-datepicker.css";
        $this->head[] = assets_url . "app-assets/vendors/dropify/dist/css/dropify.min.css";
        // ================================================================
        // $this->foot[] = assets_url . "app-assets/vendors/js/forms/icheck/icheck.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/forms/select/select2.full.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/dropify/dist/js/dropify.min.js";
        // $this->foot[] = assets_url . "app-assets/js/scripts/forms/checkbox-radio.js";
        // ================================================================
        $script[] = '$(".select2").select2();';
        $script[] = "$('.date-picker').datepicker({
                        autoclose: true,
                        todayHighlight: true,
                        format: 'dd/mm/yyyy'
                    });";
        $script[] = "$('.dropify').dropify({
                        messages: {
                            default: '<center>Drag & drop file gambar disini.</center>',
                            error: '<center>Maksimal ukuran file 5 MB.</center>',
                        }
                    }); ";
        // ================================================================
        $header['css'] = $this->head;
        $footer['js'] = $this->foot;
        $footer['script'] = $script;
        $menu['active'] = '2.1';

        $no_order = $this->kodeOtomatis('no_order', 'tbl_order', "id_order > 0", 'C', 4);

        $jenis_order = $this->MasterData->getData('tbl_jenis_order')->result_array();

        // =================================================================

        $cont = array(
            'no_order'      => $no_order,
            'jenis_order'   => $jenis_order,
        );

        $post = striptag($this->input->POST());
        if ($post) {
            $this->load->helper('upload');

            $num_results        = (!empty($_POST['num_results'])) ? $_POST['num_results'] : 24;
            $delta              = (!empty($_POST['delta'])) ? $_POST['delta'] : 255;
            $reduce_brightness  = (isset($_POST['reduce_brightness'])) ? $_POST['reduce_brightness'] : 0;
            $reduce_gradients   = (isset($_POST['reduce_gradients'])) ? $_POST['reduce_gradients'] : 0;

            $this->load->library('Color_extract');
            $color = new Color_extract();

            $name_post = 'nama_file';
            $path_file = 'assets/upload';
            $new_file  = 'assets/upload/thumb';
            $width     = '500';
            $height    = '500';
            // $upload = upload_photo($name_post, 10024, false, $path_file, $width, $height, FALSE, $path_file);
            $upload = upload_files($name_post, 10024, false, 'jpg|jpeg|png|gif|jpg2|bmp', $path_file);
            if ($upload['respons']) {
                $getColor = $color->Get_Color(FCPATH . $path_file . '/' . $upload['data'], $num_results, $reduce_brightness, $reduce_gradients, $delta);

                $cek1 = 0;
                $cek2 = 2;
                
                foreach ($getColor as $hex => $count) {
                    if ($count > 0) {
                        if ($hex == '00ffff') {
                            $cek1 = 1;
                        }
                        if ($hex == '0000ff') {
                            $cek2 = 1;
                        }
                    }
                }

                $getClr = array();
                foreach ($getColor as $hex => $count) {
                    if ($count > 0) {
                        if ($hex != 'ffffff' && $hex != '00ff00' && $hex != 'ff00ff') {
                            if ($cek1 == $cek2) {
                                if ($hex != '00ffff') {
                                    $getClr[$hex] = $count;
                                }
                            } else {
                                if ($hex == '00ffff') {
                                    $getClr['0000ff'] = $count;
                                } else {
                                    $getClr[$hex] = $count;
                                }
                            }
                        }
                    }
                }

                $jmlWarna = count($getClr);
                $namaHarga = '';
                if ($jmlWarna == 1) {
                    $namaHarga = 'harga1';
                } else if ($jmlWarna >= 2 and $jmlWarna <= 3) {
                    $namaHarga = 'harga2';
                } else {
                    $namaHarga = 'harga3';
                }

                $select = array('id_harga', 'harga');
                $table  = 'tbl_harga';
                $where  = "id_jenis_order = $post[id_jenis_order] AND nama_harga = '$namaHarga'";
                $dataHarga = $this->MasterData->getWhereData($select, $table, $where)->row_array();
            } else {
                $getClr = false;
                $dataHarga  = false;
            }

            $cont = array(
                'no_order'      => $no_order,
                'jenis_order'   => $jenis_order,
                'getColor'      => $getClr,
                'file'          => $upload['data'],
                'post'          => $post,
                'harga'         => $dataHarga['harga'],
                'id_harga'      => $dataHarga['id_harga'],
            );
        }

        $data = array(
            'header' => $header,
            'menu'   => $menu,
            'konten' => 'pages/form_order',
            'footer' => $footer,
            'cont'   => $cont,
        );

        $this->load->view("view_master_petugas", $data);
    }

    public function simpanOrder()
    {
        $data = striptag($this->input->POST());
        if ($data) {
            $dt = array(
                'no_order'      => $data['no_order'],
                'nama_order'    => $data['nama_order'],
                'nama_file'     => $data['nama_file'],
                'tgl_order'     => date('Y-m-d'),
                'jml_warna'     => $data['jml_warna'],
                'jml_cetak'     => $data['jml_cetak'],
                'id_harga'      => $data['id_harga'],
                'id_login'      => $this->id_user
            );

            $inputData = $this->MasterData->inputData($dt, 'tbl_order');

            if ($inputData) {
                alert_success('Data order berhasil disimpan.');
                redirect(base_url() . 'Petugas/addOrder');
            } else {
                alert_failed('Data order gagal disimpan.');
                redirect(base_url() . 'Petugas/addOrder');
            }
        }
    }

    public function dataOrder($show='')
    {
        $this->head[] = assets_url . "app-assets/css/plugins/animate/animate.css";
        $this->head[] = assets_url . "app-assets/vendors/css/tables/datatable/datatables.min.css";
        $this->head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css";
        $this->head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/style-datepicker.css";
        $this->head[] = assets_url . "app-assets/vendors/css/extensions/sweetalert.css";
        // ================================================================
        $this->foot[] = assets_url . "app-assets/vendors/js/tables/datatable/datatables.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/extensions/sweetalert.min.js";
        $this->foot[] = base_url('assets/js/delete_data.js');
        // ================================================================
        $script[] = "$('.data-table').dataTable({'scrollX': true});";
        $script[] = "$('.date-picker').datepicker({
                        autoclose: true,
                        todayHighlight: true,
                        format: 'dd/mm/yyyy'
                    });";
        // ================================================================
        $header['css'] = $this->head;
        $footer['js'] = $this->foot;
        $footer['script'] = $script;
        $menu['active'] = '2.2';
        // ================================================================
        $select = array(
            'od.*',
            "(SELECT jns.nama_jenis_order FROM tbl_jenis_order jns WHERE jns.id_jenis_order = (SELECT hrg.id_jenis_order FROM tbl_harga hrg WHERE hrg.id_harga = od.id_harga)) jenis_cetak",
            "((SELECT hrg.harga FROM tbl_harga hrg WHERE hrg.id_harga = od.id_harga) * od.jml_cetak) tot_harga",
            "(SELECT log.nama_user FROM tbl_login log WHERE log.id_login = od.id_login) nama_user",
        );
        $table = 'tbl_order od';
        $by    = 'id_order';
        $order = 'DESC';

        if ($show == 'date') {
            $where = "date(tgl_order) = date(now())";
            $title = 'Hari Ini';
        } else if ($show == 'week') {
            $where = "YEARWEEK(tgl_order) = YEARWEEK(NOW())";            
            $title = 'Minggu Ini';
        } else if ($show == 'month') {
            $where = "MONTH(tgl_order) = MONTH(now()) AND YEAR(tgl_order) = YEAR(now())";
            $title = 'bulan Ini';
        } else if ($show == 'year') {
            $where = "YEAR(tgl_order) = YEAR(now())";
            $title = 'Tahun Ini';
        } else {
            $where = "id_order > 0";
            $title = '';
        }

        $dataOrder = $this->MasterData->getWhereDataOrder($select,$table,$where,$by,$order)->result_array();

        $cont = array(
            'dataOrder' => $dataOrder,
            'title'     => $title,
        );

        $data = array(
            'header'    => $header,
            'menu'      => $menu,
            'konten'    => 'pages/data_order',
            'footer'    => $footer,
            'cont'      => $cont,
        );

        $this->load->view("view_master_petugas", $data);
    }

    public function deleteOrder()
    {
        if ($this->input->POST()) {
            $id = decode($this->input->POST('id'));

            $table  = 'tbl_order';
            $select = array('nama_file');
            $where  = "id_order = $id";
            $file = $this->MasterData->getWhereData($select,$table,$where)->row()->nama_file;
            $delete = $this->MasterData->deleteData($where, $table);
            if ($delete) {
                unlink(FCPATH.'assets/upload/'.$file);
                echo 'Success';
                alert_success('Data order berhasil dihapus.');
            } else {
                echo 'Gagal';
                alert_failed('Data order gagal dihapus.');
            }
        }
    }

    public function dataLaporan()
    {
        $post = striptag($this->input->POST());
        if ($post) {
            $awal = date('Y-m-d', strtotime(str_replace('/', '-', $post['tgl_awal'])));
            $akhir = date('Y-m-d', strtotime(str_replace('/', '-', $post['tgl_akhir'])));
        } else {
            $awal = date('Y-m-1');
            $akhir = date('Y-m-d');
        }
        // ==========================================
        $this->head[] = assets_url . "app-assets/css/plugins/animate/animate.css";
        $this->head[] = assets_url . "app-assets/vendors/css/tables/datatable/datatables.min.css";
        $this->head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css";
        $this->head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/style-datepicker.css";
        $this->head[] = assets_url . "app-assets/vendors/css/extensions/sweetalert.css";
        // ================================================================
        $this->foot[] = assets_url . "app-assets/vendors/js/tables/datatable/datatables.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/tables/buttons.print.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/extensions/sweetalert.min.js";
        $this->foot[] = base_url('assets/js/delete_data.js');
        // ================================================================
        $script[] = "$('.data-table').dataTable({
                        'scrollX': true,
                        dom: 'Bfrtip',
                        buttons: [
                            { 
                                extend: 'excel',
                                text: 'Export Excel',
                                title: 'Cetak Laporan Periode " . formatTanggalTtd($awal) . " - " . formatTanggalTtd($akhir) . "',
                                // exportOptions: {
                                //     format: {
                                //         header:  function (data, columnIdx) {
                                //             return columnIdx + ': ' + data;
                                //         }
                                //     }
                                // }
                            },
                        ]
                    });";
        $script[] = "$('.dt-buttons').css('margin-bottom','-70px');";
        $script[] = "$('.buttons-excel').addClass('btn btn-primary mr-1');";
        $script[] = "$('.date-range').datepicker({
                        autoclose: true,
                        todayHighlight: true,
                        format: 'dd/mm/yyyy',
                        // toggleActive: true
                    });";
        // ================================================================
        $header['css'] = $this->head;
        $footer['js'] = $this->foot;
        $footer['script'] = $script;
        $menu['active'] = '3';
        // ================================================================
        $select = array(
            'od.*',
            "(SELECT jns.nama_jenis_order FROM tbl_jenis_order jns WHERE jns.id_jenis_order = (SELECT hrg.id_jenis_order FROM tbl_harga hrg WHERE hrg.id_harga = od.id_harga)) jenis_cetak",
            "((SELECT hrg.harga FROM tbl_harga hrg WHERE hrg.id_harga = od.id_harga) * od.jml_cetak) tot_harga",
            "(SELECT log.nama_user FROM tbl_login log WHERE log.id_login = od.id_login) nama_user",
        );
        $table = 'tbl_order od';
        $where = "tgl_order BETWEEN '$awal' AND '$akhir'";
        $by    = 'id_order';
        $order = 'DESC';
        $dataOrder = $this->MasterData->getWhereDataOrder($select, $table, $where, $by, $order)->result_array();

        $cont = array(
            'dataOrder' => $dataOrder,
            'tgl_awal'  => date('d/m/Y', strtotime($awal)),
            'tgl_akhir' => date('d/m/Y', strtotime($akhir)),
        );

        $data = array(
            'header'    => $header,
            'menu'      => $menu,
            'konten'    => 'pages/data_laporan',
            'footer'    => $footer,
            'cont'      => $cont,
        );

        $this->load->view("view_master_petugas", $data);
    }

    public function kodeOtomatis($select = '', $table = '', $where = '', $kode_awal = '', $jml_kode = '')
    {
        $by     = $select;
        $order     = "DESC";
        $limit     = "1";
        $detail = $this->MasterData->getWhereDataLimitOrder($select, $table, $where, $limit, $by, $order);
        $row    = $detail->row();
        if ($detail->num_rows() > 0) { // Check data
            $kode = substr($row->$select, 1, $jml_kode); // Mengambil string beberapa digit
            $code = (int) $kode; // Mengubah String jadi Integer
            $code++;
            $kodeOtomatis = $kode_awal . str_pad($code, $jml_kode, "0", STR_PAD_LEFT); // Kerangka Kode Otomatis = kode_pasar + 6 digit
        } else {
            $code = '';
            for ($i = 1; $i < $jml_kode; $i++) {
                $code .= '0';
            }
            $kodeOtomatis = $kode_awal . $code . '1';
        }

        return $kodeOtomatis;
    }

    // =================================================

}
