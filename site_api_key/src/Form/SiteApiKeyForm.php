<?php

namespace Drupal\site_api_key\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\system\Form\SiteInformationForm;

/**
 * Setting for adding the site api key
 */
class SiteApiKeyForm extends SiteInformationForm {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'system_site_information_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'system.site',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildform($form, $form_state);

    // Getting the site information key value and setting to siteapikey
    $config = $this->config('system.site');
    $apikey = $config->get('siteapikey');

    // Set default value to No API key yet
    if (empty($apikey)) {
      $apikey = 'No API Key yet';
    }
    // Create textfield for Site API Key.
    $form['site_information']['siteapikey'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Site API Key'),
      '#description' => $this->t('The site api key to access JSON representation of page nodes.'),
      '#default_value' => $apikey,
    ];

    // changing the submit to update configuration
    $form['actions']['submit']['#value'] = $this->t('Update Configuration');

    // Return the altered form.
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    // Getting the submitted values.
    $values = $form_state->getValues();

    // Save the entered site API key in configuration.
    $this->config('system.site')
      ->set('siteapikey', $values['siteapikey'])
      ->save();

    // Set the message based on the submitted Site API Key.
    if (!empty($values['siteapikey']) && $values['siteapikey'] != "No API Key yet") {
      $this->messenger()->addStatus($this->t('Your site api key has been successfully created "@key".', ['@key' => $values['siteapikey']]));
    }
    else {
      $this->messenger()->addStatus($this->t('Site API Key is not added yet.'));
    }
  }

}