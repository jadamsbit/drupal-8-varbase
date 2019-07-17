<?php

namespace Drupal\Tests\simple_oauth\Functional;

use Drupal\Core\Url;

/**
 *
 */
trait RequestHelperTrait {

  /**
   * POST a request.
   *
   * The base methods do not provide a non-form submission POST method.
   *
   * @see https://www.drupal.org/project/drupal/issues/2908589#comment-12258839
   *
   * @param \Drupal\Core\Url $url
   *   The URL.
   * @param array $data
   *   The data to send.
   * @param array $options
   *   Optional options to pass to client.
   *
   * @return \Psr\Http\Message\ResponseInterface
   *   The response.
   */
  protected function post(Url $url, array $data, array $options = []) {
    $post_url = $this->getAbsoluteUrl($url->toString());
    $session = $this->getSession();
    $session->setCookie('SIMPLETEST_USER_AGENT', drupal_generate_test_ua($this->databasePrefix));
    return $this->getHttpClient()->request('POST', $post_url, [
      'form_params' => $data,
      'http_errors' => FALSE,
    ] + $options);
  }

  /**
   * GET a resource, with options.
   *
   * @param \Drupal\Core\Url $url
   * @param array $options
   *
   * @return mixed
   */
  protected function get(Url $url, $options = []) {
    $session = $this->getSession();
    $get_url = $this->getAbsoluteUrl($url->toString());
    $session->setCookie('SIMPLETEST_USER_AGENT', drupal_generate_test_ua($this->databasePrefix));
    return $this->getHttpClient()->get($get_url, $options);
  }

}
