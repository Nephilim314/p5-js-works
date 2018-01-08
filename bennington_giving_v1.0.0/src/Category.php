<?php

namespace Drupal\bennington_giving;

use \Drupal;

class Category {

  public $id;
  public $name;
  public $parent_id;
  public $order;

  public static $tags = [
    'Deceased',
    '5 to 9 years cumulative giving',
    '10 to 24 years cumulative giving',
    '25+ years cumulative giving',
  ];

  public static $categories = [
    'Donors' => [
      '_type'=>'hidden',
      'President\'s Circle Associates' => [
        '_type' => 'container','_header'=>'h1','_navigable'=>true,'_decade_sort' => false,'_use_year_in_sort'=>'grad_year',
        '_blurb' => "Bennington College recognizes with gratitude the difference-making philanthropy of our highest level of leadership donors. This includes all donors who made gifts of $25,000 or more in Fiscal Year 2017 (July 1, 2016 &mdash; June 30, 2017).",
        '$1,000,000 and up' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>'grad_year',],
        '$100,000 - $999,999' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>'grad_year',],
        '$25,000 - $99,999' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>'grad_year',],
      ],
      'Patron Associates' => [
        '_type' => 'container','_header'=>'h1','_navigable'=>true,'_decade_sort' => false,'_use_year_in_sort'=>'grad_year',
        '_blurb' => "Patron Associates who make annual contributions for any purpose between $1,000 and $25,000 are key to helping the College support its highest priorities. This listing recognizes with gratitude those donors in Fiscal Year 2017 (July 1, 2016 &mdash; June 30, 2017).",
        '$5,000 - $24,999' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>'grad_year',],
      ],
      'Associates' => [
        '_type' => 'container','_header'=>'h1','_navigable'=>true,'_decade_sort' => false,'_use_year_in_sort'=>'grad_year',
        '_blurb' => "Donors who make contributions of $1,000 or more are the backbone of our annual giving program. The College is proud to recognize donors who made gifts between $1,000 and $5,000 in Fiscal Year 2017 (July 1, 2017 &mdash; June 30, 2017).",
        '$1,000 - $4,999' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>'grad_year',],
      ],
      'Lifetime Giving of $1M+' => [
        '_type' => 'container','_header'=>'h1','_navigable'=>true,'_decade_sort' => false,
        '_blurb' => "We extend our deepest gratitude to the following extraordinary individual donors who have, over the course of their lifetime, given $1 million or more to Bennington College.",
        'New Members' => ['_type' => 'section','_decade_sort' => false,],
        'Existing Members' => ['_type' => 'section','_decade_sort' => false,],
      ],
      'Undergraduate Alumni' => ['_blurb'=>"In Fiscal Year 2017, nearly 1400 undergraduate alumni made gifts to Bennington College. The following list is sorted by class year, can also be searched via the Control-F function of your browser, or can be sorted by class decade, via the button to the right.",'_type' => 'section','_header'=>'h1','_navigable'=>true,'_decade_sort'=>true,'_use_year_in_sort'=>'grad_year',],
      'Undergraduate Students' => [
        '_type' => 'container','_header'=>'h1','_navigable'=>true,'_decade_sort'=>true,'_use_year_in_sort'=>false,
        '2017' => ['_type' => 'section'],
        '2018' => ['_type' => 'section'],
        '2019' => ['_type' => 'section'],
        '2020' => ['_type' => 'section'],
        '2021' => ['_type' => 'section'],
      ],
      'Graduate Alumni and Students' => [
        '_type' => 'container','_header'=>'h1','_navigable'=>true,'_decade_sort' => false,'_use_year_in_sort'=>'grad_year',
        'Master of Arts' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>'grad_year',],
        'Master of Arts in Teaching' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>'grad_year',],
        'Master of Arts in Teaching a Second Language' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>'grad_year',],
        'Master of Fine Arts' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>'grad_year',],
        'Master of Fine Arts in Writing' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>'grad_year',],
        'Postbaccalaureate' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>'grad_year',],
      ],
      'Parents & Families' => [
        '_type' => 'container','_header'=>'h1','_navigable'=>true,'_decade_sort' => false,'_use_year_in_sort'=>'parent_year',
        'Parents & Families of Current Students' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>'parent_year',],
        'Parents & Families of Alumni' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>'parent_year',],
      ],
      'Faculty & Staff Donors' => [
        '_type' => 'container','_header'=>'h1','_navigable'=>true,'_decade_sort' => false,'_use_year_in_sort'=>'grad_year',
        'Faculty' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>false,],
        'Staff' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>false,],
      ],
      'Friends' => ['_type' => 'section','_header'=>'h1','_navigable'=>true,'_decade_sort' => false,'_use_year_in_sort'=>false,],
      'Corporations and Foundations' => ['_type' => 'section','_header'=>'h1','_navigable'=>true,'_decade_sort' => false,'_use_year_in_sort'=>false,],
      'Matching Gift Corporations and Foundations' => ['_type' => 'section','_header'=>'h1','_navigable'=>true,'_decade_sort' => false,'_use_year_in_sort'=>false,],
      'Silo Legacy Society' => ['_blurb'=>"We honor and celebrate those individuals who are moved by Bennington to make legacy intentions through planned gifts with membership in the Silo Legacy Society, named for the silo that once stood in the northeast corner of the Barn. Like the structure of the silo itself, which represents sturdiness, stability and thoughtful planning for the future, the Silo Legacy Society is comprised of alumni, parents, and friends who have included Bennington in their wills or other long-term financial plans.",'_type' => 'container','_header'=>'h1', '_navigable'=>true,
        'New Silo Legacy Society Members' => ['_type' => 'section','_use_year_in_sort'=>'grad_year',],
        'Existing Silo Legacy Society Members' => ['_type' => 'section','_use_year_in_sort'=>'grad_year',],
      ],
    ],
    'Volunteers' => [
      '_type'=>'hidden',
      'FY17 Board of Trustees' => [
        '_type' => 'container','_header'=>'h1','_navigable'=>true,'_decade_sort' => false,'_use_year_in_sort'=>false,
        'FY17 Trustees' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>false,],
        'FY17 Board Committee Members' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>false,],
      ],
      'Alumni Cooperative Volunteers' => ['_type' => 'container','_header'=>'h1','_navigable'=>true,'_decade_sort' => false,'_use_year_in_sort'=>false,],
      'Development Volunteers' => ['_type'=>'container','_header'=>'h1','_navigable'=>true,'_decade_sort' => false,'_use_year_in_sort'=>false,
        'Student Gift Committee' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>false,],
        '2016 Reunion Committee' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>false,],
        'Fran Galvin Memorial Scholarship Committee' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>false,],
        'Spencer Cox \'90 Tribute Planning Committee' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>false,],
        'Next Pioneers Steering Committee' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>false,],
      ],
      'Event Hosts and Volunteers' => ['_type' => 'section','_header'=>'h1','_navigable'=>true,'_decade_sort' => false,'_use_year_in_sort'=>false,
        '24 Hour Plays' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>false,],
      ],
      'Field Work Term Hosts and Volunteers' => ['_type' => 'section','_header'=>'h1','_navigable'=>true,'_decade_sort' => false,'_use_year_in_sort'=>false,],
    ],
    'Scholarships and FWT Grants' => [
      '_type' => 'container', '_header'=>'h1','_navigable'=>true,
      '_blurb' => "Generous private philanthropy is vital to maintaining our community of exceptionally talented
students, and we thank those who have chosen to support Bennington through the creation of scholarships and Field Work Term grants. The following are scholarships and FWT Grants awarded in Fiscal Year 2017 (July 1, 2016 &mdash; June 30, 2017).",
      'Named and Endowed Scholarships' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>false,],
      'Named and Endowed FWT Grants' => ['_type' => 'section','_decade_sort' => false,'_use_year_in_sort'=>false,],
    ],
  ];
  
  public function __construct($id = null) {
    if(!is_null($id)) {
      $this->load($id);
    }
  }

  public function save() {
    if(empty($this->id) && !empty($this->name)) {
      $data = Drupal::database()
        ->select('bennington_giving_categories', 'c')
        ->fields('c',['id', 'name'])
        ->condition('name', $this->name, '=')
        ->execute()
        ->fetch();
      if(!empty($data)) {
        $this->id = $data->id;
        $this->name = $data->name;
        return $this;
      }
    } else if(!empty($this->id)) {
      $success = Drupal::database()
        ->update('bennington_giving_categories')
        ->fields(['name' => $this->name])
        ->condition('id', $this->id, '=')
        ->execute();

      return $this;
    }

    try {
      $id = Drupal::database()
        ->insert('bennington_giving_categories')
        ->fields(['name' => $this->name])
        ->execute();

      $this->id = $id;
    } catch (\Exception $e) {
      error_log("Failed to insert Category ". $this->name .": ". $e->getMessage());
    }

    return $this;
  }

  public function load($id) {
    $data = Drupal::database()
      ->query("SELECT * FROM bennington_giving_categories WHERE id = :id LIMIT 1", [':id'=>$id])
      ->fetch();

    return $this->loadData($data);
  }

  public static function all() {
    $data = Drupal::database()
      ->query("SELECT * FROM bennington_giving_categories")
      ->fetchAll();

    return $data;
  }

  public function people($version) {
    return PersonCategory::getPeopleInCategory($this, $version);
  }

  public static function findByName($name) {
    $data = Drupal::database()
      ->query("SELECT * from bennington_giving_categories WHERE name = :name",[":name"=>$name])
      ->fetch();
    $obj = new self;
    return $obj->loadData($data);
  }

  private function loadData($data) {
    if(!is_object($data)) return false;
    $this->id = $data->id;
    $this->name = $data->name;

    return $this;
  }

  public static function getAlumniCoopCategories() {
    return Drupal::database()
      ->query("SELECT * FROM bennington_giving_categories WHERE name LIKE 'alumni_coop:%'")
      ->fetchAll();
  }
}