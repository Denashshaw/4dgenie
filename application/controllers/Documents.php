
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR);
class Documents extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
    $this->load->model("empdetailsModel");
    $this->load->model("documentModel");
    $this->load->library('session');
    $userdata=$this->session->all_userdata();
    if($userdata["hrms_logged_in"] != TRUE){
      redirect('login/index');
    }
  }

  public function index(){
      $data['emp_data']   = $this->empdetailsModel->agentdata();
        $this->load->view('emp_document',$data);
    }

    public function getuserdata(){
      $datares = $this->documentModel->getentireuser('emp_documents',$_POST);
    }

    public function certificateUpload(){
      $config['upload_path'] = './documents/certificates/';
			$config['allowed_types']        = 'gif|jpg|png|doc|pdf';
			$config['max_size']     = '1200';
      $this->load->library('upload', $config);
      $id=$_POST['empidname3'];
      $dataset = array(
        "emp_id" => $id,
        "certificate1" => $_POST['certificate1'],
        "certificate2" => $_POST['certificate2'],
        "certificate3" => $_POST['certificate3']
      );
      if ( $this->upload->do_upload('certificatefile1')){
				$dataset['certificate1_filename'] = $this->upload->data('file_name');
      }
      if ( $this->upload->do_upload('certificatefile2')){
				$dataset['certificate2_filename'] = $this->upload->data('file_name');
      }
      if ( $this->upload->do_upload('certificatefile3')){
				$dataset['certificate3_filename'] = $this->upload->data('file_name');
			}
      $datares = $this->documentModel->insertupdatedata('emp_documents',$id,$dataset);
      redirect('Documents/index');
    }

    public function confirmationUpload(){
      $config['upload_path'] = './documents/confirmation_letter/';
			$config['allowed_types']        = 'gif|jpg|png|doc|pdf';
			$config['max_size']     = '1200';
      $this->load->library('upload', $config);
      $id=$_POST['empidname1'];
      $dataset = array(
        "emp_id" => $id
      );
      if ( $this->upload->do_upload('confirmationletterupload')){
				$dataset['confirmation_letter'] = $this->upload->data('file_name');
      }
      $datares = $this->documentModel->insertupdatedata('emp_documents',$id,$dataset);
      redirect('Documents/index');
    }

    public function terminationUpload(){
      $config['upload_path'] = './documents/termination_letter/';
			$config['allowed_types']        = 'gif|jpg|png|doc|pdf';
			$config['max_size']     = '1200';
      $this->load->library('upload', $config);
      $id=$_POST['empidname2'];
      $dataset = array(
        "emp_id" => $id
      );
      if ( $this->upload->do_upload('terminationletterupload')){
				$dataset['termination_letter'] = $this->upload->data('file_name');
      }
      $datares = $this->documentModel->insertupdatedata('emp_documents',$id,$dataset);
     redirect('Documents/index');
    }

    public function uploadpromotion(){
      $config['upload_path'] = './documents/promotion_letter/';
			$config['allowed_types']        = 'gif|jpg|png|doc|pdf';
			$config['max_size']     = '1200';
      $this->load->library('upload', $config);
      $id=$_POST['userid'];
      $dataset = array(
        "emp_id" => $id
      );
      if ( $this->upload->do_upload('filenamePromotion')){
        $dataset['permissiondoc'] = $this->upload->data('file_name');
        $dataset['per_update_date'] = $_POST['date'];
      }
      $datares = $this->documentModel->insertonly('emp_promotion_doc',$id,$dataset);
      $dataresview = $this->documentModel->getentireuser('emp_promotion_doc',$_POST);
    }

    public function getpromotion(){
      $dataresview = $this->documentModel->getentireuser('emp_promotion_doc',$_POST);
    }

    public function uploadwaring(){
      $config['upload_path'] = './documents/warning_letter/';
			$config['allowed_types']        = 'gif|jpg|png|doc|pdf';
			$config['max_size']     = '1200';
      $this->load->library('upload', $config);
      $id=$_POST['userid'];
      $dataset = array(
        "emp_id" => $id
      );
      if ( $this->upload->do_upload('filenamewaring')){
        $dataset['warningdoc'] = $this->upload->data('file_name');
        $dataset['war_update_date'] = $_POST['date'];
      }
      $datares = $this->documentModel->insertonly('emp_warning_doc',$id,$dataset);
      $dataresview = $this->documentModel->getentireuser('emp_warning_doc',$_POST);
    }
    public function getwarning(){
      $dataresview = $this->documentModel->getentireuser('emp_warning_doc',$_POST);
    }

    public function getpersonaldetails(){
      $dataresview = $this->documentModel->getentireuser('emp_personal_details',$_POST);
    }
    // public function aadharUpload(){
    //   $config['upload_path'] = './documents/aadhar/';
		// 	$config['allowed_types']        = 'gif|jpg|png|doc|pdf';
		// 	$config['max_size']     = '1200';
    //   $this->load->library('upload', $config);
    //   $id=$_POST['empidname4'];
    //   $dataset = array(
    //     "emp_id" => $id
    //   );
    //   if ( $this->upload->do_upload('aadharupload')){
		// 		$dataset['aadhar'] = $this->upload->data('file_name');
    //   }
    //   $datares = $this->documentModel->insertupdatedata('aadhar',$id,$dataset);
    //   redirect('Documents/index');
    // }
}
