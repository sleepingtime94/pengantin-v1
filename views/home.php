<div class="header">
    <div class="fs-4 fw-bold">PENGANTIN</div>
    <div class="small text-warning">Pengurusan Administrasi Pernikahan Terintegrasi</div>
</div>
<div class="container-fluid">
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover bg-white">
                        <thead>
                            <th class="p-3 fw-bold">NAMA KUA</th>
                            <th class="p-3 fw-bold text-center">JUMLAH PERMOHONAN</th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($params->totalByUser as $key => $value) {
                                echo '<tr class="align-middle">
                                <td class="p-3 w-50">' . NameByUser(($key + 2)) . '</td>
                                <td class="p-3 text-center">' . $value . '</td></tr>';
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
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-5">
                    <div class="mb-3 border-start border-5 border-secondary">
                        <div class="p-4 bg-white">
                            <div class="small">TOTAL PERMOHONAN</div>
                            <div class="fs-1 text-secondary"><?= $params->totalProduct ?></div>
                        </div>
                    </div>
                    <div class="mb-3 border-start border-5 border-danger">
                        <div class="p-4 bg-white">
                            <div class="small">VERIFIKASI DUKCAPIL</div>
                            <div class="fs-1 text-danger"><?= $params->totalVerify ?></div>
                        </div>
                    </div>
                    <div class="mb-3 border-start border-5 border-primary">
                        <div class="p-4 bg-white">
                            <div class="small">PELAKSANAAN NIKAH</div>
                            <div class="fs-1 text-primary"><?= $params->totalProcess ?></div>
                        </div>
                    </div>
                    <div class="mb-3 border-start border-5 border-success">
                        <div class="p-4 bg-white">
                            <div class="small">DOKUMEN DIPROSES</div>
                            <div class="fs-1 text-success"><?= $params->totalComplete ?></div>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <input type="hidden" id="capcay" value="<?= $params->captcha ?>">
                    <input type="hidden" id="csrf-token" value="<?= $params->csrfToken ?>">
                    <button class="btn btn-info btn-lg w-100 rounded-0 text-white d-block"
                        id="login">LOGIN</button>
                    <button class="btn btn-success btn-lg w-100 rounded-0 text-white mt-3 d-block"
                        onclick="location.href='/register'">REGISTRASI</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/assets/js/login.js"></script>