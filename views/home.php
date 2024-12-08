<div class="container">
    <div class="content-home">
        <div class="text-center p-5">
            <div class="fs-1 logo fw-bold text-primary">
                Pengantin
            </div>
            <div class="smaller text-secondary">
                Pengurusan Administrasi Pernikahan Terintegrasi
            </div>
        </div>
        <div class="p-3 mb-4">
            <div class="row">
                <div class="col-md-3">
                    <div class="border-start border-danger border-5">
                        <div class="ms-3">
                            <span>TOTAL PERMOHONAN</span>
                            <span class="d-block fs-3"><?= $params->totalProduct ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border-start border-warning border-5">
                        <div class="ms-3">
                            <span>VERIFIKASI DUKCAPIL</span>
                            <span class="d-block fs-3"><?= $params->totalVerify ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border-start border-primary border-5">
                        <div class="ms-3">
                            <span>PELAKSANAAN NIKAH</span>
                            <span class="d-block fs-3"><?= $params->totalProcess ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border-start border-success border-5">
                        <div class="ms-3">
                            <span>DOKUMEN DIPROSES</span>
                            <span class="d-block fs-3"><?= $params->totalComplete ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-3 border-top mb-5">
            <div class="row">
                <?php
                foreach ($params->totalByUser as $key => $value) {
                    echo '<div class="col-md-3">
                                    <div class="my-4 border-start border-1">
                                    <div class="ms-3">
                                    <span class="kua-name small">' . NameByUser(($key + 2)) . '</span>
                                    <span class="d-block fs-4">' . $value . '</span>
                                    </div>
                                    </div>
                                </div>';
                }

                function NameByUser($id)
                {
                    switch ($id) {
                        case 2:
                            return "TAPIN UTARA";
                            break;
                        case 3:
                            return "TAPIN TENGAH";
                            break;
                        case 4:
                            return "TAPIN SELATAN";
                            break;
                        case 5:
                            return "BAKARANGAN";
                            break;
                        case 6:
                            return "BUNGUR";
                            break;
                        case 7:
                            return "LOKPAIKAT";
                            break;
                        case 8:
                            return "PIANI";
                            break;
                        case 9:
                            return "SALAM BABARIS";
                            break;
                        case 10:
                            return "HATUNGUN";
                            break;
                        case 11:
                            return "BINUANG";
                            break;
                        case 12:
                            return "CANDI LARAS SELATAN";
                            break;
                        case 13:
                            return "CANDI LARAS UTARA";
                            break;
                        default:
                            return "ADMIN";
                            break;
                    }
                }
                ?>
            </div>
        </div>
        <div class="text-center my-5">
            <input type="hidden" id="capcay" value="<?= $params->captcha ?>">
            <input type="hidden" id="csrf-token" value="<?= $params->csrfToken ?>">
            <button id="login" class="btn btn-primary btn-lg w-100 m-2 rounded-0">
                MASUK
            </button>
            <button class="btn btn-success btn-lg w-100 m-2 rounded-0" onclick="window.location.href='/register'">
                DAFTAR
            </button>
        </div>
    </div>
    <div class="fixed-bottom">
        <div class="p-3 text-center smaller text-muted">
            &copy; 2024 - DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL KABUPATEN TAPIN
        </div>
    </div>
</div>
<script src="/assets/js/login.js"></script>