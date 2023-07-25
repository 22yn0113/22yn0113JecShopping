<?php
require_once 'DAO.php';

class Member
{
    public int    $memberid;
    public string $email;
    public string $membername;
    public string $zipcode;
    public string $address;
    public string $tel;
    public string $password;
}

class MemberDAO
{
    public function get_member(string $email, string $password)
    {
        $dbh = DAO::get_db_connect();

        $sql = "SELECT * FROM member WHERE email=:email";

        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        $stmt->execute();

        $member = $stmt->fetchObject('Member');

        if ($member !== false) {
            if (password_verify($password, $member->password)) {
                return $member;
            }
        }
        return false;
    }

    public function insert(Member $member)
    {
        $dbh=DAO::get_db_connect();

        $sql="INSERT INTO Member (email,membername,zipcode,address,tel,password)
        VALUES (:member->email,:member->membername,:member->zipcode,:member->address,:member->tel,:member->password)";

        $stmt=$dbh->prepare($sql);

        $password=password_hash($member->password,PASSWORD_DEFAULT);

        $stmt->bindValue(':member->email',$member->email,PDO::PARAM_STR);
        $stmt->bindValue(':member->mebername',$member->membername,PDO::PARAM_STR);
        $stmt->bindValue(':member->zipcode',$member->zipcode,PDO::PARAM_STR);
        $stmt->bindValue(':member->address',$member->address,PDO::PARAM_STR);
        $stmt->bindValue(':member->tel',$member->tel,PDO::PARAM_STR);
        $stmt->bindValue(':member->password',$password,PDO::PARAM_STR);

        $stmt->execute();
        
    }
}
