<?defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?=base_url() ?>/public/css/reset.css" rel="stylesheet">
        <link href="<?=base_url() ?>/public/css/font-awesome/css/font-awesome.css" rel="stylesheet">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link href="<?=base_url() ?>/public/css/style.css" rel="stylesheet">
        <title><?=$title ?></title>
    </head>
    <body>
        <div id="wrapper">
            <? $this->load->view("templates/message") ?>
            <? $this->load->view($sub_view) ?>
            <div id="sticky-social">
                <ul>
                    <li><a href="<?=base_url('/logout') ?>" class="logout glyphicon glyphicon-log-out"><span>Đăng xuất</span></a></li>
                </ul>
            </div>
        </div>
        
        <script src="<?=base_url() ?>/public/js/jquery-3.2.1.min.js"></script>
        <script src="<?=base_url() ?>/public/js/jquery.form.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="<?=base_url() ?>/public/js/app.js"></script>
    </body>
</html>