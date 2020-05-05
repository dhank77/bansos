<?php
error_reporting(0);

function dd($data){
    highlight_string("<?php\n " . var_export($data, true) . "?>");
    echo '<script>document.getElementsByTagName("code")[0].getElementsByTagName("span")[1].remove() ;document.getElementsByTagName("code")[0].getElementsByTagName("span")[document.getElementsByTagName("code")[0].getElementsByTagName("span").length - 1].remove() ; </script>';
    die();
  }


function materialName($id)
{
    $ci = &get_instance();
    return $ci->db->get_where('material', ['id_material' => $id])->row()->nama_material;
}

function cek_pengiriman($id)
{
    $ci = &get_instance();
    $data = $ci->db->get_where('pengiriman', ['id_permintaan' => $id])->num_rows();
    if ($data > 0) {
        return true;
    } else {
        return false;
    }
}

function bandingkan_stok_to_pengiriman($id)
{
    $ci = &get_instance();
    $pengirman = $ci->db->get_where('permintaan', ['id_permintaan' => $id])->row_array();
    $material = explode('~', $pengirman['id_material']);
    $jumlah_approve = explode('~', $pengirman['jumlah_approved']);
    for ($i = 0; $i < count($material); $i++) {
        $stok = $ci->DB->view_where('stok', ['id_kantor' => $ci->session->userdata('id'), 'id_material' => $material[$i]])->row_array();
        if ($stok['jumlah'] < $jumlah_approve[$i]) {
            return false;
        }
    }
    return true;
}

