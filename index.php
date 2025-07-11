<?php

$request = $_SERVER['REQUEST_URI'];

switch (true) {
    case $request === '/home':
        include './private/pages/home.php';
        break;
    case $request === '/page1':
        include './private/pages/page1.php';
        break;
    case $request === '/page2':
        include './private/pages/page2.php';
        break;
    case $request === '/page3':
        include './private/pages/page3.php';
        break;
    case $request === '/contact':
        include './private/pages/contact.php';
        break;
    case $request === '/login':
        include './private/pages/login.php';
        break;
    case $request === '/dashboard':
        include './private/pages/dashboard.php';
        break;
    case $request === '/crud':
        include './private/pages/crud.php';
        break;
    case $request === '/logout':
        include './private/pages/logout.php';
        break;
    case $request === '/votes':
        include './private/pages/votes.php';
        break;
    default:
        if (strpos($request, '/edit') === 0 && isset($_GET['id'])) {
            include './private/pages/edit.php';
        } else if (strpos($request, '/article') === 0 && isset($_GET['id'])) {
            include './private/pages/article.php';
        } else if (strpos($request, '/delete') === 0 && isset($_GET['id'])) {
            include './private/pages/delete.php';
        } else if (strpos($request, '/votes') === 0 && isset($_GET['jeu_id'])) {
            include './private/pages/votes.php';
        } else {
            include './private/pages/notfound.php';
        }
        break;
}
