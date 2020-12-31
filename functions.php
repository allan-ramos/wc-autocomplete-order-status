<?php

add_action('woocommerce_order_status_changed', 'ts_auto_complete_by_payment_method');
function ts_auto_complete_by_payment_method($order_id)
{  
   if ( ! $order_id ) {
      return;
   }
   global $product;
   $order = wc_get_order( $order_id );
   $payment_method=$order->get_payment_method();
   if ($order->data['status'] == 'on-hold' and $payment_method!="paygate") {
      $order->update_status( 'processing');
   }
   elseif ($order->data['status'] == 'failed') {
      $order->update_status( 'cancelled' );
   }
}


?>
