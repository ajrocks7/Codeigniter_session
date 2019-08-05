<?php 
class Login_model extends CI_Model{
    function __construct()
    {
        parent::__construct();
        $this->load->library('Password');
    }
   
    
   public function generatepasswordforadmin()
   {
    $password =substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 8);
    $hashToStoreInDb = password_hash($password, PASSWORD_BCRYPT);
    $isPasswordCorrect = password_verify($password, $hashToStoreInDb);
    if($isPasswordCorrect)
    {
      $details['login']['password'] = $hashToStoreInDb;
      $details['login']['dummypass'] = $password;
      $details['login']['userrole'] = "Admin";
      $details['login']['usertype'] = "1";
       $this->db->insert('login',$details['login']);
    }
   }

   public function generatepasswordforuser()
   {
    $password =substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 8);
    $hashToStoreInDb = password_hash($password, PASSWORD_BCRYPT);
    $isPasswordCorrect = password_verify($password, $hashToStoreInDb);
    if($isPasswordCorrect)
    {
      $details['login']['password'] = $hashToStoreInDb;
      $details['login']['dummypass'] = $password;
      $details['login']['userrole'] = "User";
      $details['login']['usertype'] = "2";
       $this->db->insert('login',$details['login']);
    }
   }

   public function checklogin($data = array(),$set_session = true)
   {
    $typedpassword = $data['password'];
    $username = $data['username'];
    $getdetails = $this->db->select('*')->from('login')->where('userrole',$username)->get()->row();
    $dbpasssword = $getdetails->password;
    $validate_password = password_verify($typedpassword, $dbpasssword);
    if($validate_password)
    {
         if ($set_session) {
                    $userdata = $getdetails;
                    $user_data = array("user_role" => $userdata->userrole, "user_type" =>$userdata->usertype);
                    $this->phpsession->save($user_data);
                }
       return 1;
    }else{
        return 2;
    }
   }

}
