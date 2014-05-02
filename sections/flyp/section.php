<?php
/*
Section: Flyp
Author: TourKick (Clifford P)
Description: A PageLines DMS section that flips / turns over content (front and back). <a href="http://www.pagelinestheme.com/flyp-section?utm_source=pagelines&utm_medium=section&utm_content=descriptionlink&utm_campaign=flyp_section" target="_blank">Flyp</a> is a <a href="http://b.tourkick.com/myplshop" target="_blank">TourKick (Clifford P) product</a>.
Class Name: Flyp
Version: 1.5
Cloning: true
PageLines: true
v3: true
Filter: component, dual-width
*/


/*
Notes:
- card-specific interval/timeout wording and coding
- firefox img max-width not working (did not test IE)
- cannot do border-radius:50%; (circle effect) because cards are not square (i.e. effect turns them into ovals instead of circles). Can't set a pixel width because then columns won't work. But could add border-radius:1000px; or something like that if you really want ovals.
- make height 0 and padding-bottom = width and height will be same as width when wider than 767px (then is just 100% width) -- http://stackoverflow.com/a/14088300 -- could then do circle (i.e. border-radius: 50%;)
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
			pl_hashify(pl_setting('bodybg'))	=> array('name' => __('PL Background Base Setting', 'flyp') ),
			pl_hashify(pl_setting('text_primary'))	=> array('name' => __('PL Text Base Setting', 'flyp') ),
			pl_hashify(pl_setting('linkcolor'))	=> array('name' => __('PL Link Base Setting', 'flyp') ),
			'#fbfbfb'	=> array('name' => __('Light Gray', 'flyp') ),
			'#bfbfbf'	=> array('name' => __('Medium Gray', 'flyp') ),
			'#1abc9c'	=> array('name' => __('* Turquoise', 'flyp') ),
			'#16a085'	=> array('name' => __('* Green Sea', 'flyp') ),
			'#40d47e'	=> array('name' => __('* Emerald', 'flyp') ),
			'#27ae60'	=> array('name' => __('* Nephritis', 'flyp') ),
			'#3498db'	=> array('name' => __('* Peter River', 'flyp') ),
			'#2980b9'	=> array('name' => __('* Belize Hole', 'flyp') ),
			'#9b59b6'	=> array('name' => __('* Amethyst', 'flyp') ),
			'#8e44ad'	=> array('name' => __('* Wisteria', 'flyp') ),
			'#34495e'	=> array('name' => __('* Wet Asphalt', 'flyp') ),
			'#2c3e50'	=> array('name' => __('* Midnight Blue', 'flyp') ),
			'#f1c40f'	=> array('name' => __('* Sun Flower', 'flyp') ),
			'#f39c12'	=> array('name' => __('* Orange', 'flyp') ),
			'#e67e22'	=> array('name' => __('* Carrot', 'flyp') ),
			'#d35400'	=> array('name' => __('* Pumpkin', 'flyp') ),
			'#e74c3c'	=> array('name' => __('* Alizarin', 'flyp') ),
			'#c0392b'	=> array('name' => __('* Pomegranate', 'flyp') ),
			'#ecf0f1'	=> array('name' => __('* Clouds', 'flyp') ),
			'#bdc3c7'	=> array('name' => __('* Silver', 'flyp') ),
			'#95a5a6'	=> array('name' => __('* Concrete', 'flyp') ),
			'#7f8c8d'	=> array('name' => __('* Asbestos', 'flyp') ),
			'#791869'	=> array('name' => __('Plum', 'flyp') ),
			'#c23b3d'	=> array('name' => __('Red', 'flyp') ),
			'#0c5cea'	=> array('name' => __('Blue', 'flyp') ),
			'#00aff0'	=> array('name' => __('Light Blue', 'flyp') ),
			'#88b500'	=> array('name' => __('Lime', 'flyp') ),
			'#cf3f20'	=> array('name' => __('Orangey', 'flyp') ),
			'#f27a00'	=> array('name' => __('Yellowy-Orange', 'flyp') ),
		);


		$options = array();

		$options[] = array(
			'key'		=> 'flyp_config',
			'type'		=> 'multi',
			'col'		=> 1, //left side
			'title'		=> __('Flyp Container Settings', 'flyp'),
			'help'		=> '<strong><a href="http://www.pagelinestheme.com/flyp-section?utm_source=pagelines&utm_medium=section&utm_content=help&utm_campaign=flyp_section" target="_blank">Flyp Section Helpful Tips</a></strong>',
			'opts'	=> array(
				array(
					'key'	=> 'flyp_type',
					'type' 	=> 'select',
					//'default' => 'flyp_over',
					'label'	=> __('Flyp Effect/Type<br/>If you chose <span style="color: darkred;">Button</span>, you will need to manually add something like<br/><span style="color: darkred;">[pl_button]Click to Flip[/pl_button]</span> (see <a href="http://docs.pagelines.com/tutorials/shortcodes" target="_blank">PL Shortcodes</a>)<br/>to both the front and back of each card.', 'flyp'),
					'opts' => array(
						'flyp_over'		=> array('name' => __('Over (Default)', 'flyp') ),
						'flyp_click'	=> array('name' => __('Click', 'flyp') ),
						'flyp_button'	=> array('name' => __('Button', 'flyp') ),
						'flyp_auto'		=> array('name' => __('Auto', 'flyp') ),
					)
				),
				array(
					'key'	=> 'flyp_direction',
					'type' 	=> 'select',
					'default' => 'right',
					'label'	=> __('Flyp Direction', 'flyp'),
					'opts' => array(
						'random'	=> array('name' => __('Randomized', 'flyp') ),
						'right'		=> array('name' => __('Right (Default)', 'flyp') ),
						'left'		=> array('name' => __('Left', 'flyp') ),
						'top'		=> array('name' => __('Top', 'flyp') ),
						'bottom'	=> array('name' => __('Bottom', 'flyp') ),
					)
				),
				array(
					'key'		=> 'flyp_auto_interval',
					'type'		=> 'text_small',
					//'default'	=> '3000',
					'label' 	=> __('Auto Flip Interval (milliseconds)<br/>Set time for a card to flip automatically back and front<br/>Default is 3000 (3 seconds)', 'flyp')
				),
				array(
					'key'		=> 'flyp_auto_timeout',
					'type'		=> 'text_small',
					//'default'	=> '2000',
					'label' 	=> __('Auto Flip Timeout (milliseconds)<br/>Set time a card will flip back after being clicked and must be less than Auto Flip Interval<br/>Cards do not flip when mouse is hovering<br/>Default is 2000 (2 seconds)', 'flyp')
				),
/*
				array(
					'key'	=> 'flyp_float',
					'type' 	=> 'select',
					//'default' => 'left',
					'label'	=> __('Flyp Float', 'flyp'),
					'opts' => array(
						'left'		=> array('name' => __('Left (Default)', 'flyp') ),
						'right'		=> array('name' => __('Right', 'flyp') ),
						'none'		=> array('name' => __('None', 'flyp') ),
					)
				),
*/
				array(
					'key'			=> 'flyp_cols_config',
					'type' 			=> 'count_select',
					'count_start'	=> 1,
					'count_number'	=> 12,
					//'default'		=> '4',
					'label' 	=> __( 'Number of Columns Wide Per Card (12 column grid, Default: 4)', 'flyp' ),
				),
				array(
					'key'	=> 'flyp_cols_tightcards',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Remove space / gap / margin between cards?', 'flyp'),
					'opts' => array(
						'yes'	=> array('name' => __('Yes to Tight Cards', 'flyp') ),
					)
				),
				array(
					'key'		=> 'flyp_height',
					'type'		=> 'text_small',
					//'default'	=> '200px',
					'label' 	=> __('Height of Flyp Cards (Default: "200") (pixels)', 'flyp')
				),
				array(
					'key'		=> 'flyp_padding_within_top',
					//'default'	=> '',
					'type'		=> 'text_small',
					'label' 	=> __('Flyp Card Interior Padding - TOP (Default: "0") (pixels)', 'flyp')
				),
				array(
					'key'		=> 'flyp_padding_within_right',
					//'default'	=> '',
					'type'		=> 'text_small',
					'label' 	=> __('Flyp Card Interior Padding - RIGHT (Default: Top\'s) (pixels)', 'flyp')
				),
				array(
					'key'		=> 'flyp_padding_within_bottom',
					//'default'	=> '',
					'type'		=> 'text_small',
					'label' 	=> __('Flyp Card Interior Padding - BOTTOM (Default: Top\'s) (pixels)', 'flyp')
				),
				array(
					'key'		=> 'flyp_padding_within_left',
					//'default'	=> '',
					'type'		=> 'text_small',
					'label' 	=> __('Flyp Card Interior Padding - LEFT (Default: Top\'s) (pixels)', 'flyp')
				),
				array(
					'key'	=> 'flyp_font',
					'type'	=> 'fonts',
					'label'	=> __('Flyp Cards Font', 'flyp')
				),
				array(
					'key'	=> 'flyp_textalign',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Flyp <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/text-align" target="_blank">text-align</a> (Default: Center)', 'flyp'),
					'opts' => array(
						'center'	=> array('name' => __('Center (Default)', 'flyp') ),
						'left'		=> array('name' => __('Left', 'flyp') ),
						'right'		=> array('name' => __('Right', 'flyp') ),
						'justify'	=> array('name' => __('Justify', 'flyp') ),
					)
				),
				array(
					'key'	=> 'flyp_verticalalign',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Flyp <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/vertical-align" target="_blank">vertical-align</a> (Default: Middle)', 'flyp'),
					'opts' => array(
						'middle'	=> array('name' => __('Middle (Default)', 'flyp') ),
						'top'		=> array('name' => __('Top', 'flyp') ),
						'bottom'	=> array('name' => __('Bottom', 'flyp') ),
					)
				),
				array(
					'key'	=> 'flyp_shadow',
					'type' 	=> 'select',
					//'default' => 'shadow',
					'label'	=> __('Card Drop Shadow (Default: ON)', 'flyp'),
					'opts' => array(
						'shadow'	=> array('name' => __('Shadow ON (Default)', 'flyp') ),
						'noshadow'	=> array('name' => __('Shadow OFF', 'flyp') ),
					)
				),
				array(
					'key'	=> 'flyp_color_text',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Flyp Text Color Preset<br/>Default: "PL Text Base Setting"<br/>(* are from <a href="http://flatuicolors.com/" target="_blank">FlatUIcolors.com</a>)', 'flyp'),
					'opts' => $colorpresets,
				),
				array(
					'key'	=> 'flyp_color_text_picker',
					'type' 	=> 'color',
					'default' => '',
					'label'	=> __('Flyp Text Color Picker<br/>(will override preset if both are set)', 'flyp'),
				),
				array(
					'key'	=> 'flyp_color_bg',
					'type' 	=> 'select',
					//'default' => '#fbfbfb',
					'label'	=> __('Flyp Background Color Preset<br/>Suggestion: Light Gray<br/>(* are from <a href="http://flatuicolors.com/" target="_blank">FlatUIcolors.com</a>)', 'flyp'),
					'opts' => $colorpresets,
				),
				array(
					'key'	=> 'flyp_color_bg_picker',
					'type' 	=> 'color',
					'default' => '',
					'label'	=> __('Flyp Background Color Picker<br/>(will override preset if both are set)', 'flyp'),
				),
				array(
					'key'	=> 'flyp_color_border',
					'type' 	=> 'select',
					//'default' => '#bfbfbf',
					'label'	=> __('Flyp Border Color Preset<br/>Suggestion: Medium Gray<br/>(* are from <a href="http://flatuicolors.com/" target="_blank">FlatUIcolors.com</a>)', 'flyp'),
					'opts' => $colorpresets,
				),
				array(
					'key'	=> 'flyp_color_border_picker',
					'type' 	=> 'color',
					'default' => '',
					'label'	=> __('Flyp Border Color Picker<br/>(will override preset if both are set)', 'flyp'),
				),
				array(
					'key'		=> 'flyp_border_width',
					//'default'	=> '1',
					'type'		=> 'text_small',
					'label' 	=> __('Flyp Card Border Width (Default: "1") (pixels)', 'flyp')
				),
				array(
					'key'		=> 'flyp_border_radius',
					//'default'	=> '0',
					'type'		=> 'text_small',
					'label' 	=> __('Flyp Card Border Radius / Rounded Corners (Default: "0") (pixels)', 'flyp')
				),

			) //opts
		); //options



		$options[] = array(
			'key'		=> 'flyp_array',
	    	'type'		=> 'accordion',
	    	//'opts_cnt'	=> 3, //number of accordions to display at first
			'col'		=> 2, //right side
			'title'		=> __('Flyp Cards', 'flyp'),
			'post_type'	=> __('Flyp Card', 'flyp'), //what shows up for each accordion option -- does not actually register a custom post type and therefore ok to have spaces
			'opts'	=> array(
				array(
					'key'	=> 'flyp_front',
					'type'	=> 'textarea',
					'label'	=> __('Card Front Content<br/><span style="color: darkred;">It is recommended to NOT use [pl_video] with Vimeo on the FRONT of cards.</style> If you do, it is recommended to turn OFF the max-height constraint for the side of a card that you use [pl_video] with Vimeo, otherwise going full-screen will not work.', 'flyp')
				),
/*
				array(
					'key'	=> 'flyp_front_font',
					'type'	=> 'fonts',
					'label'	=> __('Card Front Font', 'flyp')
				),
*/
				array(
					'key'	=> 'flyp_front_textalign',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Card Front <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/text-align" target="_blank">text-align</a> Override', 'flyp'),
					'opts' => array(
						'center'	=> array('name' => __('Center', 'flyp') ),
						'left'		=> array('name' => __('Left', 'flyp') ),
						'right'		=> array('name' => __('Right', 'flyp') ),
						'justify'	=> array('name' => __('Justify', 'flyp') ),
					)
				),
				array(
					'key'	=> 'flyp_front_verticalalign',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Card Front <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/vertical-align" target="_blank">vertical-align</a> Override', 'flyp'),
					'opts' => array(
						'middle'	=> array('name' => __('Middle', 'flyp') ),
						'top'		=> array('name' => __('Top', 'flyp') ),
						'bottom'	=> array('name' => __('Bottom', 'flyp') ),
					)
				),
				array(
					'key'	=> 'flyp_front_shadow',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Card Front Drop Shadow Override', 'flyp'),
					'opts' => array(
						'shadow'	=> array('name' => __('Shadow ON', 'flyp') ),
						'noshadow'	=> array('name' => __('Shadow OFF', 'flyp') ),
					)
				),
				array(
					'key'	=> 'flyp_front_disable_maxheight',
					'type'	=> 'select',
					'label'	=> __('(Advanced) Front: disable automatically adding style="max-height:____;" to img and iframe', 'flyp'),
					'opts' => array(
						'disable'	=> array('name' => __('Yes, Disable', 'flyp') ),
					)
				),
				array(
					'key'	=> 'flyp_back',
					'type'	=> 'textarea',
					'label'	=> __('Card Back Content<br/><span style="color: darkred;">If using [pl_video] with Vimeo, it is recommended to turn OFF the max-height constraint, otherwise going full-screen will not work.</span>', 'flyp')
				),
/*
				array(
					'key'	=> 'flyp_back_font',
					'type'	=> 'fonts',
					'label'	=> __('Card Back Font', 'flyp')
				),
*/
				array(
					'key'	=> 'flyp_back_textalign',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Card Back <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/text-align" target="_blank">text-align</a> Override', 'flyp'),
					'opts' => array(
						'center'	=> array('name' => __('Center', 'flyp') ),
						'left'		=> array('name' => __('Left', 'flyp') ),
						'right'		=> array('name' => __('Right', 'flyp') ),
						'justify'	=> array('name' => __('Justify', 'flyp') ),
					)
				),
				array(
					'key'	=> 'flyp_back_verticalalign',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Card Back <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/vertical-align" target="_blank">vertical-align</a> Override', 'flyp'),
					'opts' => array(
						'middle'	=> array('name' => __('Middle', 'flyp') ),
						'top'		=> array('name' => __('Top', 'flyp') ),
						'bottom'	=> array('name' => __('Bottom', 'flyp') ),
					)
				),
				array(
					'key'	=> 'flyp_back_shadow',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Card Back Drop Shadow Override', 'flyp'),
					'opts' => array(
						'shadow'	=> array('name' => __('Shadow ON', 'flyp') ),
						'noshadow'	=> array('name' => __('Shadow OFF', 'flyp') ),
					)
				),
				array(
					'key'	=> 'flyp_back_disable_maxheight',
					'type'	=> 'select',
					'label'	=> __('(Advanced) Back: disable automatically adding style="max-height:____;" to img and iframe', 'flyp'),
					'opts' => array(
						'disable'	=> array('name' => __('Yes, Disable', 'flyp') ),
					)
				),
				array(
					'key'			=> 'flyp_cols',
					'type' 			=> 'count_select',
					'count_start'	=> 1,
					'count_number'	=> 12,
					//'default'		=> '4',
					'label' 	=> __( 'Number of Columns Wide Override (12 column grid)', 'flyp' ),
				),
				array(
					'key'	=> 'flyp_card_direction',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Flyp Direction Override', 'flyp'),
					'opts' => array(
						'right'		=> array('name' => __('Right', 'flyp') ),
						'left'		=> array('name' => __('Left', 'flyp') ),
						'top'		=> array('name' => __('Top', 'flyp') ),
						'bottom'	=> array('name' => __('Bottom', 'flyp') ),
					)
				),
				array(
					'key'		=> 'flyp_card_auto_timeout',
					'type'		=> 'text_small',
					//'default'	=> '2000',
					'label' 	=> __('Auto Flip Timeout (milliseconds)<br/>Override per card so they auto flip at different intervals and must be less than Auto Flip Interval', 'flyp')
				),
				array(
					'key'	=> 'flyp_card_color_text',
					'type' 	=> 'select',
					//'default' => '',
					'label'	=> __('Flyp Text Color Preset<br/>Default: "PL Text Base Setting"<br/>(* are from <a href="http://flatuicolors.com/" target="_blank">FlatUIcolors.com</a>)', 'flyp'),
					'opts' => $colorpresets,
				),
				array(
					'key'	=> 'flyp_card_color_text_picker',
					'type' 	=> 'color',
					'default' => '',
					'label'	=> __('Flyp Text Color Picker<br/>(will override preset if both are set)', 'flyp'),
				),
				array(
					'key'	=> 'flyp_card_color_bg',
					'type' 	=> 'select',
					//'default' => '#fbfbfb',
					'label'	=> __('Flyp Background Color Preset<br/>(* are from <a href="http://flatuicolors.com/" target="_blank">FlatUIcolors.com</a>)', 'flyp'),
					'opts' => $colorpresets,
				),
				array(
					'key'	=> 'flyp_card_color_bg_picker',
					'type' 	=> 'color',
					'default' => '',
					'label'	=> __('Flyp Background Color Picker<br/>(will override preset if both are set)', 'flyp'),
				),
				array(
					'key'	=> 'flyp_card_color_border',
					'type' 	=> 'select',
					//'default' => '#bfbfbf',
					'label'	=> __('Flyp Border Color Preset<br/>(* are from <a href="http://flatuicolors.com/" target="_blank">FlatUIcolors.com</a>)', 'flyp'),
					'opts' => $colorpresets,
				),
				array(
					'key'	=> 'flyp_card_color_border_picker',
					'type' 	=> 'color',
					'default' => '',
					'label'	=> __('Flyp Border Color Picker<br/>(will override preset if both are set)', 'flyp'),
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
			$rowclosed = ($this->opt('flyp_cols_tightcards')) ? $this->opt('flyp_cols_tightcards') : '';

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

				$borderradius = $this->opt('flyp_border_radius') ? $this->opt('flyp_border_radius') : 0;
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


					$frontdisablemaxheight = pl_array_get('flyp_front_disable_maxheight', $flypitem, '');
					if( $frontdisablemaxheight == 'disable' ) {} else {
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

					$backdisablemaxheight = pl_array_get('flyp_back_disable_maxheight', $flypitem, '');
					if( $backdisablemaxheight == 'disable' ) {} else {
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


				//individual card's color settings
				if( pl_array_get('flyp_card_color_text_picker', $flypitem, '') ) {
					$cardcolortext = pl_array_get('flyp_card_color_text_picker', $flypitem, '');
				} elseif( pl_array_get('flyp_card_color_text', $flypitem, '') ) {
					$cardcolortext = pl_array_get('flyp_card_color_text', $flypitem, '');
				} else {
					$cardcolortext = '';
				}
					$cardcolortext = is_array($cardcolortext) ? array_shift($cardcolortext) : $cardcolortext;
					$cardcolortext = ($cardcolortext) ? pl_hashify($cardcolortext) : $colortext;

				if( pl_array_get('flyp_card_color_bg_picker', $flypitem, '') ) {
					$cardcolorbg = pl_array_get('flyp_card_color_bg_picker', $flypitem, '');
				} elseif( pl_array_get('flyp_card_color_bg', $flypitem, '') ) {
					$cardcolorbg = pl_array_get('flyp_card_color_bg', $flypitem, '');
				} else {
					$cardcolorbg = '';
				}
					$cardcolorbg = is_array($cardcolorbg) ? array_shift($cardcolorbg) : $cardcolorbg;
					$cardcolorbg = ($cardcolorbg) ? pl_hashify($cardcolorbg) : $colorbg;

				if( pl_array_get('flyp_card_color_border_picker', $flypitem, '') ) {
					$cardcolorborder = pl_array_get('flyp_card_color_border_picker', $flypitem, '');
				} elseif( pl_array_get('flyp_card_color_border', $flypitem, '') ) {
					$cardcolorborder = pl_array_get('flyp_card_color_border', $flypitem, '');
				} else {
					$cardcolorborder = '';
				}
					$cardcolorborder = is_array($cardcolorborder) ? array_shift($cardcolorborder) : $cardcolorborder;
					$cardcolorborder = ($cardcolorborder) ? pl_hashify($cardcolorborder) : $colorborder;



			// "each card" meaning both front and back are the same
			$styleeachcard = sprintf('padding: %spx %spx %spx %spx;', $paddingtop, $paddingright, $paddingbottom, $paddingleft);
				$styleeachcard .= ($cardcolortext) ? sprintf(' color: %s;', $cardcolortext) : '';
				$styleeachcard .= ($cardcolorbg) ? sprintf(' background-color: %s;', $cardcolorbg) : '';
				$styleeachcard .= ($cardcolorborder) ? sprintf(' border-radius: %spx; border: %spx solid %s;', $borderradius, $borderwidth, $cardcolorborder) : '';


				if($spans == 0){
					if($rowclosed) {
						$output .= '<div class="row row-closed fix">';
					} else {
						$output .= '<div class="row fix">';
					}
				}


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