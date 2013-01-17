<?php

/**
 * Unit testing: class License
 *
 * @package     DreykhMetadata
 * @subpackage  Tests
 * @author      Sébastien Santoro aka Dereckson <dereckson@espace-win.org>
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD
 * @version     0.1
 */

namespace DreykhMetadata;

require_once('../../DreykhMetadata/License.php');

/**
 * Test cases for the class License
 */
class LicenseTest extends \PHPUnit_Framework_TestCase {
    /**
     * Tests the License::__toString method.
     */
    public function testToString () {
        //Asserts a license instance without an URL property is rendered as its name
        $license = new License();
        $license->name = "Creative Commons Attribution 3.0 Unported License";
        $license->code = "CC-BY 3.0";
        $this->assertEquals($license, "Creative Commons Attribution 3.0 Unported License");

        //Asserts a license instance with an URL property is rendered as an HTML link
        $license->URL = "http://creativecommons.org/licenses/by/3.0/";
        $this->assertEquals(
            $license,
            '<a rel="license" href="http://creativecommons.org/licenses/by/3.0/">Creative Commons Attribution 3.0 Unported License</a>'
        );
    }
}
