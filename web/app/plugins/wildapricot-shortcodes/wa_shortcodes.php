<?php
/**
* Plugin Name: Wild Apricot Shortcodes
* Plugin URI: N/A
* Description: Embed Wild Apricot data elements using shortcodes
* Version: 0.1
* Author: Dominic Canare <dom@greenlightgo.org>
* Author URI: http://greenlightgo.org
* License: GPL2
*/

//[WildApricot_eventList]
function wildapricot_eventList($atts){
  require_once('WildApricotAPIClient.php');
  
  $months = explode(' ', 'JAN FEB MAR APR MAY JUN JUL AUG SEP OCT NOV DEC');
  function eventCompare($a, $b){
    return strcmp($a['StartDate'], $b['StartDate']);
  }

  try {
    $waApiClient = WaApiClient::getInstance();
    $waApiClient->initTokenByApiKey(get_option('wildapricot_api_key'));
  }catch(Exception $exc){
    file_put_contents('/tmp/wp_debug.log', $exc->getMessage());
    return '<h3>Failed to connect to database :(</h3><hr/>';
    $waApiClient = false;
  }

  if($waApiClient){
    $output = '
      <style type="text/css">
        table.eventList {
          border-collapse: collapse;
          width: 100%;
        }
        table.eventList td {
          text-align: left;
        }
        table.eventList td,
        table.eventList th {
          border: 1px solid #000;
          padding: 0.25em;
          vertical-align: top;
        }
        table.eventList h3 {
          margin-bottom: 0;
        }

        table.eventList .detailToggle {
          cursor: pointer;
        }

        table.eventList .details {
          display: none;
          border-top: 1px solid #444;
          margin-top: 0.5em;
          padding-top: 0.5em;
        }

        table.eventList tr.even {
          background-color: #b7c7d7;
        }

        table.eventList .time {
          white-space: nowrap;
          font-size: 75%;
        }
      </style>
      <script type="text/javascript">
        function toggleSibling(el){
          do el = el.nextSibling; while(el && el.nodeType == 3);
          if(el) el.style.display = (el.style.display == "block") ? "none" : "block";
        }
      </script>';

    try{
      $events = $waApiClient->get('events?$filter=IsUpcoming+eq+true');

      if(empty($events)){
        $output .= 'There are no upcoming events to display :(';
      }else{
        usort($events, 'eventCompare');

        $row = 0;
        $output .= '
            <table class="eventList">';
        foreach($events as $event){
          try{
            $row++;
            
            $eventData = $waApiClient->makeRequest($event['Url']);
            $eventData['Details']['DescriptionHtml'] =
              str_replace(
                'src="/',
                'src="https://makeict.wildapricot.org/',
                $eventData['Details']['DescriptionHtml']
              );

            $monthIndex = intval(substr($eventData['StartDate'], 5, 2)) - 1;
            $day = substr($eventData['StartDate'], 8, 2);

            if($eventData['StartDate'] == $eventData['EndDate']){
              $time = 'All day';
            }else{
              $startTime = date('g:ia', strtotime(substr($eventData['StartDate'], 11, 5)));
              //$startTime = substr($eventData['StartDate'], 11, 5);
              $stopTime = date('g:ia', strtotime(substr($eventData['EndDate'], 11, 5)));
              $time = "$startTime - $stopTime";
            }

            $registerURL = "https://makeict.wildapricot.org/event-$eventData[Id]/";
            $mapURL = 'https://www.google.com/maps/search/' . urlencode($eventData['Location']);
            $rowClass = ($row % 2 == 0) ? 'even' : 'odd';
            $output .= "
              <tr class=\"$rowClass\">
                <th>
                  <div>$months[$monthIndex]</div>
                  <div>$day</div>
                  <div class=\"time\">$time</div>
                </th>
                <td>
                  <h3><a href=\"$registerURL\" title=\"View event details\">$eventData[Name]</a></h3>
                  <div><a href=\"$mapURL\" title=\"View on a map\">$eventData[Location]</a></div>
                  <div class=\"detailToggle\" onclick='toggleSibling(this)'>Description (click to expand)</div>
                  <div class=\"details\">" . $eventData['Details']['DescriptionHtml'] . "</div>
                </td>
              </tr>";
          }catch(Exception $exc){
            $output .= '<a title="' . $exc->getMessage() . '">An error occurred while collecting event details :( [eventID:' . $eventData['Id'] . ']</a>';
          }
        }
        $output .= '
          </table>';
      }
    }catch(Exception $exc){
      $output .= '<a title="' . $exc->getMessage() . '">An error occurred while retrieving events :(</a>';
    }
  }

  return $output;
}

function wildapricot_settings_page(){
  ?>
    <div class="wrap">
      <h2>Wild Apricot Shortcode Plugin Settings</h2>

      <form method="post" action="options.php">
        <?php echo settings_fields('wildapricot-settings-group'); ?>
        <?php echo do_settings_sections('wildapricot-settings-group'); ?>
        <table class="form-table">
          <tr valign="top">
            <th scope="row">Wild Apricot API Key</th>
            <td><input type="text" name="wildapricot_api_key" value="<?php echo esc_attr(get_option('wildapricot_api_key')); ?>" /></td>
          </tr>
        </table>
        
        <?php submit_button(); ?>
      </form>
    </div>
  <?php
}

function register_wildapricot_settings() {
  register_setting('wildapricot-settings-group', 'wildapricot_api_key');
}

function wildapricot_create_menu(){
  add_options_page(
    'WildApricot Plugin Settings',
    'Wild Apricot Settings',
    'administrator',
    __FILE__,
    'wildapricot_settings_page'
  );
}

add_shortcode('WildApricot_eventList', 'wildapricot_eventList');
add_action('admin_menu', 'wildapricot_create_menu');
add_action('admin_init', 'register_wildapricot_settings');
