<?php
/*
Template Name: Über uns
*/
get_header(); ?>

<?php
	/*if (   ! is_active_sidebar( $slug.'-left-widget-area'  )
		&& ! is_active_sidebar( $slug.'-middle-widget-area' )
		&& ! is_active_sidebar( $slug.'-right-widget-area'  )
	)
		return;*/
?>

<div class="widgets"><h2><?php echo wp_title("", false, ""); ?></h2>
<?php if ( is_user_logged_in() ) : ?>
        <div class="edit"><a href="<?php echo get_site_url(); ?>/wp-admin/widgets.php">Bearbeiten</a></div>
<?php endif; ?>
<div id="one" class="hyphenate"><ul>
<?php if ( is_active_sidebar( 'about-us-left-area' ) ) : ?>
		<?php dynamic_sidebar( 'about-us-left-area' ); ?>
<?php endif; ?>
</ul></div>

<div id="two"><ul>
<?php if ( is_active_sidebar( 'about-us-middle-area' ) ) : ?>
		<?php dynamic_sidebar( 'about-us-middle-area' ); ?>
<?php endif; ?>
</ul></div>

<div id="three"><ul>
<?php if ( is_active_sidebar( 'about-us-right-area' ) ) : ?>
			<?php dynamic_sidebar( 'about-us-right-area' ); ?>
<?php endif; ?>
</ul></div><br style="clear:both;" /></div>

<article class="white"><header><h2>Das Pfarrheim</h2></header>
<iframe width="610" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.de/maps?f=d&amp;source=s_d&amp;saddr=Pfarrheim+%4047.98525779018178,12.128120362758636&amp;daddr=&amp;hl=de&amp;geocode=&amp;sll=47.985389,12.128319&amp;sspn=0.001129,0.001797&amp;mra=mift&amp;ie=UTF8&amp;t=m&amp;ll=47.985326,12.12808&amp;spn=0.002513,0.006534&amp;z=17&amp;output=embed"></iframe>
<footer></footer></article>

<article><header><h2>Impressum und Datenschutzerklärung</h2></header>
<?php //if ( is_active_sidebar( 'impressum-area' ) ) : ?>
		<div class="content"><div id="four">
			<?php //dynamic_sidebar( 'impressum-area' ); ?>
