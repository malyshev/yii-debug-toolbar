<table>
    <thead>
        <tr>
            <th class="al-r">Properties</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr class="odd">
            <th>Assets path</th>
            <td><?=$AM->getBasePath()?></td>
        </tr><tr class="even">
            <th>Exclude files</th>
            <td><?=implode(',', $AM->excludeFiles)?></td>
        </tr><tr class="odd">
            <th>New dir mode</th>
            <td><?=$AM->newDirMode?></td>
        </tr><tr class="even">
            <th>New file mode</th>
            <td><?=$AM->newFileMode?></td>
        </tr>
    </tbody>
</table>
<table>
    <thead>
        <tr>
            <th class="al-r">Load assets</th>
            <th class="al-l">Path</th>
            <th>Files</th>
            <th>Date create</th>
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
        <tr class="<?=$i%2?'odd':'even'?>">
            <th><?=$asset?></th>
            <td>
                <a title="Show files" href="#" onclick="jQuery('.details', $(this).parent('td')).toggleClass('hidden'); return false;"><?=$path?></a>
                <div class='details hidden' style="padding-left: 1em;">
                    <?=$fileList?>
                </div>
            </td>
            <td class="al-c"><?=Yii::t('app', '{n} file|{n} files', array(count($files)))?></td>
            <td class="al-c"><?=$DF->formatDateTime(filemtime($path))?></td>
            <td class="al-c">
                <a class="deleteAsset" href="<?=$this->owner->assetsUrl?>/ajax.php?deleteasset=<?=$asset?>"
						onclick="deleteAsset(this, <?=$blockAll?'true':'false'?>); return false;">Delete</a>
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
				alert('Папка не найдена.');
			}
			if(data == 'unknow'){
				alert('Неизвестная ошибка.');
			}
		});
	}
</script>