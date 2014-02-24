<?php
/*
Section: Flyp
Author: TourKick (Clifford P)
Description: A PageLines DMS section that flips / turns over content (front and back). <a href="http://www.pagelinestheme.com/flyp-section?utm_source=pagelines&utm_medium=section&utm_content=descriptionlink&utm_campaign=flyp_section" target="_blank">Flyp</a> is a <a href="http://b.tourkick.com/myplshop" target="_blank">TourKick (Clifford P) product</a>.
Class Name: Flyp
Version: 1.0
Cloning: true
PageLines: true
v3: true
Filter: component
*/


/*
Notes:
- card-specific interval/timeout wording and coding
- text domain
- proper license
- firefox img max-width not working (did not test IE)
- change 'check' to 'select' because of bug in v1.1 and prior
- cannot do border-radius:50%; (circle effect) because cards are not square (i.e. effect turns them into ovals instead of circles). Can't set a pixel width because then columns won't work. But could add border-radius:1000px; or something like that if you really want ovals.
- used 'text' instead of 'text_small' or 'small_text' because of https://github.com/pagelines/DMS/issues/668
*/

class Flyp extends PageLinesSection {

	function section_persistent() {

	// This section only works with DMS v1.1 or later
		$themeversionnumber = get_theme_mod( 'pagelines_version' ); // Works in both DMS and Framework
		$dmsnometapanelversion = '1.1'; // The first DMS Version that has the accordion option type

		if( function_exists('pl_has_editor')
			&& pl_has_editor()
			&& $themeversionnumber >= $dmsnometapanelversion) {	} else { return; }
	}

	function section_scripts(){
		// flipCard.js
		wp_enqueue_script('flyp', $this->base_url.'/flyp.js', array('jquery'), '1.0', true);
	}


	function section_head(){
		$font = $this->opt('flyp_font');
		if( $font ) {
			$cloneid = $this->get_the_id();
			echo load_custom_font( $font, "#flyp$cloneid" );
		}
	}



