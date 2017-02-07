<?php
/**
 * Created by PhpStorm.
 * User: zhaoh
 * Date: 2017/2/3
 * Time: 23:21
 */

require_once 'header.php';
require_once 'functions.php';
if (!$loggedin)
{
    header("Location: ./login");
    exit();
}

if (isset($_GET['id']))
{
    $id = sanitizeString($_GET['id']);
}


if (isset($_POST['name'])) {
    $result = false;
    $message = '';
    if (isset($_POST['name'])) $name = sanitizeString($_POST['name']);
    if (isset($_POST['type_id'])) $type_id = sanitizeString($_POST['type_id']);
    if (isset($_POST['group_id'])) $group_id = sanitizeString($_POST['group_id']);
    if (isset($_POST['answer'])) $answer = $_POST['answer'];

    if ($query = queryMysql("SELECT group_name FROM question_group WHERE group_id=$group_id"))
    {
        $query = $query->fetch_array(MYSQLI_ASSOC);
        $group_name = $query['group_name'];
    }

    switch ($type_id)
    {
        case 1:
        {
            $type_name = '单选题';
            break;
        }
        case 2:
        {
            $type_name = '多选题';
            break;
        }
        case 3:
        {
            $type_name = '填空题';
            break;
        }
    }


    if ($name != '') {
        if(queryMysql("INSERT INTO question(name,group_id,group_name,type_id,type_name,answer) VALUES ('$name','$group_id','$group_name','$type_id','$type_name','$answer')"))
            $result = true;
        else $result = false;

    }
    $data = compact('result','$message');
    $json = json_encode($data);
    echo $json;
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
                <li class="treeview">
                    <a href="./getBannerList">
                        <i class="fa fa-files-o"></i>
                        <span>banner管理</span>
                    </a>
                </li>
                <li class="active treeview">
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
        <!--Content Header (Page header) -->
        <!--<section class="content-header">-->
        <!--<h1>-->
        <!---->
        <!--<small>Preview</small>-->
        <!--</h1>-->
        <!--&lt;!&ndash;<ol class="breadcrumb">&ndash;&gt;-->
        <!--&lt;!&ndash;<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>&ndash;&gt;-->
        <!--&lt;!&ndash;<li><a href="#">Forms</a></li>&ndash;&gt;-->
        <!--&lt;!&ndash;<li class="active">General Elements</li>&ndash;&gt;-->
        <!--&lt;!&ndash;</ol>&ndash;&gt;-->
        <!--</section>-->

        <!-- Main content -->
        <section class="content">
            <div class="alert alert-danger alert-dismissable error_div" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <ul>
                    <li class="error_info"></li>
                </ul>
            </div>
            <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">服务问题编辑</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <div class="form-horizontal">
                            <form class="box-body problem_form" action="./createProblem" method="post">

<?php


                       echo <<<_END
<input class="group_id" type="text" value="$id" style="display: none;">
_END;

?>
                                <div class="form-group">
                                    <label for="q_name" class="col-sm-2 control-label">问题名称</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control name" id="q_name" placeholder="Question Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="q_type" class="col-sm-2 control-label">问题类型</label>
                                    <div class="col-sm-10" id="q_type">
                                        <select class="form-control type_id">
                                                                                        <option value="1">单选题</option>
                                                                                        <option value="2">多选题</option>
                                                                                        <option value="3">填空题</option>
                                                                                    </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">问题编辑</label>
                                    <div class="col-sm-10">
                                        <ul class="question_answer_list" id="question_answer_list">
                                        </ul>
                                        <div class="input-group" id="answer_addition">
                                            <span class="input-group-addon answer_tag"><i class="fa">A</i></span>
                                            <input type="text" class="form-control" placeholder="Please type an answer...">
                                            <span class="input-group-addon answer_add_btn" style="cursor: pointer"><i class="fa fa-plus"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </form><!-- /.box-body -->
                            <div class="box-footer">
                                <button type="reset" class="btn btn-default cancel">Cancel</button>
                                <button class="btn btn-info pull-right" id="question_submit_btn">Submit</button>
                            </div><!-- /.box-footer -->
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
    $(function () {
        //添加新的答案逻辑
        var letters = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n',
            'o','p','q','r','s','t','u','v','w','x','y','z'];
        var answerList = $(".question_answer_list");
        var answerTmp = '<li><span><em>@{answer_tag}@</em><label>@{answer_title}@</label><i class="fa fa-remove"></i></span></li>';
        var answerAddition = $('#answer_addition');
        answerAddition.on("click",".answer_add_btn",function () {
            var $this = $(this);
            var answer = $this.siblings("input").val();
            var curTag = $this.siblings(".answer_tag").children('i').html();
            if (answer.trim() != ""){
                var nextTag = letters[letters.indexOf(curTag.toLowerCase()) + 1];
                answerList.append(answerTmp.replace(/\@\{answer_tag\}\@/g,curTag).replace(/\@\{answer_title\}\@/g,answer));
                $this.siblings(".answer_tag").children('i').html(nextTag.toUpperCase());
            } else {
                $this.siblings("input").focus();
            }
        });
        answerList.on("click","i.fa-remove",function () {
            answerReSort($(this).parents("li"));
        })
        var answerReSort = function (rmEle) {
            rmEle ? rmEle.remove() : (false);
            console.log(answerList.children().length)
            answerList.children().each(function (index,ele) {
                console.log(index)
                $(ele).find("em").html(letters[index].toUpperCase());
            })
            answerAddition.find(".answer_tag").children('i').html(letters[answerList.children().last().index() + 1].toUpperCase());

        }
        answerReSort();

        var getAnswerList = function(){
            var dataList = [];
            $("#question_answer_list").children("li").each(function(index,ele){
                var list = {};
                list[$(ele).find("em").text()] = $(ele).find("label").text();
                dataList.push(list);
            });
//            console.log(dataList);
            return dataList;
        };

        $("#question_submit_btn").on("click",function(){
            var answer = getAnswerList();
            answer = JSON.stringify(answer);
            if($('.type_id').val()==3){
                answer = '';
            }
            $.ajax({
                type: "POST",
                url: $('.problem_form').attr('action'),
                dataType: 'json',
                data: {
                    name: $('.name').val(),
                    type_id: $('.type_id').val(),
                    group_id: $('.group_id').val(),
                    answer: answer
                },
                success:function(rs){
                    if(rs['result']==false){
                        $('.error_info').text(rs['message']);
                        $('.error_div').toggle();
                    }else{
                        $('.error_info').text('创建成功！');
                        $('.error_div').toggle();
                    }
                }
            });
        });
    });


</script>
</body>
</html>


