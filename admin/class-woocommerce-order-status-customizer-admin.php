<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.novarumsoftware.com
 * @since      1.0.0
 *
 * @package    Woocommerce_Order_Status_Customizer
 * @subpackage Woocommerce_Order_Status_Customizer/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woocommerce_Order_Status_Customizer
 * @subpackage Woocommerce_Order_Status_Customizer/admin
 * @author     Novarum <team@novarumsoftware.com>
 */
class Woocommerce_Order_Status_Customizer_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	
	
	/**
	 * Random colors
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $colors    Random colors to be used
	 */
	private $colors;
	
	
	/**
	 * Actions
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $actions    Possible actions when the status changes
	 */
	private $actions;	
		


	/**
	 * Logging
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      int    $logging    Whether logging is enabled or not
	 */
	private $logging;

	

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		$this->colors = array( array('background_color' => '#000',
		                             'color' => '#fff'
		                            ),
		                        
		                        array('background_color' => '#dd9933',
		                             'color' => '#000'
		                            ),    
		                        
		                        array('background_color' => '#75C604',
		                             'color' => '#805004'
		                            ),
		                            
		                        array('background_color' => '#69082A',
		                             'color' => '#046CC7'
		                            ), 
		                        
		                        array('background_color' => '#CD66E8',
		                             'color' => '#000'
		                            ), 
		                        
		                        array('background_color' => '#F27A6B',
		                             'color' => '#000'
		                            ), 
		                        
		                        array('background_color' => '#F1D764',
		                             'color' => '#000'
		                            ),
		                        
		                        array('background_color' => '#DA31B7',
		                             'color' => '#000'
		                            ),
		                        
		                        array('background_color' => '#3540F5',
		                             'color' => '#000'
		                            ), 
		                        
		                        array('background_color' => '#27E6C3',
		                             'color' => '#000'
		                            ),   
		                               
		                            
		                      );
		
		$this->actions = [1 => __('Send an Email', $this->plugin_name),
		                  //4 => 'Trigger Action' //TODO
		                 ];
		
		
		$this->logging = (int) get_option('nos_logging'); //logging 0 or 1
		

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woocommerce_Order_Status_Customizer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocommerce_Order_Status_Customizer_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woocommerce-order-status-customizer-admin.css', array(), $this->version, 'all' );
		
		// Add the color picker css file       
        wp_enqueue_style( 'wp-color-picker' ); 
		

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woocommerce_Order_Status_Customizer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocommerce_Order_Status_Customizer_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

        wp_enqueue_script( 'wp-color-picker');
        
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woocommerce-order-status-customizer-admin.js', array( 'jquery' ), $this->version, false );

	}



    /**
	 * Init function
	 *
	 * @since    1.0.0
	 */
	public function admin_init() 
	{
	    //Register a post type to keep the status values
	    register_post_type('novarum_order_status',
            array(
                'label'       => __('Order Status', $this->plugin_name),
                'labels'      => array(
                    'name'          => __('Status List', $this->plugin_name),
                    'menu_name'     => __('Order Status', $this->plugin_name),
                    'all_items'     => __('Status List', $this->plugin_name),
                    'singular_name' => __('Status List', $this->plugin_name),
                    'edit_item'     => __('Edit Order Status', $this->plugin_name),
                    'new_item'      => __('Add a New Order Status', $this->plugin_name),
                    'add_new_item'  => __('Add a New Order Status', $this->plugin_name),
                    'view_item'     => __('View Order Status', $this->plugin_name),
                    'view_items'    => __('Status List', $this->plugin_name),
                    'search_items'  => __('Search Custom Order Status', $this->plugin_name),
                ),
                    'public'             => false,
                    'publicly_queryable' => true,
                    'show_ui'            => true,
                    'has_archive'        => true,
                    'supports'           => array('title'),
                    'menu_icon'          => 'dashicons-filter'
            )
        );
        
        
        //Register a post type to keep the status rules
	    register_post_type('novarum_os_rules',
            array(
                'labels'      => array(
                    'name'          => __('Order Status Rules', $this->plugin_name),
                    'singular_name' => __('Order Status Rules', $this->plugin_name),
                    'edit_item'     => __('Edit Rule', $this->plugin_name),
                    'new_item'      => __('Add a New Rule', $this->plugin_name),
                    'add_new_item'  => __('Add a New Rule', $this->plugin_name),
                    'view_item'     => __('View Rules', $this->plugin_name),
                    'view_items'    => __('Rules List', $this->plugin_name),
                    'search_items'  => __('Search Rules', $this->plugin_name),
                ),
                    'public'             => true,
                    'publicly_queryable' => true,
                    'has_archive'        => true,
                    'supports'           => array('title'),
                    'show_in_menu'       => false
            )
        );
        
        
        
        
        //Now register the status values saved
        $status = get_posts(array('post_type' => 'novarum_order_status'));
        
        if( count($status) > 0 )
        {
            foreach($status as $eachStatus)
            {
                //get custom field values
                $meta = get_post_meta($eachStatus->ID);
                
                //register the status to woocommerce
                register_post_status( 'wc-' . $eachStatus->post_name, array(
                    'label'                     => $eachStatus->post_title,
                    'public'                    => true,
                    'exclude_from_search'       => false,
                    'show_in_admin_all_list'    => true,
                    'show_in_admin_status_list' => true,
                    'label_count'               => _n_noop( $eachStatus->post_title . ' (%s)',  $eachStatus->post_title . ' (%s)' )
                ) );
            }
        }
	   
	}
	

    /**
	 * Adding meta boxes function
	 *
	 * @since    1.0.0
	 */	
	public function admin_meta_boxes()
	{
        //Order status meta box            
        add_meta_box(
            'novarum_order_status_box_id',    // Unique ID
            'Order Status Fields',            // Box title
            array($this, 'render_meta_box'),  // Content callback, must be of type callable
            'novarum_order_status'                   // Post type
        );
        
        //Order status rule meta box           
        add_meta_box(
            'novarum_order_status_rule_box_id',    // Unique ID
            'Order Status Fields',            // Box title
            array($this, 'render_rule_meta_box'),  // Content callback, must be of type callable
            'novarum_os_rules'                   // Post type
        );
        
        
	}



    /**
	 * Either shows the value or randomizes it
	 *
	 * @since    1.0.0
	 */	
	public function random_color()
	{
	    $screen = get_current_screen();

        
        if ( $screen->action == 'add' ) 
        {
            
            $rand = rand(0, (count( $this->colors )  -1 ));
            
            return $this->colors[ $rand ]; 
        }
        else
           return array();
	}


    
    /**
	 * Adding meta boxes rendering function
	 *
	 * @since    1.0.0
	 * @param      object    $post    The post that's we are rendering
	 */	
	public function render_meta_box($post)
	{
	    
	    $values = get_post_meta($post->ID);
	    
	    $random = $this->random_color();
	    
	    if( isset($random['background_color']) )
	        $background_color = $random['background_color'];
	    else
	        $background_color = $values['input_nos_background_color'][0];
	        
	    
	    if( isset($random['color']) )
	        $color = $random['color'];
	    else
	        $color = $values['input_nos_color'][0];
	    
	     
	    
        ?>
        
        <div id="div_preview">
           
           <p><strong>Preview</strong></p>
           <mark id="mark_preview" class="order-status tips"><span id="span_preview"></span></mark>
           
        </div>
        
        
        <p>
          <label for="input_nos_slug"><strong><?php echo __('Background Color', $this->plugin_name); ?>:</strong></label>
          <br>
          <input type="text" name="input_nos_background_color" id="input_nos_background_color" class="color-field" value="<?php echo esc_attr($background_color); ?>">
        </p>
        
        <p>
          <label for="input_nos_color"><strong><?php echo __('Text Color', $this->plugin_name); ?>:</strong></label>
          <br>
          <input type="text" name="input_nos_color" id="input_nos_color" class="color-field" value="<?php echo esc_attr($color); ?>">
        </p>
        
        <?php
	}
	
	

    /**
	 * Adding meta boxes function for rules
	 *
	 * @since    1.0.0
	 * @param      object    $post    The post that's we are rendering
	 */	
	public function render_rule_meta_box($post)
	{
	   $order_statuses = wc_get_order_statuses();
	    
	   $values = get_post_meta($post->ID); 
	   
	   
	   //halilk: get filtered actions
	   $actions = apply_filters( 'novarum_osc_actions', $this->actions , $this);
	   
	    
       ?>
        
        
        <p><a id="a_available_tags" href="javascript:"><?php echo __('Show Available Tags', $this->plugin_name); ?></a></p>
        
        <div id="div_info_box" class="info-box">
          
          <h3>Available Tags <a id="a_close_info_box" href="javascript:">X</a></h3>
          
          <p>You can use these tags in any action field to bring the actual value of it from the order</p>
          
          <ul>
            <li>{ID}</li>
            <li>{billing_first_name}</li>
            <li>{billing_last_name}</li>
            <li>{billing_company}</li>
            <li>{billing_address_1}</li>
            <li>{billing_address_2}</li>
            <li>{billing_city}</li>
            <li>{billing_state}</li>
            <li>{billing_postcode}</li>
            <li>{billing_country}</li>
            <li>{billing_email}</li>
            <li>{billing_phone}</li>
            <li>{payment_method_title}</li>
            <li>{formatted_order_total}'</li>
            <li>{meta_$meta_key_name}</li>
            <li>{admin_email}</li>
          </ul>
        
        </div>
        
        <p>
        <label for="select_status_from"><strong><?php echo __('From Status', $this->plugin_name); ?>:</strong></label>
        <br>
        <select name="select_status_from">
           <option value="any"><?php echo __('Any', $this->plugin_name); ?></option>
           
           <?php foreach($order_statuses as $key => $each): ?>
               
               <option value="<?php echo esc_attr($key); ?>" <?php if($key == $values['select_status_from'][0]) { echo 'selected'; } ?>><?php echo esc_html($each); ?></option>
               
               
           <?php endforeach; ?>
           
        </select>
        </p>
        
        <p>
        <label for="select_status_to"><strong><?php echo __('To Status', $this->plugin_name); ?>:</strong></label>
        <br>
        <select name="select_status_to">
           <option value="any"><?php echo __('Any', $this->plugin_name); ?></option>
           
           <?php foreach($order_statuses as $key => $each): ?>
               
               
               <option value="<?php echo esc_attr($key); ?>" <?php if($key == $values['select_status_to'][0]) { echo 'selected'; } ?>> <?php echo esc_html($each); ?></option>
               
           <?php endforeach; ?>
           
           
        </select>
        </p>
        
        <p>
        <label for="select_action"><strong><?php echo __('Action', $this->plugin_name); ?>:</strong></label>
        <br>
        <select id="select_action" name="select_action">
           <optgroup label="Essential">
             <?php foreach($actions as $key => $action): ?>
               <option value="<?php echo esc_attr($key); ?>" <?php if($key == $values['select_action'][0]) { echo 'selected'; } ?>><?php echo esc_html($action); ?></option>
             <?php endforeach; ?>
           </optgroup>
        </select>
        </p>
        
        <div id="div_action_1" class="action-pane">
           
           <p>
             <label for="input_nos_email_to"><strong><?php echo __('Email To', $this->plugin_name); ?>:</strong></label>
             <br>
             <input type="text" name="input_nos_email_to" id="input_nos_email_to" value="<?php echo esc_html($values['input_nos_email_to'][0]); ?>">
           </p>
           <p>
             <label for="input_nos_email_subject"><strong><?php echo __('Email Subject', $this->plugin_name); ?>:</strong></label>
             <br>
             <input type="text" name="input_nos_email_subject" id="input_nos_email_subject" value="<?php echo esc_html($values['input_nos_email_subject'][0]); ?>">
           </p>
           
           <p>
             <label for="input_nos_email_content"><strong><?php echo __('Email Content', $this->plugin_name); ?>:</strong></label>
              <br>
              <?php echo wp_editor( esc_html(htmlspecialchars( $values['input_nos_email_content'][0]) ), 'mettaabox_ID', $settings = array('textarea_name'=>'input_nos_email_content') ); ?>
           </p>
           
        </div>
        

        <?php
	}	
	
	
	

    /**
	 * For saving the custom field values
	 *
	 * @since    1.0.0
	 * @param      int    $post_id    Id of the post
	 */	
	function save_custom_fields($post_id)
    {
        //Slug
        if (array_key_exists('input_nos_background_color', $_POST)) {
            update_post_meta(
                $post_id,
                'input_nos_background_color',
                sanitize_text_field($_POST['input_nos_background_color'])
            );
        }
        
        //Color
        if (array_key_exists('input_nos_color', $_POST)) {
            update_post_meta(
                $post_id,
                'input_nos_color',
                sanitize_text_field($_POST['input_nos_color'])
            );
        }
        
        
        //Status From
        if (array_key_exists('select_status_from', $_POST)) {
            update_post_meta(
                $post_id,
                'select_status_from',
                sanitize_text_field($_POST['select_status_from'])
            );
        }
        
        //Status To
        if (array_key_exists('select_status_to', $_POST)) {
            update_post_meta(
                $post_id,
                'select_status_to',
                sanitize_text_field($_POST['select_status_to'])
            );
        }
        
        //Action
        if (array_key_exists('select_action', $_POST)) {
            update_post_meta(
                $post_id,
                'select_action',
                sanitize_text_field((int) $_POST['select_action'])
            );
        }
        
        ///////////////////////////////////////////////////////////
        // Send an email
        
        //Action - Email To
        if (array_key_exists('input_nos_email_to', $_POST)) {
            update_post_meta(
                $post_id,
                'input_nos_email_to',
                wp_kses_post($_POST['input_nos_email_to'])
            );
        }
        
        //Action - Email Subject
        if (array_key_exists('input_nos_email_subject', $_POST)) {
            update_post_meta(
                $post_id,
                'input_nos_email_subject',
                wp_kses_post($_POST['input_nos_email_subject'])
            );
        }
        
        //Action - Email Content
        if (array_key_exists('input_nos_email_content', $_POST)) {
            update_post_meta(
                $post_id,
                'input_nos_email_content',
                wp_kses_post($_POST['input_nos_email_content'])
            );
        }
        ///////////////////////////////////////////////////////////
        
      
    }
    

    /**
	 * Add to list of WC Order statuses
	 *
	 * @since    1.0.0
	 * @param      array    $order_statuses    array of wc status values
	 */    
    function add_custom_status_to_list( $order_statuses ) 
    {
 
        $new_order_statuses = array();
        
        
        $selected_status = get_option('nos_selected_status');
        
        if($selected_status)
           $selected_status = json_decode($selected_status, true);
        else
           $selected_status = array();


        // add new order status after processing
        foreach ( $order_statuses as $key => $status ) 
        {
            
            if( count($selected_status) > 0)
            {
                if( in_array( $key, $selected_status ) )
                    $new_order_statuses[ $key ] = $status;
            }
            else
                $new_order_statuses[ $key ] = $status;
        }
        
        
        $status = get_posts(array('post_type' => 'novarum_order_status'));

        if( count($status) > 0 )
        {
            foreach($status as $eachStatus)
            {
                //get custom field values
                $meta = get_post_meta($eachStatus->ID);
                
                //add status to the list
                
                $new_order_statuses[ 'wc-' . esc_attr($eachStatus->post_name) ] = esc_html($eachStatus->post_title);
                
            }
        }
        
 
        return $new_order_statuses;
    }  
    
    

    /**
	 * Add css styles for the custom status values
	 *
	 * @since    1.0.0
	 */     
    function admin_styles()
    {
       echo '<style>';
       
       $status = get_posts(array('post_type' => 'novarum_order_status'));

        if( count($status) > 0 )
        {
            foreach($status as $eachStatus)
            {
                //get custom field values
                $meta = get_post_meta($eachStatus->ID);
                
                $background_color = '#ccc';
                $color = '#000';
                
                if( isset( $meta['input_nos_background_color'][0] ) ) 
                    $background_color = esc_attr($meta['input_nos_background_color'][0]);
                
                
                if( isset( $meta['input_nos_color'][0] ) ) 
                    $color = esc_attr($meta['input_nos_color'][0]);
                
                
                //add status to the list
                
                //$meta['input_nos_slug'][0]
                
                echo '.order-status.status-' . esc_attr($eachStatus->post_name) . ' {
                            background: ' . $background_color . ';
                            color: ' . $color . ';
                      }';
                
            }
        }
       
       
       echo '</style>';
    }
    
    

    /**
	 * Check if we can delete the status value
	 *
	 * @since    1.0.0
	 * @param      array    $caps    An array of capabilities
	 * @param      string    $cap    current capability
	 * @param      int    $user_id    id of the user
	 * @param      array    $args    array of extra arguments
	 */     
    public function check_delete($caps, $cap, $user_id, $args )
    {
           // Nothing to do
        if( 'delete_post' !== $cap || empty( $args[0] ) )
            return $caps;

        // Target the payment and transaction post types
        if( in_array( get_post_type( $args[0] ), [ 'novarum_order_status'], true ) )
            $caps[] = 'do_not_allow';       

        return $caps; 
    } 
    
    
    /**
	 * Check if we can delete the status value
	 *
	 * @since    1.0.0
	 * @param      int    $post_id    Id of the post being deleted
	 */     
    public function check_before_delete($post_id)
    {    
      $post = get_post($post_id);
      $post_slug = $post->post_name;

        if ( in_array( $post_type, array( 'novarum_order_status' ) ) ) 
        {
            
            //find orders with given status
            $orders = wc_get_orders( array('limit' => 1,
                                           'status' => $post_slug
                                          ) 
                                    );
            
            if( count( $orders ) > 0 )
                wp_die( __( 'You are not allowed to delete status entries when there are orders with these status values. Change status of all the orders with these status values before deleting.', $this->plugin_name ) );
        }
    }
     


    /**
	 * Called when an order status is changed
	 *
	 * @since    1.0.0
	 * @param      int    $order_id    Id of the order
	 * @param      string    $old_status    current order status without wc-
	 * @param      string    $new_status    new status without wc-
	 */     
    public function order_status_changed($order_id, $old_status, $new_status)
    {
        //get the rules
        
        //echo 'old status: '.$old_status.' news status: '.$new_status;
        //exit;
        
        $rules = get_posts(array('post_type' => 'novarum_os_rules'));
        
        if( count( $rules ) >  0 )
        {
            foreach($rules as $eachRule)
            {
                $meta = get_post_meta($eachRule->ID);
                
                if( ($meta['select_status_from'][0] == 'wc-' . $old_status || $meta['select_status_from'][0] == 'any') && 
                    ($meta['select_status_to'][0] == 'wc-' . $new_status || $meta['select_status_to'][0] == 'any')
                  )
                {
                    $this->perform_action($eachRule, $meta, $order_id);
                }
                
            }
        }
        
    }
    
    
    /**
	 * Called to make an action
	 *
	 * @since    1.0.0
	 * @param      object    $post    The post that's we are perfoming the action
	 * @param      array    $meta    All the meta values for the rule passed for reference and not to query again
	 * @param      int    $order_id   Id of the order
	 */     
    public function perform_action($post, $meta, $order_id)
    {
        
        $order = new WC_Order( $order_id );
        $order_meta = get_post_meta($order_id);
        
        //halilk: there might be custom actions
        do_action('novarum_osc_before_action',$post, $meta, $order);
        
        //Send and email
        if( $meta['select_action'][0] == 1)
        {
            //send an email
            
            $email_to = esc_attr($meta['input_nos_email_to'][0]);
            $subject  = esc_html($meta['input_nos_email_subject'][0]);
            $content  = esc_html($meta['input_nos_email_content'][0]);
            
            
            //now replace the variables with actual values

            //replace email
            $email_to = $this->replace_tags_with_content($order, $order_meta, $email_to);
            
            //replace subject items
            $subject = $this->replace_tags_with_content($order, $order_meta, $subject);
            
            //replace content items
            $content = $this->replace_tags_with_content($order, $order_meta, $content);
            
            
            $result = wp_mail($email_to, $subject, $content);
            
            if( $this->logging == 1)
            {
                $this->debug_log('action: email, to: '.$email_to.' subject: '. $subject. ' content: '.$content. ' result: ' . $result);                 
            }
            
            
        }
          
           
        //halilk: there might be custom actions
        do_action('novarum_osc_after_action',$post, $meta, $order);
        
        
        
    }    
    


    /**
	 * Called when we need to log some messages to WC_Logger
	 *
	 * @since    1.0.0
	 * @param      string    $content    Content to be logged
	 */     
    public function debug_log($content)
    {
        $wc_logger = wc_get_logger();

		// Add to logger
		$wc_logger->debug( $content, array( 'source' => $this->plugin_name ) );
    }




    /**
	 * Called when tags need to be replaced with actual content
	 *
	 * @since    1.0.0
	 * @param      object    $order    Order object
	 * @param      array    $meta    All the order meta values
	 * @param      string    $content    Content that we should replace the tags
	 */     
    public function replace_tags_with_content($order, $meta, $content)
    {
       $content_replaced = $content;
       
       $content_replaced = str_replace(
              array('{ID}',
                    '{billing_first_name}',
                    '{billing_last_name}',
                    '{billing_company}',
                    '{billing_address_1}',
                    '{billing_address_2}',
                    '{billing_city}',
                    '{billing_state}',
                    '{billing_postcode}',
                    '{billing_country}',
                    '{billing_email}',
                    '{billing_phone}',
                    '{payment_method_title}',
                    '{formatted_order_total}',
                    '{admin_email}'
                    ),
              
              array($order_id, 
                    $order->get_billing_first_name(),
                    $order->get_billing_last_name(),
                    $order->get_billing_company(),
                    $order->get_billing_address_1(),
                    $order->get_billing_address_2(),
                    $order->get_billing_city(),
                    $order->get_billing_state(),
                    $order->get_billing_postcode(),
                    $order->get_billing_country(),
                    $order->get_billing_email(),
                    $order->get_billing_phone(),
                    $order->get_payment_method_title(),
                    $order->get_formatted_order_total(),
                    get_option('admin_email')
                    ),
             $content_replaced
            
            );
            
            
        //now replace meta ones
        if( count($order_meta) > 0 )
        {
            foreach($order_meta as $key => $value )
            {
                $content_replaced = str_replace("{meta_$key}", $value[0], $content_replaced);
            }
        }
       
        return $content_replaced;
    }





    /**
	 * Called when creating the admin menus
	 *
	 * @since    1.0.0
	 */     
    public function admin_menu()
    {
       add_submenu_page('edit.php?post_type=novarum_order_status', 'Rules', 'Rules', 'manage_options', 'edit.php?post_type=novarum_os_rules');
       add_submenu_page('edit.php?post_type=novarum_order_status', 'Settings', 'Settings', 'manage_options','novarum_settings', array($this, 'render_settings_page'));
    }


    /**
	 * Called when wordpress lists the rules columns
	 *
	 * @since    1.0.0
	 * @param      array    $columns    Array of all the columns
	 */     
    public function set_custom_rules_columns($columns)
    {
        $columns['select_status_from'] = __( 'Status From', $this->plugin_name );
        $columns['select_status_to'] = __( 'Status To', $this->plugin_name );
        $columns['select_action'] = __( 'Action', $this->plugin_name );
        
        return $columns;
    }
    


    /**
	 * Called when wordpress lists the rules columns
	 *
	 * @since    1.0.0
	 * @param      string    $column    Current column being rendered
	 * @param      int    $post_id    The post that we are rendering
	 */     
    public function set_custom_rules_columns_data($column, $post_id)
    {
       $data = get_post_meta($post_id, $column, true);
       
       
       if($column == 'select_action')
       {
          echo $this->actions[ $data ];          
       }
       else
          echo $data;
    }



    /**
	 * Called when wordpress lists the status columns
	 *
	 * @since    1.0.0
	 * @param      array    $columns    Array of all the columns
	 */     
    public function set_status_columns($columns)
    {
        $columns['slug'] = __( 'Slug', $this->plugin_name );
        
        return $columns;
    }


    /**
	 * Called when wordpress lists the status columns data
	 *
	 * @since    1.0.0
	 * @param      string    $column    Current column being rendered
	 * @param      int    $post_id    The post that we are rendering
	 */     
    public function set_status_columns_data($column, $post_id)
    {
        $post = get_post($post_id);          
        echo $post->post_name;

    }




    /**
	 * Called when rendering the settings page
	 *
	 * @since    1.0.0
	 */    
   public function render_settings_page()
   { 
      echo '<div class="wrap"><h1 class="">'. __('Settings', $this->plugin_name) .'</h1>';
      
      echo '<div class="wrap"><h3>' .  __('Default Status Values', $this->plugin_name) . '</h3>';
      
      echo '<p>' . __('From here you can enable/disable default woocommerce status values. Please keep in mind that if you disable a status orders with this status will be invisible', $this->plugin_name) . '.</p>';
      
      
      if( isset($_POST['input_submit']) )
      {
          
          $selected_values = $_POST['check_default_status'];
          
          if(is_array($selected_values))
          {
             if(count($selected_values) > 0 )
             {
               foreach($selected_values as $key => $value)
               {
                  $selected_values[ sanitize_key($key) ] = sanitize_text_field($value);
               }
             }
          
              //save them          
              update_option('nos_selected_status', json_encode( $selected_values ) );
          
          }
          //check logging
          
          if((int) sanitize_text_field($_POST['check_logging']) == 1)
             update_option('nos_logging', 1 );
          else
             update_option('nos_logging', 0 );
          
          
          //check license key. It's a 32 character key
          if(strlen(sanitize_key($_POST['novarum_osc_license_key'])) == 32 )
          {
             update_option('novarum_osc_license_key', sanitize_key( $_POST['novarum_osc_license_key'] ) );
          }
          
          
          
      }
      
      $selected_values = '[]';
      
      if( get_option('nos_selected_status') )
          $selected_values = get_option('nos_selected_status');
      
      if( $selected_values )
          $selected_values = json_decode( $selected_values , true);
      
      $license_key = get_option('novarum_osc_license_key');
      

      echo '<form method="post">';
      
      if( in_array('wc-pending', $selected_values) )
         $checked = 'checked';
      else
         $checked = '';   
            
      echo '<p><input type="checkbox" '. $checked .' name="check_default_status[]" value="wc-pending">Pending payment</p>';
      
      if( in_array('wc-processing', $selected_values) )
         $checked = 'checked';
      else
         $checked = '';  
               
      echo '<p><input type="checkbox" ' . $checked . ' name="check_default_status[]" value="wc-processing">Processing</p>';
      
      if( in_array('wc-on-hold', $selected_values) )
         $checked = 'checked';
      else
         $checked = '';  
               
      echo '<p><input type="checkbox" ' . $checked . ' name="check_default_status[]" value="wc-on-hold">On hold</p>';
      
      if( in_array('wc-completed', $selected_values) )
         $checked = 'checked';
      else
         $checked = '';  
               
      echo '<p><input type="checkbox" ' . $checked . ' name="check_default_status[]" value="wc-completed">Completed</p>';
      
      if( in_array('wc-cancelled', $selected_values) )
         $checked = 'checked';
      else
         $checked = '';  
               
      echo '<p><input type="checkbox" ' . $checked . ' name="check_default_status[]" value="wc-cancelled">Cancelled</p>';
      
      if( in_array('wc-refunded', $selected_values) )
         $checked = 'checked';
      else
         $checked = '';  
               
      echo '<p><input type="checkbox" ' . $checked . ' name="check_default_status[]" value="wc-refunded">Refunded</p>';
      
      if( in_array('wc-failed', $selected_values) )
         $checked = 'checked';
      else
         $checked = '';  
               
      echo '<p><input type="checkbox" ' . $checked . ' name="check_default_status[]" value="wc-failed">Failed</p>';
      


      //Logging
      echo '<br><div class="wrap"><h3>Logging</h3>';
      
      if( $this->logging == 1)
          $checked = 'checked';
      else
          $checked = '';
      
      echo '<p><input type="checkbox" ' . $checked . ' name="check_logging" value="1">' . __('Enable Logging', $this->plugin_name) . '</p>';

      $upload_dir   = wp_upload_dir();
      
      if ( defined( 'WC_LOG_DIR' ) ) 
      {
         $log_url = add_query_arg( 'tab', 'logs', add_query_arg( 'page', 'wc-status', admin_url( 'admin.php' ) ) );
         $log_key = $this->plugin_name . '-' . sanitize_file_name( wp_hash( $this->plugin_name ) ) . '-log';
         $log_url = add_query_arg( 'log_file', $log_key, $log_url );

         $log_location =  sprintf( __( '%1$sView Log%2$s', $this->plugin_name ), '<a href="' . esc_url( $log_url ) . '">', '</a>' );
      }
      
      
      
      echo '<p><strong>' . __('Log File Location', $this->plugin_name) . ':</strong> ' . $log_location . '</p>';

      //License Key
      echo '<br><div class="wrap"><h3>License Management</h3>';

      echo '<p><label for="novarum_osc_license_key"><strong>'. __('License key is required to get automated updates', $this->plugin_name). ':</strong></label>';
      echo '<br>';
      echo '<input type="text" name="novarum_osc_license_key" id="novarum_osc_license_key" placeholder="Your license key" style="width: 350px" value="'. esc_attr($license_key) . '">';
      echo '</p>';


      echo '<p><input type="submit" name="input_submit" value="' . __('Save', $this->plugin_name) . '" class="button action"></p>';
      
      echo '</form>';
      
      

      
   } 


}
