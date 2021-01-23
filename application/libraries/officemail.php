<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class officemail {

        public function sendmail($send_id,$send_pw,$to,$cc,$subjecttext,$messagetext)
        {
          $CI =& get_instance();
          $CI->load->library('email');
          //$this->load->library('email')
          $config = array(
              'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
              'smtp_host' => '192.168.2.7',
              'smtp_port' => 587,
              'smtp_user' => $send_id,
              'smtp_pass' => $send_pw,
              'smtp_crypto' => 'Auto',
              'mailtype' => 'html', //plaintext 'text' mails or 'html'
              'smtp_timeout' => '4', //in seconds
              'charset' => 'iso-8859-1',
              'wordwrap' => TRUE
          );
          //$config['charset']    = 'utf-8';
          $CI->email->initialize($config);
          $CI->email->set_newline("\r\n");
          $CI->email->set_mailtype("html");
          $CI->email->from($send_id);
          $CI->email->to($to);
          if($cc !=''){
            $CI->email->cc($cc);
          }
          $CI->email->set_header('Subject',$subjecttext);
          $CI->email->message($messagetext);
          $mail=$CI->email->send();
          if($mail){
            echo "Mail Send Successfully";
          }else{
            echo "Not Send";
          }

        }
}
?>
