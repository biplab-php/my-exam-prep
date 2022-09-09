<?php

namespace Drupal\clean_node_api\Controller\Helper;

use Drupal\file\Entity\File;
use Drupal\node\Entity\Node;
use Drupal\node\NodeInterface;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\taxonomy\Entity\Term;
use Drupal\user\Entity\User;

/**
 * Process fields.
 */
class Fields {

  public const FIELD = 'field_';

  public const EMPTY = '';

  public const VALUE = 'value';

  public const TARGET_ID = 'target_id';

  /**
   * Params.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param array $values
   *   Values Param.
   * @param string $key
   *   Key Param.
   *
   * @return array
   *   Return in array
   */
  public static function booleanFields(string $fieldType, array $data, array $values, string $key): array {
    $newValues = NULL;
    if ($fieldType === 'boolean') {
      foreach ($values as $value) {
        $newValues = [self::VALUE => (bool) $value];
      }
      $data = self::getArrayPush($data, $key, $newValues);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Params.
   *
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function getArrayPush(array $data, string $key, array $values) {
    $data[] = [str_replace(self::FIELD, self::EMPTY, $key) => $values];
    // Return Data in array.
    return $data;
  }

  /**
   * Params.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param array $values
   *   Values Param.
   * @param string $key
   *   Key Param.
   *
   * @return array
   *   Return in array
   */
  public static function changedFields(string $fieldType, array $data, array $values, string $key): array {

    if ($fieldType === 'changed') {
      $data = self::changeTypeToInt($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Params.
   *
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function changeTypeToInt(array $data, string $key, array $values) {
    $newValues = NULL;
    foreach ($values as $newValue) {
      $newValues[] = [self::VALUE => (int) $newValue[self::VALUE]];
    }
    return self::getArrayPush($data, $key, $newValues);
  }

  /**
   * Params.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param array $values
   *   Values Param.
   * @param string $key
   *   Key Param.
   *
   * @return array
   *   Return in array
   */
  public static function commentFields(string $fieldType, array $data, array $values, string $key): array {
    if ($fieldType === 'comment') {

      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Params.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param array $values
   *   Values Param.
   * @param string $key
   *   Key Param.
   *
   * @return array
   *   Return in array
   */
  public static function createdFields(string $fieldType, array $data, array $values, string $key): array {

    if ($fieldType === 'created') {
      $data = self::changeTypeToInt($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Params.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param array $values
   *   Values Param.
   * @param string $key
   *   Key Param.
   *
   * @return array
   *   Return in array
   */
  public static function datetimeFields(string $fieldType, array $data, array $values, string $key): array {
    if ($fieldType === 'datetime') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Params.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param array $values
   *   Values Param.
   * @param string $key
   *   Key Param.
   *
   * @return array
   *   Return in array
   */
  public static function daterangeFields(string $fieldType, array $data, array $values, string $key): array {
    if ($fieldType === 'daterange') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Params.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param array $values
   *   Values Param.
   * @param string $key
   *   Key Param.
   *
   * @return array
   *   Return in array
   */
  public static function decimalFields(string $fieldType, array $data, array $values, string $key): array {
    if ($fieldType === 'decimal') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Params.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function emailFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'email') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Params.
   *
   * @param \Drupal\node\NodeInterface $node
   *   Node Param.
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function entityReferenceFields(NodeInterface $node, string $fieldType, array $data, string $key, array $values) {
    $entityData = NULL;
    if ($fieldType === 'entity_reference') {

      $entityData = self::referenceControl($node, $key, $values, $entityData);

      $data = self::getArrayPush($data, $key, $entityData);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Params.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function fileFields(string $fieldType, array $data, string $key, array $values) {
    $entityData = NULL;
    if ($fieldType === 'file') {
      foreach ($values as $id) {
        $entity = File::load($id[self::TARGET_ID]);
        if ($entity) {
          $entityData[] = [
            'fid' => (int) $entity->id(),
            'filename' => $entity->filename->value,
            'uri' => file_url_transform_relative(file_create_url($entity->getFileUri())),
          ];
        }
      }

      $data = self::getArrayPush($data, $key, $entityData);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Params.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function floatFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'float') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Params.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function imageFields(string $fieldType, array $data, string $key, array $values) {
    $entityData = NULL;
    if ($fieldType === 'image') {
      foreach ($values as $id) {
        $entity = File::load($id[self::TARGET_ID]);
        if ($entity) {
          $entityData[] = [
            'fid' => (int) $entity->id(),
            'alt' => $id['alt'],
            'title' => $id['title'],
            'width' => (int) $id['width'],
            'height' => (int) $id['height'],
            'filename' => $entity->filename->value,
            'uri' => file_url_transform_relative(file_create_url($entity->getFileUri())),
          ];
        }
      }
      $data = self::getArrayPush($data, $key, $entityData);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Params.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function integerFields(string $fieldType, array $data, string $key, array $values) {

    if ($fieldType === 'integer') {
      $data = self::changeTypeToInt($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Params.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function languageFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'language') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Params.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function linkFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'link') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Param.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function listFloatFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'list_float') {

      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Param.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function listIntegerFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'list_integer') {
      $data = self::changeTypeToInt($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Param.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function listStringFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'list_string') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Param.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function mapFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'map') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Param.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function passwordFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'password') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Param.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function pathFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'path') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Param.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function stringFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'string') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Param.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function stringLongFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'string_long') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Param.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function telephoneFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'telephone') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Param.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function textFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'text') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Param.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function textLongFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'text_long') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Param.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function textWithSummaryFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'text_with_summary') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Param.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function timestampFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'timestamp') {
      $data = self::changeTypeToInt($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Param.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function uriFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'uri') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Param.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function uuidFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'uuid') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Param.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function dynamicEntityReferenceFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'dynamic_entity_reference') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Param.
   *
   * @param \Drupal\node\NodeInterface $node
   *   Node param.
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function entityReferenceRevisionsFields(NodeInterface $node, string $fieldType, array $data, string $key, array $values) {
    $entity = NULL;
    $entityData = NULL;
    if ($fieldType === 'entity_reference_revisions') {
      $entityType = $node->get($key)
        ->getFieldDefinition()
        ->getSettings()['target_type'];
      if ($entityType === 'paragraph') {
        foreach ($values as $id) {
          $entity = Paragraph::load($id[self::TARGET_ID]);
          if ($entity) {
            $entityData[] = [
              'pid' => (int) $entity->id(),
              'pData' => MainHelper::rebuildFields($entity),
            ];
          }
        }
      }
      $data = self::getArrayPush($data, $key, $entityData);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Param.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function videoFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'video') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Param.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function jqueryColorPickerFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'jquery_colorpicker') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Param.
   *
   * @param string $fieldType
   *   FieldType Param.
   * @param array $data
   *   Data Param.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Values Param.
   *
   * @return mixed
   *   Return in mixed .
   */
  public static function metatagFields(string $fieldType, array $data, string $key, array $values) {
    if ($fieldType === 'metatag') {
      $data = self::getArrayPush($data, $key, $values);
    }
    // Return Data in array.
    return $data;
  }

  /**
   * Reference Control .
   *
   * @param \Drupal\node\NodeInterface $node
   *   Node interface.
   * @param string $key
   *   Key Param.
   * @param array $values
   *   Value Param.
   * @param array|null $entityData
   *   Entity Param.
   *
   * @return array|null
   *   Return array|null
   */
  public static function referenceControl(NodeInterface $node, string $key, array $values, ?array $entityData) {
    $entityType = $node->get($key)->getFieldDefinition()->getSettings()['target_type'];

    if ($entityType === 'user') {

      $entityData = self::renderUserReference($values, $entityData);

    }
    elseif ($entityType === 'taxonomy_term') {

      $entityData = self::renderTaxonomyTermReference($values, $entityData);

    }
    elseif ($entityType === 'node') {

      $entityData = self::renderNodeReference($values, $entityData);

    }
    else {

      $entityData = $values;

    }
    // Return data.
    return $entityData;

  }

  /**
   * Render User Reference.
   *
   * @param array $values
   *   Value Param.
   * @param array|null $entityData
   *   EntityData Param.
   *
   * @return array|null
   *   Return array|null
   */
  public static function renderUserReference(array $values, ?array $entityData) {
    foreach ($values as $id) {
      $entity = User::load($id[self::TARGET_ID]);
      if ($entity) {
        $entityData[] = [
          'uid' => (int) $entity->id(),
          'uuid' => $entity->uuid(),
          'name' => $entity->name->value,
        ];
      }
    }
    // Return Data.
    return $entityData;
  }

  /**
   * Render Taxonomy Term Reference.
   *
   * @param array $values
   *   Value Param.
   * @param array|null $entityData
   *   EntityData Param.
   *
   * @return array|null
   *   Return array|null
   */
  public static function renderTaxonomyTermReference(array $values, ?array $entityData) {
    foreach ($values as $id) {
      $entity = Term::load($id[self::TARGET_ID]);
      if ($entity) {
        $entityData[] = [
          'tid' => (int) $entity->id(),
          'name' => $entity->name->value,
        ];
      }
    }
    // Return Data.
    return $entityData;
  }

  /**
   * Render Node Reference.
   *
   * @param array $values
   *   Value Param.
   * @param array|null $entityData
   *   EntityData Param.
   *
   * @return array|null
   *   Return array|null
   */
  public static function renderNodeReference(array $values, ?array $entityData) {
    foreach ($values as $id) {
      $entity = Node::load($id[self::TARGET_ID]);
      if ($entity) {
        $entityData[] = [
          'nid' => (int) $entity->id(),
          'name' => $entity->getTitle(),
        ];
      }
    }
    // Return Data.
    return $entityData;
  }

}
