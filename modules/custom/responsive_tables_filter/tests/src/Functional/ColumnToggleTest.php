<?php

namespace Drupal\Tests\responsive_tables_filter\Functional;

/**
 * Tests the responsive_tables_filter filter.
 *
 * @group responsive_tables_filter
 */
class ColumnToggleTest extends TestBase {

  /**
   * {@inheritdoc}
   */
  protected $mode = 'columntoggle';

  /**
   * Input & output for stack mode.
   *
   * @var data
   */
  private static $data = [
    '<table class="no-tablesaw"><thead></thead></table>' => '<table class="no-tablesaw"><thead></thead></table>',
    '<table><thead></thead></table>' => '<table class="tablesaw tablesaw-columntoggle" data-tablesaw-mode="columntoggle" data-tablesaw-minimap=""><thead></thead></table>',
    '<table class="test"><thead></thead></table>' => '<table class="test tablesaw tablesaw-columntoggle" data-tablesaw-mode="columntoggle" data-tablesaw-minimap=""><thead></thead></table>',
    '<table additional="test"><thead><tr><th data-tablesaw-priority="persist">Header One<th>Header 2<tbody><tr><td>Easily add tables with the WYSIWYG toolbar<td>Encoded characters test öô & , ?<tr><td>Tables respond to display on smaller screens<td>Fully accessible to screen readers</table>' => '<th data-tablesaw-sortable-col="" data-tablesaw-priority="1">Header One</th>',
  ];

  /**
   * Tests the responsive_tables_filter Column Toggle mode.
   */
  public function testColumnToggle() {
    foreach (self::$data as $input => $output) {
      $settings = [];
      $settings['type'] = 'page';
      $settings['title'] = 'Test Tablesaw Column Toggle mode';
      $settings['body'] = [
        'value' => $input,
        'format' => 'custom_format',
      ];
      $node = $this->drupalCreateNode($settings);
      $this->drupalGet('node/' . $node->id());
      $this->assertSession()->responseContains($output);
    }
  }

}
