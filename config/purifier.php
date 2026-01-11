<?php

/**
 * Ok, glad you are here
 * first we get a config instance, and set the settings
 * $config = HTMLPurifier_Config::createDefault();
 * $config->set('Core.Encoding', $this->config->get('purifier.encoding'));
 * $config->set('Cache.SerializerPath', $this->config->get('purifier.cachePath'));
 * if ( ! $this->config->get('purifier.finalize')) {
 *     $config->autoFinalize = false;
 * }
 * $config->loadArray($this->getConfig());
 *
 * You must NOT delete the default settings
 * anything in settings should be compacted with params that needed to instance HTMLPurifier_Config.
 *
 * @link http://htmlpurifier.org/live/configdoc/plain.html
 */

return array(
    'encoding' => 'UTF-8',
    'finalize' => true,
    'ignoreNonStrings' => false,
    'cachePath' => storage_path('app/purifier'),
    'cacheFileMode' => 0755,
    'settings' => array(
        'default' => array(
            'HTML.Doctype' => 'HTML 4.01 Transitional',
            'HTML.Allowed' => 'div,b,strong,i,em,u,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src]',
            'CSS.AllowedProperties' => 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',
            'AutoFormat.AutoParagraph' => true,
            'AutoFormat.RemoveEmpty' => true,
        ),
        'test' => array(
            'Attr.EnableID' => 'true',
        ),
        'youtube' => array(
            'HTML.SafeIframe' => 'true',
            'URI.SafeIframeRegexp' => '%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%',
        ),
        'custom_definition' => array(
            'id' => 'html5-definitions',
            'rev' => 1,
            'debug' => false,
            'elements' => array(
                // http://developers.whatwg.org/sections.html
                array('section', 'Block', 'Flow', 'Common'),
                array('nav', 'Block', 'Flow', 'Common'),
                array('article', 'Block', 'Flow', 'Common'),
                array('aside', 'Block', 'Flow', 'Common'),
                array('header', 'Block', 'Flow', 'Common'),
                array('footer', 'Block', 'Flow', 'Common'),

                // Content model actually excludes several tags, not modelled here
                array('address', 'Block', 'Flow', 'Common'),
                array('hgroup', 'Block', 'Required: h1 | h2 | h3 | h4 | h5 | h6', 'Common'),

                // http://developers.whatwg.org/grouping-content.html
                array('figure', 'Block', 'Optional: (figcaption, Flow) | (Flow, figcaption) | Flow', 'Common'),
                array('figcaption', 'Inline', 'Flow', 'Common'),

                // http://developers.whatwg.org/the-video-element.html#the-video-element
                array('video', 'Block', 'Optional: (source, Flow) | (Flow, source) | Flow', 'Common', array(
                    'src' => 'URI',
                    'type' => 'Text',
                    'width' => 'Length',
                    'height' => 'Length',
                    'poster' => 'URI',
                    'preload' => 'Enum#auto,metadata,none',
                    'controls' => 'Bool',
                )),
                array('source', 'Block', 'Flow', 'Common', array(
                    'src' => 'URI',
                    'type' => 'Text',
                )),

                // http://developers.whatwg.org/text-level-semantics.html
                array('s', 'Inline', 'Inline', 'Common'),
                array('var', 'Inline', 'Inline', 'Common'),
                array('sub', 'Inline', 'Inline', 'Common'),
                array('sup', 'Inline', 'Inline', 'Common'),
                array('mark', 'Inline', 'Inline', 'Common'),
                array('wbr', 'Inline', 'Empty', 'Core'),

                // http://developers.whatwg.org/edits.html
                array('ins', 'Block', 'Flow', 'Common', array('cite' => 'URI', 'datetime' => 'CDATA')),
                array('del', 'Block', 'Flow', 'Common', array('cite' => 'URI', 'datetime' => 'CDATA')),
            ),
            'attributes' => array(
                array('iframe', 'allowfullscreen', 'Bool'),
                array('table', 'height', 'Text'),
                array('td', 'border', 'Text'),
                array('th', 'border', 'Text'),
                array('tr', 'width', 'Text'),
                array('tr', 'height', 'Text'),
                array('tr', 'border', 'Text'),
            ),
        ),
        'custom_attributes' => array(
            array('a', 'target', 'Enum#_blank,_self,_target,_top'),
        ),
        'custom_elements' => array(
            array('u', 'Inline', 'Inline', 'Common'),
        ),
    ),

);
