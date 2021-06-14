<?php

function dnd($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

function display_errors($errors)
{
    $display = '<ul class="bg-red">';
    foreach ($errors as $error) {
        $display .= '<li class="danger">' . $error . '</li>';
    }
    $display .= '</ul>';
    return $display;
}

function num_fo($number)
{
    return number_format($number, 2);
}

function sanitize($dirty)
{
    return htmlentities($dirty, ENT_QUOTES, "UTF-8");
}

function redirect($url)
{
    if (!headers_sent()) {
        header("Location: " . PROOT . $url);
        exit();
    }
}

function login_publisher($user_id)
{
    $_SESSION['PUBLISHER_SESSIONS'] = $user_id;
    global $db;
    $date = date("Y-m-d H:i:s");
    $db->query("UPDATE administrators SET last_login = '$date' WHERE id = '$user_id'");
    $_SESSION['success_mesg'] = 'You are now logined! Let\'s get started';
    header('Location: ' . "dashboard" . DS . "index.php");
}

function login_reviewer($user_id)
{
    $_SESSION['REVIEWER_SESSIONS'] = $user_id;
    global $db;
    $date = date("Y-m-d H:i:s");
    $db->query("UPDATE reviewers SET last_login = '$date' WHERE id = '$user_id'");
    $_SESSION['success_mesg'] = 'You are now logined! Let\'s get started';
    header('Location: ' . "dashboard" . DS . "index.php");
}

function login_researcher($user_id)
{
    $_SESSION['RESEARCHER_SESSIONS'] = $user_id;
    global $db;
    $date = date("Y-m-d H:i:s");
    $db->query("UPDATE researchers SET last_login = '$date' WHERE id = '$user_id'");
    $_SESSION['success_mesg'] = 'You are now logined! Let\'s get started';
    header('Location: ' . "dashboard" . DS . "index.php");
}

function is_logged_in()
{
    if (isset($_SESSION['PUBLISHER_SESSIONS']) && $_SESSION['PUBLISHER_SESSIONS'] > 0) {
        return true;
    } elseif (isset($_SESSION['REVIEWER_SESSIONS']) && $_SESSION['REVIEWER_SESSIONS'] > 0) {
        return true;
    } elseif (isset($_SESSION['RESEARCHER_SESSIONS']) && $_SESSION['RESEARCHER_SESSIONS'] > 0) {
        return true;
    } else {
        return false;
    }
}

function login_error_redirect($url = 'index.php')
{
    $_SESSION['error_mesg'] = 'You must be logged in to access that page';
    header('Location: ' . $url);
    exit;
}

function error_redirect($url)
{
    $_SESSION['error_mesg'] = 'You must be logged in to access that page';
    header('Location: ' . $url);
    exit;
}

function auto_refresh_page($path)
{
    $url = $_SERVER['REQUEST_URI'];
    header('Refresh: 10; URL =' . $url . $path);
}


function get_category($child_id)
{
    global $db;
    $id = sanitize($child_id);
    $sql = "SELECT
                p.id AS 'pid',
                p.category AS 'parent',
                c.id AS 'cid',
                c.category AS 'child'
            FROM
                res_area c
            INNER JOIN res_area p ON
                c.parent = p.id
            WHERE
                c.id = '$id'";
    $query = $db->query($sql);
    $res_feild = mysqli_fetch_assoc($query);
    return $res_feild;
}

function itemToArray($string)
{
    $itemsArray = explode(',', $string);
    $returnArray = array();
    foreach ($itemsArray as $item) {
        $s = explode(':', $item);
        $returnArray[] = array('rev_id' => $s[0], 'seen on selection' => $s[1]);
    }
    return $returnArray;
}

function itemToString($items)
{
    $itemString = '';
    foreach ($items as $item) {
        $itemString .= $item['rev_id'] . ':' . $item['seen on selection'] . ',';
    }
    return rtrim($itemString, ',');
}


function stringDate_to_time($date)
{
    // return all values such as the year, day, time and AM or PM  
    return date("M d, Y h:i A", strtotime($date));
}

function month_day_year_formate($date)
{
    return date("M d, Y", strtotime($date));
}

function month_time($date)
{
    return date("h:i A, d M", strtotime($date));
}
