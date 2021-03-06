<?php
/**
 * A MediaWiki media
 *
 * @package     DreykhMetadata
 * @author      Harsh Kothari (http://mediawiki.org/wiki/User:Harsh4101991) <harshkothari410@gmail.com>
 * @author      Sébastien Santoro aka Dereckson <dereckson@espace-win.org>
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD
 * @version     0.1
 */

namespace DreykhMetadata;

 /**
  * MediaWikiMedia class
  */
class MediaWikiMedia extends Media {
    /**
     * Constructs a MediaWikiMedia objet from the wiki text of a media page.
     *
     * @param string $text The wiki text
     */
    static function FromWikitext ($text) {
        $media = new Media();
        // Parses {{Information}}, {{Artwork}} templates
        $media->description = self::ParseDescription($text);
        $media->authors = self::ParseAuthors($text);
        $media->title = self::ParseTitle($text);

        // Parses licenses template / categories
        $media->licenses = self::ParseLicenses($text);

        return $media;
    }

    /**
     * Parses a MediaWiki page to get the description.
     *
     * @param string $text The description page wiki text.
     * @return string The description of the work.
     */
    static function ParseDescription ($text) {
        return "";
    }

    /**
     * Parses a MediaWiki page to get the authors.
     *
     * @param string $text The description page wiki text.
     * @return  Array The authors of the work.
     */
    static function ParseAuthors ($text) {
        $authors = array();
        return $authors;
    }

    /**
     * Parses a MediaWiki page to get the title.
     *
     * @param string $text The description page wiki text.
     * @return string The title of the work.
     *
     * @remark This is mainly intended for the {{Artwork}} template.
     */
    static function ParseTitle ($text) {
        return "";
    }

    /**
     * Parses a MediaWiki page to get the licenses.
     *
     * @param string $text The description page wiki text.
     * @return Array The licenses of the work.
     */
    static function ParseLicenses ($text) {
        $licenses = array();
        return $licenses;
    }
}
