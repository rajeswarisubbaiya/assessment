<?php

namespace Drupal\site_api_key\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides json responses for content type page.
 */
class PageNodeToJson extends ControllerBase {

  /**
   * The configuration factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * PageNodeToJson constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * Static create.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   The container.
   *
   * @return static
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')
    );
  }

  /**
   * Controller callback.
   *
   * @param string $key
   *   Site API Key.
   * @param object $nid
   *   The node object.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   The Node JSON.
   */
  public function content($key, $nid) {
    // Fetch the site api key from configuration object.
    $site_api_key = $this->configFactory->getEditable('system.site')->get('siteapikey');

    // If key and node exist then return JSON output.
    if (!empty($key) && !empty($nid)) {
      // If key in url is same as Site API Key and Node object is page, Then
      // return the Node JSON. Else deny the access.
      if ($site_api_key == $key && $nid->bundle() == 'page') {
        return new JsonResponse($nid->toArray(), 200);
      }
      else {
        throw new AccessDeniedHttpException();
      }
    }
    // Otherwise show Access Denied.
    else {
      throw new AccessDeniedHttpException();
    }
  }

}