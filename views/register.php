<div class="header">
    <div class="fs-4 fw-bold">PENGANTIN</div>
    <div class="small text-warning">Pengurusan Administrasi Pernikahan Terintegrasi</div>
</div>
<div class="container">
    <div class="mb-3">
        <div class="fs-5">FORMULIR PENDAFTARAN</div>
    </div>
    <div id="register-form" data-pid="<?= $params->pid; ?>" data-temp="<?= $params->logs; ?>">
        <div class="bg-white p-3 mb-3">
            <div class="p-2 fw-bold">
                KUA WILAYAH
            </div>
            <div class="form-floating">
                <select id="kua" class="form-select rounded-0" required>
                    <option value="0">==PILIHAN==</option>
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
        <div class="bg-white p-3 mb-3 input-custom">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <div class="p-2 fw-bold">
                            BIODATA LAKI-LAKI
                        </div>
                        <div class="box-sub">
                            <div class="form-floating mb-2">
                                <input type="text" autocomplete="off" class="form-control rounded-0" placeholder="NIK"
                                    name="lk-nik" id="lk-nik" maxlength="16" required>
                                <label for="floatingInput">NOMOR INDUK KEPENDUDUKAN</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" autocomplete="off" class="form-control rounded-0" placeholder="KK"
                                    name="lk-kk" id="lk-kk" maxlength="16" required>
                                <label for="floatingInput">NOMOR KARTU KELUARGA</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" autocomplete="off" class="form-control rounded-0" placeholder="NAMA"
                                    name="lk-name" id="lk-name" required>
                                <label for="floatingInput">NAMA LENGKAP</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" autocomplete="off" class="form-control rounded-0" placeholder="TELEPON"
                                    name="lk-phone" id="lk-phone" maxlength="14" required>
                                <label for="floatingInput" class="required">NOMOR TELEPON (WHATSAPP)</label>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control rounded-0" placeholder="ALAMAT" name="lk-address" id="lk-address"
                                    style="height: 150px;" required></textarea>
                                <label for="floatingInput">ALAMAT TINGGAL (DI KARTU KELUARGA)</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-2 fw-bold">
                        BIODATA PEREMPUAN
                    </div>
                    <div class="box-sub">
                        <div class="form-floating mb-2">
                            <input type="text" autocomplete="off" class="form-control rounded-0" placeholder="NIK"
                                name="pr-nik" id="pr-nik" maxlength="16" required>
                            <label for="floatingInput">NOMOR INDUK KEPENDUDUKAN</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" autocomplete="off" class="form-control rounded-0" placeholder="KK"
                                name="pr-kk" id="pr-kk" maxlength="16" required>
                            <label for="floatingInput">NOMOR KARTU KELUARGA</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" autocomplete="off" class="form-control rounded-0" placeholder="NAMA"
                                name="pr-name" id="pr-name" required>
                            <label for="floatingInput">NAMA LENGKAP</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" autocomplete="off" class="form-control rounded-0" placeholder="TELEPON"
                                name="pr-phone" id="pr-phone" maxlength="14" required>
                            <label for="floatingInput" class="required">NOMOR TELEPON (WHATSAPP)</label>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control rounded-0" placeholder="ALAMAT" name="pr-address" id="pr-address"
                                style="height: 150px;" required></textarea>
                            <label for="floatingInput">ALAMAT TINGGAL (DI KARTU KELUARGA)</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white p-3 mb-3 input-custom">
            <div class="p-2 fw-bold">ALAMAT BARU</div>
            <div class="form-floating mb-2">
                <input type="text" autocomplete="off" class="form-control rounded-0" name="addr-street" id="addr-street"
                    placeholder="NAMA JALAN">
                <label for="floatingInput">NAMA JALAN</label>
            </div>
            <div class="input-group">
                <div class="form-floating mb-2">
                    <input type="text" autocomplete="off" class="form-control rounded-0" name="addr-rt" id="addr-rt" placeholder="RT"
                        maxlength="3">
                    <label for="floatingInput">RT</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="text" autocomplete="off" class="form-control rounded-0" name="addr-rw" id="addr-rw" placeholder="RW"
                        maxlength="3">
                    <label for="floatingInput">RW</label>
                </div>
            </div>
            <div class="input-group">
                <div class="form-floating mb-2">
                    <input type="text" autocomplete="off" class="form-control rounded-0" name="addr-ds" id="addr-ds" placeholder="DESA">
                    <label for="floatingInput">KEL/DESA</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="text" autocomplete="off" class="form-control rounded-0" name="addr-kec" id="addr-kec"
                        placeholder="KECAMATAN">
                    <label for="floatingInput">KECAMATAN</label>
                </div>
            </div>
        </div>
        <div class="bg-white p-3 mb-3">
            <div class="p-2 fw-bold">
                PERUBAHAN DATA
            </div>
            <div class="mb-4">
                <div class="form-floating input-custom">
                    <textarea class="form-control rounded-0" placeholder="CATATAN" style="height: 150px;"
                        name="notes" id="notes"></textarea>
                    <label for="floatingInput" class="required">PENDIDIKAN / PEKERJAAN / GOLONGAN DARAH</label>
                </div>
            </div>
            <div class="p-2 fw-bold">
                DOKUMEN PENDUKUNG
            </div>
            <div class="form-floating mb-2">
                <select name="category" id="file-category" class="form-select rounded-0">
                    <option value="0">==PILIHAN==</option>
                    <option value="3">IJAZAH TERAKHIR (PENDIDIKAN)</option>
                    <option value="4">SK PEGAWAI (PEKERJAAN)</option>
                    <option value="5">LAINNYA</option>
                </select>
                <label for="floatingInput">KATEGORI</label>
            </div>
            <div class="form-floating mb-3">
                <input type="file" id="file-upload" class="form-control rounded-0" accept="image/jpeg, image/png">
                <label for="files">UNGGAH GAMBAR</label>
            </div>
            <div id="file-result" class="mt-2 list-group list-group-numbered"></div>
        </div>
        <div class="mb-3">
            <div class="bg-white p-3">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="w-50 text-center">
                        <span class="fw-bold fs-3 fst-captcha" id="captchaCode"></span>
                        <button id="captchaRefresh" class="btn btn-link"><i class="bi bi-arrow-clockwise"></i></button>
                    </div>
                    <div>
                        <input type="text" class="form-control rounded-0 form-control-lg" id="captchaInput"
                            placeholder="Kode Captcha">
                    </div>
                </div>
            </div>
            <div class="p-3">
                <ul class="small">
                    <li>Tanda <i class="text-danger">*</i> Wajib diisi.</li>
                    <li>Dengan mendaftar, anda menyetujui semua persyaratan dan ketentuan yang
                        berlaku.</li>
                </ul>
            </div>
            <button id="submit-form" class="btn btn-primary btn-lg w-100 rounded-0" type="submit" disabled>DAFTAR</button>
        </div>
    </div>
</div>

<script>
    createCaptcha();

    function createCaptcha() {
        const captcha = Math.random().toString(36).substr(2, 5).toUpperCase();
        $("#captchaCode").text(captcha);
    }

    $("#captchaRefresh").on("click", function() {
        createCaptcha();
    })

    $("#captchaInput").on("input", function() {
        const captchaInput = $(this).val();
        const captchaCode = $("#captchaCode").text();
        if (captchaInput.toUpperCase() == captchaCode.toUpperCase()) {
            $("#submit-form").removeAttr("disabled");
        } else {
            $("#submit-form").attr("disabled", true);
        }
    })
</script>
<script src="/assets/js/middleware.js"></script>
<script src="/assets/js/register.js"></script>