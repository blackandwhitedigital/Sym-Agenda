<?php
global $Agenda;
$settings = get_option($Agenda->options['settings']);
?>
<style type="text/css">
.wrap .tlp-help h3 {
  color: #b2bb1c;
  font-family: Arial, Helvetica, sans-serif;
  font-weight: bold;
}
.wrap .tlp-help {
  font-family: Arial, Helvetica, sans-serif;
}
.wrap .tlp-content-holder .tch-right-pro #pro-feature .inside {
  font-family: Arial, Helvetica, sans-serif;
}
.wrap .tlp-content-holder .tch-right-pro #pro-feature .hndle.ui-sortable-handle span {
  font-family: Arial, Helvetica, sans-serif;
}
.wrap .tlp-help p strong {
  color: #b2bb1c;
}
</style>
<div class="wrap">
    <div id="upf-icon-edit-pages" class="icon32 icon32-posts-page"><br/></div>
    <!-- <h2><?php _e('Donations', AGENDA_SLUG); ?></h2> -->
    <div class="tlp-content-holder">
        <div class="tch-left-pro">


                <h3>
                  <?php _e('If you found this plugin useful, please help us develop and support the free version with a small donation here..', AGENDA_SLUG); ?>
                </h3>
<br><br>
            <!-- Donation Button -->
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="FEVUDATV7QGK2">
                    <input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
                </form>

                <?php wp_nonce_field($Agenda->nonceText(), 'agenda_nonce'); ?>

            <!-- Donation Button -->

            <div id="response" class="updated"></div>
      </div>
        <div class="tch-right-pro">
            <div id="pro-feature" class="postbox">
                <div class="handlediv" title="Click to toggle"><br>
                </div>
              <h3 class="hndle ui-sortable-handle"><span>Symposium Meeting Agenda Pro</span></h3>
                <div class="inside">
                    <p class="heading">Pro Features</p>
                    <ul class="pro-features">
                        <li>Create unlimited agendas (free version allows only one)</li>
                        <li>Integrate with <a href="http://www.blackandwhitedigital.eu/product-category/plugins/" target="_blank">Speakers Pro</a>, allowing you to pull speaker information directly into agenda sessions without re-entering for every agenda/event</li>
                        <li>Display simultaneous meeting streams in adjacent columns</li>
                        <li>Visual Composer compatibility</li>
                        <li>Fields control - show / hide</li>
                        <li>All text size, color and text align control</li>
                        <li>Speaker details popup </li>
                        <li>Show / hide session details</li>
                    </ul><a href="http://www.blackandwhitedigital.eu/product-category/plugins/" class="button button-primary" target="_blank">Get Pro Version</a>
                </div>
            </div>
        </div>
    </div>
    <div class="tlp-help">
      <p style="font-weight: bold"><?php _e('Getting Started:', AGENDA_SLUG); ?></p>
        <h3>&nbsp;</h3>
        <h3><strong>1. Adding Agendas</strong></h3>
        <p>Click the “Add Agenda" link in the left hand menu.  Add information and save. </p>
        <p>It is intended that you use a shortcode (see below) to display agendas in pages and posts but you can use the post itself.</p>
        <p>Only one agenda can be created with the free version.</p>
        <p>&nbsp;</p>
        <h3><strong>2.  Agenda Content</strong></h3>
        <p>Mostly entering content is pretty straight forward. </p>
        <p>Some things to note:</p>
        <ul>
          <li>You can simply type a <strong>Session Time</strong> - you are not limited to the 30 minute intervals that display in the field.</li>
          <li>The <strong>'Is Leisure?'</strong> check box is meant to be used to display breaks such as lunch, tea or network sessions.</li>
          <li><strong>Organisation Logo/Speaker Image</strong> field content does not display in the current version templates (we may add it to future designs!)</li>
          <li>If you edit a session, don't click <strong>'Save'</strong> as this will add a duplicate session, click <strong>'Update'</strong>.</li>
        </ul>
        <p>&nbsp;</p>
        <h3>3. Display your Agenda in a Post or Page with a Shortcode</h3>
        <p>To display your agenda you will need to add a &lsquo;shortcode&rsquo; to the page or post in the location where you want the agenda to show. This short code will look something like this:</p>
        <p>[agenda]</p>
        <p>This will give you a basic display. However, you can refine the shortcode using some additional options to control the final display. This is what your shortcode may look like once you have added these settings:</p>
        <p>[agenda orderby="time" layout="1"]</p>
        <p>The shortcode contains a number of optional elements that allow you to control the appearance of the agendas section. These options are:</p>
        <ul>
          <li><strong>orderby</strong> = The order that sessions in the agenda display by, most people will use 'time' but you can order by 'speaker'</li>
          <li><strong>layout</strong> = the layout template you want to use.  At the moment you can choose from  “1” and "2"<br>
          </li>
        </ul>
        <p><a href="http://www.blackandwhitedigital.eu/symposium-meeting-agenda-free-template-samples/" target="_blank">You can see examples of each layout here.</a></p>
      <p>&nbsp;</p>
      <h3>4. Settings Options - changing colours, fonts, etc. in your live template</h3>
        <p>Once you have selected a template design you like and included this in the short code (above) you can tweak many aspects of this to fit your event's branding and color scheme.</p>
      <p>On the ‘Settings’ tab in the left hand menu you can change the appearance of many elements of the agenda.</p>
      <ul>
          <li><strong>Leisure Session: Background &amp; Text Colors: </strong>this is for breaks such as tea, coffee and lunch. It can be used to create a nice visual seperation between sessions in your event by setting contrasting background and text colors to the rest of the agenda</li>
          <li><strong>Table Base Color: </strong>This sets the base colour for the agenda table (isotope view only) - it becomes the main band of alternating color</li>
          <li><strong>Slug:</strong> Default is &quot;agenda&quot; - used in the shortcode</li>
          <li><strong>Session Title: Color, Text Size:</strong>
            <ul>
              <li><strong>Text Color:</strong> Select a color</li>
              <li><strong>Text Size: </strong>(eg. “12pt”) </li>
            </ul>
          </li>
          <li><strong>Styling Bullet Points:</strong> If your event details include bullet points you can choose to display &quot;circle&quot;, &quot;square&quot;, &quot;disc&quot; or &quot;none&quot;</li>
          <li><strong>Custom CSS:</strong> Add CSS part with the classname you want.</li>
          <li><strong>Save changes:</strong> Don’t forget!    </li>
      </ul>
    </div>
    
</div>
<?php


 ?>
