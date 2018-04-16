<?php

    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $fx_data = "fx_data";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'opt_name' => 'fx_data',
        'dev_mode' => FALSE,
        'use_cdn' => TRUE,
        'display_name' => 'Best Resources',
        'display_version' => '1.0.0',
        'page_title' => 'Theme Settings',
        'update_notice' => TRUE,
        'admin_bar' => TRUE,
        'menu_type' => 'menu',
        'menu_title' => 'Theme Settings',
        'page_parent_post_type' => 'your_post_type',
        'customizer' => TRUE,
        'default_mark' => '*',
        'hints' => array(
            'icon' => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color' => 'lightgray',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'dark',
                'rounded' => '1',
                ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
                ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                    ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                    ),
                ),
            ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'compiler' => TRUE,
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'disable_save_warn' => TRUE,
        'database' => 'options',
        'transient_time' => '3600',
        'network_sites' => TRUE,
        );

    $menus = get_terms('nav_menu');
    $menu_list = array();
    foreach ($menus as $menu[0] => $menu_item) {
    	$menu_list[$menu_item->name] = $menu_item->name;
    }

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'http://www.fxwebstudio.com.au',
        'title' => 'Visit us on FX Web Studio',

        'img'   => get_template_directory_uri()."/images/fxwebstudio.png",
        );

    Redux::setArgs( $fx_data, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'admin_folder' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'admin_folder' )
            ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'admin_folder' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'admin_folder' )
            )
        );
    Redux::setHelpTab( $fx_data, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'admin_folder' );
    Redux::setHelpSidebar( $fx_data, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */
    Redux::setSection( $fx_data, array(
        'title' => __( 'Home', 'redux-framework' ),
        'id'    => 'home',
        'desc'  => __( '', 'redux-framework' ),
        'icon'  => 'el el-home',
        ) );

    Redux::setSection( $fx_data, array(
        'title'      => __( 'Slider', 'redux-framework' ),
        'desc'       => __( '', 'redux-framework' ),
        'id'         => 'slide',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'          => 'slider',
                'type'        => 'slides',
                'title'       => __('Slides', 'redux-framework'),
                'subtitle'    => __('Unlimited slides with drag and drop sortings.', 'redux-framework'),
                'desc'        => __('', 'redux-framework'),
                'placeholder' => array(
                    'title'           => __('Title', 'redux-framework'),
                    'description'     => __('Description', 'redux-framework'),
                    'url'             => __('Link', 'redux-framework'),
                    ),
                ),
            )
        ) );     

    Redux::setSection( $fx_data, array(
        'title' => __( 'Header', 'redux-framework' ),
        'id'    => 'header',
        'desc'  => __( '', 'redux-framework' ),
        'icon'  => 'el el-website',
        'fields'     => array(
            array(
                'id'       => 'logo',
                'type'     => 'media',
                'title'    => __( 'Logo', 'redux-framework' ),
                'desc'     => __( '', 'redux-framework' ),
                'subtitle' => __( 'Upload any media using the WordPress native uploader.', 'redux-framework' ),
                ),

            array(
                'id'       => 'header-menu',
                'type'     => 'select',
                'title'    => __( 'Menu', 'redux-framework' ),
                'subtitle' => __( 'Select a menu. You can edit the items <a href="'.get_site_url().'/wp-admin/nav-menus.php">here</a>.', 'redux-framework' ),
                'placeholder' => __( 'Select a menu.', 'redux-framework' ),
                //Must provide key => value pairs for select options
                'options'  => $menu_list,
                ),
            array(
                'id'            =>  'google-analytics',
                'type'          =>  'textarea',
                'title'         =>  __('Google Analytics', 'redux-framework'),
                'placeholder'   =>  'Paste the code here',
                ),   
            array(
                'id'       => 'tb_switch',
                'type'     => 'switch', 
                'title'    => __('Enable Top Bar', 'redux-framework'),
                'subtitle' => __(' ', 'redux-framework'),
                'default'  => false,
                ),            
            array(
                'id'            =>  'left-topbar',
                'type'          =>  'editor',
                'title'         =>  __('Left Top Bar', 'redux-framework'),
                'placeholder'   =>  'Paste the code here',
                ),   
            array(
                'id'            =>  'right-topbar',
                'type'          =>  'editor',
                'title'         =>  __('Right Top Bar', 'redux-framework'),
                'placeholder'   =>  'Paste the code here',
                ),                                                        
            )
        ) );


    Redux::setSection( $fx_data, array(
        'title' => __( 'Footer', 'redux-framework' ),
        'id'    => 'footer',
        'desc'  => __( '', 'redux-framework' ),
        'icon'  => 'el el-photo',
        'fields'     => array(
            array(
                'id'               => 'cta-footer',
                'type'             => 'editor',
                'title'            => __('Call To Action', 'redux-framework'), 
                'subtitle'  => 'Insert a text.',
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 10
                    )
                ),
            )
        ) );

    Redux::setSection( $fx_data, array(
        'title' => __( 'Contact Information', 'redux-framework' ),
        'id'    => 'contact-info',
        'desc'  => __( '', 'redux-framework' ),
        'icon'  => 'el el-phone',
        'fields'     => array(
            array(
                'id'               => 'fb',
                'type'             => 'text',
                'title'            => __('Facebook', 'redux-framework'),
                'desc'             => 'Use [fx_facebook] to call this textfield',
                'placeholder' => __( 'https//www.facebook.com/sample', 'redux-framework' ), 
                ),

            array(
                'id'               => 'instagram',
                'type'             => 'text',
                'title'            => __('Instagram', 'redux-framework'),
                'desc'             => 'Use [fx_instagram] to call this textfield',
                'placeholder' => __( 'https://www.instagram.com/sample', 'redux-framework' ), 
                ),

            array(
                'id'               => 'twitter',
                'type'             => 'text',
                'title'            => __('Twitter', 'redux-framework'),
                'desc'             => 'Use [fx_twitter] to call this textfield',
                'placeholder' => __( 'https//www.twitter.com/sample', 'redux-framework' ), 
                ),


            array(
                'id'               => 'contact-info',
                'type'             => 'editor',
                'title'            => __('Contact Info', 'redux-framework'), 
                'subtitle'  => 'Insert a text.',
                'desc'             => 'Use [fx_contactinfo] to call this texarea',
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 10
                    )
                ),
            array(
                'id'               => 'address',
                'type'             => 'editor',
                'title'            => __('Address', 'redux-framework'),
                'desc'             => 'Use [fx_address] to call this texarea', 
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 10
                    )
                ),
            array(
                'id'               => 'email',
                'type'             => 'text',
                'desc'             => 'Use [fx_email] to call this textfield',
                'title'            => __('Email Address', 'redux-framework'), 
                ),
            array(
                'id'               => 'phone',
                'type'             => 'text',
                'desc'             => 'Use [fx_phone] to call this textfield',
                'title'            => __('Phone Number', 'redux-framework'),
                ),                                                
            )
        ) );

    Redux::setSection( $fx_data, array(
        'title' => __( 'Misc', 'redux-framework' ),
        'id'    => 'misc',
        'desc'  => __( '', 'redux-framework' ),
        'icon'  => 'el el-puzzle',
        'fields'     => array(
            array(
                'id'       => 'favicon',
                'type'     => 'media',
                'title'    => __( 'Favicon', 'redux-framework' ),
                'desc'     => __( '', 'redux-framework' ),
                'subtitle' => __( 'Upload any media using the WordPress native uploader.', 'redux-framework' ),
                ),
            array(
                'id'            =>  'enable_breadcrumbs',
                'type'          =>  'switch',
                'title'         =>  __('Enable Breadcrumbs', 'redux-framework')
                ), 
            array(
                'id'            =>  'enable_sticky_enquery',
                'type'          =>  'switch',
                'title'         =>  __('Enable Sticky Enquery', 'redux-framework')
                ), 
            array(
                'id'            =>  'enable_sticky_header',
                'type'          =>  'switch',
                'title'         =>  __('Enable Sticky Header', 'redux-framework')
                ),
            array(
                'id'            =>  'enable_backtotop',
                'type'          =>  'switch',
                'title'         =>  __('Enable Back to Top', 'redux-framework')
                ),                                                                                 
            )
        ) );
        Redux::setSection( $fx_data, array(
            'title' => __( 'Masonry Gallery', 'redux-framework' ),
            'id'    => 'masonry-gallery',
            'desc'  => __( 'Masonry Gallery Settings', 'redux-framework' ),
            'subsection' => true,
            'fields'     => array(
                         $fields = array(
                            'id'            =>  'enable_gallery',
                            'type'          =>  'switch',
                            'title'         =>  __('Enable Masonry Gallery', 'redux-framework')
                            ), 
                         array(
                            'id'       => 'qe_fullwidth',
                            'type'     => 'checkbox', 
                            'title'    => __('Fullwidth', 'redux-framework'),
                            'subtitle' => __(' ', 'redux-framework'),
                            'default'  => false,
                            ),

                        array(
                            'id'       => 'qe_column',
                            'type'     => 'select',
                            'title'    => __( 'Number of columns', 'redux-framework' ),
                            'options'  => array(
                                'grid-5' => '5',
                                'grid-4' => '4',
                                'grid-3' => '3',
                                'grid-2' => '2',
                                'grid-1' => '1'                   
                                ),
                            'default' => 'grid-4'
                            ),
                            array(
                                'id'       => 'gallery_thumbnail',
                                'type'     => 'media',
                                'title'    => __( 'Thumbnail', 'redux-framework' ),
                                )                        
                    )
            ) );
    Redux::setSection( $fx_data, array(
        'title' => __( 'Quick Enquiry', 'redux-framework' ),
        'id'    => 'quick-enquiry',
        'desc'  => __( 'This will display a sticky button and a light box to display the form.', 'redux-framework' ),
        'subsection' => true,
        'fields'     => array(
            $fields = array(
                'id'       => 'qe_switch',
                'type'     => 'switch', 
                'title'    => __('Toggle Display', 'redux-framework'),
                'subtitle' => __(' ', 'redux-framework'),
                'default'  => false,
                ),

            array(
                'id'       => 'qe_button_text',
                'type'     => 'text',
                'title'    => __( 'Button Text', 'redux-framework' ),
                //'subtitle' => __( 'Subtitle', 'redux-framework' ),
                'placeholder'  => 'Insert a text for the button.',
                ),

            array(
                'id'       => 'qe_heading',
                'type'     => 'text',
                'title'    => __( 'Form Heading', 'redux-framework' ),
                //'subtitle' => __( 'Subtitle', 'redux-framework' ),
                'placeholder'  => 'Insert a text.',
                ),

            array(
                'id'               => 'qe_paragraph',
                'type'             => 'editor',
                'title'            => __('Form Paragraph', 'redux-framework'), 
                'subtitle'  => 'Insert a text.',
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 10
                    )
                ),

            array(
                'id'       => 'qe_shortcode',
                'type'     => 'text',
                'title'    => __( 'Form Shortcode', 'redux-framework' ),
                //'subtitle' => __( 'Subtitle', 'redux-framework' ),
                'placeholder'  => 'Insert the shortcode from the plugin.',
                ),
            )
        ) );

    /*
     * <--- END SECTIONS
     */

