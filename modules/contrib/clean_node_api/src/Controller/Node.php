<?php

namespace Drupal\clean_node_api\Controller;

use Drupal\clean_node_api\Controller\Helper\MainHelper;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Returns responses for nodes .
 */
class Node {

  /**
   * Define body .
   *
   * @var mixed
   */
  private $body;

  /**
   * Define message.
   *
   * @var string
   */
  private $message;

  /**
   * Define status Message.
   *
   * @var string
   */
  private $statusMessage = 'OK';

  /**
   * Define statusCode.
   *
   * @var int
   */
  private $statusCode = 200;

  /**
   * Get node id and returns clean node values .
   *
   * @param \Drupal\node\NodeInterface $node
   *   The node information .
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   The response information .
   */
  public function getNode(NodeInterface $node): JsonResponse {

    $this->body = MainHelper::rebuildFields($node);

    return MainHelper::returnDataInJson($this->body, $this->message, $this->statusCode, $this->statusMessage);

  }

}