<p>Verantwortliche Stelle im Sinne der Datenschutzgesetze, insbesondere der EU-Datenschutzgrundverordnung (DSGVO), ist:</p>
<p>Christian John</p>
</br>
<h3 style="font-weight: bold; ">Ihre Betroffenenrechte</h3>
<p>Unter den angegebenen Kontaktdaten unseres Datenschutzbeauftragten können Sie jederzeit folgende Rechte ausüben:</p>
<ul>
<li>Auskunft über Ihre bei uns gespeicherten Daten und deren Verarbeitung,</li>
<li>Berichtigung unrichtiger personenbezogener Daten,</li>
<li>Löschung Ihrer bei uns gespeicherten Daten,</li>
<li>Einschränkung der Datenverarbeitung, sofern wir Ihre Daten aufgrund gesetzlicher Pflichten noch nicht löschen dürfen,</li>
<li>Widerspruch gegen die Verarbeitung Ihrer Daten bei uns und</li>
<li>Datenübertragbarkeit, sofern Sie in die Datenverarbeitung eingewilligt haben oder einen Vertrag mit uns abgeschlossen haben.</li>
</ul>
<p>Sofern Sie uns eine Einwilligung erteilt haben, können Sie diese jederzeit mit Wirkung für die Zukunft widerrufen.</p>
<p>Sie können sich jederzeit mit einer Beschwerde an die für Sie zuständige Aufsichtsbehörde wenden. Ihre zuständige Aufsichtsbehörde richtet sich nach dem Bundesland Ihres Wohnsitzes, Ihrer Arbeit oder der mutmaßlichen Verletzung. Eine Liste der Aufsichtsbehörden (für den nichtöffentlichen Bereich) mit Anschrift finden Sie unter: <a href="https://www.bfdi.bund.de/DE/Infothek/Anschriften_Links/anschriften_links-node.html" target="_blank" rel="noopener">https://www.bfdi.bund.de/DE/Infothek/Anschriften_Links/anschriften_links-node.html</a>.</p>
<h3>Zwecke der Datenverarbeitung durch die verantwortliche Stelle und Dritte</h3>
<p>Wir verarbeiten Ihre personenbezogenen Daten nur zu den in dieser Datenschutzerklärung genannten Zwecken. Eine Übermittlung Ihrer persönlichen Daten an Dritte zu anderen als den genannten Zwecken findet nicht statt. Wir geben Ihre persönlichen Daten nur an Dritte weiter, wenn:</p>
<ul>
<li>Sie Ihre ausdrückliche Einwilligung dazu erteilt haben,</li>
<li>die Verarbeitung zur Abwicklung eines Vertrags mit Ihnen erforderlich ist,</li>
<li>die Verarbeitung zur Erfüllung einer rechtlichen Verpflichtung erforderlich ist,</li>
</ul>
<p>die Verarbeitung zur Wahrung berechtigter Interessen erforderlich ist und kein Grund zur Annahme besteht, dass Sie ein überwiegendes schutzwürdiges Interesse an der Nichtweitergabe Ihrer Daten haben.</p>
<h3>Löschung bzw. Sperrung der Daten</h3>
<p>Wir halten uns an die Grundsätze der Datenvermeidung und Datensparsamkeit. Wir speichern Ihre personenbezogenen Daten daher nur so lange, wie dies zur Erreichung der hier genannten Zwecke erforderlich ist oder wie es die vom Gesetzgeber vorgesehenen vielfältigen Speicherfristen vorsehen. Nach Fortfall des jeweiligen Zweckes bzw. Ablauf dieser Fristen werden die entsprechenden Daten routinemäßig und entsprechend den gesetzlichen Vorschriften gesperrt oder gelöscht.</p>
<h3>Erfassung allgemeiner Informationen beim Besuch unserer Website</h3>
<p>Wenn Sie auf unsere Website zugreifen, werden automatisch Informationen allgemeiner Natur erfasst. Diese Informationen (Server-Logfiles) beinhalten etwa die Art des Webbrowsers, das verwendete Betriebssystem, den Domainnamen Ihres Internet-Service-Providers und ähnliches. Hierbei handelt es sich ausschließlich um Informationen, welche keine Rückschlüsse auf Ihre Person zulassen.</p>
<p>Diese Informationen sind technisch notwendig, um von Ihnen angeforderte Inhalte von Webseiten korrekt auszuliefern und fallen bei Nutzung des Internets zwingend an. Sie werden insbesondere zu folgenden Zwecken verarbeitet:</p>
<ul>
<li>Sicherstellung eines problemlosen Verbindungsaufbaus der Website,</li>
<li>Sicherstellung einer reibungslosen Nutzung unserer Website,</li>
<li>Auswertung der Systemsicherheit und -stabilität sowie</li>
<li>zu weiteren administrativen Zwecken.</li>
</ul>
<p>Die Verarbeitung Ihrer personenbezogenen Daten basiert auf unserem berechtigten Interesse aus den vorgenannten Zwecken zur Datenerhebung. Wir verwenden Ihre Daten nicht, um Rückschlüsse auf Ihre Person zu ziehen. Empfänger der Daten sind nur die verantwortliche Stelle und ggf. Auftragsverarbeiter.</p>
<p>Anonyme Informationen dieser Art werden von uns ggfs. statistisch ausgewertet, um unseren Internetauftritt und die dahinterstehende Technik zu optimieren.</p>
<h3>SSL-Verschlüsselung</h3>
<p>Um die Sicherheit Ihrer Daten bei der Übertragung zu schützen, verwenden wir dem aktuellen Stand der Technik entsprechende Verschlüsselungsverfahren (z. B. SSL) über HTTPS.</p>
<h3>Verwendung von Google Maps</h3>
<p>Diese Webseite verwendet Google Maps API, um geographische Informationen visuell darzustellen. Bei der Nutzung von Google Maps werden von Google auch Daten über die Nutzung der Kartenfunktionen durch Besucher erhoben, verarbeitet und genutzt. Nähere Informationen über die Datenverarbeitung durch Google können Sie <a href="http://www.google.com/privacypolicy.html" target="_blank" rel="noopener">den Google-Datenschutzhinweisen</a> entnehmen. Dort können Sie im Datenschutzcenter auch Ihre persönlichen Datenschutz-Einstellungen verändern.</p>
<p>Ausführliche Anleitungen zur Verwaltung der eigenen Daten im Zusammenhang mit Google-Produkten<a href="http://www.dataliberation.org/" target="_blank" rel="noopener"> finden Sie hier</a>.</p>
<h3>Eingebettete YouTube-Videos</h3>
<p>Auf einigen unserer Webseiten betten wir Youtube-Videos ein. Betreiber der entsprechenden Plugins ist die YouTube, LLC, 901 Cherry Ave., San Bruno, CA 94066, USA. Wenn Sie eine Seite mit dem YouTube-Plugin besuchen, wird eine Verbindung zu Servern von Youtube hergestellt. Dabei wird Youtube mitgeteilt, welche Seiten Sie besuchen. Wenn Sie in Ihrem Youtube-Account eingeloggt sind, kann Youtube Ihr Surfverhalten Ihnen persönlich zuzuordnen. Dies verhindern Sie, indem Sie sich vorher aus Ihrem Youtube-Account ausloggen.</p>
<p>Wird ein Youtube-Video gestartet, setzt der Anbieter Cookies ein, die Hinweise über das Nutzerverhalten sammeln.</p>
<p>Wer das Speichern von Cookies für das Google-Ad-Programm deaktiviert hat, wird auch beim Anschauen von Youtube-Videos mit keinen solchen Cookies rechnen müssen. Youtube legt aber auch in anderen Cookies nicht-personenbezogene Nutzungsinformationen ab. Möchten Sie dies verhindern, so müssen Sie das Speichern von Cookies im Browser blockieren.</p>
<p>Weitere Informationen zum Datenschutz bei „Youtube“ finden Sie in der Datenschutzerklärung des Anbieters unter: <a href="https://www.google.de/intl/de/policies/privacy/" target="_blank" rel="noopener">https://www.google.de/intl/de/policies/privacy/ </a></p>
<h3><strong>Änderung unserer Datenschutzbestimmungen</strong></h3>
<p>Wir behalten uns vor, diese Datenschutzerklärung anzupassen, damit sie stets den aktuellen rechtlichen Anforderungen entspricht oder um Änderungen unserer Leistungen in der Datenschutzerklärung umzusetzen, z.B. bei der Einführung neuer Services. Für Ihren erneuten Besuch gilt dann die neue Datenschutzerklärung.</p>
<h3><strong>Fragen an den Datenschutzbeauftragten</strong></h3>
<p>Wenn Sie Fragen zum Datenschutz haben, schreiben Sie uns bitte eine E-Mail oder wenden Sie sich direkt an die für den Datenschutz verantwortliche Person in unserer Organisation:</p>
<p><em>Die Datenschutzerklärung wurde mit dem </em><a href="https://www.activemind.de/datenschutz/datenschutzhinweis-generator/" target="_blank" rel="noopener"><em>Datenschutzerklärungs-Generator der activeMind AG erstellt</em></a><em>.</em></p>
		</div></div>
