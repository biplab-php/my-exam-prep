<?php

namespace Drupal\rest_register_verify_email\Plugin\rest\resource;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ModifiedResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Psr\Log\LoggerInterface;
use Drupal\user\UserStorageInterface;

/**
 * Provides a resource to Resend Email verification token to user.
 *
 * @RestResource(
 *   id = "resend_token_email_resource",
 *   label = @Translation("Resend verification email"),
 *   uri_paths = {
 *     "canonical" = "/rest/resend-token",
 *     "create" = "/rest/resend-token"
 *   }
 * )
 */
class ResendTempTokenRestResource extends ResourceBase {

  /**
   * A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * The user storage.
   *
   * @var \Drupal\user\UserStorageInterface
   */
  protected $userStorage;

  /**
   * Constructs a new CreateAccountRestResource object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param array $serializer_formats
   *   The available serialization formats.
   * @param \Psr\Log\LoggerInterface $logger
   *   A logger instance.
   * @param \Drupal\Core\Session\AccountProxyInterface $current_user
   *   A current user instance.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    array $serializer_formats,
    LoggerInterface $logger,
    AccountProxyInterface $current_user,
    UserStorageInterface $user_storage) {
      parent::__construct($configuration, $plugin_id, $plugin_definition, $serializer_formats, $logger);
      $this->currentUser = $current_user;
      $this->userStorage = $user_storage;
      $this->logger = $logger;
    }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->getParameter('serializer.formats'),
      $container->get('logger.factory')->get('rest_register_verify_email'),
      $container->get('current_user'),
      $container->get('entity_type.manager')->getStorage('user')
    );
  }

  /**
   * Responds to POST requests with email address.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   *   Throws exception expected.
   */
  public function post(array $data) {
    $response = ['message' => 'An email address is required.'];
    $code = 400;

    if (!empty($data['mail'])) {
      $code = 400;
      $response = [
        'message' => 'We are unable to send a new verification email to this address. Please double check for typos and try again.',
      ];

      $email = $data['mail'];
      $user = user_load_by_mail($email);

      if ($user) {
        $active = $user->isActive();
      }

      if ($user && !$active)
      try {

        // Mail a temp token.
        $mail = _rest_register_verify_email_user_mail_notify('email_verify_register_rest', $user);
        if (!empty($mail)) {
          $this->logger->notice('Account Verification Token instructions mailed to %email.', ['%email' => $email]);
          $response = ['message' => 'Further instructions have been sent to your email address.'];
          $code = 200;
        }
        else {
          $response = ['message' => 'Sorry system can\'t send email at the moment, please try again in a moment.'];
          $code = '400';
        }
      }
      catch (Exception $e) {
        // Something went wrong somewhere.
        \Drupal::logger('rest_register_verify_email')->error($e->getMessage());

        $code = 400;
        $response = [
          'message' => 'Uh oh, we caught an error... please try again.',
          'error' => $e->getMessage(),
        ];
      }
    }

    return new ModifiedResourceResponse($response, $code);
  }
}
