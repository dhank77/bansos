<?php

Route::get('/panel/data/daerah', 'Panel\IndexController@IndexDaerah')->name('panel.daerah');
Route::get('/panel/data/daerah/json', 'Panel\IndexController@DaerahJSON')->name('panel.daerah.json');
Route::post('/panel/data/daerah/insert', 'Panel\IndexController@DaerahInsert')->name('panel.daerah.insert');
Route::post('/panel/data/daerah/edit', 'Panel\IndexController@DaerahEdit')->name('panel.daerah.edit');
Route::get('/panel/data/daerah/delete/{id}', 'Panel\IndexController@DaerahDelete')->name('panel.daerah.delete');

Route::get('/panel/data/bansos', 'Panel\IndexController@IndexBansos')->name('panel.bansos');
Route::get('/panel/data/bansos/json', 'Panel\IndexController@BansosJSON')->name('panel.bansos.json');
Route::post('/panel/data/bansos/insert', 'Panel\IndexController@BansosInsert')->name('panel.bansos.insert');
Route::post('/panel/data/bansos/edit', 'Panel\IndexController@BansosEdit')->name('panel.bansos.edit');
Route::get('/panel/data/bansos/delete/{id}', 'Panel\IndexController@BansosDelete')->name('panel.bansos.delete');

Route::get('/panel/data/bansos/index/json/{kab}/{kec}/{kel}', 'Panel\IndexController@BansosIndexJSON');

Route::get('/kecamatan/{id}', 'Panel\IndexController@DataKec');
Route::get('/kelurahan/{kab}/{kec}', 'Panel\IndexController@DataKel');
Route::get('/tes', 'Panel\IndexController@tes');
Route::post('/file', 'Panel\IndexController@import_excel');
Route::get('/chart/data', 'Panel\IndexController@ChartData');
Route::get('/canvas', 'Panel\IndexController@Canvas');
Route::get('/non-bansos', 'Panel\IndexController@IndexNonBansos');





Route::get('/xxx', 'Panel\IndexController@XXX');

Route::get('/unker', 'ApiController@unker');
Route::get('/apipegawai/{awal}/{akhir}', 'ApiController@pegawai');
Route::get('/total', 'ApiController@total');

Route::get('/', 'IndexController@index')->name('index');
Route::get('/persyaratan', 'IndexController@Persyaratan')->name('persyaratan');
Route::post('/panel/persyaratan/insert', 'Panel\IndexController@SyaratInsert')->name('panel.persyaratan.insert');
Route::get('/panel/pegawai', 'Panel\IndexController@IndexPegawai')->name('panel.pegawai');
Route::get('/panel/penghargaan/periode', 'Panel\IndexController@IndexPeriode')->name('panel.periode');
Route::get('/panel/penghargaan/usulan-pegawai', 'Panel\IndexController@IndexUsulanPegawai')->name('panel.usulan.pegawai');
Route::get('/panel/penghargaan/penerima', 'Panel\IndexController@IndexPenerimaPenghargaan')->name('panel.penerima.penghargaan');
Route::get('/panel/laporan/skpd/{unker}', 'Panel\IndexController@LaporanSkpd')->name('panel.laporan.skpd');
Route::get('/panel/laporan/semua/{periode}', 'Panel\IndexController@LaporanSemua')->name('panel.laporan.semua');
Route::get('/panel/laporan/hal-laporan', 'Panel\IndexController@IndexLaporan')->name('panel.pagelaporan');
Route::get('/panel/laporan/hal-laporan-semua', 'Panel\IndexController@IndexLaporanSemua')->name('panel.pagelaporanall');
Route::get('/panel/konfigurasi/persyaratan', 'Panel\IndexController@indexsyarat')->name('panel.persyaratan');

Route::get('/panel/penghargaan/status', 'Panel\IndexController@status')->name('panel.status');

