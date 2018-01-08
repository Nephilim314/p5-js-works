<?php

namespace Drupal\bennington_giving\Controller;
use \Drupal\bennington_giving\Version;
use \Drupal\bennington_giving\Category;
use \Drupal\bennington_giving\PersonCategory;
use \Drupal;
use \Drupal\Core\Controller\ControllerBase;
use \Drupal\Core\Ajax\AjaxResponse;
use \Drupal\Core\Ajax\RemoveCommand;
use \Drupal\Core\Ajax\RedirectCommand;
use \Drupal\Core\Ajax\AlertCommand;
use \Drupal\Core\Url;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\JsonResponse;
use \Drupal\bennington_giving\Parsedown;

class HonorRollController extends ControllerBase {

  public $version = null;

  protected function getModuleName() {
    return 'bennington_giving';
  }

  public function honor_roll($section = null, $year = null) {

    $version = Version::verify($year);

    if(!$version) {
      $version = Version::getMax(date('Y'));
    }

    if($version) {

      $this->version = $version;

      if(is_null($section) || $section == 'welcome') return $this->introduction($version);

      if($section == 'overview') return $this->spending_overview($version);

      if($section == 'make-a-gift') return $this->gift();

      if($section == 'donors') $section = '';
      $section = Category::findByName($section, $this->version);
      if(!is_object($section)) $section = Category::findByName("President's Circle Associates", $this->version);

      return $this->donors($section);
    }

    return [
      '#title'=>"Oops!",
      "#markup"=>"You requested version $year, but we couldn't find it."
    ];
  }

  public function introduction($version) {
    return $this->wrap([
      '#markup' => <<<END
        <div id="introduction">
          <div id="introduction-picture-container">
          </div>
          <div id="introduction-content">
            <p>Welcome to Bennington College&#39;s new online donor roll.</p>
            <p>This site honors the alumni, faculty, students, staff, volunteers and friends who made donations or
              volunteered in Fiscal Year 2017 (July 1, 2016 &mdash; June 30, 2017).
            <p>I am proud to report that in Fiscal Year 2017, the College secured $18.7 million in new gifts and pledges
              from 2,226 donors&mdash;one of the most successful fundraising years in Bennington College history. These
              gifts are more than just numbers on a ledger&mdash;they are opportunities created and lives changed.</p>
            <p>The incredibly generous philanthropy in 2017 made an impact throughout many Bennington programs.
              Donor investments created new scholarships that provided opportunities for students who wouldn't
              have otherwise been able to access the Bennington education. It helped add Field Work Term grants to
              aid students in securing that once-in-a-lifetime opportunity. Gifts supported the largest period of
              campus renewal in the College's history, with new buildings such as our Student Health Center, a
              historic renovation currently underway to Commons, and the creation of a new student dining center.
              Creative gifts funded new initiatives like the Museum Fellows Term. Generous philanthropy also helped
              support the vital work done within CAPA, as well as ongoing multi-year gifts supporting a reinvention of
              our student advising programs. At the same time, scores of alumni and families, led by our Alumni
              Cooperative, volunteered their time and talents to create networking and educational opportunities
              regionally around the world as well as right here in Vermont.</p>
            <p>All of this was made possible because of you: Bennington's donors and volunteers. The College's
              progressive and experiential liberal arts education is as important now as it has ever been. Your support
              helps empower our students and programs through their shared experiences, and ultimately provides
              the capacity to create change in their communities. I cannot overstate all of our gratitude and
              inspiration we all feel because of this generosity. On behalf of the entire Bennington administration,
              thank you to everyone who helped Bennington become a better institution through philanthropy in
              2017.</p>
            <p>If you have any questions or comments, about this donor roll or about philanthropy at Bennington in
              general, please don't hesitate to contact our <a href="http://www.bennington.edu/institutional-advancement" target="_blank">Office of Institutional Advancement</a>, or by
              emailing <a href="mailto:giving@bennington.edu">giving@bennington.edu</a>.</p>
            <p style="margin-bottom:0px">Sincerely,</p>
            <p class="rizzo-sig"></p>
            <p>Matt Rizzo<br/>Vice President for Institutional Advancement</p>
            <p><a class="nav-link" href="/giving/donor-roll/overview">Explore the Donor Roll</a></p>
          </div>
          <div class="clearfix"></div>
        </div>
END
    ]);
  }

