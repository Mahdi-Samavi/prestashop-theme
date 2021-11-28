<?php

if (!defined('_PS_VERSION_'))
	exit;

class msThemeEditor extends Module
{
	public static $payment_icon = 'views/img/payment-options.png';
	public static $bStyle = array('none', 'solid', 'dashed', 'dotted', 'double', 'groove');
	public static $filter = array('none', 'blur', 'hue rotate', 'brightness', 'contrast', 'grayscale', 'invert', 'opacity', 'saturate', 'sepia', 'drop shadow');
	public static $fonts = array();
	public $imgtype = array('jpg', 'gif', 'jpeg', 'png', 'svg', 'ico');
	public $permission = 0775;
	public $templatePath;
	public $tabs;
	public $defaults;
	public $_hooks;
	public $validation_errors = array();
	private $_html;
	public static $grid_width = array(
		array('id' => 0, 'name' => '0/12'),
		array('id' => 1, 'name' => '1/12'),
		array('id' => 2, 'name' => '2/12'),
		array('id' => 3, 'name' => '3/12'),
		array('id' => 4, 'name' => '4/12'),
		array('id' => 5, 'name' => '5/12'),
		array('id' => 6, 'name' => '6/12'),
		array('id' => 7, 'name' => '7/12'),
		array('id' => 8, 'name' => '8/12'),
		array('id' => 9, 'name' => '9/12'),
		array('id' => 10, 'name' => '10/12'),
		array('id' => 11, 'name' => '11/12'),
		array('id' => 12, 'name' => '12/12'),
	);
    public static $textTransform = array(
		array('id' => 0, 'name' => 'none'),
		array('id' => 1, 'name' => 'uppercase'),
		array('id' => 2, 'name' => 'lowercase'),
		array('id' => 3, 'name' => 'capitalize'),
    );

