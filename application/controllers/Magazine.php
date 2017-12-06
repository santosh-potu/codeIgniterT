<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Magazine extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }


    public function index(){
        
        $this->load->library('table');
        
        
        $magazines = array();
        $this->load->model(array('Issue','Publication'));
        $issues = $this->Issue->get();
        foreach($issues as $issue){
            $publication = new Publication();
            $publication->load($issue->publication_id);
            $magazines[] = array(
                $publication->publication_name,
                $issue->issue_number,
                $issue->issue_date_publication,
                $issue->issue_cover ? 'Y':'N',
                anchor('/magazine/view/'.$issue->issue_id, 'View').'|'.
                anchor('/magazine/delete/'.$issue->issue_id, 'Delete'));
        }
        
         
        /* $this->load->model('Publication');
        $this->load->model('Issue');
           $data = array();   
       
        $issue = new Issue();
        $issue->load(1);
        $data['issue'] = $issue;
        
        $publication = new Publication();
        $publication->load($issue->publication_id);
        $data['publication'] = $publication; */
        
        
        /*$this->load->model('Publication');
        $this->Publication->publication_name = "Sandy Shore";
        $this->Publication->save();
        
        echo "<tt><pre>".var_dump($this->Publication,TRUE)."</pre></tt>";
        
        $this->load->model('Issue');
        $issue = new Issue();
        $issue->publication_id = $this->Publication->publication_id;
        $issue->issue_number = 2;
        $issue->issue_date_publication = date('2013-01-16');
        $issue->save();
        
        echo "<tt><pre>".var_dump($issue,TRUE)."</pre></tt>";
        
        */
        $this->load->view('bootstrap/header.php');
        $this->load->view('magazines', array(
            'magazines' => $magazines
        ));
        //$this->load->view('magazine',$data);
        $this->load->view('bootstrap/footer.php');
    }
    
    public function add(){
        
        $file_config = array(
            'upload_path' => 'uploads',
            'allowed_types' => 'jpg|png|gif|bmp',
            'max_size' => 250,
            'max_width' => 1920,
            'max_height'=> 1080
        );
        $this->load->library('upload',$file_config);
        
        $this->load->model('Publication');
        $publications = $this->Publication->get();
                
        foreach($publications as $id => $publication_tmp){
            $publication_form_options[$id] = $publication_tmp->publication_name;
        }
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array(
              'field' => 'publication_id' ,
              'label' => 'Publication',
                'rules' => 'required'
            ),
            array(
                'field' => 'issue_number' ,
                'label' => 'Issue number',
                'rules' => 'required|is_numeric'
            ),
            array(
                'field' => 'issue_date_publication',
                'label' => 'Publication date',
                'rules' => 'required|callback_date_validation'
            )
        ));
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
        
        $file_upload_check = FALSE;
        if( isset($_FILES['issue_cover']['error']) && $_FILES['issue_cover']['error'] !=4){
            $file_upload_check = TRUE;
        }
        
        $this->load->view('bootstrap/header.php');
        
        if(!$this->form_validation->run() || ($file_upload_check && 
                !$this->upload->do_upload('issue_cover'))){
                     
            $this->load->view('magazine_form',array(
            'publication_form_options' => $publication_form_options,
        ));
        }else{
            $this->load->model('Issue');
            $issue = new Issue();
            $issue->publication_id = $this->input->post('publication_id');
            $issue->issue_number = $this->input->post('issue_number');
            $issue->issue_date_publication = $this->input->post('issue_date_publication');
            
            $upload_data = $this->upload->data();
            if(isset($upload_data['file_name'])){
                $issue->issue_cover = $upload_data['file_name'];
            }
            
            $issue->save();
            $this->load->view('magazine_form_success',array(
                'issue' => $issue
                    ));
        }
        
        
        $this->load->view('bootstrap/footer.php');
    }
    
    
    public function date_validation($test_date){
        $test_date = explode('-', $test_date);
        if(!@checkdate($test_date[1],$test_date[2] , $test_date[0])){
            $this->form_validation->set_message('date_validation','The %s filed must be in YYYY-MM-DD format');
            return FALSE;
        }
        return TRUE;
    }
    
    public function delete($issue_id){
        $this->load->model("Issue");
        $issue = new Issue();
        $issue->load($issue_id);
        if(!$issue->issue_id){
            show_404();
        }
        $issue->delete();
        
        $this->load->view('bootstrap/header.php');
        $this->load->view('magazine_delete_success', array(
            'issue_id' => $issue_id
        ));
        $this->load->view('bootstrap/footer.php');
    }
    
    public function view($issue_id){
        $this->load->helper('html');
        $this->load->model(array('Issue','Publication'));
        $this->Issue->load($issue_id);
        
        if(!$this->Issue->issue_id){
            show_404();
        }
        
        $publication = new Publication();
        $publication->load($this->Issue->publication_id);
        
        
        $this->load->view('bootstrap/header.php');
        $this->load->view('magazine', array(
            'issue' => $this->Issue,
            'publication' => $publication,
        ));
        $this->load->view('bootstrap/footer.php');
    }
}

