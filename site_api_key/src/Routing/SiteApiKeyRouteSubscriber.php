<?php

namespace Drupal\site_api_key\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Get the value of the route events
 */
class SiteApiKeyRouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    // Get system site information settings route value.
    if ($route = $collection->get('system.site_information_settings')) {
      // Setting custom form to default route.
      $route->setDefault('_form', 'Drupal\site_api_key\Form\SiteApiKeyForm');
    }
  }

}