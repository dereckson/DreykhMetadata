<?php
/**
 * Media 
 *
 * @package     DreykhMetadata
 * @author      Sébastien Santoro aka Dereckson <dereckson@espace-win.org>
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD
 * @version     0.1
 */

namespace DreykhMetadata;

 /**
  * Media class
  */
class Media {
    /**
     * @var Array The authors of the work, each item an Author object.
     */
    public $authors;
    
    /**
     * @var string The title of the work
     */
    public $title;
    
    /**
     * @var string The description of the work
     */
    public $description;
    
    /**
     * @var Array The licenses of the work, each item an Author object
     */
    public $licenses;
    
    /**
     * @var string The URL to the work
     */
    public $URL;
    
    /**
     * @var string The type of media (image, video, text or application)
     */
    public $type;
    
    /**
     * @var string The format of the work
     */
    public $format;
       
    /**
     * Returns a string representation of the media.
     * 
     * @return string The media title
     */
    function __toString () {
        return $this->title;
    }
}