  public function spending_overview($version) {
    return $this->wrap([
      '#markup' => <<<END
<div id="overview">
  <h1 class="inner-header">If you believe in it, Invest in it.</h1>
  <div class="data-container" id="where-comes-from">
    <div class="data-detail">
      <h2>Where the Money Comes From</h2>
      <p>In Fiscal Year 2017, private support, primarily from philanthropy, accounted for more than 30% of our operating budget.</p>
      <br/>
      <h3 class="color">$44,262</h3> <h3>Tuition, Room, Board & Fees</h3>
      <br/><h3 class="color">$18,672</h3> <h3>Private Support</h3>
      <br/><h3 class="color">$4,423</h3> <h3>Other Income & Miscellaneous</h3>
      <br/><h3 class="color">$604</h3> <h3>Endowment Earnings</h3>
      <br/><h3 class="color"></h3><h6>All numbers in thousands</h6>
    </div>
    <div class="data-chart come-from">
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="data-container" id="where-goes">
    <div class="data-detail">
      <h2>Where the Money Goes</h2>
      <p>A look at our Fiscal Year 2017 operating budget, by area.</p>
      <h3 class="color">$19,611</h3> <h3>Scholarships & Financial Aid</h3>
      <br/><h3 class="color">$14,776</h3> <h3>Instruction & Academic Support</h3>
      <br/><h3 class="color">$10,881</h3> <h3>Campus Maintenance &<br/>Capital Spending</h3>
      <br/><h3 class="color">$9,221</h3> <h3>Institutional Support</h3>
      <br/><h3 class="color">$7,044</h3> <h3>Student & Auxiliary Services</h3>
      <br/><h3 class="color">$1,850</h3> <h3>Debt Services</h3>
      <br/><h3 class="color"></h3><h6>All numbers in thousands</h6>
    </div>
    <div class="data-chart goes-to">
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="data-container" id="breakdown">
    <div class="data-detail">
      <h2>Breakdown of private support designations By purpose</h2>
      <h3 class="color">52%</h3> <h3>Unrestricted</h3>
      <br/><h3 class="color">18%</h3> <h3>CAPA/Public Action</h3>
      <br/><h3 class="color">14%</h3> <h3>Scholarships & Financial Aid</h3>
      <br/><h3 class="color">10%</h3> <h3>Programming & Faculty Enrichment</h3>
      <br/><h3 class="color">5%</h3> <h3>Facilities</h3>
      <br/><h3 class="color">1%</h3> <h3>Field Work Term</h3>
      <br/><h3 class="color">1%</h3> <h3>Writing Seminars</h3>
    </div>
    <div class="data-chart purpose">
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="data-container" id="constituency">
    <div class="data-detail">
      <h2>Money raised by constituency</h2>
      <h3 class="color">83%</h3> <h3>Alumni & Students</h3>
      <br/><h3 class="color">11%</h3> <h3>Foundations, Organizations<br/>& Corporations</h3>
      <br/><h3 class="color">3%</h3> <h3>Parents</h3>
      <br/><h3 class="color">3%</h3> <h3>Faculty, Staff & Friends</h3>
    </div>
    <div class="data-chart constituency">
    </div>
    <div class="clearfix"></div>
  </div>
</div>
END
    ], 'overview');
  }

  public function gift() {
    return $this->wrap(['#markup' => <<<END
      <div class="thank-you-image"></div>
      <div id="make-a-gift">
        <p>Bennington College is immensely grateful to all of the donors who help us advance our mission and support our students. Gifts to the College make a tremendous difference, and help empower the work we do every day.</p>

        <p>If you would like to make a gift, or learn more about giving to Bennington College, please visit <a href="http://www.bennington.edu/giving" target="_blank">bennington.edu/giving</a>.</p>

        <p>If you have any questions about this online donor roll or about giving at Bennington College in general, please <a href="mailto:giving@bennington.edu">contact us</a>.</p> 

        <p>Thank you for your support.</p>
      </div>
END
    ], 'make-a-gift');
  }

