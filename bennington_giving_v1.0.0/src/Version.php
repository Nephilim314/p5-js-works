<?php

namespace Drupal\bennington_giving;
use \Drupal;

class Version {
  
  public static function next($year = null) {

    $year = is_null($year) ? date('Y') : $year;

    $version = self::getMax($year);

    if(empty($version)) $version = self::defaultVersion($year);

    $version = self::ensure_format($version);

    list($year, $ver) = explode('.', $version);

    $new_version = $year .'.'. str_pad(intval($ver)+1, 2, '0', STR_PAD_LEFT);

    return $new_version;
  }

  public static function getAll() {
    $versions = Drupal::database()->query("
      SELECT version, COUNT(id) as `count`
      FROM bennington_giving_people
      GROUP BY version
      ORDER BY version DESC");

    return $versions->fetchAll();
  }

  public static function delete($version) {

    $txn = Drupal::database()->startTransaction();

    try {
      Drupal::database()->query("
        DELETE pc.* FROM bennington_giving_people_categories pc
          JOIN bennington_giving_people p ON p.id = pc.person_id
        WHERE p.version = :version", [":version" => $version]);

      Drupal::database()->query("
        DELETE FROM bennington_giving_people
        WHERE version = :version", [":version" => $version]);
      
    } catch (\Exception $e) {
      $txn->rollback();
      throw $e;
    }

  }

  public static function verify($version) {
    if(preg_match('/^\d{4}$/', $version)) {
      return self::getMax($version);
    } else if(preg_match('/^\d{4}\.\d{2}$/', $version)) {
      if(self::exists($version))
        return $version;
      else 
        return self::getMax(explode('.', $version)[0]);
    }
    return false;
  }

  private static function ensure_format($version) {
    return (is_null($version) || preg_match('/^\\d{4}\\.\\d{4}$/', $version)) ? date('Y').'.00' : $version;
  }

  public static function getMax($year) {
    $version = Drupal::database()->query("
      SELECT DISTINCT version
      FROM bennington_giving_people");

    try {
      $versions = $version->fetchAll();
      $max = null;
      foreach($versions as $version) {
        if(is_null($max)) {
          $max = $version->version;
          continue;
        } else if($version->version > $max) {
          $max = $version->version;
        }
      }
      return $max;
    } catch (\Exception $e) {
      return null;
    }
  }

  private static function defaultVersion($year) {
    return $year.'.00';
  }

  private static function exists($version) {
    return Drupal::database()->query("SELECT COUNT(*) as ct FROM bennington_giving_people WHERE version = :version", [':version' => $version])->fetch()->ct;
  }
}