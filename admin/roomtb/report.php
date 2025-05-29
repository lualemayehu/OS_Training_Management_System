
<div class="container">
	<div class="panel ">
		<div class="panel-body">
		     
        <input type="text" id="report_search" onkeyup="myFunction()" placeholder="Search..." class="form-control mt-15" style="width: 30%">
                         
<form  method="post" action="list.php" target="_blank">
<span id="printout">

<table  class="table table-bordered" cellspacing="0">
<thead >
<tr><td colspan="9" align="center"><h1 class="page-header">AFLEX | TMS </h1></td></tr>
<tr class="table-dark">
<td ><strong>Full Name</strong></td>
<td ><strong>Arrival</strong></td>
<td ><strong>Departure</strong></td>
<td ><strong>Room</strong></td>
<td ><strong>Food Expence</strong></td>
<td ><strong>Drink Expence </strong></td>
<td ><strong>Total Expenditure</strong></td>
</tr>
</thead>
<tbody id="report_grid">		
<?php
	$sql ="SELECT * FROM `customer` LEFT JOIN `booking` ON `customer`.`cust_id`=`booking`.`cust_id` LEFT JOIN `room` ON `booking`.`room_no`=`room`.`room_no` ORDER BY `booking`.`booking_id`DESC";
    $b_id = mysqli_query($conn,$sql);
    while ($b_c = mysqli_fetch_array($b_id,MYSQLI_ASSOC)):; 
?>

				<tr >
				<td><?php echo $b_c['cust_title']?>&nbsp;<?php echo $b_c['cust_first_name']?>&nbsp;<?php echo $b_c['cust_middle_name']?>&nbsp;<?php echo $b_c['cust_last_name']?> ( <?php echo $b_c['cust_type']?> )</td>
				<td> <?php echo $b_c['check_in_date']?></td>
				<td><?php echo $b_c['check_in_date']?></td>
				<td><?php echo $b_c['fk_room']?></td>
				<td align="center">  <?php echo $b_c['food_price']?>Br</td>
				<td align="center"><?php echo $b_c['drink_price']?>Br</td>
				<td align="center"> <?php echo $b_c['total_price']?>Br</td>
				
				</tr>

			<?php 
            
endwhile;

?>
</tbody>
<tfoot>
</tfoot>
</table>
</span>
<input type="button" value="Print Report" onclick="tablePrint();" class="btn btn-primary">
</form>
</div>
</div> 

<script>
function tablePrint(){  
    var display_setting="toolbar=no,location=no,directories=no,menubar=no,";  
    display_setting+="scrollbars=no,width=500, height=500, left=100, top=25";  
    var content_innerhtml = document.getElementById("printout").innerHTML;  
    var document_print=window.open("","",display_setting);  
    document_print.document.open();  
    document_print.document.write('<body style="font-family:verdana; font-size:12px;" onLoad="self.print();self.close();" >');  
    document_print.document.write(content_innerhtml);  
    document_print.document.write('</body></html>');  
    document_print.print();  
    document_print.document.close();  
    return false;  
    } 
	$(document).ready(function() {
		oTable = jQuery('#list').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers"
		} );
	});		
</script>