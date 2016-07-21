<?php
if (!class_exists('AgendaPostSession')) {
    /**
     * Add meta Box for Custom Event Session information
     */
    class AgendaPostSession {


        function __construct() {
            add_action('add_meta_boxes', array($this, 'some_custom_meta'));
            add_action( 'edit_form_after_title', array($this, 'agenda_after_title') );
            add_action( 'admin_enqueue_scripts', array($this, 'prfx_calendar_enqueue'));
            add_action('wp_ajax_test_response',  array($this,'test_response'));
            add_action('wp_ajax_nopriv_test_response',  array($this,'test_response'));
            add_action('wp_ajax_editquery',  array($this,'editquery'));
            add_action('wp_ajax_nopriv_editquery',  array($this,'editquery'));
            add_action('save_post', array($this, 'save_session_meta_data'), 10, 3);
            
        }

        function agenda_after_title($post){
            global $Agenda;

            if( $Agenda->post_type !== $post->post_type) {
                return;
            }
        }

        function some_custom_meta() {
            add_meta_box(
                'agenda_metas',
                __('Session Info', AGENDA_SLUG ),
                array($this,'agenda_metas'),
                'agenda',
                'normal',
                'high');
        }
        
        function agenda_metas($post){
            
                global $Agenda;
                wp_nonce_field( $Agenda->nonceText(), 'agenda_nonce' );
                $meta = get_post_meta( $post->ID );  
                 $id = get_the_ID();

                global $wpdb;
                $table_name = $wpdb->prefix . 'session_info';
                $active_rowss = "SELECT * FROM  $table_name WHERE post_id=$id ORDER BY STR_TO_DATE(session_timefrom,'%h:%i%p');";
                $pagepostsd = $wpdb->get_results($active_rowss, OBJECT);
                /*echo "<pre>";
                 var_dump($active_rowss);
                 exit();*/
                    
                if($pagepostsd){
            ?>
            <div class="tscroll">
                <table class="session_details" id="session_details">
                    <tr>
                        <th>Title</th>
                        <th> From</th>
                        <th>To</th>
                        <th>Brief Description</th>
                        <th>Speaker</th>
                        <th>Role</th>
                        <th>Organisation</th>
                        <th>Room/Location</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        foreach ($pagepostsd as $key=>$value){ ?>
                        <tr>
                            <td><?php echo $value->session_title; ?></td>
                            <td><?php echo $value->session_timefrom; ?></td>
                            <td><?php echo $value->session_timeto; ?></td>
                            <td><?php echo $value->session_desc; ?></td>
                            <td><?php echo $value->session_speaker; ?></td>
                            <td><?php echo $value->session_speakerrole; ?></td>
                            <td><?php echo $value->session_speakerorg; ?></td>
                            <td><?php echo $value->session_room; ?></td>
                            <td>
                                <button type="button" id="dele_value" string="<?php echo $value->id; ?>" value="" onclick="deleteme(<?php echo $value->id; ?>)">
                                <?php global $Agenda; $watchSrc = $Agenda->assetsUrl.'images/trash.png'; 
                                ?>
                                <img src="<?php echo $watchSrc ?>">
                               </button>

                                <button type="button" id="edit_value" string="<?php echo $value->id; ?>" value="" onclick="editeme(<?php echo $value->id; ?>)">
                                <?php global $Agenda; $homeSrc = $Agenda->assetsUrl.'images/edit.png'; 
                                ?>
                                <img src="<?php echo $homeSrc ?>"></button> 
                            </td>
                        </tr>

                    <?php } ?>

                </table>
                </div>
            <?php } ?>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="tlp-field-holder">
                    <div class="tplp-label">
                        <label for="session_title"><?php _e('Session Title', AGENDA_SLUG); ?>:</label>
                    </div>
                    <div class="tlp-field">
                        <input type="hidden" id="session_id" name="session_id" class="tlpfield" value="">
                        <input type="text" id="session_title" name="session_title" class="tlpfield" value="">
                        <span class="session_title"></span>
                    </div>
                </div>
                <div class="tlp-field-holder">
                    <div class="tplp-label">
                        <label for="session_time"><?php _e('Session Time', AGENDA_SLUG); ?>:</label>
                    </div>
                    <div class="tlp-field">
                    From:
                        <input type="text" id="session_timefrom" name="session_timefrom" class="tlptime tmepicker1" style= "width: 20%;" value="">
                    To:
                        <input type="text" id="session_timeto" name="session_timeto" class="tlptime timepicker2" style= "width: 20%;" value="">
                        <span class="session_time"></span>
                    </div>
                </div>

                <div class="tlp-field-holder">
                    <div class="tplp-label">
                        <label for="session_desc"><?php _e('Brief Description', AGENDA_SLUG); ?>:</label>
                    </div>
                    <?php
                        $field_value = get_post_meta( $post->ID, 'session_desc', false );
                        wp_editor( $field_value[0], 'session_desc' );
                    ?>
                </div>
        
                <div class="tlp-field-holder">
                    <div class="tplp-label">
                        <label for="session_speaker"><?php _e('Speaker', AGENDA_SLUG); ?>:</label>
                    </div>
                    <div class="tlp-field">
                        <input type="text" id="session_speaker" name="session_speaker" class="tlpfield" value="">
                        <span class="session_speakerrole"></span>
                    </div>
                </div>

                <div class="tlp-field-holder">
                    <div class="tplp-label">
                        <label for="session_speakerrole"><?php _e('Speaker Role', AGENDA_SLUG); ?>:</label>
                    </div>
                    <div class="tlp-field">
                        <input type="text" id="session_speakerrole" name="session_speakerrole" class="tlpfield" value="">
                        <span class="session_speakerrole"></span>
                    </div>
                </div>

                <div class="tlp-field-holder">
                    <div class="tplp-label">
                        <label for="session_speakerorg"><?php _e('Speaker Organisation', AGENDA_SLUG); ?>:</label>
                    </div>
                    <div class="tlp-field">
                        <input type="text" id="session_speakerorg" name="session_speakerorg" class="tlpfield" value="">
                        <span class="session_speakerorg"></span>
                    </div>
                </div>

                <div class="tlp-field-holder">
                    <div class="tplp-label">
                        <label for="organisation_logo"><?php _e('Organisation logo/Speaker Image', SPEAKER_SLUG); ?>:</label>
                    </div>
                    <div class="tlp-field">
                        <input type="text" name="meta_image" id="meta_image" value="<?php if ( isset ( $prfx_stored_meta['meta_image'] ) ) echo $prfx_stored_meta['meta_image'][0]; ?>" />
                        <input type="button" id="image_button" class="button" value="<?php _e( 'Upload Image', 'prfx-textdomain' )?>" />

                        <span class="desc"></span>
                    </div>
                </div>

                <div class="tlp-field-holder">
                    <div class="tplp-label">
                        <label for="session_room"><?php _e('Room/Location', AGENDA_SLUG); ?>:</label>
                    </div>
                    <div class="tlp-field">
                        <input type="text" id="session_room" name="session_room" class="tlpfield" value="">
                        <span class="session_room"></span>
                    </div>
                </div>
                <div class="tlp-field-holder">
                    <input type="checkbox"  value="" name="row" id="checkbox">Is Leisure?
                </div>
                <div class="tlp-field-holder">
                    <input type="submit" value="Save" name="submitb" id="submitb">
                    <input type='submit' name='update' value='Update' >
                </div>
                <div id="update"></div>
            </form>
                <?php

            }


            function save_session_meta_data($post_id, $post, $update) {
            
                if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

                    global $Agenda;

                    if ( !wp_verify_nonce( @$_REQUEST['agenda_nonce'], $Agenda->nonceText() ) )return;


                        if ( 'agenda' != $post->post_type ) return;
                
                            if (isset($_REQUEST['submitb'])){
                    
                                global $Agenda;
                                $id = get_the_ID();
                                $event = get_the_title();
                                if(isset($_REQUEST['row']))
                                {
                                    $row = 1; 
                                }else{
                                    $row = 0;
                                }

                                    global $wpdb;
                                    $table_name = $wpdb->prefix .  'session_info' ;
                                    $sql = $wpdb->insert($table_name,
                                    array('session_title' => $_REQUEST['session_title'],
                                        'session_timefrom'=>$_REQUEST['session_timefrom'],
                                        'session_timeto'=>$_REQUEST['session_timeto'],
                                        'session_desc'=>$_REQUEST['session_desc'],
                                        'session_speaker'=>$_REQUEST['session_speaker'],
                                        'session_speakerrole'=>$_REQUEST['session_speakerrole'],
                                        'session_speakerorg'=>$_REQUEST['session_speakerorg'],
                                        'session_room'=>$_REQUEST['session_room'],
                                        'sort_order'=> $row,
                                        'session_orglogo'=>$_POST[ 'meta_image' ],
                                        'post_id'=> $id,
                                        'eventname'=> $event,));

                                    $wpdb->query($sql);

                            }

                            if (isset($_REQUEST['update'])){

                                $session_id=$_REQUEST['session_id'];
                                $session_title=$_REQUEST['session_title'];
                                $session_timefrom=$_REQUEST['session_timefrom'];
                                $session_timeto=$_REQUEST['session_timeto'];
                                $session_desc=$_REQUEST['session_desc'];
                                $session_speaker=$_REQUEST['session_speaker'];
                                $session_speakerrole=$_REQUEST['session_speakerrole'];
                                $session_speakerorg=$_REQUEST['session_speakerorg'];
                                $session_room=$_REQUEST['session_room'];
                                $session_orglogo=$_POST[ 'meta_image' ];
                                if(isset($_REQUEST['row']))
                                {
                                    $row = 1; 
                                }else{
                                    $row = 0;
                                }

                                global $wpdb;
                                $table_name = $wpdb->prefix .  'session_info' ;
                                $wpdb->query($wpdb->prepare("UPDATE $table_name SET 
                                    session_title=' $session_title', 
                                    session_timefrom=' $session_timefrom',
                                    session_timeto=' $session_timeto',
                                    session_desc=' $session_desc',
                                    session_speaker=' $session_speaker',
                                    session_speakerrole=' $session_speakerrole',
                                    session_speakerorg=' $session_speakerorg',
                                    session_room=' $session_room',
                                    sort_order = '$row',
                                    session_orglogo=' $session_orglogo'
                                    WHERE id=$session_id"));
                        }
               

                }

            function test_response() {
                $id = $_POST['id'];
                    global $wpdb;
                    $table_name = $wpdb->prefix .  'session_info' ;
                    $my=$wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = $id",$_POST['id']));
                    
                }
            function editquery(){
                $id = $_POST['id'];
                global $wpdb;
                $table_names = $wpdb->prefix .  'session_info' ;
                $active_user="SELECT * FROM  $table_names WHERE id = $id " ;
                $my = $wpdb->get_results($active_user, OBJECT);
                $session_title=$my[0]->session_title;
                $session_timefrom=$my[0]->session_timefrom;
                $session_timeto=$my[0]->session_timeto;
                $session_speaker=$my[0]->session_speaker;
                $session_desc=$my[0]->session_desc;
                $session_speakerrole=$my[0]->session_speakerrole;
                $session_room=$my[0]->session_room;
                $sort_order=$my[0]->sort_order;
                $session_speakerorg=$my[0]->session_speakerorg;
                $session_orglogo=$my[0]->session_orglogo;

                $session_info= $id."**".$session_title."**".$session_timefrom."**".$session_timeto."**".$session_speaker."**".$session_desc."**".$session_speakerrole."**".$session_room."**".$session_speakerorg."**".$session_orglogo."**".$sort_order;
                echo $session_info;
                die();
             
            }

            // Registers and enqueues the required javascript.
            function prfx_calendar_enqueue() {

                global $Agenda;
                wp_enqueue_media();
                wp_enqueue_script( 'meta_image', $Agenda->assetsUrl. 'js/image_upload.js', array( 'jquery' ) );
                wp_localize_script( 'meta_image', 'meta_image',
                        array(
                            'title' => __( 'Upload an Image', 'prfx-textdomain' ),
                            'button' => __( 'Use this image', 'prfx-textdomain' ),
                        )
                    );
                wp_enqueue_script( 'meta_image' );
                wp_enqueue_style('jquery-timepicker', $Agenda->assetsUrl. 'css/agendastyle.css');
                wp_enqueue_script( 'jquery-ui-timepicker' );
                wp_enqueue_script('timepicker', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js'); 
                wp_enqueue_script( 'timepicker_function', $Agenda->assetsUrl. 'js/timepicker.js', array( 'jquery' ) );
                wp_localize_script( 'ajax-testo', 'ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
                wp_enqueue_script( 'delete_function', $Agenda->assetsUrl. 'js/deletequery.js', array( 'jquery' ) );
                wp_enqueue_script( 'edit_function', $Agenda->assetsUrl. 'js/editquery.js', array( 'jquery' ) );
                wp_localize_script( 'ajax-test', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
                wp_enqueue_script( 'select_function', $Agenda->assetsUrl. 'js/selectbox.js', array( 'jquery' ) );
                
            
       
            }
        
    }
}