Route::get('/data/{periode}', 'Panel\IndexController@Data');
Route::get('/datas/rekap/{periode}', 'Panel\IndexController@DataRekap');
Route::get('/datas/pegawai/{unker}', 'Panel\IndexController@DataPegawai');
Route::get('/datas/unker', 'Panel\IndexController@DataUnker');
Route::get('/datas/agama', 'Panel\IndexController@DataAgama');
Route::get('/datas/jeniskelamin', 'Panel\IndexController@DataJenisKelamin');
Route::get('/datas/statuskerja', 'Panel\IndexController@DataStatusKerja');
Route::get('/datas/tmtgol', 'Panel\IndexController@DataTMTGol');
Route::get('/datas/jabatan', 'Panel\IndexController@DataJabatan');
Route::get('/datas/eselon', 'Panel\IndexController@DataEselon');
Route::get('/datas/pendidikan', 'Panel\IndexController@DataPendidikan');
Route::get('/datas/diklat', 'Panel\IndexController@DataDiklat');
Route::get('/datas/periode', 'Panel\IndexController@DataPeriode');

Route::post('/pegawai/insert', 'Panel\IndexController@PegawaiInsert');
Route::post('/pegawai/edit', 'Panel\IndexController@PegawaiEdit');
Route::get('/pegawai/delete/{id}', 'Panel\IndexController@PegawaiDelete');

Route::get('/datas/usulan/pegawai/{unker}', 'Panel\IndexController@DataUsulanPegawai');
Route::post('/usulan/pegawai/insert', 'Panel\IndexController@PegawaiUsulanInsert');

Route::get('/datas/ms/periode', 'Panel\IndexController@DataMsPeriode');
Route::post('/datas/ms/periode/insert', 'Panel\IndexController@DataMsPeriodeInsert');
Route::post('/datas/ms/periode/edit', 'Panel\IndexController@DataMsPeriodeEdit');

Route::get('/datas/penerima/penghargaan/usul/{unker}/{periode}', 'Panel\IndexController@DataPenerimaPengargaanUsulan');
Route::get('/datas/penerima/penghargaan/terima/{unker}/{periode}', 'Panel\IndexController@DataPenerimaPengargaanTerima');
Route::get('/datas/penerima/penghargaan/tolak/{unker}/{periode}', 'Panel\IndexController@DataPenerimaPengargaanTolak');

Route::get('/panel/acc/usulan/pegawai/{id}', 'Panel\IndexController@AccUsulan');
Route::post('/panel/tolak/usulan/pegawai', 'Panel\IndexController@TolakUsulan');







































Route::get('/rekap/{bulan}/{tahun}', 'ApiController@Rekap');
Route::get('/data/chart/{bulan}/{skpd}/{tahun}', 'ApiController@DataCHART');
Route::get('/bs', 'ApiController@bs');
Route::get('/add', 'ApiController@adduser');
Route::get('/role', 'ApiController@addrole');
Route::get('/apiskpd', 'ApiController@apiskpd');
Route::get('/apianggaran', 'ApiController@apianggaran');
Route::get('/apirealisasi', 'ApiController@apirealisasi');
Route::get('/tambahprogram', 'ApiController@program');
Route::get('/tambahkegiatan', 'ApiController@kegiatan');
Route::get('/data/skpd/load', 'ApiController@skpdload');
Route::get('/data/program/load/{skpd}', 'ApiController@programload');
Route::get('/data/kegiatan/load/{program}/{skpd}', 'ApiController@kegiatanload');
Route::get('/data/json/{triwulan}', 'JSONController@DataJSON')->name('panel.data.rekap');
Route::get('/data/json/skpd/{triwulan}', 'JSONController@DataJSONskpd')->name('panel.data.rekap.skpd');
Route::post('/fisik/realisasi/edit', 'JSONController@FisikRealisasiEdit');

Route::get('/cetak/laporan/{tahun}/{triwulan}', 'JSONController@cetakLaporan');



