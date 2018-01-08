<?php

namespace Drupal\bennington_giving;

use \Drupal;

class PersonCategory {
  
  public static function add(Person $person, Category $category) {
    try {
      Drupal::database()
        ->insert('bennington_giving_people_categories')
        ->fields(['person_id'=>$person->id, 'category_id'=>$category->id])
        ->execute();
    } catch (\Exception $e) {
      error_log($e->getMessage());
    }
  }

  public static function getCategoriesForPerson(Person $person) {
    $ppl = Drupal::database()
      ->query("SELECT c.* FROM bennington_giving_categories c 
        JOIN bennington_giving_people_categories pc ON pc.category_id = c.id
        WHERE pc.person_id = {$person->id}")
      ->fetchAll();

    $categories = [];

    foreach($ppl as $p) {
      $t = new Category();
      $t->name = $p->name;
      $t->id = $p->id;
      $categories[] = $t;
    }

    unset($ppl);
    return $categories;
  }

  public static function getPeopleInCategoryName($name, $version, $sort_with_year = false) {
    $c = Category::findByName($name);

    if(is_object($c) && $c->id) return self::getPeopleInCategory($c, $version, $sort_with_year);
  }

  public static function getPeopleInCategory(Category $category, $version, $sort_with_year = false) {
    if($sort_with_year)
      error_log("Sorting year: $sort_with_year");
    $sort_key = $sort_with_year ? 'CONCAT(CAST(IFNULL('. $sort_with_year .',9999) AS CHAR), sort_order)' : 'sort_order';
    $ppl = Drupal::database()
      ->query("SELECT p.*, $sort_key as `sort_key` FROM bennington_giving_people p 
        JOIN bennington_giving_people_categories pc ON pc.person_id = p.id AND p.version = '$version'
        WHERE pc.category_id = {$category->id}
        ORDER BY `sort_key` ASC")
      ->fetchAll();

    $persons = [];

    foreach($ppl as $p) {
      $t = new Person();
      $t->name = $p->name;
      $t->id = $p->id;
      $t->version = $p->version;
      $t->sort_order = $p->sort_key;
      $t->decade = property_exists($p, 'decade') ? $p->decade : null;
      $persons[] = $t;
    }

    unset($ppl);
    return $persons;
  }

}