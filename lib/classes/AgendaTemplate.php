<?php

if(!class_exists('AgendaTemplate')):
    /**
     *
     */
    class AgendaTemplate
    {
        function __construct()
        {
            add_filter( 'template_include', array( $this, 'template_loader' ) );
            add_action( 'admin_enqueue_scripts', array($this, 'font_enqueue'));
        }
       public function font_enqueue(){
             global $Agenda;
             wp_enqueue_style( 'fontawesome', $Agenda->assetsUrl. '/css/font-awesome/css/font-awesome.css' );
             wp_enqueue_style( 'agenda-fontawsome', $Agenda->assetsUrl .'/css/font-awesome/css/font-awesome.min.css' );
            }
        public static function template_loader( $template ) {
            $find = array();
            $file = null;
            global $Agenda;
            if ( is_single() && get_post_type() == $Agenda->post_type ) {

                $file 	= 'single-team.php';
                $find[] = $file;
                $find[] = $Agenda->templatePath . $file;

            }
               if ( @$file ) {

                $template = locate_template( array_unique( $find ) );
                if ( ! $template ) {
                    $template = $Agenda->templatePath  . $file;
                }
            }

            return $template;
        }

        

    }

endif;