Route::get('loadkab/{id}', 'Panel\IndexController@loadkab')->name('panel.load.kab');
Route::get('loadinstansi', 'Panel\IndexController@loadinstansi')->name('panel.load.instansi');
Route::get('kodefikasi/load', 'Panel\IndexController@KodefikasiLoad')->name('panel.load.kodefikasi');
Route::get('metodepembayaran/load', 'Panel\IndexController@MetodePembayaranLoad')->name('panel.load.metode.pembayaran');
Route::get('jenisdak/load', 'Panel\IndexController@JenisDakLoad')->name('panel.load.jenisdak');
Route::get('program/load', 'Panel\IndexController@ProgramLoad')->name('panel.load.program');
Route::get('kegiatan/load/{id}', 'Panel\IndexController@KegiatanLoad')->name('panel.load.kegiatan');
Route::get('kegiatan/edit/load/{program}/{kegiatan}', 'Panel\IndexController@KegiatanEditLoad')->name('panel.load.kegiatan.edit');
Route::get('program/edit/load/{program}', 'Panel\IndexController@ProgramEditLoad')->name('panel.load.Program.edit');
Route::get('bidang/edit/load/{bidang}', 'Panel\IndexController@BidangEditLoad')->name('panel.load.bidang.edit');
Route::get('subbidang/edit/load/{bidang}/{subbidang}', 'Panel\IndexController@SubBidangEditLoad')->name('panel.load.subbidang.edit');
Route::get('/load/data/ms_program', 'Panel\IndexController@LoadDataProgram')->name('panel.load.datamsprogram');
Route::get('/load/data/ms_bidang', 'Panel\IndexController@LoadDataBidang')->name('panel.load.datamsbidang');
Route::get('/load/data/ms_subbidang/{id}', 'Panel\IndexController@LoadDataSubBidangID')->name('panel.load.data.mssubbidangid');
Route::get('/sub/reguler/load', 'Panel\IndexController@SubRegulerLoad');
Route::get('/sub/reguler/ii/load/{id}', 'Panel\IndexController@SubRegulerIILoad');
Route::get('/sub/reguler/edit/ii/load/{id}/{ids}', 'Panel\IndexController@SubRegulerIIEditLoad');


Route::get('/update/program', 'Panel\IndexController@updateprogram');
Route::get('/update/kegiatan', 'Panel\IndexController@updatekegiatan');
Route::get('/insert/skpd/baru', 'Panel\IndexController@insertskpdnew');
Route::get('/insert/role/skpd/baru', 'Panel\IndexController@insertroleskpdnew');
Route::get('/update/kepala/opd', 'Panel\IndexController@insertnamakepala');
Route::get('/insert/insertidskpddibidang', 'Panel\IndexController@insertidskpddibidang');





Route::get('profil', 'IndexController@profil')->name('index.profil');
Route::get('struktur', 'IndexController@struktur')->name('index.struktur');
Route::get('layanan', 'IndexController@layanan')->name('index.layanan');
Route::group(['prefix'=>'galeri'], function () {
    Route::get('/', 'IndexController@galeri')->name('index.galeri');
    Route::get('{slug}', 'IndexController@galeriView')->name('index.galeri.view');
});

Route::group(['prefix'=>'agenda'], function () {
    Route::get('/', 'IndexController@agenda')->name('index.agenda');
    Route::get('/pilih/{bulan}/{tahun}', 'IndexController@agendapilih')->name('agenda.pilih');
});

Route::group(['prefix'=>'download'], function () {
    Route::get('/', 'IndexController@downloads')->name('index.download');
    Route::get('file/{nama_file}', 'IndexController@downloadfile')->name('download.file');
});

