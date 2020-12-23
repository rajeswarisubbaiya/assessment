CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Recommended modules
 * Installation
 * Configuration
 * Maintainers


INTRODUCTION
------------

A Drupal custom module to add Site Api Key in the site information form which will provide the json format of the content type "page".


REQUIREMENTS
------------

 * A new form text field named "Site API Key" needs to be added to the "Site Information" form with the default value of “No API Key yet”.
 * When this form is submitted, the value that the user entered for this field should be saved as the system variable named "siteapikey".
 * A Drupal message should inform the user that the Site API Key has been saved with that value.
 * When this form is visited after the "Site API Key" is saved, the field should be populated with the correct value.
 * The text of the "Save configuration" button should change to "Update Configuration".
 * This module also provides a URL that responds with a JSON representation of a given node with the content type "page" only if the previously submitted API Key and a node id (nid) of an appropriate node are present, otherwise it will respond with "access denied".


RECOMMENDED MODULES
-------------------

 No dependency module required.

INSTALLATION
------------

 * Enable the site_api_key module in the Module page

 * The field to enter the Site Api Key is present in the url "/admin/config/system/site-information".


EXAMPLE URL
-------------

http://localhost/page_json/FOOBAR12345/17


RESOURCES USED
-----------
 * https://drupal.stackexchange.com/questions/156703/how-can-i-add-a-textbox-in-site-information-configuration
 * https://www.drupal.org/docs/8/api/routing-system/parameters-in-routes/using-parameters-in-routes
 * https://www.drupal.org/docs/drupal-apis/routing-system/structure-of-routes

TIME REQUIRED
-------------

 * Took me around 10 hours.


 

