<div class="fixed-top progress" style="height:4px;">
    <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
</div>
<div class="bg-white p-3 d-flex justify-content-between align-items-center small sticky-top">
    <div class="d-flex align-items-center">
        <div class="me-4">
            <span class="me-2">STATUS :</span>
            <?= nameByStatus($params->product->id_status) ?>
        </div>
        <div class="me-4">
            <span class="me-2">TANGGAL INPUT :</span>
            <span id="product-date" class="fw-bold"><?= formatDate($params->product->created) ?></span>
        </div>
        <?php
        if ($_SESSION['user_level'] == 1 && $params->product->id_status == 0) {
            echo '<div class="me-4"><button id="formulir-print" data-pid="' . $params->product->id . '" class="btn btn-outline-primary small btn-sm rounded-0"><i class="bi bi-printer-fill me-1"></i> CETAK FORMULIR</button></div>';
        }
        ?>

    </div>
    <div>
        <button class="btn btn-link small btn-sm text-decoration-none" onclick="window.location.href='/dashboard'"><i class="bi bi-list-ul me-1"></i> DAFTAR PERMOHONAN</button>
    </div>
</div>
<div class="container-fluid">
    <div class="product-detail">
        <div class="bg-white my-2">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pg-tab" data-bs-toggle="tab" data-bs-target="#pg-tab-pane" type="button" role="tab" aria-controls="pg-tab-pane" aria-selected="true">
                        <i class="bi bi-card-text me-1"></i>
                        DATA PENGANTIN
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pn-tab" data-bs-toggle="tab" data-bs-target="#pn-tab-pane" type="button" role="tab" aria-controls="pn-tab-pane" aria-selected="false">
                        <i class="bi bi-card-list me-1"></i>
                        DATA PERNIKAHAN
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="dk-tab" data-bs-toggle="tab" data-bs-target="#dk-tab-pane" type="button" role="tab" aria-controls="dk-tab-pane" aria-selected="false">
                        <i class="bi bi-card-heading me-1"></i>
                        DOKUMEN
                    </button>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="pg-tab-pane" role="tabpanel" aria-labelledby="pg-tab" tabindex="0">
                <div class="bg-white p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle">
                                    <tr class="bg-primary bg-opacity-10 border-primary text-primary">
                                        <td colspan="2">
                                            <i class="bi bi-person-vcard mx-1"></i>
                                            DATA LAKI-LAKI
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">NIK</td>
                                        <td class="col-9">
                                            <input autocomplete="off" id="lk-nik" type="text" class="form-control" value="<?= $params->product->lk_nik ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">NO. KARTU KELUARGA</td>
                                        <td>
                                            <input autocomplete="off" id="lk-kk" type="text" class="form-control" value="<?= $params->product->lk_kk ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">NAMA</td>
                                        <td>
                                            <input autocomplete="off" id="lk-name" type="text" class="form-control" value="<?= $params->product->lk_name ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">ALAMAT</td>
                                        <td>
                                            <input autocomplete="off" id="lk-address" type="text" class="form-control" value="<?= $params->product->lk_address ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">NO. TELEPON</td>
                                        <td>
                                            <input autocomplete="off" id="lk-phone" type="text" class="form-control" value="<?= $params->product->lk_phone ?: '-' ?>">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle">
                                    <tr class="bg-danger bg-opacity-10 border-danger text-danger">
                                        <td colspan="2">
                                            <i class="bi bi-person-vcard mx-1"></i>
                                            DATA PEREMPUAN
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">NIK</td>
                                        <td class="col-9">
                                            <input autocomplete="off" id="pr-nik" type="text" class="form-control" value="<?= $params->product->pr_nik ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">NO. KARTU KELUARGA</td>
                                        <td>
                                            <input autocomplete="off" id="pr-kk" type="text" class="form-control" value="<?= $params->product->pr_kk ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">NAMA</td>
                                        <td>
                                            <input autocomplete="off" id="pr-name" type="text" class="form-control" value="<?= $params->product->pr_name ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">ALAMAT</td>
                                        <td>
                                            <input autocomplete="off" id="pr-address" type="text" class="form-control" value="<?= $params->product->pr_address ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">NO. TELEPON</td>
                                        <td>
                                            <input autocomplete="off" id="pr-phone" type="text" class="form-control" value="<?= $params->product->pr_phone ?: '-' ?>">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12 border-top">
                            <div class="row my-4">
                                <div class="col-md-6">
                                    <div class="border">
                                        <div class="form-floating">
                                            <textarea id="notes" class="form-control" placeholder="CATATAN" style="height:150px" spellcheck="false""><?= formatNotes($params->product->notes) ?: '-' ?></textarea>
                                            <label for=" notes">CATATAN</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="border">
                                        <div class="form-floating">
                                            <textarea id="address" class="form-control" placeholder="ALAMAT BARU" style="height:150px" spellcheck="false"><?= formatNotes($params->product->address) ?: '-' ?></textarea>
                                            <label for="notes">ALAMAT BARU</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 border-top p-4">
                            <div class="row justify-content-around">
                                <div class="col-md-4">
                                    <img class="images-lk w-100 button-view-image" src="<?= filePath($params->product->lk_file) ?>" alt="BIODATA LAKI-LAKI">
                                </div>
                                <div class="col-md-4">
                                    <img class="images-pr w-100 button-view-image" src="<?= filePath($params->product->pr_file) ?>" alt="BIODATA PEREMPUAN">
                                </div>
                                <?php if ($_SESSION['user_level'] == 1 && $params->product->id_status == 0) { ?>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-start gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="lk" checked>
                                                <label class="form-check-label" for="exampleRadios1">
                                                    LAKI-LAKI
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="pr">
                                                <label class="form-check-label" for="exampleRadios2">
                                                    PEREMPUAN
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div class="dropzone dropzone-biodata">
                                                <div class="file-biodata-upload-button text-primary">PILIH GAMBAR</div>
                                                <input type="file" class="file-biodata-input" style="display: none;">
                                                <input type="hidden" id="pid" value="<?= $params->product->id ?>">
                                                <input type="hidden" id="logs" value="<?= $params->product->logs ?>">
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pn-tab-pane" role="tabpanel" aria-labelledby="pn-tab" tabindex="0">
                <?php if ($params->product->id_status == 1) { ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box">
                                <img src="<?= filePath($params->product->bk_file) ?>" alt="" class="images-bk button-view-image w-100">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box">
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle">
                                        <tr>
                                            <td>TANGGAL NIKAH</td>
                                            <td class="col-8">
                                                <input autocomplete="off" id="bk-date" type="date" class="form-control" value="<?= $params->product->bk_date ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>NO. BUKU NIKAH</td>
                                            <td class="col-8">
                                                <input autocomplete="off" id="bk-number" type="text" class="form-control" value="<?= $params->product->bk_number ?: '-' ?>">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="box mt-2">
                                <div class="mb-3 required">UNGGAH FOTO BUKU NIKAH</div>
                                <div class="dropzone dropzone-bk">
                                    <div class="file-bk-upload-button text-primary">PILIH GAMBAR</div>
                                    <input type="hidden" id="pid" value="<?= $params->product->id ?>">
                                    <input type="hidden" id="logs" value="<?= $params->product->logs ?>">
                                    <input type="file" class="file-bk-input" style="display: none;">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } else if ($params->product->id_status == 0) {
                    echo '<div class="alert alert-warning mt-2"><div class="text-center">MENUNGGU PERMOHONAN DIVERIFIKASI</div></div>';
                } else if ($params->product->id_status == 2 || $params->product->id_status == 3 || $params->product->id_status == 4) { ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box">
                                <img src="<?= filePath($params->product->bk_file) ?>" alt="" class="images-bk button-view-image w-100">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box">
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle">
                                        <tr>
                                            <td>TANGGAL NIKAH</td>
                                            <td class="col-8">
                                                <input autocomplete="off" id="bk-date" type="date" class="form-control" value="<?= $params->product->bk_date ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>NO. BUKU NIKAH</td>
                                            <td class="col-8">
                                                <input autocomplete="off" id="bk-number" type="text" class="form-control" value="<?= $params->product->bk_number ?: '-' ?>">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="tab-pane fade" id="dk-tab-pane" role="tabpanel" aria-labelledby="dk-tab" tabindex="0">
                <?php
                if ($params->files) {
                    echo '<div class="box"><div class="row">';
                    foreach ($params->files as $file) {
                        if ($file->category >= 3) {
                            echo '<div class="col-md-3"><img src="' . filePath($file->path) . '" alt="" class="images-doc img-thumbnail button-view-image w-100"><div class="p-3">' . fileCategory($file->category) . '</div></div>';
                        }
                    }
                    echo '</div></div>';
                } else {
                    echo '<div class="alert alert-primary mt-2"><div class="text-center">TIDAK ADA DOKUMEN TAMBAHAN</div></div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>


<?php
if ($_SESSION['user_level'] == 1) {
    switch ($params->product->id_status) {
        case 0:
            echo '<div class="fixed-bottom text-end"><div class="p-3 bg-light border-top"><button id="product-verif" data-pid="' . $params->product->id . '" class="btn btn-success"><i class="me-1 bi bi-check-square"></i> VERIFIKASI</button><button id="product-update"  data-pid="' . $params->product->id . '" class="mx-2 btn btn-primary"><i class="me-1 bi bi-pencil-square"></i> UBAH</button><button id="product-delete" data-pid="' . $params->product->id . '" class="btn btn-danger"><i class="me-1 bi bi-trash-fill"></i> HAPUS</button></div></div>';
            break;
        case 1:
            echo '<div class="fixed-bottom text-end"><div class="p-3 bg-light border-top"><button id="product-update"  data-pid="' . $params->product->id . '" class="btn btn-primary me-2"><i class="me-1 bi bi-pencil-square"></i> UBAH</button><button id="product-delete" data-pid="' . $params->product->id . '" class="btn btn-danger me-2"><i class="me-1 bi bi-trash-fill"></i> HAPUS</button><button id="product-valid" data-pid="' . $params->product->id . '" class="btn btn-warning"><i class="me-1 bi bi-at"></i> AJUKAN</button></div></div>';
            break;
        case 2:
            echo '<div class="fixed-bottom text-end"><div class="p-3 bg-light border-top"><button id="product-done" data-pid="' . $params->product->id . '" class="btn btn-success me-2"><i class="me-1 bi bi-check-all"></i> DOKUMEN SELESAI</button><button id="product-self" data-pid="' . $params->product->id . '" class="btn btn-warning me-2"><i class="me-1 bi bi-arrow-right-short"></i> MENGURUS SENDIRI</button><button id="product-process" data-pid="' . $params->product->id . '" class="btn btn-dark"><i class="me-1 bi bi-hash"></i> DALAM PROSES</button></div></div>';
            break;
        case 3:
            echo '<div class="fixed-bottom text-end"><div class="p-3 bg-light border-top"><button id="send-notif" class="btn btn-success"><i class="me-1 bi bi-send-fill"></i> NOTIFIKASI</button></div></div>';
            break;
        case 4:
            echo '<div class="fixed-bottom text-end"><div class="p-3 bg-light border-top"><button id="product-done" data-pid="' . $params->product->id . '" class="btn btn-success"><i class="me-1 bi bi-check-all"></i> DOKUMEN SELESAI</button></div></div>';
            break;
    }
} else {
    switch ($params->product->id_status) {
        case 1:
            echo '<div class="fixed-bottom text-end"><div class="p-3 bg-light border-top"><button id="product-valid" data-pid="' . $params->product->id . '" class="btn btn-primary disabled"><i class="me-1 bi bi-at"></i> AJUKAN</button></div></div>';
            break;
    }
}

function nameByStatus($id)
{
    switch ($id) {
        case 0:
            return '<span class="bg-danger text-white small p-2">MENUNGGU VERIFIKASI</span>';
            break;
        case 1:
            return '<span class="bg-warning text-dark small p-1">MENUNGGU INFORMASI PERNIKAHAN</span>';
            break;
        case 2:
            return '<span class="bg-primary text-white small p-1">MENUNGGU PROSES DOKUMEN</span>';
            break;
        case 3:
            return '<span class="bg-success text-white small p-1">DOKUMEN SELESAI</span>';
            break;
        case 4:
            return '<span class="bg-dark text-white small p-1">DALAM PROSES</span>';
            break;
        case 5:
            return '<span class="bg-self text-white small p-1">MENGURUS SENDIRI</span>';
            break;
        default:
            return '<span class="bg-danger text-white small p-1">MENUNGGU VERIFIKASI</span>';
            break;
    }
}

function formatDate($timestamp)
{
    $date = new DateTime($timestamp);
    return $date->format('Y-m-d');
}

function filePath($path)
{
    if (!$path) {
        return '/assets/img/thumb.jpg';
    } else {
        return '/files/' . $path;
    }
}

function formatNotes($string)
{
    $string = htmlspecialchars($string);
    $string = preg_replace("/\r\n|\r|\n/", "\n", $string);
    return $string;
}

function fileCategory($value)
{
    switch ($value) {
        case "3":
            return "IJAZAH TERAKHIR";
            break;
        case "4":
            return "SK PEGAWAI";
            break;
        case "5":
            return "DOKUMEN LAINNYA";
            break;
        default:
            return "DOKUMEN LAINNYA";
            break;
    }
}
?>

<iframe id="printFrame" frameborder="0" style="display:none !important;"></iframe>
<script src="/assets/js/middleware.js"></script>
<script src="/assets/js/detail.js"></script>
<script src="/assets/js/bk.upload.js"></script>
<script src="/assets/js/bt.upload.js"></script>