	public function __construct()
	{
		$this->name = 'msthemeeditor';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->author = 'Mahdi Samavi';
		$this->need_instance = 0;
		$this->bootstrap = true;

		parent::__construct();

		$this->displayName = $this->getTranslator()->trans('Theme editor', array(), 'Modules.Msthemeeditor.Admin');
		$this->description = $this->getTranslator()->trans('', array(), 'Modules.Msthemeeditor.Admin');
		$this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
		self::$fonts = include(dirname(__FILE__).'/classes/fonts.php');
		$this->templatePath = 'module:'.$this->name.'/views/templates/hook/';

		$this->tabs = array(
			array('id' => '0', 'name' => $this->getTranslator()->trans('Dashboard', array(), 'Modules.Msthemeeditor.Admin')),
			array('id' => '1', 'name' => $this->getTranslator()->trans('General', array(), 'Modules.Msthemeeditor.Admin')),
			array('id' => '2,3,4,5,6', 'name' => $this->getTranslator()->trans('Header & Mobile Header', array(), 'Modules.Msthemeeditor.Admin')),
			array('id' => '7', 'name' => $this->getTranslator()->trans('Sticky header', array(), 'Modules.Msthemeeditor.Admin')),
			array('id' => '8', 'name' => $this->getTranslator()->trans('Product block', array(), 'Modules.Msthemeeditor.Admin')),
			array('id' => '9', 'name' => $this->getTranslator()->trans('Product sliders', array(), 'Modules.Msthemeeditor.Admin')),
			array('id' => '10', 'name' => $this->getTranslator()->trans('Product pages', array(), 'Modules.Msthemeeditor.Admin')),
			array('id' => '11', 'name' => $this->getTranslator()->trans('Category pages', array(), 'Modules.Msthemeeditor.Admin')),
			array('id' => '12,13,14,15,16', 'name' => $this->getTranslator()->trans('Footer & Mobile Footer', array(), 'Modules.Msthemeeditor.Admin')),
			array('id' => '17', 'name' => $this->getTranslator()->trans('Patterns', array(), 'Modules.Msthemeeditor.Admin')),
			array('id' => '18,19', 'name' => $this->getTranslator()->trans('Colors', array(), 'Modules.Msthemeeditor.Admin')),
			array('id' => '20,21,22,23,24', 'name' => $this->getTranslator()->trans('Font', array(), 'Modules.Msthemeeditor.Admin')),
			array('id' => '25', 'name' => $this->getTranslator()->trans('Swiper slider (Module)', array(), 'Modules.Msthemeeditor.Admin')),
			array('id' => '26', 'name' => $this->getTranslator()->trans('Custom codes', array(), 'Modules.Msthemeeditor.Admin')),
		);

		$this->defaults = array(
			'responsive' => array('val' => 1),
			'responsive_max' => array('val' => 3),
			'CC_res_max' => array('val' => ''),
			'box_style' => array('val' => 1),
			'left_column_size_xs' => array('val' => 0, 'smarty_val' => 1),
			'left_column_size_sm' => array('val' => 0, 'smarty_val' => 1),
			'left_column_size_md' => array('val' => 0, 'smarty_val' => 1),
			'left_column_size_lg' => array('val' => 0, 'smarty_val' => 1),
			'left_column_size_xl' => array('val' => 0, 'smarty_val' => 1),
			'left_column_size_xxl' => array('val' => 0, 'smarty_val' => 1),
			'right_column_size_xs' => array('val' => 0, 'smarty_val' => 1),
			'right_column_size_sm' => array('val' => 0, 'smarty_val' => 1),
			'right_column_size_md' => array('val' => 0, 'smarty_val' => 1),
			'right_column_size_lg' => array('val' => 0, 'smarty_val' => 1),
			'right_column_size_xl' => array('val' => 0, 'smarty_val' => 1),
			'right_column_size_xxl' => array('val' => 0, 'smarty_val' => 1),
			'top_spacing' => array('val' => ''),
			'bottom_spacing' => array('val' => ''),
			'block_spacing' => array('val' => ''),
			'welcome' => array('val' => [1 => 'Welcome']),
			'welcome_logged' => array('val' => [1 => 'Welcome']),
			'copyright_text' => array('val' => [1 => '&COPY; '.date('Y').' Powered by PrestaShop&trade;. All Rights Reserved'], 'esc' => 1),
			'payment_icon' => array('val' => self::$payment_icon),
			'navigation_pipe' => array('val' => '>', 'esc' => 1, 'smarty_val' => 1),
			'drop_down' => array('val' => 1, 'smarty_val' => 1),
			'download_font' => array('val' => 0),
			// header
			'fullwidth_h' => array('val' => 1, 'smarty_val' => 1),
			'h_left_alignment' => array('val' => 0),
			'h_center_alignment' => array('val' => 1),
			'h_right_alignment' => array('val' => 2),
			'mobile_logo' => array('val' => ''),
			'mobile_logo_width' => array('val' => 0),
			'mobile_logo_height' => array('val' => 0),
			'mobile_filter_mode' => array('val' => 0),
			'mobile_filter_blur' => array('val' => ''),
			'mobile_filter_hue_r' => array('val' => ''),
			'mobile_filter_brightness' => array('val' => ''),
			'mobile_filter_contrast' => array('val' => ''),
			'mobile_filter_grayscale' => array('val' => ''),
			'mobile_filter_invert' => array('val' => ''),
			'mobile_filter_opacity' => array('val' => ''),
			'mobile_filter_saturate' => array('val' => ''),
			'mobile_filter_sepia' => array('val' => ''),
			'mobile_filter_ds_h_offset' => array('val' => ''),
			'mobile_filter_ds_v_offset' => array('val' => ''),
			'mobile_filter_ds_blur' => array('val' => ''),
			'mobile_filter_ds_color' => array('val' => ''),
			'retina_logo' => array('val' => ''),
			'retina_filter_mode' => array('val' => 0),
			'retina_filter_blur' => array('val' => ''),
			'retina_filter_hue_r' => array('val' => ''),
			'retina_filter_brightness' => array('val' => ''),
			'retina_filter_contrast' => array('val' => ''),
			'retina_filter_grayscale' => array('val' => ''),
			'retina_filter_invert' => array('val' => ''),
			'retina_filter_opacity' => array('val' => ''),
			'retina_filter_saturate' => array('val' => ''),
			'retina_filter_sepia' => array('val' => ''),
			'retina_filter_ds_h_offset' => array('val' => ''),
			'retina_filter_ds_v_offset' => array('val' => ''),
			'retina_filter_ds_blur' => array('val' => ''),
			'retina_filter_ds_color' => array('val' => ''),
			'h_bg_color' => array('val' => ''),
			'cin_h_bg' => array('val' => ''),
			'h_bg_img' => array('val' => ''),
			'h_color' => array('val' => ''),
			'h_hover_color' => array('val' => ''),
			'h_link_color' => array('val' => ''),
			'h_link_bg_color' => array('val' => ''),
			'h_link_hover_color' => array('val' => ''),
			'h_link_hover_bg_color' => array('val' => ''),
			'h_bg_img' => array('val' => ''),
			'h_bg_pattern' => array('val' => ''),
			'h_border_width' => array('val' => ''),
			'h_border_color' => array('val' => ''),
			'h_border_style' => array('val' => 1),
			'cin_h_border' => array('val' => ''),
			'h_border_top_width' => array('val' => ''),
			'h_border_right_width' => array('val' => ''),
			'h_border_bottom_width' => array('val' => ''),
			'h_border_left_width' => array('val' => ''),
			'h_border_top_color' => array('val' => ''),
			'h_border_right_color' => array('val' => ''),
			'h_border_bottom_color' => array('val' => ''),
			'h_border_left_color' => array('val' => ''),
			'h_border_top_style' => array('val' => ''),
			'h_border_right_style' => array('val' => ''),
			'h_border_bottom_style' => array('val' => ''),
			'h_border_left_style' => array('val' => ''),
			'h_border_radius' => array('val' => ''),
			'cin_h_border_radius' => array('val' => ''),
			'h_border_top_left_radius' => array('val' => ''),
			'h_border_top_right_radius' => array('val' => ''),
			'h_border_bottom_right_radius' => array('val' => ''),
			'h_border_bottom_left_radius' => array('val' => ''),
			'h_bs_inset' => array('val' => 0),
			'h_bs_h_offset' => array('val' => ''),
			'h_bs_v_offset' => array('val' => ''),
			'h_bs_blur' => array('val' => ''),
			'h_bs_spread' => array('val' => ''),
			'h_bs_color' => array('val' => ''),
			// header top
			'iie_ht_bg_color' => array('val' => 1),
			'ht_bg_color' => array('val' => ''),
			'iie_cin_ht_background' => array('val' => 1),
			'ht_bg_img' => array('val' => ''),
			'iie_ht_color' => array('val' => 1),
			'ht_color' => array('val' => ''),
			'iie_ht_hover_color' => array('val' => 1),
			'ht_hover_color' => array('val' => ''),
			'iie_ht_link_color' => array('val' => 1),
			'ht_link_color' => array('val' => ''),
			'iie_ht_link_bg_color' => array('val' => 1),
			'ht_link_bg_color' => array('val' => ''),
			'iie_ht_link_hover_color' => array('val' => 1),
			'ht_link_hover_color' => array('val' => ''),
			'iie_ht_link_hover_bg_color' => array('val' => 1),
			'ht_link_hover_bg_color' => array('val' => ''),
			'iie_ht_border' => array('val' => 1),
			'ht_border_width' => array('val' => ''),
			'ht_border_color' => array('val' => ''),
			'ht_border_style' => array('val' => ''),
			'iie_cin_ht_border' => array('val' => 1),
			'ht_border_top_width' => array('val' => ''),
			'ht_border_right_width' => array('val' => ''),
			'ht_border_bottom_width' => array('val' => ''),
			'ht_border_left_width' => array('val' => ''),
			'ht_border_top_color' => array('val' => ''),
			'ht_border_right_color' => array('val' => ''),
			'ht_border_bottom_color' => array('val' => ''),
			'ht_border_left_color' => array('val' => ''),
			'ht_border_top_style' => array('val' => ''),
			'ht_border_right_style' => array('val' => ''),
			'ht_border_bottom_style' => array('val' => ''),
			'ht_border_left_style' => array('val' => ''),
			'iie_ht_border_radius' => array('val' => 1),
			'ht_border_radius' => array('val' => ''),
			'iie_cin_ht_border_radius' => array('val' => 1),
			'ht_border_top_left_radius' => array('val' => ''),
			'ht_border_top_right_radius' => array('val' => ''),
			'ht_border_bottom_right_radius' => array('val' => ''),
			'ht_border_bottom_left_radius' => array('val' => ''),
			'iie_ht_bs' => array('val' => 1),
			'ht_bs_inset' => array('val' => 0),
			'ht_bs_h_offset' => array('val' => ''),
			'ht_bs_v_offset' => array('val' => ''),
			'ht_bs_blur' => array('val' => ''),
			'ht_bs_spread' => array('val' => ''),
			'ht_bs_color' => array('val' => ''),
			// header center
			'iie_hc_bg_color' => array('val' => 1),
			'hc_bg_color' => array('val' => ''),
			'iie_cin_hc_background' => array('val' => 1),
			'hc_bg_img' => array('val' => ''),
			'iie_hc_color' => array('val' => 1),
			'hc_color' => array('val' => ''),
			'iie_hc_hover_color' => array('val' => 1),
			'hc_hover_color' => array('val' => ''),
			'iie_hc_link_color' => array('val' => 1),
			'hc_link_color' => array('val' => ''),
			'iie_hc_link_bg_color' => array('val' => 1),
			'hc_link_bg_color' => array('val' => ''),
			'iie_hc_link_hover_color' => array('val' => 1),
			'hc_link_hover_color' => array('val' => ''),
			'iie_hc_link_hover_bg_color' => array('val' => 1),
			'hc_link_hover_bg_color' => array('val' => ''),
			'iie_hc_border' => array('val' => 1),
			'hc_border_width' => array('val' => ''),
			'hc_border_color' => array('val' => ''),
			'hc_border_style' => array('val' => ''),
			'iie_cin_hc_border' => array('val' => 1),
			'hc_border_top_width' => array('val' => ''),
			'hc_border_right_width' => array('val' => ''),
			'hc_border_bottom_width' => array('val' => ''),
			'hc_border_left_width' => array('val' => ''),
			'hc_border_top_color' => array('val' => ''),
			'hc_border_right_color' => array('val' => ''),
			'hc_border_bottom_color' => array('val' => ''),
			'hc_border_left_color' => array('val' => ''),
			'hc_border_top_style' => array('val' => ''),
			'hc_border_right_style' => array('val' => ''),
			'hc_border_bottom_style' => array('val' => ''),
			'hc_border_left_style' => array('val' => ''),
			'iie_hc_border_radius' => array('val' => 1),
			'hc_border_radius' => array('val' => ''),
			'iie_cin_hc_border_radius' => array('val' => 1),
			'hc_border_top_left_radius' => array('val' => ''),
			'hc_border_top_right_radius' => array('val' => ''),
			'hc_border_bottom_right_radius' => array('val' => ''),
			'hc_border_bottom_left_radius' => array('val' => ''),
			'iie_hc_bs' => array('val' => 1),
			'hc_bs_inset' => array('val' => 0),
			'hc_bs_h_offset' => array('val' => ''),
			'hc_bs_v_offset' => array('val' => ''),
			'hc_bs_blur' => array('val' => ''),
			'hc_bs_spread' => array('val' => ''),
			'hc_bs_color' => array('val' => ''),
			// header bottom
			'iie_hb_bg_color' => array('val' => 1),
			'hb_bg_color' => array('val' => ''),
			'iie_cin_hb_background' => array('val' => 1),
			'hb_bg_img' => array('val' => ''),
			'iie_hb_color' => array('val' => 1),
			'hb_color' => array('val' => ''),
			'iie_hb_hover_color' => array('val' => 1),
			'hb_hover_color' => array('val' => ''),
			'iie_hb_link_color' => array('val' => 1),
			'hb_link_color' => array('val' => ''),
			'iie_hb_link_bg_color' => array('val' => 1),
			'hb_link_bg_color' => array('val' => ''),
			'iie_hb_link_hover_color' => array('val' => 1),
			'hb_link_hover_color' => array('val' => ''),
			'iie_hb_link_hover_bg_color' => array('val' => 1),
			'hb_link_hover_bg_color' => array('val' => ''),
			'iie_hb_border' => array('val' => 1),
			'hb_border_width' => array('val' => ''),
			'hb_border_color' => array('val' => ''),
			'hb_border_style' => array('val' => ''),
			'iie_cin_hb_border' => array('val' => 1),
			'hb_border_top_width' => array('val' => ''),
			'hb_border_right_width' => array('val' => ''),
			'hb_border_bottom_width' => array('val' => ''),
			'hb_border_left_width' => array('val' => ''),
			'hb_border_top_color' => array('val' => ''),
			'hb_border_right_color' => array('val' => ''),
			'hb_border_bottom_color' => array('val' => ''),
			'hb_border_left_color' => array('val' => ''),
			'hb_border_top_style' => array('val' => ''),
			'hb_border_right_style' => array('val' => ''),
			'hb_border_bottom_style' => array('val' => ''),
			'hb_border_left_style' => array('val' => ''),
			'iie_hb_border_radius' => array('val' => 1),
			'hb_border_radius' => array('val' => ''),
			'iie_cin_hb_border_radius' => array('val' => 1),
			'hb_border_top_left_radius' => array('val' => ''),
			'hb_border_top_right_radius' => array('val' => ''),
			'hb_border_bottom_right_radius' => array('val' => ''),
			'hb_border_bottom_left_radius' => array('val' => ''),
			'iie_hb_bs' => array('val' => 1),
			'hb_bs_inset' => array('val' => 0),
			'hb_bs_h_offset' => array('val' => ''),
			'hb_bs_v_offset' => array('val' => ''),
			'hb_bs_blur' => array('val' => ''),
			'hb_bs_spread' => array('val' => ''),
			'hb_bs_color' => array('val' => ''),
			// header mobile
			'iie_hm_bg_color' => array('val' => 1),
			'hm_bg_color' => array('val' => ''),
			'iie_cin_hm_bg' => array('val' => 1),
			'hm_bg_img' => array('val' => ''),
			'iie_hm_color' => array('val' => 1),
			'hm_color' => array('val' => ''),
			'iie_hm_hover_color' => array('val' => 1),
			'hm_hover_color' => array('val' => ''),
			'iie_hm_link_color' => array('val' => 1),
			'hm_link_color' => array('val' => ''),
			'iie_hm_link_bg_color' => array('val' => 1),
			'hm_link_bg_color' => array('val' => ''),
			'iie_hm_link_hover_color' => array('val' => 1),
			'hm_link_hover_color' => array('val' => ''),
			'iie_hm_link_hover_bg_color' => array('val' => 1),
			'hm_link_hover_bg_color' => array('val' => ''),
			'iie_hm_border' => array('val' => 1),
			'hm_border_width' => array('val' => ''),
			'hm_border_color' => array('val' => ''),
			'hm_border_style' => array('val' => ''),
			'iie_cin_hm_border' => array('val' => 1),
			'hm_border_top_width' => array('val' => ''),
			'hm_border_right_width' => array('val' => ''),
			'hm_border_bottom_width' => array('val' => ''),
			'hm_border_left_width' => array('val' => ''),
			'hm_border_top_color' => array('val' => ''),
			'hm_border_right_color' => array('val' => ''),
			'hm_border_bottom_color' => array('val' => ''),
			'hm_border_left_color' => array('val' => ''),
			'hm_border_top_style' => array('val' => ''),
			'hm_border_right_style' => array('val' => ''),
			'hm_border_bottom_style' => array('val' => ''),
			'hm_border_left_style' => array('val' => ''),
			'iie_hm_border_radius' => array('val' => 1),
			'hm_border_radius' => array('val' => ''),
			'iie_cin_hm_border_radius' => array('val' => 1),
			'hm_border_top_left_radius' => array('val' => ''),
			'hm_border_top_right_radius' => array('val' => ''),
			'hm_border_bottom_right_radius' => array('val' => ''),
			'hm_border_bottom_left_radius' => array('val' => ''),
			'iie_hm_bs' => array('val' => 1),
			'hm_bs_inset' => array('val' => 0),
			'hm_bs_h_offset' => array('val' => ''),
			'hm_bs_v_offset' => array('val' => ''),
			'hm_bs_blur' => array('val' => ''),
			'hm_bs_spread' => array('val' => ''),
			'hm_bs_color' => array('val' => ''),
			// sticky header
			'sticky_h' => array('val' => 4),
			'sticky_animation' => array('val' => 1),
			'sticky_header_top' => array('val' => 1),
			'sticky_header_center' => array('val' => 1),
			'sticky_header_bottom' => array('val' => 1),
			'sticky_bs_inset' => array('val' => 0),
			'sticky_bs_h_offset' => array('val' => ''),
			'sticky_bs_v_offset' => array('val' => ''),
			'sticky_bs_blur' => array('val' => ''),
			'sticky_bs_spread' => array('val' => ''),
			'sticky_bs_color' => array('val' => ''),
			// product block
			'pro_bck_retina' => array('val' => ''),
			'pro_bck_cp_img' => array('val' => ''),
			'pro_bck_op_img' => array('val' => ''),
			'len_of_pro_bck_name' => array('val' => '', 'smarty_val' => 1),
			'CC_len_of_pro_bck_name' => array('val' => '', 'smarty_val' => 1),
			'show_short_desc' => array('val' => '', 'smarty_val' => 1),
			'CC_show_short_desc' => array('val' => '', 'smarty_val' => 1),
			'pro_bck_truncated_text' => array('val' => '...', 'smarty_val' => 1),
			'display_color_list' => array('val' => '', 'smarty_val' => 1),
			'display_pro_bck_brand_name' => array('val' => '', 'smarty_val' => 1),
			'display_pro_bck_reference' => array('val' => '', 'smarty_val' => 1),
			'display_pro_bck_cate_name' => array('val' => '', 'smarty_val' => 1),
			'pro_bck_img_hover_scale' => array('val' => '', 'smarty_val' => 1),
			'pro_bck_font' => array('val' => ''),
			'pro_bck_font_color' => array('val' => ''),
			'pro_bck_font_size' => array('val' => ''),
			'pro_bck_font_trans' => array('val' => ''),
			'border_pro_bck' => array('val' => ''),
			'pro_bck_border_width' => array('val' => ''),
			'pro_bck_border_color' => array('val' => ''),
			'pro_bck_border_style' => array('val' => ''),
			'cin_pro_bck_border' => array('val' => ''),
			'pro_bck_border_top_width' => array('val' => ''),
			'pro_bck_border_right_width' => array('val' => ''),
			'pro_bck_border_bottom_width' => array('val' => ''),
			'pro_bck_border_left_width' => array('val' => ''),
			'pro_bck_border_top_color' => array('val' => ''),
			'pro_bck_border_right_color' => array('val' => ''),
			'pro_bck_border_bottom_color' => array('val' => ''),
			'pro_bck_border_left_color' => array('val' => ''),
			'pro_bck_border_top_style' => array('val' => ''),
			'pro_bck_border_right_style' => array('val' => ''),
			'pro_bck_border_bottom_style' => array('val' => ''),
			'pro_bck_border_left_style' => array('val' => ''),
			'border_radius_pro_bck' => array('val' => ''),
			'pro_bck_border_radius' => array('val' => ''),
			'cin_pro_bck_border_radius' => array('val' => ''),
			'pro_bck_border_top_left_radius' => array('val' => ''),
			'pro_bck_border_top_right_radius' => array('val' => ''),
			'pro_bck_border_bottom_right_radius' => array('val' => ''),
			'pro_bck_border_bottom_left_radius' => array('val' => ''),
			'sh_pro_bck' => array('val' => ''),
			'pro_bck_bs_inset' => array('val' => 0),
			'pro_bck_bs_h_offset' => array('val' => ''),
			'pro_bck_bs_v_offset' => array('val' => ''),
			'pro_bck_bs_blur' => array('val' => ''),
			'pro_bck_bs_spread' => array('val' => ''),
			'pro_bck_bs_color' => array('val' => ''),
			'pro_bck_transition' => array('val' => 0.3),
			// cross selling
			'cs_per_fs' => array('val' => ''),
			'cs_per_md' => array('val' => ''),
			'cs_per_lg' => array('val' => ''),
			'cs_per_xl' => array('val' => ''),
			'cs_per_xxl' => array('val' => ''),
			'cs_autoplay' => array('val' => ''),
			'' => array('val' => ''),
			'' => array('val' => ''),
			'cs_spacing_between' => array('val' => 16),
			'cs_pause_on_hover' => array('val' => 1),
			'cs_title' => array('val' => 0),
			// product pages
			'pro_img_col' => array('val' => ''),
			'pro_primary_col' => array('val' => ''),
			'pro_secondary_col' => array('val' => ''),
			'pro_font' => array('val' => ''),
			'pro_font_color' => array('val' => ''),
			'pro_font_size' => array('val' => ''),
			'pro_font_trans' => array('val' => ''),
			'thumb_img_type' => array('val' => 'cart_default'),
			'gallery_img_type' => array('val' => 'medium_default'),
			// category pages
			'pro_view' => array('val' => 0),
			'pro_view_mobile' => array('val' => 1),
			'pro_view_switcher' => array('val' => 1),
			'pro_spacing_grid' => array('val' => 15),
			'products_per_page' => array('val' => 8),
			'cate_pro_lazy' => array('val' => 1),
			'sticky_col' => array('val' => 0),
			'display_cate_title' => array('val' => 1),
			'display_full_cate_desc' => array('val' => 0),
			'display_cate_img' => array('val' => 0),
			'display_subcate' => array('val' => 0),
			'subcate_per_fs' => array('val' => ''),
			'subcate_per_md' => array('val' => ''),
			'subcate_per_lg' => array('val' => ''),
			'subcate_per_xl' => array('val' => ''),
			'subcate_per_xxl' => array('val' => ''),
			'cate_per_fs' => array('val' => ''),
			'cate_per_md' => array('val' => ''),
			'cate_per_lg' => array('val' => ''),
			'cate_per_xl' => array('val' => ''),
			'cate_per_xxl' => array('val' => ''),
			// footer
			'fullwidth_f' => array('val' => 1, 'smarty_val' => 1),
			'f_left_alignment' => array('val' => 0),
			'f_center_alignment' => array('val' => 1),
			'f_right_alignment' => array('val' => 2),
			'f_bg_color' => array('val' => ''),
			'cin_f_bg' => array('val' => ''),
			'f_bg_img' => array('val' => ''),
			'f_color' => array('val' => ''),
			'f_hover_color' => array('val' => ''),
			'f_link_color' => array('val' => ''),
			'f_link_bg_color' => array('val' => ''),
			'f_link_hover_color' => array('val' => ''),
			'f_link_hover_bg_color' => array('val' => ''),
			'f_bg_img' => array('val' => ''),
			'f_bg_pattern' => array('val' => ''),
			'f_border_width' => array('val' => ''),
			'f_border_color' => array('val' => ''),
			'f_border_style' => array('val' => 1),
			'cin_f_border' => array('val' => ''),
			'f_border_top_width' => array('val' => ''),
			'f_border_right_width' => array('val' => ''),
			'f_border_bottom_width' => array('val' => ''),
			'f_border_left_width' => array('val' => ''),
			'f_border_top_color' => array('val' => ''),
			'f_border_right_color' => array('val' => ''),
			'f_border_bottom_color' => array('val' => ''),
			'f_border_left_color' => array('val' => ''),
			'f_border_top_style' => array('val' => ''),
			'f_border_right_style' => array('val' => ''),
			'f_border_bottom_style' => array('val' => ''),
			'f_border_left_style' => array('val' => ''),
			'f_border_radius' => array('val' => ''),
			'cin_f_border_radius' => array('val' => ''),
			'f_border_top_left_radius' => array('val' => ''),
			'f_border_top_right_radius' => array('val' => ''),
			'f_border_bottom_right_radius' => array('val' => ''),
			'f_border_bottom_left_radius' => array('val' => ''),
			'f_bs_inset' => array('val' => 0),
			'f_bs_h_offset' => array('val' => ''),
			'f_bs_v_offset' => array('val' => ''),
			'f_bs_blur' => array('val' => ''),
			'f_bs_spread' => array('val' => ''),
			'f_bs_color' => array('val' => ''),
			// footer top
			'iie_ft_bg_color' => array('val' => 1),
			'ft_bg_color' => array('val' => ''),
			'iie_cin_ft_background' => array('val' => 1),
			'ft_bg_img' => array('val' => ''),
			'iie_ft_color' => array('val' => 1),
			'ft_color' => array('val' => ''),
			'iie_ft_hover_color' => array('val' => 1),
			'ft_hover_color' => array('val' => ''),
			'iie_ft_link_color' => array('val' => 1),
			'ft_link_color' => array('val' => ''),
			'iie_ft_link_bg_color' => array('val' => 1),
			'ft_link_bg_color' => array('val' => ''),
			'iie_ft_link_hover_color' => array('val' => 1),
			'ft_link_hover_color' => array('val' => ''),
			'iie_ft_link_hover_bg_color' => array('val' => 1),
			'ft_link_hover_bg_color' => array('val' => ''),
			'iie_ft_border' => array('val' => 1),
			'ft_border_width' => array('val' => ''),
			'ft_border_color' => array('val' => ''),
			'ft_border_style' => array('val' => ''),
			'iie_cin_ft_border' => array('val' => 1),
			'ft_border_top_width' => array('val' => ''),
			'ft_border_right_width' => array('val' => ''),
			'ft_border_bottom_width' => array('val' => ''),
			'ft_border_left_width' => array('val' => ''),
			'ft_border_top_color' => array('val' => ''),
			'ft_border_right_color' => array('val' => ''),
			'ft_border_bottom_color' => array('val' => ''),
			'ft_border_left_color' => array('val' => ''),
			'ft_border_top_style' => array('val' => ''),
			'ft_border_right_style' => array('val' => ''),
			'ft_border_bottom_style' => array('val' => ''),
			'ft_border_left_style' => array('val' => ''),
			'iie_ft_border_radius' => array('val' => 1),
			'ft_border_radius' => array('val' => ''),
			'iie_cin_ft_border_radius' => array('val' => 1),
			'ft_border_top_left_radius' => array('val' => ''),
			'ft_border_top_right_radius' => array('val' => ''),
			'ft_border_bottom_right_radius' => array('val' => ''),
			'ft_border_bottom_left_radius' => array('val' => ''),
			'iie_ft_bs' => array('val' => 1),
			'ft_bs_inset' => array('val' => 0),
			'ft_bs_h_offset' => array('val' => ''),
			'ft_bs_v_offset' => array('val' => ''),
			'ft_bs_blur' => array('val' => ''),
			'ft_bs_spread' => array('val' => ''),
			'ft_bs_color' => array('val' => ''),
			// footer center
			'iie_fc_bg_color' => array('val' => 1),
			'fc_bg_color' => array('val' => ''),
			'iie_cin_fc_background' => array('val' => 1),
			'fc_bg_img' => array('val' => ''),
			'iie_fc_color' => array('val' => 1),
			'fc_color' => array('val' => ''),
			'iie_fc_hover_color' => array('val' => 1),
			'fc_hover_color' => array('val' => ''),
			'iie_fc_link_color' => array('val' => 1),
			'fc_link_color' => array('val' => ''),
			'iie_fc_link_bg_color' => array('val' => 1),
			'fc_link_bg_color' => array('val' => ''),
			'iie_fc_link_hover_color' => array('val' => 1),
			'fc_link_hover_color' => array('val' => ''),
			'iie_fc_link_hover_bg_color' => array('val' => 1),
			'fc_link_hover_bg_color' => array('val' => ''),
			'iie_fc_border' => array('val' => 1),
			'fc_border_width' => array('val' => ''),
			'fc_border_color' => array('val' => ''),
			'fc_border_style' => array('val' => ''),
			'iie_cin_fc_border' => array('val' => 1),
			'fc_border_top_width' => array('val' => ''),
			'fc_border_right_width' => array('val' => ''),
			'fc_border_bottom_width' => array('val' => ''),
			'fc_border_left_width' => array('val' => ''),
			'fc_border_top_color' => array('val' => ''),
			'fc_border_right_color' => array('val' => ''),
			'fc_border_bottom_color' => array('val' => ''),
			'fc_border_left_color' => array('val' => ''),
			'fc_border_top_style' => array('val' => ''),
			'fc_border_right_style' => array('val' => ''),
			'fc_border_bottom_style' => array('val' => ''),
			'fc_border_left_style' => array('val' => ''),
			'iie_fc_border_radius' => array('val' => 1),
			'fc_border_radius' => array('val' => ''),
			'iie_cin_fc_border_radius' => array('val' => 1),
			'fc_border_top_left_radius' => array('val' => ''),
			'fc_border_top_right_radius' => array('val' => ''),
			'fc_border_bottom_right_radius' => array('val' => ''),
			'fc_border_bottom_left_radius' => array('val' => ''),
			'iie_fc_bs' => array('val' => 1),
			'fc_bs_inset' => array('val' => 0),
			'fc_bs_h_offset' => array('val' => ''),
			'fc_bs_v_offset' => array('val' => ''),
			'fc_bs_blur' => array('val' => ''),
			'fc_bs_spread' => array('val' => ''),
			'fc_bs_color' => array('val' => ''),
			// footer bottom
			'iie_fb_bg_color' => array('val' => 1),
			'fb_bg_color' => array('val' => ''),
			'iie_cin_fb_background' => array('val' => 1),
			'fb_bg_img' => array('val' => ''),
			'iie_fb_color' => array('val' => 1),
			'fb_color' => array('val' => ''),
			'iie_fb_hover_color' => array('val' => 1),
			'fb_hover_color' => array('val' => ''),
			'iie_fb_link_color' => array('val' => 1),
			'fb_link_color' => array('val' => ''),
			'iie_fb_link_bg_color' => array('val' => 1),
			'fb_link_bg_color' => array('val' => ''),
			'iie_fb_link_hover_color' => array('val' => 1),
			'fb_link_hover_color' => array('val' => ''),
			'iie_fb_link_hover_bg_color' => array('val' => 1),
			'fb_link_hover_bg_color' => array('val' => ''),
			'iie_fb_border' => array('val' => 1),
			'fb_border_width' => array('val' => ''),
			'fb_border_color' => array('val' => ''),
			'fb_border_style' => array('val' => ''),
			'iie_cin_fb_border' => array('val' => 1),
			'fb_border_top_width' => array('val' => ''),
			'fb_border_right_width' => array('val' => ''),
			'fb_border_bottom_width' => array('val' => ''),
			'fb_border_left_width' => array('val' => ''),
			'fb_border_top_color' => array('val' => ''),
			'fb_border_right_color' => array('val' => ''),
			'fb_border_bottom_color' => array('val' => ''),
			'fb_border_left_color' => array('val' => ''),
			'fb_border_top_style' => array('val' => ''),
			'fb_border_right_style' => array('val' => ''),
			'fb_border_bottom_style' => array('val' => ''),
			'fb_border_left_style' => array('val' => ''),
			'iie_fb_border_radius' => array('val' => 1),
			'fb_border_radius' => array('val' => ''),
			'iie_cin_fb_border_radius' => array('val' => 1),
			'fb_border_top_left_radius' => array('val' => ''),
			'fb_border_top_right_radius' => array('val' => ''),
			'fb_border_bottom_right_radius' => array('val' => ''),
			'fb_border_bottom_left_radius' => array('val' => ''),
			'iie_fb_bs' => array('val' => 1),
			'fb_bs_inset' => array('val' => 0),
			'fb_bs_h_offset' => array('val' => ''),
			'fb_bs_v_offset' => array('val' => ''),
			'fb_bs_blur' => array('val' => ''),
			'fb_bs_spread' => array('val' => ''),
			'fb_bs_color' => array('val' => ''),
			// footer mobile
			'iie_fm_bg_color' => array('val' => 1),
			'fm_bg_color' => array('val' => ''),
			'iie_cin_fm_bg' => array('val' => 1),
			'fm_bg_img' => array('val' => ''),
			'iie_fm_color' => array('val' => 1),
			'fm_color' => array('val' => ''),
			'iie_fm_hover_color' => array('val' => 1),
			'fm_hover_color' => array('val' => ''),
			'iie_fm_link_color' => array('val' => 1),
			'fm_link_color' => array('val' => ''),
			'iie_fm_link_bg_color' => array('val' => 1),
			'fm_link_bg_color' => array('val' => ''),
			'iie_fm_link_hover_color' => array('val' => 1),
			'fm_link_hover_color' => array('val' => ''),
			'iie_fm_link_hover_bg_color' => array('val' => 1),
			'fm_link_hover_bg_color' => array('val' => ''),
			'iie_fm_border' => array('val' => 1),
			'fm_border_width' => array('val' => ''),
			'fm_border_color' => array('val' => ''),
			'fm_border_style' => array('val' => ''),
			'iie_cin_fm_border' => array('val' => 1),
			'fm_border_top_width' => array('val' => ''),
			'fm_border_right_width' => array('val' => ''),
			'fm_border_bottom_width' => array('val' => ''),
			'fm_border_left_width' => array('val' => ''),
			'fm_border_top_color' => array('val' => ''),
			'fm_border_right_color' => array('val' => ''),
			'fm_border_bottom_color' => array('val' => ''),
			'fm_border_left_color' => array('val' => ''),
			'fm_border_top_style' => array('val' => ''),
			'fm_border_right_style' => array('val' => ''),
			'fm_border_bottom_style' => array('val' => ''),
			'fm_border_left_style' => array('val' => ''),
			'iie_fm_border_radius' => array('val' => 1),
			'fm_border_radius' => array('val' => ''),
			'iie_cin_fm_border_radius' => array('val' => 1),
			'fm_border_top_left_radius' => array('val' => ''),
			'fm_border_top_right_radius' => array('val' => ''),
			'fm_border_bottom_right_radius' => array('val' => ''),
			'fm_border_bottom_left_radius' => array('val' => ''),
			'iie_fm_bs' => array('val' => 1),
			'fm_bs_inset' => array('val' => 0),
			'fm_bs_h_offset' => array('val' => ''),
			'fm_bs_v_offset' => array('val' => ''),
			'fm_bs_blur' => array('val' => ''),
			'fm_bs_spread' => array('val' => ''),
			'fm_bs_color' => array('val' => ''),
			// patterns
			// colors
			'body_color' => array('val' => ''),
			'link_color' => array('val' => ''),
			'link_hover_color' => array('val' => ''),
			'price_color' => array('val' => ''),
			'old_price_color' => array('val' => ''),
			// header cart icon
			'cart_number_color' => array('val' => ''),
			'cart_number_bg_color' => array('val' => ''),
			// upload fonts
			'fonts_imported' => array('val' => ''),
			'font_name' => array('val' => ''),
			// main font
			'body_font' => array('val' => ''),
			'body_font_size' => array('val' => ''),
			// heading
			'hdg_font' => array('val' => ''),
			'hdg_font_color' => array('val' => ''),
			'hdg_font_size' => array('val' => ''),
			'hdg_font_trans' => array('val' => ''),
			'hdg_border_width' => array('val' => ''),
			'hdg_border_color' => array('val' => ''),
			'hdg_style' => array('val' => ''),
			'hdg_under_line_color' => array('val' => ''),
			'hdg_bg_img' => array('val' => ''),
			// other
			'price_font' => array('val' => ''),
			'price_font_size' => array('val' => ''),
			'old_price_font_size' => array('val' => ''),
			'main_price_font_size' => array('val' => ''),
			// header tag size
			'header_tag_1' => array('val' => ''),
			'header_tag_2' => array('val' => ''),
			'header_tag_3' => array('val' => ''),
			'header_tag_4' => array('val' => ''),
			'header_tag_5' => array('val' => ''),
			'header_tag_6' => array('val' => ''),
            // Swiper slider (Module)
            'msswiper_int_css' => array('val' => 0),
            'msswiper_int_js' => array('val' => 0),
			// custom codes
			'custom_css' => array('val' => '', 'esc' => 1),
			'custom_js' => array('val' => '', 'esc' => 1),
			'head_code' => array('val' => '', 'esc' => 1),
			'tracking_code' => array('val' => '', 'esc' => 1),
		);

		$this->_hooks = array(
			//		   NAME            TITLE                DESCRIPTION        POSITION
			array('displayWrapperTop', 'Wrapper top', 'After header section', 1),
			array('displayNav1', 'Navigation', 'Right side of navigation', 1),
			array('displayNav2', 'Navigation', 'Center of navigation', 1),
			array('displayNav3', 'Navigation', 'Left side of navigation', 1),
		);
	}

