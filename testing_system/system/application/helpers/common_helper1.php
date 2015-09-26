<?php 
class common{

	public static function is_logged(){
		$CI =& get_instance();
	        if($CI->session->userdata('logged_in')){
	            return TRUE;
	        }else{
				return FALSE;
			}
	}
	public static function is_logged_in(){
		$CI =& get_instance();
		if(!$CI->session->userdata('logged_in')){
			redirect('home');
		}
	}
	public static function is_admin_logged()
	{
		$CI =& get_instance();
		if(!$CI->session->userdata('logged_in') || $CI->session->userdata('user_name')!='admin'){
		   redirect('home');
		}
	}
	public static function status($status=''){
		if($status==1){
			return 'Active';
		}
		else{
			return 'Inactive';
		}
	}
	public static function change_status($table,$con,$status){
		$CI =& get_instance();
		$sql="update $table set status=$sta where $con";
		return $CI->db->query($sql);
	}
	public static function mail_sending($from_name,$from_email,$to_email,$subject,$msg_content){
		$CI=& get_instance();
		$CI->load->library('email');
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['mailtype']='html';
		
		$CI->email->initialize($config);
		
		$CI->email->from($from_email, $from_name);
		$CI->email->to($to_email);
		$CI->email->subject($subject);
		$CI->email->message($msg_content);
		$CI->email->send();
		//echo $CI->email->print_debugger();
	}
	public static function view_permit(){
		$CI=& get_instance();
		$permit=$CI->session->userdata('permission');
		
		if($permit==1||$permit==3||$permit==5||$permit==7){
				return true;
		}
		else{
			return false;
		}
	}
	public static function add_permit($permit=''){
		$CI=& get_instance();
		if($permit==''){
		$permit=$CI->session->userdata('permission');
		}
		if($permit==2||$permit==3||$permit==6||$permit==7){
				return true;
		}
		else{
			return false;
		}
	}
	public static function update_permit($permit=''){
		$CI=& get_instance();
		if($permit==''){
		$permit=$CI->session->userdata('permission');
		}
		if($permit==4||$permit==5||$permit==6||$permit==7){
				return true;
		}
		else{
			return false;
		}
	}
}
?>