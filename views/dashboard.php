<div class="container-fluid">
    <div class="fixed-top progress" style="height:3px;">
        <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
    </div>
    <div class="row">
        <div class="col-md-12 bg-white p-3 small">
            <div class="row justify-content-around">
                <div class="col-md-2">
                    <div class="border-start border-dark border-5">
                        <div class="ms-4">
                            PERMOHONAN
                            <span class="d-block fs-3"><?= $params->totalProduct ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="border-start border-danger border-5">
                        <div class="ms-4">
                            VERIFIKASI
                            <span class="d-block fs-3"><?= $params->totalVerify ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="border-start border-warning border-5">
                        <div class="ms-4">
                            VALIDASI
                            <span class="d-block fs-3"><?= $params->totalValidation ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="border-start border-primary border-5">
                        <div class="ms-4">
                            DIPROSES
                            <span class="d-block fs-3"><?= $params->totalProcess ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="border-start border-success border-5">
                        <div class="ms-4">
                            SELESAI
                            <span class="d-block fs-3"><?= $params->totalComplete ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="sticky-top">
                <div class="p-3">
                    <div id="result-info" class="p-2 mb-2 small"></div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input id="form-search" type="text" class="form-control text-uppercase" placeholder="PENCARIAN" autocomplete="off">
                            <label for="floatingInput">MASUKKAN NAMA ATAU NIK</label>
                        </div>
                    </div>
                    <?php if ($_SESSION['user_level'] == 1) { ?>
                        <div class="mb-3">
                            <div class="form-floating">
                                <select id="form-user" class="form-control">
                                    <option value="">==PILIHAN==</option>
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
                                <label for="kua">KUA KECAMATAN</label>
                            </div>
                        </div>
                    <?php  } ?>
                    <div class="mb-3">
                        <div class="form-floating">
                            <select id="form-status" class="form-control">
                                <option value="">==PILIHAN==</option>
                                <option value="0">MENUNGGU VERIFIKASI</option>
                                <option value="1">MENUNGGU INFORMASI PERNIKAHAN</option>
                                <option value="2">MENUNGGU PROSES DOKUMEN</option>
                                <option value="3">DOKUMEN SELESAI</option>
                                <option value="4">DALAM PROSES</option>
                            </select>
                            <label for="kua">STATUS PERMOHONAN</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="p-3 table-responsive">
                <table class="table table-borderless table-hover">
                    <tbody id="product-result" class="text-uppercase">
                        <div id="loading" class="text-center">
                            <div class="lds-ripple">
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/dashboard.js"></script>