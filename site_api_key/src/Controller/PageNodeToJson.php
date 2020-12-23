<?php

namespace Drupal\site_api_key\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Gives json format for content type page.
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
  public function content($apikey, $nid) {
    $site_api_key = $this->configFactory->getEditable('system.site')->get('siteapikey');
    // checking the condition whether key value and the node is present
    if (!empty($apikey) && !empty($nid)) {
      if ($site_api_key == $apikey && $nid->bundle() == 'page') {
        return new JsonResponse($nid->toArray(), 200);
      }
      else {
        throw new AccessDeniedHttpException();
      }
    }
    // else shows access denied.
    else {
      throw new AccessDeniedHttpException();
    }
  }
}