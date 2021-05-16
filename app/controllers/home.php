<?php

// main homepage
$router->get('/', function() {
include "app/db.php";
$data = $mysqli->query("SELECT * FROM posts ORDER BY id DESC LIMIT 1, 27");
$featured = $mysqli->query("SELECT * FROM posts ORDER BY id DESC LIMIT 1");

// meta information
$meta_title = $app->home_title;
$meta_desc = $app->description;
$meta_keywords = $app->keywords;
$meta_url = root;
$meta_img = root."uploads/global/media.jpg";
$meta_time = "2021-05-09T16:46:15.000Z";
$meta_writer = "Qasim Hussain";

$title = $app->home_title;
$body = views."home.php";
include template;
});

// newsletters subsriber page
$router->post('newsletters', function() {
include "app/db.php";
$data = $mysqli->query("INSERT INTO `newsletters` (`id`, `name`, `email`, `created_at`) VALUES (NULL, '".$_POST['name']."', '".$_POST['email']."', current_timestamp())");
// redirect to success newsletters page
header('Location: '.root.'newsletters/success');
});

// post page
$router->get('newsletters/success', function() {

// meta information
$meta_title = $app->home_title;
$meta_desc = $app->description;
$meta_keywords = $app->keywords;
$meta_url = root;
$meta_img = root."uploads/global/media.jpg";
$meta_time = "2021-05-09T16:46:15.000Z";
$meta_writer = "Qasim Hussain";

include "app/db.php";
$title ="Newsletters";
$body = views."newsletters.php";
include template;
});

// main sitemap page
$router->get('sitemap.xml', function() {
header("Content-type: text/xml");
include "app/views/sitemap/sitemap.php";
});

// pages sitemap page
$router->get('sitemap-pages.xml', function() {
header("Content-type: text/xml");
include "app/db.php";
$pages = $mysqli->query("SELECT * FROM pages ORDER BY id DESC");
include "app/views/sitemap/sitemap_pages.php";
});

// posts sitemap page
$router->get('sitemap-posts.xml', function() {
header("Content-type: text/xml");
include "app/db.php";
$posts = $mysqli->query("SELECT * FROM posts ORDER BY id DESC");
include "app/views/sitemap/sitemap_posts.php";
});

// author sitemap page
$router->get('sitemap-authors.xml', function() {
header("Content-type: text/xml");
include "app/db.php";
$users = $mysqli->query("SELECT * FROM users ORDER BY id DESC");
include "app/views/sitemap/sitemap_authors.php";
});

// categories sitemap page
$router->get('sitemap-categories.xml', function() {
header("Content-type: text/xml");
include "app/db.php";
$categories = $mysqli->query("SELECT * FROM categories ORDER BY id DESC");
include "app/views/sitemap/sitemap_categories.php";
});

// categories sitemap page
$router->get('sitemap-tags.xml', function() {
header("Content-type: text/xml");
include "app/db.php";
$tags = $mysqli->query("SELECT * FROM posts ORDER BY id DESC");
include "app/views/sitemap/sitemap_tags.php";
});

// main homepage
$router->get('install', function() {

// Do not modify anything under this line :)
    class db {
    var $dbhost;
    var $dbuser;
    var $dbpassword;
    var $dbname;
    var $query;
        function connect() {
            $this->db = new mysqli($this->dbhost, $this->dbuser, $this->dbpassword, $this->dbname);
            mysqli_set_charset($this->db,"utf8");
        }
        function __construct() {
            $this->dbhost = server;
            $this->dbuser = username;
            $this->dbpassword = password;
            $this->dbname = dbname;
        }
    }
    $con = new db;
    $con->connect();
   // $res = $con->db->query("SELECT * FROM pt_accounts");
     $sql= file_get_contents('db.sql');
     foreach (explode(";\n", $sql) as $sql)
       {
         $sql = trim($sql);
           if($sql)
               {
                $con->db->query($sql);
               }
      }
      echo "<p>Installation Completed</p>";
});

// post page
$router->get('(.*)', function() {

include "app/db.php";
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url_end = array_slice(explode('/', rtrim($uri, '/')), -1)[0];
$data = $mysqli->query("SELECT * FROM `posts` WHERE `slug` LIKE '".$url_end."'");

if ($data->num_rows > 0) { foreach($data as $post) {
// meta information
$post_title = substr(strip_tags($post['content']), 0, 160);
$date=date_create($post['created_at']); $post_date = date_format($date,"Y-m-d")."T".date_format($date,"H:i:s");

$meta_title = $post['title'];
$meta_desc = $post_title;
$meta_keywords = $post['keywords'];
$meta_url = root.$post['slug'];
$meta_img = root."uploads/posts/".$post['img'];
$meta_time = $post_date.".000Z";
$meta_writer = "Qasim Hussain";

$title =$post['title'];
}}

$body = views."post.php";
include template;
$mysqli -> close();
});