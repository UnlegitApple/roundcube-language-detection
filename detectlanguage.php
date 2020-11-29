<?php

/**
 * roundcubeLanguageDetection
 *
 * Adds the automatic detection of the browser's language to be set as a user preference
 *
 * @author UnlegitApple <lurchibolzen@slapmail.tk>
 *
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see http://www.gnu.org/licenses/.
 */

class detectlanguage extends rcube_plugin
{

    function init() {
        $this->add_hook('startup', array($this, 'startup'));
        setLanguage(detectLanguage());
    }


   function detectLanguage($languageOfPage){
    $languageOfPage = "notset";

    // look through sorted list and use first one that matches our languages
    foreach ($langs as $lang => $val) {
        if (strpos($lang, 'de') === 0) {
            // show German site
            $languageOfPage = "de_DE";
        } /*else if (strpos($lang, 'en') === 0) {
            // show English site
            $languageOfPage = "en";
            echo "english";
        }*/
    }
    
    if ($languageOfPage == "notset") {
        $languageOfPage = "en_GB";
    }
    if (isset($_GET['lang'])) {
        $languageOfPage = $_GET['lang'];
    }
    
    $_SESSION['language'] = $languageOfPage;

    return $languageOfPage;
   } 

   function setLanguage($customLanguage){
    
    $rcmail = rcmail::get_instance();
    $rcmail->config->set('language', $customLanguage);
    $rcmail->load_language($customLanguage);
    $rcmail->user->save_prefs(array("language"=>$customLanguage));
   }




}