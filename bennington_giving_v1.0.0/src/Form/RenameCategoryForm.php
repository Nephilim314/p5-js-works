<?php

namespace Drupal\bennington_giving\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use \Drupal;
use Drupal\bennington_giving\Version;
use Drupal\bennington_giving\Person;
use Drupal\bennington_giving\Category;
use Drupal\bennington_giving\PersonCategory;

class RenameCategoryForm extends FormBase {
  public function getFormId() {
    return "honor_roll_form";
  }

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['fieldset'] = ['#type' => 'fieldset', '#title' => $this->t('New Honor Roll Upload')];
    $form['fieldset']['honor_roll_csv'] = array(
      '#type' => 'managed_file',
      "#title" => $this->t('Choose an honor roll file (txt files only)'),
      '#multiple' => false,
      '#required' => true,
    );
    $form['fieldset']['year'] = [
      '#type' => 'number',
      '#title' => $this->t('The giving year'),
      '#min' => idate('Y') - 5,
      '#max' => idate('Y') + 10,
      '#size' => 4,
      '#step' => 1,
      '#default_value' => idate('Y'),
      '#required' => true,
    ];
    $form['fieldset']['hr_block'] = ['#markup' => '<hr/>'];
    $form['fieldset']['actions'] = ['#type'=>'actions'];
    $form['fieldset']['actions']['submit'] = [
      "#type" => "submit",
      "#value" => $this->t("Submit")
    ];
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

    $version = Version::next($form_state->getValue('year'));

    error_log("Submitted: ". json_encode($form_state->getValues()));

    error_log("Version: $version");

    $file = File::load($form_state->getValue('honor_roll_csv')[0]);

    $contents = file_get_contents($file->getFileUri());

    $lines = explode("\n", $contents);

    $people = [];
    $categories = [];
    
    $line_length = count($lines);

    for($i = 0; $i < $line_length; $i++) {

      $csv = str_getcsv($lines[$i]);

      $name = array_shift($csv);

      $person = new Person();
      $person->name = $name;
      $person->version = $version;
      $person->save();

      foreach($csv as $cat) {
        if(!isset($categories[$cat])) {
          $categories[$cat] = new Category();
          $categories[$cat]->name = $cat;
          $categories[$cat]->save();
        }

        PersonCategory::add($person, $categories[$cat]);
      }

    }

    drupal_set_message("Honor roll version $version processed successfully.");
  }
}