<?php

namespace Drupal\rest_api_authentication;
use Drupal\Core\Form\FormStateInterface;
class setupAuthenticationForm{
  public static function insertForm(array &$form, FormStateInterface $form_state){
    global $base_url;
    $form['markup_library_3'] = array(
      '#attached' => array(
        'library' => array(
          "rest_api_authentication/rest_api_authentication.basic_style_settings",
        )
      ),
    );
    $form['api_auth'] = [
      '#type' => 'details',
      '#title' => t('Setup Authentication Method'),
      '#open' => TRUE,
      '#group' => 'verticaltabs',
    ];

    $form['api_auth']['mo_rest_api_authentication_authenticator']['head_text'] = array(
      '#markup' => '<div><b>SELECT AUTHENTICATION METHOD OF YOUR CHOICE: </b><a class=" shift-right" target="_blank" href="https://plugins.miniorange.com/drupal-api-authentication"><b>How To Setup?</b></a></div><hr><br><div class="mo_rest_api_highlight_background_note_1">Need any help? We can help you with configuring your API authentication method. Just send us a query and we will get back to you soon.</div>',
    );

    $form['api_auth']['mo_rest_api_authentication_authenticator']['settings']['active'] = array(
      '#type' => 'radios',
      '#prefix' => '<br>',
      '#title' => '',
      '#default_value' => \Drupal::config('rest_api_authentication.settings')->get('authentication_method'),
      '#options' => array(
        0 => ('<b>Basic Authentication</b>'),
        1 => t('<b>API Key</b>'),
        2 => t('<b>OAuth <a href = "'.$base_url.'/admin/config/people/rest_api_authentication/auth_settings/?tab=edit-upgrade-plans">[Premium]</b></a></b>'),
        3 => t('<b>JWT <a href = "'.$base_url.'/admin/config/people/rest_api_authentication/auth_settings/?tab=edit-upgrade-plans">[Premium]</b></a></b>'),
        4 => t('<b>3rd Party <a href = "'.$base_url.'/admin/config/people/rest_api_authentication/auth_settings/?tab=edit-upgrade-plans">[Premium]</b></a></b>'),
      ),
      '#attributes' => array('class' => array('container-inline')),
    );

    $form['api_auth']['rest_api_authentication_method_submit'] = array(
      '#type' => 'submit',
      '#button_type' => 'primary',
      '#states' => array('visible' => array(':input[name = "active"]' => array('value' => 0 ), ),),
      '#value' => t('Select Method'),
      '#submit' => array('::rest_api_authentication_save_basic_auth_conf'),
    );


    $form['api_auth']['mo_rest_api_authentication_authenticator']['rest_api_authentication_ext_oauth'] = array(
      '#type' => 'textfield',
      '#id'  => 'rest_api_authentication_token_key',
      '#states' => array('visible' => array(':input[name = "active"]' => array('value' => 4 ), ),),
      '#title' => t('User Info Endpoint: '),
      '#disabled' => TRUE,
      '#default_value' => \Drupal::config('rest_api_authentication.settings')->get('user_info_endpoint'),
      '#attributes' => array('style' => 'width:100%'),
    );
    $form['api_auth']['mo_rest_api_authentication_authenticator']['rest_api_authentication_ext_oauth_username'] = array(
      '#type' => 'textfield',
      '#disabled' => TRUE,
      '#id'  => 'rest_api_authentication_token_key',
      '#states' => array('visible' => array(':input[name = "active"]' => array('value' => 4 ), ),),
      '#title' => t('Username Attribute: '),
      '#default_value' => \Drupal::config('rest_api_authentication.settings')->get('username_attribute'),
      '#attributes' => array('style' => 'width:100%'),
    );
    $form['api_auth']['rest_api_authentication_save_ext_oauth'] = array(
      '#type' => 'submit',
      '#disabled' => TRUE,
      '#button_type' => 'primary',
      '#value' => t('Save Configurations'),
      '#states' => array('visible' => array(':input[name = "active"]' => array('value' => 4 ), ),),
      '#submit' => array('::rest_api_authentication_save_ext_oauth'),
    );

    $form['api_auth']['mo_rest_api_authentication_authenticator']['rest_api_authentication_key'] = array(
      '#type' => 'textfield',
      '#id'  => 'rest_api_authentication_token_key',
      '#states' => array('visible' => array(':input[name = "active"]' => array('value' => 1 ), ),),
      '#title' => t('API Key required for Authentication: '),
      '#default_value' => \Drupal::config('rest_api_authentication.settings')->get('api_token'),
      '#attributes' => array('style' => 'width:100%'),
    );
    $form['api_auth']['rest_api_authentication_generate_key'] = array(
      '#type' => 'submit',
      '#button_type' => 'primary',
      '#value' => t('Generate API Key'),
      '#states' => array('visible' => array(':input[name = "active"]' => array('value' => 1 ), ),),
      '#submit' => array('::rest_api_authentication_generate_api_token'),
    );

    $form['api_auth']['rest_api_authentication_key_generate_all_keys'] = array(
      '#type' => 'checkbox',
      '#disabled' => TRUE,
      '#title' => t('Generate separate API Keys for all Drupal users <a href = "'.$base_url.'/admin/config/people/rest_api_authentication/auth_settings/?tab=edit-upgrade-plans"><b>[Premium]</b></a>'),
      '#states' => array('visible' => array(':input[name = "active"]' => array('value' => 1 ), ),),
    );
    $form['api_auth']['rest_api_authentication_key_generate_akey'] = array(
      '#type' => 'checkbox',
      '#disabled' => TRUE,
      '#title' => t('Reset API Key for a specific Drupal user <a href = "'.$base_url.'/admin/config/people/rest_api_authentication/auth_settings/?tab=edit-upgrade-plans"><b>[Premium]</b></a>'),
      '#states' => array('visible' => array(':input[name = "active"]' => array('value' => 1 ), ),),
    );

    $form['api_auth']['mo_rest_api_authentication_authenticator']['rest_api_authentication_oauth_client_id'] = array(
      '#type' => 'textfield',
      '#id'  => 'rest_api_authentication_token_key',
      '#states' => array('visible' => array(':input[name = "active"]' => array('value' => 2 ), ),),
      '#title' => t('Client ID: '),
      '#default_value' => \Drupal::config('rest_api_authentication.settings')->get('oauth_client_id'),
      '#attributes' => array('style' => 'width:100%'),
      '#disabled' => 'true',
    );
    $form['api_auth']['mo_rest_api_authentication_authenticator']['rest_api_authentication_oauth_client_secret'] = array(
      '#type' => 'textfield',
      '#id'  => 'rest_api_authentication_token_key',
      '#states' => array('visible' => array(':input[name = "active"]' => array('value' => 2 ), ),),
      '#title' => t('Client Secret: '),
      '#default_value' => \Drupal::config('rest_api_authentication.settings')->get('oauth_client_secret'),
      '#attributes' => array('style' => 'width:100%'),
      '#disabled' => 'true',
    );
    $form['api_auth']['rest_api_authentication_generate_and_secret'] = array(
      '#type' => 'submit',
      '#disabled' => TRUE,
      '#value' => t('Generate a new Client ID and Secret'),
      '#states' => array('visible' => array(':input[name = "active"]' => array('value' => 2 ), ),),
      '#submit' => array('::rest_api_authentication_generate_oauth_keys'),
    );
    $form['api_auth']['rest_api_authentication_save_oauth_config'] = array(
      '#type' => 'submit',
      '#disabled' => TRUE,
      '#button_type' => 'primary',
      '#value' => t('Save Settings'),
      '#states' => array('visible' => array(':input[name = "active"]' => array('value' => 2 ), ),),
      '#submit' => array('::rest_api_authentication_save_oauth_token'),
    );
    $form['api_auth']['rest_api_authentication_generate_id_token'] = array(
      '#type' => 'submit',
      '#button_type' => 'primary',
      '#disabled' => TRUE,
      '#value' => t('Save JWT Configuration'),
      '#states' => array('visible' => array(':input[name = "active"]' => array('value' => 3 ), ),),
      '#submit' => array('::rest_api_authentication_save_id_token'),
    );
    $form['api_auth']['select_api_head_text'] = array(
      '#markup' => '<br><br><b>APIs TO BE RESTRICTED: </b><a href = "'.$base_url.'/admin/config/people/rest_api_authentication/auth_settings/?tab=edit-upgrade-plans"><b>[PREMIUM]</b></a><hr>',
    );
    $form['api_auth']['head_api_options'] = array(
      '#type' => 'checkbox',
      '#title' => '<b><a target="_blank" href="https://www.drupal.org/docs/8/core/modules/rest">RESTful Web Services APIs</a></b> (Always specify the <b>?_format=</b> query argument, e.g. http://example.com/node/1?_format=json)',
      '#default_value' => "1",
      '#disabled' => true,
      '#attributes' => array('class' => array('container-inline')),
    );

    $form['api_auth']['head_jsonapi_options'] = array(
      '#type' => 'checkbox',
      '#title' => '<b><a href="https://www.drupal.org/docs/core-modules-and-themes/core-modules/jsonapi-module" target="_blank">JSON:API module APIs</a></b> (Always specify the <b><u>/jsonapi/</u></b> in the API, e.g. http://example.com/jsonapi/node/article/{{article_uuid}})',
      '#default_value' => "1",
      '#disabled' => true,
      '#attributes' => array('class' => array('container-inline')),
    );

    $form['api_auth']['head_customapi_options'] = array(
      '#type' => 'checkbox',
      '#title' => 'Any Other/Custom APIs',
      '#default_value' => "0",
      '#disabled' => true,
      '#attributes' => array('class' => array('container-inline')),
    );

    return $form;
  }
}
