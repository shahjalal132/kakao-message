<?php

if ( !defined( 'ABSPATH' ) ) {
    die;
} // Cannot access directly.

if ( class_exists( 'CSF' ) ) {

    // Get WooCommerce order statuses
    $order_statuses = get_option( '_wc_order_statuses' ) ?? array();
    // Decode to array
    $order_statuses = json_decode( $order_statuses, true );

    // Prefix
    $prefix = '_qata_message';

    // Create metabox
    CSF::createMetabox( $prefix, array(
        'title'        => 'Message',
        'post_type'    => 'qata_message',
        'show_restore' => true,
    ) );

    // Convert order statuses to a format suitable for dropdown
    $status_options = array();
    if ( !empty( $order_statuses ) && is_array( $order_statuses ) ) {
        foreach ( $order_statuses as $status_key => $status_label ) {
            $status_key                  = str_replace( 'wc-', '', $status_key ); // Remove 'wc-' prefix
            $status_label                = translate( $status_label );
            $status_options[$status_key] = $status_label;
        }
    }

    // Generate order data array
    $order_data = array(
        'order_number'        => 'Order Number',
        'order_total'         => 'Order Total',
        'order_content'       => 'Order Content',
        'product_name'        => 'Product Name',
        'product_quantity'    => 'Product Quantity',
        'tracking_link'       => 'Tracking Number',
        'billing_first_name'  => 'Billing First Name',
        'billing_last_name'   => 'Billing Last Name',
        'billing_address_1'   => 'Billing Address 1',
        'billing_address_2'   => 'Billing Address 2',
        'billing_city'        => 'Billing City',
        'billing_state'       => 'Billing State',
        'billing_postcode'    => 'Billing Postcode',
        'billing_country'     => 'Billing Country',
        'billing_email'       => 'Billing Email',
        'billing_phone'       => 'Billing Phone',
        'shipping_first_name' => 'Shipping First Name',
        'shipping_last_name'  => 'Shipping Last Name',
        'shipping_address_1'  => 'Shipping Address 1',
        'shipping_address_2'  => 'Shipping Address 2',
        'shipping_city'       => 'Shipping City',
        'shipping_state'      => 'Shipping State',
        'shipping_postcode'   => 'Shipping Postcode',
        'shipping_country'    => 'Shipping Country',
        'customer_note'       => 'Customer Note',
        'payment_method'      => 'Payment Method',
        'transaction_id'      => 'Transaction ID',
        'order_date'          => 'Order Date',
        'order_status'        => 'Order Status',
        'shipping_method'     => 'Shipping Method',
        'shipping_total'      => 'Shipping Total',
        'shipping_tax'        => 'Shipping Tax',
        'discount_total'      => 'Discount Total',
        'discount_tax'        => 'Discount Tax',
        'cart_tax'            => 'Cart Tax',
        'total_tax'           => 'Total Tax',
        'order_key'           => 'Order Key',
        'customer_id'         => 'Customer ID',
        'order_currency'      => 'Order Currency',
        'prices_include_tax'  => 'Prices Include Tax',
        'customer_ip_address' => 'Customer IP Address',
        'customer_user_agent' => 'Customer User Agent',
    );

    CSF::createSection( $prefix, array(
        'title'  => 'Message',
        'icon'   => '',
        'fields' => array(

            // Status field
            array(
                'id'          => 'qsms_order_status',
                'type'        => 'select',
                'title'       => 'Status',
                'placeholder' => 'Select a Status',
                'options'     => $status_options,
            ),

            // Template code field
            array(
                'id'          => 'qsms_template_code',
                'type'        => 'text',
                'title'       => 'Template Code',
                'placeholder' => 'Template Code',
            ),

            // Repeater field
            array(
                'id'     => 'qsms_params',
                'type'   => 'repeater',
                'title'  => 'Parameters',
                'fields' => array(
                    // Parameter key field
                    array(
                        'id'          => 'qsms_param_key',
                        'type'        => 'text',
                        'title'       => 'Parameter Key',
                        'placeholder' => 'Parameter Key',
                    ),
                    // Custom parameter value field
                    array(
                        'id'          => 'qsms_custom_param_value',
                        'type'        => 'text',
                        'title'       => 'Custom Parameter value',
                        'placeholder' => 'Custom Parameter value',
                    ),
                    // Parameter value field
                    array(
                        'id'          => 'qsms_param_value',
                        'type'        => 'select',
                        'title'       => 'Parameter Value',
                        'placeholder' => 'Select a Value',
                        'options'     => $order_data,
                    ),
                ),
            ),

        ),
    ) );

}