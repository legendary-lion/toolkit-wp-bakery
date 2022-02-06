<?php

// update text block parameters
vc_map_update('vc_column_text', array(
	'params' => array(
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => esc_html__( 'Text', 'js_composer' ),
			'param_name' => 'content',
			'value' => '<p>' . esc_html__( '', 'js_composer' ) . '</p>',
		),
		array(
		"type" => "ll_add_placeholder_text",
		"holder" => "div",
		"class" => "",
		// "heading" => __("Flipping text", "js_composer"),
		"param_name" => "ll_add_placeholder_text",
		"value" => '',
		// "description" => __( "Add placeholder text", 'legendary-visual-composer' ),
		),
		vc_map_add_css_animation(),
		array(
			'type' => 'el_id',
			'heading' => esc_html__( 'Element ID', 'js_composer' ),
			'param_name' => 'el_id',
			'description' => sprintf( esc_html__( 'Enter element ID (Note: make sure it is unique and valid according to %sw3c specification%s).', 'js_composer' ), '<a href="https://www.w3schools.com/tags/att_global_id.asp" target="_blank">', '</a>' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
		),
	),
));


