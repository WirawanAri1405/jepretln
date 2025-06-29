<?php

class Faq extends Controller {

    public function index()
    {

        $data['judul'] = 'Pusat Bantuan (FAQ)';
        $faq_model = $this->model('FAQ_model');

       
        $search_term = $_GET['search'] ?? null;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        
        
        $results_per_page = 5; 
        $status_filter = 1;


        $page = max(1, $page);
        $offset = ($page - 1) * $results_per_page;

     
        $total_results = $faq_model->countAllFAQs($search_term, $status_filter);

        $data['faqs'] = $faq_model->getAllFAQs($search_term, $status_filter, $results_per_page, $offset);
  
        $total_pages = ceil($total_results / $results_per_page);
        
        $data['search_term'] = $search_term; 
        $data['current_page'] = $page;
        $data['total_pages'] = $total_pages;

   
        $this->view('templates/header', $data);
        $this->view('Users/Faq', $data);
        $this->view('templates/footer');
    }
}