function slug($text)
{
    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
    $text = trim($text, '-');
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = strtolower($text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    if (empty($text)) {
        return 'n-a';
    }
    return $text;
}

function description()
{
    $ci = &get_instance();
    $title = $ci->db->query("SELECT meta_deskripsi FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
    return $title['meta_deskripsi'];
}

function keywords()
{
    $ci = &get_instance();
    $title = $ci->db->query("SELECT meta_keyword FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
    return $title['meta_keyword'];
}

function filter($str)
{
    return strip_tags(htmlentities($str, ENT_QUOTES, 'UTF-8'));
}

function umur($date)
{
    $tanggal = new DateTime($date);
    $today = new DateTime('today');
    $y = $today->diff($tanggal)->y;
    // $m = $today->diff($tanggal)->m;
    return $y . " tahun ";
}

function acakangkahuruf($panjang)
{
    $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
        $pos = rand(0, strlen($karakter) - 1);
        $string .= $karakter[$pos];
    }
    return $string;
}

function rupiah($total)
{
    return number_format($total, 0, ',', '.');
}

function tgl_indo($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulanbaru(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

function tgl_indo_time($timestamp)
{
    $tgl = date('M-d-y', $timestamp);
    dd($tgl);
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

function tgl_simpan($tgl)
{
    $tanggal = substr($tgl, 0, 2);
    $bulan = substr($tgl, 3, 2);
    $tahun = substr($tgl, 6, 4);
    return $tahun . '-' . $bulan . '-' . $tanggal;
}

function tgl_view($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = substr($tgl, 5, 2);
    $tahun = substr($tgl, 0, 4);
    return $tanggal . '-' . $bulan . '-' . $tahun;
}

function tgl_grafik($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . '_' . $bulan;
}

function generateRandomString($length = 10)
{
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

function seo_title($s)
{
    $c = array(' ');
    $d = array('-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '–');
    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
    $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
    return $s;
}

function hari_ini($date)
{
    $w = date('w', strtotime($date));
    $seminggu = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
    $hari_ini = $seminggu[$w];
    return $hari_ini;
}

function tgl_indoo($tgl)
{
    $bulan = getBulanbaru(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $bulan . ' ' . $tahun;
}

function tgl_indoos($tgl)
{
    $bulan = substr($tgl, 0, 2);
    $tahun = substr($tgl, 3, 4);
    return $tahun . '-' . $bulan;
}

function tgl_indoose($tgl)
{
    $bulan = substr($tgl, 5, 2);
    $tahun = substr($tgl, 0, 4);
    return $bulan . '-' . $tahun;
}

function getBulanbaru($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}

function getBulan($bln)
{
    switch ($bln) {
        case 1:
            return "Jan";
            break;
        case 2:
            return "Feb";
            break;
        case 3:
            return "Mar";
            break;
        case 4:
            return "Apr";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Jun";
            break;
        case 7:
            return "Jul";
            break;
        case 8:
            return "Agu";
            break;
        case 9:
            return "Sep";
            break;
        case 10:
            return "Okt";
            break;
        case 11:
            return "Nov";
            break;
        case 12:
            return "Des";
            break;
    }
}
function getStatus($id)
{
    switch ($id) {
        case 1:
            return '<span class="badge badge-warning badge-pill">Created</span>';
            break;
        case 2:
            return '<span class="badge badge-success badge-pill">Accepted</span>';
            break;
        case 3:
            return '<span class="badge badge-danger badge-pill">Declined</span>';
            break;
    }
}

function getStatusPenyaluran($id)
{
    switch ($id) {
        case 1:
            return '<span class="badge badge-info badge-pill">Approved</span>';
            break;
        case 2:
            return '<span class="badge badge-success badge-pill">Done</span>';
            break;
        case 3:
            return '<span class="badge badge-danger badge-pill">Lost</span>';
            break;
    }
}

function getStatusKirim($id)
{
    switch ($id) {
        case 1:
            return '<span class="badge badge-warning badge-pill">Proses</span>';
            break;
        case 2:
            return '<span class="badge badge-success badge-pill">Diterima</span>';
            break;
    }
}

function getVia($id)
{
    switch ($id) {
        case 1:
            return ' <span class="badge badge-info badge-pill" > <i class="fa fa-truck"></i> Darat</span>';
            break;
        case 2:
            return '<span class="badge badge-info badge-pill"> <i class="fa fa-ship" aria-hidden="true"></i> Laut</span>';
            break;
        case 3:
            return '<span class="badge badge-info badge-pill"> <i class="fa fa-plane"> </i> Udara</span>';
            break;
    }
}

function cutterArray($array, $jumlah)
{
    $arr = explode('~', $array);
    $jum = explode('~', $jumlah);
    $data = '';
    for ($i = 0; $i < count($arr); $i++) {
        $data .= '<p class="text-muted mb-0">' . materialName($arr[$i]) . ' - ' . $jum[$i] . " " .  getSatuan($arr[$i]) . '</p>';
    }
    return $data;
}

function getNameKantor($id)
{
    $ci = &get_instance();
    $data = $ci->db->get_where('administrator', ['id' => $id])->row();
    if ($data) {
        return $data->nama_kantor;
    } else {
        return "-";
    }
}

function getNameMaterial($id)
{
    $ci = &get_instance();
    $data = $ci->db->get_where('material', ['id_material' => $id])->row();
    if ($data) {
        return $data->nama_material;
    } else {
        return "-";
    }
}

function getSatuan($id)
{
    $ci = &get_instance();
    $data = $ci->db->get_where('material', ['id_material' => $id])->row();
    if ($data) {
        return $data->satuan_material;
    } else {
        return "-";
    }
}

function getNameKategori($id)
{
    $ci = &get_instance();
    $data = $ci->db->get_where('kategori_material', ['id' => $id])->row();
    if ($data) {
        return $data->nama;
    } else {
        return "-";
    }
}

function getListMaterial($id){
    $ci = &get_instance();
    $data = $ci->db->get_where('material', ['id_kategori' => $id])->result_array();
    if($data){
        return $data;
    }
}

function wordlimit($text, $limit = 180)
{
    if (strlen($text) > $limit)
        $word = mb_substr($text, 0, $limit - 3) . "...";
    else
        $word = $text;
    return $word;
}

function login_check()
{
    $ci = &get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    }
}

function kanpus_only()
{
    $ci = &get_instance();
    if ($ci->session->userdata('status') != 1) {
        redirect('auth');
    }
}

function getUserIP()
{
    //check ip from share internet
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //to check ip is pass from proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
