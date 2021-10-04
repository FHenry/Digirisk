<?php
/* Copyright (C) 2021 EOXIA <dev@eoxia.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */


// Protection to avoid direct call of template
if (empty($conf) || !is_object($conf))
{
	print "Error, template page digiriskdolibarr_photo_view.tpl.tpl.php can't be called as URL";
	exit;
}

?>

<!-- BEGIN PHP TEMPLATE core/tpl/digiriskdolibarr_photo_view.tpl.php -->

<?php $permtoupload = $user->rights->ecm->upload; ?>

<div class="risk-evaluation-photo" value="<?php echo $risk->id ?>">
	<span class="title"><?php echo $langs->trans('Photo'); ?></span>
	<div class="risk-evaluation-photo-container wpeo-modal-event tooltip hover">
		<?php
		$entity = ($conf->entity > 1) ? '/' . $conf->entity  : '';

		$relativepath = 'digiriskdolibarr/medias/thumbs/';
		$modulepart = $entity . 'ecm';
		$path = DOL_URL_ROOT.'/document.php?modulepart=' . $modulepart  . '&attachment=0&file=' . str_replace('/', '%2F', $relativepath) . '/';
		$nophoto = '/public/theme/common/nophoto.png'; ?>
		<!-- BUTTON RISK EVALUATION PHOTO MODAL -->
		<div class="action risk-evaluation-photo default-photo modal-open risk-evaluation-photo-<?php echo $cotation->id ?>" value="<?php echo $cotation->id ?>">
			<?php if (isset($cotation->photo)) {
				$filearray = dol_dir_list($conf->digiriskdolibarr->multidir_output[$conf->entity].'/'.$cotation->element.'/'.$cotation->ref, "files", 0, '', '(\.odt|_preview.*\.png)$', 'position_name', 'asc', 1);
				if (count($filearray)) {
					?>
					<span class="floatleft inline-block valignmiddle divphotoref risk-evaluation-photo-single">
						<input type="hidden" value="<?php echo $path ?>">
						<input class="filename" type="hidden" value="">
						 <?php print digirisk_show_photos('digiriskdolibarr', $conf->digiriskdolibarr->multidir_output[$conf->entity].'/'.$cotation->element, 'small', 1, 0, 0, 0, 40, 0, 1, 0, 0, $cotation->element, $cotation); ?>
					</span>
					<?php
				} else {
					$nophoto = '/public/theme/common/nophoto.png'; ?>
					<span class="floatleft inline-block valignmiddle divphotoref risk-evaluation-photo-single">
						<input type="hidden" value="<?php echo $path ?>">
						<input class="filename" type="hidden" value="">
						<img class="photodigiriskdolibarr" alt="No photo" src="<?php echo DOL_URL_ROOT.$nophoto ?>">
					</span>
				<?php }
			} else { ?>
			<span class="floatleft inline-block valignmiddle divphotoref risk-evaluation-photo-single">
				<input type="hidden" value="<?php echo $path ?>">
				<input class="filename" type="hidden" value="">
				<img class="photo maxwidth50"  src="<?php echo DOL_URL_ROOT.$nophoto ?>">
			</span>
			<?php } ?>
		</div>
	</div>
</div>

<!-- END PHP TEMPLATE core/tpl/digiriskdolibarr_photo_view.tpl.php -->
