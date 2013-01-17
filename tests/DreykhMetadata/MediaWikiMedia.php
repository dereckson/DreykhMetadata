<?php

/**
 * Unit testing: class Media
 *
 * @package     DreykhMetadata
 * @subpackage  Tests
 * @author      SÃ©bastien Santoro aka Dereckson <dereckson@espace-win.org>
 * @license     http://www.opensource.org/licenses/bsd-license.php BSD
 * @version     0.1
 */

namespace DreykhMetadata;

require_once('../../DreykhMetadata/Author.php');
require_once('../../DreykhMetadata/License.php');
require_once('../../DreykhMetadata/Media.php');
require_once('../../DreykhMetadata/MediaWikiMedia.php');

/**
 * Test cases for the class License
 */
#{{en|''Crassula arborescens'', Botanic Garden, Munich, Germany}}
class MediaWikiMediaTest extends \PHPUnit_Framework_TestCase {
    /**
     * Tests the parser functions
     */
    public function testFromWikitext () {
        $textInformation = <<<EOT
=={{int:filedesc}}==
{{Information
|description=
{{es|1=''Crassula arborescens'', Jardín Botánico, Múnich, Alemania}}
{{fr|1=''Crassula arborescens'', Jardin botanique, Munich, Allemagne}}
|date=2012-04-21
|source={{own}}
|author=[[User:Poco a poco|Poco a poco]]
|permission=
|other_versions=
|other_fields=
}}

== {{Assessment}} ==
{{Assessments|featured=1}}
{{picture of the day|year=2013|month=01|day=15}}
{{QualityImage}}

=={{int:license-header}}==
{{User:Poco a poco/credit}}
{{self|cc-by-sa-3.0}}

[[Category:Uploaded with UploadWizard]]
[[Category:Crassula arborescens]]
[[category:Images by User:Poco a poco]]
[[Category:Quality images by User:Poco a poco]]
[[Category:Quality images of Munich]]
[[Category:Featured pictures by User:Poco a poco]]
[[Category:Featured pictures of Munich]]
[[Category:Botanical gardens in Bavaria]]
[[Category:Nature of Munich]]
[[Category:Taken with Canon EOS 5D Mark II]]
[[Category:2012 in Munich]]
[[Category:April 2012 in Germany]]
EOT;
        $textArtwork = <<<EOT
== {{int:filedesc}} ==
{{Artwork
 |artist           = {{creator:Amedeo Modigliani}}
 |title            = {{fr|''Portrait de Picasso }}
 |description      = {{es|1=''Crassula arborescens'', Jardín Botánico, Múnich, Alemania}}
 |date             = 1915
 |medium           = {{Technique|oil|canvas}}
 |dimensions       = 
 |institution      = {{private collection}}
 |location         = {{unknown|Location}}
 |accession number = 
 |object history   = 
 |credit line      = 
 |inscriptions     = 
 |notes            = 
 |references       = 
 |source           = Museo Progressivo d'Art Contemporanea: ''Modigliani gli anni della scultura'', Livorno 1984
 |permission       = 
 |other_versions   = 
}}


[[Category:Portraits of Pablo Picasso]]

== {{int:license}} ==
{{PD-Art|PD-old-auto|deathyear=1920}}
[[Category:Amedeo Modigliani]]

EOT;

        //Empty string
        $media = MediaWikiMedia::FromWikitext("");
        $this->assertEquals( "" , $media->description );
        $this->assertEquals( 0, count($media->authors) );
        $this->assertEquals( 0, count($media->licenses) );

        //{{Information}}
        $media = MediaWikiMedia::FromWikitext($textInformation);
        $expectedLicense = new License();
        $expectedLicense->name = "Creative Commons Attribution-ShareAlike 3.0 Unported";
        $expectedLicense->code = "CC BY-SA 3.0";
        $expectedLicense->URL = "http://creativecommons.org/licenses/by-sa/3.0/";
        $this->assertEquals( "Crassula arborescens, Botanic Garden, Munich, Germany+", $media->description );
        $this->assertEquals( array('Poco a poco'), $media->authors );
        $this->assertEquals( array($expectedLicense), $media->licenses );

        //{{Artwork}}
        $media = MediaWikiMedia::FromWikitext($textArtwork);
        $expectedLicense = new License();
        $this->assertEquals( "Portrait de Picasso", $media->description) ;
        $this->assertEquals( array('Amedeo Modigliani'), $media->authors );
        $this->assertEquals( 1, count($media->licenses) );
        $licenseToTest = $media->licenses[0];
        $this->assertEquals( "Public domain", $licenseToTest->name );
        $this->assertEquals( "PD", $licenseToTest->code );
        $this->assertEquals( "", $licenseToTest->URL );
    }

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
