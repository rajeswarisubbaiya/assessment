Introduction
⦁	Creating a custom module in drupal 8 for adding the site api key in site informaion form at the path "/admin/config/system/site-information".
⦁	Site Api Key module also provides you a url that gives the JSON representation of a given node of content type "page".
⦁	JSON representation is done only when the provided API key matches with the content type.
⦁	Example URL : http://localhost/page_json/FOOBAR12345/17
Requirements
      This module needs to alter the existing Drupal "Site Information" form. Specifics:
⦁	 A new form text field named "Site API Key" needs to be added to the "Site Information" form with the default value of “No API Key yet”.
⦁	When this form is submitted, the value that the user entered for this field should be saved as the system variable named "siteapikey".
⦁	 A Drupal message should inform the user that the Site API Key has been saved with that value.
⦁	When this form is visited after the "Site API Key" is saved, the field should be populated with the correct value.
⦁	The text of the "Save configuration" button should change to "Update Configuration".
⦁	This module also provides a URL that responds with a JSON representation of a given node with the content type "page" only if the previously submitted API Key and a node id (nid) of an appropriate node are present, otherwise it will respond with "access denied".
References
⦁	    For adding new field in the site configuration form I referred to : https://drupal.stackexchange.com/questions/156703/how-can-i-add-a-textbox-in-site-information-configuration


