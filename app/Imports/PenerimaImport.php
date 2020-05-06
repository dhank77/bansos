<?php

namespace App\Imports;

use App\Penerima;
use Maatwebsite\Excel\Concerns\ToModel;

class PenerimaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Penerima([
            'IDARTBDT'          => $row[1],
            'IDBDT'             => $row[2], 
            'KD_PROV'           => $row[3], 
            'KD_KAB'            => $row[4], 
            'KD_KEC'            => $row[5], 
            'KD_KEL'            => $row[6], 
            'PROVINSI'          => $row[7], 
            'KABUPATEN'         => $row[8], 
            'KECAMATAN'         => $row[9], 
            'DESA_KELURAHAN'    => $row[10], 
            'ALAMAT'            => $row[11], 
            'NAMA_SLS'          => $row[12], 
            'NAMA'              => $row[13], 
            'JENIS_KELAMIN'     => $row[14], 
            'TEMPAT_LAHIR'      => $row[15], 
            'TANGGAL_LAHIR'     => $row[16], 
            'USIA'              => $row[17], 
            'NIK'               => $row[18], 
            'NO_KK'             => $row[19], 
            'JUMLAH_ART'        => $row[20], 
            'PERSENTIL'         => $row[21]
        ]);
    }

    public function startRow(): int 
    {
         return 1;
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
