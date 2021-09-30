<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(null);

class Admin extends Adm_Controller
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

        $this->load->view("view_master_admin", $data);
    }
    // ===========================================
    public function simpanUser()
    {
        $data = striptag($this->input->POST());
        if ($data) {
            $dt = array(
                'nama_user'    => $data['nama_user'],
                'username'     => $data['username'],
                'password'     => md5($data['password']),
                'role'         => $data['role'],
            );

            $inputData = $this->MasterData->inputData($dt, 'tbl_login');

            if ($inputData) {
                alert_success('Data user berhasil disimpan.');
                redirect(base_url() . 'Admin/dataUser');
            } else {
                alert_failed('Data user gagal disimpan.');
                redirect(base_url() . 'Admin/dataUser');
            }
        }
    }

    public function updateUser()
    {
        $data = $this->input->POST();
        if ($data) {
            $id_login = decode($data['id_login']);
            $dt = array(
                'nama_user'    => $data['nama_user'],
                'username'     => $data['username'],
                'password'     => md5($data['password']),
                'role'         => $data['role'],
            );

            $where = "id_login = $id_login";
            $updateData = $this->MasterData->editData($where, $dt, 'tbl_login');

            if ($updateData) {
                alert_success('Data user berhasil disimpan.');
                redirect(base_url() . 'Admin/dataUser');
            } else {
                alert_failed('Data user gagal disimpan.');
                redirect(base_url() . 'Admin/dataUser');
            }
        }
    }

    public function dataUser()
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
        $script[] = "$('.data-table').dataTable();";
        $script[] = "$('.date-picker').datepicker({
                        autoclose: true,
                        todayHighlight: true,
                        format: 'dd/mm/yyyy'
                    });";
        // ================================================================
        $header['css'] = $this->head;
        $footer['js'] = $this->foot;
        $footer['script'] = $script;
        $menu['active'] = '2';
        // ================================================================
        $select = '*';
        $table  = 'tbl_login';
        $by     = 'id_login';
        $order  = 'DESC';
        $dataUser = $this->MasterData->getSelectDataOrder($select, $table, $by, $order)->result_array();

        $cont = array(
            'dataUser' => $dataUser,
        );

        $data = array(
            'header'    => $header,
            'menu'      => $menu,
            'konten'    => 'pages/data_user',
            'footer'    => $footer,
            'cont'      => $cont,
        );

        $this->load->view("view_master_admin", $data);
    }

    public function deleteUser($value = '')
    {
        if ($this->input->POST()) {
            $id = decode($this->input->POST('id'));
            $where = "id_login = $id";
            $delete = $this->MasterData->deleteData($where, 'tbl_login');
            if ($delete) {
                echo 'Success';
                alert_success('Data user login berhasil dihapus.');
            } else {
                echo 'Gagal';
                alert_failed('Data user login gagal dihapus.');
            }
        }
    }
    // ============================================
    public function simpanJenisCetak()
    {
        $data = striptag($this->input->POST());
        if ($data) {
            $harga1 = str_replace('.', '', $data['harga1']);
            $harga2 = str_replace('.', '', $data['harga2']);
            $harga3 = str_replace('.', '', $data['harga3']);

            $dt = array(
                'nama_jenis_order'    => $data['nama_jenis_order'],
            );
            $inputData = $this->MasterData->inputData($dt, 'tbl_jenis_order');

            $id_jenis_order = $this->db->insert_id();

            $dt = array('id_jenis_order' => $id_jenis_order, 'nama_harga' => 'harga1', 'harga' => $harga1);
            $inputData = $this->MasterData->inputData($dt, 'tbl_harga');

            $dt = array('id_jenis_order' => $id_jenis_order, 'nama_harga' => 'harga2', 'harga' => $harga2);
            $inputData = $this->MasterData->inputData($dt, 'tbl_harga');

            $dt = array('id_jenis_order' => $id_jenis_order, 'nama_harga' => 'harga3', 'harga' => $harga3);
            $inputData = $this->MasterData->inputData($dt, 'tbl_harga');

            if ($inputData) {
                alert_success('Data jenis cetak berhasil disimpan.');
                redirect(base_url() . 'Admin/dataJenisCetak');
            } else {
                alert_failed('Data jenis cetak gagal disimpan.');
                redirect(base_url() . 'Admin/dataJenisCetak');
            }
        }
    }

    public function updateJenisCetak()
    {
        $data = $this->input->POST();
        if ($data) {
            $harga1 = str_replace('.', '', $data['harga1']);
            $harga2 = str_replace('.', '', $data['harga2']);
            $harga3 = str_replace('.', '', $data['harga3']);
            $id_jenis_order = decode($data['id_jenis_order']);

            $dt = array(
                'nama_jenis_order'    => $data['nama_jenis_order'],
            );
            $where = "id_jenis_order = $id_jenis_order";
            $updateData = $this->MasterData->editData($where, $dt, 'tbl_jenis_order');

            $dt = array('harga' => $harga1);
            $where = "id_jenis_order = $id_jenis_order AND nama_harga = 'harga1'";
            $updateData = $this->MasterData->editData($where, $dt, 'tbl_harga');

            $dt = array('harga' => $harga2);
            $where = "id_jenis_order = $id_jenis_order AND nama_harga = 'harga2'";
            $updateData = $this->MasterData->editData($where, $dt, 'tbl_harga');

            $dt = array('harga' => $harga3);
            $where = "id_jenis_order = $id_jenis_order AND nama_harga = 'harga3'";
            $updateData = $this->MasterData->editData($where, $dt, 'tbl_harga');

            if ($updateData) {
                alert_success('Data jenis cettak berhasil disimpan.');
                redirect(base_url() . 'Admin/dataJenisCetak');
            } else {
                alert_failed('Data jenis cettak gagal disimpan.');
                redirect(base_url() . 'Admin/dataJenisCetak');
            }
        }
    }

    public function dataJenisCetak()
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
        $script[] = "$('.data-table').dataTable();";
        $script[] = "$('.date-picker').datepicker({
                        autoclose: true,
                        todayHighlight: true,
                        format: 'dd/mm/yyyy'
                    });";
        $script[] = "function changeRupe(data){
                        var val = formatRupiah($(data).val(), 'Rp. ');
                        $(data).val(val);
                    };";
        $script[] = "function formatRupiah(angka='', prefix=''){
                        var number_string = angka.replace(/[^,\d]/g, '').toString(),
                        split           = number_string.split(','),
                        sisa            = split[0].length % 3,
                        rupiah          = split[0].substr(0, sisa),
                        ribuan          = split[0].substr(sisa).match(/\d{3}/gi);

                        // tambahkan titik jika yang di input sudah menjadi angka ribuan
                        if(ribuan){
                            separator = sisa ? '.' : '';
                            rupiah += separator + ribuan.join('.');
                        }

                        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                        return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
                    };";
        // ================================================================
        $header['css'] = $this->head;
        $footer['js'] = $this->foot;
        $footer['script'] = $script;
        $menu['active'] = '3';
        // ================================================================
        $select = array(
            'od.*',
            "(SELECT hrg.harga FROM tbl_harga hrg WHERE hrg.id_jenis_order = od.id_jenis_order AND hrg.nama_harga = 'harga1') harga1",
            "(SELECT hrg.harga FROM tbl_harga hrg WHERE hrg.id_jenis_order = od.id_jenis_order AND hrg.nama_harga = 'harga2') harga2",
            "(SELECT hrg.harga FROM tbl_harga hrg WHERE hrg.id_jenis_order = od.id_jenis_order AND hrg.nama_harga = 'harga3') harga3",
        );
        $table  = 'tbl_jenis_order od';
        $by     = 'id_jenis_order';
        $order  = 'DESC';
        $dataJenis = $this->MasterData->getSelectDataOrder($select, $table, $by, $order)->result_array();

        $cont = array(
            'dataJenis' => $dataJenis,
        );

        $data = array(
            'header'    => $header,
            'menu'      => $menu,
            'konten'    => 'pages/data_jenis',
            'footer'    => $footer,
            'cont'      => $cont,
        );

        $this->load->view("view_master_admin", $data);
    }

    public function deleteJenisCetak()
    {
        if ($this->input->POST()) {
            $id = decode($this->input->POST('id'));
            $where = "id_jenis_order = $id";
            $delete = $this->MasterData->deleteData($where, 'tbl_jenis_order');
            if ($delete) {
                echo 'Success';
                alert_success('Data jenis cetak berhasil dihapus.');
            } else {
                echo 'Gagal';
                alert_failed('Data jenis cetak gagal dihapus.');
            }
        }
    }
    // ============================================
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
        $menu['active'] = '5';
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

        $this->load->view("view_master_admin", $data);
    }

    // =================================================

}
