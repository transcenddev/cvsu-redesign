<?php

namespace EmbedPress\Providers;

use Embera\Provider\ProviderAdapter;
use Embera\Provider\ProviderInterface;
use Embera\Url;

(defined('ABSPATH') && defined('EMBEDPRESS_IS_LOADED')) or die("No direct script access allowed.");

/**
 * Entity responsible to support GoogleMaps embeds.
 *
 * @package     EmbedPress
 * @subpackage  EmbedPress/Providers
 * @author      EmbedPress <help@embedpress.com>
 * @copyright   Copyright (C) 2023 WPDeveloper. All rights reserved.
 * @license     GPLv3 or later
 * @since       1.0.0
 */
class GoogleMaps extends ProviderAdapter implements ProviderInterface
{
    /** inline {@inheritdoc} */
    protected static $hosts = ["google.com", "google.com.*", "maps.google.com", "goo.gl", "google.co.*"];
    /**
     * Method that verifies if the embed URL belongs to GoogleMaps.
     *
     * @param Url $url
     * @return  boolean
     * @since   1.0.0
     *
     */
    public function validateUrl(Url $url)
    {
       return  (bool) preg_match('~http[s]?:\/\/(?:(?:(?:www\.|maps\.)?(?:google\.com?))|(?:goo\.gl))(?:\.[a-z]{2})?\/(?:maps\/)?(?:place\/)?(?:[a-z0-9\/%+\-_]*)?([a-z0-9\/%,+\-_=!:@\.&*\$#?\']*)~i',
            (string) $url);
    }

    public function validateGoogleMapUrl($url)
    {
       return  (bool) preg_match('~http[s]?:\/\/(?:(?:(?:www\.|maps\.)?(?:google\.com?))|(?:goo\.gl))(?:\.[a-z]{2})?\/(?:maps\/)?(?:place\/)?(?:[a-z0-9\/%+\-_]*)?([a-z0-9\/%,+\-_=!:@\.&*\$#?\']*)~i',
            (string) $url);
    }

    /**
     * This method fakes an Oembed response.
     *
     * @since   1.0.0
     *
     * @return  array
     */
    public function fakeResponse()
    {
        $src_url = urldecode($this->url);

        preg_match('/(?<=mid=).*$/', $src_url, $matches);
        
        if (!empty($matches)) {
            $mid = $matches[0].'&ehbc=2E312F';
        }

        // Check if the url is already converted to the embed format  
        if (preg_match('~(maps/embed|output=embed)~i', $src_url)) {
            $iframeSrc = $src_url;
        } 
        else {
            // Extract coordinates and zoom from the url
            if (preg_match('~(?:maps\/(?:place|(?:dir\/.+?))\/(.+)\/)?@(-?[0-9\.]+,-?[0-9\.]+).+,([0-9\.]+[a-z])~i', $src_url, $matches)) {
                $place_name = str_replace("+"," ",$matches[1]);
            	$z = floatval( $matches[3]);
                $iframeSrc = 'https://maps.google.com/maps?hl=en&ie=UTF8&ll=' . $matches[2] . '&spn=' . $matches[2] . '&q='.$place_name.'&t=m&z=' . round($z) . '&output=embed&iwloc';
            } 
            else if ($this->validateGoogleMapUrl($src_url)){
                $iframeSrc = 'https://www.google.com/maps/d/embed?mid='.$mid;
            }
            else {
                return [];
            }
        }

	    $width = isset( $this->config['maxwidth']) ? $this->config['maxwidth']: 600;
	    $height = isset( $this->config['maxheight']) ? $this->config['maxheight']: 450;

        return [
            'type'          => 'rich',
            'provider_name' => 'Google Maps',
            'provider_url'  => 'https://maps.google.com',
            'title'         => 'Unknown title',
            'html'          => '<iframe title=""  width="'.$width.'" height="'.$height.'" src="'.$iframeSrc.'" frameborder="0"></iframe>',     
        ];
    }
    /** inline @inheritDoc */
    public function modifyResponse( array $response = [])
    {
        return $this->fakeResponse();
    }

}
