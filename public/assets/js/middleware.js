function filterNumber(inputValue, className) {
  var regex = /^[0-9]*$/;
  if (!regex.test(inputValue)) {
    inputValue = inputValue.replace(/[^0-9]/g, "");
  }
  return $(className).val(inputValue);
}

function filterName(inputValue, className) {
  var regex = /^[. a-zA-Z]*$/;
  if (!regex.test(inputValue)) {
    inputValue = inputValue.replace(/[^. a-zA-Z]/g, "");
  }
  return $(className).val(inputValue);
}

function filterNotes(inputValue, className) {
  var regex = /^[/.:, a-zA-Z0-9\r\n]*$/;
  if (!regex.test(inputValue)) {
    inputValue = inputValue.replace(/[^/.:, a-zA-Z0-9\r\n]+/g, "");
  }
  return $(className).val(inputValue);
}

function filterAddress(inputValue, className) {
  var regex = /^[/.a-zA-Z0-9 ]*$/;
  if (!regex.test(inputValue)) {
    inputValue = inputValue.replace(/[^/.a-zA-Z0-9 ]+/g, "");
  }
  return $(className).val(inputValue);
}

function filterBK(inputValue, className) {
  var regex = /^[/.a-zA-Z0-9]*$/;
  if (!regex.test(inputValue)) {
    inputValue = inputValue.replace(/[^/.a-zA-Z0-9]+/g, "");
  }
  return $(className).val(inputValue);
}

$(".button-view-image").click(function (e) {
  e.preventDefault();
  const source = $(this).attr("src");
  const alt = $(this).attr("alt");

  Swal.fire({
    text: alt,
    imageUrl: source,
    width: "100%",
    imageHeight: 500,
    confirmButtonText: "TUTUP",
    customClass: {
      confirmButton: "btn btn-danger btn-lg rounded-0",
    },
  });
});
