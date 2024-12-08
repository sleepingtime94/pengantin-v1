<?php
function formatDate($dateString)
{
    $date = new DateTime($dateString);
    $months = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];

    $day = $date->format('j');
    $month = $date->format('n');
    $year = $date->format('Y');
    $monthName = $months[(int)$month];
    $formattedDate = "$day $monthName $year";

    return $formattedDate;
}

function nameByUser($id)
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMULIR</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.12.4/sweetalert2.min.css" integrity="sha512-WxRv0maH8aN6vNOcgNFlimjOhKp+CUqqNougXbz0E+D24gP5i+7W/gcc5tenxVmr28rH85XHF5eXehpV2TQhRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js" integrity="sha512-7Pi/otdlbbCR+LnW+F7PwFcSDJOuUJB3OxtEHbg4vSMvzvJjde4Po1v4BR9Gdc9aXNUNFVUY+SK51wWT8WF0Gg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.12.4/sweetalert2.all.min.js" integrity="sha512-aRyxRCMzAorfKGjEjnSeGTVKrI/2irvvR5DI38LV/JXOkL9VLnZ+rfFkD9i1UTWTB8e8W5vpf7SjDsfMOdNosg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="p-5">
            <div class="mb-3 text-center fw-bold fs-5">
                FORMULIR PERMINTAAN PERUBAHAN DATA KEPENDUDUKAN INOVASI PENGANTIN
            </div>
            <div class="table-responsive">
                <table class="table table-bordered align-middle border-dark text-uppercase small">
                    <tr>
                        <td class="col fw-bold">TANGGAL PENGAJUAN</td>
                        <td class="col-8"><?= formatDate($params->created) ?></td>
                    </tr>
                    <tr>
                        <td class="col fw-bold">KUA</td>
                        <td class="col-8"><?= nameByUser($params->id_user) ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="fw-bold bg-secondary-subtle">
                            DATA LAKI-LAKI
                        </td>
                    </tr>
                    <tr>
                        <td class="col fw-bold">NAMA</td>
                        <td class="col-8"><?= $params->lk_name ?></td>
                    </tr>
                    <tr>
                        <td class="col fw-bold">NIK</td>
                        <td class="col-8"><?= $params->lk_nik ?></td>
                    </tr>
                    <tr>
                        <td class="col fw-bold">NO. KARTU KELUARGA</td>
                        <td class="col-8"><?= $params->lk_kk ?></td>
                    </tr>
                    <tr>
                        <td class="col fw-bold">ALAMAT</td>
                        <td class="col-8"><?= $params->lk_address ?></td>
                    </tr>
                    <tr>
                        <td class="col fw-bold">NO. TELEPON</td>
                        <td class="col-8"><?= $params->lk_phone ?: '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="fw-bold bg-secondary-subtle">
                            DATA PEREMPUAN
                        </td>
                    </tr>
                    <tr>
                        <td class="col fw-bold">NAMA</td>
                        <td class="col-8"><?= $params->pr_name ?></td>
                    </tr>
                    <tr>
                        <td class="col fw-bold">NIK</td>
                        <td class="col-8"><?= $params->pr_nik ?></td>
                    </tr>
                    <tr>
                        <td class="col fw-bold">NO. KARTU KELUARGA</td>
                        <td class="col-8"><?= $params->pr_kk ?></td>
                    </tr>
                    <tr>
                        <td class="col fw-bold">ALAMAT</td>
                        <td class="col-8"><?= $params->pr_address ?></td>
                    </tr>
                    <tr>
                        <td class="col fw-bold">NO. TELEPON</td>
                        <td class="col-8"><?= $params->pr_phone ?: '-' ?></td>
                    </tr>
                    <tr>
                        <td class="col fw-bold">CATATAN</td>
                        <td class="col-8"><?= nl2br($params->notes) ?: '-' ?></td>
                    </tr>
                    <tr>
                        <td class="col fw-bold">ALAMAT BARU</td>
                        <td class="col-8"><?= $params->address ?: '-' ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>