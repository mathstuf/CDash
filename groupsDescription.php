<?php
/*=========================================================================

  Program:   CDash - Cross-Platform Dashboard System
  Module:    $Id$
  Language:  PHP
  Date:      $Date$
  Version:   $Revision$

  Copyright (c) 2002 Kitware, Inc.  All rights reserved.
  See Copyright.txt or http://www.cmake.org/HTML/Copyright.html for details.

     This software is distributed WITHOUT ANY WARRANTY; without even 
     the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR 
     PURPOSE.  See the above copyright notices for more information.

=========================================================================*/
include("config.php");
include("common.php"); 

$db = mysql_connect("$CDASH_DB_HOST", "$CDASH_DB_LOGIN","$CDASH_DB_PASS");
mysql_select_db("$CDASH_DB_NAME",$db);

?>
<html>
  <head>
   <title>CDash-Groups Description</title>
   <meta name="robots" content="noindex,nofollow" />
   <link rel="StyleSheet" type="text/css" href="cdash/cssfile"/>
  </head>
<body>
<table border="0" cellpadding="3" cellspacing="1" bgcolor="#0000aa" width="100%">
   <tr>
    <th class="table-heading1"><a href="#" class="jqmClose">[close]</a></th>
    <th class="table-heading1">CDash Build Group Description</th>
   </tr>
   <?php
    $i = 0;
   
   $project = $_GET["project"];
   $projectid = get_project_id($project);
   if($projectid<1)
     {
?>
</table>
<center><a href="#" class="jqmClose">Close</a></center>
</body>
</html>
<?php
     return;
     }
    $group = mysql_query("SELECT buildgroup.name,buildgroup.description
                          FROM buildgroup,buildgroupposition 
                          WHERE buildgroup.projectid='$projectid' 
                          AND buildgroup.id = buildgroupposition.buildgroupid
                          AND buildgroup.endtime = '0000-00-00 00:00:00'
                          AND buildgroupposition.endtime = '0000-00-00 00:00:00'
                          ORDER BY buildgroupposition.position ASC");
    while($group_array = mysql_fetch_array($group))
    {
   ?> 
    <tr class="<?php if($i%2==0) {echo "treven";} else {echo "trodd";} ?>">
       <td align="center" width="30%"><b><?php echo $group_array["name"]; ?></b></td>
       <td align="left"><?php echo $group_array["description"]; ?></td>
    </tr>
    <?php 
    $i++;
    } ?>
     <tr class="<?php if($i%2==0) {echo "treven";} else {echo "trodd";} $i++;?>">
       <td align="center" width="30%"><b>Coverage</b></td>
       <td align="left">Check how many current lines of code are currently tested</td>
    </tr>
    <tr class="<?php if($i%2==0) {echo "treven";} else {echo "trodd";}?>">
       <td align="center" width="30%"><b>Dynamic Analysis</b></td>
       <td align="left">Check if the current tests have memory defects</td>
    </tr>
    
</table>
<center><a href="#" class="jqmClose">Close</a></center>
</body>
</html>