  public function donors($category = null) {

    if($category->name == 'Alumni Cooperative Volunteers')
      $people = $this->get_alumni_coop_people();
    else
      $people = $this->get_categories_people(
        $this->find_category($category->name, Category::$categories)
      );

    $sections = $this->build_sections($people, $category->name);
    $nav = $this->build_donor_nav($category->name);

    return $this->wrap(
      ['#type'=>'html_tag', '#tag'=>'div','#attributes'=>['class'=>'donors'],
        ['#type'=>'html_tag', '#tag'=>'div','#attributes'=>['class'=>'donors-container'], $sections],
        ['#type'=>'html_tag', '#tag'=>'div','#attributes'=>['class'=>'donors-nav hide-mobile'], $nav],
        ['#type'=>'html_tag', '#tag'=>'div','#attributes'=>['class'=>'back-to-top'], 
          ['#markup' => '<a href="#top" class="back-to-top">Back to top</a>']
        ],
        ['#type'=>'html_tag', '#tag'=>'div','#attributes'=>['class'=>'clearfix']],
      ], 'donor');
  }

  public function wrap($content, $section = null) {
    $welcome_active = $section == 'welcome' || is_null($section) ? 'active' : '';
    $overview_active = $section == 'overview' ? 'active' : '';
    $donor_active = $section == 'donor' ? 'active' : '';
    $gift_active = $section == 'make-a-gift' ? 'active' : '';

    $donor_roll_hidden = $section == 'donor' ? '' : 'hidden';

    $year_start = intval(substr($this->version, 0, 4));
    $year_end = $year_start + 1;
    return [
      'header' => [
        '#markup' => '<div class="header"><h1>Bennington College</h1></div>'
      ],
      'nav' => [
        '#markup' => <<<END
          <h1 class="giving-title">DONOR ROLL</h1>
          <div id="giving-nav">
            <a class="nav-link {$welcome_active}" href="/giving/donor-roll/">Welcome</a>
            <a class="nav-link {$overview_active}" href="/giving/donor-roll/overview">FY17 Overview</a>
            <a class="nav-link {$donor_active}" href="/giving/donor-roll/donors">Donors & Volunteers</a>
            <a class="nav-link {$gift_active}" href="/giving/donor-roll/make-a-gift">Make a Gift</a>
            <div class="show-mobile">
              <a class="{$donor_roll_hidden}" id="mobile-menu-link" href="#">Donor Roll Navigation</a>
              <div class="hidden" id="mobile-menu">
              </div>
            </div>
          </div>
END
      ],
      'content' => $content,
      '#attached' => ['library'=>'bennington_giving/bennington_giving.honor_roll'],
    ];
  }

  public function get_categories($parent_id = null) {
    return new JsonResponse(Category::all());
  }

  public function administer() {
    $render = [
      'form_block' => Drupal::formBuilder()->getForm('Drupal\bennington_giving\Form\HonorRollForm'),
      'divider' => [
        '#markup' => '<hr/><br/>'
      ],
      'versions_block' => [
        '#type' => 'table',
        '#caption' => $this->t('Honor Roll Versions'),
        '#header' => [$this->t('Version'), $this->t('Total Entries'), $this->t('Actions')],
      ],
    ];

    $versions = Version::getAll();
    $ver_len = count($versions);

    for($i = 0; $i < $ver_len; $i++) {
      
      $render['versions_block'][$i] = [
        "#attributes" => ["idx" => "delete-{$versions[$i]->version}"],
        "version" => ['#plain_text' => $versions[$i]->version],
        "count" => ['#plain_text' => $versions[$i]->count], 
        "action" => [
          "delete_button" => [
            '#type' => 'link',
            '#title' => $this->t("Delete"),
            '#url' => Url::fromRoute('bennington_giving.delete-version', ['version'=>$versions[$i]->version]),
            '#attributes' => ['class' => ['use-ajax']],
          ],
          // '#attributes' => ['css' => ['use-ajax']],
        ],
      ];

    }

    $render['#attached'] = ['library' => 'bennington_giving/bennington_giving_admin.categories'];

    return $render;
  }

