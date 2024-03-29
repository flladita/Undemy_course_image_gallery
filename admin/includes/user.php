<?php

class User extends Db_object {

    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'image');
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $image;

    public static function verify_user($username,$password ) {

        global $database;

        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " .self::$db_table . " WHERE ";
        $sql .= "username = '{$username}'";
        $sql .= "AND password = '{$password}'";
        $sql .= "LIMIT 1";

        $the_result_array = self::find_by_query($sql);

        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public function image_path_and_placeholder()
    {
        return empty($this->image) ? $this->upload_directory.DS.$this->image_placeholder : $this->upload_directory.DS.$this->image;
    }
}
?>