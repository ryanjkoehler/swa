<?php
include("config.php");
$search_term = filter_var($_GET["s"], FILTER_SANITIZE_STRING);
$q = "SELECT * FROM posts WHERE title LIKE '%".$search_term."%'";
$r = mysql_query($q);
if(mysql_num_rows($r)==0)//no result found
 {
 echo "<div id='search-status'>No result found!</div>";
 }
else //result found
 {
 echo "<ul>";
 while($row = mysql_fetch_assoc($r))
  {
  $title = str_ireplace($search_term, "<b>".$search_term."</b>", $row['title']);
?>
 <li><a href='<?php echo $row['url']; ?>'><?php echo $title ?></a></li>

<?php
  }
 echo "</ul>";
 }
?>
