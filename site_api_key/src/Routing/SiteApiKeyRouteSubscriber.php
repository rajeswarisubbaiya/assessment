<?php

namespace Drupal\site_api_key\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class SiteApiKeyRouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    // Load system site information settings route.
    if ($route = $collection->get('system.site_information_settings')) {
      // Set custom form to default route.
      $route->setDefault('_form', 'Drupal\site_api_key\Form\SiteApiKeyForm');
    }
  }

}