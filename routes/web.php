<?php
Route::get('/', 'IndexController@index')->name('index');
Route::get('/non-bansos', 'Panel\IndexController@IndexNonBansos');

Route::get('/panel/data/bansos/index/json/{kab}/{kec}/{kel}', 'Panel\IndexController@BansosIndexJSON');
Route::get('/kecamatan/{id}', 'Panel\IndexController@DataKec');
Route::get('/kelurahan/{kab}/{kec}', 'Panel\IndexController@DataKel');
Route::get('/tes', 'Panel\IndexController@tes');
Route::post('/file', 'Panel\IndexController@import_excel');
Route::get('/chart/data', 'Panel\IndexController@ChartData');
Route::get('/canvas', 'Panel\IndexController@Canvas');

Route::group(['middleware' => ['role:superadmin']], function () {
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
});

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/panel/data/bansos', 'Panel\IndexController@IndexBansos')->name('panel.bansos');
    Route::get('/panel/data/bansos/json', 'Panel\IndexController@BansosJSON')->name('panel.bansos.json');
    Route::post('/panel/data/bansos/insert', 'Panel\IndexController@BansosInsert')->name('panel.bansos.insert');
    Route::post('/panel/data/bansos/edit', 'Panel\IndexController@BansosEdit')->name('panel.bansos.edit');
    Route::get('/panel/data/bansos/delete/{id}', 'Panel\IndexController@BansosDelete')->name('panel.bansos.delete');

    Route::get('/panel/data/pemberi/bantuan', 'Panel\IndexController@IndexPemberiBantuan')->name('panel.pemberi.bantuan');
    Route::get('/panel/data/pemberi/bantuan/json', 'Panel\IndexController@PemberiBantuanJSON');
    Route::post('/panel/data/pemberi/bantuan/insert', 'Panel\IndexController@PemberiBantuanInsert')->name('panel.pemberi.bantuan.insert');
    Route::post('/panel/data/pemberi/bantuan/edit', 'Panel\IndexController@PemberiBantuanEdit')->name('panel.pemberi.bantuan.edit');
    Route::get('/panel/data/pemberi/bantuan/delete/{id}', 'Panel\IndexController@PemberiBantuanDelete')->name('panel.pemberi.bantuan.delete');
    Route::get('/panel/data/pemberi/bantuan/edit/json/{id}', 'Panel\IndexController@PemberiBantuanEditJSON')->name('panel.pemberi.bantuan.edit.json');
});

Route::group(['middleware' => ['role:adminaduan']], function () {
    Route::get('/panel/data/aduan', 'Panel\IndexController@IndexAduan')->name('panel.aduan');
    Route::get('/panel/data/aduan/json/{kab}/{kec}/{kel}', 'Panel\IndexController@AduanJSON')->name('panel.aduan.json');
});




Route::group(['prefix'=>'panel'], function () {
    Auth::routes();
    Route::group(['middleware' => ['auth']], function() {
        Route::get('/', 'Panel\IndexController@index')->name('panel.dashboard');
        
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

        Route::group(['middleware' => ['role:superadmin']], function () {
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
            Route::group(['prefix'=>'profil'], function () {
                Route::get('/', 'Panel\IndexController@profil')->name('panel.profil');
                Route::post('edit', 'Panel\IndexController@profilEdit')->name('panel.profil.edit');
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