
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Healthtip extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();
                $this->load->library('session');
                $this->load->model('health_model');
    }

    // The function below manage study health //
    function health_tip($param1 = '', $param2 = '', $param3 = ''){

        if ($param1 == 'insert'){
        
        $this->health_model->inserIntohealth();
        $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
        redirect(base_url(). 'healthtip/health_tip', 'refresh');
        }
        
    if($param1 == 'update'){

        $this->health_model->updatehealthtip($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
        redirect(base_url(). 'healthtip/health_tip', 'refresh');
    }

    if($param1 == 'delete'){
        $this->health_model->deleteFromhealth($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
        redirect(base_url(). 'healthtip/health_tip', 'refresh');
    }

        $page_data['page_name']         = 'health_tip';
        $page_data['page_title']        = get_phrase('Health Tips');
        $this->load->view('backend/index', $page_data);


    }
}