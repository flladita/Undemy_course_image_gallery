<?php

class Photo extends Db_object {

    protected static $db_table = "photos";
    protected static $db_table_fields = array('title', 'time', 'description', 'image', 'author', 'type', 'size');
    public $id;
    public $title;
    public $description;
    public $image;
    public $author;



}


















?>