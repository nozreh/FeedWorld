<style type="text/css">
.ac_results { padding: 0px; border: 1px solid black; background-color: white; overflow: hidden; z-index: 99999; }
.ac_results ul { width: 100%; list-style-position: outside; list-style: none; padding: 0; margin: 0; }
.ac_results li { margin: 0px; padding: 2px 5px; cursor: default; display: block; font: menu; font-size: 12px; line-height: 16px; overflow: hidden; }
.ac_results li span.email { font-size: 10px; } 
.ac_loading { background: white url('<?php echo $this->config->item('staticPath'); ?>/images/loader.gif') right center no-repeat; }
.ac_odd { background-color: #eee; }
.ac_over { background-color: #0A246A; color: white; }
 @media only print
{
    #footer, #header, #navigation, .sidebar{ display:none; }
}
</style>

<script language="javascript" type="text/javascript">
function formatItem(row) {
	if (row[0].length) return row[1]+'<br /><span class="email">(#'+row[0]+')</span>';
	else return 'No results';
}
$(function(){
	
	$('select#filter').change(function(){
		var status = ($(this).val());
		window.location.href = '<?php echo site_url('/admin/shop/reports'); ?>/'+status;
	});	
});

function printReport()
{
  $("#footer, #header, #navigation, .headingright, #totop").hide();
  window.print();
  $("#footer, #header, #navigation, .headingright, #totop").show();
}

</script>

<h1 class="headingleft">Reports <?php if ($trackingStatus) echo '('.$statusArray[$trackingStatus].')'?></h1>

<div class="headingright">

	<label for="filter">
		Filter
	</label> 

	<?php
		foreach ($statusArray as $key => $status):
			$options[$key] = $status;
		endforeach;
		
		echo form_dropdown('filter',$options,$trackingStatus,'id="filter"');
	?>
	
	<a href="<?php echo site_url('/admin/shop/export_orders'); ?>" class="button blue">Export Orders as CSV</a>
    <a href="#" class="button green" onclick="printReport();">Print Reports</a>

</div>

<div class="clear"></div>

<?php if ($orders): ?>

<?php echo $this->pagination->create_links(); ?>

<table id="reportTable" class="default">
	<tr>
		<th>Order ID</th>
		<th>Date Ordered</th>
		<th>Full Name</th>
		<th>Number of Items</th>
		<th class="narrow">Total (<?php echo currency_symbol(); ?>)</th>
		<th>Status</th>
		<th class="tiny">&nbsp;</th>
	</tr>
 <?php $total = 0; ?>  
<?php foreach ($orders as $order): 
	if (!$order['viewed']) $class = 'style="font-weight: bold;"'; else $class='';
?>
	<tr <?php echo $class ?>>
		<td><?php echo anchor('/admin/shop/view_order/'.$order['transactionID'], $order['transactionCode']); ?></td>
		<td><?php echo dateFmt($order['dateCreated'], '', '', TRUE); ?></td>
		<td><?php echo $order['firstName']; ?> <?php echo $order['lastName']; ?></td>
		<td><?php echo $order['numItems']; ?></td>
		<td><?php echo currency_symbol().number_format($order['amount'],2); ?></td>
        <?php $total += $order['amount']; ?>
		<td>
			<?php
				if ($order['trackingStatus'] == 'U' && $order['paid']) echo 'Unprocessed';
				elseif ($order['trackingStatus'] == 'L') echo 'Allocated';
				elseif ($order['trackingStatus'] == 'A') echo 'Awaiting Goods';
				elseif ($order['trackingStatus'] == 'O') echo 'Out of Stock';
				elseif ($order['trackingStatus'] == 'D') echo 'Dispatched';
				else echo 'Unpaid Checkout';
			?>
		</td>
		<td><?php echo anchor('/admin/shop/view_order/'.$order['transactionID'], 'View'); ?></td>
		
	</tr>
<?php endforeach; ?>
    <tr><td colspan="8" style="padding-left: 57%" ><strong>Total Amount:&nbsp;&nbsp;<?php echo currency_symbol().number_format($total,2); ?></strong></td></tr>
</table>
<?php echo $this->pagination->create_links(); ?>

<p style="text-align: right;"><a href="#" class="button grey" id="totop">Back to top</a></p>

<?php else: ?>

<p class="clear">There were no orders found.</p>

<?php endif; ?>

