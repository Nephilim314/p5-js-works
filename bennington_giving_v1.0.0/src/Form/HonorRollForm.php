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

class HonorRollForm extends FormBase {
  public function getFormId() {
    return "honor_roll_form";
  }

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['fieldset'] = ['#type' => 'fieldset', '#title' => $this->t('New Donor Roll Upload')];
    $form['fieldset']['honor_roll_csv'] = array(
      '#type' => 'managed_file',
      "#title" => $this->t('Choose a donor roll file. CSV extension is not allowed by Drupal. Please upload only .txt files.'),
      '#multiple' => false,
      '#required' => true,
    );
    // $form['fieldset']['year'] = [
    //   '#type' => 'number',
    //   '#title' => $this->t('The giving year'),
    //   '#min' => idate('Y') - 5,
    //   '#max' => idate('Y') + 10,
    //   '#size' => 4,
    //   '#step' => 1,
    //   '#default_value' => idate('Y'),
    //   '#required' => true,
    // ];
    $form['fieldset']['hr_block'] = ['#markup' => '<hr/>'];
    $form['fieldset']['actions'] = ['#type'=>'actions'];
    $form['fieldset']['actions']['submit'] = [
      "#type" => "submit",
      "#value" => $this->t("Submit")
    ];
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

    // $version = Version::next($form_state->getValue('year'));
    $version = Version::next('2017');

    error_log("Submitted: ". json_encode($form_state->getValues()));

    error_log("Version: $version");

    $file = File::load($form_state->getValue('honor_roll_csv')[0]);

    $contents = file_get_contents($file->getFileUri());

    $lines = explode("\n", $contents);
    
    $line_length = count($lines);

    $categories = $this->columns();
    $categories_map = $this->create_category_map(str_getcsv(strtolower($lines[0])), $categories);