	public function install()
	{
		if (
			!parent::install() ||
			!$this->_addHook() ||
			!$this->registerHook('displayHeader') ||
			!$this->registerHook('actionShopDataDuplication') ||
			!$this->_useDefault()
		) {
			return false;
		}
		return true;
	}

	public function uninstall()
	{
		if (
			!parent::uninstall() ||
			!$this->_removeHook() ||
			!$this->unregisterHook('displayHeader') ||
			!$this->unregisterHook('actionShopDataDuplication') ||
			!$this->_deleteConfiguration()
		) {
			return false;
		}
		return true;
	}

	public function getContent()
	{
		include(_PS_MODULE_DIR_.$this->name.'/MsThemeEditorForm.php');
		$F = new msThemeEditorForm();
		$this->context->controller->addCSS($this->_path.'views/css/admin.css');
		$this->context->controller->addJS($this->_path.'views/js/admin.js');
		$this->context->controller->addJS($this->_path.'views/js/CF.js');
		$this->context->controller->addJS($this->_path.'views/js/jsonFonts.js');
		$this->context->controller->addJS($this->_path.'views/js/owl.carousel.min.js');
		if (Tools::isSubmit('savemsthemeeditor')) {
			foreach ($F->initFormGroup() as $form)
				foreach ($form['form']['input'] as $field)
					if (isset($field['validation'])) {
						$errors = array();
						$ishtml = ($field['validation'] == 'isAnything') ? true : false;
						$value = Tools::getValue($field['name']);
						// Set default value
						if ($value === false && isset($field['default_value']))
							$value = $field['default_value'];
						if (count($errors)) {
							$this->validation_errors = array_merge($this->validation_errors, $errors);
						} elseif (!$value) {
							if ($field['validation'] == 'isBool')
								$value = 0;
							Configuration::updateValue('MSM_'.strtoupper($field['name']), $value);
						} else
							Configuration::updateValue('MSM_'.strtoupper($field['name']), $value, $ishtml);
					}
			foreach ($F->id_input as $v) {
				$arr = explode(':', $v);
				foreach ($F->setInputs($arr[0], $arr[1]) as $i) {
					$gv = Tools::getValue($i['name']);
					if ($gv !== false)
						Configuration::updateValue('MSM_'.strtoupper($i['name']), $gv);
				}
			}
			if ($nav_pipe = Configuration::get('MSM_NAVIGATION_PIPE'))
				Configuration::updateValue('PS_NAVIGATION_PIPE', $nav_pipe);
			if ($pro_per_page = Configuration::get('MSM_PRODUCTS_PER_PAGE'))
				Configuration::updateValue('PS_PRODUCTS_PER_PAGE', $pro_per_page);
			$this->updateLangInput();
			CF::downloadAndSetFont(['pro_bck_font', 'pro_font', 'body_font', 'hdg_font', 'price_font'], $this->name);
			$this->_checkDir(_PS_UPLOAD_DIR_.$this->name.'/');
			if ($payment_icon = Tools::fileAttachment('payment_icon', false)) {
				$imgS = getimagesize($payment_icon['tmp_name']);
				if (!empty($imgS)) {
					if ($e = ImageManager::validateUpload($payment_icon, Tools::convertBytes(ini_get('upload_max_filesize'))))
						$this->validation_errors[] = $e;
					else {
						$name = $this->uploadCheckAndGetName($payment_icon['name']);
						if (!$name)
							$this->validation_errors[] = $this->l('Image format not recognized');
						elseif (!move_uploaded_file($payment_icon['tmp_name'], _PS_UPLOAD_DIR_.$this->name.'/'.$name))
							$this->validation_errors[] = $this->l('Error move uploaded file');
						else
							Configuration::updateValue('MSM_PAYMENT_ICON', $this->name.'/'.$name);
					}
				}
			}
			if ($mobile_logo = Tools::fileAttachment('mobile_logo', false)) {
				$imgS = getimagesize($mobile_logo['tmp_name']);
				if (!empty($imgS)) {
					if ($e = ImageManager::validateUpload($mobile_logo, Tools::convertBytes(ini_get('upload_max_filesize'))))
						$this->validation_errors[] = $e;
					else {
						$name = $this->uploadCheckAndGetName($mobile_logo['name']);
						if (!$name)
							$this->validation_errors[] = $this->l('Image format not recognized');
						elseif (!move_uploaded_file($mobile_logo['tmp_name'], _PS_UPLOAD_DIR_.$this->name.'/'.$name))
							$this->validation_errors[] = $this->l('Error move uploaded file');
						else {
							Configuration::updateValue('MSM_MOBILE_LOGO', $this->name.'/'.$name);
							Configuration::updateValue('MSM_MOBILE_LOGO_WIDTH', $imgS[0]);
							Configuration::updateValue('MSM_MOBILE_LOGO_HEIGHT', $imgS[1]);
						}
					}
				}
			}
			if ($retina_logo = Tools::fileAttachment('retina_logo', false)) {
				if ($e = ImageManager::validateUpload($retina_logo, Tools::convertBytes(ini_get('upload_max_filesize'))))
					$this->validation_errors[] = $e;
				else {
					$name = $this->uploadCheckAndGetName($retina_logo['name']);
					if (!$name)
						$this->validation_errors[] = $this->l('Image format not recognized');
					elseif (!move_uploaded_file($retina_logo['tmp_name'], _PS_UPLOAD_DIR_.$this->name.'/'.$name))
						$this->validation_errors[] = $this->l('Error move uploaded file');
					else
						Configuration::updateValue('MSM_RETINA_LOGO', $this->name.'/'.$name);
				}
			}
			if ($fonts = Tools::fileAttachment('fonts', false)) {
				$fontDir = $this->local_path.'views/fonts/';
				$name = Tools::getValue('font_name');
				$FIs = Configuration::get('MSM_FONTS_IMPORTED');
				if (!CF::checkFont($name, $FIs))
					$this->validation_errors[] = $this->l('The "Name your own font" value is empty or this is in the font list.');
				elseif (!Tools::ZipTest($fonts['tmp_name']))
					$this->validation_errors[] = $this->l('Please send a "Zip" file.');
				elseif (!Tools::ZipExtract($fonts['tmp_name'], $fontDir.$name))
					$this->validation_errors[] = $this->l('Could not extract file.');
				else {
					Configuration::updateValue('MSM_FONTS_IMPORTED', $FIs ? $FIs.','.$name : $name);
					file_put_contents($this->local_path.'views/css/fonts_imported.css', CF::includeFonts($name), FILE_APPEND);
				}
			}
			if (count($this->validation_errors))
				$this->_html .= $this->displayError(implode('<br/>', $this->validation_errors));
			else {
				$this->writeCss();
				$this->_html .= $this->displayConfirmation($this->getTranslator()->trans('Settings updated', array(), 'Modules.Msthemeeditor.Admin'));
			}
		}
		// header & mobile header
		if (Tools::getValue('act') == 'del_img' && $field = Tools::getValue('field')) {
			$file = _PS_UPLOAD_DIR_.Configuration::get('MSM_'.strtoupper($field));
			Tools::deleteFile($file);
			Configuration::updateValue('MSM_'.strtoupper($field), '');
			$result['r'] = true;
            die(json_encode($result));
		}
		if (Tools::getValue('act') == 'del_fonts_imported') {
			Configuration::updateValue('MSM_FONTS_IMPORTED', '');
			Tools::deleteFile($this->local_path.'views/css/fonts_imported.css');
			$result['r'] = true;
            die(json_encode($result));
		}
		Media::addJsDef(array(
			'module_name' => $this->name,
            'id_tab_index' => Tools::getValue('id_tab_index', 0),
			'CIN' => $this->CIN_IIE('CIN'),
			'IIE' => $this->CIN_IIE('IIE'),
        ));
		$this->context->controller->addCSS($this->_path.'views/css/fonts_imported.css');
		$helper = $this->initForm();

		return $this->_html.$this->initTab().$helper->generateForm($F->initFormGroup());
	}
	// s hook
	private function _addHook()
	{
		$res = true;
		foreach ($this->_hooks as $v) {
			if (!$res)
				break;
			if (!Validate::isHookName($v[0]))
				continue;
			$id_hook = Hook::getIdByName($v[0]);
			if (!$id_hook) {
				$new_hook = new Hook();
				$new_hook->name = pSQL($v[0]);
				$new_hook->title = pSQL($v[1]);
				$new_hook->description = pSQL($v[2]);
				$new_hook->position = pSQL($v[3]);
				$new_hook->add();
				if (!$new_hook->id)
					$res = false;
			} else {
				Db::getInstance()->execute('UPDATE `'._DB_PREFIX_.'hook` set `title`="'.$v[1].'", `description`="'.$v[2].'", `position`="'.$v[3].'" where `id_hook`='.$id_hook);
			}
		}

		return $res;
	}

