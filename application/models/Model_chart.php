<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Model_chart extends CI_Model {

    public function permintaan_masuk($id){
        $start = date('Y-m-d', time() - (6 * 60 * 60 * 24));
        $last = date('Y-m-d', time() + (60 * 60 * 24));
        $begin = new DateTime($start);
        $end = new DateTime($last);

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);
        $tgl = [];
        $day = [];
        $permintaan_data = [];
        foreach ($period as $dt) {
            $tggl = $dt->format("Y-m-d");
            $hari = hari_ini($tggl);
            array_push($day, $hari);
            array_push($tgl, $tggl);
            $permintaan = $this->db->query("SELECT * from permintaan WHERE id_asal = '$id' AND DATE(tgl_permintaan) = '$tggl'")->num_rows();
            array_push($permintaan_data, $permintaan);
        }

        $send = [
            $day,
            $tgl,
            $permintaan_data
        ];
        return $send; 
    }   

    public function permintaan_keluar($id){
        $start = date('Y-m-d', time() - (6 * 60 * 60 * 24));
        $last = date('Y-m-d', time() + (60 * 60 * 24));
        $begin = new DateTime($start);
        $end = new DateTime($last);

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);
        $tgl = [];
        $day = [];
        $permintaan_data = [];
        foreach ($period as $dt) {
            $tggl = $dt->format("Y-m-d");
            $hari = hari_ini($tggl);
            array_push($day, $hari);
            array_push($tgl, $tggl);
            $permintaan = $this->db->query("SELECT * from permintaan WHERE id_tujuan = '$id' AND DATE(tgl_permintaan) = '$tggl'")->num_rows();
            array_push($permintaan_data, $permintaan);
        }

        $send = [
            $day,
            $tgl,
            $permintaan_data
        ];
        return $send; 
    }   

}

/* End of file Model_chart.php */