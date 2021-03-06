<?php
if( !class_exists( 'AgendafrontEnd' ) ) :

	class AgendafrontEnd {

        function __construct(){
            add_action( 'wp_enqueue_scripts', array($this, 'agenda_front_end') );
            add_action( 'wp_head', array($this, 'custom_css') );
        }

        function custom_css(){
            $html = null;
            
            global $Agenda;
            $settings = get_option($Agenda->options['settings']);
            $pc = (isset($settings['primary_color']) ? ($settings['primary_color'] ? $settings['primary_color'] : '#4b4b4b' ) : '#4b4b4b');
            $lt = (isset($settings['ltext_color']) ? ($settings['ltext_color'] ? $settings['ltext_color'] : '#fff' ) : '#fff');
            $imgw = (isset($settings['imgw']) ? ($settings['imgw'] ? $settings['imgw'] : 150 ) : 150);
            $imgh = (isset($settings['imgh']) ? ($settings['imgh'] ? $settings['imgh'] : 150 ) : 150);
            $bp = (isset($settings['bullet_point']) ? ($settings['bullet_point'] ? $settings['bullet_point'] : 'circle' ) : 'circle');
            $tc = (isset($settings['text_color']) ? ($settings['text_color'] ? $settings['text_color'] : '#4a4a4a' ) : '#4a4a4a');
            $ts = (isset($settings['text_size']) ? ($settings['text_size'] ? $settings['text_size'] : '15px' ) : '15px');
            $ta = (isset($settings['text_align']) ? ($settings['text_align'] ? $settings['text_align'] : 'none' ) : 'none');
            $bc = (isset($settings['table_color']) ? ($settings['table_color'] ? $settings['table_color'] : '') : '');
            $thc = (isset($settings['table_hcolor']) ? ($settings['table_hcolor'] ? $settings['table_hcolor'] : '#44BBFF') : '#44BBFF');
            

            $html .= "<style type='text/css'>";
            $html .= '.agenda-pro-table.agenlayout2 tr.leisure-layout2,.agenda-pro-table tr.leisure-row,.roomNo,.agenda-content,.agenda .short-desc, .agenda .agenda-layout2 .agenda-content, .agenda .button-group .selected, .agenda .layout1 .agenda-content, .agenda .agenda-social a, .agenda .agenda-social li a.fa {';
            $html .= 'background: '.$pc.'!important';
            $html .= '}';
            $html .= '.leisure-layout2 .ses-title,.agenda-pro-table .leisure-row th,.agenda-pro-table tr.leisure-row,.agenda-pro-table.agenlayout2 tr.leisure-layout2{';
            $html .= 'color: '.$lt;
            $html .= '}';
            $html .= '.agenda-pro-table tr:nth-child(odd),.agenda-pro-table.agenlayout2 tr:nth-child(odd){';
            $html .= 'background: '.$bc;
            $html .= '}';
            $html .= '.agenda-pro-table .ses-title{';
            $html .= 'color: '.$tc.'!important;';
            $html .= 'font-size: '.$ts.'!important;';
            $html .= 'margin: '.$ta.'!important';
            $html .= '}';
            $html .= '.session_desc li,.entry-content ul, .entry-summary ul, .comment-content ul, .entry-content ol, .entry-summary ol, .comment-content ol, .site-content .agenda-pro-table ul,.speak_desc li, .agenda-pro-table ol{';
            $html .= 'list-style-type: '.$bp.'!important;';
            $html .= 'margin-left: 30px;';
            $html .= '}';
            $html .= '.agenlayout2 .iso-th{';
            $html .= 'background-color: '.$thc.'!important;';
            $html .= '}';
            

            $html .= (isset($settings['custom_css']) ? ($settings['custom_css'] ? "{$settings['custom_css']}" : null) : null );

            $html .= "</style>";
             echo $html;
        }

	function agenda_front_end(){
            global $Agenda;
            wp_enqueue_style( 'agenda-fontawsome', $Agenda->assetsUrl .'css/font-awesome/css/font-awesome.min.css' );
            wp_enqueue_style( 'agendastyle', $Agenda->assetsUrl . 'css/agendastyle.css' );
            wp_enqueue_script( 'agenda-layout2-js', $Agenda->assetsUrl . 'js/layout2.pkgd.js', array('jquery'), '2.2.2', true);
            wp_enqueue_script( 'agenda-layout2-imageload-js', $Agenda->assetsUrl . 'js/imagesloaded.pkgd.min.js', array('jquery'), null, true);
            wp_enqueue_script( 'tpl-team-front-end', $Agenda->assetsUrl . 'js/front-end.js', null, null, true);
        }

	}
endif;
