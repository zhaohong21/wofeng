<?php
/**
 * Created by PhpStorm.
 * User: zhaoh
 * Date: 2017/2/3
 * Time: 16:57
 */

require_once 'functions.php';
require_once 'header.php';

if (!$loggedin)
{
    header("Location: ./login");
    exit();
}



echo <<<HTML

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
    <link rel="stylesheet" href="../dist/css/custom.css">

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
              <li class="active treeview">
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
              <li class="treeview">
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
                  <h3 class="box-title">Banner管理</h3>
                                                                        </div><!-- /.box-header -->
                <!-- form start -->
                  <div class="box-body">
                    <div class="row banner_manage_container">
                        <form action="./createBanner" method="post" enctype="multipart/form-data">
                      <div class="col-sm-6">
                      <div class="banner_manage_box">
                        <div class="banner_item">
                          <div class="form-horizontal banner_edit active">
                            <div class="form-group">
                              <label class="col-sm-2 control-label">图片</label>
                              <div class="col-sm-10">
                                <input type="file" class="form-control" name="file">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 control-label">主标题</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="b_title" placeholder="Main Title">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 control-label">副标题</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="s_title" placeholder="Subtitle">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 control-label"></label>
                              <div class="col-sm-10">
                                <button type="submit" class="btn btn-info banner_edit_submit">提交</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                        </form>       
HTML;

if ($query = queryMysql("SELECT * FROM banner"))
{
    if ($query->num_rows)
    {
        while ($row = $query->fetch_array(MYSQLI_ASSOC))
        {
            $id = $row['id'];
            $address = $row['banner_address'];
            $b_title = $row['b_title'];
            $s_title = $row['s_title'];


            echo <<<_END
<form action="./editBanner" method="post" enctype="multipart/form-data">
                                <input type="text" name="id" value="$id" style="display: none;">
                      <div class="col-sm-6">
                        <div class="banner_manage_box">
                          <div class="banner_item" style="background-image: url('../$address')">
                            <div class="form-horizontal banner_edit">
                              <div class="form-group">
                                <label class="col-sm-2 control-label">图片</label>
                                <div class="col-sm-10">
                                  <input type="file" class="form-control" name="file">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">主标题</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="b_title" value="$b_title" placeholder="Main Title">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">副标题</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="s_title" value="$s_title" placeholder="Subtitle">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                  <button type="button" class="btn btn-default banner_edit_close">取消</button>
                                  <button class="btn btn-info banner_edit_submit">提交</button>
                                </div>
                              </div>
                            </div>
                              <span class="banner_remove_btn" title="删除Banner" onclick="delete_banner($id)">
                                 <i class="fa fa-remove"></i>
                              </span>
                            <div class="banner_info">
                              <h3> </h3>
                              <span> </span>
                              <button type="button" class="btn btn-primary banner_edit_btn">编辑</button>
                            </div>
                          </div>
                        </div>
                      </div>
                        </form>
_END;
        }
    }
}



echo <<<HTML
                                            </div>
                  </div>
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
        <p class="delete_url" url="./deleteBanner" style="display: none;"></p>
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

    <!-- jQuery 2.2.3 -->
    <script src="../plugins/jQuery/jQuery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>

    <script>
      $(function () {
//        关闭编辑
        $(".banner_manage_container").on("click",".banner_edit_close",function () {
          $(this).parents(".banner_edit").removeClass("active");
        })
//        开启编辑
        $(".banner_manage_container").on("click",".banner_edit_btn",function () {
          $(this).parent().siblings(".banner_edit").addClass("active");
        })
//        删除Banner
        $(".banner_manage_container").on("click",".banner_remove_btn",function () {
          $(this).parent().siblings(".banner_edit").addClass("active");
        })
//        提交Banner变更
        $(".banner_manage_container").on("click",".banner_edit_submit",function () {
          var verify = true;
          $(this).parents(".banner_edit").find("input").each(function (index,ele) {
            if ($(ele).val().trim() == ""){
              verify = false;
            }
          });
          if (verify){
//            允许提交

            console.log("Submit");
          } else {
            alert("请填写完整信息！")
          }
        })
//        新增一个Banner
//        var bannerTmp = $("#banner_templete").html();
//        $(".banner_add_new").on('click',function () {
//          $(".banner_manage_container").append(bannerTmp);
//        })

      });

        function delete_banner(banner_id){
            $.post($('.delete_url').attr('url'),{id:banner_id},function(data){

                if(data['result']==true){
                    window.location.reload();
                }else{
                    window.confirm(data['message']);
                }
            });
        }
    </script>
  </body>
</html>

HTML;
