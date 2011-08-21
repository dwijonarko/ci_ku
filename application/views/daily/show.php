<h1>Daily Notes</h1>
<table >
 <tr >
 <th>No</th>
 <th>Date</th>
 <th>Name</th>
 <th>Amount</th>
 <th>Edit</th>
 <th>Delete</th>
 </tr>
 <?php
 $i=0;
 foreach ($query as $row){
 $i++;
 echo "<tr class=\"record\">";
 echo    "<td>$i</td>";
 echo    "<td>$row->date</td>";
 echo    "<td>$row->name</td>";
 echo    "<td>$row->amount</td>";
 echo    "<td><a href=\"#\" class=\"edit\" id=\"$row->id\" date=\"$row->date\" name=\"$row->name\" amount=\"$row->amount\">Edit</a></td>";
 echo    "<td><a class=\"delbutton\" id=\"$row->id\" href=\"#\" >Delete</a></td>";
 echo  "</tr>";
 }
 ?>
</table>
