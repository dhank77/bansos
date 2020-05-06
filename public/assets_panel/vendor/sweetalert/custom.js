function alertDelete($id, $name, $msg, $table) {
    swal.fire({
        title: 'Apakah anda yakin ?',
        html: "Semua data yang terkait "+$msg+" <strong>"+$name+"</strong> akan ikut terhapus.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya, hapus sekarang',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            window.location = $table+'/'+$id+'/delete';
        }
    });
}

function alertDeletePost($id, $name, $msg) {
    swal.fire({
        title: 'Apakah anda yakin ?',
        html: "Semua data yang terkait "+$msg+" <strong>"+$name+"</strong> akan ikut terhapus.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya, hapus sekarang',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            window.location = $id+'/delete';
        }
    });
}

function alertDeletePostAgenda($id, $name, $msg) {
    swal.fire({
        title: 'Apakah anda yakin ?',
        html: "Semua data yang terkait "+$msg+" <strong>"+$name+"</strong> akan ikut terhapus.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya, hapus sekarang',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            window.location = 'agenda/'+ $id +'/delete';
        }
    });
}

function alertDeletePostDownload($id, $name, $msg) {
    swal.fire({
        title: 'Apakah anda yakin ?',
        html: "Semua data yang terkait "+$msg+" <strong>"+$name+"</strong> akan ikut terhapus.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya, hapus sekarang',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            window.location = 'download/'+ $id +'/delete';
        }
    });
}

function alertResetPassword($id, $name, $table) {
    swal.fire({
        title: 'Apakah anda yakin ?',
        html: "Anda akan mereset password user <strong>"+$name+"</strong>. Setelah reset, password sama dengan username.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya, reset sekarang',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            window.location = $table+'/'+$id+'/reset';
        }
    });
}
  
function alertSuccess($msg) {
    swal.fire("Sukses!", $msg, "success");
}

function alertProses($id) {
    swal.fire({
        title: 'Apakah anda yakin ?',
        html: "Ubah status dari <strong> Belum diproses </strong> menjadi  <strong> Sudah diproses </strong>",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            window.location = 'laporan/'+$id+'/proses';
        }
    });
}

function alertDeleteBeritaHoax($id, $judul) {
    swal.fire({
        title: 'Apakah anda yakin ?',
        html: "Semua Data Terkait <strong>"+$judul+"</strong> Akan Terhapus",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            window.location = 'berita/'+$id+'/delete';
        }
    });
}

function alertTambahDataPenyedia() {
    swal.fire({
        title: 'Apakah anda yakin ?',
        html: "Simpan data",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            SimpanDataPenyedia();
        }
    });
}

function alertBerhasilTambahDataPenyedia() {
    swal.fire({
        title: 'Sukses',
        html: "Berhasil menyimpan data",
        type: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ok',
    }).then((result) => {
        if (result.value) {
            
        }
    });
}

function alertGagalTambahDataPenyedia() {
    swal.fire({
        title: 'Oops...',
        html: "Gagal menyimpan data",
        type: 'error',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ok',
    }).then((result) => {
        if (result.value) {
            
        }
    });
}

function alertSukses() {
    swal.fire({
        title: 'Sukses',
        type: 'success',
        showCancelButton: false,
        showConfirmButton: false,
        timer: 1500
    })
}

function alertGagal() {
    swal.fire({
        title: 'Oops...',
        html: "Terjadi kesalahan",
        type: 'error',
        showCancelButton: false,
        showConfirmButton: false,
        timer: 1500
    })
}

function alertGagal2($txt) {
    swal.fire({
        title: 'Oops...',
        html: $txt,
        type: 'error',
        showCancelButton: false,
        showConfirmButton: true
    })
}