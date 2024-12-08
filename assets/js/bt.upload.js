$(".file-biodata-upload-button").click(function () {
  $(".file-biodata-input").click();
});

$(".file-biodata-input").change(function () {
  var file = $(this)[0].files[0];
  if (file) {
    saveFileBiodata(file);
  }
});

const dropzoneBiodata = $(".dropzone-biodata");

dropzoneBiodata.on("paste", function (event) {
  const clipboardData = event.originalEvent.clipboardData;
  const items = clipboardData.items;

  for (let i = 0; i < items.length; i++) {
    const item = items[i];
    if (item.kind === "file") {
      const file = item.getAsFile();
      handleFilesBiodata([file]);
    }
  }
});

dropzoneBiodata.on("dragover", function (e) {
  e.preventDefault();
  e.stopPropagation();
  dropzoneBiodata.addClass("dragover");
});

dropzoneBiodata.on("dragleave", function (e) {
  e.preventDefault();
  e.stopPropagation();
  dropzoneBiodata.removeClass("dragover");
});

dropzoneBiodata.on("drop", function (e) {
  e.preventDefault();
  e.stopPropagation();
  dropzoneBiodata.removeClass("dragover");

  const files = e.originalEvent.dataTransfer.files;
  handleFilesBiodata(files);
});

function handleFilesBiodata(files) {
  for (let i = 0; i < files.length; i++) {
    const file = files[i];
    saveFileBiodata(file);
  }
}

function saveFileBiodata(file) {
  $(".progress").show();
  $("#progressBar").removeClass("bg-success");
  $("#progressBar").attr("aria-valuenow", 0);
  $("#progressBar").css("width", "0%");

  const pid = $("#pid").val();
  const logs = $("#logs").val();
  const gender = $('input[name="exampleRadios"]:checked').val();

  const formData = new FormData();
  formData.append("file", file);
  formData.append("type", "bt");
  formData.append("gender", gender);
  formData.append("pid", pid);
  formData.append("logs", logs);
  formData.append("category", 1);

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
        if (gender == "lk") {
          $(".images-lk").attr("src", e.target.result);
        } else if (gender == "pr") {
          $(".images-pr").attr("src", e.target.result);
        }
      };
      reader.readAsDataURL(file);
    },
    success: function (response) {
      const gender = $('input[name="exampleRadios"]:checked').val();
      const item = JSON.parse(response);
      if (gender == "lk") {
        $(".images-lk").attr("src", `/files/${item.path}`);
      } else if (gender == "pr") {
        $(".images-pr").attr("src", `/files/${item.path}`);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error(textStatus, errorThrown);
    },
  });
}
