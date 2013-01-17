<?php
/**
 * Author
 *
 * @package     DreykhMetadata
 * @author      Sébastien Santoro aka Dereckson <dereckson@espace-win.org>
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD
 * @version     0.1
 */

namespace DreykhMetadata;

 /**
  * Author class
  */
class Author {   
    /**
     * @var string The name of the author
     */
    public $name;
    
    /**
     * @var string An URL pointing to the author reference information or profile
     */
    public $URL;
       
    /**
     * Returns a string representation of the author.
     * 
     * @return string If the URL property is defined, the HTML code of a link to the author; otherwise, the name of the author.
     */
    function __toString () {
        if ($this->URL) {
            return '<a href="' . $this->URL . '">' . $this->name . '</a>';
        } else {
            return $this->name;
        }
    }
}