<?php
/**
 * Admin booking cancelled email
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<p><?php _e( 'The following booking has been cancelled. The details of the cancelled booking can be found below.', 'woocommerce-bookings' ); ?></p>
<?php 
		$order = $booking->get_order();
		$tourtransfer_details = get_post_meta( $order->id, "_tourtransfer_details", true ); 
	?>
<table cellspacing="0" cellpadding="6" style="width: 100%; border: 1px solid #eee;" border="1" bordercolor="#eee">
	<tbody>
		<?php if ( $booking->get_product() ) : ?>
			<tr>
				<th scope="row" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Booked Product', 'woocommerce-bookings' ); ?></th>
				<td style="text-align:left; border: 1px solid #eee;"><?php echo $booking->get_product()->get_title(); ?></td>
			</tr>
		<?php endif; ?>
		<tr>
			<th style="text-align:left; border: 1px solid #eee;" scope="row"><?php _e( 'Booking ID', 'woocommerce-bookings' ); ?></th>
			<td style="text-align:left; border: 1px solid #eee;"><?php echo $booking->get_id(); ?></td>
		</tr>
		<?php if ( $booking->has_resources() && ( $resource = $booking->get_resource() ) ) : ?>
			<tr>
				<th style="text-align:left; border: 1px solid #eee;" scope="row"><?php _e( 'Booking Type', 'woocommerce-bookings' ); ?></th>
				<td style="text-align:left; border: 1px solid #eee;"><?php echo $resource->post_title; ?></td>
			</tr>
		<?php endif; ?>
		<tr>
			<th style="text-align:left; border: 1px solid #eee;" scope="row"><?php _e( 'Booking Start Date', 'woocommerce-bookings' ); ?></th>
			<td style="text-align:left; border: 1px solid #eee;"><?php echo $booking->get_start_date(); ?></td>
		</tr>
		<tr>
			<th style="text-align:left; border: 1px solid #eee;" scope="row"><?php _e( 'Booking End Date', 'woocommerce-bookings' ); ?></th>
			<td style="text-align:left; border: 1px solid #eee;"><?php echo $booking->get_end_date(); ?></td>
		</tr>
		<?php if ( $booking->has_persons() ) : ?>
			<?php
			foreach ( $booking->get_persons() as $id => $qty ) :
				if ( 0 === $qty ) {
					continue;
				}

				$person_type = ( 0 < $id ) ? get_the_title( $id ) : __( 'Person(s)', 'woocommerce-bookings' );
			?>
				<tr>
					<th style="text-align:left; border: 1px solid #eee;" scope="row"><?php echo $person_type; ?></th>
					<td style="text-align:left; border: 1px solid #eee;"><?php echo $qty; ?></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
		<?php foreach( $tourtransfer_details as $item ) :?>
		
			<?php if ( $item['item_id'] == $booking->get_product()->get_id() ) : ?>
				<tr>
					<th style="text-align:left; border: 1px solid #eee;" scope="row"><?php _e( 'Pick up', 'terratours' ); ?></th>
					<td style="text-align:left; border: 1px solid #eee;"><?php echo $item["pickup_location"] ?></td>
				</tr>
				<tr>
					<th style="text-align:left; border: 1px solid #eee;" scope="row"><?php _e( 'Drop off', 'terratours' ); ?></th>
					<td style="text-align:left; border: 1px solid #eee;"><?php echo $item["dropoff_location"] ?></td>
				</tr>
				<tr>
					<th style="text-align:left; border: 1px solid #eee;" scope="row"><?php _e( 'Flight', 'terratours' ); ?></th>
					<td style="text-align:left; border: 1px solid #eee;"><?php echo $item["flight"] ?></td>
				</tr>
				<tr>
					<th style="text-align:left; border: 1px solid #eee;" scope="row"><?php _e( 'Pick up time', 'terratours' ); ?></th>
					<td style="text-align:left; border: 1px solid #eee;"><?php echo $item["time"] ?></td>
				</tr>
				<tr>
					<th style="text-align:left; border: 1px solid #eee;" scope="row"><?php _e( 'Passengers', 'terratours' ); ?></th>
					<td style="text-align:left; border: 1px solid #eee;"><?php echo $item["passengers"] ?></td>
				</tr>
				<tr>
					<th style="text-align:left; border: 1px solid #eee;" scope="row"><?php _e( 'Airline', 'terratours' ); ?></th>
					<td style="text-align:left; border: 1px solid #eee;"><?php echo $item["airline"] ?></td>
				</tr>
			
		<?php endif ?>
		<?php	endforeach; ?>
	</tbody>
</table>

<p><?php echo make_clickable( sprintf( __( 'You can view and edit this booking in the dashboard here: %s', 'woocommerce-bookings' ), admin_url( 'post.php?post=' . $booking->get_id() . '&action=edit' ) ) ); ?></p>

<?php do_action( 'woocommerce_email_footer' ); ?>