	private function _removeHook()
	{
		$sql = 'DELETE FROM `'._DB_PREFIX_.'hook` WHERE ';
		foreach ($this->_hooks as $v) {
			$sql .= '`name` = "'.$v[0].'" OR';
		}
		return Db::getInstance()->execute(rtrim($sql, 'OR').';');
	}
	// e hook
	private function _checkDir($dir)
	{
		$res = '';
		if (!file_exists($dir)) {
			$success = @mkdir($dir, $this->permission, true) || @chmod($dir, $this->permission);
			if (!$success)
				$res = $this->displayError('"'.$dir.'" '.$this->getTranslator()->trans('An error occurred during new folder creation', array(), 'Modules.Msthemeeditor.Admin'));
		}
		if (!is_writable($dir))
			$res = $this->displayError('"'.$dir.'" '.$this->getTranslator()->trans('directory isn\'t writable.', array(), 'Modules.Msthemeeditor.Admin'));
		return $res;
	}

	public function uploadCheckAndGetName($name)
	{
		$type = strtolower(substr(strrchr($name, '.'), 1));
		if (!in_array($type, $this->imgtype))
			return false;
		$filename = Tools::encrypt($name.sha1(microtime()));
		while (file_exists(_PS_UPLOAD_DIR_.$this->name.'/'.$filename.'.'.$type)) {
			$filename .= rand(10, 99);
		}
		return $filename.'.'.$type;
	}
	// s display and action hooks
	public function hookActionShopDataDuplication($params)
	{
		$this->_useDefault(false, Shop::getGroupFromShop($params['new_id_shop']), $params['new_id_shop']);
	}