  public function delete_version($version) {

    Version::delete($version);

    $response = new AjaxResponse();
    $response->addCommand(new RemoveCommand("tr[idx='delete-".$version."']"));

    return $response;
  }

  private function jslink($name, $id, $unactionable = false) {
    if($unactionable) {
      return ['#markup' => '<span>'. $name .'</span>'];
    }
    return ['#markup' => '<a class="action-link" action="'. $this->snake_case($name) .'" idx="'. $id .'">'. $name .'</a>'];
  }

  private function snake_case($input) {
    preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
    $ret = $matches[0];
    foreach ($ret as &$match) {
      $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
    }
    return implode('_', $ret);
  }

  private function find_category($name, $in) {
    if(array_key_exists($name, $in)) return [$name => $in[$name]];

    foreach($in as $cat => $subs) {
      if(substr($cat, 0,1) == '_') continue;
      if($found = $this->find_category($name, $subs)) return $found;
    }

    return false;
  }

  private function get_categories_people($categories) {
    $people = [];
    foreach($categories as $category_name => $sub_categories) {
      if(substr($category_name, 0,1) == '_') {
        $people[$category_name] = $sub_categories;
        continue;
      }

      if(is_array($sub_categories)) {
        $sort_with_year = array_key_exists('_use_year_in_sort', $sub_categories) ? $sub_categories['_use_year_in_sort'] : false;
      }

      $people[$category_name] = [
        'people' => PersonCategory::getPeopleInCategoryName($category_name, $this->version, $sort_with_year), 
        'children'=>$this->get_categories_people($sub_categories)
      ];

      $t_children = $people[$category_name]['children'];

      foreach($t_children as $category => $val) {
        if(substr($category, 0,1) == '_') {
          $people[$category_name][$category] = $val;
          unset($people[$category_name]['children'][$category]);
        }
      }
    }

    return $people;
  }

  private function get_alumni_coop_people() {
    $cats = Category::getAlumniCoopCategories();

    $categories = [];
    foreach($cats as $cat) {
      $categories[$cat->name] = ['_type'=>'section'];
    }

    $people = $this->get_categories_people($categories);
    $ret = ['_type' => 'container','_header'=>'h1'];

    foreach($people as $cat => $peeps) {
      $ret[substr($cat,12)] = $peeps;
    }

    return $ret;
  }

  private function build_sections($sections, $name = null) {
    $_sections = [];

    if(!is_null($name)) {
      if(array_key_exists('_type', $sections) && $sections['_type'] != 'hidden')
        $_sections[] = ['#type' => 'html_tag', '#tag'=>'h1', '#value'=>$name];
    }

    foreach($sections as $title => $person_section) {
      if($title{0} == '_') continue;
      
      $sec = $this->build_section($person_section, $title);
      
      if(!empty($sec)) {
        $_sections[] = $sec;
      }
    }

    return $_sections;
  }

  private function build_section($section, $title) {
    $type = array_key_exists('_type', $section) ? $section['_type'] : 'hidden';
    $heading = array_key_exists('_header', $section) ? $section['_header'] : 'h2';
    $use_decade_sort = array_key_exists('_decade_sort', $section) ? $section['_decade_sort'] : false;

    $decade_sort = ['#markup'=>'<a class="decade-sort" title="Sort by decade">Sort</a>'];

    $markup = [];

    if($title == 'New Silo Legacy Society Members')
      $title = 'New Members';
    else if($title == 'Existing Silo Legacy Society Members')
      $title = 'Existing Members';

    $heads_up = ['#type' => 'html_tag', '#tag'=>$heading, '#value'=>$title];
    if($type == 'section') {
      $heads_up = ['#type' => 'html_tag', '#tag'=>'div', '#attributes'=>['class'=>'sortable-header'], 
        $heads_up,
      ];
      if($use_decade_sort === true) {
        $heads_up[] = $decade_sort;
      }
    }

    $markup = ['heading' => $heads_up];

    if(array_key_exists('_blurb', $section)) {
      $markup[] = ['#markup' => '<p class="blurb">'. $section['_blurb'] .'</p>'];
    }
    
    $markup['people'] = $type == 'container' ? [] : $this->build_people($section['people']);
    $markup['child-list'] = $this->build_sections($section['children']);

    return $markup;
  }

