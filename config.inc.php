<?php

/**
 * sanskrit Addon
 *
 * @author cukabeka
 * @author <a href="http://www.redaxo.de">www.redaxo.de</a>
 *
 * @package redaxo4
 * @version svn:$Id$
 */

$mypage = 'sanskrit';

// Versionsnummer, auch in den Language-Files ändern
$REX['ADDON']['version'][$mypage] = '0.1';

// Fix für REDAXO < 4.2.x
if (!isset($REX['FRONTEND_FILE'])) 
{
  $REX['FRONTEND_FILE'] = 'index.php';
}
  
// Backend
if ($REX['REDAXO'])
{

  if (!isset($I18N))
  {
    $I18N = new i18n($REX['LANG'],$REX['INCLUDE_PATH'] . '/addons/' . $mypage . '/lang/');
  }
  
  // I18N, Addon-Titel für die Navigation
  if (isset($I18N) && is_object($I18N))
  {
    if ($REX['VERSION'] . $REX['SUBVERSION'] < '42')
    {
      $I18N->locale = $REX['LANG'];
      $I18N->filename = $REX['INCLUDE_PATH'] . '/addons/' . $mypage . '/lang/'. $REX['LANG'] . ".lang";
      $I18N->loadTexts();
    }
    else
    {
      $I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/' . $mypage . '/lang/');
    }  
    $REX['ADDON']['page'][$mypage] = $mypage;
    $REX['ADDON']['name'][$mypage] = $I18N->msg('sanskrit_menu_link');
  }

  // Addoninfos, Perms usw.
  $REX['ADDON']['perm'][$mypage] = $mypage.'[]';

  $REX['ADDON']['author'][$mypage] = 'cukabeka';
  $REX['ADDON']['supportpage'][$mypage] = 'forum.redaxo.de';
  $REX['PERM'][] = $mypage.'[]';

  // Subpages
  $REX['ADDON'][$mypage]['SUBPAGES'] = array();
  $REX['ADDON'][$mypage]['SUBPAGES'][] = array ('', $I18N->msg('sanskrit_menu_info'));
  $REX['ADDON'][$mypage]['SUBPAGES'][] = array ('settings', $I18N->msg('sanskrit_menu_settings'));
  // not functional yet
  //$REX['ADDON'][$mypage]['SUBPAGES'][] = array ('profiles', $I18N->msg('sanskrit_menu_profiles'));
  $REX['ADDON'][$mypage]['SUBPAGES'][] = array ('css', $I18N->msg('sanskrit_menu_css'));
}


// Konfiguration

// --- DYN
$REX['ADDON']['sanskrit']['backend'] = '1';
$REX['ADDON']['sanskrit']['frontend'] = '1';
$REX['ADDON']['sanskrit']['excludecats'] = '';
$REX['ADDON']['sanskrit']['excludeids'] = 'a356_ajax';
// --- /DYN


// Include Functions
include($REX['INCLUDE_PATH'] . '/addons/' . $mypage . '/functions/functions.inc.php');

// Request page/sanskrit
$page = rex_request('page', 'string', '');
if ($page === 'medienpool')
{
  $page = 'mediapool';
}

$sanskrit = rex_request('sanskrit', 'string', '');
if (($sanskrit == '') and (isset($_COOKIE['sanskrit_mediapool'])))
{
  $sanskrit = $_COOKIE['sanskrit_mediapool'];
  setcookie('sanskrit_mediapool', '');
}

// OUTPUT_FILTER - sanskrit-Scripte einbinden, Mediapool + Linkmap anpassen
if (($REX['REDAXO'] and $REX['ADDON']['sanskrit']['backend'] === '1') or (!$REX['REDAXO'] and $REX['ADDON']['sanskrit']['frontend'] === '1'))
{
  rex_register_extension('OUTPUT_FILTER', 'sanskrit_output_filter');
}

// Extension-Point für Hinzufügen+übernehmen
if ((($page === 'mediapool') or ($page === 'linkmap')) and ( $sanskrit === 'true'))
{
  rex_register_extension('OUTPUT_FILTER', 'sanskrit_opf_media_linkmap');
  rex_register_extension('MEDIA_ADDED', 'sanskrit_media_added');
}

// JavaScript für Backend und Frontend generieren
// Einbindung sanskrit mit verschiedenen Profilen
if (rex_request('sanskritinit', 'string', '') === 'true')
{
  sanskrit_generate_script();
}

// JavaScript für Mediapool generieren
if (rex_request('sanskritmedia', 'string', '') === 'true')
{
  sanskrit_generate_mediascript();
}

// JavaScript für Linkmap generieren
if (rex_request('sanskritlink', 'string', '') === 'true')
{
  sanskrit_generate_linkscript();
}

// CSS generieren
if (rex_request('sanskritcss', 'string', '') === 'true')
{
  sanskrit_generate_css();
}

// Ausgabe Images
if (rex_request('sanskritimg', 'string', '') <> '')
{
  sanskrit_generate_image();
}