	function section_opts(){


		$colorpresets = array( // ALL HEX's LOWER-CASE
			pl_hashify(pl_setting('bodybg'))	=> array('name' => __('PL Background Base Setting', $this->id) ),
			pl_hashify(pl_setting('text_primary'))	=> array('name' => __('PL Text Base Setting', $this->id) ),
			pl_hashify(pl_setting('linkcolor'))	=> array('name' => __('PL Link Base Setting', $this->id) ),
			'#fbfbfb'	=> array('name' => __('Light Gray', $this->id) ),
			'#bfbfbf'	=> array('name' => __('Medium Gray', $this->id) ),
			'#1abc9c'	=> array('name' => __('* Turquoise', $this->id) ),
			'#16a085'	=> array('name' => __('* Green Sea', $this->id) ),
			'#40d47e'	=> array('name' => __('* Emerald', $this->id) ),
			'#27ae60'	=> array('name' => __('* Nephritis', $this->id) ),
			'#3498db'	=> array('name' => __('* Peter River', $this->id) ),
			'#2980b9'	=> array('name' => __('* Belize Hole', $this->id) ),
			'#9b59b6'	=> array('name' => __('* Amethyst', $this->id) ),
			'#8e44ad'	=> array('name' => __('* Wisteria', $this->id) ),
			'#34495e'	=> array('name' => __('* Wet Asphalt', $this->id) ),
			'#2c3e50'	=> array('name' => __('* Midnight Blue', $this->id) ),
			'#f1c40f'	=> array('name' => __('* Sun Flower', $this->id) ),
			'#f39c12'	=> array('name' => __('* Orange', $this->id) ),
			'#e67e22'	=> array('name' => __('* Carrot', $this->id) ),
			'#d35400'	=> array('name' => __('* Pumpkin', $this->id) ),
			'#e74c3c'	=> array('name' => __('* Alizarin', $this->id) ),
			'#c0392b'	=> array('name' => __('* Pomegranate', $this->id) ),
			'#ecf0f1'	=> array('name' => __('* Clouds', $this->id) ),
			'#bdc3c7'	=> array('name' => __('* Silver', $this->id) ),
			'#95a5a6'	=> array('name' => __('* Concrete', $this->id) ),
			'#7f8c8d'	=> array('name' => __('* Asbestos', $this->id) ),
			'#791869'	=> array('name' => __('Plum', $this->id) ),
			'#c23b3d'	=> array('name' => __('Red', $this->id) ),
			'#0c5cea'	=> array('name' => __('Blue', $this->id) ),
			'#00aff0'	=> array('name' => __('Light Blue', $this->id) ),
			'#88b500'	=> array('name' => __('Lime', $this->id) ),
			'#cf3f20'	=> array('name' => __('Orangey', $this->id) ),
			'#f27a00'	=> array('name' => __('Yellowy-Orange', $this->id) ),
		);


		$options = array();

		$options[] = array(
			'key'		=> 'flyp_config',
			'type'		=> 'multi',
			'col'		=> 1, //left side
			'title'		=> __('Flyp Container Settings', $this->id),
			'help'		=> '<strong><a href="http://www.pagelinestheme.com/flyp-section?utm_source=pagelines&utm_medium=section&utm_content=help&utm_campaign=flyp_section" target="_blank">Flyp Section Helpful Tips</a></strong>',
			'opts'	=> array(
				array(
					'key'	=> 'flyp_type',
					'type' 	=> 'select',
					//'default' => 'flyp_over',
					'label'	=> __('Flyp Effect/Type<br/>If you chose <span style="color: darkred;">Button</span>, you will need to manually add something like<br/><span style="color: darkred;">[pl_button]Click to Flip[/pl_button]</span> (see <a href="http://docs.pagelines.com/tutorials/shortcodes" target="_blank">PL Shortcodes</a>)<br/>to both the front and back of each card.', $this->id),
					'opts' => array(
						'flyp_over'		=> array('name' => __('Over (Default)', $this->id) ),
						'flyp_click'	=> array('name' => __('Click', $this->id) ),
						'flyp_button'	=> array('name' => __('Button', $this->id) ),
						'flyp_auto'		=> array('name' => __('Auto', $this->id) ),
					)
				),
				array(
					'key'	=> 'flyp_direction',
					'type' 	=> 'select',
					'default' => 'right',
					'label'	=> __('Flyp Direction', $this->id),
					'opts' => array(
						'random'	=> array('name' => __('Randomized', $this->id) ),
						'right'		=> array('name' => __('Right (Default)', $this->id) ),
						'left'		=> array('name' => __('Left', $this->id) ),
						'top'		=> array('name' => __('Top', $this->id) ),
						'bottom'	=> array('name' => __('Bottom', $this->id) ),
					)
				),
				array(
					'key'		=> 'flyp_auto_interval',
					'type'		=> 'text',
					//'default'	=> '3000',
					'label' 	=> __('Auto Flip Interval (milliseconds)<br/>Set time for a card to flip automatically back and front<br/>Default is 3000 (3 seconds)', $this->id)
				),
				array(
					'key'		=> 'flyp_auto_timeout',
					'type'		=> 'text',
					//'default'	=> '2000',
					'label' 	=> __('Auto Flip Timeout (milliseconds)<br/>Set time a card will flip back after being clicked and must be less than Auto Flip Interval<br/>Cards do not flip when mouse is hovering<br/>Default is 2000 (2 seconds)', $this->id)
				),
/*
				array(
					'key'	=> 'flyp_float',
					'type' 	=> 'select',
					//'default' => 'left',
					'label'	=> __('Flyp Float', $this->id),
					'opts' => array(
						'left'		=> array('name' => __('Left (Default)', $this->id) ),
						'right'		=> array('name' => __('Right', $this->id) ),
						'none'		=> array('name' => __('None', $this->id) ),
					)
				),
*/
				array(
					'key'			=> 'flyp_cols_config',
					'type' 			=> 'count_select',
					'count_start'	=> 1,
					'count_number'	=> 12,
					'default'		=> '4',
					'label' 	=> __( 'Number of Columns Wide Per Card (12 column grid)', $this->id ),
				),
				array(
					'key'		=> 'flyp_height',
					'type'		=> 'text',
					//'default'	=> '200px',
					'label' 	=> __('Height of Flyp Cards (Default: "200") (pixels)', $this->id)
				),
				array(
					'key'		=> 'flyp_padding_within_top',
					//'default'	=> '',
					'type'		=> 'text',
					'label' 	=> __('Flyp Card Interior Padding - TOP (Default: "0") (pixels)', $this->id)
				),
				array(
					'key'		=> 'flyp_padding_within_right',
					//'default'	=> '',
					'type'		=> 'text',
					'label' 	=> __('Flyp Card Interior Padding - RIGHT (Default: Top\'s) (pixels)', $this->id)
				),
				array(
					'key'		=> 'flyp_padding_within_bottom',
					//'default'	=> '',
					'type'		=> 'text',
					'label' 	=> __('Flyp Card Interior Padding - BOTTOM (Default: Top\'s) (pixels)', $this->id)
				),
				array(
					'key'		=> 'flyp_padding_within_left',
					//'default'	=> '',
					'type'		=> 'text',
					'label' 	=> __('Flyp Card Interior Padding - LEFT (Default: Top\'s) (pixels)', $this->id)
				),
				array(
					'key'	=> 'flyp_font',
					'type'	=> 'fonts',
					'label'	=> __('Flyp Cards Font', $this->id)
				),
				array(
					'key'	=> 'flyp_textalign',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Flyp <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/text-align" target="_blank">text-align</a> (Default: Center)', $this->id),
					'opts' => array(
						'center'	=> array('name' => __('Center (Default)', $this->id) ),
						'left'		=> array('name' => __('Left', $this->id) ),
						'right'		=> array('name' => __('Right', $this->id) ),
						'justify'	=> array('name' => __('Justify', $this->id) ),
					)
				),
				array(
					'key'	=> 'flyp_verticalalign',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Flyp <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/vertical-align" target="_blank">vertical-align</a> (Default: Middle)', $this->id),
					'opts' => array(
						'middle'	=> array('name' => __('Middle (Default)', $this->id) ),
						'top'		=> array('name' => __('Top', $this->id) ),
						'bottom'	=> array('name' => __('Bottom', $this->id) ),
					)
				),
				array(
					'key'	=> 'flyp_shadow',
					'type' 	=> 'select',
					//'default' => 'shadow',
					'label'	=> __('Card Drop Shadow (Default: ON)', $this->id),
					'opts' => array(
						'shadow'	=> array('name' => __('Shadow ON (Default)', $this->id) ),
						'noshadow'	=> array('name' => __('Shadow OFF', $this->id) ),
					)
				),
				array(
					'key'	=> 'flyp_color_text',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Flyp Text Color Preset<br/>Default: "PL Text Base Setting"<br/>(* are from <a href="http://flatuicolors.com/" target="_blank">FlatUIcolors.com</a>)', $this->id),
					'opts' => $colorpresets,
				),
				array(
					'key'	=> 'flyp_color_text_picker',
					'type' 	=> 'color',
					'default' => '',
					'label'	=> __('Flyp Text Color Picker<br/>(will override preset if both are set)', $this->id),
				),
				array(
					'key'	=> 'flyp_color_bg',
					'type' 	=> 'select',
					//'default' => '#fbfbfb',
					'label'	=> __('Flyp Background Color Preset<br/>Suggestion: Light Gray<br/>(* are from <a href="http://flatuicolors.com/" target="_blank">FlatUIcolors.com</a>)', $this->id),
					'opts' => $colorpresets,
				),
				array(
					'key'	=> 'flyp_color_bg_picker',
					'type' 	=> 'color',
					'default' => '',
					'label'	=> __('Flyp Background Color Picker<br/>(will override preset if both are set)', $this->id),
				),
				array(
					'key'	=> 'flyp_color_border',
					'type' 	=> 'select',
					//'default' => '#bfbfbf',
					'label'	=> __('Flyp Border Color Preset<br/>Suggestion: Medium Gray<br/>(* are from <a href="http://flatuicolors.com/" target="_blank">FlatUIcolors.com</a>)', $this->id),
					'opts' => $colorpresets,
				),
				array(
					'key'	=> 'flyp_color_border_picker',
					'type' 	=> 'color',
					'default' => '',
					'label'	=> __('Flyp Border Color Picker<br/>(will override preset if both are set)', $this->id),
				),
				array(
					'key'		=> 'flyp_border_width',
					//'default'	=> '1',
					'type'		=> 'text',
					'label' 	=> __('Flyp Card Border Width (Default: "1") (pixels)', $this->id)
				),
				array(
					'key'		=> 'flyp_border_radius',
					//'default'	=> '2',
					'type'		=> 'text',
					'label' 	=> __('Flyp Card Border Radius / Rounded Corners (Default: "2") (pixels)', $this->id)
				),

			) //opts
		); //options



		$options[] = array(
			'key'		=> 'flyp_array',
	    	'type'		=> 'accordion',
	    	//'opts_cnt'	=> 3, //number of accordions to display at first
			'col'		=> 2, //right side
			'title'		=> __('Flyp Cards', $this->id),
			'post_type'	=> __('Flyp Card', $this->id), //what shows up for each accordion option -- does not actually register a custom post type and therefore ok to have spaces
			'opts'	=> array(
				array(
					'key'	=> 'flyp_front',
					'type'	=> 'textarea',
					'label'	=> __('Card Front Content<br/><span style="color: darkred;">It is recommended to NOT use [pl_video] with Vimeo on the FRONT of cards.</style> If you do, it is recommended to turn OFF the max-height constraint for the side of a card that you use [pl_video] with Vimeo, otherwise going full-screen will not work.', $this->id)
				),
/*
				array(
					'key'	=> 'flyp_front_font',
					'type'	=> 'fonts',
					'label'	=> __('Card Front Font', $this->id)
				),
*/
				array(
					'key'	=> 'flyp_front_textalign',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Card Front <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/text-align" target="_blank">text-align</a> Override', $this->id),
					'opts' => array(
						'center'	=> array('name' => __('Center', $this->id) ),
						'left'		=> array('name' => __('Left', $this->id) ),
						'right'		=> array('name' => __('Right', $this->id) ),
						'justify'	=> array('name' => __('Justify', $this->id) ),
					)
				),
				array(
					'key'	=> 'flyp_front_verticalalign',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Card Front <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/vertical-align" target="_blank">vertical-align</a> Override', $this->id),
					'opts' => array(
						'middle'	=> array('name' => __('Middle', $this->id) ),
						'top'		=> array('name' => __('Top', $this->id) ),
						'bottom'	=> array('name' => __('Bottom', $this->id) ),
					)
				),
				array(
					'key'	=> 'flyp_front_shadow',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Card Front Drop Shadow Override', $this->id),
					'opts' => array(
						'shadow'	=> array('name' => __('Shadow ON', $this->id) ),
						'noshadow'	=> array('name' => __('Shadow OFF', $this->id) ),
					)
				),
				array(
					'key'	=> 'flyp_front_disable_maxheight',
					'type'	=> 'check',
					'label'	=> __('(Advanced) Front: disable automatically adding style="max-height:____;" to img and iframe', $this->id)
				),
				array(
					'key'	=> 'flyp_back',
					'type'	=> 'textarea',
					'label'	=> __('Card Back Content<br/><span style="color: darkred;">If using [pl_video] with Vimeo, it is recommended to turn OFF the max-height constraint, otherwise going full-screen will not work.</span>', $this->id)
				),
/*
				array(
					'key'	=> 'flyp_back_font',
					'type'	=> 'fonts',
					'label'	=> __('Card Back Font', $this->id)
				),
*/
				array(
					'key'	=> 'flyp_back_textalign',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Card Back <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/text-align" target="_blank">text-align</a> Override', $this->id),
					'opts' => array(
						'center'	=> array('name' => __('Center', $this->id) ),
						'left'		=> array('name' => __('Left', $this->id) ),
						'right'		=> array('name' => __('Right', $this->id) ),
						'justify'	=> array('name' => __('Justify', $this->id) ),
					)
				),
				array(
					'key'	=> 'flyp_back_verticalalign',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Card Back <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/vertical-align" target="_blank">vertical-align</a> Override', $this->id),
					'opts' => array(
						'middle'	=> array('name' => __('Middle', $this->id) ),
						'top'		=> array('name' => __('Top', $this->id) ),
						'bottom'	=> array('name' => __('Bottom', $this->id) ),
					)
				),
				array(
					'key'	=> 'flyp_back_shadow',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Card Back Drop Shadow Override', $this->id),
					'opts' => array(
						'shadow'	=> array('name' => __('Shadow ON', $this->id) ),
						'noshadow'	=> array('name' => __('Shadow OFF', $this->id) ),
					)
				),
				array(
					'key'	=> 'flyp_back_disable_maxheight',
					'type'	=> 'check',
					'label'	=> __('(Advanced) Back: disable automatically adding style="max-height:____;" to img and iframe', $this->id)
				),
				array(
					'key'			=> 'flyp_cols',
					'type' 			=> 'count_select',
					'count_start'	=> 1,
					'count_number'	=> 12,
					'default'		=> '4',
					'label' 	=> __( 'Number of Columns Wide Override (12 column grid)', $this->id ),
				),
				array(
					'key'	=> 'flyp_card_direction',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Flyp Direction Override', $this->id),
					'opts' => array(
						'right'		=> array('name' => __('Right', $this->id) ),
						'left'		=> array('name' => __('Left', $this->id) ),
						'top'		=> array('name' => __('Top', $this->id) ),
						'bottom'	=> array('name' => __('Bottom', $this->id) ),
					)
				),
				array(
					'key'		=> 'flyp_card_auto_timeout',
					'type'		=> 'text',
					//'default'	=> '2000',
					'label' 	=> __('Auto Flip Timeout (milliseconds)<br/>Override per card so they auto flip at different intervals and must be less than Auto Flip Interval', $this->id)
				),
				array(
					'key'	=> 'flyp_card_color_text',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Flyp Text Color Preset<br/>Default: "PL Text Base Setting"<br/>(* are from <a href="http://flatuicolors.com/" target="_blank">FlatUIcolors.com</a>)', $this->id),
					'opts' => $colorpresets,
				),
				array(
					'key'	=> 'flyp_card_color_text_picker',
					'type' 	=> 'color',
					'default' => '',
					'label'	=> __('Flyp Text Color Picker<br/>(will override preset if both are set)', $this->id),
				),
				array(
					'key'	=> 'flyp_card_color_bg',
					'type' 	=> 'select',
					//'default' => '#fbfbfb',
					'label'	=> __('Flyp Background Color Preset<br/>(* are from <a href="http://flatuicolors.com/" target="_blank">FlatUIcolors.com</a>)', $this->id),
					'opts' => $colorpresets,
				),
				array(
					'key'	=> 'flyp_card_color_bg_picker',
					'type' 	=> 'color',
					'default' => '',
					'label'	=> __('Flyp Background Color Picker<br/>(will override preset if both are set)', $this->id),
				),
				array(
					'key'	=> 'flyp_card_color_border',
					'type' 	=> 'select',
					//'default' => '#bfbfbf',
					'label'	=> __('Flyp Border Color Preset<br/>(* are from <a href="http://flatuicolors.com/" target="_blank">FlatUIcolors.com</a>)', $this->id),
					'opts' => $colorpresets,
				),
				array(
					'key'	=> 'flyp_card_color_border_picker',
					'type' 	=> 'color',
					'default' => '',
					'label'	=> __('Flyp Border Color Picker<br/>(will override preset if both are set)', $this->id),
				),
			)
	    );



		return $options;

	}


