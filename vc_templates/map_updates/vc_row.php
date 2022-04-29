<?php

vc_map_update('vc_row', array(
	'name' => esc_html__( 'Row', 'toolkit-vc' ),
	'is_container' => true,
	'icon' => plugin_dir_url( __FILE__ ) . '../../assets/img/toolkit_vc_row.svg',
	'show_settings_on_create' => false,
	'category' => esc_html__( 'Content', 'toolkit-vc' ),
	'class' => 'vc_main-sortable-element',
	'description' => esc_html__( 'Place content elements inside the row', 'toolkit-vc' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Row stretch', 'toolkit-vc' ),
			'param_name' => 'full_width',
			'value' => array(
				esc_html__( 'Default', 'toolkit-vc' ) => '',
				esc_html__( 'Stretch row', 'toolkit-vc' ) => 'stretch_row',
				esc_html__( 'Stretch row and content', 'toolkit-vc' ) => 'stretch_row_content',
				esc_html__( 'Stretch row and content (no paddings)', 'toolkit-vc' ) => 'stretch_row_content_no_spaces',
			),
			'description' => esc_html__( 'Select stretching options for row and content (Note: stretched may not work properly if parent container has "overflow: hidden" CSS property).', 'toolkit-vc' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Full height row?', 'toolkit-vc' ),
			'param_name' => 'full_height',
			'description' => esc_html__( 'If checked row will be set to full height.', 'toolkit-vc' ),
			'value' => array( esc_html__( 'Yes', 'toolkit-vc' ) => 'yes' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Reverse order for mobile?', 'toolkit-vc' ),
			'param_name' => 'reverse_on_mobile',
			'description' => esc_html__( 'If checked row will reverse order for mobile (under 769px).', 'toolkit-vc' ),
			'value' => array( esc_html__( 'Yes', 'toolkit-vc' ) => 'yes' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Columns position', 'toolkit-vc' ),
			'param_name' => 'columns_placement',
			'value' => array(
				esc_html__( 'Middle', 'toolkit-vc' ) => 'middle',
				esc_html__( 'Top', 'toolkit-vc' ) => 'top',
				esc_html__( 'Bottom', 'toolkit-vc' ) => 'bottom',
				esc_html__( 'Stretch', 'toolkit-vc' ) => 'stretch',
			),
			'description' => esc_html__( 'Select columns position within row.', 'toolkit-vc' ),
			'dependency' => array(
				'element' => 'full_height',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Equal height', 'toolkit-vc' ),
			'param_name' => 'equal_height',
			'description' => esc_html__( 'If checked columns will be set to equal height.', 'toolkit-vc' ),
			'value' => array( esc_html__( 'Yes', 'toolkit-vc' ) => 'yes' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Content position', 'toolkit-vc' ),
			'param_name' => 'content_placement',
			'value' => array(
				esc_html__( 'Default', 'toolkit-vc' ) => '',
				esc_html__( 'Top', 'toolkit-vc' ) => 'top',
				esc_html__( 'Middle', 'toolkit-vc' ) => 'middle',
				esc_html__( 'Bottom', 'toolkit-vc' ) => 'bottom',
			),
			'description' => esc_html__( 'Select content position within columns.', 'toolkit-vc' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Use video background?', 'toolkit-vc' ),
			'param_name' => 'video_bg',
			'description' => esc_html__( 'If checked, video will be used as row background.', 'toolkit-vc' ),
			'value' => array( esc_html__( 'Yes', 'toolkit-vc' ) => 'yes' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'YouTube link', 'toolkit-vc' ),
			'param_name' => 'video_bg_url',
			'value' => 'https://www.youtube.com/watch?v=lMJXxhRFO1k', // default video url
			'description' => esc_html__( 'Add YouTube link.', 'toolkit-vc' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'CSS Overlay', 'toolkit-vc' ),
			'param_name' => 'css_overlay',
			'value' => '',
			'description' => esc_html__( '*Requires unique ID* Added as css background above the row, below content in E.G. rgba(0, 0, 0, 0.5) or linear-gradient(120deg, #eaee44, #33d0ff)', 'toolkit-vc' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Parallax', 'toolkit-vc' ),
			'param_name' => 'video_bg_parallax',
			'value' => array(
				esc_html__( 'None', 'toolkit-vc' ) => '',
				esc_html__( 'Simple', 'toolkit-vc' ) => 'content-moving',
				esc_html__( 'With fade', 'toolkit-vc' ) => 'content-moving-fade',
			),
			'description' => esc_html__( 'Add parallax type background for row.', 'toolkit-vc' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Parallax', 'toolkit-vc' ),
			'param_name' => 'parallax',
			'value' => array(
				esc_html__( 'None', 'toolkit-vc' ) => '',
				esc_html__( 'Simple', 'toolkit-vc' ) => 'content-moving',
				esc_html__( 'With fade', 'toolkit-vc' ) => 'content-moving-fade',
			),
			'description' => esc_html__( 'Add parallax type background for row (Note: If no image is specified, parallax will use background image from Design Options).', 'toolkit-vc' ),
			'dependency' => array(
				'element' => 'video_bg',
				'is_empty' => true,
			),
		),
		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Image', 'toolkit-vc' ),
			'param_name' => 'parallax_image',
			'value' => '',
			'description' => esc_html__( 'Select image from media library.', 'toolkit-vc' ),
			'dependency' => array(
				'element' => 'parallax',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Parallax speed', 'toolkit-vc' ),
			'param_name' => 'parallax_speed_video',
			'value' => '1.5',
			'description' => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'toolkit-vc' ),
			'dependency' => array(
				'element' => 'video_bg_parallax',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Parallax speed', 'toolkit-vc' ),
			'param_name' => 'parallax_speed_bg',
			'value' => '1.5',
			'description' => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'toolkit-vc' ),
			'dependency' => array(
				'element' => 'parallax',
				'not_empty' => true,
			),
		),
		vc_map_add_css_animation( false ),
		array(
			'type' => 'el_id',
			'heading' => esc_html__( 'Row ID', 'toolkit-vc' ),
			'param_name' => 'el_id',
			'description' => sprintf( esc_html__( 'Enter element ID (Note: make sure it is unique and valid according to %sw3c specification%s).', 'toolkit-vc' ), '<a href="https://www.w3schools.com/tags/att_global_id.asp" target="_blank">', '</a>' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Disable row', 'toolkit-vc' ),
			'param_name' => 'disable_element',
			// Inner param name.
			'description' => esc_html__( 'If checked the row won\'t be visible on the public side of your website. You can switch it back any time.', 'toolkit-vc' ),
			'value' => array( esc_html__( 'Yes', 'toolkit-vc' ) => 'yes' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'toolkit-vc' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'toolkit-vc' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', 'toolkit-vc' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design Options', 'toolkit-vc' ),
		),
	),
));