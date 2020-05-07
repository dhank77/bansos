<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Penerima extends Model
{
    protected $table = "t_penerima";
 
    protected $fillable = ['IDARTBDT', 'IDBDT', 'KD_PROV', 'KD_KAB', 'KD_KEC', 'KD_KEL', 'PROVINSI', 'KABUPATEN', 'KECAMATAN', 'DESA_KELURAHAN', 'ALAMAT', 'NAMA_SLS', 'NAMA', 'JENIS_KELAMIN', 'TEMPAT_LAHIR', 'TANGGAL_LAHIR', 'USIA', 'NIK', 'NO_KK', 'JUMLAH_ART', 'PERSENTIL'];
}