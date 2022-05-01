<?php

vc_map_update('vc_column_text', array(
	'icon' => plugin_dir_url( __FILE__ ) . '../../assets/img/toolkit_vc_text_block.svg',
	'params' => array(
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => esc_html__( 'Text', 'toolkit-vc' ),
			'param_name' => 'content',
			'value' => '<p>' . esc_html__( '', 'toolkit-vc' ) . '</p>',
		),
		array(
			"type" => "toolkit_vc_add_placeholder_text",
			"holder" => "div",
			"class" => "",
			"param_name" => "toolkit_vc_add_placeholder_text",
			"value" => '',
		),
		vc_map_add_css_animation(),
		array(
			'type' => 'el_id',
			'heading' => esc_html__( 'Element ID', 'toolkit-vc' ),
			'param_name' => 'el_id',
			'description' => sprintf( esc_html__( 'Enter element ID (Note: make sure it is unique and valid according to %sw3c specification%s).', 'toolkit-vc' ), '<a href="https://www.w3schools.com/tags/att_global_id.asp" target="_blank">', '</a>' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'toolkit-vc' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'toolkit-vc' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'Css', 'toolkit-vc' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'toolkit-vc' ),
		),
	),
));