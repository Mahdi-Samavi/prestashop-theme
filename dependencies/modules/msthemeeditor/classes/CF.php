<?php

require_once(dirname(__FILE__).'/../../../config/config.inc.php');

class CF
{
	public static $fonts = array();
    private static $BDir = _PS_MODULE_DIR_.'msthemeeditor/views/';

	public function __construct()
	{
		self::$fonts = include(dirname(__FILE__).'/fonts.php');
		$this->jsonFonts();
	}

	public function jsonFonts()
	{
		if (file_exists(dirname(__FILE__).'/../views/js/jsonFonts.js'))
			return false;
		$system_fonts = 'var system_fonts = \''.json_encode(self::$fonts['system']).'\';';
		$google_fonts = 'var google_fonts = \''.json_encode(self::$fonts['google']).'\';';
		file_put_contents(dirname(__FILE__).'/../views/js/jsonFonts.js', $system_fonts.$google_fonts);
	}

	public static function initFonts($font_list, &$fields_form)
	{
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
					$fields_form[$k]['form']['input'][$v]['options']['query'][] = array(
						'id' => $font.':'.($val == 'regular' ? '400' : $val),
						'name' => $val,
					);
			} else {
				$fields_form[$k]['form']['input'][$v]['options']['query'] = array(
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

	public static function fontOptions()
	{
		$system = $google = $custom = array();
		foreach (self::$fonts['system'] as $v)
			$system[] = array('id' => $v, 'name' => $v);
		foreach (self::$fonts['google'] as $v)
			$google[] = array('id' => $v['family'], 'name' => $v['family']);
		$option = array(
			array('name' => Context::getContext()->getTranslator()->trans('System Web Fonts', array(), 'Modules.Msthemeeditor.Admin'), 'query' => $system),
			array('name' => Context::getContext()->getTranslator()->trans('Google Web Fonts', array(), 'Modules.Msthemeeditor.Admin'), 'query' => $google),
		);
		if ($fonts = Configuration::get('MSM_FONTS_IMPORTED')) {
			foreach (explode(',', $fonts) as $v)
				$custom[] = array('id' => $v, 'name' => $v);
			array_unshift($option, array('name' => Context::getContext()->getTranslator()->trans('Imported Fonts', array(), 'Modules.Msthemeeditor.Admin'), 'query' => $custom));
		}
		return $option;
	}

	public static function downloadAndSetFont($fonts, $module)
	{
		if (!Configuration::get('MSM_DOWNLOAD_FONT'))
			return true;
		$cssFonts = fopen(_PS_MODULE_DIR_.'msthemeeditor/views/css/fonts.css', 'w');
        $FDir = self::$BDir.'fonts/'.$module.'/';
		$FN = array();
		foreach ($fonts as $v) {
			$font = Tools::getValue($v);
			$FN[] = substr($font, 0, strpos($font, ':'));
		}
		$FN = array_unique($FN);
		if ($difference = array_diff($FN, scandir($FDir)))
			self::clearFont($difference);
        if (!file_exists($FDir))
            mkdir($FDir);
		foreach ($FN as $v) {
			if (!isset($v) || !$v || $v == 'inherit' || in_array($v, self::$fonts['system']))
				continue;
			$dir = $FDir.$v;
			if (!file_exists($dir)) {
				$zip = $FDir.$v.'.zip';
				self::getZip('https://fonts.google.com/download?family='.rawurlencode($v), $zip);
				Tools::ZipExtract($zip, $dir);
				Tools::deleteFile($zip);
			}
		}
        foreach (glob(self::$BDir.'fonts/*/', GLOB_ONLYDIR) as $v)
            foreach (scandir($v) as $vv)
                if ($vv != '.' && $vv != '..')
                    fwrite($cssFonts, self::includeFonts($vv, $v.$vv));
		fclose($cssFonts);
        return true;
	}
	
	public static function clearFont($difference)
	{
		//var_dump($difference);
	}

	public static function getZip($url, $file)
	{
		$zip = fopen($file, 'w');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($ch, CURLOPT_FILE, $zip);
		$res = curl_exec($ch);
		if (!$res)
			die(curl_error($ch));
		curl_close($ch);
	}

	public static function includeFonts($font, $dir)
	{
        $fontFace = "@font-face {\n\tfont-family: '$font';\n\tsrc:";
		foreach (scandir($dir) as $v) {
			if ($v != '.' && $v != '..' && !strpos($v, '.txt')) {
				$fontFace .= " url('".str_replace(self::$BDir, '../', $dir)."/$v'),\n\t\t";
			}
		}
		return rtrim($fontFace, ",\n\t\t").";\n}\n";
	}

    public static function checkFont($name, $FIs)
    {
        if (
            !$name ||
            in_array($name, explode(',', $FIs)) ||
            in_array($name, self::$fonts['system']) ||
            array_key_exists(str_replace(' ', '_', ucwords($name)), self::$fonts['google'])
        )
            return false;
        return true;
    }

	public static function getAnimation()
	{
		$option = array();
		$anim = include_once(dirname(__FILE__).'/animation.php');
		foreach ($anim as $k => $v)
			$option[] = array('name' => Context::getContext()->getTranslator()->trans($k, array(), 'Modules.Msthemeeditor.Admin'), 'query' => $v);

		return $option;
	}
}
