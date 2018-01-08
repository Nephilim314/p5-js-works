<?php

namespace Drupal\bennington_giving;

use \Drupal;

class Person {

  public $name;
  public $version;
  public $id;
  public $decade;
  public $tags;
  public $grad_year;
  public $parent_year;
  
  public function __construct($id = null) {
    if(!is_null($id)) {
      $this->load($id);
    }
  }

  public function save() {
    if($this->id) {
      Drupal::database()
        ->update('bennington_giving_people')
        ->fields($this->getFields())
        ->condition('id',$this->id,'=')
        ->execute();
    } else {
      $this->id = Drupal::database()
        ->insert('bennington_giving_people')
        ->fields($this->getFields())
        ->execute();
    }

    return $this;
  }

  public function load($id) {
    $data = Drupal::database()
      ->query("SELECT * FROM bennington_giving_people WHERE id = $id LIMIT 1")
      ->fetch();

    $this->id = $data->id;
    $this->name = $data->name;
    $this->sort_order = $data->sort_order;
    $this->decade = property_exists($data, 'decade') ? $data->decade : null;
    $this->version = $data->version;
    $this->grad_year = $data->grad_year;
    $this->parent_year = $data->parent_year;

    return $this;
  }

  public function categories() {
    PeopleCategory::getCategoriesForPerson($this);
  }

  public function getTags() {
    $tags = Drupal::database()
      ->query("SELECT c.name FROM bennington_giving_categories c 
        JOIN bennington_giving_people_categories pc ON pc.category_id = c.id
        WHERE pc.person_id = :person_id", [':person_id' => $this->id])
      ->fetchAll();

    $ret = [];
    foreach($tags as $obj) {
      if(in_array($obj->name, Category::$tags))
        $ret[] = $obj->name;
    }
    return $ret;
  }

  private function getFields() {
    return [
      'name' => $this->name,
      'sort_order' => $this->sort_order,
      'version' => $this->version,
      'decade' => $this->decade ?: null,
      'tags' => $this->tags ?: null,
      'grad_year' => $this->grad_year ?: null,
      'parent_year' => $this->parent_year ?: null,
    ];
  }

}