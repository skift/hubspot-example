<?php
require 'vendor/autoload.php';
require 'utils/HubspotClientHelper.php';
require 'utils/OAuth2Helper.php';

?>
<h1>Every list I have</h1>
<?php
$hubSpot = HubspotClientHelper::createFactory();

// https://legacydocs.hubspot.com/docs/methods/lists/get_list
// Client documentiation: vendor/hubspot/hubspot-php/src/Resources/ContactLists.php
$response = $hubSpot->contactLists()->all();
$all_data = $response['lists'] ?? false;
if (!$all_data) return 'Guess I don\'t have any lists :(';
$base_link = dirname($_SERVER['PHP_SELF']) . '/list.php';

?>
<ul>
<?php
foreach ($all_data as $list) {
  $list_id = $list['listId'];
  $list_name = $list['name'];
  echo sprintf('<li><a href="%1$s?id=%2$s">%3$s</a></li>', $base_link, $list_id, $list_name);
}
?>
</ul>