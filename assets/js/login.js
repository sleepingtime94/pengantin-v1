let capcay = $("#capcay").val();
let csrfToken = $("#csrf-token").val();

$("#login").click(function () {
  Swal.fire({
    html: `
      <div class="mt-4"><div class="form-floating mb-3">
      <input type="text" class="form-control" id="form-input-username" placeholder="Username" autocomplete="off">
      <label for="username">Nama Pengguna</label>
      </div>
      <div class="form-floating mb-3">
      <input type="password" class="form-control" id="form-input-password" placeholder="Password">
      <label for="password">Kata Sandi</label>
      </div>
      <div class="mb-5 input-group">
      <input id="csrf-token" type="hidden" name="csrfToken" value="${csrfToken}">
      <span class="input-group-text fs-4 bg-light captcha-text fw-bold">${capcay}</span>
      <input type="text" id="form-input-captcha" class="form-control" placeholder="Masukkan kode captcha" autocomplete="off">
      </div>
      </div>
      `,
    focusConfirm: false,
    showCancelButton: true,
    confirmButtonText: "MASUK",
    cancelButtonText: "BATAL",
    allowOutsideClick: false,
    customClass: {
      confirmButton: "btn btn-primary",
      cancelButton: "btn btn-outline-muted",
    },
    preConfirm: () => {
      const username = document.getElementById("form-input-username").value;
      const password = document.getElementById("form-input-password").value;
      const captcha = document.getElementById("form-input-captcha").value;
      const csrf = document.getElementById("csrf-token").value;

      if (!username || !password) {
        Swal.showValidationMessage(
          "SILAHKAN MASUKKAN NAMA PENGGUNA/KATA SANDI"
        );
        return false;
      }

      if (captcha.toLowerCase() !== capcay.toLowerCase()) {
        Swal.showValidationMessage("KODE CAPTCHA SALAH");
        return false;
      }

      return {
        username,
        password,
        csrf,
      };
    },
  }).then((result) => {
    if (result.isConfirmed) {
      const { username, password, csrf } = result.value;

      $.ajax({
        type: "POST",
        url: "/user/login",
        data: {
          username: username.toLowerCase(),
          password,
          csrfToken: csrf,
        },
        success: function (res) {
          const response = JSON.parse(res);
          if (response.status == "success") {
            Swal.fire({
              icon: "success",
              title: "BERHASIL!",
              text: response.message,
              timer: 3000,
              showConfirmButton: false,
              allowOutsideClick: false,
            }).then(() => {
              location.replace("/dashboard");
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "GAGAL!",
              text: response.message,
              timer: 3000,
              showConfirmButton: false,
              allowOutsideClick: false,
            });
          }
        },
      });
    }
  });
});
