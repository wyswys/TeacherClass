<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
  <title>教师报课管理系统</title>
  <script type="text/javascript" src="../../../js/jquery.min.js"></script>
   <script type="text/javascript">
    jQuery.fn.rowspan = function(colIdx) { //封装的一个JQuery小插件
    return this.each(function(){
    var that;
    $('tr', this).each(function(row) {
    $('td:eq('+colIdx+')', this).filter(':visible').each(function(col) {
    if (that!=null && $(this).html() == $(that).html()) {
    rowspan = $(that).attr("rowSpan");
    if (rowspan == undefined) {
    $(that).attr("rowSpan",1);
    rowspan = $(that).attr("rowSpan"); }
    rowspan = Number(rowspan)+1;
    $(that).attr("rowSpan",rowspan);
    $(this).hide();
    } else {
    that = this;
    }
    });
    });
    });
    }
    $(function() {
    $("#table_cl_info").rowspan(0);//
   
    });
</script> 
  
  <script type="text/javascript">
   $(function(){
    setSize();
   }
    )
       $(window).resize(function(){
          setSize();
       });
        function setSize() {
            var height1 = $("#bgConsure").height();
            var height2 = $("#footer").height();
            var number = parseInt(height1);
            var right_nav = $("#right-nav").height();
            var min_height = number - 110;
             var r_min_height = min_height - right_nav;
            $("#left").css('min-height', min_height);
            $("#right").css('min-height', min_height);
            $("#left").css('height', min_height);
            $("#right").css('height', min_height);
           
             $("#right-content").css('height', r_min_height);
            var left = $("#left").height();
            var width1 = $("#container").width();
            var width11 = parseInt(width1);
            var width_status = width11 - 221;
            $("#status1").css('min-width',width_status);
             $("#status2").css('min-width',width_status);
            $("#right-text").css('width',width_status);
            //alert(left);
        }   
    </script> 
  <link href="../../../css/base.css" type="text/css" rel="stylesheet"/>
 </head>
 <body>

 <div id="container">
      <div id="head">
          <div id="logo">
            <img src="../../../image/logo.png" width="220" height="78">
          </div>
          <div id="status1">
            <?php 
                 session_start();
                 $work_number = $_SESSION["temp"][0];
                 header("Content-type: text/html; charset:utf-8");                 
                   $con = mysql_connect("localhost","root","");
                   if (!$con)
                  {
                         die('Could not connect: ' . mysql_error());
                  }
                  else
                  {
                      mysql_select_db("teacher_class_system", $con);
                      mysql_query("SET NAMES UTF8");
                      $result = mysql_query("SELECT * FROM user_teacher where workNumber=$work_number");
                      if(mysql_num_rows($result)>0)
                      {
                        $row = mysql_fetch_array($result);          
                        $GLOBALS['name']=$row['name'];
                      }
                  }
            ?>
            <a class="a_exit" href="../../index.php">退出系统</a>
            <p>欢迎您，<span>
              <?php  
               echo $name;
                   ?> 
            </span>老师</p>
          </div>
          <div id="status2">
          </div>
        </div>
        <div id="main-content">
          <div id="sider">
            <ul>    
             <li class="now_li"><a class="a_sider a_now" href="../teacher_table_overview"  >查看表格</a></li>
              <li><a class="a_sider" href="../teacher_fill_online">填写表格</a></li>
              <li><a class="a_sider" href="../teacher-information.php">个人信息</a></li>
            </ul>
          </div>
          <div id="right-text">
                <table class="table_gen" border="1">
              <!--此处应显示所有年份列表-->
              <?php
                 header("Content-type: text/html; charset:utf-8");                 
                   $con = mysql_connect("localhost","root","");
                   if (!$con)
                  {
                         die('Could not connect: ' . mysql_error());
                  }
                  else
                  {
                      $year = $_GET["year"];
                      $table_name = $_GET["table_name"];
                      mysql_select_db("teacher_class_system", $con);
                      mysql_query("SET NAMES UTF8");
                      //$year=date("Y");

                      //判断表格状态以选择显示分行表还是不分行表
                      $sql="SELECT taskState FROM task_info WHERE relativeTable='$table_name'";
                      $result = mysql_query($sql);
                      if(mysql_num_rows($result)>0)
                      $row = mysql_fetch_array($result);
                      //echo $row[0];
                      if($row[0]==2)
                      {
                          //如果是已经公示完的表格，显示最终结果，先输出一行提示
                          echo"<p class='empty-warning'>该表目前已公示</p>";
                          $table_name = 'cb_'.$table_name;
                          //echo $table_name;
                          $sql = "SELECT * FROM $table_name";
                          $result = mysql_query($sql);
                          if(mysql_num_rows($result)>0)
                          while($row = mysql_fetch_array($result))
                          {

                              echo"<tr><td>".$row['grade'];     
                              echo"<td>".$row['major']."</td>";
                              echo"<td>".$row['people']."</td>";
                              echo"<td>".$row['courseName']."</td>";
                              echo"<td>".$row['courseType']."</td>";
                              echo"<td>".$row['courseCredit']."</td>";
                              echo"<td>".$row['courseHour']."</td>";
                              echo"<td>".$row['practiceHour']."</td>";
                              echo"<td>".$row['onMachineHour']."</td>";
                              echo"<td>".$row['timePeriod']."</td>";
                              echo"<td>".$row['teacherName']."</td>";
                              echo"<td>".$row['remark']."</td>";
                              echo"</td></tr>";
                            
                          }
                      }
                      else
                      {

                          //否则，说明表格还没公示，显示填报记录，但是要先判断填报记录是否为0
                          $sql = "SELECT count(*) FROM $table_name WHERE workNumber='$work_number'";
                          $result = mysql_query($sql);
                          if(mysql_num_rows($result)>0)
                          $row = mysql_fetch_array($result);
                          if($row[0]==0)
                          {
                            echo"<p class='empty-warning'>您暂时还没有填报该表</p>";
                          }
                          else{
                            echo"<p class='completed-warning'>该表暂未公示,您的填报记录为：</p>";
                            $sql = "SELECT * FROM $table_name WHERE major=''or major='专业'";
                            $result = mysql_query($sql);
                            if(mysql_num_rows($result)>0)
                            while($row = mysql_fetch_array($result))
                            {
                              echo"<tr><td>".$row['grade'];     
                                echo"<td>".$row['major']."</td>";
                                echo"<td>".$row['people']."</td>";
                                echo"<td>".$row['courseName']."</td>";
                                echo"<td>".$row['courseType']."</td>";
                                echo"<td>".$row['courseCredit']."</td>";
                                echo"<td>".$row['courseHour']."</td>";
                                echo"<td>".$row['practiceHour']."</td>";
                                echo"<td>".$row['onMachineHour']."</td>";
                                echo"<td>".$row['timePeriod']."</td>";
                                echo"<td>".$row['teacherName']."</td>";
                                echo"<td>".$row['remark']."</td>";
                                echo"</td></tr>";
                            }
                            //echo $work_number;
                            $sql = "SELECT * FROM $table_name WHERE workNumber='$work_number'";
                            $result = mysql_query($sql);
                            if(mysql_num_rows($result)>0)
                            while($row = mysql_fetch_array($result))
                            {

                                echo"<tr><td>".$row['grade'];     
                                echo"<td>".$row['major']."</td>";
                                echo"<td>".$row['people']."</td>";
                                echo"<td>".$row['courseName']."</td>";
                                echo"<td>".$row['courseType']."</td>";
                                echo"<td>".$row['courseCredit']."</td>";
                                echo"<td>".$row['courseHour']."</td>";
                                echo"<td>".$row['practiceHour']."</td>";
                                echo"<td>".$row['onMachineHour']."</td>";
                                echo"<td>".$row['timePeriod']."</td>";
                                echo"<td>".$row['teacherName']."</td>";
                                echo"<td>".$row['remark']."</td>";
                                echo"</td></tr>";
                              
                            }
                          }
                          //echo $sql;
                          //echo ;
                      }
                      
                      
                  }
              ?>
            </table>
            <div>
        </div>
 </div>
  <div id ="footer">
    <p>2015@stc system by Mr.Linlin ma</p>
  </div>
 </body>
</html>
