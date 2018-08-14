<?php
  require_once('page.class.php'); //分页类 
  $showrow = 1; //一页显示的行数 
  $curpage = empty($_GET['page']) ? 1 : $_GET['page']; //当前的页,还应该处理非数字的情况 
  $url = "?page={page}"; //分页地址，如果有检索条件 ="?page={page}&q=".$_GET['q'] 
  //省略了链接mysql的代码，测试时自行添加 

  $link = mysql_connect('localhost','root',''); 
  mysql_select_db("terminal",$link) or die("选择数据库失败".mysql_error());
  mysql_query("set names 'utf8'");

  $sql = "SELECT * FROM videolist"; 
  $total = mysql_num_rows(mysql_query($sql,$link)); //记录总条数 
  if (!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $showrow)) 
    $curpage = ceil($total_rows / $showrow); //当前页数大于最后页数，取最后一页 
    //获取数据 
    $sql .= " LIMIT " . ($curpage - 1) * $showrow . ",$showrow;"; 
    $query = mysql_query($sql,$link);
    $row = mysql_fetch_array($query);
    echo $row['id'];
?>