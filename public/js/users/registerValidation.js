// JS: VALIDASI SAJA, jangan redirect
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('registerForm');

  if (form) {
    form.addEventListener('submit', function (e) {
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirmPassword').value;

      if (password !== confirmPassword) {
        alert('Password dan Konfirmasi Password tidak sama!');
        e.preventDefault(); // cegah kirim form jika tidak valid
        return;
      }

    });
  }
});
