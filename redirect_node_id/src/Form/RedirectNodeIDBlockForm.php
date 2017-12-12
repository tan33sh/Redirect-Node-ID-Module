<?php

namespace Drupal\redirect_node_id\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Redirect Node ID block form
 */
class RedirectNodeIDBlockForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'redirect_node_id_block_form';
  }
 /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // How many paragraphs?
    // $options = new array();
    // How many phrases?
    $form['id'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Node ID'),
      '#default_value' => '1',
      '#description' => $this->t('Node ID of the page which you would like to view.'),
    );

    // Submit.
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('View'),
    );

    return $form;
  }
 /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $id = $form_state->getValue('id');
    if (!is_numeric($id)) {
      $form_state->setErrorByName('id', $this->t('Please use a number.'));
    }

    if (floor($id) != $id) {
      $form_state->setErrorByName('id', $this->t('No decimals, please.'));
    }
    
    if ($id < 1) {
      $form_state->setErrorByName('id', $this->t('Please use a number greater than zero.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $form_state->setRedirect(
      'redirect_node_id.generate',
      array(
        'id' => $form_state->getValue('id'),
      )
    );
  }
}