  private function build_people($people) {

    if(empty($people)) {
      return ['#markup' => '<div class="blank">There are no entries in this category</div>'];
    }

    $markup = ['#type' => 'html_tag', '#tag' => 'ul'];

    $parsedown = new Parsedown();

    foreach($people as $person) {
      $tags = $person->getTags();
      $class = 'person';
      if(in_array('Deceased', $tags)) {
        $class .= ' deceased';
      }
      $markup[] = ['#type' => 'html_tag', '#tag' => 'li', '#value' => $parsedown->line($person->name), 
        '#attributes' => [
          'class'=>$class,
          'x-decade'=>strval($person->decade),
          'x-sort'=>strval($person->sort_order),
          'x-tags'=>implode('|',$person->getTags())
        ]
      ];
    }

    return $markup;
  }

  private function build_donor_nav($active_cat) {
    $flat = $this->get_categories_with('_navigable', true, Category::$categories);
    $markup = ['#type'=>'html_tag','#tag'=>'li','#value'=>'Donors', '#attributes'=>['class'=>'nav-title']];

    foreach($flat as $cat) {
      $attributes = ['nav-to'=>$cat,'version'=>$this->version];
      if($cat == $active_cat) {
        $attributes['class'] = 'active';
      }
      if($cat == 'FY17 Board of Trustees') {
        $markup[] = ['#type'=>'html_tag','#tag'=>'li','#value'=>'Volunteers', '#attributes'=>['class'=>'nav-title']];
      }
      $markup[] = ['#type'=>'html_tag','#tag'=>'li','#attributes'=>$attributes, 
        ['#markup'=>'<a href="/giving/donor-roll/'. urlencode($cat) .'">'.$cat.'</a>']
      ];
      //$markup[] = ['#type'=>'html_tag','#tag'=>'li','#value'=>$cat, '#attributes'=>$attributes];
    }

    $ignored_cats = [
      'Lifetime Giving of $1M+', 
      'Silo Legacy Society',
      'FY17 Board of Trustees',
      'Alumni Cooperative Volunteers',
      'Development Volunteers',
      'Event Hosts and Volunteers',
      'Field Work Term Hosts and Volunteers',
      'Scholarships and FWT Grants',
    ];

    $use_cumulative_keys = '<div class="giving-25">25+ years cumulative giving</div>
      <div class="giving-10-24">10 to 24 years cumulative giving</div>
      <div class="giving-5-9">5 to 9 years cumulative giving</div>';

    if(in_array($active_cat, $ignored_cats)) {
      $use_cumulative_keys = '';
    }

    $markup[] = ['#markup'=>'<li class="nav-key">
      <h3>A Key To Our Donor List</h3>
      '. $use_cumulative_keys .'
      <div class="giving-nostyle"><strong>P</strong>: Parent</div>
      <div class="giving-nostyle"><strong>G</strong>: Grandparent</div>
      <div class="giving-nostyle"><strong>MA</strong>: Master of Arts</div>
      <div class="giving-nostyle"><strong>MAT</strong>: Master of Arts in Teaching</div>
      <div class="giving-nostyle"><strong>MALS</strong>: Master of Arts in Liberal Studies</div>
      <div class="giving-nostyle"><strong>MFA</strong>: Master of Fine Arts</div>
      <div class="giving-nostyle"><strong>PB</strong>: Postbaccalaureate</div>
      <div class="giving-nostyle"><em>Deceased</em></div>
    </li>'];
    
    return $markup;
  }

  private function get_categories_with($key, $value, $categories) {
    $output = [];
    foreach($categories as $category => $data) {
      if(!is_array($data)) continue;
      if(array_key_exists($key, $data) && $data[$key]==$value)
        $output[] = $category;
      $output = array_merge($output, $this->get_categories_with($key, $value, $data));
    }

    return $output;
  }
}
