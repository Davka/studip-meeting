<?php

/**
 * Adds the meeting plugin's help tours.
 * 
 * @author Gerd Hoffmann <gerd.hoffmann@uni-oldenburg.de>
 */

class AddHelpTours extends Migration {
	
    /**
     * {@inheritdoc}
     */
    public function description() {
        return "Adds the meeting plugin's help tours.";
    }

    /**
     * {@inheritdoc}
     */
    public function up() {
    	
    	// add tour data
    	$insert = "INSERT IGNORE INTO `help_tours` (`tour_id`, `name`, `description`, `type`, `roles`, `version`, `language`, `studip_version`, `installation_id`, `mkdate`) VALUES
            ('4c41c9760a3248313236af202275109a', 'Meetings erstellen', 'Die Tour erkl�rt das Anlegen neuer Meetings.', 'tour', 'dozent,admin,root', 1, 'de', '3.1', '', 1406709759),
            ('4c41c9760a3248313236af202275109b', 'Meetings nutzen', 'Die Tour erkl�rt die Verwaltung von Meetings in einer Veranstaltung.', 'tour', 'dozent,admin,root', 1, 'de', '3.1', '', 1406709759),
            ('4c41c9760a3248313236af202275109c', 'Meetings anpassen', 'Die Tour beschreibt, wie die Benutzungsoberfl�che von Meetings angepasst werden kann.', 'tour', 'dozent,admin,root', 1, 'de', '3.1', '', 1406709759),
            ('4c41c9760a3248313236af202275109d', 'Gesamtansicht', 'Die Tour erkl�rt die Verwaltung von Meetings in der pers�nlichen Gesamtansicht eines Nutzers.', 'tour', 'dozent,admin,root', 1, 'de', '3.1', '', 1406709759);
            ";
    	
    	DBManager::get()->exec($insert);
    	
    	// add steps
    	$insert = "INSERT IGNORE INTO `help_tour_steps` (`tour_id`, `step`, `title`, `tip`, `orientation`, `interactive`, `css_selector`, `route`, `mkdate`) VALUES
            ('4c41c9760a3248313236af202275109a', 1, 'Meetings erstellen', 'Diese Tour gibt einen �berblick �ber das Anlegen neuer Meetings.\r\n\r\nUm zum n�chsten Schritt zu gelangen, klicken Sie bitte rechts unten auf \"Weiter\".', 'T', 0, '', 'plugins.php/meetingplugin', 1406709759),
            ('4c41c9760a3248313236af202275109a', 2, 'Meeting benennen', 'Um ein neues Meeting zu erstellen, geben Sie bitte zun�chst einen Namen ein und klicke dann auf die Schaltfl�che \"Meeting erstellen\".', 'B', 1, 'INPUT[name=name]', 'plugins.php/meetingplugin', 1406709759),
            ('4c41c9760a3248313236af202275109a', 3, 'Meetings mehrfach verwenden', 'Haben Sie ein Meeting erstellt und in Adobe Connect konfiguriert, so k�nnen Sie die Konfiguration einsparen, indem Sie ein neues Meeting erstellen, das auf ein bereits vorhandenes Meeting verweist.', 'R', 0, 'SELECT[name=meeting_id]', 'plugins.php/meetingplugin', 1406709759),
            ('4c41c9760a3248313236af202275109a', 4, 'Meetings mehrfach verwenden', 'Geben Sie in das Eingabefeld einen Namen f�r das neue Meeting ein. Suchen Sie dann in dem gezeigten Feld ein Meeting aus und klicken auf die Schaltfl�che \"Meeting verlinken\".', 'BR', 0, 'SELECT[name=meeting_id]', 'plugins.php/meetingplugin', 1406709759),
    		('4c41c9760a3248313236af202275109a', 5, 'Informationen anzeigen', 'Zeigt eine �bersicht der Eigenschaften aller Meetings an, die f�r diese Veranstaltung erstellt wurden.', 'BL', 0, '#layout-sidebar SECTION:eq(0)  DIV:eq(5)  DIV:eq(1)  UL:eq(0)  LI:eq(0)  A:eq(0)', 'plugins.php/meetingplugin', 1406709759),
            ('4c41c9760a3248313236af202275109a', 6, 'Anpassen', 'Mit einem Klick auf diesen Hyperlink gelangen Sie in einen Arbeitsbereich, mit dessen Hilfe Sie Meetings konfigurieren k�nnen.', 'BL', 0, '#layout-sidebar SECTION:eq(0)  DIV:eq(8)  DIV:eq(1)  UL:eq(0)  LI:eq(0)  A:eq(0)', 'plugins.php/meetingplugin', 1406709759),
    		('4c41c9760a3248313236af202275109b', 1, 'Meetings nutzen', 'Die Tour erkl�rt die Verwaltung von Meetings in einer Veranstaltung.\r\n\r\nUm zum n�chsten Schritt zu gelangen, klicken Sie bitte rechts unten auf \"Weiter\".', 'T', 0, '', 'plugins.php/meetingplugin', 1406709759),
    		('4c41c9760a3248313236af202275109b', 2, 'Meetings', 'Zeigt eine Liste aller erstellten Meetings in tabellarischer Form an.', 'BL', 0, '#layout_content DIV:eq(0)  FORM:eq(0)  TABLE:eq(0)  CAPTION:eq(0)', 'plugins.php/meetingplugin', 1406709759),
    	    ('4c41c9760a3248313236af202275109b', 3, 'Meeting', 'Zeigt den Namen eines Meetings an.', 'BL', 0, '#layout_content DIV:eq(0)  FORM:eq(0)  TABLE:eq(0)  THEAD:eq(0)  TR:eq(0)  TH:eq(1)', 'plugins.php/meetingplugin', 1406709759),
    		('4c41c9760a3248313236af202275109b', 4, 'Aufzeichnung', 'Zeigt ein Icon an, wenn Sie mit Hilfe der Aktion \"Meeting bearbeiten\" die URL eines aufgezeichneten Meetings eingetragen haben.\r\n\r\nEin Klick auf ein solches Icon �ffnet das aufgezeichnete Meeting.', 'BL', 0, '#layout_content DIV:eq(0)  FORM:eq(0)  TABLE:eq(0)  THEAD:eq(0)  TR:eq(0)  TH:eq(2)', 'plugins.php/meetingplugin', 1406709759),
    		('4c41c9760a3248313236af202275109b', 5, 'Erstellt von', 'In der Regel steht hier der Name der veranstaltenden Person. Wenn diese an die  Teilnehmenden Veranstalter-Rechte vergibt, k�nnen auch Teilnehmende Meetings erstellen. In dem Fall f�hrt das Feld dann den Namen der teilnehmenden Person an, die ein Meeting erstellt hat.', 'BL', 0, '#layout_content DIV:eq(0)  FORM:eq(0)  TABLE:eq(0)  THEAD:eq(0)  TR:eq(0)  TH:eq(3)', 'plugins.php/meetingplugin', 1406709759),
    		('4c41c9760a3248313236af202275109b', 6, 'Zuletzt betreten', 'Zeigt an, ob ein Meeting benutzt wird. Auf diese Weise lassen sich Meetings, die nicht genutzt werden, leicht identifizieren.', 'BL', 0, '#layout_content DIV:eq(0)  FORM:eq(0)  TABLE:eq(0)  THEAD:eq(0)  TR:eq(0)  TH:eq(4)', 'plugins.php/meetingplugin', 1406709759),
     		('4c41c9760a3248313236af202275109b', 7, 'Freigeben', 'Sie k�nnen f�r Ihre Veranstaltung Meetings vorbereiten und diese dann, wenn Sie diese einsetzen m�chten, durch das Setzen eines Hakens f�r die Teilnehmenden sichtbar schalten.\r\n\r\nDas Zur�cksetzen des Hakens schaltet ein Meeting f�r die Teilnehmenden wieder unsichtbar.', 'BL', 0, '#layout_content DIV:eq(0)  FORM:eq(0)  TABLE:eq(0)  THEAD:eq(0)  TR:eq(0)  TH:eq(5)', 'plugins.php/meetingplugin', 1406709759),
    		('4c41c9760a3248313236af202275109b', 8, 'Aktion', 'F�r angelegte Meetings stehen vier Aktionen bereit:\r\n\r\n- Informationen anzeigen\r\n- Meeting bearbeiten\r\n- Status der Teilnehmenden\r\n- L�schen', 'BR', 0, '#layout_content DIV:eq(0)  FORM:eq(0)  TABLE:eq(0)  THEAD:eq(0)  TR:eq(0)  TH:eq(6)', 'plugins.php/meetingplugin', 1406709759),
    		('4c41c9760a3248313236af202275109b', 9, 'Informationen anzeigen', 'Zeigt eine �bersicht der Eigenschaften aller Meetings an, die f�r diese Veranstaltung erstellt wurden.', 'BL', 0, '#layout-sidebar SECTION:eq(0)  DIV:eq(5)  DIV:eq(1)  UL:eq(0)  LI:eq(0)  A:eq(0)', 'plugins.php/meetingplugin', 1406709759),
    		('4c41c9760a3248313236af202275109b', 10, 'Anpassen', 'Mit einem Klick auf diesen Hyperlink gelangen Sie in einen Arbeitsbereich, mit dessen Hilfe Sie Meetings konfigurieren k�nnen.', 'BL', 0, '#layout-sidebar SECTION:eq(0)  DIV:eq(8)  DIV:eq(1)  UL:eq(0)  LI:eq(0)  A:eq(0)', 'plugins.php/meetingplugin', 1406709759),
            ('4c41c9760a3248313236af202275109c', 1, 'Meetings anpassen', 'Die Tour zeigt, wie Sie Meetings umbenennen und mit Inhalten erg�nzen k�nnen.\r\n\r\nUm zum n�chsten Schritt zu gelangen, klicken Sie bitte rechts unten auf \"Weiter\".', 'T', 0, '', 'plugins.php/meetingplugin/index/config', 1406709759),
    		('4c41c9760a3248313236af202275109c', 2, 'Reitername', 'M�chten Sie den Videokonferenzen in Ihrer Veranstaltung einen anderen Sammelbegriff zuordnen, tragen Sie den Begriff in das Eingabefeld ein und klicken unten auf die Schaltfl�che \"Speichern\".', 'BL', 0, '#vc_config_title', 'plugins.php/meetingplugin/index/config', 1406709759),
    		('4c41c9760a3248313236af202275109c', 3, 'Einleitungstext', 'Erstellen Sie mit Hilfe des Editors einen Einleitungstext f�r die Meetings zu Ihrer Veranstaltung. Klicken Sie anschlie�end unten auf die Schaltfl�che \"Speichern\".\r\n\r\nDer Text erscheint �ber der tabellarischen Liste der Meetings.', 'TL', 0, '#layout_content FORM:eq(0)  FIELDSET:eq(0)  FIELDSET:eq(1)  LABEL:eq(0)', 'plugins.php/meetingplugin/index/config', 1406709759),
    		('4c41c9760a3248313236af202275109c', 4, 'Meetings', 'Mit einem Klick auf diesen Hyperlink gelangen Sie in die Hauptansicht von Meetings zur�ck.', 'BL', 0, '#layout-sidebar SECTION:eq(0)  DIV:eq(2)  DIV:eq(1)  UL:eq(0)  LI:eq(0)  A:eq(0)', 'plugins.php/meetingplugin/index/config', 1406709759),	
    		('4c41c9760a3248313236af202275109d', 1, 'Gesamtansicht', 'Die Tour erkl�rt die Verwaltung Ihrer in der Gesamtansicht angezeigten Meetings.\r\n\r\nUm zum n�chsten Schritt zu gelangen, klicken Sie bitte rechts unten auf \"Weiter\".', 'T', 0, '', 'plugins.php/meetingplugin/index/my', 1406709759),
    		('4c41c9760a3248313236af202275109d', 2, 'Anzeige', 'W�hlen Sie die Sortierung Ihrer Meetings nach Semester oder nach dem Namen der Meetings.', 'BL', 0, '#layout-sidebar SECTION:eq(0)  DIV:eq(1)  DIV:eq(1)  UL:eq(0)  LI:eq(0)  A:eq(0)', 'plugins.php/meetingplugin/index/my', 1406709759),
    		('4c41c9760a3248313236af202275109d', 3, 'Meine Meetings', 'Zeigt eine Liste aller von Ihnen erstellten Meetings in tabellarischer Form an.', 'BL', 0, '#layout_content FORM:eq(0)  TABLE:eq(0)  CAPTION:eq(0)', 'plugins.php/meetingplugin/index/my', 1406709759),
    		('4c41c9760a3248313236af202275109d', 4, 'Meeting', 'Zeigt den Namen eines Meetings an.', 'BL', 0, '#layout_content FORM:eq(0)  TABLE:eq(0)  THEAD:eq(0)  TR:eq(0)  TH:eq(1)', 'plugins.php/meetingplugin/index/my', 1406709759),
    		('4c41c9760a3248313236af202275109d', 5, 'Aufzeichnung', 'Zeigt ein Icon an, wenn Sie mit Hilfe der Aktion \"Meeting bearbeiten\" die URL eines aufgezeichneten Meetings eingetragen haben.\r\n\r\nEin Klick auf ein solches Icon �ffnet das aufgezeichnete Meeting.', 'BL', 0, '#layout_content FORM:eq(0)  TABLE:eq(0)  THEAD:eq(0)  TR:eq(0)  TH:eq(2)', 'plugins.php/meetingplugin/index/my', 1406709759),
    		('4c41c9760a3248313236af202275109d', 6, 'Veranstaltung', 'Zeigt die Veranstaltung an, zu der das Meeting geh�rt.', 'BL', 0, '#layout_content FORM:eq(0)  TABLE:eq(0)  THEAD:eq(0)  TR:eq(0)  TH:eq(3)', 'plugins.php/meetingplugin/index/my', 1406709759),
    		('4c41c9760a3248313236af202275109d', 7, 'Zuletzt betreten', 'Zeigt an, ob ein Meeting benutzt wird. Auf diese Weise lassen sich Meetings, die nicht genutzt werden, leicht identifizieren.', 'BL', 0, '#layout_content FORM:eq(0)  TABLE:eq(0)  THEAD:eq(0)  TR:eq(0)  TH:eq(4)', 'plugins.php/meetingplugin/index/my', 1406709759),
    		('4c41c9760a3248313236af202275109d', 8, 'Freigeben', 'Sie k�nnen f�r Ihre Veranstaltung Meetings vorbereiten und diese dann, wenn Sie diese einsetzen m�chten, durch das Setzen eines Hakens f�r die Teilnehmenden sichtbar schalten.\r\n\r\nDas Zur�cksetzen des Hakens schaltet ein Meeting f�r die Teilnehmenden wieder unsichtbar.', 'BL', 0, '#layout_content FORM:eq(0)  TABLE:eq(0)  THEAD:eq(0)  TR:eq(0)  TH:eq(5)', 'plugins.php/meetingplugin/index/my', 1406709759),
    		('4c41c9760a3248313236af202275109d', 9, 'Aktion', 'F�r angelegte Meetings stehen vier Aktionen bereit:\r\n\r\n- Informationen anzeigen\r\n- Meeting bearbeiten\r\n- Status der Teilnehmenden\r\n- L�schen', 'BR', 0, '#layout_content FORM:eq(0)  TABLE:eq(0)  THEAD:eq(0)  TR:eq(0)  TH:eq(6)', 'plugins.php/meetingplugin/index/my', 1406709759),
    		('4c41c9760a3248313236af202275109d', 10, 'Informationen anzeigen', 'Zeigt eine �bersicht der Eigenschaften aller Ihrer Meetings an.', 'BL', 0, '#layout-sidebar SECTION:eq(0)  DIV:eq(1)  DIV:eq(1)  UL:eq(0)  LI:eq(1)  A:eq(0)', 'plugins.php/meetingplugin/index/my', 1406709759);
    	    ";
    	
    	DBManager::get()->exec($insert);
    	
    	// add settings
    	$insert = "INSERT IGNORE INTO `help_tour_settings` (`tour_id`, `active`, `access`) VALUES
            ('4c41c9760a3248313236af202275109a', 1, 'standard'),
    		('4c41c9760a3248313236af202275109b', 1, 'standard'),
    		('4c41c9760a3248313236af202275109c', 1, 'standard'),
    		('4c41c9760a3248313236af202275109d', 1, 'standard');
            ";
    	
    	DBManager::get()->exec($insert);
    }