	function section_template(){
		global $is_chrome, $is_safari;

		// The Cards
		$flyp_array = $this->opt('flyp_array');

		if( !$flyp_array || $flyp_array == 'false' || !is_array($flyp_array) ){
			$flyp_array = array( array(), array(), array() );
		}

		if( is_array($flyp_array) ) {
			$numberofcards = count( $flyp_array ); // number of accordians available for input, not necessarily having input

			//start Flyp Area
			//echo '<div class="flyp_card-container">';

			//start accordions one by one
			$spans = 0;
			$type = ($this->opt('flyp_type')) ? $this->opt('flyp_type') : 'flyp_over';
			$direction = ($this->opt('flyp_direction')) ? $this->opt('flyp_direction') : 'right';
			if($type == 'flyp_auto') {
				$autointerval = ($this->opt('flyp_auto_interval')) ? $this->opt('flyp_auto_interval') : '3000';
					$autointerval = preg_replace("/[^0-9]/","", $autointerval);
				$autotimeout = ($this->opt('flyp_auto_timeout')) ? $this->opt('flyp_auto_timeout') : '2000';
					$autotimeout = preg_replace("/[^0-9]/","", $autotimeout);
				$dataautoflip = " data-autoflip='$autointerval'";
				$datastart = " data-start='$autotimeout'";
			} else {
				$autointerval = '';
				$autotimeout = '';
				$dataautoflip = '';
				$datastart = '';
			}


			$cardstyle = '';

			//$float = ($this->opt('flyp_float')) ? $this->opt('flyp_float') : 'left';
			$colsconfig = ($this->opt('flyp_cols_config')) ? $this->opt('flyp_cols_config') : 4;

			$height = ($this->opt('flyp_height')) ? $this->opt('flyp_height') : 200;
					$height = preg_replace("/[^0-9]/","", $height);

			$paddingtop = ($this->opt('flyp_padding_within_top')) ? $this->opt('flyp_padding_within_top') : 0;
				$paddingtop = preg_replace("/[^0-9]/","", $paddingtop);
			$paddingright = ($this->opt('flyp_padding_within_right')) ? $this->opt('flyp_padding_within_right') : $paddingtop;
				$paddingright = preg_replace("/[^0-9]/","", $paddingright);
			$paddingbottom = ($this->opt('flyp_padding_within_bottom')) ? $this->opt('flyp_padding_within_bottom') : $paddingtop;
				$paddingbottom = preg_replace("/[^0-9]/","", $paddingbottom);
			$paddingleft = ($this->opt('flyp_padding_within_left')) ? $this->opt('flyp_padding_within_left') : $paddingtop;
				$paddingleft = preg_replace("/[^0-9]/","", $paddingleft);



			if( $this->opt('flyp_color_border_picker') ) {
				$colorborder = $this->opt('flyp_color_border_picker');
			} elseif( $this->opt('flyp_color_border') ) {
				$colorborder = $this->opt('flyp_color_border');
			} else {
				$colorborder = '';
			}
				$colorborder = is_array($colorborder) ? array_shift($colorborder) : $colorborder;
				$colorborder = ($colorborder) ? pl_hashify($colorborder) : '';

			$borderwidth = '';
			$borderradius = '';
			if($colorborder) {
				$borderwidth = $this->opt('flyp_border_width') ? $this->opt('flyp_border_width') : 1;
					$borderwidth = preg_replace("/[^0-9]/","", $borderwidth);

				$borderradius = $this->opt('flyp_border_radius') ? $this->opt('flyp_border_radius') : 2;
					$borderradius = preg_replace("/[^0-9]/","", $borderradius);
			}


			$maxcontentheight = $height - $paddingtop - $paddingbottom - $borderwidth - $borderwidth; // make tall images and iframes behave
			$maxcontentheight = $maxcontentheight . 'px';

			$textalign = $this->opt('flyp_textalign') ? $this->opt('flyp_textalign') : '';
			$verticalalign = $this->opt('flyp_verticalalign') ? $this->opt('flyp_verticalalign') : '';

			$shadow = $this->opt('flyp_shadow') ? $this->opt('flyp_shadow') : 'shadow';


			if( $this->opt('flyp_color_text_picker') ) {
				$colortext = $this->opt('flyp_color_text_picker');
			} elseif( $this->opt('flyp_color_text') ) {
				$colortext = $this->opt('flyp_color_text');
			} else {
				$colortext = '';
			}
				$colortext = is_array($colortext) ? array_shift($colortext) : $colortext;
					//array_shift: http://stackoverflow.com/a/6262225
				$colortext = ($colortext) ? pl_hashify($colortext) : '';

			$stylecontainer = sprintf('height: %spx;', $height);
				$stylecontainer .= ($colortext) ? sprintf(' color: %s;', $colortext) : '';



			if( $this->opt('flyp_color_bg_picker') ) {
				$colorbg = $this->opt('flyp_color_bg_picker');
			} elseif( $this->opt('flyp_color_bg') ) {
				$colorbg = $this->opt('flyp_color_bg');
			} else {
				$colorbg = '';
			}
				$colorbg = is_array($colorbg) ? array_shift($colorbg) : $colorbg;
				$colorbg = ($colorbg) ? pl_hashify($colorbg) : '';

			$styleeachcard = sprintf('padding: %spx %spx %spx %spx;', $paddingtop, $paddingright, $paddingbottom, $paddingleft);
				$styleeachcard .= ($colorbg) ? sprintf(' background-color: %s;', $colorbg) : '';
				$styleeachcard .= ($colorborder) ? sprintf(' border-radius: %spx; border: %spx solid %s;', $borderradius, $borderwidth, $colorborder) : '';



			// EACH ACCORDION
			$output = '';
			$count = 1;
			foreach( $flyp_array as $flypitem ){

				$front = pl_array_get( 'flyp_front', $flypitem, 'Flyp Front '. $count);
					$front = do_shortcode($front);

						//override styles for [pl_video] only for chrome and safari -- but then should turn off max-height for Vimeo/HTML5 embeds otherwise full-screen doesn't work
						//just recommend no pl_video (especially no pl_video vimeo) on front of any card
						if( strripos($front, 'class="pl-video ') !== false
						  && ( $is_chrome || $is_safari ) ){
						$front = str_replace('class="pl-video ', 'class="', $front);
						}

/* .chrome, .safari
.flyp_front {
	.pl-video {
		&.youtube {
			padding-top: inherit;
		}
		&.vimeo {
			padding-top: inherit;
		}
		position: inherit;

		iframe, object, embed {
			position: inherit;
		}
	}
}
*/

					if( $type == 'flyp_button' && strripos($front, 'class="btn') !== false ){
						$front = str_replace('class="btn', 'class="fcbutton btn', $front); //add fcbutton class to [pl_button]'s output
					}

					if( pl_array_get('flyp_front_disable_maxheight', $flypitem, '') ) {} else {
						if( strripos($front, '<img ') !== false && strripos($front, 'max-height:') === false ){
							$front = str_replace('"', "'", $front); //replace all double quotes with single quotes
							if( strripos($front, "<img style='") !== false ){
								$front = str_replace("<img style='", "<img style='max-height:$maxcontentheight; ", $front);
							} else {
								$front = str_replace("<img ", "<img style='max-height:$maxcontentheight;'", $front);
							}
						}
						if( strripos($front, '<iframe ') !== false && strripos($front, 'max-height:') === false ){
							$front = str_replace('"', "'", $front); //replace all double quotes with single quotes
							if( strripos($front, "<iframe style='") !== false ){
								$front = str_replace("<iframe style='", "<iframe style='max-height:$maxcontentheight; ", $front);
							} else {
								$front = str_replace("<iframe ", "<iframe style='max-height:$maxcontentheight;'", $front);
							}
						}
					}


				$shadowfront = pl_array_get( 'flyp_front_shadow', $flypitem, $shadow );
					if( $shadowfront == 'noshadow') {
						$shadowfrontclass = ' flyp_noshadow'; //add space
					} else {
						$shadowfrontclass = '';
					}


				$frontstyle = 'style="';
					$textalignfront = pl_array_get( 'flyp_front_textalign', $flypitem, $textalign );
					$verticalalignfront = pl_array_get( 'flyp_front_verticalalign', $flypitem, $verticalalign );
					if( $textalignfront ) {
						$frontstyle .= 'text-align: ' . $textalignfront . ';';
					}
					if( $verticalalignfront ) {
						$frontstyle .= ' vertical-align: ' . $verticalalignfront . ';';
					}
				$frontstyle .= '"';


				$back = pl_array_get( 'flyp_back', $flypitem, 'Flyp Back '. $count);
					$back = do_shortcode($back);

					if( $type == 'flyp_button' && strripos($back, 'class="btn') !== false ){
						$back = str_replace('class="btn', 'class="fcbutton btn', $back); //add fcbutton class to [pl_button]'s output
					}

					if( pl_array_get('flyp_back_disable_maxheight', $flypitem, '') ) {} else {
						if( strripos($back, '<img ') !== false && strripos($back, 'max-height:') === false ){
							$back = str_replace('"', "'", $back); //replace all double quotes with single quotes
							if( strripos($back, "<img style='") !== false ){
								$back = str_replace("<img style='", "<img style='max-height:$maxcontentheight; ", $back);
							} else {
								$back = str_replace("<img ", "<img style='max-height:$maxcontentheight;'", $back);
							}
						}
						if( strripos($back, '<iframe ') !== false && strripos($back, 'max-height:') === false ){
							$back = str_replace('"', "'", $back); //replace all double quotes with single quotes
							if( strripos($back, "<iframe style='") !== false ){
								$back = str_replace("<iframe style='", "<iframe style='max-height:$maxcontentheight; ", $back);
							} else {
								$back = str_replace("<iframe ", "<iframe style='max-height:$maxcontentheight;'", $back);
							}
						}
					}


				$shadowback = pl_array_get( 'flyp_back_shadow', $flypitem, $shadow );
					if( $shadowback == 'noshadow') {
						$shadowbackclass = ' flyp_noshadow'; //add space
					} else {
						$shadowbackclass = '';
					}



				$backstyle = 'style="';
					$textalignback = pl_array_get( 'flyp_back_textalign', $flypitem, $textalign );
					$verticalalignback = pl_array_get( 'flyp_back_verticalalign', $flypitem, $verticalalign );
					if( $textalignback ) {
						$backstyle .= 'text-align: ' . $textalignback . ';';
					}
					if( $verticalalignback ) {
						$backstyle .= ' vertical-align: ' . $verticalalignback . ';';
					}
				$backstyle .= '"';



				//$front = sprintf('<div data-sync="flyp_array_item%s_text">%s</div>', $count, $front );


				$cols = pl_array_get('flyp_cols', $flypitem, $colsconfig);

				$directioncard = pl_array_get('flyp_card_direction', $flypitem, $direction);
					if( $directioncard == 'random' ){
						$randomdirections = array('right', 'left', 'top', 'bottom');
						$randdirection = array_rand($randomdirections, 1); //1, 2, 3, or 4
						$directioncard = $randomdirections[$randdirection];
					}


				$autotimeout = pl_array_get('flyp_card_auto_timeout', $flypitem, $autotimeout);
						$autotimeout = preg_replace("/[^0-9]/","", $autotimeout);
					if( $autotimeout > $autointerval ) {
						$autotimeout = $autointerval;
					}
				if($autotimeout){
					$datastart = " data-start='$autotimeout'";
				}



				$cardcolortext = ($this->opt('flyp_card_color_text')) ? pl_hashify($this->opt('flyp_card_color_text')) : '';
				$cardcolorbg = ($this->opt('flyp_card_color_bg')) ? pl_hashify($this->opt('flyp_card_color_bg')) : '';
				$cardcolorborder = ($this->opt('flyp_card_color_border')) ? pl_hashify($this->opt('flyp_card_color_border')) : '';



				if($spans == 0)
					$output .= '<div class="row fix">';


				$output .= sprintf(
					'<div class="span%s fix flyp_card-container flypcard%s" style="%s">
						<div class="flyp_card %s" data-direction="%s" style="%s"%s%s>
							<div class="flyp_front%s" style="%s"><span><span %s>%s</span></span></div>
							<div class="flyp_back%s" style="%s"><span><span %s>%s</span></span></div>
						</div>
					</div>',
					$cols,
					$count,
					$stylecontainer,
					$type,
					$directioncard,
					$cardstyle,
					$dataautoflip,
					$datastart,
					$shadowfrontclass,
					$styleeachcard,
					$frontstyle,
					$front,
					$shadowbackclass,
					$styleeachcard,
					$backstyle,
					$back
				);

				$spans += $cols;

				if($spans >= 12 || $count == $numberofcards){
					$spans = 0;
					$output .= '</div>';
				}


				$count++;


			}//end of foreach

		} //end of is_array

	printf('<div class="flyp pl-animation-group">%s</div>', $output);
	//<div style="clear:both;"></div> not needed from flippingcards because class 'fix' does this in PL

	} // end of function



} // end of section