// Fungsi untuk toggle password dari halaman login
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if (input.type === "password") {
        input.type = "text";
        icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-5 0-9.27-3.11-10.542-7.5a10.05 10.05 0 012.09-3.368m1.446-1.446A10.05 10.05 0 0112 5c5 0 9.27 3.11 10.542 7.5a10.05 10.05 0 01-4.124 5.182M15 12a3 3 0 01-3 3m0 0a3 3 0 01-3-3m3 3L3 3"/>`;
    } else {
        input.type = "password";
        icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />`;
    }
}

// Fungsi untuk kembali ke halaman sebelumnya
function goBack() {
    window.history.back();
}


// Di bawah ini adalah contoh script dari file Mahasiswa Anda yang menggunakan jQuery
// Pastikan jQuery sudah dimuat sebelum file script.js ini.
$(function() {

    // Tombol untuk menampilkan modal tambah data
    $('.tombolTambahData').on('click', function() {
        $('#exampleModalLabel').html('Tambah Data Mahasiswa');
        $('.modal-footer button[type=submit]').html('Tambah Data');
        // Kosongkan form jika perlu
        $('#nama').val('');
        $('#NIM').val('');
        $('#email').val('');
        $('#jurusan').val('');
        $('#id').val('');
    });

    // Tombol untuk menampilkan modal ubah data
    $('.tampilModalUbah').on('click', function() {
        $('#exampleModalLabel').html('Ubah Data Mahasiswa');
        $('.modal-footer button[type=submit]').html('Ubah Data');
        $('.modal-body form').attr('action', 'http://localhost/phpmvc/public/mahasiswa/ubah'); // Sesuaikan BASEURL

        const id = $(this).data('id');
        
        // ajax menggunakan jQuery
        $.ajax({
            url: 'http://localhost/phpmvc/public/mahasiswa/getubah', // Sesuaikan BASEURL
            data: {id : id},
            method: 'post',
            dataType: 'json',
            success: function(data){
                $('#nama').val(data.nama);
                $('#NIM').val(data.NIM);
                $('#email').val(data.email);
                $('#jurusan').val(data.jurusan);
                $('#id').val(data.id);
            }
        });
    });

});