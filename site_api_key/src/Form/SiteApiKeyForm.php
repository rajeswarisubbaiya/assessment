<?php

namespace Drupal\site_api_key\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\system\Form\SiteInformationForm;

/**
 * Settings form for adding site api key.
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
  // public function buildForm(array $form, FormStateInterface $form_state) {
  //   $form = parent::buildform($form, $form_state);

  //   // Load the Site Information configuration and extract Site API Key from it.
  //   $config = $this->config('system.site');
  //   $apikey = $config->get('siteapikey');

  //   // Set a default value if Key is not set.
  //   if (empty($apikey)) {
  //     $apikey = 'No API Key yet';
  //   }
  //   // Create textfield for storing Site API Key.
  //   $form['site_information']['siteapikey'] = [
  //     '#type' => 'textfield',
  //     '#title' => $this->t('Site API Key'),
  //     '#description' => $this->t('The private key to access JSON representation of page nodes.'),
  //     '#default_value' => $apikey,
  //   ];

  //   // Change the submit button title.
  //   $form['actions']['submit']['#value'] = $this->t('Update Configuration');

  //   // Return the altered form.
  //   return $form;
  // }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    // Get the submitted form values.
    $values = $form_state->getValues();

    // Save the submitted Site API Key in configuration.
    $this->config('system.site')
      ->set('siteapikey', $values['siteapikey'])
      ->save();

    // Set the message based on the submitted Site API Key.
    if (!empty($values['siteapikey']) && $values['siteapikey'] != "No API Key yet") {
      $this->messenger()->addStatus($this->t('The Site API Key has been saved with value "@key".', ['@key' => $values['siteapikey']]));
    }
    else {
      $this->messenger()->addStatus($this->t('Site API Key is not added yet.'));
    }
  }

}