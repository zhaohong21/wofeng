<?php
/**
 * Created by PhpStorm.
 * User: zhaoh
 * Date: 2017/2/5
 * Time: 10:16
 */

require_once 'header.php';
require_once 'functions.php';
if (!$loggedin)
{
    header("Location: ./login");
    exit();
}

if (isset($_GET['id'])) $id = sanitizeString($_GET['id']);
else
{
    header("Location: ./messageList");
    exit();
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | General Form Elements</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="../dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Administrator</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">主导航</li>
                <li class="treeview">
                    <a href="./index">
                        <i class="fa fa-dashboard"></i> <span>主面板</span></i>
                    </a>
                </li>
                <li class="treeview">
                    <a href="./getAboutUsInfo">
                        <i class="fa fa-files-o"></i>
                        <span>关于我们</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="./getBannerList">
                        <i class="fa fa-files-o"></i>
                        <span>banner管理</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="./queryProblemGroup">
                        <i class="fa fa-files-o"></i>
                        <span>服务问题</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="./getUserInfo">
                        <i class="fa fa-files-o"></i>
                        <span>用户答案</span>
                    </a>
                </li>
                <li class="active treeview">
                    <a href="./messageList">
                        <i class="fa fa-files-o"></i>
                        <span>用户留言</span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!--<section class="content-header">-->
        <!--<h1>-->
        <!--General Form Elements-->
        <!--<small>Preview</small>-->
        <!--</h1>-->
        <!--<ol class="breadcrumb">-->
        <!--<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>-->
        <!--<li><a href="#">Forms</a></li>-->
        <!--<li class="active">General Elements</li>-->
        <!--</ol>-->
        <!--</section>-->

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">用户留言详情</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal">
                            <?php

                            if ($query = queryMysql("SELECT * FROM message WHERE id=$id"))
                            {
                                if ($query->num_rows)
                                {
                                    $row = $query->fetch_array(MYSQLI_ASSOC);

                                    $name = $row['name'];
                                    $phone = $row['phone'];
                                    $email = $row['email'];
                                    $content = $row['content'];

                                    echo <<<HTML
<div class="box-body">
                    <div class="form-group">
                      <label for="u_name" class="col-sm-2 control-label">用户名称</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="u_name" disabled="" value="$name">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="u_phone" class="col-sm-2 control-label">联系电话</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="u_phone" disabled="" value="$phone">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="c_email" class="col-sm-2 control-label">邮箱地址</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="c_email" disabled="" value="$email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">用户留言</label>
                      <div class="col-sm-10">
                                                                                          <div style="display: inline;">
                                    留言1:
                                  </div>
                                                          <blockquote>
                              <p>
                                  $content
                              </p>
                            </blockquote>
                                                </div>
                    </div>
                  </div>
HTML;

                                }
                            }

                            ?>
                            <div class="box-footer">
                                <button type="reset" class="btn btn-default" onclick="history.go(-1)"><i class="fa fa-arrow-left"></i> Go Back</button>
                            </div><!-- /.box-footer -->
                        </form>
                    </div><!-- /.box -->
                </div><!--/.col (right) -->
            </div>   <!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
    </footer>

    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
    });
</script>
</body>
</html>

