<?php

namespace Drupal\clean_node_api\Controller\Helper;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * MainHelper for Node class .
 */
class MainHelper {

  /**
   * Params Description .
   *
   * @param mixed $body
   *   Return in $body.
   * @param string $message
   *   Return in $message.
   * @param int $statusCode
   *   Return in $statusCode.
   * @param string $statusMessage
   *   Return in $statusMessage.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   The response information .
   */
  public static function returnDataInJson($body, $message, $statusCode, $statusMessage): JsonResponse {
    $data = [
      'body' => $body,
      'message' => $message,
    ];
    $jsonResponse = new JsonResponse($data);

    // Return value in json.
    return $jsonResponse->setStatusCode($statusCode, $statusMessage);
  }

  /**
   * Rebuild Fields.
   *
   * @param mixed $node
   *
   *   Return data in array .
   *
   * @return array
   *   Return data in array .
   */
  public static function rebuildFields($node): array {
    $data = [];
    $array = $node->toArray();

    foreach ($array as $key => $values) {
      $fieldType = $node->get($key)->getFieldDefinition()->getType();

      $data = Fields::booleanFields($fieldType, $data, $values, $key);

      $data = Fields::changedFields($fieldType, $data, $values, $key);

      $data = Fields::commentFields($fieldType, $data, $values, $key);

      $data = Fields::createdFields($fieldType, $data, $values, $key);

      $data = Fields::datetimeFields($fieldType, $data, $values, $key);

      $data = Fields::daterangeFields($fieldType, $data, $values, $key);

      $data = Fields::decimalFields($fieldType, $data, $values, $key);

      $data = Fields::emailFields($fieldType, $data, $key, $values);

      $data = Fields::entityReferenceFields($node, $fieldType, $data, $key, $values);

      $data = Fields::fileFields($fieldType, $data, $key, $values);

      $data = Fields::floatFields($fieldType, $data, $key, $values);

      $data = Fields::imageFields($fieldType, $data, $key, $values);

      $data = Fields::integerFields($fieldType, $data, $key, $values);

      $data = Fields::languageFields($fieldType, $data, $key, $values);

      $data = Fields::linkFields($fieldType, $data, $key, $values);

      $data = Fields::listFloatFields($fieldType, $data, $key, $values);

      $data = Fields::listIntegerFields($fieldType, $data, $key, $values);

      $data = Fields::listStringFields($fieldType, $data, $key, $values);

      $data = Fields::mapFields($fieldType, $data, $key, $values);

      $data = Fields::passwordFields($fieldType, $data, $key, $values);

      $data = Fields::pathFields($fieldType, $data, $key, $values);

      $data = Fields::stringFields($fieldType, $data, $key, $values);

      $data = Fields::stringLongFields($fieldType, $data, $key, $values);

      $data = Fields::telephoneFields($fieldType, $data, $key, $values);

      $data = Fields::textFields($fieldType, $data, $key, $values);

      $data = Fields::textLongFields($fieldType, $data, $key, $values);

      $data = Fields::textWithSummaryFields($fieldType, $data, $key, $values);

      $data = Fields::timestampFields($fieldType, $data, $key, $values);

      $data = Fields::uriFields($fieldType, $data, $key, $values);

      $data = Fields::uuidFields($fieldType, $data, $key, $values);

      $data = Fields::dynamicEntityReferenceFields($fieldType, $data, $key, $values);

      $data = Fields::entityReferenceRevisionsFields($node, $fieldType, $data, $key, $values);

      $data = Fields::videoFields($fieldType, $data, $key, $values);

      $data = Fields::jqueryColorPickerFields($fieldType, $data, $key, $values);

      $data = Fields::metatagFields($fieldType, $data, $key, $values);

    }

    // Push data in variable and return.
    return $data;
  }

}