    /**
     * {@inheritdoc}
     */
    public function down() {
    	
    	// delete settings
    	$delete = "DELETE FROM help_tour_settings WHERE 
    		tour_id = '4c41c9760a3248313236af202275109a' OR 
    		tour_id = '4c41c9760a3248313236af202275109b' OR 
    		tour_id = '4c41c9760a3248313236af202275109c' OR 
    		tour_id = '4c41c9760a3248313236af202275109d'
    		";
    	
    	DBManager::get()->exec($delete);
    	
    	// delete steps
    	$delete = "DELETE FROM help_tour_steps WHERE
    		tour_id = '4c41c9760a3248313236af202275109a' OR
    		tour_id = '4c41c9760a3248313236af202275109b' OR
    		tour_id = '4c41c9760a3248313236af202275109c' OR
    		tour_id = '4c41c9760a3248313236af202275109d'
    		";
    	 
    	DBManager::get()->exec($delete);
    	
    	// delete tour data
    	$delete = "DELETE FROM help_tours WHERE
    		tour_id = '4c41c9760a3248313236af202275109a' OR
    		tour_id = '4c41c9760a3248313236af202275109b' OR
    		tour_id = '4c41c9760a3248313236af202275109c' OR
    		tour_id = '4c41c9760a3248313236af202275109d'
    		";
    	 
    	DBManager::get()->exec($delete);	
    }
}