	public function hookDisplayHeader()
	{
		$theme_font = array(
			Configuration::get('MSM_PRO_BCK_FONT'),
			Configuration::get('MSM_PRO_FONT'),
			Configuration::get('MSM_BODY_FONT'),
			Configuration::get('MSM_HDG_FONT'),
			Configuration::get('MSM_PRICE_FONT'),
		);
		if (!Configuration::get('MSM_DOWNLOAD_FONT') && is_array($theme_font) && count($theme_font)) {
			$fonts = array();
			foreach ($theme_font as $v) {
				$arr = explode(':', $v);
				if (!isset($arr[0]) || !$arr[0] || $arr[0] == 'inherit' || in_array($arr[0], self::$fonts['system']))
					continue;
				$gf_key = preg_replace('/\s/iS','_',$arr[0]);
				if (isset($arr[1]) && !in_array($arr[1], self::$fonts['google'][$gf_key]['variants']))
					$v = $arr[0];
				$fonts[] = str_replace(' ', '+', $v);
			}
			if ($fonts)
				$this->context->controller->registerStylesheet('msthemeeditor-google-fonts', $this->context->link->protocol_content.'fonts.googleapis.com/css?family='.implode('|', $fonts), ['server' => 'remote']);
		}
		/*$is_responsive = Configuration::get('MSM_RESPONSIVE');
		$responsive_max = Configuration::get('MSM_RESPONSIVE_MAX');
		$cc_res_max = Configuration::get('MSM_CC_RES_MAX');
		if ($is_responsive) {
			$this->context->controller->registerStylesheet('msthemeeditor-responsive', 'assets/css/responsive.css');
		}*/
		if (!file_exists($this->local_path.'views/css/customer-s'.$this->context->shop->getContextShopID().'.css'))
			$this->writeCss();
		$vals = $this->initFront();
		$this->context->smarty->assign('theme', $vals['smarty_val']);
	}
	// e display and action hooks / s configuration
	private function _deleteConfiguration()
	{
		foreach ($this->defaults as $k => $v) {
			if (!Configuration::deleteByName('MSM_'.strtoupper($k)))
				return false;
		}

		return true;
	}

	private function _useDefault($html = false, $idShopGroup = null, $idShop = null)
	{
		foreach ($this->defaults as $k => $v) {
			if (!Configuration::updateValue('MSM_'.strtoupper($k), $v['val'], $html, $idShopGroup, $idShop))
				return false;
		}

		return true;
	}

	public function updateLangInput()
	{
		$languages = Language::getLanguages(false);
		$default_lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
		$welcome = $welcome_logged = $copyright_text = array();
		foreach ($languages as $language) {
			$welcome[$language['id_lang']] = Tools::getValue('welcome_'.$language['id_lang']) ? Tools::getValue('welcome_'.$language['id_lang']) : Tools::getValue('welcome_'.$default_lang->id);
			$welcome_logged[$language['id_lang']] = Tools::getValue('welcome_logged_'.$language['id_lang']) ? Tools::getValue('welcome_logged_'.$language['id_lang']) : Tools::getValue('welcome_logged_'.$default_lang->id);
			$copyright_text[$language['id_lang']] = Tools::getValue('copyright_text_'.$language['id_lang']) ? Tools::getValue('copyright_text_'.$language['id_lang']) : Tools::getValue('copyright_text_'.$default_lang->id);
		}
		Configuration::updateValue('MSM_WELCOME', $welcome);
		Configuration::updateValue('MSM_WELCOME_LOGGED', $welcome_logged);
		Configuration::updateValue('MSM_COPYRIGHT_TEXT', $copyright_text);
	}

