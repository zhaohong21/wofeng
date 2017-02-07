<?php
/**
 * Created by PhpStorm.
 * User: zhaoh
 * Date: 2017/2/4
 * Time: 18:28
 */

require_once 'header.php';
require_once 'functions.php';
if (!$loggedin)
{
    header("Location: ./login");
    exit();
}

$f_group_id = $f_status = $f_keyword = $where ='';
$page = 1;

if (isset($_GET['group_id'])) $f_group_id = sanitizeString($_GET['group_id']);
if (isset($_GET['status'])) $f_status = sanitizeString($_GET['status']);
if (isset($_GET['keyword'])) $f_keyword = sanitizeString($_GET['keyword']);
if (isset($_GET['page'])) $page = sanitizeString($_GET['page']);

if ($f_group_id != '' || $f_status != '' || $f_keyword != '')
{
    if ($f_group_id != '')
    {
        if ($g_keyword = queryMysql("SELECT keyword FROM question_group WHERE group_id=$f_group_id"))
        {
            $g_keyword = $g_keyword->fetch_array(MYSQLI_ASSOC);
            $g_keyword = $g_keyword['keyword'];
        }
        $where = " WHERE keyword='$g_keyword'";
        if ($f_status != '')
        {
            $where = " WHERE keyword='$g_keyword' AND status=$f_status";
            if ($f_keyword != '')
            {
                $where = " WHERE keyword='$g_keyword' AND status=$f_status AND (name='$f_keyword' OR phone=$f_keyword)";
            }
        }
    }
    else
    {
        if ($f_status != '')
        {
            $where = " WHERE status=$f_status";
            if ($f_keyword != '')
            {
                $where = " WHERE status=$f_status AND (name='$f_keyword' OR phone=$f_keyword)";
            }
        }
        else
        {
            if($f_keyword != '')
            {
                $where = " WHERE name='$f_keyword' OR phone=$f_keyword";
            }
        }
    }

}

$result = array();
if ($query = queryMysql("SELECT * FROM answer$where"))
{
    if ($query->num_rows != 0)
        while ($row = $query->fetch_array(MYSQLI_ASSOC))
        {
            $result[] = $row;
        }
}

$num = count($result);
$size = 15;
$total_page = ceil($num/$size);
if ($page <= $total_page) {
    $result = array_slice($result, $size * ($page - 1), $size);
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
              <li class="active treeview">
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
        <section class="content-header">
          <h1>
            用户答题列表
            <!--<small>Preview</small>-->
          </h1>
          <!--<ol class="breadcrumb">-->
            <!--<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>-->
            <!--<li><a href="#">Forms</a></li>-->
            <!--<li class="active">General Elements</li>-->
          <!--</ol>-->
        </section>

        <!-- Main content -->
        <section class="content">
                      <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- Horizontal Form -->
              <div class="box box-info">
                  <form action="./getUserInfo" method="get" style="display: inline;">
                    <div class="box-header with-border">
                          <label>问答分组：</label>
                          <select class="form-control" name="group_id" style="display: inline-block; width: 100px;" onchange="submitForm()">
                            <option value="">全部</option>
                              <?php

                              if ($query = queryMysql("SELECT * FROM question_group"))
                              {
                                  if ($query->num_rows != 0)
                                  {
                                      while ($row = $query->fetch_array(MYSQLI_ASSOC))
                                      {
                                          $gi = $row['group_id'];
                                          $gn = $row['group_name'];
                                          echo <<<HTML
<option value="$gi" >$gn</option>
HTML;

                                      }
                                  }
                              }
                              ?>
                                                        </select>
                            <label style="margin-left: 30px">状态：</label>
                              <select class="form-control" name="status" style="display: inline-block;width: 100px;"  onchange="submitForm()">
                                <option value="" >全部</option>
                                <option value="1" >已处理</option>
                                <option value="0" >未处理</option>
                              </select>
                      <div class="box-tools">
                        <div class="input-group input-lg" style="width: 250px;">
                          <input type="text" name="keyword" class="form-control input-sm pull-right" value="" placeholder="Search by Name or Phone...">
                          <div class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                          </div>
                        </div>
                      </div>
                    </div><!-- /.box-header -->
                      <input class="query_submit" type="submit" style="display: none;">
                  </form>
                <div class="box-body">
                  <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th>用户名</th>
                      <th>联系电话</th>
                      <th>邮箱地址</th>
                      <th>分组</th>
                      <th>状态</th>
                      <th style="width: 130px">操作</th>
                    </tr>
<?php

foreach ($result as $v)
{
    extract($v);
    $group_name = '';
    if ($query = queryMysql("SELECT group_name FROM question_group WHERE keyword='$keyword'"))
    {
        if ($query->num_rows != 0)
        {
            $row = $query->fetch_array(MYSQLI_ASSOC);
            $group_name = $row['group_name'];
        }
    }

    echo <<<HTML
<tr>
                          <td>$id</td>
                          <td>$name</td>
                          <td>$phone</td>
                          <td>$email</td>
                          <th>$group_name</th>
                          <th>
HTML;

    if ($status == 0) echo "<span class=\"badge bg-red\">未处理</span>                          </th>";
    else if ($status == 1) echo "<span class=\"badge bg-green\">已处理</span>                          </th>";

    echo <<<HTML
                          <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-xs btn-info" onclick="location = './getGroupAnswer?id=$id'">详情</button>
                                <button type="button" class="btn btn-xs btn-danger" onclick="location = './deleteGroupAnswer?id=$id'">删除</button>
                            </div>
                          </td>
                        </tr>
HTML;
}
?>
                                        </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <ul class="pagination pagination-sm no-margin pull-right"><ul class="pagination">

<?php

if ($page == 1)
{
    echo <<<HTML
<li class="disabled"><span>&laquo;</span></li>
HTML;
}
else
{
    $p = $page-1;
    echo <<<HTML
<li><a href="./getUserInfo?page=$p" rel="prev">«</a></li>
HTML;


}

for ($i=1;$i<($total_page+1);$i++)
{
    if ($i == $page)
    {
        echo <<<HTML
<li class="active"><span>$i</span></li>
HTML;

    }
    else
    {
        echo <<<HTML
<li><a href="./getUserInfo?page=$i">$i</a></li>
HTML;

    }
}
if ($page == $total_page)
{
    echo <<<HTML
<li class="disabled"><span>»</span></li>
HTML;
}
else
{
    $p = $page+1;
    echo <<<HTML
<li><a href="./getUserInfo?page=$p" rel="next">»</a></li>
HTML;

}
?>
                  </ul>
                </div>
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

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked>
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right">
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
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
    <script>
        var submitForm = function(){
    $('.query_submit').trigger('click');
};
    </script>
  </body>
</html>
