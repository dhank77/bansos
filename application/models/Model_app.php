<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_app extends CI_Model
{
    public function view($table)
    {
        return $this->db->get($table);
    }

    public function insert($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function edit($table, $data)
    {
        return $this->db->get_where($table, $data);
    }

    public function update($table, $data, $where)
    {
        return $this->db->update($table, $data, $where);
    }

    public function delete($table, $where)
    {
        return $this->db->delete($table, $where);
    }

    public function view_where($table, $data)
    {
        $this->db->where($data);
        return $this->db->get($table);
    }
    public function view_ordering_limit($table, $order, $ordering, $baris, $dari)
    {
        $this->db->select('*');
        $this->db->order_by($order, $ordering);
        $this->db->limit($dari, $baris);
        return $this->db->get($table);
    }

    public function cari_lowongan($kata)
    {
        if ($this->input->post('sebagai')) {
            $this->db->like("sebagai", $kata);
        }
        if ($this->input->post('pendidikan')) {
            $this->db->where('pendidikan', $this->input->post('pendidikan'));
        }
        if ($this->input->post('id_jurusan')) {
            $this->db->like('id_jurusan', $this->input->post('id_jurusan'));
        }
        return $this->db->get('cdc_lowongan');
    }
    public function cari_event($kata)
    {
        $this->db->like("judul", $kata);
        $this->db->like("isi", $kata);
        return $this->db->get('cdc_event');
    }

    public function lamaran($id_perusahaan)
    {
        $this->db->select('cdc_lamaran.*, mahasiswa.nama_lengkap, cdc_lowongan.sebagai');
        $this->db->from('cdc_lamaran');
        $this->db->join('mahasiswa', 'cdc_lamaran.id_mahasiswa = mahasiswa.id_mahasiswa');
        $this->db->join('cdc_perusahaan', 'cdc_lamaran.id_perusahaan = cdc_perusahaan.id');
        $this->db->join('cdc_lowongan', 'cdc_lamaran.id_lowongan = cdc_lowongan.id');
        $this->db->where('cdc_lamaran.id_perusahaan', $id_perusahaan);
        return $this->db->get()->result_array();
    }

    public function daftar_lamaran($id_lowongan = null, $id_mahasiswa = null)
    {
        $this->db->select('cdc_lamaran.*, mahasiswa.nama_lengkap, mahasiswa.id_mahasiswa, mahasiswa.no_hp_1, mahasiswa.email, cdc_lowongan.sebagai, cdc_perusahaan.nama_lengkap as nama_perusahaan');
        $this->db->from('cdc_lamaran');
        $this->db->join('mahasiswa', 'cdc_lamaran.id_mahasiswa = mahasiswa.id_mahasiswa');
        $this->db->join('cdc_perusahaan', 'cdc_lamaran.id_perusahaan = cdc_perusahaan.id');
        $this->db->join('cdc_lowongan', 'cdc_lamaran.id_lowongan = cdc_lowongan.id');
        if ($id_lowongan) {
            $this->db->where('cdc_lamaran.id_lowongan', $id_lowongan);
        }
        if ($id_mahasiswa) {
            $this->db->where('cdc_lamaran.id_mahasiswa', $id_mahasiswa);
        }
        return $this->db->get()->result_array();
    }

    public function getLaporan($tabel, $tahun)
    {
        $this->db->select('*');
        $this->db->from("$tabel");
        $this->db->join('mahasiswa', "$tabel.id_mahasiswa = mahasiswa.id_mahasiswa");
        $this->db->join('cdc_pekerjaan_utama', 'cdc_pekerjaan_utama.id_mahasiswa = mahasiswa.id_mahasiswa');
        $this->db->join('cdc_kuisioner_data', 'cdc_kuisioner_data.id_mahasiswa = mahasiswa.id_mahasiswa');
        $this->db->join('cdc_bidang_usaha', "cdc_bidang_usaha.id = $tabel.id_bidang_usaha");
        $this->db->join('cdc_sub_bidang_usaha', "cdc_sub_bidang_usaha.id = $tabel.id_bidang_usaha");
        $this->db->where("$tabel.tahun_input", $tahun);
        return $this->db->get()->result_array();
    }
    
    public function getLaporanWirausaha($tahun)
    {
        $this->db->select('*');
        $this->db->from("cdc_wirausaha");
        $this->db->join('mahasiswa', "cdc_wirausaha.id_mahasiswa = mahasiswa.id_mahasiswa");
        $this->db->join('cdc_pekerjaan_utama', 'cdc_pekerjaan_utama.id_mahasiswa = mahasiswa.id_mahasiswa');
        $this->db->join('cdc_kuisioner_data', 'cdc_kuisioner_data.id_mahasiswa = mahasiswa.id_mahasiswa');
        $this->db->where("cdc_wirausaha.tahun_input", $tahun);
        return $this->db->get()->result_array();
    }

    public function getLaporanIdeal($tahun)
    {
        $this->db->select('*');
        $this->db->from("cdc_pekerjaan_ideal");
        $this->db->join('mahasiswa', "cdc_pekerjaan_ideal.id_mahasiswa = mahasiswa.id_mahasiswa");
        $this->db->join('cdc_pekerjaan_utama', 'cdc_pekerjaan_utama.id_mahasiswa = mahasiswa.id_mahasiswa');
        $this->db->join('cdc_kuisioner_data', 'cdc_kuisioner_data.id_mahasiswa = mahasiswa.id_mahasiswa');
        $this->db->where("cdc_pekerjaan_ideal.tahun_input", $tahun);
        return $this->db->get()->result_array();
    }

    public function getLaporanKuisioner($tahun)
    {
        $this->db->select('*');
        $this->db->from("cdc_kuisioner_all");
        $this->db->join('mahasiswa', "cdc_kuisioner_all.id_mahasiswa = mahasiswa.id_mahasiswa");
        $this->db->join('cdc_pekerjaan_utama', 'cdc_pekerjaan_utama.id_mahasiswa = mahasiswa.id_mahasiswa');
        $this->db->join('cdc_kuisioner_p', 'cdc_kuisioner_p.id_mahasiswa = mahasiswa.id_mahasiswa');
        $this->db->join('cdc_kuisioner_q', 'cdc_kuisioner_q.id_mahasiswa = mahasiswa.id_mahasiswa');
        $this->db->join('cdc_kuisioner_r', 'cdc_kuisioner_r.id_mahasiswa = mahasiswa.id_mahasiswa');
        $this->db->join('cdc_kuisioner_s', 'cdc_kuisioner_s.id_mahasiswa = mahasiswa.id_mahasiswa');
        $this->db->join('cdc_kuisioner_t', 'cdc_kuisioner_t.id_mahasiswa = mahasiswa.id_mahasiswa');
        $this->db->join('cdc_kuisioner_u', 'cdc_kuisioner_u.id_mahasiswa = mahasiswa.id_mahasiswa');
        $this->db->join('cdc_kuisioner_v', 'cdc_kuisioner_v.id_mahasiswa = mahasiswa.id_mahasiswa');
        $this->db->join('cdc_kuisioner_w', 'cdc_kuisioner_w.id_mahasiswa = mahasiswa.id_mahasiswa');
        $this->db->join('cdc_kuisioner_x', 'cdc_kuisioner_x.id_mahasiswa = mahasiswa.id_mahasiswa');
        $this->db->where("cdc_kuisioner_all.tahun_input", $tahun);
        return $this->db->get()->result_array();
    }

    public function panggilan($id_mahasiswa = null)
    {
        if ($id_mahasiswa != null) {
            $query = "SELECT id_perusahaan FROM `cdc_lamaran`  WHERE id_mahasiswa = $id_mahasiswa GROUP BY id_perusahaan";
            return $this->db->query($query)->result_array();
        }
    }

    public function lamaran_list_populer()
    {
        $query = "SELECT id_lowongan, count(id_lowongan) AS jumlah_pelamar FROM `cdc_lamaran`  GROUP BY id_lowongan ORDER by jumlah_pelamar DESC LIMIT 6";
        return $this->db->query($query)->result_array();
    }

    public function subbidang($id = null)
    {
        if ($id == null) {
            redirect('/');
        }
        $subbidang = "<div class='form-group lg'>";
        $subbidang .= "<label>Sub Bidang Usaha <span class='text-danger'>*</span></label>";
        $subbidang .= "<select name='id_sub_bidang_usaha' class='form-control' style='height:50px;'><option value='0'>-- Pilih Sub Bidang Usaha --</option>";
        $this->db->order_by('nama_sub_bidang_usaha', 'ASC');
        $sub = $this->db->get_where('cdc_sub_bidang_usaha', ['id_bidang_usaha' => $id]);
        foreach ($sub->result_array() as $data) {
            $subbidang .= "<option value='$data[id]' " . set_value('id_sub_bidang_usaha', $data['id']) . " >$data[nama_sub_bidang_usaha]</option>";
        }
        $subbidang .= "</select></div>";
        return $subbidang;
    }

    
    public function getPanggilanTes()
    {
        $this->db->limit('6');
        $this->db->order_by('cdc_panggilan_tes.id', 'DESC');
        $this->db->select('*');
        $this->db->from('cdc_panggilan_tes');
        $this->db->join('cdc_perusahaan', 'cdc_perusahaan.id = cdc_panggilan_tes.id_perusahaan');
        $res = $this->db->get()->result_array();
        return $res;
    }



    public function getAlumni($id_mahasiswa = null)
    {
        if ($id_mahasiswa == null) {
            redirect('/');
        }
        $mhs = $this->db->get_where('mahasiswa', ['id_mahasiswa' => $id_mahasiswa])->row_array();
        $this->db->select('*');
        $this->db->from('mahasiswa');
        $this->db->join('prodi', 'prodi.id_prodi = mahasiswa.id_prodi');
        $this->db->join('angkatan', 'angkatan.id_angkatan = mahasiswa.id_angkatan');
        if ($mhs['id_kelurahan'] != null) {
            $this->db->join('master_kel', 'master_kel.kel_id = mahasiswa.id_kelurahan');
        }
        if ($mhs['id_kecamatan'] != null) {
            $this->db->join('master_kecam', 'master_kecam.kecam_id = mahasiswa.id_kecamatan');
        }
        if ($mhs['id_kota'] != null) {
            $this->db->join('master_kokab', 'master_kokab.kota_id = mahasiswa.id_kota');
        }
        if ($mhs['id_provinsi'] != null) {
            $this->db->join('master_provinsi', 'master_provinsi.provinsi_id = mahasiswa.id_provinsi');
        }
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $this->db->where('status_mahasiswa', 2);
        $ret = $this->db->get()->row_array();
        return $ret;
    }

    public function getCountBekerja()
    {
        $tNow = $this->db->get_where('mahasiswa', ['status_mahasiswa' => 2, 'YEAR(tgl_lulus)' => date('Y')])->result_array();
        $tM1 = $this->db->get_where('mahasiswa', ['status_mahasiswa' => 2, 'YEAR(tgl_lulus)' => date('Y') - 1])->result_array();
        $tM2 = $this->db->get_where('mahasiswa', ['status_mahasiswa' => 2, 'YEAR(tgl_lulus)' => date('Y') - 2])->result_array();
        $tM3 = $this->db->get_where('mahasiswa', ['status_mahasiswa' => 2, 'YEAR(tgl_lulus)' => date('Y') - 3])->result_array();
        $tM4 = $this->db->get_where('mahasiswa', ['status_mahasiswa' => 2, 'YEAR(tgl_lulus)' => date('Y') - 4])->result_array();
        $pekerjaan = $this->db->get('cdc_pekerjaan_utama')->result_array();

        $bekerjaNow = 0;
        $wirausahaNow = 0;
        $tidak_bekerjaNow = 0;
        foreach ($pekerjaan as $p) {
            foreach ($tNow as $t) {
                if ($t['id_mahasiswa'] == $p['id_mahasiswa']) {
                    if ($p['id_pekerjaan_utama'] == 1) {
                        $bekerjaNow += 1;
                    }
                    if ($p['id_pekerjaan_utama'] == 2) {
                        $wirausahaNow += 1;
                    }
                    if ($p['id_pekerjaan_utama'] == 3) {
                        $tidak_bekerjaNow += 1;
                    }
                }
            }
        }
        $bekerjaM1 = 0;
        $wirausahaM1 = 0;
        $tidak_bekerjaM1 = 0;
        foreach ($pekerjaan as $p) {
            foreach ($tM1 as $t) {
                if ($t['id_mahasiswa'] == $p['id_mahasiswa']) {
                    if ($p['id_pekerjaan_utama'] == 1) {
                        $bekerjaM1 += 1;
                    }
                    if ($p['id_pekerjaan_utama'] == 2) {
                        $wirausahaM1 += 1;
                    }
                    if ($p['id_pekerjaan_utama'] == 3) {
                        $tidak_bekerjaM1 += 1;
                    }
                }
            }
        }
        $bekerjaM2 = 0;
        $wirausahaM2 = 0;
        $tidak_bekerjaM2 = 0;
        foreach ($pekerjaan as $p) {
            foreach ($tM2 as $t) {
                if ($t['id_mahasiswa'] == $p['id_mahasiswa']) {
                    if ($p['id_pekerjaan_utama'] == 1) {
                        $bekerjaM2 += 1;
                    }
                    if ($p['id_pekerjaan_utama'] == 2) {
                        $wirausahaM2 += 1;
                    }
                    if ($p['id_pekerjaan_utama'] == 3) {
                        $tidak_bekerjaM2 += 1;
                    }
                }
            }
        }
        $bekerjaM3 = 0;
        $wirausahaM3 = 0;
        $tidak_bekerjaM3 = 0;
        foreach ($pekerjaan as $p) {
            foreach ($tM3 as $t) {
                if ($t['id_mahasiswa'] == $p['id_mahasiswa']) {
                    if ($p['id_pekerjaan_utama'] == 1) {
                        $bekerjaM3 += 1;
                    }
                    if ($p['id_pekerjaan_utama'] == 2) {
                        $wirausahaM3 += 1;
                    }
                    if ($p['id_pekerjaan_utama'] == 3) {
                        $tidak_bekerjaM3 += 1;
                    }
                }
            }
        }
        $bekerjaM4 = 0;
        $wirausahaM4 = 0;
        $tidak_bekerjaM4 = 0;
        foreach ($pekerjaan as $p) {
            foreach ($tM4 as $t) {
                if ($t['id_mahasiswa'] == $p['id_mahasiswa']) {
                    if ($p['id_pekerjaan_utama'] == 1) {
                        $bekerjaM4 += 1;
                    }
                    if ($p['id_pekerjaan_utama'] == 2) {
                        $wirausahaM4 += 1;
                    }
                    if ($p['id_pekerjaan_utama'] == 3) {
                        $tidak_bekerjaM4 += 1;
                    }
                }
            }
        }
        $data['now'] = [$bekerjaNow, $wirausahaNow, $tidak_bekerjaNow];
        $data['m1'] = [$bekerjaM1, $wirausahaM1, $tidak_bekerjaM1];
        $data['m2'] = [$bekerjaM2, $wirausahaM2, $tidak_bekerjaM2];
        $data['m3'] = [$bekerjaM3, $wirausahaM3, $tidak_bekerjaM3];
        $data['m4'] = [$bekerjaM4, $wirausahaM4, $tidak_bekerjaM4];
        return $data;
    }

    public function getKuisioner($inis, $length)
    {
        $tNow = $this->db->get_where('mahasiswa', ['status_mahasiswa' => 2, 'YEAR(tgl_lulus)' => date('Y')])->result_array();
        $tM1 = $this->db->get_where('mahasiswa', ['status_mahasiswa' => 2, 'YEAR(tgl_lulus)' => date('Y') - 1])->result_array();
        $tM2 = $this->db->get_where('mahasiswa', ['status_mahasiswa' => 2, 'YEAR(tgl_lulus)' => date('Y') - 2])->result_array();
        $tM3 = $this->db->get_where('mahasiswa', ['status_mahasiswa' => 2, 'YEAR(tgl_lulus)' => date('Y') - 3])->result_array();
        $tM4 = $this->db->get_where('mahasiswa', ['status_mahasiswa' => 2, 'YEAR(tgl_lulus)' => date('Y') - 4])->result_array();

        $kuisioner = $this->db->get("cdc_kuisioner_$inis")->result_array();

        for ($i = 1; $i < $length + 1; $i++) {
            $n1[$i] =  0;
            $n2[$i] = 0;
            $n3[$i] = 0;
            $n4[$i] = 0;
            $n5[$i] = 0;
        }
        for ($i = 1; $i < $length + 1; $i++) {
            $o1[$i] =  0;
            $o2[$i] = 0;
            $o3[$i] = 0;
            $o4[$i] = 0;
            $o5[$i] = 0;
        }
        for ($i = 1; $i < $length + 1; $i++) {
            $p1[$i] =  0;
            $p2[$i] = 0;
            $p3[$i] = 0;
            $p4[$i] = 0;
            $p5[$i] = 0;
        }
        for ($i = 1; $i < $length + 1; $i++) {
            $q1[$i] =  0;
            $q2[$i] = 0;
            $q3[$i] = 0;
            $q4[$i] = 0;
            $q5[$i] = 0;
        }
        for ($i = 1; $i < $length + 1; $i++) {
            $r1[$i] =  0;
            $r2[$i] = 0;
            $r3[$i] = 0;
            $r4[$i] = 0;
            $r5[$i] = 0;
        }

        foreach ($kuisioner as $k) {
            foreach ($tNow as $t) {
                if ($t['id_mahasiswa'] == $k['id_mahasiswa']) {
                    for ($i = 1; $i < $length + 1; $i++) {
                        if ($k["$inis$i"] == 1) {
                            $n1[$i] += 1;
                        }
                        if ($k["$inis$i"] == 2) {
                            $n2[$i] += 1;
                        }
                        if ($k["$inis$i"] == 3) {
                            $n3[$i] += 1;
                        }
                        if ($k["$inis$i"] == 4) {
                            $n4[$i] += 1;
                        }
                        if ($k["$inis$i"] == 5) {
                            $n5[$i] += 1;
                        }
                    }
                }
            }
        }

        foreach ($kuisioner as $k) {
            foreach ($tM1 as $t) {
                if ($t['id_mahasiswa'] == $k['id_mahasiswa']) {
                    for ($i = 1; $i < $length + 1; $i++) {
                        if ($k["$inis$i"] == 1) {
                            $o1[$i] += 1;
                        }
                        if ($k["$inis$i"] == 2) {
                            $o2[$i] += 1;
                        }
                        if ($k["$inis$i"] == 3) {
                            $o3[$i] += 1;
                        }
                        if ($k["$inis$i"] == 4) {
                            $o4[$i] += 1;
                        }
                        if ($k["$inis$i"] == 5) {
                            $o5[$i] += 1;
                        }
                    }
                }
            }
        }

        foreach ($kuisioner as $k) {
            foreach ($tM2 as $t) {
                if ($t['id_mahasiswa'] == $k['id_mahasiswa']) {
                    for ($i = 1; $i < $length + 1; $i++) {
                        if ($k["$inis$i"] == 1) {
                            $p1[$i] += 1;
                        }
                        if ($k["$inis$i"] == 2) {
                            $p2[$i] += 1;
                        }
                        if ($k["$inis$i"] == 3) {
                            $p3[$i] += 1;
                        }
                        if ($k["$inis$i"] == 4) {
                            $p4[$i] += 1;
                        }
                        if ($k["$inis$i"] == 5) {
                            $p5[$i] += 1;
                        }
                    }
                }
            }
        }
        foreach ($kuisioner as $k) {
            foreach ($tM3 as $t) {
                if ($t['id_mahasiswa'] == $k['id_mahasiswa']) {
                    for ($i = 1; $i < $length + 1; $i++) {
                        if ($k["$inis$i"] == 1) {
                            $q1[$i] += 1;
                        }
                        if ($k["$inis$i"] == 2) {
                            $q2[$i] += 1;
                        }
                        if ($k["$inis$i"] == 3) {
                            $q3[$i] += 1;
                        }
                        if ($k["$inis$i"] == 4) {
                            $q4[$i] += 1;
                        }
                        if ($k["$inis$i"] == 5) {
                            $q5[$i] += 1;
                        }
                    }
                }
            }
        }
        foreach ($kuisioner as $k) {
            foreach ($tM4 as $t) {
                if ($t['id_mahasiswa'] == $k['id_mahasiswa']) {
                    for ($i = 1; $i < $length + 1; $i++) {
                        if ($k["$inis$i"] == 1) {
                            $r1[$i] += 1;
                        }
                        if ($k["$inis$i"] == 2) {
                            $r2[$i] += 1;
                        }
                        if ($k["$inis$i"] == 3) {
                            $r3[$i] += 1;
                        }
                        if ($k["$inis$i"] == 4) {
                            $r4[$i] += 1;
                        }
                        if ($k["$inis$i"] == 5) {
                            $r5[$i] += 1;
                        }
                    }
                }
            }
        }

        for ($i = 1; $i < $length + 1; $i++) {
            $data["$inis$i"]['now'] = [$n1[$i], $n2[$i], $n3[$i], $n4[$i], $n5[$i]];
            $data["$inis$i"]['m1'] = [$o1[$i], $o2[$i], $o3[$i], $o4[$i], $o5[$i]];
            $data["$inis$i"]['m2'] = [$p1[$i], $p2[$i], $p3[$i], $p4[$i], $p5[$i]];
            $data["$inis$i"]['m3'] = [$q1[$i], $q2[$i], $q3[$i], $q4[$i], $q5[$i]];
            $data["$inis$i"]['m4'] = [$r1[$i], $r2[$i], $r3[$i], $r4[$i], $r5[$i]];
        }

        return ($data);
    }

    public function getBekerja($table)
    {
        $tNow = $this->db->get_where('mahasiswa', ['status_mahasiswa' => 2, 'YEAR(tgl_lulus)' => date('Y')])->result_array();
        $tM1 = $this->db->get_where('mahasiswa', ['status_mahasiswa' => 2, 'YEAR(tgl_lulus)' => date('Y') - 1])->result_array();
        $tM2 = $this->db->get_where('mahasiswa', ['status_mahasiswa' => 2, 'YEAR(tgl_lulus)' => date('Y') - 2])->result_array();
        $tM3 = $this->db->get_where('mahasiswa', ['status_mahasiswa' => 2, 'YEAR(tgl_lulus)' => date('Y') - 3])->result_array();
        $tM4 = $this->db->get_where('mahasiswa', ['status_mahasiswa' => 2, 'YEAR(tgl_lulus)' => date('Y') - 4])->result_array();

        $kuisioner = $this->db->get("cdc_$table")->result_array();

        // // Tahun Ini
        if ($table == "bekerja") {
            // Kategori
            $lokal = 0;
            $nasional = 0;
            $internasional = 0;

            // Sesuai Bidang
            $sesuai = 0;
            $tidak_sesuai = 0;

            // ID Bidang usaha
            for ($i = 2; $i < 23; $i++) {
                $kategori[$i] = 0;
            }

            // ID SUB Bidang usaha
            for ($i = 1; $i < 88; $i++) {
                $sub[$i] = 0;
            }

            // Bonus
            for ($i = 0; $i < 5; $i++) {
                $bonus[$i] = 0;
            }
        }

        if ($table == "pekerjaan_sebelum") {
            $label_alasan = [
                "Gaji Kurang Memuaskan",
                "Tidak Sesua Minat",
                "Lingkungan Kerja Tidak Kondusif (Pekerjaan Terlalu Padat, dll)",
                "Mencari Pengembangan Diri Yang Lebih Besar",
                "Habis Masa Kontrak",
                "Melanjutkan Studi",
                "Mencari Pengalaman Lain",
                "Lainnya"
            ];
            // Alasan
            for ($i = 0; $i < 8; $i++) {
                $alasan[$i] = 0;
                $alasanM1[$i] = 0;
                $alasanM2[$i] = 0;
            }
        }

        // Jabatan
        $magang = 0;
        $staf = 0;
        $manajer = 0;
        $direktur = 0;
        $pemilik = 0;

        // Tanggung Jawab
        $label = [
            "Maintenance",
            "Process Engineering",
            "Surveliance Engineering",
            "Distribution",
            "Production",
            "Research and Development",
            "Sales and Marketing",
            "Field Engineer",
            "Controling",
            "Ensuring",
            "Planning",
            "Suply Chain",
            "Packaging",
            "Service"
        ];
        for ($i = 0; $i < 14; $i++) {
            $tanggung_jawab[$i] = 0;
        }

        // Label penghasilan dan bonus
        $uang = [
            "3",
            "3-5",
            "5-7",
            "7-10",
            "10"
        ];
        // Penghasilan
        for ($i = 0; $i < 5; $i++) {
            $penghasilan[$i] = 0;
        }

        // Tahun ini
        foreach ($kuisioner as $k) {
            foreach ($tNow as $t) {
                if ($t['id_mahasiswa'] == $k['id_mahasiswa']) {
                    if ($table == "bekerja") {
                        if ($k["kategori"] == "Lokal") {
                            $lokal += 1;
                        }
                        if ($k["kategori"] == "Nasional") {
                            $nasional += 1;
                        }
                        if ($k["kategori"] == "Internasional") {
                            $internasional += 1;
                        }
                        if ($k["sesuai_bidang"] == "Ya") {
                            $sesuai += 1;
                        }
                        if ($k["sesuai_bidang"] == "Tidak") {
                            $tidak_sesuai += 1;
                        }
                        for ($i = 2; $i < 23; $i++) {
                            if ($k['id_bidang_usaha'] == $i) {
                                $kategori[$i] += 1;
                            }
                        }
                        for ($i = 1; $i < 88; $i++) {
                            if ($k['id_sub_bidang_usaha'] == $i) {
                                $sub[$i] += 1;
                            }
                        }
                        for ($i = 0; $i < 5; $i++) {
                            if ($k["bonus"] == $uang[$i]) {
                                $bonus[$i] += 1;
                            }
                        }
                    }

                    if ($table == "pekerjaan_sebelum") {
                        for ($i = 0; $i < 8; $i++) {
                            if ($k["alasan"] == $label_alasan[$i]) {
                                $alasan[$i] += 1;
                            }
                        }
                    }

                    if ($k["jabatan"] == "Magang") {
                        $magang += 1;
                    }
                    if ($k["jabatan"] == "Staf") {
                        $staf += 1;
                    }
                    if ($k["jabatan"] == "Manajer") {
                        $manajer += 1;
                    }
                    if ($k["jabatan"] == "Direktur") {
                        $direktur += 1;
                    }
                    if ($k["jabatan"] == "Pemilik") {
                        $pemilik += 1;
                    }
                    for ($i = 0; $i < 14; $i++) {
                        if ($k["jenis_tanggung_jawab"] == $label[$i]) {
                            $tanggung_jawab[$i] += 1;
                        }
                    }
                    for ($i = 0; $i < 5; $i++) {
                        if ($k["penghasilan"] == $uang[$i]) {
                            $penghasilan[$i] += 1;
                        }
                    }
                }
            }
        }

        // // 1 Tahun Lalu
        if ($table == "bekerja") {
            // Kategori
            $lokalM1 = 0;
            $nasionalM1 = 0;
            $internasionalM1 = 0;

            // Sesuai Bidang
            $sesuaiM1 = 0;
            $tidak_sesuaiM1 = 0;

            // ID Bidang usaha
            for ($i = 2; $i < 23; $i++) {
                $kategoriM1[$i] = 0;
            }

            // ID SUB Bidang usaha
            for ($i = 1; $i < 88; $i++) {
                $subM1[$i] = 0;
            }

            // Bonus
            for ($i = 0; $i < 5; $i++) {
                $bonusM1[$i] = 0;
            }
        }
        // Jabatan
        $magangM1 = 0;
        $stafM1 = 0;
        $manajerM1 = 0;
        $direkturM1 = 0;
        $pemilikM1 = 0;

        // Tanggung Jawab
        for ($i = 0; $i < 14; $i++) {
            $tanggung_jawabM1[$i] = 0;
        }

        // Penghasilan
        for ($i = 0; $i < 5; $i++) {
            $penghasilanM1[$i] = 0;
        }

        // 1 Tahun Lalu
        foreach ($kuisioner as $k) {
            foreach ($tM1 as $t) {
                if ($t['id_mahasiswa'] == $k['id_mahasiswa']) {
                    if ($table == "bekerja") {
                        if ($k["kategori"] == "Lokal") {
                            $lokalM1 += 1;
                        }
                        if ($k["kategori"] == "Nasional") {
                            $nasionalM1 += 1;
                        }
                        if ($k["kategori"] == "Internasional") {
                            $internasionalM1 += 1;
                        }
                        if ($k["sesuai_bidang"] == "Ya") {
                            $sesuaiM1 += 1;
                        }
                        if ($k["sesuai_bidang"] == "Tidak") {
                            $tidak_sesuaiM1 += 1;
                        }
                        for ($i = 2; $i < 23; $i++) {
                            if ($k['id_bidang_usaha'] == $i) {
                                $kategoriM1[$i] += 1;
                            }
                        }
                        for ($i = 1; $i < 88; $i++) {
                            if ($k['id_sub_bidang_usaha'] == $i) {
                                $subM1[$i] += 1;
                            }
                        }
                        for ($i = 0; $i < 5; $i++) {
                            if ($k["bonus"] == $uang[$i]) {
                                $bonusM1[$i] += 1;
                            }
                        }
                    }
                    if ($table == "pekerjaan_sebelum") {
                        for ($i = 0; $i < 8; $i++) {
                            if ($k["alasan"] == $label_alasan[$i]) {
                                $alasanM1[$i] += 1;
                            }
                        }
                    }
                    if ($k["jabatan"] == "Magang") {
                        $magangM1 += 1;
                    }
                    if ($k["jabatan"] == "Staf") {
                        $stafM1 += 1;
                    }
                    if ($k["jabatan"] == "Manajer") {
                        $manajerM1 += 1;
                    }
                    if ($k["jabatan"] == "Direktur") {
                        $direkturM1 += 1;
                    }
                    if ($k["jabatan"] == "Pemilik") {
                        $pemilikM1 += 1;
                    }
                    for ($i = 0; $i < 14; $i++) {
                        if ($k["jenis_tanggung_jawab"] == $label[$i]) {
                            $tanggung_jawabM1[$i] += 1;
                        }
                    }
                    for ($i = 0; $i < 5; $i++) {
                        if ($k["penghasilan"] == $uang[$i]) {
                            $penghasilanM1[$i] += 1;
                        }
                    }
                }
            }
        }

        // // 2 Tahun Lalu
        if ($table == "bekerja") {
            // Kategori
            $lokalM2 = 0;
            $nasionalM2 = 0;
            $internasionalM2 = 0;

            // Sesuai Bidang
            $sesuaiM2 = 0;
            $tidak_sesuaiM2 = 0;

            // ID Bidang usaha
            for ($i = 2; $i < 23; $i++) {
                $kategoriM2[$i] = 0;
            }

            // ID SUB Bidang usaha
            for ($i = 1; $i < 88; $i++) {
                $subM2[$i] = 0;
            }

            // Bonus
            for ($i = 0; $i < 5; $i++) {
                $bonusM2[$i] = 0;
            }
        }
        // Jabatan
        $magangM2 = 0;
        $stafM2 = 0;
        $manajerM2 = 0;
        $direkturM2 = 0;
        $pemilikM2 = 0;

        // Tanggung Jawab
        for ($i = 0; $i < 14; $i++) {
            $tanggung_jawabM2[$i] = 0;
        }

        // Penghasilan
        for ($i = 0; $i < 5; $i++) {
            $penghasilanM2[$i] = 0;
        }


        // 2 Tahun Lalu
        foreach ($kuisioner as $k) {
            foreach ($tM2 as $t) {
                if ($t['id_mahasiswa'] == $k['id_mahasiswa']) {
                    if ($table == "bekerja") {
                        if ($k["kategori"] == "Lokal") {
                            $lokalM2 += 1;
                        }
                        if ($k["kategori"] == "Nasional") {
                            $nasionalM2 += 1;
                        }
                        if ($k["kategori"] == "Internasional") {
                            $internasionalM2 += 1;
                        }
                        if ($k["sesuai_bidang"] == "Ya") {
                            $sesuaiM2 += 1;
                        }
                        if ($k["sesuai_bidang"] == "Tidak") {
                            $tidak_sesuaiM2 += 1;
                        }
                        for ($i = 2; $i < 23; $i++) {
                            if ($k['id_bidang_usaha'] == $i) {
                                $kategoriM2[$i] += 1;
                            }
                        }
                        for ($i = 0; $i < 5; $i++) {
                            if ($k["bonus"] == $uang[$i]) {
                                $bonusM2[$i] += 1;
                            }
                        }
                    }
                    if ($table == "pekerjaan_sebelum") {
                        for ($i = 0; $i < 8; $i++) {
                            if ($k["alasan"] == $label_alasan[$i]) {
                                $alasanM2[$i] += 1;
                            }
                        }
                    }
                    for ($i = 1; $i < 88; $i++) {
                        if ($k['id_sub_bidang_usaha'] == $i) {
                            $subM2[$i] += 1;
                        }
                    }
                    if ($k["jabatan"] == "Magang") {
                        $magangM2 += 1;
                    }
                    if ($k["jabatan"] == "Staf") {
                        $stafM2 += 1;
                    }
                    if ($k["jabatan"] == "Manajer") {
                        $manajerM2 += 1;
                    }
                    if ($k["jabatan"] == "Direktur") {
                        $direkturM2 += 1;
                    }
                    if ($k["jabatan"] == "Pemilik") {
                        $pemilikM2 += 1;
                    }
                    for ($i = 0; $i < 14; $i++) {
                        if ($k["jenis_tanggung_jawab"] == $label[$i]) {
                            $tanggung_jawabM2[$i] += 1;
                        }
                    }
                    for ($i = 0; $i < 5; $i++) {
                        if ($k["penghasilan"] == $uang[$i]) {
                            $penghasilanM2[$i] += 1;
                        }
                    }
                }
            }
        }

        // // 3 Tahun Lalu
        if ($table == "bekerja") {
            // Kategori
            $lokalM3 = 0;
            $nasionalM3 = 0;
            $internasionalM3 = 0;

            // Sesuai Bidang
            $sesuaiM3 = 0;
            $tidak_sesuaiM3 = 0;

            // ID Bidang usaha
            for ($i = 2; $i < 23; $i++) {
                $kategoriM3[$i] = 0;
            }

            // ID SUB Bidang usaha
            for ($i = 1; $i < 88; $i++) {
                $subM3[$i] = 0;
            }

            // Bonus
            for ($i = 0; $i < 5; $i++) {
                $bonusM3[$i] = 0;
            }
        }
        // Jabatan
        $magangM3 = 0;
        $stafM3 = 0;
        $manajerM3 = 0;
        $direkturM3 = 0;
        $pemilikM3 = 0;

        // Tanggung Jawab
        for ($i = 0; $i < 14; $i++) {
            $tanggung_jawabM3[$i] = 0;
        }

        // Penghasilan
        for ($i = 0; $i < 5; $i++) {
            $penghasilanM3[$i] = 0;
        }


        // 3 Tahun Lalu
        foreach ($kuisioner as $k) {
            foreach ($tM3 as $t) {
                if ($t['id_mahasiswa'] == $k['id_mahasiswa']) {
                    if ($table == "bekerja") {
                        if ($k["kategori"] == "Lokal") {
                            $lokalM3 += 1;
                        }
                        if ($k["kategori"] == "Nasional") {
                            $nasionalM3 += 1;
                        }
                        if ($k["kategori"] == "Internasional") {
                            $internasionalM3 += 1;
                        }
                        if ($k["sesuai_bidang"] == "Ya") {
                            $sesuaiM3 += 1;
                        }
                        if ($k["sesuai_bidang"] == "Tidak") {
                            $tidak_sesuaiM3 += 1;
                        }
                        for ($i = 2; $i < 23; $i++) {
                            if ($k['id_bidang_usaha'] == $i) {
                                $kategoriM3[$i] += 1;
                            }
                        }
                        for ($i = 1; $i < 88; $i++) {
                            if ($k['id_sub_bidang_usaha'] == $i) {
                                $subM3[$i] += 1;
                            }
                        }
                        for ($i = 0; $i < 5; $i++) {
                            if ($k["bonus"] == $uang[$i]) {
                                $bonusM3[$i] += 1;
                            }
                        }
                    }
                    if ($table == "pekerjaan_sebelum") {
                        for ($i = 0; $i < 8; $i++) {
                            if ($k["alasan"] == $label_alasan[$i]) {
                                $alasanM3[$i] += 1;
                            }
                        }
                    }
                    if ($k["jabatan"] == "Magang") {
                        $magangM3 += 1;
                    }
                    if ($k["jabatan"] == "Staf") {
                        $stafM3 += 1;
                    }
                    if ($k["jabatan"] == "Manajer") {
                        $manajerM3 += 1;
                    }
                    if ($k["jabatan"] == "Direktur") {
                        $direkturM3 += 1;
                    }
                    if ($k["jabatan"] == "Pemilik") {
                        $pemilikM3 += 1;
                    }
                    for ($i = 0; $i < 14; $i++) {
                        if ($k["jenis_tanggung_jawab"] == $label[$i]) {
                            $tanggung_jawabM3[$i] += 1;
                        }
                    }
                    for ($i = 0; $i < 5; $i++) {
                        if ($k["penghasilan"] == $uang[$i]) {
                            $penghasilanM3[$i] += 1;
                        }
                    }
                }
            }
        }

        // // 4 Tahun Lalu
        if ($table == "bekerja") {
            // Kategori
            $lokalM4 = 0;
            $nasionalM4 = 0;
            $internasionalM4 = 0;

            // Sesuai Bidang
            $sesuaiM4 = 0;
            $tidak_sesuaiM4 = 0;

            // ID Bidang usaha
            for ($i = 2; $i < 23; $i++) {
                $kategoriM4[$i] = 0;
            }

            // ID SUB Bidang usaha
            for ($i = 1; $i < 88; $i++) {
                $subM4[$i] = 0;
            }

            // Bonus
            for ($i = 0; $i < 5; $i++) {
                $bonusM4[$i] = 0;
            }
        }
        // Jabatan
        $magangM4 = 0;
        $stafM4 = 0;
        $manajerM4 = 0;
        $direkturM4 = 0;
        $pemilikM4 = 0;

        // Tanggung Jawab
        for ($i = 0; $i < 14; $i++) {
            $tanggung_jawabM4[$i] = 0;
        }

        // Penghasilan
        for ($i = 0; $i < 5; $i++) {
            $penghasilanM4[$i] = 0;
        }


        // 3 Tahun Lalu
        foreach ($kuisioner as $k) {
            foreach ($tM4 as $t) {
                if ($t['id_mahasiswa'] == $k['id_mahasiswa']) {
                    if ($table == "bekerja") {
                        if ($k["kategori"] == "Lokal") {
                            $lokalM4 += 1;
                        }
                        if ($k["kategori"] == "Nasional") {
                            $nasionalM4 += 1;
                        }
                        if ($k["kategori"] == "Internasional") {
                            $internasionalM4 += 1;
                        }
                        if ($k["sesuai_bidang"] == "Ya") {
                            $sesuaiM4 += 1;
                        }
                        if ($k["sesuai_bidang"] == "Tidak") {
                            $tidak_sesuaiM4 += 1;
                        }
                        for ($i = 2; $i < 23; $i++) {
                            if ($k['id_bidang_usaha'] == $i) {
                                $kategoriM4[$i] += 1;
                            }
                        }
                        for ($i = 1; $i < 88; $i++) {
                            if ($k['id_sub_bidang_usaha'] == $i) {
                                $subM4[$i] += 1;
                            }
                        }
                        for ($i = 0; $i < 5; $i++) {
                            if ($k["bonus"] == $uang[$i]) {
                                $bonusM4[$i] += 1;
                            }
                        }
                    }
                    if ($table == "pekerjaan_sebelum") {
                        for ($i = 0; $i < 8; $i++) {
                            if ($k["alasan"] == $label_alasan[$i]) {
                                $alasanM4[$i] += 1;
                            }
                        }
                    }
                    if ($k["jabatan"] == "Magang") {
                        $magangM4 += 1;
                    }
                    if ($k["jabatan"] == "Staf") {
                        $stafM4 += 1;
                    }
                    if ($k["jabatan"] == "Manajer") {
                        $manajerM4 += 1;
                    }
                    if ($k["jabatan"] == "Direktur") {
                        $direkturM4 += 1;
                    }
                    if ($k["jabatan"] == "Pemilik") {
                        $pemilikM4 += 1;
                    }
                    for ($i = 0; $i < 14; $i++) {
                        if ($k["jenis_tanggung_jawab"] == $label[$i]) {
                            $tanggung_jawabM4[$i] += 1;
                        }
                    }
                    for ($i = 0; $i < 5; $i++) {
                        if ($k["penghasilan"] == $uang[$i]) {
                            $penghasilanM4[$i] += 1;
                        }
                    }
                }
            }
        }

        if ($table == "bekerja") {

            // Kategori
            $data['kategori']['now'] = [$lokal, $nasional, $internasional];
            $data['kategori']['m1'] = [$lokalM1, $nasionalM1, $internasionalM1];
            $data['kategori']['m2'] = [$lokalM2, $nasionalM2, $internasionalM2];
            $data['kategori']['m3'] = [$lokalM3, $nasionalM3, $internasionalM3];
            $data['kategori']['m4'] = [$lokalM4, $nasionalM4, $internasionalM4];

            // Sesuai Bidang
            $data['sesuai_bidang']['now'] = [$sesuai, $tidak_sesuai];
            $data['sesuai_bidang']['m1'] = [$sesuaiM1, $tidak_sesuaiM1];
            $data['sesuai_bidang']['m2'] = [$sesuaiM2, $tidak_sesuaiM2];
            $data['sesuai_bidang']['m3'] = [$sesuaiM3, $tidak_sesuaiM3];
            $data['sesuai_bidang']['m4'] = [$sesuaiM4, $tidak_sesuaiM4];

            // Bidang Usaha
            $data['bidang']['now'] = [];
            $data['bidang']['m1'] = [];
            $data['bidang']['m2'] = [];
            $data['bidang']['m3'] = [];
            $data['bidang']['m4'] = [];
            for ($i = 2; $i < 23; $i++) {
                array_push($data['bidang']['now'], $kategori[$i]);
                array_push($data['bidang']['m1'], $kategoriM1[$i]);
                array_push($data['bidang']['m2'], $kategoriM2[$i]);
                array_push($data['bidang']['m3'], $kategoriM3[$i]);
                array_push($data['bidang']['m4'], $kategoriM4[$i]);
            }

            // ID SUB Bidang usaha
            $data['sub_bidang']['now'] = [];
            $data['sub_bidang']['m1'] = [];
            $data['sub_bidang']['m2'] = [];
            $data['sub_bidang']['m3'] = [];
            $data['sub_bidang']['m4'] = [];
            for ($i = 1; $i < 88; $i++) {
                array_push($data['sub_bidang']['now'], $sub[$i]);
                array_push($data['sub_bidang']['m1'], $subM1[$i]);
                array_push($data['sub_bidang']['m2'], $subM2[$i]);
                array_push($data['sub_bidang']['m3'], $subM3[$i]);
                array_push($data['sub_bidang']['m4'], $subM4[$i]);
            }
        }

        // Jabatan
        $data['jabatan']['now'] = [$magang, $staf, $manajer, $direktur, $pemilik];
        $data['jabatan']['m1'] = [$magangM1, $stafM1, $manajerM1, $direkturM1, $pemilikM1];
        $data['jabatan']['m2'] = [$magangM2, $stafM2, $manajerM2, $direkturM2, $pemilikM2];
        $data['jabatan']['m3'] = [$magangM3, $stafM3, $manajerM3, $direkturM3, $pemilikM3];
        $data['jabatan']['m4'] = [$magangM4, $stafM4, $manajerM4, $direkturM4, $pemilikM4];

        // Tanggung Jawab
        $data['tanggung_jawab']['now'] = [];
        $data['tanggung_jawab']['m1'] = [];
        $data['tanggung_jawab']['m2'] = [];
        $data['tanggung_jawab']['m3'] = [];
        $data['tanggung_jawab']['m4'] = [];
        for ($i = 0; $i < 14; $i++) {
            array_push($data['tanggung_jawab']['now'], $tanggung_jawab[$i]);
            array_push($data['tanggung_jawab']['m1'], $tanggung_jawabM1[$i]);
            array_push($data['tanggung_jawab']['m2'], $tanggung_jawabM2[$i]);
            array_push($data['tanggung_jawab']['m3'], $tanggung_jawabM3[$i]);
            array_push($data['tanggung_jawab']['m4'], $tanggung_jawabM4[$i]);
        }

        // Penghasilan
        $data['penghasilan']['now'] = [];
        $data['penghasilan']['m1'] = [];
        $data['penghasilan']['m2'] = [];
        $data['penghasilan']['m3'] = [];
        $data['penghasilan']['m4'] = [];
        for ($i = 0; $i < 5; $i++) {
            array_push($data['penghasilan']['now'], $penghasilan[$i]);
            array_push($data['penghasilan']['m1'], $penghasilanM1[$i]);
            array_push($data['penghasilan']['m2'], $penghasilanM2[$i]);
            array_push($data['penghasilan']['m3'], $penghasilanM3[$i]);
            array_push($data['penghasilan']['m4'], $penghasilanM4[$i]);
        }

        if ($table == "bekerja") {
            // Bonus
            $data['bonus']['now'] = [];
            $data['bonus']['m1'] = [];
            $data['bonus']['m2'] = [];
            $data['bonus']['m3'] = [];
            $data['bonus']['m4'] = [];
            for ($i = 0; $i < 5; $i++) {
                array_push($data['bonus']['now'], $bonus[$i]);
                array_push($data['bonus']['m1'], $bonusM1[$i]);
                array_push($data['bonus']['m2'], $bonusM2[$i]);
                array_push($data['bonus']['m3'], $bonusM3[$i]);
                array_push($data['bonus']['m4'], $bonusM4[$i]);
            }
        }

        if ($table == "pekerjaan_sebelum") {
            // Bonus
            $data['alasan']['now'] = [];
            $data['alasan']['m1'] = [];
            $data['alasan']['m2'] = [];
            $data['alasan']['m3'] = [];
            $data['alasan']['m4'] = [];
            for ($i = 0; $i < 8; $i++) {
                array_push($data['alasan']['now'], $alasan[$i]);
                array_push($data['alasan']['m1'], $alasanM1[$i]);
                array_push($data['alasan']['m2'], $alasanM2[$i]);
                array_push($data['alasan']['m3'], $alasanM3[$i]);
                array_push($data['alasan']['m4'], $alasanM4[$i]);
            }
        }


        return $data;
    }

    public function getAllTracer()
    {
        $tNow = $this->db->get_where('mahasiswa', ['status_mahasiswa' => 2, 'YEAR(tgl_lulus)' => date('Y')])->result_array();
        $tM1 = $this->db->get_where('mahasiswa', ['status_mahasiswa' => 2, 'YEAR(tgl_lulus)' => date('Y') - 1])->result_array();
        $tM2 = $this->db->get_where('mahasiswa', ['status_mahasiswa' => 2, 'YEAR(tgl_lulus)' => date('Y') - 2])->result_array();
        $tM3 = $this->db->get_where('mahasiswa', ['status_mahasiswa' => 2, 'YEAR(tgl_lulus)' => date('Y') - 3])->result_array();
        $tM4 = $this->db->get_where('mahasiswa', ['status_mahasiswa' => 2, 'YEAR(tgl_lulus)' => date('Y') - 4])->result_array();

        $kuisioner = $this->db->get('cdc_kuisioner_all')->result_array();

        // tinggal
        $label_tinggal = [
            "Di Asrama",
            "Di Tempat Kos",
            "Bersama Orang Tua / Keluarga",
            "Bersama Saudara",
            "Berbagi Kamar Kos / Apartemen",
            "Lainnya",
        ];

        // biaya
        $label_biaya = [
            "Beasiswa",
            "Sebagian Beasiswa",
            "Orang Tua / Keluarga",
            "Biaya Sendiri",
            "Lainnya",
        ];

        // Label 13
        $label_13 = [
            "Melalui Iklan Koran / Majalah / Brosur ",
            "Melamar ke perusahaan tanpa mengetahui lowongan yang ada ",
            "Pergi ke bursa / pameran kerja yang diselenggarakan selain CDC FEB Untirta ",
            "Mencari lewat internet / iklan online / sosial media di luar website CDC FEB Untirta ",
            "Dihubungi oleh perusahaan ",
            "Menghubungi Kemenakertrans ",
            "Menghubungi agen tenaga kerja komersial / swasta ",
            "Membangun network sejak masih kuliah ",
            "Melalui relasi (dosen, orangtua, saudara, teman, dll) ",
            "Membangun bisnis sendiri ",
            "Melalui penempatan kerja atau magang ",
            "Bekerja di tempat yang sama dengan tempat kerja semasa kuliah ",
            "Lainnya "
        ];

        // Label Persepsi
        $label_persepsi = [
            "Program Diskusi",
            "Spesialisasi",
            "IPK",
            "Pengalam kerja selama kuliah",
            "Reputasi dari perguruan tinggi",
            "Pengalaman ke luar negeri (untuk bekerja atau magang)",
            "Kemampuan bahasa inggris",
            "kemampuan bahasa asing lainnya",
            "Pengoperasian Komputer",
            "Pengalaman berorganisasi",
            "Rekomendasi dari pihak ketiga",
            "Kepribadian dari keterampilan interpersonal",
            "Lainnya"
        ];

        // Label Aspek
        $label_aspek = [
            "Gaji",
            "Kedekatan dengan rumah",
            "Tantangan pekerjaan",
            "Benefit (perumahan, transport, uang lembur)",
            "Kesempatan beasiswa",
            "Kesempatan pengembangan diri",
            "Lainnya"
        ];

        // Label kursus lulus
        $label_kursus_lulus = [
            "Pengoperasian Komputer",
            "Piranti lunak aplikasi (Accurate, MyOB, SAP, dll)",
            "Bahasa Inggris",
            "Bahasa Asing Lainnya",
            "Kepemimpinan",
            "Kewirausahaan",
            "Tidak Ada",
            "Lainnya"
        ];

        // Label Situasi
        $label_situasi = [
            "Saya masih belajar / melanjutkan profesi atau pasca sarjana",
            "Saya menikah",
            "Saya sibuk dengan keluarga dan anak-anak",
            "Saya sekarang sedang mencari pekerjaan",
            "Lainnya"
        ];

        // Label Jenis Perusahaan
        $label_jenis = [
            "Instansi Pemerintahan (Termasuk BUMN)",
            "Organisasi non-profit / lembaga swadaya masyarakat",
            "Perusahaan Swasta",
            "Wiraswasta / Perusahaan Sendiri",
            "Lainnya"
        ];

        // Tahun Ini
        for ($i = 0; $i < 13; $i++) {
            $melaluiM0[$i] = 0;
            $selainCDCM0[$i] = 0;
            $persepsiM0[$i] = 0;
            if ($i < 7) {
                $aspekM0[$i] = 0;
            }
            if ($i < 8) {
                $kursuslulus[$i] = 0;
            }
        }
        for ($i = 0; $i < 5; $i++) {
            $biayaM0[$i] = 0;
            //organisasi 
            $organisasiM0[$i] = 0;
            $perlukahM0[$i] = 0;
            $situasiM0[$i] = 0;
            $jenisM0[$i] = 0;
            $bahasa_asing_setelah_lulusM0[$i] = 0;
            $kontribusi_kampus_bahasa_asingM0[$i] = 0;
            $kaitan_studi_pekerjaanM0[$i] = 0;
            // kursus
            if ($i < 2) {
                $kursusM0[$i] = 0;
                $carikerjaM0[$i] = 0;
                $kapancariM0[$i] = 0;
                $kapan_pekerjaan_pertamaM0[$i] = 0;
                $melalui_cdcM0[$i] = 0;
            }
        }
        for ($i = 0; $i < 6; $i++) {
            $tinggalM0[$i] = 0;
        }

        // 1 Tahun Lalu
        for ($i = 0; $i < 13; $i++) {
            $melaluiM1[$i] = 0;
            $selainCDCM1[$i] = 0;
            $persepsiM1[$i] = 0;
            if ($i < 7) {
                $aspekM1[$i] = 0;
            }
            if ($i < 8) {
                $kursuslulusM1[$i] = 0;
            }
        }
        for ($i = 0; $i < 5; $i++) {
            $biayaM1[$i] = 0;
            //organisasi 
            $organisasiM1[$i] = 0;
            $perlukahM1[$i] = 0;
            $situasiM1[$i] = 0;
            $jenisM1[$i] = 0;
            $bahasa_asing_setelah_lulusM1[$i] = 0;
            $kontribusi_kampus_bahasa_asingM1[$i] = 0;
            $kaitan_studi_pekerjaanM1[$i] = 0;
            // kursus
            if ($i < 2) {
                $kursusM1[$i] = 0;
                $carikerjaM1[$i] = 0;
                $kapancariM1[$i] = 0;
                $kapan_pekerjaan_pertamaM1[$i] = 0;
                $melalui_cdcM1[$i] = 0;
            }
        }
        for ($i = 0; $i < 6; $i++) {
            $tinggalM1[$i] = 0;
        }
        
        // 2 Tahun Lalu
        for ($i = 0; $i < 13; $i++) {
            $melaluiM2[$i] = 0;
            $selainCDCM2[$i] = 0;
            $persepsiM2[$i] = 0;
            if ($i < 7) {
                $aspekM2[$i] = 0;
            }
            if ($i < 8) {
                $kursuslulusM2[$i] = 0;
            }
        }
        for ($i = 0; $i < 5; $i++) {
            $biayaM2[$i] = 0;
            //organisasi 
            $organisasiM2[$i] = 0;
            $perlukahM2[$i] = 0;
            $situasiM2[$i] = 0;
            $jenisM2[$i] = 0;
            $bahasa_asing_setelah_lulusM2[$i] = 0;
            $kontribusi_kampus_bahasa_asingM2[$i] = 0;
            $kaitan_studi_pekerjaanM2[$i] = 0;
            // kursus
            if ($i < 2) {
                $kursusM2[$i] = 0;
                $carikerjaM2[$i] = 0;
                $kapancariM2[$i] = 0;
                $kapan_pekerjaan_pertamaM2[$i] = 0;
                $melalui_cdcM2[$i] = 0;
            }
        }
        for ($i = 0; $i < 6; $i++) {
            $tinggalM2[$i] = 0;
        }

        // 3 Tahun Lalu
        for ($i = 0; $i < 13; $i++) {
            $melaluiM3[$i] = 0;
            $selainCDCM3[$i] = 0;
            $persepsiM3[$i] = 0;
            if ($i < 7) {
                $aspekM3[$i] = 0;
            }
            if ($i < 8) {
                $kursuslulusM3[$i] = 0;
            }
        }
        for ($i = 0; $i < 5; $i++) {
            $biayaM3[$i] = 0;
            //organisasi 
            $organisasiM3[$i] = 0;
            $perlukahM3[$i] = 0;
            $situasiM3[$i] = 0;
            $jenisM3[$i] = 0;
            $bahasa_asing_setelah_lulusM3[$i] = 0;
            $kontribusi_kampus_bahasa_asingM3[$i] = 0;
            $kaitan_studi_pekerjaanM3[$i] = 0;
            // kursus
            if ($i < 2) {
                $kursusM3[$i] = 0;
                $carikerjaM3[$i] = 0;
                $kapancariM3[$i] = 0;
                $kapan_pekerjaan_pertamaM3[$i] = 0;
                $melalui_cdcM3[$i] = 0;
            }
        }
        for ($i = 0; $i < 6; $i++) {
            $tinggalM3[$i] = 0;
        }

        // 4 Tahun Lalu
        for ($i = 0; $i < 13; $i++) {
            $melaluiM4[$i] = 0;
            $selainCDCM4[$i] = 0;
            $persepsiM4[$i] = 0;
            if ($i < 7) {
                $aspekM4[$i] = 0;
            }
            if ($i < 8) {
                $kursuslulusM4[$i] = 0;
            }
        }
        for ($i = 0; $i < 5; $i++) {
            $biayaM4[$i] = 0;
            //organisasi 
            $organisasiM4[$i] = 0;
            $perlukahM4[$i] = 0;
            $situasiM4[$i] = 0;
            $jenisM4[$i] = 0;
            $bahasa_asing_setelah_lulusM4[$i] = 0;
            $kontribusi_kampus_bahasa_asingM4[$i] = 0;
            $kaitan_studi_pekerjaanM4[$i] = 0;
            // kursus
            if ($i < 2) {
                $kursusM4[$i] = 0;
                $carikerjaM4[$i] = 0;
                $kapancariM4[$i] = 0;
                $kapan_pekerjaan_pertamaM4[$i] = 0;
                $melalui_cdcM4[$i] = 0;
            }
        }
        for ($i = 0; $i < 6; $i++) {
            $tinggalM4[$i] = 0;
        }

        // Sekarang
        foreach ($kuisioner as $k) {
            foreach ($tNow as $t) {
                if ($t['id_mahasiswa'] == $k['id_mahasiswa']) {
                    for ($i = 0; $i < 13; $i++) {
                        if (trim($k['melalui_pekerjaan_pertama']) == trim($label_13[$i])) {
                            $melaluiM0[$i] += 1;
                        }
                        $selainCDC = explode(',', $k['selain_cdc_2']);
                        for ($j = 0; $j < count($selainCDC); $j++) {
                            if (trim($selainCDC[$j]) == trim($label_13[$i])) {
                                $selainCDCM0[$i] += 1;
                            }
                        }
                        $persepsi = explode(',', $k['persepsi']);
                        for ($j = 0; $j < count($persepsi); $j++) {
                            if (trim($persepsi[$j]) == trim($label_persepsi[$i])) {
                                $persepsiM0[$i] += 1;
                            }
                        }
                        if ($i < 8) {
                            $kursus = explode(',', $k['kursus_setelah_lulus']);
                            for ($j = 0; $j < count($kursus); $j++) {
                                if (trim($kursus[$j]) == trim($label_kursus_lulus[$i])) {
                                    $kursuslulus[$i] += 1;
                                }
                            }
                        }
                        if ($i < 7) {
                            if ($k['aspek_pekerjaan_pertama'] == $label_aspek[$i]) {
                                $aspekM0[$i] += 1;
                            }
                        }
                        if ($i < 6) {
                            if ($k['tinggal'] == $label_tinggal[$i]) {
                                $tinggalM0[$i] += 1;
                            }
                        }
                        if ($i < 5) {
                            if ($k['biaya'] == $label_biaya[$i]) {
                                $biayaM0[$i] += 1;
                            }
                            if ($k['organisasi'] == $i + 1) {
                                $organisasiM0[$i] += 1;
                            }
                            if ($k['perlukah_kursus'] == $i + 1) {
                                $perlukahM0[$i] += 1;
                            }
                            if ($k['bahasa_asing_setelah_lulus'] == $i + 1) {
                                $bahasa_asing_setelah_lulusM0[$i] += 1;
                            }
                            if ($k['kontribusi_kampus_bahasa_asing'] == $i + 1) {
                                $kontribusi_kampus_bahasa_asingM0[$i] += 1;
                            }
                            if ($k['kaitan_studi_pekerjaan'] == $i + 1) {
                                $kaitan_studi_pekerjaanM0[$i] += 1;
                            }
                            $jenis = explode(',', $k['jenis_perusahaan_saat_ini']);
                            for ($j = 0; $j < count($jenis); $j++) {
                                if (trim($jenis[$j]) == trim($label_jenis[$i])) {
                                    $jenisM0[$i] += 1;
                                }
                            }
                            $situasi = explode(',', $k['situasi_setelah_lulus']);
                            for ($j = 0; $j < count($situasi); $j++) {
                                if (trim($situasi[$j]) == trim($label_situasi[$i])) {
                                    $situasiM0[$i] += 1;
                                }
                            }
                        }
                        if ($i < 2) {
                            if ($k['kursus'] == $i + 1) {
                                $kursusM0[$i] += 1;
                            }
                            if ($k['cari_kerja'] == $i + 1) {
                                $carikerjaM0[$i] += 1;
                            }
                            if ($k['kapancari'] == $i + 1) {
                                $kapancariM0[$i] += 1;
                            }
                            if ($k['melalui_cdc'] == $i + 1) {
                                $melalui_cdcM0[$i] += 1;
                            }
                            if ($k['kapan_pekerjaan_pertama'] == $i + 1) {
                                $kapan_pekerjaan_pertamaM0[$i] += 1;
                            }
                        }
                    }
                }
            }
        }

        // 1 Tahun Lalu
        foreach ($kuisioner as $k) {
            foreach ($tM1 as $t) {
                if ($t['id_mahasiswa'] == $k['id_mahasiswa']) {
                    for ($i = 0; $i < 13; $i++) {
                        if (trim($k['melalui_pekerjaan_pertama']) == trim($label_13[$i])) {
                            $melaluiM1[$i] += 1;
                        }
                        $selainCDC = explode(',', $k['selain_cdc_2']);
                        for ($j = 0; $j < count($selainCDC); $j++) {
                            if (trim($selainCDC[$j]) == trim($label_13[$i])) {
                                $selainCDCM1[$i] += 1;
                            }
                        }
                        $persepsi = explode(',', $k['persepsi']);
                        for ($j = 0; $j < count($persepsi); $j++) {
                            if (trim($persepsi[$j]) == trim($label_persepsi[$i])) {
                                $persepsiM1[$i] += 1;
                            }
                        }
                        if ($i < 8) {
                            $kursus = explode(',', $k['kursus_setelah_lulus']);
                            for ($j = 0; $j < count($kursus); $j++) {
                                if (trim($kursus[$j]) == trim($label_kursus_lulus[$i])) {
                                    $kursuslulusM1[$i] += 1;
                                }
                            }
                        }
                        if ($i < 7) {
                            if ($k['aspek_pekerjaan_pertama'] == $label_aspek[$i]) {
                                $aspekM1[$i] += 1;
                            }
                        }
                        if ($i < 6) {
                            if ($k['tinggal'] == $label_tinggal[$i]) {
                                $tinggalM1[$i] += 1;
                            }
                        }
                        if ($i < 5) {
                            if ($k['biaya'] == $label_biaya[$i]) {
                                $biayaM1[$i] += 1;
                            }
                            if ($k['organisasi'] == $i + 1) {
                                $organisasiM1[$i] += 1;
                            }
                            if ($k['perlukah_kursus'] == $i + 1) {
                                $perlukahM1[$i] += 1;
                            }
                            if ($k['bahasa_asing_setelah_lulus'] == $i + 1) {
                                $bahasa_asing_setelah_lulusM1[$i] += 1;
                            }
                            if ($k['kontribusi_kampus_bahasa_asing'] == $i + 1) {
                                $kontribusi_kampus_bahasa_asingM1[$i] += 1;
                            }
                            if ($k['kaitan_studi_pekerjaan'] == $i + 1) {
                                $kaitan_studi_pekerjaanM1[$i] += 1;
                            }
                            $jenis = explode(',', $k['jenis_perusahaan_saat_ini']);
                            for ($j = 0; $j < count($jenis); $j++) {
                                if (trim($jenis[$j]) == trim($label_jenis[$i])) {
                                    $jenisM1[$i] += 1;
                                }
                            }
                            $situasi = explode(',', $k['situasi_setelah_lulus']);
                            for ($j = 0; $j < count($situasi); $j++) {
                                if (trim($situasi[$j]) == trim($label_situasi[$i])) {
                                    $situasiM1[$i] += 1;
                                }
                            }
                        }
                        if ($i < 2) {
                            if ($k['kursus'] == $i + 1) {
                                $kursusM1[$i] += 1;
                            }
                            if ($k['cari_kerja'] == $i + 1) {
                                $carikerjaM1[$i] += 1;
                            }
                            if ($k['kapancari'] == $i + 1) {
                                $kapancariM1[$i] += 1;
                            }
                            if ($k['melalui_cdc'] == $i + 1) {
                                $melalui_cdcM1[$i] += 1;
                            }
                            if ($k['kapan_pekerjaan_pertama'] == $i + 1) {
                                $kapan_pekerjaan_pertamaM1[$i] += 1;
                            }
                        }
                    }
                }
            }
        }

        // 2 Tahun Lalu
        foreach ($kuisioner as $k) {
            foreach ($tM2 as $t) {
                if ($t['id_mahasiswa'] == $k['id_mahasiswa']) {
                    for ($i = 0; $i < 13; $i++) {
                        if (trim($k['melalui_pekerjaan_pertama']) == trim($label_13[$i])) {
                            $melaluiM2[$i] += 1;
                        }
                        $selainCDC = explode(',', $k['selain_cdc_2']);
                        for ($j = 0; $j < count($selainCDC); $j++) {
                            if (trim($selainCDC[$j]) == trim($label_13[$i])) {
                                $selainCDCM2[$i] += 1;
                            }
                        }
                        $persepsi = explode(',', $k['persepsi']);
                        for ($j = 0; $j < count($persepsi); $j++) {
                            if (trim($persepsi[$j]) == trim($label_persepsi[$i])) {
                                $persepsiM2[$i] += 1;
                            }
                        }
                        if ($i < 8) {
                            $kursus = explode(',', $k['kursus_setelah_lulus']);
                            for ($j = 0; $j < count($kursus); $j++) {
                                if (trim($kursus[$j]) == trim($label_kursus_lulus[$i])) {
                                    $kursuslulusM2[$i] += 1;
                                }
                            }
                        }
                        if ($i < 7) {
                            if ($k['aspek_pekerjaan_pertama'] == $label_aspek[$i]) {
                                $aspekM2[$i] += 1;
                            }
                        }
                        if ($i < 6) {
                            if ($k['tinggal'] == $label_tinggal[$i]) {
                                $tinggalM2[$i] += 1;
                            }
                        }
                        if ($i < 5) {
                            if ($k['biaya'] == $label_biaya[$i]) {
                                $biayaM2[$i] += 1;
                            }
                            if ($k['organisasi'] == $i + 1) {
                                $organisasiM2[$i] += 1;
                            }
                            if ($k['perlukah_kursus'] == $i + 1) {
                                $perlukahM2[$i] += 1;
                            }
                            if ($k['bahasa_asing_setelah_lulus'] == $i + 1) {
                                $bahasa_asing_setelah_lulusM2[$i] += 1;
                            }
                            if ($k['kontribusi_kampus_bahasa_asing'] == $i + 1) {
                                $kontribusi_kampus_bahasa_asingM2[$i] += 1;
                            }
                            if ($k['kaitan_studi_pekerjaan'] == $i + 1) {
                                $kaitan_studi_pekerjaanM2[$i] += 1;
                            }
                            $jenis = explode(',', $k['jenis_perusahaan_saat_ini']);
                            for ($j = 0; $j < count($jenis); $j++) {
                                if (trim($jenis[$j]) == trim($label_jenis[$i])) {
                                    $jenisM2[$i] += 1;
                                }
                            }
                            $situasi = explode(',', $k['situasi_setelah_lulus']);
                            for ($j = 0; $j < count($situasi); $j++) {
                                if (trim($situasi[$j]) == trim($label_situasi[$i])) {
                                    $situasiM2[$i] += 1;
                                }
                            }
                        }
                        if ($i < 2) {
                            if ($k['kursus'] == $i + 1) {
                                $kursusM2[$i] += 1;
                            }
                            if ($k['cari_kerja'] == $i + 1) {
                                $carikerjaM2[$i] += 1;
                            }
                            if ($k['kapancari'] == $i + 1) {
                                $kapancariM2[$i] += 1;
                            }
                            if ($k['melalui_cdc'] == $i + 1) {
                                $melalui_cdcM2[$i] += 1;
                            }
                            if ($k['kapan_pekerjaan_pertama'] == $i + 1) {
                                $kapan_pekerjaan_pertamaM2[$i] += 1;
                            }
                        }
                    }
                }
            }
        }

        // 3 Tahun Lalu
        foreach ($kuisioner as $k) {
            foreach ($tM3 as $t) {
                if ($t['id_mahasiswa'] == $k['id_mahasiswa']) {
                    for ($i = 0; $i < 13; $i++) {
                        if (trim($k['melalui_pekerjaan_pertama']) == trim($label_13[$i])) {
                            $melaluiM3[$i] += 1;
                        }
                        $selainCDC = explode(',', $k['selain_cdc_2']);
                        for ($j = 0; $j < count($selainCDC); $j++) {
                            if (trim($selainCDC[$j]) == trim($label_13[$i])) {
                                $selainCDCM3[$i] += 1;
                            }
                        }
                        $persepsi = explode(',', $k['persepsi']);
                        for ($j = 0; $j < count($persepsi); $j++) {
                            if (trim($persepsi[$j]) == trim($label_persepsi[$i])) {
                                $persepsiM3[$i] += 1;
                            }
                        }
                        if ($i < 8) {
                            $kursus = explode(',', $k['kursus_setelah_lulus']);
                            for ($j = 0; $j < count($kursus); $j++) {
                                if (trim($kursus[$j]) == trim($label_kursus_lulus[$i])) {
                                    $kursuslulusM3[$i] += 1;
                                }
                            }
                        }
                        if ($i < 7) {
                            if ($k['aspek_pekerjaan_pertama'] == $label_aspek[$i]) {
                                $aspekM3[$i] += 1;
                            }
                        }
                        if ($i < 6) {
                            if ($k['tinggal'] == $label_tinggal[$i]) {
                                $tinggalM3[$i] += 1;
                            }
                        }
                        if ($i < 5) {
                            if ($k['biaya'] == $label_biaya[$i]) {
                                $biayaM3[$i] += 1;
                            }
                            if ($k['organisasi'] == $i + 1) {
                                $organisasiM3[$i] += 1;
                            }
                            if ($k['perlukah_kursus'] == $i + 1) {
                                $perlukahM3[$i] += 1;
                            }
                            if ($k['bahasa_asing_setelah_lulus'] == $i + 1) {
                                $bahasa_asing_setelah_lulusM3[$i] += 1;
                            }
                            if ($k['kontribusi_kampus_bahasa_asing'] == $i + 1) {
                                $kontribusi_kampus_bahasa_asingM3[$i] += 1;
                            }
                            if ($k['kaitan_studi_pekerjaan'] == $i + 1) {
                                $kaitan_studi_pekerjaanM3[$i] += 1;
                            }
                            $jenis = explode(',', $k['jenis_perusahaan_saat_ini']);
                            for ($j = 0; $j < count($jenis); $j++) {
                                if (trim($jenis[$j]) == trim($label_jenis[$i])) {
                                    $jenisM3[$i] += 1;
                                }
                            }
                            $situasi = explode(',', $k['situasi_setelah_lulus']);
                            for ($j = 0; $j < count($situasi); $j++) {
                                if (trim($situasi[$j]) == trim($label_situasi[$i])) {
                                    $situasiM3[$i] += 1;
                                }
                            }
                        }
                        if ($i < 2) {
                            if ($k['kursus'] == $i + 1) {
                                $kursusM3[$i] += 1;
                            }
                            if ($k['cari_kerja'] == $i + 1) {
                                $carikerjaM3[$i] += 1;
                            }
                            if ($k['kapancari'] == $i + 1) {
                                $kapancariM3[$i] += 1;
                            }
                            if ($k['melalui_cdc'] == $i + 1) {
                                $melalui_cdcM3[$i] += 1;
                            }
                            if ($k['kapan_pekerjaan_pertama'] == $i + 1) {
                                $kapan_pekerjaan_pertamaM3[$i] += 1;
                            }
                        }
                    }
                }
            }
        }
        // 3 Tahun Lalu
        foreach ($kuisioner as $k) {
            foreach ($tM4 as $t) {
                if ($t['id_mahasiswa'] == $k['id_mahasiswa']) {
                    for ($i = 0; $i < 13; $i++) {
                        if (trim($k['melalui_pekerjaan_pertama']) == trim($label_13[$i])) {
                            $melaluiM4[$i] += 1;
                        }
                        $selainCDC = explode(',', $k['selain_cdc_2']);
                        for ($j = 0; $j < count($selainCDC); $j++) {
                            if (trim($selainCDC[$j]) == trim($label_13[$i])) {
                                $selainCDCM4[$i] += 1;
                            }
                        }
                        $persepsi = explode(',', $k['persepsi']);
                        for ($j = 0; $j < count($persepsi); $j++) {
                            if (trim($persepsi[$j]) == trim($label_persepsi[$i])) {
                                $persepsiM4[$i] += 1;
                            }
                        }
                        if ($i < 8) {
                            $kursus = explode(',', $k['kursus_setelah_lulus']);
                            for ($j = 0; $j < count($kursus); $j++) {
                                if (trim($kursus[$j]) == trim($label_kursus_lulus[$i])) {
                                    $kursuslulusM4[$i] += 1;
                                }
                            }
                        }
                        if ($i < 7) {
                            if ($k['aspek_pekerjaan_pertama'] == $label_aspek[$i]) {
                                $aspekM4[$i] += 1;
                            }
                        }
                        if ($i < 6) {
                            if ($k['tinggal'] == $label_tinggal[$i]) {
                                $tinggalM4[$i] += 1;
                            }
                        }
                        if ($i < 5) {
                            if ($k['biaya'] == $label_biaya[$i]) {
                                $biayaM4[$i] += 1;
                            }
                            if ($k['organisasi'] == $i + 1) {
                                $organisasiM4[$i] += 1;
                            }
                            if ($k['perlukah_kursus'] == $i + 1) {
                                $perlukahM4[$i] += 1;
                            }
                            if ($k['bahasa_asing_setelah_lulus'] == $i + 1) {
                                $bahasa_asing_setelah_lulusM4[$i] += 1;
                            }
                            if ($k['kontribusi_kampus_bahasa_asing'] == $i + 1) {
                                $kontribusi_kampus_bahasa_asingM4[$i] += 1;
                            }
                            if ($k['kaitan_studi_pekerjaan'] == $i + 1) {
                                $kaitan_studi_pekerjaanM4[$i] += 1;
                            }
                            $jenis = explode(',', $k['jenis_perusahaan_saat_ini']);
                            for ($j = 0; $j < count($jenis); $j++) {
                                if (trim($jenis[$j]) == trim($label_jenis[$i])) {
                                    $jenisM4[$i] += 1;
                                }
                            }
                            $situasi = explode(',', $k['situasi_setelah_lulus']);
                            for ($j = 0; $j < count($situasi); $j++) {
                                if (trim($situasi[$j]) == trim($label_situasi[$i])) {
                                    $situasiM4[$i] += 1;
                                }
                            }
                        }
                        if ($i < 2) {
                            if ($k['kursus'] == $i + 1) {
                                $kursusM4[$i] += 1;
                            }
                            if ($k['cari_kerja'] == $i + 1) {
                                $carikerjaM4[$i] += 1;
                            }
                            if ($k['kapancari'] == $i + 1) {
                                $kapancariM4[$i] += 1;
                            }
                            if ($k['melalui_cdc'] == $i + 1) {
                                $melalui_cdcM4[$i] += 1;
                            }
                            if ($k['kapan_pekerjaan_pertama'] == $i + 1) {
                                $kapan_pekerjaan_pertamaM4[$i] += 1;
                            }
                        }
                    }
                }
            }
        }

        // Data
        // Tinggal
        $data['tinggal']['now'] = [];
        $data['tinggal']['m1'] = [];
        $data['tinggal']['m2'] = [];
        $data['tinggal']['m3'] = [];
        $data['tinggal']['m4'] = [];

        // Biaya
        $data['biaya']['now'] = [];
        $data['biaya']['m1'] = [];
        $data['biaya']['m2'] = [];
        $data['biaya']['m3'] = [];
        $data['biaya']['m4'] = [];

        // Organisasi
        $data['organisasi']['now'] = [];
        $data['organisasi']['m1'] = [];
        $data['organisasi']['m2'] = [];
        $data['organisasi']['m3'] = [];
        $data['organisasi']['m4'] = [];

        // Organisasi
        $data['kursus']['now'] = [];
        $data['kursus']['m1'] = [];
        $data['kursus']['m2'] = [];
        $data['kursus']['m3'] = [];
        $data['kursus']['m4'] = [];

        // Cari Kerja
        $data['cari_kerja']['now'] = [];
        $data['cari_kerja']['m1'] = [];
        $data['cari_kerja']['m2'] = [];
        $data['cari_kerja']['m3'] = [];
        $data['cari_kerja']['m4'] = [];

        // Kapan Cari
        $data['kapancari']['now'] = [];
        $data['kapancari']['m1'] = [];
        $data['kapancari']['m2'] = [];
        $data['kapancari']['m3'] = [];
        $data['kapancari']['m4'] = [];

        // CDC
        $data['melalui_cdc']['now'] = [];
        $data['melalui_cdc']['m1'] = [];
        $data['melalui_cdc']['m2'] = [];
        $data['melalui_cdc']['m3'] = [];
        $data['melalui_cdc']['m4'] = [];

        // Selain CDC
        $data['selain_cdc']['now'] = [];
        $data['selain_cdc']['m1'] = [];
        $data['selain_cdc']['m2'] = [];
        $data['selain_cdc']['m3'] = [];
        $data['selain_cdc']['m4'] = [];

        // Persepsi
        $data['persepsi']['now'] = [];
        $data['persepsi']['m1'] = [];
        $data['persepsi']['m2'] = [];
        $data['persepsi']['m3'] = [];
        $data['persepsi']['m4'] = [];

        // kapan_pekerjaan_pertama
        $data['kapan_pekerjaan_pertama']['now'] = [];
        $data['kapan_pekerjaan_pertama']['m1'] = [];
        $data['kapan_pekerjaan_pertama']['m2'] = [];
        $data['kapan_pekerjaan_pertama']['m3'] = [];
        $data['kapan_pekerjaan_pertama']['m4'] = [];

        // kapan_pekerjaan_pertama
        $data['melalui_pekerjaan_pertama']['now'] = [];
        $data['melalui_pekerjaan_pertama']['m1'] = [];
        $data['melalui_pekerjaan_pertama']['m2'] = [];
        $data['melalui_pekerjaan_pertama']['m3'] = [];
        $data['melalui_pekerjaan_pertama']['m4'] = [];

        // aspek_pekerjaan_pertama
        $data['aspek_pekerjaan_pertama']['now'] = [];
        $data['aspek_pekerjaan_pertama']['m1'] = [];
        $data['aspek_pekerjaan_pertama']['m2'] = [];
        $data['aspek_pekerjaan_pertama']['m3'] = [];
        $data['aspek_pekerjaan_pertama']['m4'] = [];

        // kursus_setelah_lulus
        $data['kursus_setelah_lulus']['now'] = [];
        $data['kursus_setelah_lulus']['m1'] = [];
        $data['kursus_setelah_lulus']['m2'] = [];
        $data['kursus_setelah_lulus']['m3'] = [];
        $data['kursus_setelah_lulus']['m4'] = [];

        // perlukah_kursus
        $data['perlukah_kursus']['now'] = [];
        $data['perlukah_kursus']['m1'] = [];
        $data['perlukah_kursus']['m2'] = [];
        $data['perlukah_kursus']['m3'] = [];
        $data['perlukah_kursus']['m4'] = [];
        
        // situasi_setelah_lulus
        $data['situasi_setelah_lulus']['now'] = [];
        $data['situasi_setelah_lulus']['m1'] = [];
        $data['situasi_setelah_lulus']['m2'] = [];
        $data['situasi_setelah_lulus']['m3'] = [];
        $data['situasi_setelah_lulus']['m4'] = [];
        
        // perlukah_kursus
        $data['jenis_perusahaan_saat_ini']['now'] = [];
        $data['jenis_perusahaan_saat_ini']['m1'] = [];
        $data['jenis_perusahaan_saat_ini']['m2'] = [];
        $data['jenis_perusahaan_saat_ini']['m3'] = [];
        $data['jenis_perusahaan_saat_ini']['m4'] = [];

        // bahasa_asing_setelah_lulus
        $data['bahasa_asing_setelah_lulus']['now'] = [];
        $data['bahasa_asing_setelah_lulus']['m1'] = [];
        $data['bahasa_asing_setelah_lulus']['m2'] = [];
        $data['bahasa_asing_setelah_lulus']['m3'] = [];
        $data['bahasa_asing_setelah_lulus']['m4'] = [];
       
        // kontribusi_kampus_bahasa_asing
        $data['kontribusi_kampus_bahasa_asing']['now'] = [];
        $data['kontribusi_kampus_bahasa_asing']['m1'] = [];
        $data['kontribusi_kampus_bahasa_asing']['m2'] = [];
        $data['kontribusi_kampus_bahasa_asing']['m3'] = [];
        $data['kontribusi_kampus_bahasa_asing']['m4'] = [];
        
        // kaitan_studi_pekerjaan
        $data['kaitan_studi_pekerjaan']['now'] = [];
        $data['kaitan_studi_pekerjaan']['m1'] = [];
        $data['kaitan_studi_pekerjaan']['m2'] = [];
        $data['kaitan_studi_pekerjaan']['m3'] = [];
        $data['kaitan_studi_pekerjaan']['m4'] = [];


        for ($i = 0; $i < 13; $i++) {
            if ($i < 8) {
                array_push($data['kursus_setelah_lulus']['now'], $kursuslulus[$i]);
                array_push($data['kursus_setelah_lulus']['m1'], $kursuslulusM1[$i]);
                array_push($data['kursus_setelah_lulus']['m2'], $kursuslulusM2[$i]);
                array_push($data['kursus_setelah_lulus']['m3'], $kursuslulusM3[$i]);
                array_push($data['kursus_setelah_lulus']['m4'], $kursuslulusM4[$i]);
            }
            if ($i < 7) {
                array_push($data['aspek_pekerjaan_pertama']['now'], $aspekM0[$i]);
                array_push($data['aspek_pekerjaan_pertama']['m1'], $aspekM1[$i]);
                array_push($data['aspek_pekerjaan_pertama']['m2'], $aspekM2[$i]);
                array_push($data['aspek_pekerjaan_pertama']['m3'], $aspekM3[$i]);
                array_push($data['aspek_pekerjaan_pertama']['m4'], $aspekM4[$i]);
            }
            if ($i < 6) {
                array_push($data['tinggal']['now'], $tinggalM0[$i]);
                array_push($data['tinggal']['m1'], $tinggalM1[$i]);
                array_push($data['tinggal']['m2'], $tinggalM2[$i]);
                array_push($data['tinggal']['m3'], $tinggalM3[$i]);
                array_push($data['tinggal']['m4'], $tinggalM4[$i]);
            }
            if ($i < 5) {
                // Biaya
                array_push($data['biaya']['now'], $biayaM0[$i]);
                array_push($data['biaya']['m1'], $biayaM1[$i]);
                array_push($data['biaya']['m2'], $biayaM2[$i]);
                array_push($data['biaya']['m3'], $biayaM3[$i]);
                array_push($data['biaya']['m4'], $biayaM4[$i]);

                // Organisasi
                array_push($data['organisasi']['now'], $organisasiM0[$i]);
                array_push($data['organisasi']['m1'], $organisasiM1[$i]);
                array_push($data['organisasi']['m2'], $organisasiM2[$i]);
                array_push($data['organisasi']['m3'], $organisasiM3[$i]);
                array_push($data['organisasi']['m4'], $organisasiM4[$i]);

                // perlukah_kursus
                array_push($data['perlukah_kursus']['now'], $perlukahM0[$i]);
                array_push($data['perlukah_kursus']['m1'], $perlukahM1[$i]);
                array_push($data['perlukah_kursus']['m2'], $perlukahM2[$i]);
                array_push($data['perlukah_kursus']['m3'], $perlukahM3[$i]);
                array_push($data['perlukah_kursus']['m4'], $perlukahM4[$i]);

                // situasi_setelah_lulus
                array_push($data['situasi_setelah_lulus']['now'], $situasiM0[$i]);
                array_push($data['situasi_setelah_lulus']['m1'], $situasiM1[$i]);
                array_push($data['situasi_setelah_lulus']['m2'], $situasiM2[$i]);
                array_push($data['situasi_setelah_lulus']['m3'], $situasiM3[$i]);
                array_push($data['situasi_setelah_lulus']['m4'], $situasiM4[$i]);
                
                // jenis_perusahaan_saat_ini
                array_push($data['jenis_perusahaan_saat_ini']['now'], $jenisM0[$i]);
                array_push($data['jenis_perusahaan_saat_ini']['m1'], $jenisM1[$i]);
                array_push($data['jenis_perusahaan_saat_ini']['m2'], $jenisM2[$i]);
                array_push($data['jenis_perusahaan_saat_ini']['m3'], $jenisM3[$i]);
                array_push($data['jenis_perusahaan_saat_ini']['m4'], $jenisM4[$i]);
                
                // bahasa_asing_setelah_lulus
                array_push($data['bahasa_asing_setelah_lulus']['now'], $bahasa_asing_setelah_lulusM0[$i]);
                array_push($data['bahasa_asing_setelah_lulus']['m1'], $bahasa_asing_setelah_lulusM1[$i]);
                array_push($data['bahasa_asing_setelah_lulus']['m2'], $bahasa_asing_setelah_lulusM2[$i]);
                array_push($data['bahasa_asing_setelah_lulus']['m3'], $bahasa_asing_setelah_lulusM3[$i]);
                array_push($data['bahasa_asing_setelah_lulus']['m4'], $bahasa_asing_setelah_lulusM4[$i]);
                
                // kontribusi_kampus_bahasa_asing
                array_push($data['kontribusi_kampus_bahasa_asing']['now'], $kontribusi_kampus_bahasa_asingM0[$i]);
                array_push($data['kontribusi_kampus_bahasa_asing']['m1'], $kontribusi_kampus_bahasa_asingM1[$i]);
                array_push($data['kontribusi_kampus_bahasa_asing']['m2'], $kontribusi_kampus_bahasa_asingM2[$i]);
                array_push($data['kontribusi_kampus_bahasa_asing']['m3'], $kontribusi_kampus_bahasa_asingM3[$i]);
                array_push($data['kontribusi_kampus_bahasa_asing']['m4'], $kontribusi_kampus_bahasa_asingM4[$i]);
                
                // kaitan_studi_pekerjaan
                array_push($data['kaitan_studi_pekerjaan']['now'], $kaitan_studi_pekerjaanM0[$i]);
                array_push($data['kaitan_studi_pekerjaan']['m1'], $kaitan_studi_pekerjaanM1[$i]);
                array_push($data['kaitan_studi_pekerjaan']['m2'], $kaitan_studi_pekerjaanM2[$i]);
                array_push($data['kaitan_studi_pekerjaan']['m3'], $kaitan_studi_pekerjaanM3[$i]);
                array_push($data['kaitan_studi_pekerjaan']['m4'], $kaitan_studi_pekerjaanM4[$i]);
            }
            if ($i < 2) {
                // Kursus
                array_push($data['kursus']['now'], $kursusM0[$i]);
                array_push($data['kursus']['m1'], $kursusM1[$i]);
                array_push($data['kursus']['m2'], $kursusM2[$i]);
                array_push($data['kursus']['m3'], $kursusM3[$i]);
                array_push($data['kursus']['m4'], $kursusM4[$i]);

                // Cari Kerja
                array_push($data['cari_kerja']['now'], $carikerjaM0[$i]);
                array_push($data['cari_kerja']['m1'], $carikerjaM1[$i]);
                array_push($data['cari_kerja']['m2'], $carikerjaM2[$i]);
                array_push($data['cari_kerja']['m3'], $carikerjaM3[$i]);
                array_push($data['cari_kerja']['m4'], $carikerjaM4[$i]);

                // Kapan Cari
                array_push($data['kapancari']['now'], $kapancariM0[$i]);
                array_push($data['kapancari']['m1'], $kapancariM1[$i]);
                array_push($data['kapancari']['m2'], $kapancariM2[$i]);
                array_push($data['kapancari']['m3'], $kapancariM3[$i]);
                array_push($data['kapancari']['m4'], $kapancariM4[$i]);

                // Melalui CDC
                array_push($data['melalui_cdc']['now'], $kapancariM0[$i]);
                array_push($data['melalui_cdc']['m1'], $kapancariM1[$i]);
                array_push($data['melalui_cdc']['m2'], $kapancariM2[$i]);
                array_push($data['melalui_cdc']['m3'], $kapancariM3[$i]);
                array_push($data['melalui_cdc']['m4'], $kapancariM4[$i]);

                // kapan_pekerjaan_pertama
                array_push($data['kapan_pekerjaan_pertama']['now'], $kapan_pekerjaan_pertamaM0[$i]);
                array_push($data['kapan_pekerjaan_pertama']['m1'], $kapan_pekerjaan_pertamaM1[$i]);
                array_push($data['kapan_pekerjaan_pertama']['m2'], $kapan_pekerjaan_pertamaM2[$i]);
                array_push($data['kapan_pekerjaan_pertama']['m3'], $kapan_pekerjaan_pertamaM3[$i]);
                array_push($data['kapan_pekerjaan_pertama']['m4'], $kapan_pekerjaan_pertamaM4[$i]);
            }
            // Selain CDC
            array_push($data['selain_cdc']['now'], $selainCDCM0[$i]);
            array_push($data['selain_cdc']['m1'], $selainCDCM1[$i]);
            array_push($data['selain_cdc']['m2'], $selainCDCM2[$i]);
            array_push($data['selain_cdc']['m3'], $selainCDCM3[$i]);
            array_push($data['selain_cdc']['m4'], $selainCDCM4[$i]);

            // Persepsi
            array_push($data['persepsi']['now'], $persepsiM0[$i]);
            array_push($data['persepsi']['m1'], $persepsiM1[$i]);
            array_push($data['persepsi']['m2'], $persepsiM2[$i]);
            array_push($data['persepsi']['m3'], $persepsiM3[$i]);
            array_push($data['persepsi']['m4'], $persepsiM4[$i]);

            // melalui_pekerjaan_pertama
            array_push($data['melalui_pekerjaan_pertama']['now'], $melaluiM0[$i]);
            array_push($data['melalui_pekerjaan_pertama']['m1'], $melaluiM1[$i]);
            array_push($data['melalui_pekerjaan_pertama']['m2'], $melaluiM2[$i]);
            array_push($data['melalui_pekerjaan_pertama']['m3'], $melaluiM3[$i]);
            array_push($data['melalui_pekerjaan_pertama']['m4'], $melaluiM4[$i]);
        }

        return $data;
    }
}

/* End of file Model_app.php */
