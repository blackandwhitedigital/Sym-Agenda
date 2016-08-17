        <?php
get_header( );
	while ( have_posts() ) : the_post();
	global $post;
?>
<div class="container-fluid tlp-single-container">
	<div class="row">
		<article id="post-<?php the_ID(); ?>" <?php post_class('tlp-member-article');?> >

			<div class="tlp-col-lg-12 tlp-col-md-12 tlp-col-sm-12 tlp-col-xs-12 tlp-member-feature-img">
				<div class="event-name">
					<h3 class="event-name-title">
						<?php 
						echo get_the_title();
						?>
					</h3>
					
				</div>
					<?php
					if(has_post_thumbnail()){
						echo get_the_post_thumbnail( get_the_ID() );
					}else{
									$imgSrc = $Agenda->assetsUrl.'images/default.jpg';
									echo "<img src=".$imgSrc.">";
					      		}
					?>

					<p class="event-mdesc">
						<?php 
						$short_bio = get_post_meta( get_the_ID(), 'short_bio', true );
						echo $short_bio;
						?>
					</p>
			</div>

			<div class="tlp-col-lg-12 tlp-col-md-12 tlp-col-sm-12 tlp-col-xs-12">
				<div class="tlp-member-detail"><?php echo apply_filters('the_content',get_the_content()); ?></div>

				<?php
					$date_ev= get_post_meta( get_the_ID(), 'event_date', true );
					$date=date_create("$date_ev");
					$event_date=date_format($date,"d F Y");
					$location = get_post_meta( get_the_ID(), 'location', true );
					$id = get_the_ID();

					global $wpdb;
			        $sessiont=$wpdb->prefix . 'session_info';
					$active_rows = "SELECT * FROM  $sessiont WHERE post_id=$id ORDER BY session_timefrom";
			        $pageposts = $wpdb->get_results($active_rows, OBJECT);

					$html = null;

					$html .="<div class='tlp-single-details tlp-team'>";
					$html .= '<ul class="contact-info">';
					if($event_date){
						$html .="<li class='event_date'>".__('<strong></strong>',AGENDA_SLUG)." $event_date</li>";
					}if($location){
						$html .="<li class='location'>".__('<span class="fa fa-map-marker"></span>',AGENDA_SLUG)." $location</li></ul>";
					}

					/* session info start*/

				    $html .= '<table class="agenda-pro-table">';
		            $html .= '<tbody>';
		            foreach ($pageposts as $key => $value) {
		                $id = $value->id;
		                $session_title = $value->session_title;
		                $session_timefrom = $value->session_timefrom;
		                $session_timeto = $value->session_timeto;
		                $session_desc = $value->session_desc;
		                $session_speaker = $value->session_speaker;
		                $session_speakerrole = $value->session_speakerrole;
		                $session_speakerorg = $value->session_speakerorg;
		                $session_orglogo = $value->session_orglogo;
		                $session_room = $value->session_room;
		                $speaker_id = $value->speaker_id;
		                $leisure = $value->sort_order;
		                
		                $plus = $Agenda->assetsUrl . 'images/plus.png';
		                global $wpdb;
		                $post = $wpdb->prefix . 'posts';
		                $speakerlink = "SELECT ID FROM $post where ID=$speaker_id";
		                $pagepostslink = $wpdb->get_results($speakerlink, OBJECT);
		                $postid = $pagepostslink[0]->ID;

		                $post_speaker = get_post($postid);
		                $ppLink = get_post_permalink($postid);

		                if ($leisure==0) {
		                    $html .= '<tr>';
		                } else {
		                    $html .= '<tr class="leisure-row">';
		                }

		                $html .= '<th>' . $session_timefrom . '-'. $session_timeto .'<br>'. $session_room .'</th>';
		                if ($leisure==0) {
		                    $html .= '<td>';
		                    $html .= "{$session_title}<a id='speakertoggle'><span class='session_toggle'>                </span></a><br><p>{$session_desc}</p>";

		                    if (!empty($session_speaker)) {
		                        $html .= "<p>{$session_speaker}, {$session_speakerrole}, {$session_speakerorg}</p>";
		                        $html .= "<a onclick='event_show(" . $postid . ")'' id='speakerinfo'><span class='session_speakerimg'></span></a>";

		                    }
		                    $html .= '</td>';
		                } else {
		                    $html .= '<td>'. $session_title . '<br>' . $session_desc . '</td>';
		                }

		                $html .= '</tr>';
		            }
		            $html .= '</tbody>';
           			$html .= '</table>';
					/* session info start*/
					
					$html .="</div>";

			echo $html;
			?>
			</div>
		</article>
	</div>
</div>
<?php endwhile;
get_footer();
