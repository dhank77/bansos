<?php

Class Model_select extends CI_Model{


    function material($id){
        $material="<option value='0'>-- Pilih Material --</option>";
        $this->db->order_by('nama_material','ASC');
        $mat = $this->db->get_where('material',array('id_kategori'=>$id));
        foreach ($mat->result_array() as $data ){
            $material.= "<option value='$data[id_material]'>$data[nama_material]</option>";
        }
        return $material;
    }

    function kelurahan($kecId){
        $kelurahan="<option value='0'>-- Pilih Kelurahan --</option>";
        $this->db->order_by('nama','ASC');
        $kel = $this->db->get_where('kelurahan',array('kecamatan_id'=>$kecId));
        foreach ($kel->result_array() as $data ){
            $kelurahan.= "<option value='$data[id]'>$data[nama]</option>";
        }
        return $kelurahan;
    }

    function kondisi($id){
        $kelurahan="<option value='0'>-- Pilih Kondisi --</option>";
        $this->db->order_by('nama','ASC');
        $kel = $this->db->get_where('kondisi',array('status_id'=>$id));
        foreach ($kel->result_array() as $data ){
            $kelurahan.= "<option value='$data[id]'>$data[nama]</option>";
        }
        return $kelurahan;
    }
    
}