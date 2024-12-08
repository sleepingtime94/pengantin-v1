$(".file-bk-upload-button").click(function () {
  $(".file-bk-input").click();
});

$(".file-bk-input").change(function () {
  var file = $(this)[0].files[0];
  if (file) {
    saveFileBK(file);
  }
});

const dropzoneBK = $(".dropzone-bk");

dropzoneBK.on("paste", function (event) {
  const clipboardData = event.originalEvent.clipboardData;
  const items = clipboardData.items;

  for (let i = 0; i < items.length; i++) {
    const item = items[i];
    if (item.kind === "file") {
      const file = item.getAsFile();
      handleFilesBK([file]);
    }
  }
});

dropzoneBK.on("dragover", function (e) {
  e.preventDefault();
  e.stopPropagation();
  dropzoneBK.addClass("dragover");
});

dropzoneBK.on("dragleave", function (e) {
  e.preventDefault();
  e.stopPropagation();
  dropzoneBK.removeClass("dragover");
});

dropzoneBK.on("drop", function (e) {
  e.preventDefault();
  e.stopPropagation();
  dropzoneBK.removeClass("dragover");

  const files = e.originalEvent.dataTransfer.files;
  handleFilesBK(files);
});

function handleFilesBK(files) {
  for (let i = 0; i < files.length; i++) {
    const file = files[i];
    saveFileBK(file);
  }
}

function saveFileBK(file) {
  $(".progress").show();
  $("#progressBar").removeClass("bg-success");
  $("#progressBar").attr("aria-valuenow", 0);
  $("#progressBar").css("width", "0%");

  const logs = $("#logs").val();
  const pid = $("#pid").val();
  const formData = new FormData();

  formData.append("file", file);
  formData.append("pid", pid);
  formData.append("logs", logs);
  formData.append("type", "bk");
  formData.append("category", 2);

  $.ajax({
    url: "/file/create",
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
    before: function () {
      const reader = new FileReader();

      reader.onload = function (e) {
        $(".images-bk").attr("src", e.target.result);
      };
      reader.readAsDataURL(file);
    },
    success: function (response) {
      const item = JSON.parse(response);
      const bkDate = $("#bk-date").val();
      const bkNumber = $("#bk-number").val();

      if (bkDate !== "" && bkNumber !== "") {
        $("#product-valid").removeClass("disabled");
      }

      $(".images-bk").attr("src", `/files/${item.path}`);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error(textStatus, errorThrown);
    },
  });
}
