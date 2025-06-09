<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <h3>Daftar mahasiswa</h3>

                <ul class="list-group">
                    <?php foreach ($data['mhs'] as $mhs): ?>
                        <li class="list-group-item d-flex justify-content-between aligin-items-center">
                            <?= $mhs['nama'] ?>
                        <a href = "<?= BASEURL;?>/mahasiswa/detail/<?= $mhs['id'];?>" class="badge text-bg-primary">detail</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>