    for($i = 1; $i < $line_length; $i++) {

      $csv = str_getcsv($lines[$i]);

      //Sort order
      $sort_order = trim($this->getInCsv('sort key', $csv, $categories, $categories_map), '"');

      //Name
      $name = trim($this->getInCsv('donor book listing', $csv, $categories, $categories_map), '"');

      if(empty($name)) {
        error_log("Encountered empty name on line $i: ". $lines[$i]);
        continue;
      }

      //Decade
      $decade = null;
      $year = $this->getInCsv('undergraduate class year', $csv, $categories, $categories_map);
      $parent_year = $this->getInCsv('parent class year', $csv, $categories, $categories_map);
      if(empty($year)) {
        $year = $this->getInCsv('graduate class year', $csv, $categories, $categories_map);
      }
      if(empty($year)) {
        $year = $parent_year;
      }
      if(!empty($year)) {
        $decade = intval($year) - (intval($year) % 10);
      }

      $person = new Person();
      $person->name = $name;
      $person->sort_order = $sort_order;
      $person->version = $version;
      $person->decade = (!empty($decade)) ? $decade : 0;
      $person->grad_year = $year ?: null;
      $person->parent_year = $parent_year ?: null;

      $person->save();

      //Giving Categories
      $giving_category = $this->getInCsv('giving category', $csv, $categories, $categories_map);
      if(!empty($giving_category)) {
        $this->addPersonToCategory($person, $giving_category);
      }

      $giving_level = trim($this->getInCsv('giving level', $csv, $categories, $categories_map),'"');
      if(!empty($giving_level)) {
        $this->addPersonToCategory($person, $giving_level);
      }

      if(!empty($this->getInCsv('donor', $csv, $categories, $categories_map))){
        $this->addPersonToCategory($person, 'Donors');
      }
      
      if(!empty($this->getInCsv('lifetime \'$1m+ donors', $csv, $categories, $categories_map))){
        if($this->getInCsv('lifetime giving subcategory', $csv, $categories, $categories_map) == 'New Member') {
          $this->addPersonToCategory($person, 'New Members');
        } else {
          $this->addPersonToCategory($person, 'Existing Members');
        }
        $this->addPersonToCategory($person, 'Lifetime Giving of $1M+');
      }

      $undergraduate = $this->getInCsv('undergraduate', $csv, $categories, $categories_map);
      if(!empty($undergraduate)) {
        if($undergraduate == 'Undergraduate Student') {
          $undergraduate .= 's';
          $this->addPersonToCategory($person, $year);
        }
        $this->addPersonToCategory($person, $undergraduate);
      }
      
      if(!empty($this->getInCsv('graduate alumni and students', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, "Graduate Alumni and Students");
      }

      $graduate_type = $this->getInCsv('graduate type', $csv, $categories, $categories_map);
      if(!empty($graduate_type)) {
        $this->addPersonToCategory($person, $graduate_type);
      }

      if(!empty($this->getInCsv('parent of curr student', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, 'Parents & Families of Current Students');
      }

      if(!empty($this->getInCsv('parent of alumna/i', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, 'Parents & Families of Alumni');
      }

      if(!empty($this->getInCsv('faculty', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, 'Faculty');
      }

      if(!empty($this->getInCsv('staff', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, 'staff');
      }

      if(!empty($this->getInCsv('friends', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, 'Friends');
      }

      if(!empty($this->getInCsv('corporations and foundations', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, 'Corporations and Foundations');
      }

      if(!empty($this->getInCsv('silo', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, 'Silo Legacy Society');

        if($this->getInCsv('silo membership', $csv, $categories, $categories_map) == 'New Member') {
          $this->addPersonToCategory($person, 'New Silo Legacy Society Members');
        } else {
          $this->addPersonToCategory($person, 'Existing Silo Legacy Society Members');
        }
      }

      $cumulative_giving = trim($this->getInCsv('cumulative giving flag', $csv, $categories, $categories_map));
      if(!empty($cumulative_giving)) {
        switch($cumulative_giving) {
          case '(25+)':
            $this->addPersonToCategory($person, '25+ years cumulative giving');
            break;
          case '(5-9)':
            $this->addPersonToCategory($person, '5 to 9 years cumulative giving');
            break;
          case '(10-24)':
            $this->addPersonToCategory($person, '10 to 24 years cumulative giving');
            break;
        }
      }

      //Volunteers
      if(!empty($this->getInCsv('volunteer', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, 'Volunteers');

      }
      if(!empty($this->getInCsv('2016-17 board of trustees', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, 'FY17 Trustees');
      }

      if(!empty($this->getInCsv('alumni cooperative', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, 'Alumni Cooperative Volunteers');
        $coop_region = trim($this->getInCsv('alumni cooperative region', $csv, $categories, $categories_map),'"');
        if(!empty($coop_region)) {
          $this->addPersonToCategory($person, 'alumni_coop:'. $coop_region);
        }
      }

      if(!empty($this->getInCsv('board committee member', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, 'FY17 Board Committee Members');
      }

      if(!empty($this->getInCsv('2016-17 next pioneers steering committee', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, 'Next Pioneers Steering Committee');
      }

      if(!empty($this->getInCsv('spencer cox \'90 memorial scholarship committee', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, 'Spencer Cox \'90 Tribute Planning Committee');
      }
      
      if(!empty($this->getInCsv('fran galvin memorial scholarship committee', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, 'Fran Galvin Memorial Scholarship Committee');
      }

      if(!empty($this->getInCsv('student gift steering committee', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, 'Student Gift Committee');
      }

      if(!empty($this->getInCsv('2016 reunion committee', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, '2016 Reunion Committee');
      }

      if(!empty($this->getInCsv('event volunteer', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, 'Event Hosts and Volunteers');
      }

      if(!empty($this->getInCsv('the 24 hour plays', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, '24 Hour Plays');
      }

      if(!empty($this->getInCsv('fwt volunteers', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, 'Field Work Term Hosts and Volunteers');
      }

      if(!empty($this->getInCsv('fwt grant', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, 'Named and Endowed FWT Grants');
      }

      if(!empty($this->getInCsv('scholarship', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, 'Named and Endowed Scholarships');
      }

      if(!empty($this->getInCsv('matching gift corporations and foundations', $csv, $categories, $categories_map))) {
        $this->addPersonToCategory($person, 'Matching Gift Corporations and Foundations');
      }

      if($this->getInCsv('deceased', $csv, $categories, $categories_map) == 'Y') {
        $this->addPersonToCategory($person, 'Deceased');
      }

    }


    drupal_set_message("Donor roll version $version processed successfully.");
  }

  private function columns() {
    return array_map("strtolower",[
      'RE ID',
      'IMPORT COLUMN',
      'Sort Key',
      'DONOR BOOK LISTING',
      'Donor',
      'Giving Level',
      'GIVING CATEGORY',
      'Lifetime \'$1M+ DONORS',
      'Lifetime Giving Subcategory',
      'Undergraduate',
      'Undergraduate Class Year',
      'Graduate Alumni and Students',
      'Graduate Type',
      'Graduate Class Year',
      'Parent of curr student',
      'Parent of alumna/i',
      'Parent Class Year',
      'Faculty',
      'Staff',
      'Friends',
      'Corporations and Foundations',
      'Matching Gift Corporations and Foundations',
      'Silo',
      'SILO MEMBERSHIP',
      'Cumulative Giving Flag',
      'Volunteer',
      '2016-17 Board of Trustees',
      'Alumni Cooperative',
      'Alumni Cooperative Region',
      'Board Committee Member',
      '2016-17 Next Pioneers Steering Committee',
      'Spencer Cox \'90 Memorial Scholarship Committee',
      'Fran Galvin Memorial Scholarship Committee',
      'Student Gift Steering Committee',
      'Event Volunteer',
      'The 24 Hour Plays',
      '2016 Reunion Committee',
      'FWT Volunteers',
      'Scholarship',
      'FWT Grant',
      'Endowed Fund, Other',
      'Deceased',
    ]);
  }

  private function create_category_map($cols, $from_map) {
    $map = [];
    foreach($cols as $i=>$col) {
      $j = array_search($col, $from_map);
      if(!is_null($j)) {
        $map['to'][$i] = $j;
        $map['from'][$j] = $i;
      }
    }

    return $map;
  }

  private function getInCsv($column, $csv, $categories, $categories_map, $default = null) {
    $column = strtolower($column);
    $i = array_search($column, $categories);
    if($i !== false) {
      try {
        if(!isset($categories_map['from'][$i])) {
          throw new \Exception("Missing index $i in categories_map: ". json_encode($categories_map['from']) ." requested from: ". json_encode($categories));
        }
        if(!isset($csv[$categories_map['from'][$i]])) {
          throw new \Exception("Missing index ". $categories_map['from'][$i] ." in line: ". json_encode($csv));
        }
        $val = $csv[$categories_map['from'][$i]];
        if(is_null($default)) return $val;
        return empty($val) ? $default : $val;
      } catch (\Exception $e) {
        error_log($e->getMessage());
      }
    }
    return false;
  }

  private function addPersonToCategory($person, $category_name) {

    $cat = new Category;
    $cat->name = $category_name;
    $cat->save();

    PersonCategory::add($person, $cat);
  }
}