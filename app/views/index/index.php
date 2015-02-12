<?php
/** @var VideoConferencePlugin $plugin */
/** @var ElanEv\Model\CourseConfig $courseConfig */
/** @var Flexi_TemplateFactory $templateFactory */
/** @var bool $configured */
/** @var bool $confirmDeleteMeeting */
/** @var string[] $questionOptions */
/** @var bool $canModifyCourse */
/** @var ElanEv\Model\Meeting[] $meetings */
/** @var ElanEv\Model\Meeting[] $userMeetings */
/** @var array $errors */
?>

<?php if (!$configured): ?>
    <?= MessageBox::info(_('Es wurden noch keine Meetings eingerichtet.')) ?>

    <? if ($GLOBALS['perm']->have_perm('root')) : ?>
        <form method="post" action="<?= PluginEngine::getLink($plugin, array(), 'index/saveConfig') ?>">
            URL des BBB-Servers:<br>
            <input type="text" name="bbb_url" size="50"><br><br>

            Api-Key (Salt):<br>
            <input type="text" name="bbb_salt" size="50"><br>

            <?= Studip\Button::createAccept(_('Konfiguration speichern')) ?>
        </form>
    <?php endif; ?>
<?php else: ?>
    <?php if ($confirmDeleteMeeting): ?>
        <?= $templateFactory->render('shared/question', $questionOptions) ?>
    <? endif ?>

    <?php if ($courseConfig->introduction): ?>
        <div class="vc_introduction"><?= formatReady($courseConfig->introduction) ?></div>
    <?php endif ?>

    <div>
        <table class="default collapsable tablesorter conference-meetings">
            <caption><?=$courseConfig->title?></caption>
            <colgroup>
                <col>
                <col style="width: 100px;">
                <col style="width: 80px;">
            </colgroup>
            <thead>
            <tr>
                <th>Meeting</th>
                <?php if ($canModifyCourse): ?>
                    <th><?= _('Freigeben') ?></th>
                    <th><?=_('Aktion')?></th>
                <?php endif; ?>
            </tr>
            </thead>

            <tbody>
                <?php foreach ($meetings as $meeting): ?>
                    <?php
                    $joinUrl = PluginEngine::getLink($plugin, array(), 'index/joinMeeting/'.$meeting->id);
                    $moderatorPermissionsUrl = PluginEngine::getLink($plugin, array(), 'index/moderator_permissions/'.$meeting->id);
                    $deleteUrl = PluginEngine::getLink($plugin, array('delete' => $meeting->id), 'index');
                    ?>
                    <tr>
                        <td class="meeting-name">
                            <a href="<?=$joinUrl?>" title="<?=_('Meeting betreten')?>" target="_blank"><?=htmlReady($meeting->name)?></a>
                            <input type="text" name="name">
                            <img src="<?=$GLOBALS['ASSETS_URL']?>/images/icons/20/grey/accept.png" class="accept-button" title="<?=_('�nderungen speichern')?>">
                            <img src="<?=$GLOBALS['ASSETS_URL']?>/images/icons/20/grey/decline.png" class="decline-button" title="<?=_('�nderungen verwerfen')?>">
                            <img src="<?=$GLOBALS['ASSETS_URL']?>/images/ajax_indicator_small.gif" class="loading-indicator">

                            <?php if ($canModifyCourse): ?>
                                <ul class="info">
                                    <li><?= _('Meeting wird in ').count($meeting->courses)._(' Veranstaltung/en verwendet.') ?></li>

                                    <?php if ($meeting->join_as_moderator): ?>
                                        <li><?=_('Teilnehmende haben VeranstalterInnen-Rechte (wie Anlegende/r).')?></li>
                                    <?php else: ?>
                                        <li><?=_('Teilnehmende haben eingeschr�nkte Teilnehmenden-Rechte.')?></li>
                                    <?php endif; ?>

                                    <?php if (count($meeting->getRecentJoins()) === 1): ?>
                                        <li><?=_('Eine Person hat das Meeting in den letzten 24 Stunden betreten')?>.</li>
                                    <?php else: ?>
                                        <li><?=count($meeting->getRecentJoins()).' '._('Personen haben das Meeting in den letzten 24 Stunden betreten')?>.</li>
                                    <?php endif; ?>

                                    <?php if (count($meeting->getAllJoins()) === 1): ?>
                                        <li><?=_('Eine Person hat das Meeting insgesamt betreten')?>.</li>
                                    <?php else: ?>
                                        <li><?=count($meeting->getAllJoins()).' '._('Personen haben das Meeting insgesamt betreten')?>.</li>
                                    <?php endif; ?>
                                </ul>
                            <?php endif ?>
                        </td>
                        <?php if ($canModifyCourse): ?>
                            <td><input type="checkbox"<?=$meeting->active ? ' checked="checked"' : ''?> data-meeting-enable-url="<?=PluginEngine::getLink($plugin, array(), 'index/enable/'.$meeting->id)?>" title="<?=$meeting->active ? _('Meeting f�r Studierende unsichtbar schalten') : _('Meeting f�r Studierende sichtbar schalten')?>"></td>
                            <td>
                                <a href="#" title="<?=_('Meeting umbenennen')?>" class="edit-meeting" data-meeting-rename-url="<?=PluginEngine::getLink($plugin, array(), 'index/rename/'.$meeting->id)?>"><img src="<?=$GLOBALS['ASSETS_URL']?>/images/icons/20/blue/edit.png"></a>
                                <?php if ($meeting->join_as_moderator): ?>
                                    <a href="<?=$moderatorPermissionsUrl?>" title="<?=_('Teilnehmende erhalten eingeschr�nkte Teilnehmenden-Rechte (Standard)')?>"><img src="<?=$plugin->getAssetsUrl()?>/images/moderator-enabled.png"></a>
                                <?php else: ?>
                                    <a href="<?=$moderatorPermissionsUrl?>" title="<?=_('Teilnehmende erhalten VeranstalterInnen-Rechte (wie Anlegende/r)')?>"><img src="<?=$plugin->getAssetsUrl()?>/images/moderator-disabled.png"></a>
                                <?php endif; ?>
                                <a href="<?=$deleteUrl?>" title="<?=_('Meeting l�schen')?>"><img src="<?=$GLOBALS['ASSETS_URL']?>/images/icons/20/blue/trash.png"></a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>

            <?php if ($canModifyCourse): ?>
                <tfoot>
                    <tr>
                        <td colspan="<?=$canModifyCourse ? 3 : 2?>">
                            <form method="post" action="<?=PluginEngine::getURL($GLOBALS['plugin'], array(), 'index')?>" class="create-conference-meeting">
                                <input type="hidden" name="action" value="create">
                                <fieldset name="Meeting erstellen">
                                    <?php if (count($errors) > 0): ?>
                                        <ul>
                                            <?php foreach ($errors as $error): ?>
                                                <li><?php echo htmlReady($error); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                    <input type="text" name="name" placeholder="">
                                    <input type="submit" value="<?= _('Meeting erstellen') ?>">
                                </fieldset>
                            </form>

                            <p><?= _('oder') ?></p>

                            <form method="post" action="<?=PluginEngine::getURL($GLOBALS['plugin'], array(), 'index')?>" class="create-conference-meeting">
                                <input type="hidden" name="action" value="link">
                                <fieldset name="Meeting erstellen">
                                    <select name="meeting_id" size="1">
                                        <option><?= _('zu verlinkendes Meeting ausw�hlen') ?></option>
                                        <?php foreach ($userMeetings as $meeting): ?>
                                            <option value="<?= $meeting->id ?>"><?= htmlReady($meeting->name) ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <input type="submit" value="<?= _('Meeting verlinken') ?>">
                                </fieldset>
                            </form>
                        </td>
                    </tr>
                </tfoot>
            <?php endif; ?>
        </table>
    </div>
<? endif ?>
