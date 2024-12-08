<div id="form-register" class="container">
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">PENDAFTARAN</button>
        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">PETUNJUK PENGISIAN</button>
    </div>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
            <form id="product-register" data-pid="<?= $params->pid; ?>" data-temp="<?= $params->logs; ?>">
                <div class="box">
                    <div class="p-2">
                        KUA WILAYAH
                    </div>
                    <div class="form-floating">
                        <select id="kua" class="form-select" required>
                            <option value="0">== PILIHAN ==</option>
                            <option value="2">TAPIN UTARA</option>
                            <option value="3">TAPIN TENGAH</option>
                            <option value="4">TAPIN SELATAN</option>
                            <option value="5">BAKARANGAN</option>
                            <option value="6">BUNGUR</option>
                            <option value="7">LOKPAIKAT</option>
                            <option value="8">PIANI</option>
                            <option value="9">SALAM BABARIS</option>
                            <option value="10">HATUNGUN</option>
                            <option value="11">BINUANG</option>
                            <option value="12">CANDI LARAS SELATAN</option>
                            <option value="13">CANDI LARAS UTARA</option>
                        </select>
                        <label for="kua">KECAMATAN</label>
                    </div>
                </div>
                <div class="box">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="p-2">
                                    DATA LAKI-LAKI
                                </div>
                                <div class="box-sub">
                                    <div class="form-floating mb-2">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="NIK" name="lk-nik" maxlength="16" required>
                                        <label for="floatingInput">NOMOR INDUK KEPENDUDUKAN</label>
                                    </div>
                                    <div class="form-floating mb-2">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="KK" name="lk-kk" maxlength="16" required>
                                        <label for="floatingInput">NOMOR KARTU KELUARGA</label>
                                    </div>
                                    <div class="form-floating mb-2">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="NAMA" name="lk-name" required>
                                        <label for="floatingInput">NAMA LENGKAP</label>
                                    </div>
                                    <div class="form-floating mb-2">
                                        <input type="text" autocomplete="off" class="form-control" placeholder="TELEPON" name="lk-phone" maxlength="14" required>
                                        <label for="floatingInput" class="required">NOMOR TELEPON (WHATSAPP)</label>
                                    </div>
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="ALAMAT" name="lk-address" style="height: 150px;" required></textarea>
                                        <label for="floatingInput">ALAMAT TINGGAL (DI KARTU KELUARGA)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-2">
                                DATA PEREMPUAN
                            </div>
                            <div class="box-sub">
                                <div class="form-floating mb-2">
                                    <input type="text" autocomplete="off" class="form-control" placeholder="NIK" name="pr-nik" maxlength="16" required>
                                    <label for="floatingInput">NOMOR INDUK KEPENDUDUKAN</label>
                                </div>
                                <div class="form-floating mb-2">
                                    <input type="text" autocomplete="off" class="form-control" placeholder="KK" name="pr-kk" maxlength="16" required>
                                    <label for="floatingInput">NOMOR KARTU KELUARGA</label>
                                </div>
                                <div class="form-floating mb-2">
                                    <input type="text" autocomplete="off" class="form-control" placeholder="NAMA" name="pr-name" required>
                                    <label for="floatingInput">NAMA LENGKAP</label>
                                </div>
                                <div class="form-floating mb-2">
                                    <input type="text" autocomplete="off" class="form-control" placeholder="TELEPON" name="pr-phone" maxlength="14" required>
                                    <label for="floatingInput" class="required">NOMOR TELEPON (WHATSAPP)</label>
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="ALAMAT" name="pr-address" style="height: 150px;" required></textarea>
                                    <label for="floatingInput">ALAMAT TINGGAL (DI KARTU KELUARGA)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="p-2">ALAMAT BARU</div>
                    <div class="form-floating mb-2">
                        <input type="text" autocomplete="off" class="form-control" name="addr-street" placeholder="NAMA JALAN">
                        <label for="floatingInput">NAMA JALAN</label>
                    </div>
                    <div class="input-group">
                        <div class="form-floating mb-2">
                            <input type="text" autocomplete="off" class="form-control" name="addr-rt" placeholder="RT" maxlength="3">
                            <label for="floatingInput">RT</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" autocomplete="off" class="form-control" name="addr-rw" placeholder="RW" maxlength="3">
                            <label for="floatingInput">RW</label>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="form-floating mb-2">
                            <input type="text" autocomplete="off" class="form-control" name="addr-ds" placeholder="DESA">
                            <label for="floatingInput">KEL/DESA</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" autocomplete="off" class="form-control" name="addr-kec" placeholder="KECAMATAN">
                            <label for="floatingInput">KECAMATAN</label>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="CATATAN" style="height: 150px;" name="notes"></textarea>
                        <label for="floatingInput" class="required">PERUBAHAN DATA: GOLONGAN DARAH / PENDIDIKAN / PEKERJAAN</label>
                    </div>
                </div>
                <div class="box">
                    <div class="p-2">
                        DOKUMEN PENDUKUNG PERUBAHAN DATA
                    </div>
                    <div class="input-group">
                        <div class="form-floating">
                            <select name="category" id="file-category" class="form-select">
                                <option value="0">== PILIHAN ==</option>
                                <option value="3">IJAZAH TERAKHIR (PENDIDIKAN)</option>
                                <option value="4">SK PEGAWAI (PEKERJAAN)</option>
                                <option value="5">LAINNYA</option>
                            </select>
                            <label for="floatingInput">KATEGORI</label>
                        </div>
                        <div class="form-floating">
                            <input type="file" id="file-upload" class="form-control" accept="image/jpeg, image/png">
                            <label for="files">UNGGAH GAMBAR</label>
                        </div>
                    </div>
                    <div id="file-result" class="mt-2 list-group list-group-numbered"></div>
                </div>
                <div class="box">
                    <div class="d-flex mb-3">
                        <input class="form-check-input me-2" type="checkbox" checked> DENGAN MENDAFTAR, SAYA SETUJU DENGAN KETENTUAN DAN KEBIJAKAN YANG BERLAKU.
                    </div>
                    <button type="submit" class="btn-success btn btn-lg w-100">MENDAFTAR</button>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
            <div class="box">
                <div class="text-start">
                    <div class="box">
                        <span class="fw-bold">KUA WILAYAH</span>
                        <span class="d-block smaller p-2">
                            PILIH SESUAI DENGAN KECAMATAN KANTOR KUA DIMANA TEMPAT PENDAFTARAN PERNIKAHAN
                        </span>
                    </div>
                    <div class="box">
                        <span class="fw-bold">NIK</span>
                        <span class="d-block smaller p-2">NOMOR INDUK KEPENDUDUKAN YANG TERTERA PADA KTP</span>
                    </div>
                    <div class="box">
                        <span class="fw-bold">NOMOR KARTU KELUARGA</span>
                        <span class="d-block smaller p-2">BISA DILIHAT DIBAGIAN ATAS DOKUMEN KARTU KELUARGA</span>
                    </div>
                    <div class="box">
                        <span class="fw-bold">NAMA LENGKAP</span>
                        <span class="d-block smaller p-2">SILAHKAN ISI NAMA LENGKAP TANPA GELAR SESUAI DENGAN DI KTP/KARTU KELUARGA</span>
                    </div>
                    <div class="box">
                        <span class="fw-bold">NOMOR TELEPON</span>
                        <span class="d-block smaller p-2">NOMOR TELEPON/WHATSAPP TERDAFTAR DAN AKTIF, UNTUK NOTIFIKASI PROSES PERMOHONAN CETAK DOKUMEN</span>
                    </div>
                    <div class="box">
                        <span class="fw-bold">ALAMAT TINGGAL</span>
                        <span class="d-block smaller p-2">SESUAIKAN DENGAN YANG TERTERA PADA ALAMAT DI KTP/KARTU KELUARGA</span>
                    </div>
                    <div class="box">
                        <span class="fw-bold">ALAMAT BARU</span>
                        <span class="d-block smaller p-2">ISI ALAMAT BARU SESUAI DENGAN ALAMAT TINGGAL SEKARANG</span>
                    </div>
                    <div class="box">
                        <span class="fw-bold">PERUBAHAN DATA</span>
                        <span class="d-block smaller p-2">SILAHKAN ISI CATATAN PERUBAHAN DATA, MISALNYA PERUBAHAN PENDIDIKAN ATAU PEKERJAAN</span>
                    </div>
                    <div class="box">
                        <span class="fw-bold">DOKUMEN PENDUKUNG PERUBAHAN DATA</span>
                        <span class="d-block smaller p-2">UNGGAH DOKUMEN PENDUKUNG PERUBAHAN DATA, CONTOH: IJAZAH TERAKHIR DAN LAIN SEBAGAINYA</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="fixed-bottom progress" style="height:6px;">
    <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
</div>

<script src="/assets/js/middleware.js"></script>
<script src="/assets/js/register.js"></script>