<?php //endif; ?>
<footer></footer></article>
<div class="back-to-top">
    <div class="elevator">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" height="100px" width="100px">
            <path d="M70,47.5H30c-1.4,0-2.5,1.1-2.5,2.5v40c0,1.4,1.1,2.5,2.5,2.5h40c1.4,0,2.5-1.1,2.5-2.5V50C72.5,48.6,71.4,47.5,70,47.5z   M47.5,87.5h-5v-25h5V87.5z M57.5,87.5h-5v-25h5V87.5z M67.5,87.5h-5V60c0-1.4-1.1-2.5-2.5-2.5H40c-1.4,0-2.5,1.1-2.5,2.5v27.5h-5  v-35h35V87.5z"/>
            <path d="M50,42.5c1.4,0,2.5-1.1,2.5-2.5V16l5.7,5.7c0.5,0.5,1.1,0.7,1.8,0.7s1.3-0.2,1.8-0.7c1-1,1-2.6,0-3.5l-10-10  c-1-1-2.6-1-3.5,0l-10,10c-1,1-1,2.6,0,3.5c1,1,2.6,1,3.5,0l5.7-5.7v24C47.5,41.4,48.6,42.5,50,42.5z"/>
        </svg>
        Nach oben
    </div>
</div>
<?php get_footer(); ?>
