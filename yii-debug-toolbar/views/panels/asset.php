<table>
    <thead>
        <tr>
            <th class="al-r"><?=YiiDebug::t('Properties')?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr class="even">
            <th><?=YiiDebug::t('Assets path')?></th>
            <td><?=$AM->getBasePath()?></td>
        </tr><tr class="odd">
            <th><?=YiiDebug::t('Exclude files')?></th>
            <td><?=implode(',', $AM->excludeFiles)?></td>
        </tr><tr class="even">
            <th><?=YiiDebug::t('New dir mode')?></th>
            <td><?=$AM->newDirMode?></td>
        </tr><tr class="odd">
            <th><?=YiiDebug::t('New file mode')?></th>
            <td><?=$AM->newFileMode?></td>
        </tr>
    </tbody>
</table>
<table>
    <thead>
        <tr>
            <th class="al-r"><?=YiiDebug::t('Load assets')?></th>
            <th class="al-l"><?=YiiDebug::t('Path')?></th>
            <th><?=YiiDebug::t('Files')?></th>
            <th><?=YiiDebug::t('Date create')?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?
        
        $DF = new CDateFormatter(Yii::app()->sourceLanguage);
        $i=0;
        foreach($assets as $asset){
            $i++;

            $path = $AM->getBasePath().'/'.$asset;
            $files = CFileHelper::findFiles($path);
            $fileList = implode('<br />', $files);

			$blockAll = false;
			if(preg_match('|yii\.debug\.toolbar\.js|is', $fileList)) $blockAll = true;

            ?>
        <tr class="<?=$i%2?'even':'odd'?>">
            <th><?=$asset?></th>
            <td>
                <a title="<?=YiiDebug::t('Show files')?>" href="#"
				   onclick="jQuery('.details', $(this).parent('td')).toggleClass('hidden'); return false;"><?=$path?></a>
                <div class='details hidden'>
                    <?=$fileList?>
                </div>
            </td>
            <td class="al-c"><?=YiiDebug::t('{n} file|{n} files', array(count($files)))?></td>
            <td class="al-c"><?=$DF->formatDateTime(filemtime($path))?></td>
            <td class="al-c">
                <a class="deleteAsset" href="<?=$this->owner->assetsUrl?>/ajax.php?deleteasset=<?=$asset?>"
						onclick="deleteAsset(this, <?=$blockAll?'true':'false'?>); return false;">
										<?=YiiDebug::t('Clean')?></a>
            </td>
        </tr>
        <?}?>
    </tbody>
</table>

<script type="text/javascript">
	function deleteAsset(link, blockAll){
		$.getJSON(link.href, {}, function(data){
			if(data == 'ok'){
				$(link).parents('tr').remove();
				if(blockAll){
					$('a.deleteAsset').remove();
				}
			}
			if(data == 'notexists'){
				alert('<?=YiiDebug::t('Path not found.')?>');
			}
			if(data == 'unknow'){
				alert('<?=YiiDebug::t('Unknow error.')?>');
			}
		});
	}
</script>