<?php

/**
 * Unit testing: class Media
 *
 * @package     DreykhMetadata
 * @subpackage  Tests
 * @author      Sébastien Santoro aka Dereckson <dereckson@espace-win.org>
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD
 * @version     0.1
 */

namespace DreykhMetadata;

require_once('../../DreykhMetadata/Media.php');

/**
 * Test cases for the class License
 */
class MediaTest extends PHPUnit_Framework_TestCase {
    /**
     * Tests the Media::__toString method.
     */
    public function testToString () {
        //Asserts a media instance is rendered as its title
        $media = new Media();
        $media->title = "Quux xuuQ";
        $this->assertEquals($media, "Quux xuuQ");
    }
}