	private function getConfigFieldsValues()
	{
		$fields_values = array();
		foreach ($this->defaults as $k => $v) {
			$fields_values[$k] = Configuration::get('MSM_'.strtoupper($k));
			if (isset($v['esc']) && $v['esc'])
				$fields_values[$k] = html_entity_decode($fields_values[$k]);
		}
		$languages = Language::getLanguages(false);
		foreach ($languages as $language) {
			$fields_values['welcome'][$language['id_lang']] = Configuration::get('MSM_WELCOME', $language['id_lang']);
			$fields_values['welcome_logged'][$language['id_lang']] = Configuration::get('MSM_WELCOME_LOGGED', $language['id_lang']);
			$fields_values['copyright_text'][$language['id_lang']] = Configuration::get('MSM_COPYRIGHT_TEXT', $language['id_lang']);
		}
		$font_list = array('pro_bck_font', 'pro_font', 'body_font', 'hdg_font', 'price_font');
		foreach ($font_list as $v) {
			$font_string = explode(':', Configuration::get('MSM_'.strtoupper($v)));
			$fields_values[$v.'_list'] = $font_string ? $font_string[0] : '';
		}

		return $fields_values;
	}
	// e configuration
	public function writeCss()
	{
		$id_shop = (int)Shop::getContextShopID();
		$css = '';
		// s (import a css fonts)
		if (file_exists($this->local_path.'views/css/fonts.css') && Configuration::get('MSM_DOWNLOAD_FONT'))
			$css .= '@import "fonts.css";';
		// e (import a css fonts) / s (Page top spacing, page bottom spacing and block spacing)
		$top_spacing = ($top_spacing = Configuration::get('MSM_TOP_SPACING')) ? 'padding-top:'.$top_spacing.'px;' : '';
		$bottom_spacing = ($bottom_spacing = Configuration::get('MSM_BOTTOM_SPACING')) ? 'padding-bottom:'.$bottom_spacing.'px;' : '';
		if ($top_spacing || $bottom_spacing)
			$css .= 'body{'.$top_spacing.$bottom_spacing.'}';
		if ($block_spacing = Configuration::get('MSM_BLOCK_SPACING'))
			$css .= '.block{margin-bottom:'.$block_spacing.'px;}';
		// e (Page top spacing, page bottom spacing and block spacing) / s (responsive max)
		/*$responsive_max = Configuration::get('MSM_RESPONSIVE_MAX');
		if ($responsive_max == 3)
			$css .= '.container{max-width:100%;width:100%;}';
		if ($responsive_max == 4 && $cc_res_max = Configuration::get('MSM_CC_RES_MAX'))
			$css .= '.container{max-width:'.$cc_res_max.'px;width:'.$cc_res_max.'px;}';*/
		// e (responsive max) / s (product image)
		$imagesTypes = ImageType::getImagesTypes('products');
		$gallery_img_type = ($gallery_img_type = Configuration::get('MSM_GALLERY_IMG_TYPE')) ? $gallery_img_type : 'medium_default';
		foreach ($imagesTypes as $imageType) {
			$css .= '.'.$imageType['name'].'{max-width:'.$imageType['width'].'px;}';
			if ($imageType['name'] != $gallery_img_type)
				continue;
		}
		// e (product image) / s (category image)
		$imagesTypes = ImageType::getImagesTypes('categories');
		foreach ($imagesTypes as $imageType) {
			$css .= '.'.$imageType['name'].'{max-width:'.$imageType['width'].'px;}';
		}
		// e (category image) / s (main header, main footer)
		$p = array(
			'prefix' => array('_H_', '_F_'),
			'id' => array('#header', '#footer'),
		);
		for ($i = 0; $i < 2; $i++) {
			$prefix = $p['prefix'][$i];
			$main_border = $main_border_radius = $main_bs = '';
			if (!Configuration::get('MSM_CIN'.$prefix.'BG')) {
				$main_bg_color = ($main_bg_color = Configuration::get('MSM'.$prefix.'BG_COLOR')) ? 'background-color:'.$main_bg_color.';' : '';
			} elseif (Configuration::get('MSM_CIN'.$prefix.'BG') && $h_img = Configuration::get('MSM'.$prefix.'BG_IMG')) {
				$main_bg_color = 'background-image: url(../img/patterns/'.$h_img.'.png);';
			}
			$main_color = ($main_color = Configuration::get('MSM'.$prefix.'COLOR')) ? 'color:'.$main_color.';' : '';
			$main_hover_color = ($main_hover_color = Configuration::get('MSM'.$prefix.'HOVER_COLOR')) ? 'color:'.$main_hover_color.';' : '';
			$main_link_color = ($main_link_color = Configuration::get('MSM'.$prefix.'LINK_COLOR')) ? 'color:'.$main_link_color.';' : '';
			$main_link_hover_color = ($main_link_hover_color = Configuration::get('MSM'.$prefix.'LINK_HOVER_COLOR')) ? 'color:'.$main_link_hover_color.';' : '';
			if (!Configuration::get('MSM_CIN'.$prefix.'BORDER') && $bw = Configuration::get('MSM'.$prefix.'BORDER_WIDTH')) {
				$main_border = 'border:'.$bw.'px';
				$main_border .= Configuration::get('MSM'.$prefix.'BORDER_STYLE') ? ' '.self::$bStyle[Configuration::get('MSM'.$prefix.'BORDER_STYLE')] : '';
				$main_border .= Configuration::get('MSM'.$prefix.'BORDER_COLOR') ? ' '.Configuration::get('MSM'.$prefix.'BORDER_COLOR').';' : '';
			} elseif (Configuration::get('MSM_CIN'.$prefix.'BORDER')) {
				$BTW = ($BTW = Configuration::get('MSM'.$prefix.'BORDER_TOP_WIDTH')) ? $BTW.'px' : '0';
				$BRW = ($BRW = Configuration::get('MSM'.$prefix.'BORDER_RIGHT_WIDTH')) ? ' '.$BRW.'px' : ' 0';
				$BBW = ($BBW = Configuration::get('MSM'.$prefix.'BORDER_BOTTOM_WIDTH')) ? ' '.$BBW.'px' : ' 0';
				$BLW = ($BLW = Configuration::get('MSM'.$prefix.'BORDER_LEFT_WIDTH')) ? ' '.$BLW.'px' : ' 0';
				$main_border = 'border-width:'.$BTW.$BRW.$BBW.$BLW.';';
				$BTS = ($BTS = Configuration::get('MSM'.$prefix.'BORDER_TOP_STYLE')) ? self::$bStyle[$BTS] : 'none';
				$BRS = ($BRS = Configuration::get('MSM'.$prefix.'BORDER_RIGHT_STYLE')) ? ' '.self::$bStyle[$BRS] : ' none';
				$BBS = ($BBS = Configuration::get('MSM'.$prefix.'BORDER_BOTTOM_STYLE')) ? ' '.self::$bStyle[$BBS] : ' none';
				$BLS = ($BLS = Configuration::get('MSM'.$prefix.'BORDER_LEFT_STYLE')) ? ' '.self::$bStyle[$BLS] : ' none';
				$main_border .= 'border-style:'.$BTS.$BRS.$BBS.$BLS.';';
				$BTC = ($BTC = Configuration::get('MSM'.$prefix.'BORDER_TOP_COLOR')) ? $BTC : 'transparent';
				$BRC = ($BRC = Configuration::get('MSM'.$prefix.'BORDER_RIGHT_COLOR')) ? ' '.$BRC : ' transparent';
				$BBC = ($BBC = Configuration::get('MSM'.$prefix.'BORDER_BOTTOM_COLOR')) ? ' '.$BBC : ' transparent';
				$BLC = ($BLC = Configuration::get('MSM'.$prefix.'BORDER_LEFT_COLOR')) ? ' '.$BLC : ' transparent';
				$main_border .= 'border-color:'.$BTC.$BRC.$BBC.$BLC.';';
			}
			if (!Configuration::get('MSM_CIN'.$prefix.'BORDER_RADIUS') && $br = Configuration::get('MSM'.$prefix.'BORDER_RADIUS'))
				$main_border_radius = 'border-radius:'.$br.'px;';
			elseif (Configuration::get('MSM_CIN'.$prefix.'BORDER_RADIUS')) {
				$BTLR = ($BTLR = Configuration::get('MSM'.$prefix.'BORDER_TOP_LEFT_RADIUS')) ? $BTLR.'px' : '0';
				$BTRR = ($BTRR = Configuration::get('MSM'.$prefix.'BORDER_TOP_RIGHT_RADIUS')) ? ' '.$BTRR.'px' : ' 0';
				$BBRR = ($BBRR = Configuration::get('MSM'.$prefix.'BORDER_BOTTOM_RIGHT_RADIUS')) ? ' '.$BBRR.'px' : ' 0';
				$BBLR = ($BBLR = Configuration::get('MSM'.$prefix.'BORDER_BOTTOM_LEFT_RADIUS')) ? ' '.$BBLR.'px' : ' 0';
				$main_border_radius = 'border-radius:'.$BTLR.$BTRR.$BBRR.$BBLR.';';
			}
			$bs_h_offset = Configuration::get('MSM'.$prefix.'BS_H_OFFSET');
			$bs_v_offset = Configuration::get('MSM'.$prefix.'BS_V_OFFSET');
			if ($bs_h_offset !== '' && $bs_v_offset !== '') {
				$bs_inset = ($bs_inset = Configuration::get('MSM'.$prefix.'BS_INSET')) ? 'inset ' : '';
				$bs_h_offset = $bs_h_offset.'px';
				$bs_v_offset = ' '.$bs_v_offset.'px';
				$bs_blur = ($bs_blur = Configuration::get('MSM'.$prefix.'BS_BLUR')) ? ' '.$bs_blur.'px' : '';
				$bs_spread = ($bs_spread = Configuration::get('MSM'.$prefix.'BS_SPREAD')) ? ' '.$bs_spread.'px' : '';
				$bs_color = ($bs_color = Configuration::get('MSM'.$prefix.'BS_COLOR')) ? ' '.$bs_color : '';
				$main_bs = 'box-shadow:'.$bs_inset.$bs_h_offset.$bs_v_offset.$bs_blur.$bs_spread.$bs_color.';';
			}
			$id = $p['id'][$i];
			if ($id === '#header') {
				$h_bg_color = $main_bg_color;
				$h_color = $main_color;
				$h_border = $main_border;
				$h_border_radius = $main_border_radius;
				$h_bs = $main_bs;
				$h_hover_color = $main_hover_color;
				$h_link_color = $main_link_color;
				$h_link_hover_color = $main_link_hover_color;
			} else {
				$f_bg_color = $main_bg_color;
				$f_color = $main_color;
				$f_border = $main_border;
				$f_border_radius = $main_border_radius;
				$f_bs = $main_bs;
				$f_hover_color = $main_hover_color;
				$f_link_color = $main_link_color;
				$f_link_hover_color = $main_link_hover_color;
			}
		}
		// e (main header, main footer) / s (top header, center header, bottom header, mobile header)
		$h_c = array(
			'prefix' => array('_HT_', '_HC_', '_HB_', '_HM_', '_FT_', '_FC_', '_FB_', '_FM_'),
			'class' => array('header-top', 'header-center', 'header-bottom', 'header-mobile', 'footer-top', 'footer-center', 'footer-bottom', 'footer-mobile'),
		);
		for ($i = 0; $i < 8; $i++) {
			$border = $border_radius = $bs = '';
			$prefix = $h_c['prefix'][$i];
			$a = ($a = Configuration::get('MSM'.$prefix.'BG_COLOR')) ? 'background-color:'.$a.';' : '';
			$bg_color = Configuration::get('MSM_IIE'.$prefix.'BG_COLOR') ? (($i < 4) ? $h_bg_color : $f_bg_color) : $a;
			$b = ($b = Configuration::get('MSM'.$prefix.'COLOR')) ? 'color:'.$b.';' : '';
			$color = Configuration::get('MSM_IIE'.$prefix.'COLOR') ? (($i < 4) ? $h_color : $f_color) : $b;
			$c = ($c = Configuration::get('MSM'.$prefix.'HOVER_COLOR')) ? 'color:'.$c.';' : '';
			$hover_color = Configuration::get('MSM_IIE'.$prefix.'HOVER_COLOR') ? (($i < 4) ? $h_hover_color : $f_hover_color) : $c;
			$d = ($d = Configuration::get('MSM'.$prefix.'LINK_COLOR')) ? 'color:'.$d.';' : '';
			$link_color = Configuration::get('MSM_IIE'.$prefix.'LINK_COLOR') ? (($i < 4) ? $h_link_color : $f_link_color) : $d;
			$e = ($e = Configuration::get('MSM'.$prefix.'LINK_HOVER_COLOR')) ? 'color:'.$e.';' : '';
			$link_hover_color = Configuration::get('MSM_IIE'.$prefix.'LINK_HOVER_COLOR') ? (($i < 4) ? $h_link_hover_color : $f_link_hover_color) : $e;
			if (!Configuration::get('MSM_IIE'.$prefix.'BORDER') && $bw = Configuration::get('MSM'.$prefix.'BORDER_WIDTH')) {
				$border = 'border:'.$bw.'px';
				$border .= Configuration::get('MSM'.$prefix.'BORDER_STYLE') ? ' '.self::$bStyle[Configuration::get('MSM'.$prefix.'BORDER_STYLE')] : '';
				$border .= Configuration::get('MSM'.$prefix.'BORDER_COLOR') ? ' '.Configuration::get('MSM'.$prefix.'BORDER_COLOR').';' : '';
			} elseif (!Configuration::get('MSM_IIE_CIN'.$prefix.'BORDER')) {
				$BTW = ($BTW = Configuration::get('MSM'.$prefix.'BORDER_TOP_WIDTH')) ? $BTW.'px' : '0';
				$BRW = ($BRW = Configuration::get('MSM'.$prefix.'BORDER_RIGHT_WIDTH')) ? ' '.$BRW.'px' : ' 0';
				$BBW = ($BBW = Configuration::get('MSM'.$prefix.'BORDER_BOTTOM_WIDTH')) ? ' '.$BBW.'px' : ' 0';
				$BLW = ($BLW = Configuration::get('MSM'.$prefix.'BORDER_LEFT_WIDTH')) ? ' '.$BLW.'px' : ' 0';
				$border = 'border-width:'.$BTW.$BRW.$BBW.$BLW.';';
				$BTS = ($BTS = Configuration::get('MSM'.$prefix.'BORDER_TOP_STYLE')) ? self::$bStyle[$BTS] : 'none';
				$BRS = ($BRS = Configuration::get('MSM'.$prefix.'BORDER_RIGHT_STYLE')) ? ' '.self::$bStyle[$BRS] : ' none';
				$BBS = ($BBS = Configuration::get('MSM'.$prefix.'BORDER_BOTTOM_STYLE')) ? ' '.self::$bStyle[$BBS] : ' none';
				$BLS = ($BLS = Configuration::get('MSM'.$prefix.'BORDER_LEFT_STYLE')) ? ' '.self::$bStyle[$BLS] : ' none';
				$border .= 'border-style:'.$BTS.$BRS.$BBS.$BLS.';';
				$BTC = ($BTC = Configuration::get('MSM'.$prefix.'BORDER_TOP_COLOR')) ? $BTC : 'transparent';
				$BRC = ($BRC = Configuration::get('MSM'.$prefix.'BORDER_RIGHT_COLOR')) ? ' '.$BRC : ' transparent';
				$BBC = ($BBC = Configuration::get('MSM'.$prefix.'BORDER_BOTTOM_COLOR')) ? ' '.$BBC : ' transparent';
				$BLC = ($BLC = Configuration::get('MSM'.$prefix.'BORDER_LEFT_COLOR')) ? ' '.$BLC : ' transparent';
				$border .= 'border-color:'.$BTC.$BRC.$BBC.$BLC.';';
			} elseif (Configuration::get('MSM_IIE'.$prefix.'BORDER') || Configuration::get('MSM_IIE_CIN'.$prefix.'BORDER'))
				$border = (($i < 4) ? $h_border : $f_border);
			if (!Configuration::get('MSM_IIE_CIN'.$prefix.'BORDER_RADIUS') && $br = Configuration::get('MSM'.$prefix.'BORDER_RADIUS'))
				$border_radius = 'border-radius:'.$br.'px;';
			elseif (!Configuration::get('MSM_IIE_CIN'.$prefix.'BORDER_RADIUS')) {
				$BTLR = ($BTLR = Configuration::get('MSM'.$prefix.'BORDER_TOP_LEFT_RADIUS')) ? $BTLR.'px' : '0';
				$BTRR = ($BTRR = Configuration::get('MSM'.$prefix.'BORDER_TOP_RIGHT_RADIUS')) ? ' '.$BTRR.'px' : ' 0';
				$BBRR = ($BBRR = Configuration::get('MSM'.$prefix.'BORDER_BOTTOM_RIGHT_RADIUS')) ? ' '.$BBRR.'px' : ' 0';
				$BBLR = ($BBLR = Configuration::get('MSM'.$prefix.'BORDER_BOTTOM_LEFT_RADIUS')) ? ' '.$BBLR.'px' : ' 0';
				$border_radius = 'border-radius:'.$BTLR.$BTRR.$BBRR.$BBLR.';';
			} elseif (Configuration::get('MSM_IIE_CIN'.$prefix.'BORDER_RADIUS'))
				$border_radius = (($i < 4) ? $h_border_radius : $f_border_radius);
			$bs_h_offset = Configuration::get('MSM'.$prefix.'BS_H_OFFSET');
			$bs_v_offset = Configuration::get('MSM'.$prefix.'BS_V_OFFSET');
			if (!Configuration::get('MSM_IIE'.$prefix.'BS') && $bs_h_offset !== '' && $bs_v_offset !== '') {
				$bs_inset = ($bs_inset = Configuration::get('MSM'.$prefix.'BS_INSET')) ? 'inset ' : '';
				$bs_h_offset = $bs_h_offset.'px';
				$bs_v_offset = ' '.$bs_v_offset.'px';
				$bs_blur = ($bs_blur = Configuration::get('MSM'.$prefix.'BS_BLUR')) ? ' '.$bs_blur.'px' : '';
				$bs_spread = ($bs_spread = Configuration::get('MSM'.$prefix.'BS_SPREAD')) ? ' '.$bs_spread.'px' : '';
				$bs_color = ($bs_color = Configuration::get('MSM'.$prefix.'BS_COLOR')) ? ' '.$bs_color : '';
				$bs = 'box-shadow:'.$bs_inset.$bs_h_offset.$bs_v_offset.$bs_blur.$bs_spread.$bs_color.';';
			} elseif (Configuration::get('MSM_IIE'.$prefix.'BS'))
				$bs = (($i < 4) ? $h_bs : $f_bs);
			$class = $h_c['class'][$i];
			$id = '#header ';
			if ($i >= 4)
				$id = '#footer ';
			$css .= $id.'.'.$class.'{'.$bg_color.$color.$border.$border_radius.$bs.'}';
			if ($hover_color)
				$css .= $id.'.'.$class.' p:hover{'.$hover_color.'}';
			if ($link_hover_color)
				$css .= $id.'.'.$class.' a:hover{'.$link_hover_color.'}';
		}
		$filter_c = array(
			'prefix' => array('_MOBILE_FILTER_', '_RETINA_FILTER_'),
			'id' => array('mobile_logo', 'retina_logo'),
		);
		for ($i = 0; $i < 2; $i++) {
			$filter = '';
			$prefix = $filter_c['prefix'][$i];
			if ($mode = (int)Configuration::get('MSM'.$prefix.'MODE')) {
				$ds_h_offset = (int)Configuration::get('MSM'.$prefix.'DS_H_OFFSET');
				$ds_v_offset = (int)Configuration::get('MSM'.$prefix.'DS_V_OFFSET');
				if ($mode == 1 && $val = (int)Configuration::get('MSM'.$prefix.'BLUR'))
					$filter = 'filter:blur('.$val.'px);-webkit-filter:blur('.$val.'px)';
				elseif ($mode == 2 && $val = (int)Configuration::get('MSM'.$prefix.'HUE_R'))
					$filter = 'filter:hue-rotate('.$val.'deg);-webkit-filter:hue-rotate('.$val.'deg)';
				elseif ($mode == 10 && $ds_h_offset && $ds_v_offset) {
					$ds_h_offset = $ds_h_offset.'px';
					$ds_v_offset = ' '.$ds_v_offset.'px';
					$ds_blur = ($ds_blur = (int)Configuration::get('MSM'.$prefix.'DS_BLUR')) ? ' '.$ds_blur.'px' : '';
					$ds_color = ($ds_color = Configuration::get('MSM'.$prefix.'DS_COLOR')) ? ' '.$ds_color : '';
					$filter = 'filter:drop-shadow('.$ds_h_offset.$ds_v_offset.$ds_blur.$ds_color.');-webkit-filter:drop-shadow('.$ds_h_offset.$ds_v_offset.$ds_blur.$ds_color.')';
				} elseif ($val = Configuration::get('MSM'.$prefix.strtoupper(self::$filter[$mode])))
					$filter = 'filter:'.self::$filter[$mode].'('.$val.');-webkit-filter:'.self::$filter[$mode].'('.$val.')';
			}
			$id = $filter_c['id'][$i];
			if ($filter)
				$css .= '#'.$id.'{'.$filter.'}';
		}
		// e (top header, center header, bottom header, top footer, center footer, bottom footer) / s (product block)
		$pro_bck_font = '';
		$pro_bck_border = $pro_bck_border_radius = $pro_bck_bs = '';
		$pro_bck_style = '.product-miniature{';
		$pro_bck_hover = '.product-miniature:hover{';
		if ($pro_bck_font_variants = Configuration::get('MSM_PRO_BCK_FONT')) {
			preg_match_all('/^([^:]+):?(\d*)([a-z]*)$/', $pro_bck_font_variants, $pro_bck_font_arr);
			$pro_bck_font_name = ($pro_bck_font_arr[1][0] != 'inherit') ? 'font-family:'.$pro_bck_font_arr[1][0].';' : '';
			$pro_bck_font_wt = $pro_bck_font_arr[2][0] ? 'font-weight:'.$pro_bck_font_arr[2][0].';' : '';
			$pro_bck_font_style = $pro_bck_font_arr[3][0] ? 'font-style:'.$pro_bck_font_arr[3][0].';' : '';
			$pro_bck_font = $pro_bck_font_name.$pro_bck_font_wt.$pro_bck_font_style;
		}
		$pro_bck_font_color = ($pro_bck_font_color = Configuration::get('MSM_PRO_BCK_FONT_COLOR')) ? 'color:'.$pro_bck_font_color.';' : '';
		$pro_bck_font_size = ($pro_bck_font_size = Configuration::get('MSM_PRO_BCK_FONT_SIZE')) ? 'font-size:'.$pro_bck_font_size.'px;' : '';
		$pro_bck_font_trans = ($pro_bck_font_trans = Configuration::get('MSM_PRO_BCK_FONT_TRANS')) ? 'text-transform:'.self::$textTransform[$pro_bck_font_trans]['name'].';' : '';
		if (!Configuration::get('MSM_CIN_PRO_BCK_BORDER') && $bw = Configuration::get('MSM_PRO_BCK_BORDER_WIDTH')) {
			$pro_bck_border = 'border:'.$bw.'px';
			$pro_bck_border .= Configuration::get('MSM_PRO_BCK_BORDER_STYLE') ? ' '.self::$bStyle[Configuration::get('MSM_PRO_BCK_BORDER_STYLE')] : '';
			$pro_bck_border .= Configuration::get('MSM_PRO_BCK_BORDER_COLOR') ? ' '.Configuration::get('MSM_PRO_BCK_BORDER_COLOR').';' : '';
		} elseif (Configuration::get('MSM_CIN_PRO_BCK_BORDER')) {
			$BTW = ($BTW = Configuration::get('MSM_PRO_BCK_BORDER_TOP_WIDTH')) ? $BTW.'px' : '0';
			$BRW = ($BRW = Configuration::get('MSM_PRO_BCK_BORDER_RIGHT_WIDTH')) ? ' '.$BRW.'px' : ' 0';
			$BBW = ($BBW = Configuration::get('MSM_PRO_BCK_BORDER_BOTTOM_WIDTH')) ? ' '.$BBW.'px' : ' 0';
			$BLW = ($BLW = Configuration::get('MSM_PRO_BCK_BORDER_LEFT_WIDTH')) ? ' '.$BLW.'px' : ' 0';
			$pro_bck_border = 'border-width:'.$BTW.$BRW.$BBW.$BLW.';';
			$BTS = ($BTS = Configuration::get('MSM_PRO_BCK_BORDER_TOP_STYLE')) ? self::$bStyle[$BTS] : 'none';
			$BRS = ($BRS = Configuration::get('MSM_PRO_BCK_BORDER_RIGHT_STYLE')) ? ' '.self::$bStyle[$BRS] : ' none';
			$BBS = ($BBS = Configuration::get('MSM_PRO_BCK_BORDER_BOTTOM_STYLE')) ? ' '.self::$bStyle[$BBS] : ' none';
			$BLS = ($BLS = Configuration::get('MSM_PRO_BCK_BORDER_LEFT_STYLE')) ? ' '.self::$bStyle[$BLS] : ' none';
			$pro_bck_border .= 'border-style:'.$BTS.$BRS.$BBS.$BLS.';';
			$BTC = ($BTC = Configuration::get('MSM_PRO_BCK_BORDER_TOP_COLOR')) ? $BTC : 'transparent';
			$BRC = ($BRC = Configuration::get('MSM_PRO_BCK_BORDER_RIGHT_COLOR')) ? ' '.$BRC : ' transparent';
			$BBC = ($BBC = Configuration::get('MSM_PRO_BCK_BORDER_BOTTOM_COLOR')) ? ' '.$BBC : ' transparent';
			$BLC = ($BLC = Configuration::get('MSM_PRO_BCK_BORDER_LEFT_COLOR')) ? ' '.$BLC : ' transparent';
			$pro_bck_border .= 'border-color:'.$BTC.$BRC.$BBC.$BLC.';';
		}
		$border_pro_bck = (int)Configuration::get('MSM_BORDER_PRO_BCK');
		if ($pro_bck_border) {
			if ($border_pro_bck == 0)
				$pro_bck_hover .= $pro_bck_border;
			elseif ($border_pro_bck == 1) {
				$pro_bck_style .= $pro_bck_border;
				$pro_bck_hover .= 'border:none;';
			} elseif ($border_pro_bck == 2)
				$pro_bck_style .= $pro_bck_border;
		}
		if (!Configuration::get('MSM_CIN_PRO_BCK_BORDER_RADIUS') && $br = Configuration::get('MSM_PRO_BCK_BORDER_RADIUS'))
			$pro_bck_border_radius = 'border-radius:'.$br.'px;';
		elseif (Configuration::get('MSM_CIN_PRO_BCK_BORDER_RADIUS')) {
			$BTLR = ($BTLR = Configuration::get('MSM_PRO_BCK_BORDER_TOP_LEFT_RADIUS')) ? $BTLR.'px' : '0';
			$BTRR = ($BTRR = Configuration::get('MSM_PRO_BCK_BORDER_TOP_RIGHT_RADIUS')) ? ' '.$BTRR.'px' : ' 0';
			$BBRR = ($BBRR = Configuration::get('MSM_PRO_BCK_BORDER_BOTTOM_RIGHT_RADIUS')) ? ' '.$BBRR.'px' : ' 0';
			$BBLR = ($BBLR = Configuration::get('MSM_PRO_BCK_BORDER_BOTTOM_LEFT_RADIUS')) ? ' '.$BBLR.'px' : ' 0';
			$pro_bck_border_radius = 'border-radius:'.$BTLR.$BTRR.$BBRR.$BBLR.';';
		}
		$border_radius_pro_bck = (int)Configuration::get('MSM_BORDER_RADIUS_PRO_BCK');
		if ($pro_bck_border_radius) {
			if ($border_radius_pro_bck == 0)
				$pro_bck_hover .= $pro_bck_border_radius;
			elseif ($border_radius_pro_bck == 1) {
				$pro_bck_style .= $pro_bck_border_radius;
				$pro_bck_hover .= 'border-radius:none;';
			} elseif ($border_radius_pro_bck == 2)
				$pro_bck_style .= $pro_bck_border_radius;
		}
		$bs_h_offset = Configuration::get('MSM_PRO_BCK_BS_H_OFFSET');
		$bs_v_offset = Configuration::get('MSM_PRO_BCK_BS_V_OFFSET');
		if ($bs_h_offset !== '' && $bs_v_offset !== '') {
			$bs_inset = ($bs_inset = Configuration::get('MSM_PRO_BCK_BS_INSET')) ? 'inset ' : '';
			$bs_h_offset = $bs_h_offset.'px';
			$bs_v_offset = ' '.$bs_v_offset.'px';
			$bs_blur = ($bs_blur = Configuration::get('MSM_PRO_BCK_BS_BLUR')) ? ' '.$bs_blur.'px' : '';
			$bs_spread = ($bs_spread = Configuration::get('MSM_PRO_BCK_BS_SPREAD')) ? ' '.$bs_spread.'px' : '';
			$bs_color = ($bs_color = Configuration::get('MSM_PRO_BCK_BS_COLOR')) ? ' '.$bs_color : '';
			$pro_bck_bs = 'box-shadow:'.$bs_inset.$bs_h_offset.$bs_v_offset.$bs_blur.$bs_spread.$bs_color.';';
		}
		$sh_pro_bck = (int)Configuration::get('MSM_SH_PRO_BCK');
		if ($pro_bck_bs) {
			if ($sh_pro_bck == 0)
				$pro_bck_hover .= $pro_bck_bs;
			elseif ($sh_pro_bck == 1) {
				$pro_bck_style .= $pro_bck_bs;
				$pro_bck_hover .= 'box-shadow:none;';
			} elseif ($sh_pro_bck == 2)
				$pro_bck_style .= $pro_bck_bs;
		}
		$pro_bck_transition = ($pro_bck_transition = Configuration::get('MSM_PRO_BCK_TRANSITION')) ? 'transition:'.$pro_bck_transition.'s;' : '';
		$pro_bck_style .= $pro_bck_transition.'}';
		$pro_bck_hover .= '}';
		if ($pro_bck_style != '.product-miniature{}')
			$css .= $pro_bck_style;
		if ($pro_bck_hover != '.product-miniature:hover{}')
			$css .= $pro_bck_hover;
		$css .= '.product-miniature .product-name{'.$pro_bck_font.$pro_bck_font_color.$pro_bck_font_size.$pro_bck_font_trans.'}';
		// e (product block) / s (old price)
		$old_price_size = ($old_price_size = Configuration::get('MSM_OLD_PRICE_FONT_SIZE')) ? 'font-size:'.$old_price_size.'px;' : '';
		$old_price_color = ($old_price_color = Configuration::get('MSM_OLD_PRICE_COLOR')) ? 'color:'.$old_price_color.';' : '';
		if ($old_price_size || $old_price_color)
			$css .= '.regular-price{'.$old_price_size.$old_price_color.'}';
		// e (old price) / s (body font)
		$body_color = ($body_color = Configuration::get('MSM_BODY_COLOR')) ? 'color:'.$body_color.';' : '';
		if ($body_font_variants = Configuration::get('MSM_BODY_FONT')) {
			preg_match_all('/^([^:]+):?(\d*)([a-z]*)$/', $body_font_variants, $body_font_arr);
			$body_font_name = ($body_font_arr[1][0] != 'inherit') ? 'font-family:'.$body_font_arr[1][0].';' : '';
			$body_font_wt = $body_font_arr[2][0] ? 'font-weight:'.$body_font_arr[2][0].';' : '';
			$body_font_style = $body_font_arr[3][0] ? 'font-style:'.$body_font_arr[3][0].';' : '';
			$body_font = $body_font_name.$body_font_wt.$body_font_style;
		}
		$body_size = ($body_size = Configuration::get('MSM_BODY_FONT_SIZE')) ? 'font-size:'.$body_size.'px;' : '';
		if ($body_color || $body_font || $body_size)
			$css .= 'body{'.$body_color.$body_font.$body_size.'}';
		// e (body font) / s (link color and link hover color)
		if ($link_color = Configuration::get('MSM_LINK_COLOR'))
			$css .= 'a{'.$link_color.'}';
		if ($link_hover_color = Configuration::get('MSM_LINK_HOVER_COLOR'))
			$css .= 'a:hover{'.$link_hover_color.'}';
		// e (link color and link hover color) / s (custom css, custom js)
		if (Configuration::get('MSM_CUSTOM_CSS'))
			$css .= html_entity_decode(Configuration::get('MSM_CUSTOM_CSS'));
		if (Configuration::get('MSM_CUSTOM_JS')) {
			$jsFile = $this->local_path.'views/js/customer-s'.$id_shop.'.js';
			if (!file_put_contents($jsFile, Configuration::get('MSM_CUSTOM_JS')))
				die ('cant\' write file "'.$jsFile.'"');
		}
		// e (custom css, custom js)

		if (Shop::getContext() == Shop::CONTEXT_SHOP) {
			$cssFile = $this->local_path.'views/css/customer-s'.(int)$this->context->shop->getContextShopID().'.css';
			if (!file_put_contents($cssFile, $css))
				die ('can\'t write file "'.$cssFile.'"');
		}
	}
	// s init
	public function initFront()
	{
		$id_shop = (int)Shop::getContextShopID();
		$vals = array(
			'smarty_val' => array(),
			'js_val' => array()
		);
		$mobile_detect = $this->context->getMobileDetect();
        $mobile_device = $mobile_detect->isMobile() || $mobile_detect->isTablet();
		$vals['smarty_val'] = array(
			'ps_version' => _PS_VERSION_,
			'theme_version' => $this->version,
			'is_mobile_device' => $mobile_device,
			'is_rtl' => (int)$this->context->language->is_rtl,
			'currency_iso_code' => $this->context->currency->iso_code,
			'lang_iso_code' => $this->context->language->iso_code,
		);
		foreach ($this->defaults as $k => $v) {
			if (isset($v['smarty_val']))
				$vals['smarty_val'][$k] = Configuration::get('MSM_'.strtoupper($k));
			if (isset($v['js_val']))
				$vals['js_val'][$k] = Configuration::get('MSM_'.strtoupper($k));
		}

		$payment_icon_src = $mobile_logo_src = $retina_logo_src = '';
		if ($icon_src = Configuration::get('MSM_PAYMENT_ICON')) {
			$payment_icon_src = ($icon_src != self::$payment_icon ? _THEME_PROD_PIC_DIR_.$icon_src : $this->_path.$icon_src);
			$payment_icon_src = $this->context->link->getMediaLink($payment_icon_src);
		}
		if ($logo_src = Configuration::get('MSM_MOBILE_LOGO'))
			$mobile_logo_src = $this->context->link->getMediaLink(_THEME_PROD_PIC_DIR_.$logo_src);
		if ($logo_src = Configuration::get('MSM_RETINA_LOGO'))
			$retina_logo_src = $this->context->link->getMediaLink(_THEME_PROD_PIC_DIR_.$logo_src);

		$extra_smarty_val = array(
			'logo_img_width' => Configuration::get('SHOP_LOGO_WIDTH'),
			'logo_img_height' => Configuration::get('SHOP_LOGO_HEIGHT'),
			'mobile_logo_src' => $mobile_logo_src,
			'retina_logo_src' => $retina_logo_src,
			'head_code' =>  html_entity_decode(Configuration::get('MSM_HEAD_CODE')),
			'tracking_code' =>  html_entity_decode(Configuration::get('MSM_TRACKING_CODE')),
		);
		$vals['smarty_val'] = array_merge($extra_smarty_val, $vals['smarty_val']);

		if (file_exists($this->local_path.'views/js/customer-s'.$id_shop.'.js')) {
			$custom_js_path = $this->_path.'views/js/customer-s'.$this->context->shop->getContextShopID().'.js?'.rand(1000, 9999);
			$vals['smarty_val']['custom_js'] = context::getContext()->link->protocol_content.Tools::getMediaServer($custom_js_path).$custom_js_path;
		}

		$vals['smarty_val']['custom_css'] = array();
		$vals['smarty_val']['custom_css_media'] = 'all';
		if (Shop::getContext() == Shop::CONTEXT_SHOP) {
			$custom_css_path = $this->_path.'views/css/customer-s'.$this->context->shop->getContextShopID().'.css?'.rand(1000, 9999);
            $vals['smarty_val']['custom_css'][] = context::getContext()->link->protocol_content.Tools::getMediaServer($custom_css_path).$custom_css_path;
		}

		return $vals;
	}

