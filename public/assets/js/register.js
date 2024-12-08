const isName = ["#lk-name", "#pr-name"];
const isNotes = ["#notes"];
const isAddress = [
  "#addr-ds",
  "#addr-kec",
  "#lk-address",
  "#pr-address",
  "#addr-street",
];
const isNumber = [
  "#lk-nik",
  "#pr-nik",
  "#lk-kk",
  "#pr-kk",
  "#lk-phone",
  "#pr-phone",
  "#addr-rt",
  "#addr-rw",
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

$("#file-upload").change(function () {
  const file = $(this)[0].files[0];
  if (file) {
    uploadFile(file);
  }
});

function uploadFile(file) {
  $(".progress").show();
  $("#progressBar").removeClass("bg-success");
  $("#progressBar").attr("aria-valuenow", 0);
  $("#progressBar").css("width", "0%");

  let category;
  const logs = $(".product-register").data("temp");
  const fileCat = $("#file-category").val();
  const formData = new FormData();

  switch (fileCat) {
    case "3":
      category = "IJAZAH TERAKHIR";
      break;
    case "4":
      category = "SK PEGAWAI";
      break;
    case "5":
      category = "DOKUMEN LAINNYA";
      break;
    default:
      category = "DOKUMEN LAINNYA";
      break;
  }

  formData.append("file", file);
  formData.append("logs", logs);
  formData.append("category", fileCat);

  $.ajax({
    url: "/file/create/temp",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    xhr: function () {
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener("progress", function (evt) {
        if (evt.lengthComputable) {
          var percentComplete = (evt.loaded / evt.total) * 100;
          $("#progressBar").attr("aria-valuenow", percentComplete);
          $("#progressBar").css("width", percentComplete + "%");
          $("#progressBar").text(percentComplete.toFixed(0) + "%");
        }
      });
      return xhr;
    },
    success: function (response) {
      const item = JSON.parse(response);

      if (item.status == "success") {
        $("#file-result").append(
          `<li class="list-group-item" data-path="${removeFileExtension(
            item.path
          )}"><button id="document" class="btn btn-link">${category}</button></li>`
        );

        Swal.fire({
          icon: "success",
          title: item.message,
          toast: true,
          position: "bottom",
          showConfirmButton: false,
          timer: 5000,
          timerProgressBar: true,
        });

        $("li").click(function (e) {
          e.preventDefault();
          const source = $(this).attr("data-path");
          const alt = $(this).text();

          return Swal.fire({
            text: alt,
            imageUrl: source,
            width: "100%",
            imageHeight: 500,
            confirmButtonText: "TUTUP",
            customClass: {
              confirmButton: "btn btn-danger rounded-0",
            },
          });
        });
      } else {
        $("#progressBar").addClass("bg-danger");
        Swal.fire({
          icon: "warning",
          title: item.message,
          toast: true,
          position: "bottom",
          showConfirmButton: false,
          timer: 5000,
          timerProgressBar: true,
        });
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error(textStatus, errorThrown);
    },
  });
}

$("#submit-form").click(function () {
  const id_user = $("#kua").val();
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
  const logs = $("#register-form").data("temp");
  const rt = $("#addr-rt").val();
  const rw = $("#addr-rw").val();
  const ds = $("#addr-ds").val();
  const kec = $("#addr-kec").val();
  const street = $("#addr-street").val();
  const address = `${street} RT/RW ${rt}/${rw} ${ds} ${kec}`;

  $.ajax({
    type: "POST",
    url: "/client/register",
    data: {
      logs,
      id_user,
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
      notes: notes.toUpperCase(),
      address: address.toUpperCase(),
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
      const result = JSON.parse(response);
      if (result.status == "success") {
        Swal.fire({
          icon: "success",
          title: "SUKSES!",
          text: result.message,
          timer: 3000,
          showConfirmButton: false,
          allowOutsideClick: false,
        }).then(() => {
          location.replace(`/client/${logs}`);
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "GAGAL!",
          text: result.message,
          timer: 3000,
          showConfirmButton: false,
          allowOutsideClick: false,
        });
      }
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
});

function removeFileExtension(path) {
  const parts = path.split("/");
  const namaFile = parts[parts.length - 1].split(".")[0];
  return "images/" + namaFile;
}