Route::group(['prefix'=>'panel'], function () {
    Auth::routes();
    Route::group(['middleware' => ['auth']], function() {
        Route::get('/', 'Panel\IndexController@index')->name('panel.dashboard');

        Route::get('/master/skpd', 'Panel\IndexController@MasterSkpd')->name('panel.master.skpd');
        Route::post('/master/skpd/insert', 'Panel\IndexController@MasterSkpdInsert')->name('panel.master.skpd.insert');
        Route::get('/master/skpd/delete/{id}', 'Panel\IndexController@MasterSkpdDelete')->name('panel.master.skpd.delete');
        Route::get('/master/skpd/json', 'Panel\IndexController@MasterSkpdJSON')->name('panel.master.skpd.json');
        Route::post('/master/skpd/edit', 'Panel\IndexController@MasterSkpdEdit')->name('panel.master.skpd.edit');

        Route::get('/master/skpd/kab', 'Panel\IndexController@MasterSkpdKab')->name('panel.master.skpdkab');
        Route::get('/master/skpd/kab/delete/{id}', 'Panel\IndexController@MasterSkpdKabDelete')->name('panel.master.skpdkab.delete');
        Route::get('/master/skpd/kab/json', 'Panel\IndexController@MasterSkpdKabJSON')->name('panel.master.skpdkab.json');
        Route::post('/master/skpd/kab/insert', 'Panel\IndexController@MasterSkpdKabInsert')->name('panel.master.skpdkab.insert');
        Route::post('/master/skpd/kab/edit', 'Panel\IndexController@MasterSkpdKabEdit')->name('panel.master.skpdkab.edit');

        Route::get('/master/belanja', 'Panel\IndexController@MasterBelanja')->name('panel.master.belanja');
        Route::post('/master/belanja/insert', 'Panel\IndexController@MasterBelanjaInsert')->name('panel.master.belanja.insert');
        Route::get('/master/belanja/delete/{id}', 'Panel\IndexController@MasterBelanjaDelete')->name('panel.master.belanja.delete');
        Route::get('/master/belanja/json', 'Panel\IndexController@MasterBelanjaJSON')->name('panel.master.belanja.json');
        Route::post('/master/belanja/edit', 'Panel\IndexController@MasterBelanjaEdit')->name('panel.master.belanja.edit');

        Route::get('/master/kodefikasi', 'Panel\IndexController@MasterKodefikasi')->name('panel.master.kodefikasi');
        Route::post('/master/kodefikasi/insert', 'Panel\IndexController@MasterKodefikasiInsert')->name('panel.master.kodefikasi.insert');
        Route::get('/master/kodefikasi/delete/{id}', 'Panel\IndexController@MasterKodefikasiDelete')->name('panel.master.kodefikasi.delete');
        Route::get('/master/kodefikasi/json', 'Panel\IndexController@MasterKodefikasiJSON')->name('panel.master.kodefikasi.json');
        Route::post('/master/kodefikasi/edit', 'Panel\IndexController@MasterKodefikasiEdit')->name('panel.master.kodefikasi.edit');

        Route::get('/program', 'Panel\IndexController@Program')->name('panel.program');
        Route::post('/program/insert', 'Panel\IndexController@DataProgramInsert')->name('panel.program.insert');
        Route::post('/program/edit', 'Panel\IndexController@DataProgramEdit')->name('panel.program.edit');
        Route::get('/data/program/json', 'Panel\IndexController@DataProgramJSON')->name('panel.program.json.load');
        Route::get('/program/delete/{id}', 'Panel\IndexController@DataProgramDelete')->name('panel.program.delete');
        Route::get('/cetak/laporan', 'Panel\IndexController@cetakLaporan')->name('panel.program.cetak.laporan');
        Route::get('/cetak/laporan/{kodeskpd}/{tahun}/{triwulan}', 'Panel\IndexController@cetakLaporan2')->name('panel.program.cetak.laporan2');

        Route::get('/chart/{kodeskpd}', 'Panel\IndexController@Chart');





        Route::get('/master/ms_program', 'Panel\IndexController@MsProgram')->name('panel.ms_program');
        Route::post('/master/ms_program/insert', 'Panel\IndexController@MsProgramInsert')->name('panel.ms_program.insert');
        Route::post('/master/ms_program/edit', 'Panel\IndexController@MsProgramEdit')->name('panel.ms_program.edit');
        Route::get('/master/data/ms_program/json', 'Panel\IndexController@MsProgramJSON')->name('panel.ms_program.json.load');
        Route::get('/master/ms_program/delete/{id}', 'Panel\IndexController@MsProgramDelete')->name('panel.ms_program.delete');

        Route::get('/master/ms_kegiatan', 'Panel\IndexController@MsKegiatan')->name('panel.ms_kegiatan');
        Route::post('/master/ms_kegiatan/insert', 'Panel\IndexController@MsKegiatanInsert')->name('panel.ms_kegiatan.insert');
        Route::post('/master/ms_kegiatan/edit', 'Panel\IndexController@MsKegiatanEdit')->name('panel.ms_kegiatan.edit');
        Route::get('/master/data/ms_kegiatan/json', 'Panel\IndexController@MsKegiatanJSON')->name('panel.ms_kegiatan.json.load');
        Route::get('/master/ms_kegiatan/delete/{id}', 'Panel\IndexController@MsKegiatanDelete')->name('panel.ms_kegiatan.delete');

        Route::get('/master/ms_bidang', 'Panel\IndexController@MsBidang')->name('panel.ms_bidang');
        Route::post('/master/ms_bidang/insert', 'Panel\IndexController@MsBidangInsert')->name('panel.ms_bidang.insert');
        Route::post('/master/ms_bidang/edit', 'Panel\IndexController@MsBidangEdit')->name('panel.ms_bidang.edit');
        Route::get('/master/data/ms_bidang/json', 'Panel\IndexController@MsBidangJSON')->name('panel.ms_bidang.json.load');
        Route::get('/master/ms_bidang/delete/{id}', 'Panel\IndexController@MsBidangDelete')->name('panel.ms_bidang.delete');

        Route::get('/master/ms_subbidang', 'Panel\IndexController@MsSubBidang')->name('panel.ms_subbidang');
        Route::post('/master/ms_subbidang/insert', 'Panel\IndexController@MsSubBidangInsert')->name('panel.ms_subbidang.insert');
        Route::post('/master/ms_subbidang/edit', 'Panel\IndexController@MsSubBidangEdit')->name('panel.ms_subbidang.edit');
        Route::get('/master/data/ms_subbidang/json', 'Panel\IndexController@MsSubBidangJSON')->name('panel.ms_subbidang.json.load');
        Route::get('/master/ms_subbidang/delete/{id}', 'Panel\IndexController@MsSubBidangDelete')->name('panel.ms_subbidang.delete');






        
        Route::group(['middleware' => ['role:admin']], function () {
            Route::group(['prefix'=>'masters'], function () {
                Route::group(['prefix'=>'users'], function () {
                    Route::group(['prefix'=>'skpd'], function () {
                        Route::get('/', 'Panel\IndexController@usersSkpd')->name('panel.usersSkpd');
                        Route::post('insert', 'Panel\IndexController@usersSkpdInsert')->name('panel.usersSkpd.insert');
                        Route::post('edit', 'Panel\IndexController@usersSkpdEdit')->name('panel.usersSkpd.edit');
                        Route::get('delete/{id}', 'Panel\IndexController@usersSkpdDelete')->name('panel.usersSkpd.delete');
                        Route::get('json', 'Panel\IndexController@usersSkpdJson')->name('panel.usersSkpd.json');
                        Route::get('{id}/jsonedit', 'Panel\IndexController@usersSkpdJsonEdit')->name('panel.usersSkpd.jsonedit');
                        Route::get('reset/{id}', 'Panel\IndexController@usersSkpdReset')->name('panel.usersSkpd.reset');
                    });
                });
            });
        });

        Route::group(['middleware' => ['role:superadmin|verifikator']], function () {
            Route::group(['prefix'=>'konfigurasi/masters'], function () {
                Route::group(['prefix'=>'users'], function () {
                    Route::get('/', 'Panel\IndexController@users')->name('panel.users');
                    Route::post('insert', 'Panel\IndexController@usersInsert')->name('panel.users.insert');
                    Route::post('edit', 'Panel\IndexController@usersEdit')->name('panel.users.edit');
                    Route::get('delete/{id}', 'Panel\IndexController@usersDelete')->name('panel.users.delete');
                    Route::get('json', 'Panel\IndexController@usersJson')->name('panel.users.json');
                    Route::get('{id}/jsonedit', 'Panel\IndexController@usersJsonEdit')->name('panel.users.jsonedit');
                    Route::get('reset/{id}', 'Panel\IndexController@usersReset')->name('panel.users.reset');
                    Route::get('aktif/{id}', 'Panel\IndexController@usersAktif')->name('panel.users.aktif');
                });
            });
            Route::group(['prefix'=>'settings'], function () {
                Route::get('/', 'Panel\IndexController@settings')->name('panel.settings');
                Route::post('edit', 'Panel\IndexController@settingsEdit')->name('panel.settings.edit');
            });
            Route::group(['prefix'=>'slide'], function () {
                Route::get('/', 'Panel\IndexController@slide')->name('panel.slide');
                Route::post('insert', 'Panel\IndexController@slideInsert')->name('panel.slide.insert');
                Route::post('edit', 'Panel\IndexController@slideEdit')->name('panel.slide.edit');
                Route::get('{id}/delete', 'Panel\IndexController@slideDelete')->name('panel.slide.delete');
                Route::get('json', 'Panel\IndexController@slideJson')->name('panel.slide.json');
                Route::get('{id}/jsonedit', 'Panel\IndexController@slideJsonEdit')->name('panel.slide.jsonedit');
            });
            Route::group(['prefix'=>'profil'], function () {
                Route::get('/', 'Panel\IndexController@profil')->name('panel.profil');
                Route::post('edit', 'Panel\IndexController@profilEdit')->name('panel.profil.edit');
            });
            Route::group(['prefix'=>'struktur'], function () {
                Route::get('/', 'Panel\IndexController@struktur')->name('panel.struktur');
                Route::post('edit', 'Panel\IndexController@strukturEdit')->name('panel.struktur.edit');
            });
            Route::group(['prefix'=>'link'], function () {
                Route::get('/', 'Panel\IndexController@link')->name('panel.link');
                Route::post('insert-terkait', 'Panel\IndexController@linkTerkaitInsert')->name('panel.link.insert-terkait');
                Route::post('edit-terkait', 'Panel\IndexController@linkEditTerkait')->name('panel.link.edit-terkait');
                Route::get('terkait-json', 'Panel\IndexController@linkTerkaitJson')->name('panel.link.terkait-json');
                Route::get('{id}/terkait-jsonedit', 'Panel\IndexController@linkTerkaitJsonEdit')->name('panel.link.terkait-jsonedit');
                Route::get('{id}/delete', 'Panel\IndexController@linkTerkaitDelete')->name('panel.link.terkait-delete');
                Route::post('edit-sosmed', 'Panel\IndexController@linkEditSosmed')->name('panel.link.edit-sosmed');
            });
        });
        Route::group(['middleware' => ['role:admin|moderator']], function () {
            Route::group(['prefix'=>''], function () {
                Route::get('updatelink/{link}', 'Panel\IndexController@linkupdate')->name('panel.link.update');
                Route::post('updatetextvideo', 'Panel\IndexController@textvideoupdate')->name('panel.text.video.update');
            });
            Route::group(['prefix'=>'post'], function () {
                Route::get('/', 'Panel\IndexController@post')->name('panel.post');
                Route::get('/posts/data/produk', 'Panel\IndexController@post2')->name('panel.post2');
                Route::post('/posts/produk/insert', 'Panel\IndexController@produkInsert')->name('panel.produk.insert');
                Route::post('/posts/produk/edit', 'Panel\IndexController@produkEdit')->name('panel.produk.edit');
                Route::post('/posts/produk/delete', 'Panel\IndexController@produkDelete')->name('panel.produk.delete');
                Route::get('/json', 'Panel\IndexController@postJson')->name('panel.post.json');
                Route::get('{id}/jsonedit', 'Panel\IndexController@postJsonEdit')->name('panel.post.jsonedit');
            });
            Route::group(['prefix'=>'laporan'], function () {
                Route::get('/', 'Panel\IndexController@lapor')->name('panel.lapor');
                Route::get('{id}/proses', 'Panel\IndexController@laporProses')->name('panel.lapor.proses');
            });
            Route::group(['prefix'=>'berita'], function () {
                Route::get('/', 'Panel\IndexController@berita')->name('panel.berita');
                Route::get('/posts/data/berita', 'Panel\IndexController@berita2')->name('panel.berita2');
                Route::post('/posts/berita/insert', 'Panel\IndexController@beritaInsert')->name('panel.berita.insert');
                Route::post('/posts/berita/edit', 'Panel\IndexController@beritaEdit')->name('panel.berita.edit');
                Route::get('{id}/delete', 'Panel\IndexController@beritaDelete')->name('panel.berita.delete');
                Route::get('/json', 'Panel\IndexController@beritaJson')->name('panel.berita.json');
                Route::get('{id}/jsonedit', 'Panel\IndexController@postJsonEdit')->name('panel.post.jsonedit');
            });
            Route::group(['prefix'=>'kontak'], function () {
                Route::get('/', 'Panel\IndexController@kontak')->name('panel.kontak');
                //Route::post('insert', 'Panel\IndexController@postInsert')->name('panel.post.insert');
                Route::post('edit', 'Panel\IndexController@kontakEdit')->name('panel.kontak.edit');
                //Route::get('{id}/delete', 'Panel\IndexController@postDelete')->name('panel.post.delete');
                Route::get('json', 'Panel\IndexController@kontakJson')->name('panel.kontak.json');
                Route::get('jsonedit/{id}', 'Panel\IndexController@kontakJsonEdit')->name('panel.kontak.jsonedit');
            });
            Route::group(['prefix'=>'agenda'], function () {
                Route::get('/', 'Panel\IndexController@agenda')->name('panel.agenda');
                Route::post('insert', 'Panel\IndexController@agendaInsert')->name('panel.agenda.insert');
                Route::post('edit', 'Panel\IndexController@agendaEdit')->name('panel.agenda.edit');
                Route::get('{id}/delete', 'Panel\IndexController@agendaDelete')->name('panel.agenda.delete');
                Route::get('json', 'Panel\IndexController@agendaJson')->name('panel.agenda.json');
                Route::get('{id}/jsonedit', 'Panel\IndexController@agendaJsonEdit')->name('panel.agenda.jsonedit');
            });
            Route::group(['prefix'=>'download'], function () {
                Route::get('/', 'Panel\IndexController@download')->name('panel.download');
                Route::post('insert', 'Panel\IndexController@downloadInsert')->name('panel.download.insert');
                Route::post('edit', 'Panel\IndexController@downloadEdit')->name('panel.download.edit');
                Route::get('{id}/delete', 'Panel\IndexController@downloadDelete')->name('panel.download.delete');
                Route::get('json', 'Panel\IndexController@downloadJson')->name('panel.download.json');
                Route::get('{id}/jsonedit', 'Panel\IndexController@downloadJsonEdit')->name('panel.download.jsonedit');
            });
            Route::group(['prefix'=>'galeri'], function () {
                Route::get('/', 'Panel\IndexController@galeri')->name('panel.galeri');
                Route::post('insert', 'Panel\IndexController@galeriInsert')->name('panel.galeri.insert');
                Route::post('insert-image', 'Panel\IndexController@galeriInsertImage')->name('panel.galeri.insert-image');
                Route::post('edit', 'Panel\IndexController@galeriEdit')->name('panel.galeri.edit');
                Route::post('edit-add-image', 'Panel\IndexController@galeriEditAddImage')->name('panel.galeri.edit-add-image');
                Route::get('{id}/delete', 'Panel\IndexController@galeriDelete')->name('panel.galeri.delete');
                Route::get('json', 'Panel\IndexController@galeriJson')->name('panel.galeri.json');
                Route::get('{id}/jsonedit', 'Panel\IndexController@galeriJsonEdit')->name('panel.galeri.jsonedit');
            });
        });
        
        Route::group(['prefix'=>'akun'], function () {
            Route::get('/', 'Panel\IndexController@akun')->name('panel.akun');
            Route::post('edit-password', 'Panel\IndexController@akunEditPassword')->name('panel.akun.edit-password');
        });
        Route::get('logout', 'Auth\LoginController@logout')->name('panel.logout');
    });
});