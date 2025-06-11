$(function () {
    $('.tombolTambahData').on('click', function () {
        $('#exampleModalLabel').html('Tambah data mahasiswa');
        $('.modal-footer button[type=submit]').html('tambah data');
    });

    $('.tampilModalUbah').on('click', function () {
        $('#exampleModalLabel').html('Ubah data mahasiswa');
        $('.modal-footer button[type=submit]').html('ubah data');
        $('.modal-body form').attr('action','http://localhost/jepretln/public/mahasiswa/ubah');

        const id = $(this).data('id');
        console.log(id);

        $.ajax({
            url: 'http://localhost/jepretln/public/mahasiswa/getubah',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#nama').val(data.nama);
                $('#NIM').val(data.NIM);
                $('#email').val(data.email);
                $('#jurusan').val(data.jurusan);
                $('#id').val(data.id);
            }
        })
    });
});