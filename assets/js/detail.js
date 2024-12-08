$("#formulir-print").click(function (e) {
  e.preventDefault();
  const pid = $(this).data("pid");
  const url = `/formulir/${pid}`;
  var iframe = document.getElementById("printFrame");

  iframe.src = url;
  iframe.onload = function () {
    iframe.contentWindow.focus();
    iframe.contentWindow.print();
  };
});

$("#product-update").click(function (e) {
  e.preventDefault();
  const id = $(this).data("pid");
  const lk_nik = $("#lk-nik").val();
  const lk_kk = $("#lk-kk").val();
  const lk_name = $("#lk-name").val();
  const lk_phone = $("#lk-phone").val();
  const lk_address = $("#lk-address").val();
  const pr_nik = $("#pr-nik").val();
  const pr_kk = $("#pr-kk").val();
  const pr_name = $("#pr-name").val();
  const pr_phone = $("#pr-phone").val();
  const pr_address = $("#pr-address").val();
  const notes = $("#notes").val();
  const new_address = $("#address").val();

  $.ajax({
    type: "POST",
    url: "/product/update",
    data: {
      id,
      lk_nik,
      lk_kk,
      lk_name: lk_name.toUpperCase(),
      lk_phone,
      lk_address: lk_address.toUpperCase(),
      pr_nik,
      pr_kk,
      pr_name: pr_name.toUpperCase(),
      pr_phone,
      pr_address: pr_address.toUpperCase(),
      address: new_address.toUpperCase(),
      notes: notes.toUpperCase(),
    },
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
      Swal.fire({
        icon: "success",
        title: "DATA BERHASIL DIUBAH",
        timer: 3000,
        showConfirmButton: false,
        timerProgressBar: false,
        allowOutsideClick: false,
        backdrop: `rgb(255, 255, 255)`,
      }).then(() => {
        location.reload();
      });
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
});

$("#product-delete").click(function (e) {
  e.preventDefault();
  const pid = $(this).data("pid");
  Swal.fire({
    title: "HAPUS PERMOHONAN?",
    text: "DATA PERMOHONAN AKAN DIHAPUS PERMANEN",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#e74337",
    cancelButtonColor: "#0081a7",
    confirmButtonText: "HAPUS",
    cancelButtonText: "BATAL",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "GET",
        url: `/product/delete/${pid}`,
        success: function (response) {
          Swal.fire({
            icon: "success",
            title: "PERMOHONAN DIHAPUS!",
            showConfirmButton: false,
            timerProgressBar: true,
            allowOutsideClick: false,
            backdrop: `rgb(255, 255, 255)`,
            timer: 3000,
            timerProgressBar: false,
          }).then(() => {
            location.replace("/dashboard");
          });
        },
      });
    }
  });
});

$("#product-verif").click(function (e) {
  $.ajax({
    type: "POST",
    url: "/product/update",
    data: {
      id: $(this).data("pid"),
      id_status: 1,
    },
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
      Swal.fire({
        icon: "success",
        title: "PERMOHONAN DIVERIFIKASI",
        timer: 3000,
        showConfirmButton: false,
        timerProgressBar: false,
        allowOutsideClick: false,
        backdrop: `rgb(255, 255, 255)`,
      }).then(() => {
        location.reload();
      });
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
});

$("#product-valid").click(function (e) {
  $.ajax({
    type: "POST",
    url: "/product/update",
    data: {
      id: $(this).data("pid"),
      id_status: 2,
      bk_number: $("#bk-number").val(),
      bk_date: $("#bk-date").val(),
    },
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
      Swal.fire({
        icon: "success",
        title: "PENGAJUAN PERMOHONAN",
        timer: 3000,
        showConfirmButton: false,
        timerProgressBar: false,
        allowOutsideClick: false,
        backdrop: `rgb(255, 255, 255)`,
      }).then(() => {
        location.reload();
      });
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
});

$("#product-process").click(function (e) {
  $.ajax({
    type: "POST",
    url: "/product/update",
    data: {
      id: $(this).data("pid"),
      id_status: 4,
    },
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
      Swal.fire({
        icon: "success",
        title: "DOKUMEN DALAM PROSES CETAK",
        timer: 3000,
        showConfirmButton: false,
        timerProgressBar: false,
        allowOutsideClick: false,
        backdrop: `rgb(255, 255, 255)`,
      }).then(() => {
        location.reload();
      });
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
});

$("#product-done").click(function (e) {
  $.ajax({
    type: "POST",
    url: "/product/update",
    data: {
      id: $(this).data("pid"),
      id_status: 3,
    },
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
      Swal.fire({
        icon: "success",
        title: "DOKUMEN SELESAI",
        timer: 3000,
        showConfirmButton: false,
        timerProgressBar: false,
        allowOutsideClick: false,
        backdrop: `rgb(255, 255, 255)`,
      }).then(() => {
        location.reload();
      });
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
});

$("#product-self").click(function (e) {
  $.ajax({
    type: "POST",
    url: "/product/update",
    data: {
      id: $(this).data("pid"),
      id_status: 5,
    },
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
      Swal.fire({
        icon: "success",
        title: "MENGURUS SENDIRI",
        timer: 3000,
        showConfirmButton: false,
        timerProgressBar: false,
        allowOutsideClick: false,
        backdrop: `rgb(255, 255, 255)`,
      }).then(() => {
        location.reload();
      });
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
});

$("#send-notif").click(function () {
  const lkName = $("#lk-name").val();
  const prName = $("#pr-name").val();
  const lkPhone = $("#lk-phone").val();
  const prPhone = $("#pr-phone").val();
});

function sanitizeInput() {
  const isName = ["#lk-name", "#pr-name"];
  const isNotes = ["#notes"];
  const isBK = ["#bk-number"];
  const isAddress = ["#address"];
  const isNumber = [
    "#lk-nik",
    "#pr-nik",
    "#lk-kk",
    "#pr-kk",
    "#lk-phone",
    "#pr-phone",
  ];

  $.each(isNumber, function (i, data) {
    $(data).keyup(function () {
      filterNumber($(this).val(), data);
    });
  });

  $.each(isNotes, function (i, data) {
    $(data).keyup(function () {
      filterNotes($(this).val(), data);
    });
  });

  $.each(isName, function (i, data) {
    $(data).keyup(function () {
      filterName($(this).val(), data);
    });
  });

  $.each(isAddress, function (i, data) {
    $(data).keyup(function () {
      filterAddress($(this).val(), data);
    });
  });

  $.each(isBK, function (i, data) {
    $(data).keyup(function () {
      filterAddress($(this).val(), data);
    });
  });
}

sanitizeInput();
