storeItem("/products");

function storeItem(url, params) {
  $.ajax({
    url,
    type: "POST",
    data: params,
    beforeSend: function () {
      $("#progressBar").attr("aria-valuenow", 0);
      $("#progressBar").css("width", "0%");
    },
    xhr: function () {
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener("progress", function (evt) {
        if (evt.lengthComputable) {
          var percentComplete = (evt.loaded / evt.total) * 100;
          $("#progressBar").attr("aria-valuenow", percentComplete);
          $("#progressBar").css("width", percentComplete + "%");
        }
      });
      return xhr;
    },
    success: function (response) {
      $("#loading").remove();

      const result = JSON.parse(response);
      $.each(result.data, function (i, row) {
        $("#product-result").append(`<tr class="product-item bg-white" data-pid="${row.id}"><td class="align-middle p-4"><div class="small">${formatDate(row.date_created)}</div><div class="mt-2 smaller">${nameByStatus(row.id_status)}</div></td><td class="align-middle"><div class="fw-bold">${row.lk_name}</div><div class="small">${row.lk_nik}</div><div class="smaller text-muted">${row.lk_address}</div></td><td class="align-middle"><div class="fw-bold">${row.pr_name}</div><div class="small">${row.pr_nik}</div><div class="smaller text-muted">${row.pr_address}</div></td><td class="align-middle">${nameByUser(row.id_user)}</td></tr>`);
      });
      const foundItem = result.data;
      const totalItem = result.totalItem;

      if (typeof totalItem === "object") {
        totalItem = totalItem.count || foundItem.length;
      }

      if (foundItem.length < 1) {
        notify("DATA TIDAK DITEMUKAN");
      } else {
        notify("MEMUAT DATA");
      }

      $("#result-info").html(
        `<i class="bi bi-list-ul me-1"></i> TOTAL PERMOHONAN : ${totalItem}`
      );

      localStorage.setItem("currentPage", result.currentPage);
      localStorage.setItem("totalPage", result.totalPage);

      $(".product-item").click(function () {
        const pid = $(this).data("pid");
        return location.replace(`/detail/${pid}`);
      });
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });

  function nameByUser(id) {
    switch (id) {
      case 1:
        return "ADMIN";
        break;
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
    }
  }

  function nameByStatus(id) {
    switch (id) {
      case 0:
        return '<span class="bg-danger text-white smaller p-1">MENUNGGU VERIFIKASI</span>';
        break;
      case 1:
        return '<span class="bg-warning text-dark smaller p-1">MENUNGGU INFORMASI PERNIKAHAN</span>';
        break;
      case 2:
        return '<span class="bg-primary text-white smaller p-1">MENUNGGU PROSES DOKUMEN</span>';
        break;
      case 3:
        return '<span class="bg-success text-white smaller p-1">DOKUMEN SELESAI</span>';
        break;
      case 4:
        return '<span class="bg-dark text-white smaller p-1">DALAM PROSES</span>';
        break;
      case 5:
        return '<span class="bg-self text-white smaller p-1">MENGURUS SENDIRI</span>';
        break;
      default:
        return '<span class="bg-danger text-white smaller p-1">MENUNGGU VERIFIKASI</span>';
        break;
    }
  }

  function formatDate(timestamp) {
    const date = new Date(timestamp);
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, "0");
    const day = String(date.getDate()).padStart(2, "0");
    return `${year}-${month}-${day}`;
  }
}

$("#form-search").change(function () {
  $("#product-result").empty();

  const keyword = $(this).val();

  storeItem("/product/search", { keyword: keyword.toUpperCase() });
});

$("#form-user").change(function () {
  $("#product-result").empty();

  const user = $(this).val();
  const status = $("#form-status").val();

  storeItem("/products", { user, status });
});

$("#form-status").change(function () {
  $("#product-result").empty();
  const user = $("#form-user").val();
  const status = $(this).val();

  storeItem("/products", { user, status });
});

$(window).scroll(function () {
  if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
    const totalPage = parseInt(localStorage.getItem("totalPage"));
    const currentPage = parseInt(localStorage.getItem("currentPage"));
    const params = {
      page: currentPage + 1,
      status: $("#form-status").val(),
      user: $("#form-user").val(),
    };

    if (currentPage < totalPage) {
      storeItem("/products", params);
      notify("MEMUAT DATA");
    } else notify("MENAMPILKAN SEMUA DATA");
  }
});

function notify(message) {
  Swal.fire({
    position: "bottom-end",
    icon: "success",
    title: message,
    toast: true,
    timer: 5000,
    timerProgressBar: true,
    showConfirmButton: false,
  });
}
