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

        $text = preg_replace( '/^.*([Ii]nformation|[Aa]rtwork)/', '', $text );
       /* $pos = strpos($text, "{{Information"); 
        if ( $pos === false ) { 
            $pos = strpos($text, "{{information"); 
        }

        if ( $pos === false ) {
            $pos = strpos($text, "{{Artwork");
        }

        if ( $pos === false ) {
            $pos = strpos($text, "{{artwork");
        }
*/
        #$str = substr($text, $pos);
        $find = "description";
        $pos = strpos($text,$find);
        
        if ($pos) {//checking id description field is there or not
            $str = substr($text, $pos+strlen($find));
        }
        else{
            return "";
        }
        #Extracting Info from Description
        $pos = strpos($str, "{{");
        $str = substr($str, $pos + strlen("{{"));
        $pos1 = strpos($str, "}}");
        $str = substr($str, 0, $pos1);

        if( strpos($str, "=") ){
            $pos = strpos($str, "=");
            $str = substr($str, $pos + strlen("="));
            $str = str_replace("''", "", $str);
            $str = preg_replace( '/\[\[([^\]\|]+\|)?([^\]\|]+)\]\]/', "$2", $str );
        }
        elseif ( strpos($str, "|") ) {
            $pos = strpos($str, "|");
            $str = substr($str, $pos + strlen("|"));
            $str = str_replace("''", "", $str);
            $str = preg_replace( '/\[\[([^\]\|]+\|)?([^\]\|]+)\]\]/', "$2", $str );

        }
        else{
            $str = $str ;
            $str = preg_replace( '/\[\[([^\]\|]+\|)?([^\]\|]+)\]\]/', "$2", $str );
        }

        return $str;
    }

    /**
     * Parses a MediaWiki page to get the authors.
     *
     * @param string $text The description page wiki text.
     * @return  Array The authors of the work.
     */
    static function ParseAuthors ($text) {
        #$authors = array();
        $pos = strpos($text, "{{Information");
        $flag = 1; 
        if ( $pos === false ) { 
            $pos = strpos($text, "{{information"); 
            $flag = 1;
        }

        if ( $pos === false ) {
            $pos = strpos($text, "{{Artwork");
            $flag = 0;
        }

        if ( $pos === false ) {
            $pos = strpos($text, "{{artwork");
            $flag = 0;
        }

        $str = substr($text, $pos);
        $find = $flag ? "author" : "artist" ;
        $bracket =  $flag ? "[[" : "{{" ;
        $bracket1 = $flag ? "]]" : "}}" ;
        $pos = strpos($text,$find);
        
        if ($pos) {//checking id description field is there or not
            $str = substr($text, $pos+strlen($find));
        }
        else{
            return $authors = array();
        }

        $pos = strpos($str, "[[");

        if ($pos < 5) {
            $pos = strpos($str, $bracket);
            $str = substr($str, $pos + strlen($bracket));
            $pos1 = strpos($str, $bracket1);
            $str = substr($str, 0, $pos1);
            $find = strpos($str, "|") ? "|" : ":" ;
            $pos = strpos($str,$find);
            $str = substr($str, $pos+strlen("|"));
        }
        else{
            $pos = strpos($str, "|");
            $str = substr($str, strpos($str, "=")+1 , $pos-2);
        }
        return $authors = array($str);
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
