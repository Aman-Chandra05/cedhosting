<?php 
date_default_timezone_set("Asia/Kolkata");
class User
{
    public function register($name,$email,$password,$conpassword,$mobile,$question,$answer,$conn)
    {
        $err=array();
        $sql="SELECT * FROM `tbl_user` WHERE `email`='$email'";
	    $res=$conn->query($sql);
	    if($res->num_rows>0)
	    {
            $err['email']="* Email already registered.";
        }
        $sql="SELECT * FROM `tbl_user` WHERE `mobile`='$mobile'";
	    $res=$conn->query($sql);
	    if($res->num_rows>0)
	    {
            $err['mobile']="* Mobile Number already registered.";
        }
        if($password==$conpassword)
            $password=md5($password);
         else
            $err['password']="* Password does not match.";
        if(count($err)==0)
        {
            $date=date("Y/m/d H:i:s");
            $sql="INSERT INTO `tbl_user`(`email`, `name`, `mobile`, `email_approved`, `phone_approved`, `active`, `is_admin`, `sign_up_date`, `password`, `security_question`, `security_answer`) VALUES('$email','$name','$mobile','0','0','0','0','$date','$password','$question','$answer')";
            $res=$conn->query($sql);
        }
        $conn->close();
        return $err;
    }

    public function login($email,$password,$conn)
    {
        $password=md5($password);
        $sql="SELECT * FROM `tbl_user` WHERE `email`='$email' AND `password`='$password'";
        $res=$conn->query($sql);
		if($res->num_rows>0)
		{
            $row=$res->fetch_assoc();
            $conn->close();
            return $row;
		}
    	else
		{
            $conn->close();
            return 0;
		} 
    }
    public function emailverify($conn,$email=-1)
    {
        $success=0;
        if($email!=-1)
        {
            $sql="UPDATE `tbl_user` SET `email_approved`='1', `active`='1' WHERE `email`='$email'";
            $res=$conn->query($sql);
            if($res)
                $success=1;
        }
        $conn->close();
        return $success;
    }
    public function mobileverify($conn,$mobile=-1)
    {
        $success=0;
        if($email!=-1)
        {
            $sql="UPDATE `tbl_user` SET `phone_approved`='1', `active`='1' WHERE `mobile`='$mobile'";
            $res=$conn->query($sql);
            if($res)
                $success=1;
        }
        $conn->close();
        return $success;
    }
}
?>