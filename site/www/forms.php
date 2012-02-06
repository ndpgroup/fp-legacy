<?php
   /**
    * Display page for list of all recent forms in reverse-chronological order.
    */

    ini_set('include_path', ini_get('include_path').PATH_SEPARATOR.'../lib');
    require_once 'init.php';
    require_once 'data.php';
    require_once 'lib.auth.php';
    require_once 'lib.forms.php';

    /**** ... ****/
    
    session_start();
    $dbh =& get_db_connection();
    remember_user($dbh);
    
    $pagination = array('page' => $_GET['page'], 'perpage' => $_GET['perpage']);
    
    $forms = get_forms($dbh, $pagination);
    list($count, $offset, $perpage, $page) = get_pagination($pagination);

    $sm = get_smarty_instance();
    $sm->assign('forms', $forms);
    $sm->assign('language', $language);

    $sm->assign('count', $count);
    $sm->assign('offset', $offset);
    $sm->assign('perpage', $perpage);
    $sm->assign('page', $page);
    
    header("Content-Type: text/html; charset=UTF-8");
    print $sm->fetch("forms.html.tpl");

?>
