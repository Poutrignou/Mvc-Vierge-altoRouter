<?php

class Model_loggin extends Model
{
    public static function getModel()
    {
        if(is_null(Model::$instance)) {
            Model::$instance = new Model_loggin();
        }
        return Model::$instance;
    }

    
    public function getUserIdsFromEmail($email) {
        $reqSlq = "SELECT id_user, email, password FROM user WHERE email = :email";
        $r = $this->db->prepare($reqSlq);
        $r->execute([
            ':email' => $email
        ]);
        return $r->fetch(PDO::FETCH_OBJ);
    }
}