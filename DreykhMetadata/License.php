<?php
/**
 * License 
 *
 * @package     DreykhMetadata
 * @author      Sébastien Santoro aka Dereckson <dereckson@espace-win.org>
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD
 * @version     0.1
 */

namespace DreykhMetadata;

 /**
  * License class
  */
class License {
    /**
     * @var string The shortname of the license (e.g. CC-BY 3.0)
     */
    public $code;
    
    /**
     * @var string The full name of the license (e.g. Creative Commons Attribution 3.0)
     */
    public $name;
    
    /**
     * @var string The URL of the license (e.g. http://creativecommons.org/licenses/by/3.0/)
     */
    public $URL;
       
    /**
     * Returns a string representation of the license.
     * 
     * @return string If the URL property is defined, the HTML code of a link to the license; otherwise, the name of the license.
     */
    function __toString () {
        if ($this->URL) {
            return '<a rel="license" href="' . $this->URL . '">' . $this->name . '</a>';
        } else {
            return $this->name;
        }
    }
}