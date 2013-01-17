<?php

/**
 * Unit testing: class Author
 *
 * @package     DreykhMetadata
 * @subpackage  Tests
 * @author      Sébastien Santoro aka Dereckson <dereckson@espace-win.org>
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD
 * @version     0.1
 */

namespace DreykhMetadata;

require_once('../../DreykhMetadata/Author.php');

/**
 * Test cases for the class Author
 */
class AuthorTest extends PHPUnit_Framework_TestCase {
    /**
     * Tests the Author::__toString method.
     */
    public function testToString () {
        //Asserts an Author instance without an URL property is rendered as its name
        $author = new Author();
        $author->name = "Quux"
        $this->assertEquals($author, "Quux");

        //Asserts an Author instance with an URL property is rendered as an HTML link
        $author->URL = "http://purl.org/NET/foo/Quux";
        $this->assertEquals(
            $author,
            '<a href="http://purl.org/NET/foo/Quux">Quux</a>'
        );
    }
}