	public function initForm()
	{
		$helper = new HelperForm();
		$helper->show_toolbar = false;
        $helper->module = $this;
		$helper->table = $this->table;
		$lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
		$helper->default_form_language = $lang->id;
		$helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;

		$helper->identifier = $this->identifier;
		$helper->submit_action = 'savemsthemeeditor';
		$helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->tpl_vars = array(
			'fields_value' => $this->getConfigFieldsValues(),
			'languages' => $this->context->controller->getLanguages(),
			'id_language' => $this->context->language->id
		);

		return $helper;
	}

	public function initTab()
	{
		$html = '<div id="nav-bar"><div id="tabMenu" class="owl-carousel">';
		foreach($this->tabs as $t) {
			$html .= '<a href="javascript:;" title="'.$t['name'].'" data-fieldset="'.$t['id'].'">'.$t['name'].'</a>';
		}
		$html .= '</div><div id="dots-nav-bar"></div></div>';
		
		return $html;
	}
	// e init
	private function CIN_IIE($m)
	{
		$CIN_IIE = array();
		if ($m == 'CIN')
			foreach ($this->defaults as $k => $v) {
				if (strpos($k, 'cin_') === 0)
					$CIN_IIE[$k] = Configuration::get('MSM_'.strtoupper($k));
			}
		if ($m == 'IIE')
			foreach ($this->defaults as $k => $v) {
				if (strpos($k, 'iie_') === 0)
					$CIN_IIE[$k] = Configuration::get('MSM_'.strtoupper($k));
			}
		return $CIN_IIE;
	}
}
