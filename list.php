<?php
require 'vendor/autoload.php';
require 'utils/HubspotClientHelper.php';
require 'utils/OAuth2Helper.php';

$id = $_GET['id'];
if (!$id) {
    echo 'Hey! I need an ID!';
    exit;
};


$hubSpot = HubspotClientHelper::createFactory();

// https://legacydocs.hubspot.com/docs/methods/lists/get_list
// Client documentiation: vendor/hubspot/hubspot-php/src/Resources/ContactLists.php
$response = $hubSpot->contactLists()->contacts($id);
$contacts = $response['contacts'];
?>
<h1>Everyone on my list</h1>
<ul>
    <?php
    foreach ($contacts as $contact) {
        $properties = $contact['properties'];
        $first_name = $properties;
        echo sprintf('<li>%s</li>', $properties['firstname']['value']);
    }
    ?>
</ul>
