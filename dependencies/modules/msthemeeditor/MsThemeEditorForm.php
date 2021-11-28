<?php

include(_PS_MODULE_DIR_.'msthemeeditor/classes/CF.php');

class msThemeEditorForm extends msThemeEditor
{
	public $fields_form = array();
	public $id_input = array();
	private $p = __PS_BASE_URI__.'modules/msthemeeditor/';

	public function initConfigure()
	{
		$cf = new CF();
		$this->fields_form[0]['form'] = array(
			'input' => array(
				array(
					'type' => 'html',
					'name' => '<input type="hidden" name="id_tab_index" id="id_tab_index" value="0">',
				),
				array(
					'type' => 'html',
					'name' => '<div id="welcome">'.$this->getTranslator()->trans('Welcome to', array(), 'Modules.Msthemeeditor.Admin').' <span>theme</span></div>',
				),
			),
		);
		// general
		$this->fields_form[1]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('General', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'input' => array(
				array(
					'type' => 'switch',
					'name' => 'responsive',
					'label' => $this->getTranslator()->trans('Enable responsive layout:', array(), 'Modules.Msthemeeditor.Admin'),
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'responsive_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'responsive_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'desc' => $this->getTranslator()->trans('Enable responsive design for mobile devices.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isBool',
				),
				array(
					'type' => 'radio',
					'name' => 'responsive_max',
					'label' => $this->getTranslator()->trans('Maximum Page Width:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'res_max_0',
							'value' => 0,
							'label' => $this->getTranslator()->trans('992', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'res_max_1',
							'value' => 1,
							'label' => $this->getTranslator()->trans('1200', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'res_max_2',
							'value' => 2,
							'label' => $this->getTranslator()->trans('1440', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'res_max_3',
							'value' => 3,
							'label' => $this->getTranslator()->trans('Full screen', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'CC_res_max_4',
							'value' => 4,
							'label' => $this->getTranslator()->trans('Set custom size', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'desc' => $this->getTranslator()->trans('Maximum width of the page', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'text',
					'name' => 'CC_res_max',
					'label' => $this->getTranslator()->trans('Custom maximum page width:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'disabled' => true,
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'radio',
					'name' => 'box_style',
					'label' => $this->getTranslator()->trans('Box style:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'box_style_1',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Full width', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'box_style_2',
							'value' => 2,
							'label' => $this->getTranslator()->trans('Boxed', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'desc' => $this->getTranslator()->trans('', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isUnsignedInt',
				),
				'left_column_size' => array(
					'type' => 'html',
					'name' => '',
					'label' => $this->getTranslator()->trans('Left column width', array(), 'Modules.Msthemeeditor.Admin'),
					'desc' => array(
						$this->getTranslator()->trans('This setting is used to change the width of left column, it would not enable the left column.', array(), 'Modules.Msthemeeditor.Admin'),
						$this->getTranslator()->trans('The later 3 options work for slide in left and right columns.', array(), 'Modules.Msthemeeditor.Admin'),
					),
				),
				'right_column_size' => array(
					'type' => 'html',
					'name' => '',
					'label' => $this->getTranslator()->trans('Right column width', array(), 'Modules.Msthemeeditor.Admin'),
					'desc' => array(
						$this->getTranslator()->trans('This setting is used to change the width of right column, it would not enable the right column.', array(), 'Modules.Msthemeeditor.Admin'),
						$this->getTranslator()->trans('The later 3 options work for slide in left and right columns.', array(), 'Modules.Msthemeeditor.Admin'),
					),
				),
				array(
					'type' => 'text',
					'name' => 'top_spacing',
					'label' => $this->getTranslator()->trans('Page top spacing:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'text',
					'name' => 'bottom_spacing',
					'label' => $this->getTranslator()->trans('Page bottom spacing:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'text',
					'name' => 'block_spacing',
					'label' => $this->getTranslator()->trans('Block spacing:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'text',
					'name' => 'welcome',
					'label' => $this->getTranslator()->trans('Guest welcome message:', array(), 'Modules.Msthemeeditor.Admin'),
					'lang' => true,
				),
				array(
					'type' => 'text',
					'name' => 'welcome_logged',
					'label' => $this->getTranslator()->trans('Logged welcome message:', array(), 'Modules.Msthemeeditor.Admin'),
					'lang' => true,
				),
				array(
					'type' => 'textarea',
					'name' => 'copyright_text',
					'label' => $this->getTranslator()->trans('Copyright text:', array(), 'Modules.Msthemeeditor.Admin'),
					'cols' => 60,
					'rows' => 2,
					'lang' => true,
				),
				'payment_icon' => array(
					'type' => 'file',
					'label' => $this->getTranslator()->trans('Payment icon:', array(), 'Modules.Msthemeeditor.Admin'),
					'name' => 'payment_icon',
				),
				array(
					'type' => 'text',
					'name' => 'navigation_pipe',
					'label' => $this->getTranslator()->trans('Navigation pipe:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'desc' => $this->getTranslator()->trans('Used for the navigation path: Store Name > Category Name > Product Name.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isAnything',
				),
				array(
					'type' => 'radio',
					'name' => 'drop_down',
					'label' => $this->getTranslator()->trans('How to open drop down lists:', array(), 'Modules.Msthemeeditor.Admin'),
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'drop_down_click',
							'value' => 0,
							'label' => $this->getTranslator()->trans('Click', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'drop_down_hover',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Mouse hover', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'switch',
					'name' => 'download_font',
					'label' => $this->getTranslator()->trans('Download fonts:', array(), 'Modules.Msthemeeditor.Admin'),
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'download_font_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'download_font_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'desc' => $this->getTranslator()->trans('If you want to use CDN fonts set to No.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isBool',
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		// main header
		$this->fields_form[2]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('Header & Mobile header', array(), 'Modules.Msthemeeditor.Admin').' <sup>'.$this->getTranslator()->trans('Main header', array(), 'Modules.Msthemeeditor.Admin').'</sup>',
			),
			'input' => array(
				array(
					'type' => 'switch',
					'name' => 'fullwidth_h',
					'label' => $this->getTranslator()->trans('Full width header:', array(), 'Modules.Msthemeeditor.Admin'),
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'fullwidth_h_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'fullwidth_h_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'radio',
					'name' => 'h_left_alignment',
					'label' => $this->getTranslator()->trans('Header left alignment:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'h_left_alignment_left',
							'value' => 0,
							'label' => $this->getTranslator()->trans('Left', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'h_left_alignment_center',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Center', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'h_left_alignment_right',
							'value' => 2,
							'label' => $this->getTranslator()->trans('Right', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'radio',
					'name' => 'h_center_alignment',
					'label' => $this->getTranslator()->trans('Header center alignment:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'h_center_alignment_left',
							'value' => 0,
							'label' => $this->getTranslator()->trans('Left', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'h_center_alignment_center',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Center', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'h_center_alignment_right',
							'value' => 2,
							'label' => $this->getTranslator()->trans('Right', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'radio',
					'name' => 'h_right_alignment',
					'label' => $this->getTranslator()->trans('Header right alignment:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'h_right_alignment_left',
							'value' => 0,
							'label' => $this->getTranslator()->trans('Left', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'h_right_alignment_center',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Center', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'h_right_alignment_right',
							'value' => 2,
							'label' => $this->getTranslator()->trans('Right', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isUnsignedInt',
				),
				'mobile_logo' => array(
					'type' => 'file',
					'label' => $this->getTranslator()->trans('Mobile logo:', array(), 'Modules.Msthemeeditor.Admin'),
					'name' => 'mobile_logo',
					'desc' => $this->getTranslator()->trans('If you want to have a different logo for mobile, then uplaod a logo here.', array(), 'Modules.Msthemeeditor.Admin'),
				),
				'mobile_logo_filter' => array(
					'type' => 'html',
					'name' => '',
					'label' => $this->getTranslator()->trans('Mobile logo filter:', array(), 'Modules.Msthemeeditor.Admin'),
				),
				'retina_logo' => array(
					'type' => 'file',
					'label' => $this->getTranslator()->trans('Retina logo:', array(), 'Modules.Msthemeeditor.Admin'),
					'name' => 'retina_logo',
					'desc' => $this->getTranslator()->trans('The size of retina logo should be twice of your logo/mobile logo or at least keep the same ratio.', array(), 'Modules.Msthemeeditor.Admin'),
				),
				'retina_logo_filter' => array(
					'type' => 'html',
					'name' => '',
					'label' => $this->getTranslator()->trans('Retina logo filter:', array(), 'Modules.Msthemeeditor.Admin'),
				),
				array(
					'type' => 'color',
					'name' => 'h_bg_color',
					'label' => $this->getTranslator()->trans('Background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'cin_h_bg',
					'label' => $this->getTranslator()->trans('Background color or image:', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'cin_h_bg_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'cin_h_bg_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'select',
					'name' => 'h_bg_img',
					'label' => $this->getTranslator()->trans('Select a pattern number:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'query' => $this->getPatternsArray(),
						'id' => 'id',
						'name' => 'name',
						'default' => array(
							'value' => 0,
							'label' => $this->getTranslator()->trans('None', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'desc' => $this->getPatterns(),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'color',
					'name' => 'h_color',
					'label' => $this->getTranslator()->trans('Text color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'color',
					'name' => 'h_hover_color',
					'label' => $this->getTranslator()->trans('Text hover color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'color',
					'name' => 'h_link_color',
					'label' => $this->getTranslator()->trans('Link color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'color',
					'name' => 'h_link_bg_color',
					'label' => $this->getTranslator()->trans('Link background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'color',
					'name' => 'h_link_hover_color',
					'label' => $this->getTranslator()->trans('Link hover color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'color',
					'name' => 'h_link_hover_bg_color',
					'label' => $this->getTranslator()->trans('Link hover background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				'border' => array(
					'type' => 'html',
					'name' => '',
					'label' => $this->getTranslator()->trans('Border:', array(), 'Modules.Msthemeeditor.Admin'),
				),
				array(
					'type' => 'switch',
					'name' => 'cin_h_border',
					'label' => $this->getTranslator()->trans('Custom border:', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'cin_h_border_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'cin_h_border_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'cin_border' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'text',
					'name' => 'h_border_radius',
					'label' => $this->getTranslator()->trans('Border radius:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'cin_h_border_radius',
					'label' => $this->getTranslator()->trans('Custom border radius:', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'cin_h_border_radius_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'cin_h_border_radius_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'cin_border_radius' => array(
					'type' => 'html',
					'name' => '',
					'label' => $this->getTranslator()->trans('Border radius:', array(), 'Modules.Msthemeeditor.Admin'),
				),
				'bs' => array(
					'type' => 'html',
					'name' => '',
					'label' => $this->getTranslator()->trans('Box shadow:', array(), 'Modules.Msthemeeditor.Admin'),
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		// header top
		$this->fields_form[3]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('Header top', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'input' => array(
				array(
					'type' => 'switch',
					'name' => 'iie_ht_bg_color',
					'label' => $this->getTranslator()->trans('Background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_ht_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_ht_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'ht_bg_color',
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_ht_background',
					'label' => $this->getTranslator()->trans('Background image:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_ht_background_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_ht_background_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'select',
					'name' => 'ht_bg_img',
					'label' => $this->getTranslator()->trans('Select a pattern number:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'query' => $this->getPatternsArray(),
						'id' => 'id',
						'name' => 'name',
						'default' => array(
							'value' => 0,
							'label' => $this->getTranslator()->trans('None', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'desc' => $this->getPatterns(),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_ht_color',
					'label' => $this->getTranslator()->trans('Text color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_ht_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_ht_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'ht_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_ht_hover_color',
					'label' => $this->getTranslator()->trans('Text hover color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_ht_hover_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_ht_hover_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'ht_hover_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_ht_link_color',
					'label' => $this->getTranslator()->trans('Link color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_ht_link_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_ht_link_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'ht_link_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_ht_link_bg_color',
					'label' => $this->getTranslator()->trans('Link background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_ht_link_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_ht_link_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'ht_link_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_ht_link_hover_color',
					'label' => $this->getTranslator()->trans('Link hover color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_ht_link_hover_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_ht_link_hover_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'ht_link_hover_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_ht_link_hover_bg_color',
					'label' => $this->getTranslator()->trans('Link hover background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_ht_link_hover_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_ht_link_hover_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'ht_link_hover_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_ht_border',
					'label' => $this->getTranslator()->trans('Border/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_ht_bs_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_ht_bs_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'border' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_ht_border',
					'label' => $this->getTranslator()->trans('Custom border/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_ht_border_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_ht_border_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'cin_border' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_ht_border_radius',
					'label' => $this->getTranslator()->trans('Border radius/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_ht_border_radius_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_ht_border_radius_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'text',
					'name' => 'ht_border_radius',
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_ht_border_radius',
					'label' => $this->getTranslator()->trans('Custom border radius/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_ht_border_radius_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_ht_border_radius_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'cin_border_radius' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_ht_bs',
					'label' => $this->getTranslator()->trans('Box shadow:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_ht_bs_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_ht_bs_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'bs' => array(
					'type' => 'html',
					'name' => '',
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		// header center
		$this->fields_form[4]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('Header center', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'input' => array(
				array(
					'type' => 'switch',
					'name' => 'iie_hc_bg_color',
					'label' => $this->getTranslator()->trans('Background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hc_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hc_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'hc_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_hc_background',
					'label' => $this->getTranslator()->trans('Background image:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_hc_background_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_hc_background_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'select',
					'name' => 'hc_bg_img',
					'label' => $this->getTranslator()->trans('Select a pattern number:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'query' => $this->getPatternsArray(),
						'id' => 'id',
						'name' => 'name',
						'default' => array(
							'value' => 0,
							'label' => $this->getTranslator()->trans('None', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'desc' => $this->getPatterns(),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hc_color',
					'label' => $this->getTranslator()->trans('Text color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hc_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hc_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'hc_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hc_hover_color',
					'label' => $this->getTranslator()->trans('Text hover color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hc_hover_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hc_hover_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'hc_hover_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hc_link_color',
					'label' => $this->getTranslator()->trans('Link color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hc_link_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hc_link_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'hc_link_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hc_link_bg_color',
					'label' => $this->getTranslator()->trans('Link background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hc_link_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hc_link_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'hc_link_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hc_link_hover_color',
					'label' => $this->getTranslator()->trans('Link hover color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hc_link_hover_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hc_link_hover_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'hc_link_hover_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hc_link_hover_bg_color',
					'label' => $this->getTranslator()->trans('Link hover background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hc_link_hover_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hc_link_hover_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'hc_link_hover_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hc_border',
					'label' => $this->getTranslator()->trans('Border/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hc_border_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hc_border_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'border' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_hc_border',
					'label' => $this->getTranslator()->trans('Custom border/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_hc_border_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_hc_border_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'cin_border' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hc_border_radius',
					'label' => $this->getTranslator()->trans('Border radius/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hc_border_radius_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hc_border_radius_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'text',
					'name' => 'hc_border_radius',
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_hc_border_radius',
					'label' => $this->getTranslator()->trans('Custom border radius/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_hc_border_radius_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_hc_border_radius_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'cin_border_radius' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hc_bs',
					'label' => $this->getTranslator()->trans('Box shadow:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hc_bs_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hc_bs_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'bs' => array(
					'type' => 'html',
					'name' => '',
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		// header bottom
		$this->fields_form[5]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('Header bottom', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'input' => array(
				array(
					'type' => 'switch',
					'name' => 'iie_hb_bg_color',
					'label' => $this->getTranslator()->trans('Background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hb_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hb_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'hb_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_hb_background',
					'label' => $this->getTranslator()->trans('Background image:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_hb_background_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_hb_background_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'select',
					'name' => 'hb_bg_img',
					'label' => $this->getTranslator()->trans('Select a pattern number:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'query' => $this->getPatternsArray(),
						'id' => 'id',
						'name' => 'name',
						'default' => array(
							'value' => 0,
							'label' => $this->getTranslator()->trans('None', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'desc' => $this->getPatterns(),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hb_color',
					'label' => $this->getTranslator()->trans('Text color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hb_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hb_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'hb_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hb_hover_color',
					'label' => $this->getTranslator()->trans('Text hover color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hb_hover_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hb_hover_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'hb_hover_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hb_link_color',
					'label' => $this->getTranslator()->trans('Link color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hb_link_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hb_link_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'hb_link_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hb_link_bg_color',
					'label' => $this->getTranslator()->trans('Link background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hb_link_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hb_link_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'hb_link_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hb_link_hover_color',
					'label' => $this->getTranslator()->trans('Link hover color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hb_link_hover_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hb_link_hover_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'hb_link_hover_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hb_link_hover_bg_color',
					'label' => $this->getTranslator()->trans('Link hover background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hb_link_hover_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hb_link_hover_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'hb_link_hover_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hb_border',
					'label' => $this->getTranslator()->trans('Border/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hb_border_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hb_border_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'border' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_hb_border',
					'label' => $this->getTranslator()->trans('Custom border/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_hb_border_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_hb_border_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'cin_border' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hb_border_radius',
					'label' => $this->getTranslator()->trans('Border radius/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hb_border_radius_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hb_border_radius_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'text',
					'name' => 'hb_border_radius',
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_hb_border_radius',
					'label' => $this->getTranslator()->trans('Custom border radius/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_hb_border_radius_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_hb_border_radius_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'cin_border_radius' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hb_bs',
					'label' => $this->getTranslator()->trans('Box shadow:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hb_bs_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hb_bs_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'bs' => array(
					'type' => 'html',
					'name' => '',
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		// header mobile
		$this->fields_form[6]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('Header mobile', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'input' => array(
				array(
					'type' => 'switch',
					'name' => 'iie_hm_bg_color',
					'label' => $this->getTranslator()->trans('Background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hm_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hm_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'hm_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_hm_bg',
					'label' => $this->getTranslator()->trans('Background image:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_hm_bg_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_hm_bg_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'select',
					'name' => 'hm_bg_img',
					'label' => $this->getTranslator()->trans('Select a pattern number:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'query' => $this->getPatternsArray(),
						'id' => 'id',
						'name' => 'name',
						'default' => array(
							'value' => 0,
							'label' => $this->getTranslator()->trans('None', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'desc' => $this->getPatterns(),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hm_color',
					'label' => $this->getTranslator()->trans('Text color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hm_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hm_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'hm_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hm_hover_color',
					'label' => $this->getTranslator()->trans('Text hover color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hm_hover_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hm_hover_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'hm_hover_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hm_link_color',
					'label' => $this->getTranslator()->trans('Link color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hm_link_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hm_link_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'hm_link_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hm_link_bg_color',
					'label' => $this->getTranslator()->trans('Link background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hm_link_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hm_link_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'hm_link_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hm_link_hover_color',
					'label' => $this->getTranslator()->trans('Link hover color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hm_link_hover_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hm_link_hover_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'hm_link_hover_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hm_link_hover_bg_color',
					'label' => $this->getTranslator()->trans('Link hover background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hm_link_hover_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hm_link_hover_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'hm_link_hover_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hm_border',
					'label' => $this->getTranslator()->trans('Border/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hm_border_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hm_border_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'border' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_hm_border',
					'label' => $this->getTranslator()->trans('Custom border/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_hm_border_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_hm_border_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'cin_border' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hm_border_radius',
					'label' => $this->getTranslator()->trans('Border radius/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hm_border_radius_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hm_border_radius_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'text',
					'name' => 'hm_border_radius',
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_hm_border_radius',
					'label' => $this->getTranslator()->trans('Custom border radius/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_hm_border_radius_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_hm_border_radius_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'cin_border_radius' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_hm_bs',
					'label' => $this->getTranslator()->trans('Box shadow:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN HEADER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_hm_bs_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_hm_bs_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'bs' => array(
					'type' => 'html',
					'name' => '',
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		// sticky header
		$this->fields_form[7]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('Sticky header', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'input' => array(
				array(
					'type' => 'select',
					'name' => 'sticky_h',
					'label' => $this->getTranslator()->trans('Select sticky header:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'query' => array(
							array('id' => 0, 'name' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin')),
							array('id' => 1, 'name' => $this->getTranslator()->trans('All header', array(), 'Modules.Msthemeeditor.Admin')),
							array('id' => 2, 'name' => 'Header top'),
							array('id' => 3, 'name' => 'Header center'),
							array('id' => 4, 'name' => 'Header bottom'),
						),
						'id' => 'id',
						'name' => 'name',
					),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'sticky_animation',
					'label' => $this->getTranslator()->trans('With animation', array(), 'Modules.Msthemeeditor.Admin'),
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'sticky_animation_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'sticky_animation_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'switch',
					'name' => 'sticky_header_top',
					'label' => $this->getTranslator()->trans('Display header top on sticky all header:', array(), 'Modules.Msthemeeditor.Admin'),
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'sticky_header_top_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'sticky_header_top_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'switch',
					'name' => 'sticky_header_center',
					'label' => $this->getTranslator()->trans('Display header center on sticky all header:', array(), 'Modules.Msthemeeditor.Admin'),
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'sticky_header_center_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'sticky_header_center_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'switch',
					'name' => 'sticky_header_bottom',
					'label' => $this->getTranslator()->trans('Display header bottom on sticky all header:', array(), 'Modules.Msthemeeditor.Admin'),
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'sticky_header_bottom_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'sticky_header_bottom_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'bs' => array(
					'type' => 'html',
					'name' => '',
					'label' => $this->getTranslator()->trans('Box shadow:', array(), 'Modules.Msthemeeditor.Admin'),
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		// product block
		$this->fields_form[8]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('Product block', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'description' => $this->getTranslator()->trans('Settings here are for products in product sliders and products on product listings. You need to clear the Smarty cache after making changes here.', array(), 'Modules.Msthemeeditor.Admin'),
			'input' => array(
				array(
					'type' => 'switch',
					'name' => 'pro_bck_retina',
					'label' => $this->getTranslator()->trans('', array(), 'Modules.Msthemeeditor.Admin'),
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'pro_bck_retina_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'pro_bck_retina_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'desc' => $this->getTranslator()->trans('Retina support for logo and product images.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isBool',
				),
				array(
					'type' => 'radio',
					'name' => 'pro_bck_cp_img',
					'label' => $this->getTranslator()->trans('How to display product images on the category page:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'pro_bck_cp_img_0',
							'value' => 0,
							'label' => $this->getTranslator()->trans('Display the cover images only', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'pro_bck_cp_img_1',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Display all images in a slider', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'pro_bck_cp_img_2',
							'value' => 2,
							'label' => $this->getTranslator()->trans('Display all images in a slider with thumbnails below', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'desc' => array(
						$this->getTranslator()->trans('Hover image feature and zoom feature would not work when images are in a slider', array(), 'Modules.Msthemeeditor.Admin'),
						$this->getTranslator()->trans('If the cover image you set for a product is not in the images for the default combination, then prestashop will use the first image for the default combination to be the cover image.', array(), 'Modules.Msthemeeditor.Admin'),
					),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'radio',
					'name' => 'pro_bck_op_img',
					'label' => $this->getTranslator()->trans('How to display product images on other places:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'pro_bck_op_img_0',
							'value' => 0,
							'label' => $this->getTranslator()->trans('Display the cover images only', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'pro_bck_op_img_1',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Display all images in a slider', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'pro_bck_op_img_2',
							'value' => 2,
							'label' => $this->getTranslator()->trans('Display all images in a slider with thumbnails below', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'desc' => array(
						$this->getTranslator()->trans('Hover image feature and zoom feature would not work when images are in a slider', array(), 'Modules.Msthemeeditor.Admin'),
						$this->getTranslator()->trans('If the cover image you set for a product is not in the images for the default combination, then prestashop will use the first image for the default combination to be the cover image.', array(), 'Modules.Msthemeeditor.Admin'),
					),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'radio',
					'name' => 'len_of_pro_bck_name',
					'label' => $this->getTranslator()->trans('Length of product names:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'len_of_pro_bck_name_normal',
							'value' => 0,
							'label' => $this->getTranslator()->trans('Normal(one line)', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'len_of_pro_bck_name_long',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Long(70 characters)', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'len_of_pro_bck_name_full',
							'value' => 2,
							'label' => $this->getTranslator()->trans('Full name', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'len_of_pro_bck_name_two',
							'value' => 3,
							'label' => $this->getTranslator()->trans('Two lines, focus all product names having the same height', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'CC_len_of_pro_bck_name_char',
							'value' => 4,
							'label' => $this->getTranslator()->trans('Set custom maximum characters', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'text',
					'name' => 'CC_len_of_pro_bck_name',
					'label' => $this->getTranslator()->trans('Custom maximum characters:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'disabled' => true,
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'radio',
					'name' => 'show_short_desc',
					'label' => $this->getTranslator()->trans('Display product short descriptions:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'show_short_desc_off',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'show_short_desc_on',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes, 200 characters', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'show_short_desc_full',
							'value' => 2,
							'label' => $this->getTranslator()->trans('Yes, full short description', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'CC_show_short_desc_char',
							'value' => 3,
							'label' => $this->getTranslator()->trans('Yes, set maximum characters', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'text',
					'name' => 'CC_show_short_desc',
					'label' => $this->getTranslator()->trans('Custom maximum characters:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'disabled' => true,
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'text',
					'name' => 'pro_bck_truncated_text',
					'label' => $this->getTranslator()->trans('Symbol end of truncated text:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'desc' => array(
						$this->getTranslator()->trans('Leave it empty to use the default value "...".', array(), 'Modules.Msthemeeditor.Admin'),
						$this->getTranslator()->trans('This is a text string that replaces the truncated text. Its length is included in the truncation length setting.', array(), 'Modules.Msthemeeditor.Admin'),
					),
					'validation' => 'isAnything',
				),
				array(
					'type' => 'switch',
					'name' => 'display_color_list',
					'label' => $this->getTranslator()->trans('Show product colors out:', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'display_color_list_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'display_color_list_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'switch',
					'name' => 'display_pro_bck_brand_name',
					'label' => $this->getTranslator()->trans('Show manufacturer/brand name:', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'display_pro_bck_brand_name_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'display_pro_bck_brand_name_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'switch',
					'name' => 'display_pro_bck_reference',
					'label' => $this->getTranslator()->trans('Show reference:', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'display_pro_bck_reference_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'display_pro_bck_reference_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'switch',
					'name' => 'display_pro_bck_cate_name',
					'label' => $this->getTranslator()->trans('Show default category name:', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'display_pro_bck_cate_name_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'display_pro_bck_cate_name_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'switch',
					'name' => 'pro_bck_img_hover_scale',
					'label' => $this->getTranslator()->trans('Zoom product images on hover:', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'pro_bck_img_hover_scale_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'pro_bck_img_hover_scale_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'select',
					'name' => 'pro_bck_font_list',
					'label' => $this->getTranslator()->trans('Product name font:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'optiongroup' => array(
							'query' => CF::fontOptions(),
							'label' => 'name',
						),
						'options' => array(
							'query' => 'query',
							'id' => 'id',
							'name' => 'name'
						),
						'default' => array(
							'value' => 0,
							'label' => $this->getTranslator()->trans('Use default', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'onchange' => 'handle_font_change(this);',
				),
				'pro_bck_font' => array(
					'type' => 'select',
					'name' => 'pro_bck_font',
					'label' => $this->getTranslator()->trans('Product name font weight:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'query' => array(),
						'id' => 'id',
						'name' => 'name',
					),
					'class' => 'fontOptions',
					'onchange' => 'handle_font_style(this);',
					'desc' => '<p id="pro_bck_font_preview" class="fontshow">Sample Font</p>',
					'validation' => 'isAnything',
				),
				array(
					'type' => 'color',
					'name' => 'pro_bck_font_color',
					'label' => $this->getTranslator()->trans('Product name font color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'text',
					'name' => 'pro_bck_font_size',
					'label' => $this->getTranslator()->trans('Product name font size:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'select',
					'name' => 'pro_bck_font_trans',
					'label' => $this->getTranslator()->trans('Product name transform:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'query' => self::$textTransform,
						'id' => 'id',
						'name' => 'name',
					),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'radio',
					'name' => 'border_pro_bck',
					'label' => $this->getTranslator()->trans('Border around product block:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'border_pro_bck_over',
							'value' => 0,
							'label' => $this->getTranslator()->trans('Show border when mouseover', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'border_pro_bck_out',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Show border when mouseout', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'border_pro_bck_fix',
							'value' => 2,
							'label' => $this->getTranslator()->trans('Be steady. (Unchanged)', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isUnsignedInt',
				),
				'border' => array(
					'type' => 'html',
					'name' => '',
					'label' => $this->getTranslator()->trans('Border:', array(), 'Modules.Msthemeeditor.Admin'),
				),
				array(
					'type' => 'switch',
					'name' => 'cin_pro_bck_border',
					'label' => $this->getTranslator()->trans('Custom border:', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'cin_pro_bck_border_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'cin_pro_bck_border_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'cin_border' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'radio',
					'name' => 'border_radius_pro_bck',
					'label' => $this->getTranslator()->trans('Border radius around product block:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'border_radius_pro_bck_over',
							'value' => 0,
							'label' => $this->getTranslator()->trans('Show border radius when mouseover', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'border_radius_pro_bck_out',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Show border radius when mouseout', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'border_radius_pro_bck_fix',
							'value' => 2,
							'label' => $this->getTranslator()->trans('Be steady. (Unchanged)', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'text',
					'name' => 'pro_bck_border_radius',
					'label' => $this->getTranslator()->trans('Border radius:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'cin_pro_bck_border_radius',
					'label' => $this->getTranslator()->trans('Custom border radius:', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'cin_pro_bck_border_radius_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'cin_pro_bck_border_radius_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'cin_border_radius' => array(
					'type' => 'html',
					'name' => '',
					'label' => $this->getTranslator()->trans('Border radius:', array(), 'Modules.Msthemeeditor.Admin'),
				),
				array(
					'type' => 'radio',
					'name' => 'sh_pro_bck',
					'label' => $this->getTranslator()->trans('Shadows around product block:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'sh_pro_bck_over',
							'value' => 0,
							'label' => $this->getTranslator()->trans('Show shadows when mouseover', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'sh_pro_bck_out',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Show shadows when mouseout', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'sh_pro_bck_fix',
							'value' => 2,
							'label' => $this->getTranslator()->trans('Be steady. (Unchanged)', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isUnsignedInt',
				),
				'bs' => array(
					'type' => 'html',
					'name' => '',
					'label' => $this->getTranslator()->trans('Box shadow:', array(), 'Modules.Msthemeeditor.Admin'),
				),
				array(
					'type' => 'text',
					'name' => 'pro_bck_transition',
					'label' => $this->getTranslator()->trans('Transition:', array(), 'Modules.Msthemeeditor.Admin'),
					'desc' => array(
						$this->getTranslator()->trans('Instead of having property changes take effect immediately, you can cause the changes in a property to take place over a period of time.', array(), 'Modules.Msthemeeditor.Admin'),
						$this->getTranslator()->trans('This value will be executed if the settings above are set to "Show ... when mouseover" or "Show ... when mouseout".', array(), 'Modules.Msthemeeditor.Admin'),
					),
					'class' => 'fixed-width-md',
					'prefix' => 's',
					'validation' => 'isUnsignedInt',
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		// cross selling
		$this->fields_form[9]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('Cross selling', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'input' => array(
				'nr_col' => array(
					'type' => 'html',
					'name' => '',
					'label' => $this->getTranslator()->trans('The number of columns', array(), 'Modules.Msthemeeditor.Admin'),
				),
				array(
					'type' => 'radio',
					'name' => 'cs_autoplay',
					'label' => $this->getTranslator()->trans('Autoplay:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'cs_autoplay_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'cs_autoplay_once',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Once, has no effect in loop mode', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'cs_autoplay_yes',
							'value' => 2,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'text',
					'name' => '',
					'label' => $this->getTranslator()->trans('Time:', array(), 'Modules.Msthemeeditor.Admin'),
					'desc' => $this->getTranslator()->trans('The period, in milliseconds, between the end of a transition effect and the start of the next one.', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'prefix' => 'ms',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'text',
					'name' => '',
					'label' => $this->getTranslator()->trans('Transition period:', array(), 'Modules.Msthemeeditor.Admin'),
					'desc' => $this->getTranslator()->trans('The period, in milliseconds, of the transition effect.', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'prefix' => 'ms',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'text',
					'name' => 'cs_spacing_between',
					'label' => $this->getTranslator()->trans('Spacing between products:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'cs_pause_on_hover',
					'label' => $this->getTranslator()->trans('Stop autoplay after interaction:', array(), 'Modules.Msthemeeditor.Admin'),
					'is_bool' => true,
					'values' => array(
						array(
							'id' => '_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => '_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'radio',
					'name' => 'cs_title',
					'label' => $this->getTranslator()->trans('Title text align:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'cs_autoplay_left',
							'value' => 0,
							'label' => $this->getTranslator()->trans('Left', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'cs_autoplay_center',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Center', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'cs_autoplay_right',
							'value' => 2,
							'label' => $this->getTranslator()->trans('Right', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isUnsignedInt',
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		// product pages
		$this->fields_form[10]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('Product pages', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'input' => array(
				'pro_img_col' => array(
					'type' => 'html',
					'name' => '',
					'label' => $this->getTranslator()->trans('Image column width', array(), 'Modules.Msthemeeditor.Admin'),
					'desc' => $this->getTranslator()->trans('The default image type of the main product image is "medium_default" 420px in wide. When the image column width is larger that 4, "large_default" image type will be applied, it is 700px in wide. You may need to change the size of those image types to make images look sharpe.', array(), 'Modules.Msthemeeditor.Admin'),
				),
				'pro_primary_col' => array(
					'type' => 'html',
					'name' => '',
					'label' => $this->getTranslator()->trans('Primary column width', array(), 'Modules.Msthemeeditor.Admin'),
					'desc' => $this->getTranslator()->trans('Sum of the three columns has to be equal 12, for example: 4 + 5 + 3, or 6 + 6 + 0.', array(), 'Modules.Msthemeeditor.Admin'),
				),
				'pro_secondary_col' => array(
					'type' => 'html',
					'name' => '',
					'label' => $this->getTranslator()->trans('Secondary column width', array(), 'Modules.Msthemeeditor.Admin'),
					'desc' => $this->getTranslator()->trans('You can set them to 0 to hide the secondary column.', array(), 'Modules.Msthemeeditor.Admin'),
				),
				array(
					'type' => 'select',
					'name' => 'pro_font_list',
					'label' => $this->getTranslator()->trans('Product name font:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'optiongroup' => array(
							'query' => CF::fontOptions(),
							'label' => 'name',
						),
						'options' => array(
							'query' => 'query',
							'id' => 'id',
							'name' => 'name'
						),
						'default' => array(
							'value' => 0,
							'label' => $this->getTranslator()->trans('Use default', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'onchange' => 'handle_font_change(this);',
				),
				'pro_font' => array(
					'type' => 'select',
					'name' => 'pro_font',
					'label' => $this->getTranslator()->trans('Product font weight:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'query' => array(),
						'id' => 'id',
						'name' => 'name',
					),
					'class' => 'fontOptions',
					'onchange' => 'handle_font_style(this);',
					'desc' => '<p id="pro_font_preview" class="fontshow">Sample Font</p>',
					'validation' => 'isAnything',
				),
				array(
					'type' => 'color',
					'name' => 'pro_font_color',
					'label' => $this->getTranslator()->trans('Product font color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'text',
					'name' => 'pro_font_size',
					'label' => $this->getTranslator()->trans('Product font size:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'select',
					'name' => 'pro_font_trans',
					'label' => $this->getTranslator()->trans('Product transform:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'query' => self::$textTransform,
						'id' => 'id',
						'name' => 'name',
					),
					'validation' => 'isUnsignedInt',
				),
				'thumb_img_type' => array(
					'type' => 'select',
					'name' => 'thumb_img_type',
					'label' => $this->getTranslator()->trans('Thumbnail image type:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'query' => array(),
						'id' => 'id',
						'name' => 'name',
					),
					'validation' => 'isGenericName',
				),
				'gallery_img_type' => array(
					'type' => 'select',
					'name' => 'gallery_img_type',
					'label' => $this->getTranslator()->trans('Gallery image type:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'query' => array(),
						'id' => 'id',
						'name' => 'name',
					),
					'validation' => 'isGenericName',
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		// category pages
		$this->fields_form[11]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'input' => array(
				array(
					'type' => 'radio',
					'name' => 'pro_view',
					'label' => $this->getTranslator()->trans('Default product listing:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'pro_view_grid',
							'value' => 0,
							'label' => $this->getTranslator()->trans('Grid', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'pro_view_list',
							'value' => 1,
							'label' => $this->getTranslator()->trans('List', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'radio',
					'name' => 'pro_view_mobile',
					'label' => $this->getTranslator()->trans('Default product listing for mobile devices:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'pro_view_mobile_grid',
							'value' => 0,
							'label' => $this->getTranslator()->trans('Grid', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'pro_view_mobile_list',
							'value' => 1,
							'label' => $this->getTranslator()->trans('List', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'pro_view_switcher',
					'label' => $this->getTranslator()->trans('Display a switcher so customers can decide using grid or list:', array(), 'Modules.Msthemeeditor.Admin'),
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'pro_view_switcher_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'pro_view_switcher_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'text',
					'name' => 'pro_spacing_grid',
					'label' => $this->getTranslator()->trans('Spacing between products in grid view:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'desc' => $this->getTranslator()->trans('Leave it empty to use the default value 15.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'text',
					'name' => 'products_per_page',
					'label' => $this->getTranslator()->trans('Products per page:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'desc' => array(
						$this->getTranslator()->trans('Number of products displayed per page.', array(), 'Modules.Msthemeeditor.Admin'),
						$this->getTranslator()->trans('This is the same setting as the "Products per page" on the "Product settings" page.', array(), 'Modules.Msthemeeditor.Admin'),
					),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'cate_pro_lazy',
					'label' => $this->getTranslator()->trans('Lazy load images:', array(), 'Modules.Msthemeeditor.Admin'),
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'cate_pro_lazy_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'cate_pro_lazy_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'radio',
					'name' => 'sticky_col',
					'label' => $this->getTranslator()->trans('Sticky left or right column:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'sticky_col_0',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'sticky_col_1',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Sticky left column', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'sticky_col_2',
							'value' => 2,
							'label' => $this->getTranslator()->trans('Sticky right column', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'radio',
					'name' => 'display_cate_title',
					'label' => $this->getTranslator()->trans('Show category title on the category page:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'display_cate_title_0',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'display_cate_title_1',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Left', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'display_cate_title_2',
							'value' => 2,
							'label' => $this->getTranslator()->trans('Center', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'display_cate_title_3',
							'value' => 3,
							'label' => $this->getTranslator()->trans('Right', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'radio',
					'name' => 'display_full_cate_desc',
					'label' => $this->getTranslator()->trans('Show full category description on the category page:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'display_full_cate_desc_0',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'display_full_cate_desc_1',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes, at the top of product listing', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'display_full_cate_desc_2',
							'value' => 2,
							'label' => $this->getTranslator()->trans('Yes, at the bottom of product listing', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'display_cate_img',
					'label' => $this->getTranslator()->trans('Show category image on the category page:', array(), 'Modules.Msthemeeditor.Admin'),
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'display_cate_img_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'display_cate_img_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'radio',
					'name' => 'display_subcate',
					'label' => $this->getTranslator()->trans('Show subcategories:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'display_subcate_0',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'display_subcate_1',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Grid view', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'display_subcate_2',
							'value' => 2,
							'label' => $this->getTranslator()->trans('List view', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'display_subcate_3',
							'value' => 3,
							'label' => $this->getTranslator()->trans('Grid view(Display full category name)', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isUnsignedInt',
				),
				'subcate_per' => array(
					'type' => 'html',
					'name' => '',
					'label' => $this->getTranslator()->trans('Subcategories per row in grid view:', array(), 'Modules.Msthemeeditor.Admin'),
				),
				'products_per' => array(
					'type' => 'html',
					'name' => '',
					'label' => $this->getTranslator()->trans('The number of products per row on listing page', array(), 'Modules.Msthemeeditor.Admin'),
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		// main footer
		$this->fields_form[12]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('Footer & Mobile footer', array(), 'Modules.Msthemeeditor.Admin').' <sup>'.$this->getTranslator()->trans('Main footer', array(), 'Modules.Msthemeeditor.Admin').'</sup>',
			),
			'input' => array(
				array(
					'type' => 'switch',
					'name' => 'fullwidth_f',
					'label' => $this->getTranslator()->trans('Full width footer:', array(), 'Modules.Msthemeeditor.Admin'),
					'is_bool' => true,
					'values' => array(
						array(
							'id' => 'fullwidth_f_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'fullwidth_f_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'radio',
					'name' => 'f_left_alignment',
					'label' => $this->getTranslator()->trans('Footer left alignment:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'f_left_alignment_left',
							'value' => 0,
							'label' => $this->getTranslator()->trans('Left', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'f_left_alignment_center',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Center', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'f_left_alignment_right',
							'value' => 2,
							'label' => $this->getTranslator()->trans('Right', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'radio',
					'name' => 'f_center_alignment',
					'label' => $this->getTranslator()->trans('Footer center alignment:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'f_center_alignment_left',
							'value' => 0,
							'label' => $this->getTranslator()->trans('Left', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'f_center_alignment_center',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Center', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'f_center_alignment_right',
							'value' => 2,
							'label' => $this->getTranslator()->trans('Right', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'radio',
					'name' => 'f_right_alignment',
					'label' => $this->getTranslator()->trans('Footer right alignment:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'f_right_alignment_left',
							'value' => 0,
							'label' => $this->getTranslator()->trans('Left', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'f_right_alignment_center',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Center', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'f_right_alignment_right',
							'value' => 2,
							'label' => $this->getTranslator()->trans('Right', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'color',
					'name' => 'f_bg_color',
					'label' => $this->getTranslator()->trans('Background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'cin_f_bg',
					'label' => $this->getTranslator()->trans('Background color or image:', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'cin_f_bg_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'cin_f_bg_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'select',
					'name' => 'f_bg_img',
					'label' => $this->getTranslator()->trans('Select a pattern number:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'query' => $this->getPatternsArray(),
						'id' => 'id',
						'name' => 'name',
						'default' => array(
							'value' => 0,
							'label' => $this->getTranslator()->trans('None', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'desc' => $this->getPatterns(),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'color',
					'name' => 'f_color',
					'label' => $this->getTranslator()->trans('Text color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'color',
					'name' => 'f_hover_color',
					'label' => $this->getTranslator()->trans('Text hover color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'color',
					'name' => 'f_link_color',
					'label' => $this->getTranslator()->trans('Link color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'color',
					'name' => 'f_link_bg_color',
					'label' => $this->getTranslator()->trans('Link background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'color',
					'name' => 'f_link_hover_color',
					'label' => $this->getTranslator()->trans('Link hover color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'color',
					'name' => 'f_link_hover_bg_color',
					'label' => $this->getTranslator()->trans('Link hover background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				'border' => array(
					'type' => 'html',
					'name' => '',
					'label' => $this->getTranslator()->trans('Border:', array(), 'Modules.Msthemeeditor.Admin'),
				),
				array(
					'type' => 'switch',
					'name' => 'cin_f_border',
					'label' => $this->getTranslator()->trans('Custom border:', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'cin_f_border_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'cin_f_border_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'cin_border' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'text',
					'name' => 'f_border_radius',
					'label' => $this->getTranslator()->trans('Border radius:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'cin_f_border_radius',
					'label' => $this->getTranslator()->trans('Custom border radius:', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'cin_f_border_radius_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'cin_f_border_radius_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'cin_border_radius' => array(
					'type' => 'html',
					'name' => '',
					'label' => $this->getTranslator()->trans('Border radius:', array(), 'Modules.Msthemeeditor.Admin'),
				),
				'bs' => array(
					'type' => 'html',
					'name' => '',
					'label' => $this->getTranslator()->trans('Box shadow:', array(), 'Modules.Msthemeeditor.Admin'),
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		// footer top
		$this->fields_form[13]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('Footer top', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'input' => array(
				array(
					'type' => 'switch',
					'name' => 'iie_ft_bg_color',
					'label' => $this->getTranslator()->trans('Background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_ft_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_ft_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'ft_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_ft_background',
					'label' => $this->getTranslator()->trans('Background image:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_ft_background_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_ft_background_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'select',
					'name' => 'ft_bg_img',
					'label' => $this->getTranslator()->trans('Select a pattern number:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'query' => $this->getPatternsArray(),
						'id' => 'id',
						'name' => 'name',
						'default' => array(
							'value' => 0,
							'label' => $this->getTranslator()->trans('None', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'desc' => $this->getPatterns(),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_ft_color',
					'label' => $this->getTranslator()->trans('Text color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_ft_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_ft_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'ft_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_ft_hover_color',
					'label' => $this->getTranslator()->trans('Text hover color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_ft_hover_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_ft_hover_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'ft_hover_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_ft_link_color',
					'label' => $this->getTranslator()->trans('Link color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_ft_link_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_ft_link_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'ft_link_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_ft_link_bg_color',
					'label' => $this->getTranslator()->trans('Link background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_ft_link_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_ft_link_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'ft_link_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_ft_link_hover_color',
					'label' => $this->getTranslator()->trans('Link hover color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_ft_link_hover_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_ft_link_hover_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'ft_link_hover_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_ft_link_hover_bg_color',
					'label' => $this->getTranslator()->trans('Link hover background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_ft_link_hover_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_ft_link_hover_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'ft_link_hover_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_ft_border',
					'label' => $this->getTranslator()->trans('Border/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_ft_bs_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_ft_bs_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'border' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_ft_border',
					'label' => $this->getTranslator()->trans('Custom border/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_ft_border_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_ft_border_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'cin_border' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_ft_border_radius',
					'label' => $this->getTranslator()->trans('Border radius/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_ft_border_radius_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_ft_border_radius_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'text',
					'name' => 'ft_border_radius',
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_ft_border_radius',
					'label' => $this->getTranslator()->trans('Custom border radius/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_ft_border_radius_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_ft_border_radius_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'cin_border_radius' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_ft_bs',
					'label' => $this->getTranslator()->trans('Box shadow:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_ft_bs_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_ft_bs_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'bs' => array(
					'type' => 'html',
					'name' => '',
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		// footer center
		$this->fields_form[14]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('Footer center', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'input' => array(
				array(
					'type' => 'switch',
					'name' => 'iie_fc_bg_color',
					'label' => $this->getTranslator()->trans('Background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fc_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fc_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'fc_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_fc_background',
					'label' => $this->getTranslator()->trans('Background image:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_fc_background_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_fc_background_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'select',
					'name' => 'fc_bg_img',
					'label' => $this->getTranslator()->trans('Select a pattern number:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'query' => $this->getPatternsArray(),
						'id' => 'id',
						'name' => 'name',
						'default' => array(
							'value' => 0,
							'label' => $this->getTranslator()->trans('None', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'desc' => $this->getPatterns(),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fc_color',
					'label' => $this->getTranslator()->trans('Text color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fc_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fc_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'fc_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fc_hover_color',
					'label' => $this->getTranslator()->trans('Text hover color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fc_hover_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fc_hover_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'fc_hover_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fc_link_color',
					'label' => $this->getTranslator()->trans('Link color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fc_link_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fc_link_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'fc_link_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fc_link_bg_color',
					'label' => $this->getTranslator()->trans('Link background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fc_link_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fc_link_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'fc_link_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fc_link_hover_color',
					'label' => $this->getTranslator()->trans('Link hover color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fc_link_hover_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fc_link_hover_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'fc_link_hover_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fc_link_hover_bg_color',
					'label' => $this->getTranslator()->trans('Link hover background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fc_link_hover_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fc_link_hover_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'fc_link_hover_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fc_border',
					'label' => $this->getTranslator()->trans('Border/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fc_border_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fc_border_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'border' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_fc_border',
					'label' => $this->getTranslator()->trans('Custom border/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_fc_border_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_fc_border_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'cin_border' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fc_border_radius',
					'label' => $this->getTranslator()->trans('Border radius/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fc_border_radius_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fc_border_radius_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'text',
					'name' => 'fc_border_radius',
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_fc_border_radius',
					'label' => $this->getTranslator()->trans('Custom border radius/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_fc_border_radius_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_fc_border_radius_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'cin_border_radius' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fc_bs',
					'label' => $this->getTranslator()->trans('Box shadow:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fc_bs_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fc_bs_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'bs' => array(
					'type' => 'html',
					'name' => '',
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		// footer bottom
		$this->fields_form[15]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('Footer bottom', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'input' => array(
				array(
					'type' => 'switch',
					'name' => 'iie_fb_bg_color',
					'label' => $this->getTranslator()->trans('Background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fb_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fb_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'fb_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_fb_background',
					'label' => $this->getTranslator()->trans('Background image:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_fb_background_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_fb_background_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'select',
					'name' => 'fb_bg_img',
					'label' => $this->getTranslator()->trans('Select a pattern number:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'query' => $this->getPatternsArray(),
						'id' => 'id',
						'name' => 'name',
						'default' => array(
							'value' => 0,
							'label' => $this->getTranslator()->trans('None', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'desc' => $this->getPatterns(),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fb_color',
					'label' => $this->getTranslator()->trans('Text color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fb_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fb_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'hb_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fb_hover_color',
					'label' => $this->getTranslator()->trans('Text hover color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fb_hover_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fb_hover_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'fb_hover_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fb_link_color',
					'label' => $this->getTranslator()->trans('Link color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fb_link_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fb_link_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'fb_link_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fb_link_bg_color',
					'label' => $this->getTranslator()->trans('Link background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fb_link_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fb_link_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'fb_link_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fb_link_hover_color',
					'label' => $this->getTranslator()->trans('Link hover color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fb_link_hover_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fb_link_hover_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'fb_link_hover_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fb_link_hover_bg_color',
					'label' => $this->getTranslator()->trans('Link hover background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fb_link_hover_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fb_link_hover_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'fb_link_hover_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fb_border',
					'label' => $this->getTranslator()->trans('Border/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fb_border_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fb_border_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'border' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_fb_border',
					'label' => $this->getTranslator()->trans('Custom border/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_fb_border_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_fb_border_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'cin_border' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fb_border_radius',
					'label' => $this->getTranslator()->trans('Border radius/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fb_border_radius_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fb_border_radius_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'text',
					'name' => 'fb_border_radius',
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_fb_border_radius',
					'label' => $this->getTranslator()->trans('Custom border radius/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_fb_border_radius_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_fb_border_radius_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'cin_border_radius' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fb_bs',
					'label' => $this->getTranslator()->trans('Box shadow:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fb_bs_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fb_bs_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'bs' => array(
					'type' => 'html',
					'name' => '',
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		// footer mobile
		$this->fields_form[16]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('Footer mobile', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'input' => array(
				array(
					'type' => 'switch',
					'name' => 'iie_fm_bg_color',
					'label' => $this->getTranslator()->trans('Background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fm_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fm_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'fm_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_fm_bg',
					'label' => $this->getTranslator()->trans('Background image:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_fm_bg_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_fm_bg_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'select',
					'name' => 'fm_bg_img',
					'label' => $this->getTranslator()->trans('Select a pattern number:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'query' => $this->getPatternsArray(),
						'id' => 'id',
						'name' => 'name',
						'default' => array(
							'value' => 0,
							'label' => $this->getTranslator()->trans('None', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'desc' => $this->getPatterns(),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fm_color',
					'label' => $this->getTranslator()->trans('Text color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fm_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fm_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'fm_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fm_hover_color',
					'label' => $this->getTranslator()->trans('Text hover color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fm_hover_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fm_hover_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'fm_hover_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fm_link_color',
					'label' => $this->getTranslator()->trans('Link color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fm_link_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fm_link_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'fm_link_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fm_link_bg_color',
					'label' => $this->getTranslator()->trans('Link background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fm_link_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fm_link_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'fm_link_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fm_link_hover_color',
					'label' => $this->getTranslator()->trans('Link hover color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fm_link_hover_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fm_link_hover_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'fm_link_hover_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fm_link_hover_bg_color',
					'label' => $this->getTranslator()->trans('Link hover background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fm_link_hover_bg_color_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fm_link_hover_bg_color_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'color',
					'name' => 'fm_link_hover_bg_color',
					'validation' => 'isColor',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fm_border',
					'label' => $this->getTranslator()->trans('Border/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fm_border_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fm_border_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'border' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_fm_border',
					'label' => $this->getTranslator()->trans('Custom border/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_fm_border_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_fm_border_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'cin_border' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fm_border_radius',
					'label' => $this->getTranslator()->trans('Border radius/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fm_border_radius_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fm_border_radius_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				array(
					'type' => 'text',
					'name' => 'fm_border_radius',
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_cin_fm_border_radius',
					'label' => $this->getTranslator()->trans('Custom border radius/None:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_cin_fm_border_radius_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_cin_fm_border_radius_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'cin_border_radius' => array(
					'type' => 'html',
					'name' => '',
				),
				array(
					'type' => 'switch',
					'name' => 'iie_fm_bs',
					'label' => $this->getTranslator()->trans('Box shadow:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('Inherit from "MAIN FOOTER"', array(), 'Modules.Msthemeeditor.Admin'),
					'isBool' => true,
					'values' => array(
						array(
							'id' => 'iie_fm_bs_yes',
							'value' => 1,
							'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'iie_fm_bs_no',
							'value' => 0,
							'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'validation' => 'isBool',
				),
				'bs' => array(
					'type' => 'html',
					'name' => '',
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		// patterns
		$this->fields_form[17]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('Patterns', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'input' => array(
				array(
					'type' => 'file',
					'name' => 'u_pattern',
					'label' => $this->getTranslator()->trans('Upload your own pattern as background image:', array(), 'Modules.Msthemeeditor.Admin'),
					'desc' => $this->getTranslator()->trans('Pattern credits:', array(), 'Modules.Msthemeeditor.Admin').'<a href="http://subtlepatterns.com" target="_blank">subtlepatterns.com</a><!-- and <a href="http://heropatterns.com" target="_blank">heropatterns.com</a>-->',
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		// colors
		$this->fields_form[18]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('General color', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'input' => array(
				array(
					'type' => 'color',
					'name' => 'body_color',
					'label' => $this->getTranslator()->trans('Body font color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'color',
					'name' => 'link_color',
					'label' => $this->getTranslator()->trans('General links color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'color',
					'name' => 'link_hover_color',
					'label' => $this->getTranslator()->trans('General links hover color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'color',
					'name' => 'price_color',
					'label' => $this->getTranslator()->trans('Price color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'color',
					'name' => 'old_price_color',
					'label' => $this->getTranslator()->trans('Old price color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		// header cart icon
		$this->fields_form[19]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('Header cart icon', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'input' => array(
				array(
					'type' => 'color',
					'name' => 'cart_number_color',
					'label' => $this->getTranslator()->trans('Cart number color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'color',
					'name' => 'cart_number_bg_color',
					'label' => $this->getTranslator()->trans('Cart number background color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		// upload fonts
		$this->fields_form[20]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('Upload fonts', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'description' => '',
			'input' => array(
				array(
					'type' => 'file',
					'name' => 'fonts',
					'label' => $this->getTranslator()->trans('Upload your own fonts:', array(), 'Modules.Msthemeeditor.Admin'),
				),
				array(
					'type' => 'text',
					'name' => 'font_name',
					'label' => $this->getTranslator()->trans('Name your own font:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		$this->fields_form[21]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('Main font', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'input' => array(
				array(
					'type' => 'select',
					'name' => 'body_font_list',
					'label' => $this->getTranslator()->trans('Body name font:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'optiongroup' => array(
							'query' => CF::fontOptions(),
							'label' => 'name',
						),
						'options' => array(
							'query' => 'query',
							'id' => 'id',
							'name' => 'name'
						),
						'default' => array(
							'value' => 0,
							'label' => $this->getTranslator()->trans('Use default', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'onchange' => 'handle_font_change(this);',
				),
				'body_font' => array(
					'type' => 'select',
					'name' => 'body_font',
					'label' => $this->getTranslator()->trans('Body font weight:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'query' => array(),
						'id' => 'id',
						'name' => 'name',
					),
					'class' => 'fontOptions',
					'onchange' => 'handle_font_style(this);',
					'desc' => '<p id="body_font_preview" class="fontshow">Sample Font</p>',
					'validation' => 'isAnything',
				),
				array(
					'type' => 'text',
					'name' => 'body_font_size',
					'label' => $this->getTranslator()->trans('Body font size:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		// heading
		$this->fields_form[22]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('Headings', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'input' => array(
				array(
					'type' => 'select',
					'name' => 'hdg_font_list',
					'label' => $this->getTranslator()->trans('Heading name font:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'optiongroup' => array(
							'query' => CF::fontOptions(),
							'label' => 'name',
						),
						'options' => array(
							'query' => 'query',
							'id' => 'id',
							'name' => 'name'
						),
						'default' => array(
							'value' => 0,
							'label' => $this->getTranslator()->trans('Use default', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'onchange' => 'handle_font_change(this);',
				),
				'hdg_font' => array(
					'type' => 'select',
					'name' => 'hdg_font',
					'label' => $this->getTranslator()->trans('Heading font weight:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'query' => array(),
						'id' => 'id',
						'name' => 'name',
					),
					'class' => 'fontOptions',
					'onchange' => 'handle_font_style(this);',
					'desc' => '<p id="hdg_font_preview" class="fontshow">Sample Font</p>',
					'validation' => 'isAnything',
				),
				array(
					'type' => 'color',
					'name' => 'hdg_font_color',
					'label' => $this->getTranslator()->trans('Heading font color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'text',
					'name' => 'hdg_font_size',
					'label' => $this->getTranslator()->trans('Heading font size:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'select',
					'name' => 'hdg_font_trans',
					'label' => $this->getTranslator()->trans('Heading transform:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'query' => self::$textTransform,
						'id' => 'id',
						'name' => 'name',
					),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'text',
					'name' => 'hdg_border_width',
					'label' => $this->getTranslator()->trans('Heading border width:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'color',
					'name' => 'hdg_border_color',
					'label' => $this->getTranslator()->trans('Heading border color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'radio',
					'name' => 'hdg_style',
					'label' => $this->getTranslator()->trans('Heading style:', array(), 'Modules.Msthemeeditor.Admin'),
					'values' => array(
						array(
							'id' => 'hdg_style_0',
							'value' => 0,
							'label' => $this->getTranslator()->trans('Under line', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'hdg_style_1',
							'value' => 1,
							'label' => $this->getTranslator()->trans('One line. Can not have background image', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'hdg_style_2',
							'value' => 2,
							'label' => $this->getTranslator()->trans('Two lines', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'hdg_style_3',
							'value' => 3,
							'label' => $this->getTranslator()->trans('One short line. Can not have background image', array(), 'Modules.Msthemeeditor.Admin'),
						),
						array(
							'id' => 'hdg_style_4',
							'value' => 4,
							'label' => $this->getTranslator()->trans('One dashed line. Can not have background image', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'desc' => $this->getTranslator()->trans('Pay attention to the "Heading border width" setting above.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'color',
					'name' => 'hdg_under_line_color',
					'label' => $this->getTranslator()->trans('Heading under line color:', array(), 'Modules.Msthemeeditor.Admin'),
					'hint' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'desc' => $this->getTranslator()->trans('This value will be executed if the Heading style value is set to "Under line".', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isColor',
				),
				array(
					'type' => 'select',
					'name' => 'hdg_bg_img',
					'label' => $this->getTranslator()->trans('Select a pattern number:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'query' => $this->getPatternsArray(7),
						'id' => 'id',
						'name' => 'name',
						'default' => array(
							'value' => 0,
							'label' => $this->getTranslator()->trans('None', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'desc' => $this->getPatterns(7, 'hdg_bg'),
					'validation' => 'isUnsignedInt',
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		// others
		$this->fields_form[23]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('Others', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'input' => array(
				array(
					'type' => 'select',
					'name' => 'price_font_list',
					'label' => $this->getTranslator()->trans('Price name font:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'optiongroup' => array(
							'query' => CF::fontOptions(),
							'label' => 'name',
						),
						'options' => array(
							'query' => 'query',
							'id' => 'id',
							'name' => 'name'
						),
						'default' => array(
							'value' => 0,
							'label' => $this->getTranslator()->trans('Use default', array(), 'Modules.Msthemeeditor.Admin'),
						),
					),
					'onchange' => 'handle_font_change(this);',
				),
				'price_font' => array(
					'type' => 'select',
					'name' => 'price_font',
					'label' => $this->getTranslator()->trans('Price font weight:', array(), 'Modules.Msthemeeditor.Admin'),
					'options' => array(
						'query' => array(),
						'id' => 'id',
						'name' => 'name',
					),
					'class' => 'fontOptions',
					'onchange' => 'handle_font_style(this);',
					'desc' => '<p id="price_font_preview" class="fontshow">'.Tools::displayPrice('12345.67890').'</p>',
					'validation' => 'isAnything',
				),
				array(
					'type' => 'text',
					'name' => 'price_font_size',
					'label' => $this->getTranslator()->trans('Price font size:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'text',
					'name' => 'old_price_font_size',
					'label' => $this->getTranslator()->trans('Old price font size:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
				array(
					'type' => 'text',
					'name' => 'main_price_font_size',
					'label' => $this->getTranslator()->trans('Price font size for the main price on the product page:', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'fixed-width-md',
					'prefix' => 'px',
					'validation' => 'isUnsignedInt',
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
		// header tag size
		$this->fields_form[24]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('Header tag size', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'input' => array(
				'header_tag' => array(
					'type' => 'html',
					'name' => '',
					'desc' => $this->getTranslator()->trans('Force the size of h1,h2,h3,... tags on cms page, blog pages and product descriptions.', array(), 'Modules.Msthemeeditor.Admin'),
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
        // Swiper slider (Module)
        $this->fields_form[25]['form'] = array(
            'legend' => array(
                'title' => $this->getTranslator()->trans('Settings', array(), 'Modules.Msthemeeditor.Admin'),
            ),
            'input' => array(
                array(
                    'type' => 'switch',
                    'name' => 'msswiper_int_css',
                    'label' => $this->getTranslator()->trans('Enable internal CSS:', array(), 'Modules.Msthemeeditor.Admin'),
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'msswiper_int_css_yes',
                            'value' => 1,
                            'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
                        ),
                        array(
                            'id' => 'msswiper_int_css_no',
                            'value' => 0,
                            'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
                        ),
                    ),
                    'desc' => $this->getTranslator()->trans('Set to NO to generate the CSS file.', array(), 'Modules.Msthemeeditor.Admin'),
                    'validation' => 'isBool',
                ),
                array(
                    'type' => 'switch',
                    'name' => 'msswiper_int_js',
                    'label' => $this->getTranslator()->trans('Enable internal JS:', array(), 'Modules.Msthemeeditor.Admin'),
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'msswiper_int_js_yes',
                            'value' => 1,
                            'label' => $this->getTranslator()->trans('Yes', array(), 'Modules.Msthemeeditor.Admin'),
                        ),
                        array(
                            'id' => 'msswiper_int_js_no',
                            'value' => 0,
                            'label' => $this->getTranslator()->trans('No', array(), 'Modules.Msthemeeditor.Admin'),
                        ),
                    ),
                    'desc' => $this->getTranslator()->trans('Set to NO to generate the JS file.', array(), 'Modules.Msthemeeditor.Admin'),
                    'validation' => 'isBool',
                ),
            ),
            'submit' => array(
                'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
            ),
        );
		// custom codes
		$this->fields_form[26]['form'] = array(
			'legend' => array(
				'title' => $this->getTranslator()->trans('Custom codes', array(), 'Modules.Msthemeeditor.Admin'),
			),
			'input' => array(
				array(
					'type' => 'textarea',
					'name' => 'custom_css',
					'label' => $this->getTranslator()->trans('Custom CSS Code:', array(), 'Modules.Msthemeeditor.Admin'),
					'cols' => 80,
					'rows' => 20,
					'desc' => $this->getTranslator()->trans('Override css with your custom code', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isAnything',
				),
				array(
					'type' => 'textarea',
					'name' => 'custom_js',
					'label' => $this->getTranslator()->trans('Custom JAVASCRIPT Code:', array(), 'Modules.Msthemeeditor.Admin'),
					'cols' => 80,
					'rows' => 20,
					'desc' => $this->getTranslator()->trans('Remove all script tags', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isAnything',
				),
				array(
					'type' => 'textarea',
					'name' => 'head_code',
					'label' => $this->getTranslator()->trans('Head code:', array(), 'Modules.Msthemeeditor.Admin'),
					'cols' => 80,
					'rows' => 20,
					'desc' => $this->getTranslator()->trans('Code added here is injected into the head tag on every page in your site. Turn off the "Use HTMLPurifier Library" setting on the Preferences > General page if you want to put html tags into this field.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isAnything',
				),
				array(
					'type' => 'textarea',
					'name' => 'tracking_code',
					'label' => $this->getTranslator()->trans('Tracking code:', array(), 'Modules.Msthemeeditor.Admin'),
					'cols' => 80,
					'rows' => 20,
					'desc' => $this->getTranslator()->trans('Code added here is injected before the closing body tag on every page in your site. Turn off the "Use HTMLPurifier Library" setting on the Preferences > General page if you want to put html codes into this field.', array(), 'Modules.Msthemeeditor.Admin'),
					'validation' => 'isAnything',
				),
			),
			'submit' => array(
				'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
			),
		);
	}

	public function initFormGroup()
	{
		$this->initConfigure();
		// s - general
		$this->fields_form[1]['form']['input']['left_column_size']['name'] = $this->buildFormGroup($this->setInputs(1, 'left_'));
		$this->fields_form[1]['form']['input']['right_column_size']['name'] = $this->buildFormGroup($this->setInputs(1, 'right_'));
		if ($payment_icon = Configuration::get('MSM_PAYMENT_ICON'))
			$this->fields_form[1]['form']['input']['payment_icon']['image'] = $this->getImgHtml(($payment_icon != self::$payment_icon ? _THEME_PROD_PIC_DIR_.$payment_icon : $this->p.$payment_icon), 'payment_icon');
		// e - general . s - header
		if (Configuration::get('MSM_MOBILE_LOGO'))
			$this->fields_form[2]['form']['input']['mobile_logo']['image'] = $this->getImgHtml(_THEME_PROD_PIC_DIR_.Configuration::get('MSM_MOBILE_LOGO'), 'mobile_logo');
		if (Configuration::get('MSM_RETINA_LOGO'))
			$this->fields_form[2]['form']['input']['retina_logo']['image'] = $this->getImgHtml(_THEME_PROD_PIC_DIR_.Configuration::get('MSM_RETINA_LOGO'), 'retina_logo');
		$this->fields_form[2]['form']['input']['mobile_logo_filter']['name'] = $this->buildFormGroup($this->setInputs(2, 'mobile_', 1));
		$this->fields_form[2]['form']['input']['retina_logo_filter']['name'] = $this->buildFormGroup($this->setInputs(2, 'retina_', 2));
		$this->fields_form[2]['form']['input']['border']['name'] = $this->buildFormGroup($this->setInputs(3, 'h_', 3));
		$this->fields_form[2]['form']['input']['cin_border']['name'] = $this->buildFormGroup($this->setInputs(4, 'h_', 4));
		$this->fields_form[2]['form']['input']['cin_border_radius']['name'] = $this->buildFormGroup($this->setInputs(5, 'h_'));
		$this->fields_form[2]['form']['input']['bs']['name'] = $this->buildFormGroup($this->setInputs(6, 'h_', 8));
		// e - header . s - header.top
		$this->fields_form[3]['form']['input']['border']['name'] = $this->buildFormGroup($this->setInputs(3, 'ht_', 9));
		$this->fields_form[3]['form']['input']['cin_border']['name'] = $this->buildFormGroup($this->setInputs(4, 'ht_', 10));
		$this->fields_form[3]['form']['input']['cin_border_radius']['name'] = $this->buildFormGroup($this->setInputs(5, 'ht_'));
		$this->fields_form[3]['form']['input']['bs']['name'] = $this->buildFormGroup($this->setInputs(6, 'ht_', 14));
		// e - header.top . s - header.center
		$this->fields_form[4]['form']['input']['border']['name'] = $this->buildFormGroup($this->setInputs(3, 'hc_', 15));
		$this->fields_form[4]['form']['input']['cin_border']['name'] = $this->buildFormGroup($this->setInputs(4, 'hc_', 16));
		$this->fields_form[4]['form']['input']['cin_border_radius']['name'] = $this->buildFormGroup($this->setInputs(5, 'hc_'));
		$this->fields_form[4]['form']['input']['bs']['name'] = $this->buildFormGroup($this->setInputs(6, 'hc_', 20));
		// e - header.center . s - header.bottom
		$this->fields_form[5]['form']['input']['border']['name'] = $this->buildFormGroup($this->setInputs(3, 'hb_', 21));
		$this->fields_form[5]['form']['input']['cin_border']['name'] = $this->buildFormGroup($this->setInputs(4, 'hb_', 22));
		$this->fields_form[5]['form']['input']['cin_border_radius']['name'] = $this->buildFormGroup($this->setInputs(5, 'hb_'));
		$this->fields_form[5]['form']['input']['bs']['name'] = $this->buildFormGroup($this->setInputs(6, 'hb_', 26));
		// e - header.bottom . s - header.mobile
		$this->fields_form[6]['form']['input']['border']['name'] = $this->buildFormGroup($this->setInputs(3, 'hm_', 27));
		$this->fields_form[6]['form']['input']['cin_border']['name'] = $this->buildFormGroup($this->setInputs(4, 'hm_', 28));
		$this->fields_form[6]['form']['input']['cin_border_radius']['name'] = $this->buildFormGroup($this->setInputs(5, 'hm_'));
		$this->fields_form[6]['form']['input']['bs']['name'] = $this->buildFormGroup($this->setInputs(6, 'hm_', 32));
		// e - header.mobile . s - sticky header
		$this->fields_form[7]['form']['input']['bs']['name'] = $this->buildFormGroup($this->setInputs(6, 'sticky_', 33));
		// e - sticky header . s - product.block
		$this->fields_form[8]['form']['input']['border']['name'] = $this->buildFormGroup($this->setInputs(3, 'pro_bck_', 34));
		$this->fields_form[8]['form']['input']['cin_border']['name'] = $this->buildFormGroup($this->setInputs(4, 'pro_bck_', 35));
		$this->fields_form[8]['form']['input']['cin_border_radius']['name'] = $this->buildFormGroup($this->setInputs(5, 'pro_bck_'));
		$this->fields_form[8]['form']['input']['bs']['name'] = $this->buildFormGroup($this->setInputs(6, 'pro_bck_', 39));
		// e - product.block . s - cross.selling
		$this->fields_form[9]['form']['input']['nr_col']['name'] = $this->buildFormGroup($this->setInputs(7, 'cs_'), 1, 12);
		// e - cross.selling - product.pages
		$this->fields_form[10]['form']['input']['pro_img_col']['name'] = $this->buildFormGroup($this->setInputs(8), 1, 11);
		$this->fields_form[10]['form']['input']['pro_primary_col']['name'] = $this->buildFormGroup($this->setInputs(9), 1, 11);
		$this->fields_form[10]['form']['input']['pro_secondary_col']['name'] = $this->buildFormGroup($this->setInputs(10), 1, 11);
		// e - product.pages . s - category.pages
		$this->fields_form[11]['form']['input']['subcate_per']['name'] = $this->buildFormGroup($this->setInputs(7, 'subcate_'), 1, 6);
		$this->fields_form[11]['form']['input']['products_per']['name'] = $this->buildFormGroup($this->setInputs(7, 'cate_'), 1, 6);
		// e - category.pages . s - footer
		$this->fields_form[12]['form']['input']['border']['name'] = $this->buildFormGroup($this->setInputs(3, 'f_', 40));
		$this->fields_form[12]['form']['input']['cin_border']['name'] = $this->buildFormGroup($this->setInputs(4, 'f_', 41));
		$this->fields_form[12]['form']['input']['cin_border_radius']['name'] = $this->buildFormGroup($this->setInputs(5, 'f_'));
		$this->fields_form[12]['form']['input']['bs']['name'] = $this->buildFormGroup($this->setInputs(6, 'f_', 45));
		// e - footer . s - footer.top
		$this->fields_form[13]['form']['input']['border']['name'] = $this->buildFormGroup($this->setInputs(3, 'ft_', 46));
		$this->fields_form[13]['form']['input']['cin_border']['name'] = $this->buildFormGroup($this->setInputs(4, 'ft_', 47));
		$this->fields_form[13]['form']['input']['cin_border_radius']['name'] = $this->buildFormGroup($this->setInputs(5, 'ft_'));
		$this->fields_form[13]['form']['input']['bs']['name'] = $this->buildFormGroup($this->setInputs(6, 'ft_', 51));
		// e - footer.top . s - footer.center
		$this->fields_form[14]['form']['input']['border']['name'] = $this->buildFormGroup($this->setInputs(3, 'fc_', 52));
		$this->fields_form[14]['form']['input']['cin_border']['name'] = $this->buildFormGroup($this->setInputs(4, 'fc_', 53));
		$this->fields_form[14]['form']['input']['cin_border_radius']['name'] = $this->buildFormGroup($this->setInputs(5, 'fc_'));
		$this->fields_form[14]['form']['input']['bs']['name'] = $this->buildFormGroup($this->setInputs(6, 'fc_', 57));
		// e - footer.center . s - footer.bottom
		$this->fields_form[15]['form']['input']['border']['name'] = $this->buildFormGroup($this->setInputs(3, 'fb_', 58));
		$this->fields_form[15]['form']['input']['cin_border']['name'] = $this->buildFormGroup($this->setInputs(4, 'fb_', 59));
		$this->fields_form[15]['form']['input']['cin_border_radius']['name'] = $this->buildFormGroup($this->setInputs(5, 'fb_'));
		$this->fields_form[15]['form']['input']['bs']['name'] = $this->buildFormGroup($this->setInputs(6, 'fb_', 63));
		// e - footer.bottom . s - footer.mobile
		$this->fields_form[16]['form']['input']['border']['name'] = $this->buildFormGroup($this->setInputs(3, 'fm_', 64));
		$this->fields_form[16]['form']['input']['cin_border']['name'] = $this->buildFormGroup($this->setInputs(4, 'fm_', 65));
		$this->fields_form[16]['form']['input']['cin_border_radius']['name'] = $this->buildFormGroup($this->setInputs(5, 'fm_'));
		$this->fields_form[16]['form']['input']['bs']['name'] = $this->buildFormGroup($this->setInputs(6, 'fm_', 69));
		// e - footer.mobile . s - upload.fonts
		if ($fonts = Configuration::get('MSM_FONTS_IMPORTED'))
			$this->fields_form[20]['form']['description'] = $this->getTranslator()->trans('List of fonts you have entered:', array(), 'Modules.Msthemeeditor.Admin').'<br>'.str_replace(',', ' , ', $fonts).'<br><a href="javascript:;" id="del_fonts_imported" class="btn btn-default"><i class="icon-trash"></i> '.$this->getTranslator()->trans('delete fonts imported', array(), 'Modules.Msthemeeditor.Admin').'</a>';
		// e - upload.fonts . s - header.tag.size
		$this->fields_form[24]['form']['input']['header_tag']['name'] = $this->buildFormGroup($this->setInputs(11));
		// e - header.tag.size
		$this->initImagesTypes();
		$font_list = array(8 => 'pro_bck_font', 10 => 'pro_font', 21 => 'body_font', 22 => 'hdg_font', 23 => 'price_font');
		CF::initFonts($font_list, $this->fields_form);
		return $this->fields_form;
	}

	private function buildFormGroup($group, $start = false, $end = false)
	{
		if (!is_array($group) || !count($group))
			return false;
		$html = '<div class="row">';
		foreach ($group as $k => $v) {
			$html .= (isset($v['break']) ? '</div><div class="new row">' : '');
			if (isset($v['isSelect']) && $v['isSelect']) {
				$html .= '<div class="col-xs-4 col-sm-2"><label'.(isset($v['tooltip']) ? ' data-html="true" data-toggle="tooltip" class="label-tooltip" data-original-title="'.$v['tooltip'].'"' : '').'>'.$v['label'].'</label>'.
				'<select name="'.$v['name'].'" id="'.$v['name'].'" class="'.(isset($v['class']) ? $v['class'] : 'fixed-width-md').'"'.(isset($v['onchange']) ? ' onchange="'.$v['onchange'].'"' : '').'>';
				if (!$start && !$end) {
					$n = $v['options'];
					for ($i = 0; $i < count($n); $i++) {
						if (isset($n[$i]['name']) && $n[$i]['name'])
							$n[$i] = $n[$i]['name'];
						$html .= '<option value="'.$i.'"'.(Configuration::get('MSM_'.strtoupper($v['name'])) == $i ? ' selected="selected"' : '').'>'.$n[$i].'</option>';
					}
				} else
					for ($i = $start; $i <= $end; $i++)
						$html .= '<option value="'.$i.'"'.(Configuration::get('MSM_'.strtoupper($v['name'])) == $i ? ' selected="selected"' : '').'>'.$i.'</option>';
				$html .= '</select></div>';
			} elseif (isset($v['isColor']) && $v['isColor']) {
				$html .= '<div class="col-xs-4 col-sm-2"><label'.(isset($v['tooltip']) ? ' data-html="true" data-toggle="tooltip" class="label-tooltip" data-original-title="'.$v['tooltip'].'"' : '').'>'.$v['label'].'</label>'.
				'<div class="input-group"><input type="'.$v['type'].'" name="'.$v['name'].'" value="'.Configuration::get('MSM_'.strtoupper($v['name'])).'" id="'.$v['idColor'].'" class="color mColorPickerInput mColorPicker'.(isset($v['class']) ? $v['class'] : '').'" data-hex="true" style="background-color: rgb(0, 0, 0); color: white;" />'.
				'<span style="cursor: pointer;" id="icp_'.$v['idColor'].'" class="mColorPickerTrigger input-group-addon" data-mcolorpicker="true"><img src="'._PS_ADMIN_IMG_.'color.png" style="border: 0;margin:0 0 0 3px" align="absmiddle"></span></div></div>';
			} elseif (isset($v['isSwitch']) && $v['isSwitch']) {
				$html .= '<div class="col-xs-4 col-sm-2"><label'.(isset($v['tooltip']) ? ' data-html="true" data-toggle="tooltip" class="label-tooltip" data-original-title="'.$v['tooltip'].'"' : '').'>'.$v['label'].'</label>'.
				'<div class="input-group"><span class="switch prestashop-switch fixed-width-lg">'.
				'<input type="radio" name="'.$v['name'].'" id="'.$v['name'].'_on" value="1"'.(Configuration::get('MSM_'.strtoupper($v['name'])) ? ' checked="checked"' : '').' /><label for="'.$v['name'].'_on">'.$this->getTranslator()->trans('Yes', array(), 'Admin.Global').'</label>'.
				'<input type="radio" name="'.$v['name'].'" id="'.$v['name'].'_off" value="0"'.(!Configuration::get('MSM_'.strtoupper($v['name'])) ? ' checked="checked"' : '').' /><label for="'.$v['name'].'_off">'.$this->getTranslator()->trans('No', array(), 'Admin.Global').'</label>'.
				'<a class="slide-button btn"></a>'.
				'</span></div></div>';
			} else {
				$html .= '<div class="col-xs-4 col-sm-2"><label'.(isset($v['tooltip']) ? ' data-html="true" data-toggle="tooltip" class="label-tooltip" data-original-title="'.$v['tooltip'].'"' : '').'>'.$v['label'].'</label>'.
				(isset($v['prefix']) ? '<div class="input-group"><span class="input-group-addon">'.$v['prefix'].'</span>' : '').
				'<input type="'.$v['type'].'" name="'.$v['name'].'" value="'.Configuration::get('MSM_'.strtoupper($v['name'])).'"'.(isset($v['placeholder']) ? ' placeholder="'.$v['placeholder'].'"' : '').' class="'.(isset($v['class']) ? $v['class'] : 'fixed-width-md').'" />'.(isset($v['prefix']) ? '</div>' : '').'</div>';
			}
		}

		return $html.'</div>';
	}

	public function setInputs($k = null, $prefix = '', $ic = '')
	{
		$bStyle = self::$bStyle;
		$grid = self::$grid_width;
		$this->id_input[] = $k.':'.$prefix;
		$inputs = array(
			1 => array(
				array(
					'name' => $prefix.'column_size_xs',
					'label' => $this->getTranslator()->trans('Width < 576 (Extra small)', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('Screen width Smaller than 576px', array(), 'Modules.Msthemeeditor.Admin'),
					'isSelect' => true,
					'options' => $grid,
				),
				array(
					'name' => $prefix.'column_size_sm',
					'label' => $this->getTranslator()->trans('Width ≥ 576 (Small)', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('Screen width larger equal than 576px', array(), 'Modules.Msthemeeditor.Admin'),
					'isSelect' => true,
					'options' => $grid,
				),
				array(
					'name' => $prefix.'column_size_md',
					'label' => $this->getTranslator()->trans('Width ≥ 768 (Medium)', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('Screen width larger equal than 768px', array(), 'Modules.Msthemeeditor.Admin'),
					'isSelect' => true,
					'options' => $grid,
				),
				array(
					'name' => $prefix.'column_size_lg',
					'label' => $this->getTranslator()->trans('Width ≥ 992 (Extra medium)', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('Screen width larger equal than 992px', array(), 'Modules.Msthemeeditor.Admin'),
					'isSelect' => true,
					'options' => $grid,
					'break' => true,
				),
				array(
					'name' => $prefix.'column_size_xl',
					'label' => $this->getTranslator()->trans('Width ≥ 1200 (Large)', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('Screen width larger equal than 1200px', array(), 'Modules.Msthemeeditor.Admin'),
					'isSelect' => true,
					'options' => $grid,
				),
				array(
					'name' => $prefix.'column_size_xxl',
					'label' => $this->getTranslator()->trans('Width ≥ 1440 (Extra large)', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('Screen width larger equal than 1440px', array(), 'Modules.Msthemeeditor.Admin'),
					'isSelect' => true,
					'options' => $grid,
				),
			),
			2 => array(
				array(
					'name' => $prefix.'filter_mode',
					'label' => $this->getTranslator()->trans('mode', array(), 'Modules.Msthemeeditor.Admin'),
					'isSelect' => true,
					'options' => self::$filter,
				),
				array(
					'type' => 'text',
					'name' => $prefix.'filter_blur',
					'label' => $this->getTranslator()->trans('blur value', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('Enter a numeric value', array(), 'Modules.Msthemeeditor.Admin'),
					'placeholder' => $this->getTranslator()->trans('e.g. 4', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'filter_val fixed-width-md',
					'prefix' => 'px',
					'break' => true,
				),
				array(
					'type' => 'text',
					'name' => $prefix.'filter_hue_r',
					'label' => $this->getTranslator()->trans('hue rotate value', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('Enter a numeric value', array(), 'Modules.Msthemeeditor.Admin'),
					'placeholder' => $this->getTranslator()->trans('e.g. 140', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'filter_val fixed-width-md',
					'prefix' => 'deg',
					'break' => true,
				),
				array(
					'type' => 'text',
					'name' => $prefix.'filter_brightness',
					'label' => $this->getTranslator()->trans('brightness value', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('Accepts a number or percentage as its argument.', array(), 'Modules.Msthemeeditor.Admin'),
					'placeholder' => $this->getTranslator()->trans('e.g. 5 or 25%', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'filter_val fixed-width-md',
					'break' => true,
				),
				array(
					'type' => 'text',
					'name' => $prefix.'filter_contrast',
					'label' => $this->getTranslator()->trans('contrast value', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('Accepts a number or percentage as its argument.', array(), 'Modules.Msthemeeditor.Admin'),
					'placeholder' => $this->getTranslator()->trans('e.g. 5 or 25%', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'filter_val fixed-width-md',
					'break' => true,
				),
				array(
					'type' => 'text',
					'name' => $prefix.'filter_grayscale',
					'label' => $this->getTranslator()->trans('grayscale value', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('Accepts a number(From 0.0 to 1.0) or percentage as its argument.', array(), 'Modules.Msthemeeditor.Admin'),
					'placeholder' => $this->getTranslator()->trans('e.g. 0.7 or 25%', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'filter_val fixed-width-md',
					'break' => true,
				),
				array(
					'type' => 'text',
					'name' => $prefix.'filter_invert',
					'label' => $this->getTranslator()->trans('invert value', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('Accepts a number(From 0.0 to 1.0) or percentage as its argument.', array(), 'Modules.Msthemeeditor.Admin'),
					'placeholder' => $this->getTranslator()->trans('e.g. 0.7 or 25%', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'filter_val fixed-width-md',
					'break' => true,
				),
				array(
					'type' => 'text',
					'name' => $prefix.'filter_opacity',
					'label' => $this->getTranslator()->trans('opacity value', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('Accepts a number(From 0.0 (fully transparent) to 1.0 (fully opaque)) or percentage as its argument.', array(), 'Modules.Msthemeeditor.Admin'),
					'placeholder' => $this->getTranslator()->trans('e.g. 0.7 or 25%', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'filter_val fixed-width-md',
					'break' => true,
				),
				array(
					'type' => 'text',
					'name' => $prefix.'filter_saturate',
					'label' => $this->getTranslator()->trans('saturate value', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('Accepts a number or percentage as its argument.', array(), 'Modules.Msthemeeditor.Admin'),
					'placeholder' => $this->getTranslator()->trans('e.g. 50 or 25%', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'filter_val fixed-width-md',
					'break' => true,
				),
				array(
					'type' => 'text',
					'name' => $prefix.'filter_sepia',
					'label' => $this->getTranslator()->trans('sepia value', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('Accepts a number or percentage as its argument.', array(), 'Modules.Msthemeeditor.Admin'),
					'placeholder' => $this->getTranslator()->trans('e.g. 50 or 25%', array(), 'Modules.Msthemeeditor.Admin'),
					'class' => 'filter_val fixed-width-md',
					'break' => true,
				),
				array(
					'type' => 'text',
					'name' => $prefix.'filter_ds_h_offset',
					'label' => $this->getTranslator()->trans('h-offset', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('If a negative value is provided, the offset will result in the drop shadow being drawn to the left of the box.', array(), 'Modules.Msthemeeditor.Admin'),
					'prefix' => 'px',
					'class' => 'filter_val fixed-width-md',
					'break' => true,
				),
				array(
					'type' => 'text',
					'name' => $prefix.'filter_ds_v_offset',
					'label' => $this->getTranslator()->trans('v-offset', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('If a negative value is provided, the offset will result in the drop shadow being drawn above the box.', array(), 'Modules.Msthemeeditor.Admin'),
					'prefix' => 'px',
				),
				array(
					'type' => 'text',
					'name' => $prefix.'filter_ds_blur',
					'label' => $this->getTranslator()->trans('blur', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('If the value is zero (i.e. 0), the edge of the shadow will be sharp.', array(), 'Modules.Msthemeeditor.Admin'),
					'prefix' => 'px',
				),
				array(
					'type' => 'text',
					'name' => $prefix.'filter_ds_color',
					'label' => $this->getTranslator()->trans('color', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'prefix' => 'px',
					'idColor' => 'c_'.$ic,
					'isColor' => true
				),
			),
			3 => array(
				array(
					'type' => 'text',
					'name' => $prefix.'border_width',
					'label' => $this->getTranslator()->trans('Border width', array(), 'Modules.Msthemeeditor.Admin'),
					'prefix' => 'px',
				),
				array(
					'type' => 'text',
					'name' => $prefix.'border_color',
					'label' => $this->getTranslator()->trans('Border color', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'idColor' => 'c_'.$ic,
					'isColor' => true,
				),
				array(
					'name' => $prefix.'border_style',
					'label' => $this->getTranslator()->trans('Border style', array(), 'Modules.Msthemeeditor.Admin'),
					'isSelect' => true,
					'options' => $bStyle,
				),
			),
			4 => array(
				array(
					'type' => 'text',
					'name' => $prefix.'border_top_width',
					'label' => $this->getTranslator()->trans('Border top width', array(), 'Modules.Msthemeeditor.Admin'),
					'prefix' => 'px',
				),
				array(
					'type' => 'text',
					'name' => $prefix.'border_right_width',
					'label' => $this->getTranslator()->trans('Border right width', array(), 'Modules.Msthemeeditor.Admin'),
					'prefix' => 'px',
				),
				array(
					'type' => 'text',
					'name' => $prefix.'border_bottom_width',
					'label' => $this->getTranslator()->trans('Border bottom width', array(), 'Modules.Msthemeeditor.Admin'),
					'prefix' => 'px',
				),
				array(
					'type' => 'text',
					'name' => $prefix.'border_left_width',
					'label' => $this->getTranslator()->trans('Border left width', array(), 'Modules.Msthemeeditor.Admin'),
					'prefix' => 'px',
				),
				array(
					'type' => 'text',
					'name' => $prefix.'border_top_color',
					'label' => $this->getTranslator()->trans('Border top color', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'idColor' => 'c_'.$b = $ic,
					'break' => true,
					'isColor' => true,
				),
				array(
					'type' => 'text',
					'name' => $prefix.'border_right_color',
					'label' => $this->getTranslator()->trans('Border right color', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'idColor' => 'c_'.++$b,
					'isColor' => true
				),
				array(
					'type' => 'text',
					'name' => $prefix.'border_bottom_color',
					'label' => $this->getTranslator()->trans('Border bottom color', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'idColor' => 'c_'.++$b,
					'isColor' => true
				),
				array(
					'type' => 'text',
					'name' => $prefix.'border_left_color',
					'label' => $this->getTranslator()->trans('Border left color', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'idColor' => 'c_'.++$b,
					'isColor' => true
				),
				array(
					'name' => $prefix.'border_top_style',
					'label' => $this->getTranslator()->trans('Border top style', array(), 'Modules.Msthemeeditor.Admin'),
					'isSelect' => true,
					'break' => true,
					'options' => $bStyle,
				),
				array(
					'name' => $prefix.'border_right_style',
					'label' => $this->getTranslator()->trans('Border right style', array(), 'Modules.Msthemeeditor.Admin'),
					'isSelect' => true,
					'options' => $bStyle,
				),
				array(
					'name' => $prefix.'border_bottom_style',
					'label' => $this->getTranslator()->trans('Border bottom style', array(), 'Modules.Msthemeeditor.Admin'),
					'isSelect' => true,
					'options' => $bStyle,
				),
				array(
					'name' => $prefix.'border_left_style',
					'label' => $this->getTranslator()->trans('Border left style', array(), 'Modules.Msthemeeditor.Admin'),
					'isSelect' => true,
					'options' => $bStyle,
				),
			),
			5 => array(
				array(
					'type' => 'text',
					'name' => $prefix.'border_top_left_radius',
					'label' => $this->getTranslator()->trans('Border top left radius', array(), 'Modules.Msthemeeditor.Admin'),
					'prefix' => 'px',
				),
				array(
					'type' => 'text',
					'name' => $prefix.'border_top_right_radius',
					'label' => $this->getTranslator()->trans('Border top right radius', array(), 'Modules.Msthemeeditor.Admin'),
					'prefix' => 'px',
				),
				array(
					'type' => 'text',
					'name' => $prefix.'border_bottom_right_radius',
					'label' => $this->getTranslator()->trans('Border bottom right radius', array(), 'Modules.Msthemeeditor.Admin'),
					'prefix' => 'px',
				),
				array(
					'type' => 'text',
					'name' => $prefix.'border_bottom_left_radius',
					'label' => $this->getTranslator()->trans('Border bottom left radius', array(), 'Modules.Msthemeeditor.Admin'),
					'prefix' => 'px',
				),
			),
			6 => array(
				array(
					'type' => 'switch',
					'name' => $prefix.'bs_inset',
					'label' => $this->getTranslator()->trans('inset', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('', array(), 'Modules.Msthemeeditor.Admin'),
					'isSwitch' => true,
				),
				array(
					'type' => 'text',
					'name' => $prefix.'bs_h_offset',
					'label' => $this->getTranslator()->trans('h-offset', array(), 'Modules.Msthemeeditor.Admin'),
					'prefix' => 'px',
				),
				array(
					'type' => 'text',
					'name' => $prefix.'bs_v_offset',
					'label' => $this->getTranslator()->trans('v-offset', array(), 'Modules.Msthemeeditor.Admin'),
					'prefix' => 'px',
				),
				array(
					'type' => 'text',
					'name' => $prefix.'bs_blur',
					'label' => $this->getTranslator()->trans('blur', array(), 'Modules.Msthemeeditor.Admin'),
					'prefix' => 'px',
					'break' => true,
				),
				array(
					'type' => 'text',
					'name' => $prefix.'bs_spread',
					'label' => $this->getTranslator()->trans('spread', array(), 'Modules.Msthemeeditor.Admin'),
					'prefix' => 'px',
				),
				array(
					'type' => 'text',
					'name' => $prefix.'bs_color',
					'label' => $this->getTranslator()->trans('color', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('For example, steelblue, #FF4500 or rgba(35,124,255,0.3) are all valid colors.', array(), 'Modules.Msthemeeditor.Admin'),
					'idColor' => 'c_'.$ic,
					'isColor' => true
				),
			),
			7 => array(
				array(
					'name' => $prefix.'per_fs',
					'label' => $this->getTranslator()->trans('Full screen', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('Desktops (Full screen)', array(), 'Modules.Msthemeeditor.Admin'),
					'isSelect' => true,
				),
				array(
					'name' => $prefix.'per_md',
					'label' => $this->getTranslator()->trans('Width >= 768', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('Screen width larger equal than 768px', array(), 'Modules.Msthemeeditor.Admin'),
					'isSelect' => true,
				),
				array(
					'name' => $prefix.'per_lg',
					'label' => $this->getTranslator()->trans('Width >= 992', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('Screen width larger equal than 992px', array(), 'Modules.Msthemeeditor.Admin'),
					'isSelect' => true,
				),
				array(
					'name' => $prefix.'per_xl',
					'label' => $this->getTranslator()->trans('Width >= 1200', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('Screen width larger equal than 1200px', array(), 'Modules.Msthemeeditor.Admin'),
					'isSelect' => true,
				),
				array(
					'name' => $prefix.'per_xxl',
					'label' => $this->getTranslator()->trans('Width >= 1440', array(), 'Modules.Msthemeeditor.Admin'),
					'tooltip' => $this->getTranslator()->trans('Screen width larger equal than 1440px', array(), 'Modules.Msthemeeditor.Admin'),
					'isSelect' => true,
				),
			),
			8 => array(
				array(
					'name' => $prefix.'pro_img_col',
					'label' => $this->getTranslator()->trans('', array(), 'Modules.Msthemeeditor.Admin'),
					'isSelect' => true,
				),
			),
			9 => array(
				array(
					'name' => $prefix.'pro_primary_col',
					'label' => $this->getTranslator()->trans('', array(), 'Modules.Msthemeeditor.Admin'),
					'isSelect' => true,
				),
			),
			10 => array(
				array(
					'name' => $prefix.'pro_secondary_col',
					'label' => $this->getTranslator()->trans('', array(), 'Modules.Msthemeeditor.Admin'),
					'isSelect' => true,
				),
			),
			11 => array(
				array(
					'type' => 'text',
					'name' => $prefix.'header_tag_1',
					'label' => $this->getTranslator()->trans('H1 size', array(), 'Modules.Msthemeeditor.Admin'),
					'prefix' => 'px',
				),
				array(
					'type' => 'text',
					'name' => $prefix.'header_tag_2',
					'label' => $this->getTranslator()->trans('H2 size', array(), 'Modules.Msthemeeditor.Admin'),
					'prefix' => 'px',
				),
				array(
					'type' => 'text',
					'name' => $prefix.'header_tag_3',
					'label' => $this->getTranslator()->trans('H3 size', array(), 'Modules.Msthemeeditor.Admin'),
					'prefix' => 'px',
				),
				array(
					'type' => 'text',
					'name' => $prefix.'header_tag_4',
					'label' => $this->getTranslator()->trans('H4 size', array(), 'Modules.Msthemeeditor.Admin'),
					'break' => true,
					'prefix' => 'px',
				),
				array(
					'type' => 'text',
					'name' => $prefix.'header_tag_5',
					'label' => $this->getTranslator()->trans('H5 size', array(), 'Modules.Msthemeeditor.Admin'),
					'prefix' => 'px',
				),
				array(
					'type' => 'text',
					'name' => $prefix.'header_tag_6',
					'label' => $this->getTranslator()->trans('H6 size', array(), 'Modules.Msthemeeditor.Admin'),
					'prefix' => 'px',
				),
			),
		);

		return ($k !== null && isset($inputs[$k])) ? $inputs[$k] : $inputs;
	}

	public function initImagesTypes()
	{
		$imageTypes = array(
			array('id' => '', 'name' => $this->getTranslator()->trans('--', array(), 'Modules.Msthemeeditor.Admin')),
		);
		$imagesTypes = ImageType::getImagesTypes('products');
		foreach ($imagesTypes as $imageType) {
			if (substr($imageType['name'], -3) == '_2x')
				continue;
			$imageTypes[] = array('id' => $imageType['name'], 'name' => $imageType['name'].'('.$imageType['width'].' x '.$imageType['height'].')');
		}
		$this->fields_form[10]['form']['input']['thumb_img_type']['options']['query'] = $imageTypes;
		$this->fields_form[10]['form']['input']['gallery_img_type']['options']['query'] = $imageTypes;
	}

	public function initFonts()
	{
		$font_list = array(8 => 'pro_bck_font', 10 => 'pro_font', 21 => 'body_font', 22 => 'hdg_font', 23 => 'price_font');
		foreach ($font_list as $k => $v) {
			if ($font_string = Configuration::get('MSM_'.strtoupper($v))) {
				$font = explode(':', $font_string);
				$font = $font[0];
				$font_key = str_replace(' ', '_', $font);
			} else {
				$font = $font_key = 'inherit';
			}
			if (array_key_exists($font_key, self::$fonts['google'])) {
				$font_arr = array(
					$font.':700' => '700',
					$font.':italic' => 'italic',
					$font.':700italic' => '700italic',
				);
				foreach (self::$fonts['google'][$font_key]['variants'] as $g)
					$font_arr[$font.':'.$g] = $g;
				foreach ($font_arr as $val)
					$this->fields_form[$k]['form']['input'][$v]['options']['query'][] = array(
						'id' => $font.':'.($val == 'regular' ? '400' : $val),
						'name' => $val,
					);
			} else {
				$this->fields_form[$k]['form']['input'][$v]['options']['query'] = array(
					array('id' => $font, 'name' => 'Normal'),
					array('id' => $font.':700', 'name' => 'Bold'),
					array('id' => $font.':italic', 'name' => 'Italic'),
					array('id' => $font.':700italic', 'name' => 'Bold & Italic'),
					array('id' => $font.':100', 'name' => '100'),
					array('id' => $font.':100italic', 'name' => '100 & Italic'),
					array('id' => $font.':300', 'name' => '300'),
					array('id' => $font.':300italic', 'name' => '300 & Italic'),
					array('id' => $font.':500', 'name' => '500'),
					array('id' => $font.':500italic', 'name' => '500 & Italic'),
					array('id' => $font.':600', 'name' => '600'),
					array('id' => $font.':600italic', 'name' => '600 & Italic'),
					array('id' => $font.':800', 'name' => '800'),
					array('id' => $font.':800italic', 'name' => '800 & Italic'),
					array('id' => $font.':900', 'name' => '900'),
					array('id' => $font.':900italic', 'name' => '900 & Italic'),
				);
			}
		}
	}

	public function imgDesc()
	{}

	public function calcImgWidth($option = array())
	{}
	// s patterns
	public function getPatterns($amount = 40, $type = '')
	{
		$html = '';
		foreach (range(1, $amount) as $v)
			$html .= '<div class="pattern_wrap'.($type == 'hdg_bg' ? ' repeat_x' : '').'" style="background-image:url('.$this->p.'views/img/patterns'.($type ? '/'.$type : '').'/'.$v.'.png);"><span>'.$v.'</span></div>';
		return $html;
	}

	public function getPatternsArray($amount = 40)
	{
		$a = array();
		for ($i = 1; $i <= $amount; $i++)
			$a[] = array('id' => $i, 'name' => $i);
		return $a;
	}

	private function getImgHtml($src, $id)
	{
		$html = '';
		if ($src && $id)
			$html .= '<div class="img_preview_wrap"><img src="'.$src.'" class="img_preview"></div><a data-field="'.$id.'" href="javascript:;" class="btn btn-default del_img"><i class="icon-trash"></i> '.$this->getTranslator()->trans('Delete', array(), 'Modules.Msthemeeditor.Admin').'</a>';
		return $html;
	}
}
