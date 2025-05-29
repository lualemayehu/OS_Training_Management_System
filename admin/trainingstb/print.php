<!DOCTYPE html>
<?php
	
	include('../includes/config.php');
?>
<html lang="en">
	<head>
		<style>	
		.table {
			width: 100%;
			margin-bottom: 20px;
		}	
		
		.table-striped tbody > tr:nth-child(odd) > td,
		.table-striped tbody > tr:nth-child(odd) > th {
			background-color: #f9f9f9;
		}
		
		@media print{
			#print {
				display:none;
			}
		}
		@media print {
			#PrintButton {
				display: none;
			}
		}
		
		@page {
			size: auto;   /* auto is the initial value */
			margin: 0;  /* this affects the margin in the printer settings */
		}
	</style>
	</head>
<body>
	<h2>African Leadership Excellence Academy</h2>
	<br /> <br /> <br /> <br />
	<b style="color:blue;">Date Prepared:</b>
	<?php
		$date = date("Y-m-d", strtotime("+6 HOURS"));
		echo $date;
	?>
	<br /><br />
	<table class="table table-striped">
		<thead>
			<tr>
				<th class="tg-ldzw">Subject/Tittle</th>
				<th class="tg-ldzw">Request Date</th>	
				<th class="tg-ldzw">Start Date </th>
				<th class="tg-ldzw">End Date</th>
				<th class="tg-ldzw">Trainee Level</th>			
				<th class="tg-ldzw">Mode of Delivery</th>
				<th class="tg-ldzw">Medium of Communication</th>
				<th class="tg-ldzw">Key note Speaker</th>
				<th class="tg-ldzw">Organization</th>
			</tr>
		</thead>
		<tbody>
			<?php
				
				
				$query = $conn->query("SELECT * FROM `event`");
				while($fetch = $query->fetch_array()){
					
			?>
			
			<tr>
				<td style="text-align:center;"><?php echo $fetch['ev_tittle_subject']?></td>
				<td style="text-align:center;"><?php echo $fetch['ev_request_date']?></td>
				<td style="text-align:center;"><?php echo $fetch['ev_start_date']?></td>
				<td style="text-align:center;"><?php echo $fetch['ev_end_date']?></td>
				<td style="text-align:center;"><?php echo $fetch['ev_level']?></td>
				<td style="text-align:center;"><?php echo $fetch['ev_mode_of_delivery']?></td>
				<td style="text-align:center;"><?php echo $fetch['ev_language']?></td>
				<td style="text-align:center;"><?php echo $fetch['ev_key_note']?></td>
				<td style="text-align:center;"><?php echo $fetch['fk_organization']?></td>
			</tr>
			
			<?php
				}
			?>
		</tbody>
	</table>
	<center><button id="PrintButton" onclick="PrintPage()">Print</button></center>
</body>
<script type="text/javascript">
	function PrintPage() {
		window.print();
	}
	document.loaded = function(){
		
	}
	window.addEventListener('DOMContentLoaded', (event) => {
   		PrintPage()
		setTimeout(function(){ window.close() },750)
	});
</script>
</html>


