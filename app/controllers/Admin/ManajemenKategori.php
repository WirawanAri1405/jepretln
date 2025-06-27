<?php

class ManajemenKategori extends Controller
{
    // ... (metode index, hapus, edit yang sudah ada) ...
    public function index()
    {
        $data['judul'] = 'Manajemen Kategori';
        $kategori_model = $this->model('Kategori_model');

        // Ambil parameter pencarian dari URL
        $search_term = $_GET['search'] ?? null;

        // Data untuk view (termasuk navbar dinamis)
        $data['search_action'] = BASEURL . '/Admin/ManajemenKategori';
        $data['search_placeholder'] = 'Cari nama atau slug kategori...';
        $data['search_term'] = $search_term;
        
        // Logika Paginasi
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $results_per_page = 10;
        $offset = ($page - 1) * $results_per_page;
        
        // Ambil total data dan data per halaman dari model
        $total_results = $kategori_model->countAllKategori($search_term);
        $total_pages = ceil($total_results / $results_per_page);
        $data['kategori'] = $kategori_model->getAllKategori($search_term, $results_per_page, $offset);

        // Data paginasi untuk view
        $data['current_page'] = $page;
        $data['total_pages'] = $total_pages;
        $data['total_results'] = $total_results;
        $data['showing_from'] = ($total_results > 0) ? $offset + 1 : 0;
        $data['showing_to'] = min($offset + $results_per_page, $total_results);

        // Memuat semua view
        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar', $data);
        $this->view('admin/templates/navbar', $data);
        $this->view('admin/manajemenKategori/index', $data);
        $this->view('admin/manajemenKategori/form_modal', $data);
        $this->view('admin/templates/footer');
    }
    /**
     * Fungsi helper untuk mengubah array keys dan values menjadi format JSON
     */
    private function buildSpecJson($keys, $values)
    {
        $fields = [];
        if (!empty($keys) && count($keys) === count($values)) {
            for ($i = 0; $i < count($keys); $i++) {
                if (!empty(trim($keys[$i])) && !empty(trim($values[$i]))) {
                    $fields[trim($keys[$i])] = trim($values[$i]);
                }
            }
        }
        return json_encode(['fields' => $fields]);
    }

    public function tambah()
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['name'])));
        
        // Gunakan fungsi helper untuk merakit JSON
        $specTemplateJson = $this->buildSpecJson($_POST['spec_keys'] ?? [], $_POST['spec_values'] ?? []);

        $data = [
            'name' => $_POST['name'],
            'slug' => $slug,
            'spec_template' => $specTemplateJson
        ];

        if ($this->model('Kategori_model')->tambahDataKategori($data) > 0) {
            Flasher::setFlash('Kategori', 'berhasil ditambahkan', 'success');
        } else {
            Flasher::setFlash('Kategori', 'gagal ditambahkan', 'danger');
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenKategori');
        exit;
    }

   public function edit($id)
    {
        $data['judul'] = 'Edit Kategori';
        $data['kategori'] = $this->model('Kategori_model')->getKategoriById($id);
        
        $this->view('admin/templates/header', $data);
        $this->view('admin/templates/sidebar');
        $this->view('admin/templates/navbar');
        $this->view('admin/manajemenKategori/edit', $data);
        $this->view('admin/templates/footer');
    }

    public function update()
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['name'])));
        
        $specTemplateJson = $this->buildSpecJson($_POST['spec_keys'] ?? [], $_POST['spec_values'] ?? []);
        
        $data = [
            'id' => $_POST['id'],
            'name' => $_POST['name'],
            'slug' => $slug,
            'spec_template' => $specTemplateJson
        ];
        
        if ($this->model('Kategori_model')->updateDataKategori($data) > 0) {
            Flasher::setFlash('Kategori', 'berhasil diubah', 'success');
        } else {
            Flasher::setFlash('Kategori', 'tidak ada perubahan data', 'info');
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenKategori');
        exit;
    }
        public function detail($id)
    {
        $data['judul'] = 'Detail Kategori';
        $data['kategori'] = $this->model('Kategori_model')->getKategoriById($id);
        $this->view('admin/templates/header', $data);
        $this->view('admin/manajemenKategori/detail', $data);
        $this->view('admin/templates/footer');
    }
         public function hapus($id)
    {
        if ($this->model('Kategori_model')->hapusDataKategori($id) > 0) {
            Flasher::setFlash('Data Kategori', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Data kategori', 'gagal dihapus', 'danger');
        }
        header('Location: ' . BASEURL . '/Admin/ManajemenKategori');
        exit;
    }
}