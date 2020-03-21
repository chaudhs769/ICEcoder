<?php
include("lib/headers.php");
include("lib/settings.php");
$t = $text['files'];
?>
<!DOCTYPE html>

<html onMouseDown="parent.ICEcoder.mouseDown=true; parent.ICEcoder.resetAutoLogoutTimer(); parent.ICEcoder.boxSelect(event,'down')" onMouseUp="parent.ICEcoder.mouseDown=false; parent.ICEcoder.resetAutoLogoutTimer(); parent.ICEcoder.mouseDownInCM=false; parent.ICEcoder.boxSelect(event,'up'); if (!parent.ICEcoder.overCloseLink) {parent.ICEcoder.tabDragEnd()}" onMouseMove="if(parent.ICEcoder) {parent.ICEcoder.getMouseXY(event,'files'); parent.ICEcoder.resetAutoLogoutTimer(); parent.ICEcoder.canResizeFilesW(); parent.ICEcoder.boxSelect(event,'drag')}" onDrop="if(parent.ICEcoder) {parent.ICEcoder.getMouseXY(event,'files')}" onContextMenu="parent.ICEcoder.selectFileFolder(event); return parent.ICEcoder.showMenu(event)" onClick="if (!parent.ICEcoder.fmDraggedBox) {parent.ICEcoder.selectFileFolder(event)} else {parent.ICEcoder.fmDraggedBox = false}" onDragStart="parent.ICEcoder.selectFileFolder(event);" onDragOver="event.preventDefault();event.stopPropagation()">
<head>
    <title>ICEcoder v <?php echo $ICEcoder["versionNo"];?> file manager</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" type="text/css" href="assets/css/files.css?microtime=<?php echo microtime(true);?>">
    <link rel="stylesheet" type="text/css" href="assets/css/file-types.css?microtime=<?php echo microtime(true);?>">
    <link rel="stylesheet" type="text/css" href="assets/css/file-type-icons.css?microtime=<?php echo microtime(true);?>">
    <!--Updated via settings so must remain 4th stylesheet//-->
    <style>
        ul.fileManager li a span { font-size:  <?php echo $ICEcoder["fontSize"];?>; }
    </style>
</head>

<body onFocus="parent.ICEcoder.files.style.background='#444'" onBlur="parent.ICEcoder.files.style.background='#383838'" onDblClick="parent.ICEcoder.openFile()" onKeyDown="return parent.ICEcoder.interceptKeys('files', event);" onKeyUp="parent.ICEcoder.resetKeys(event);" onBlur="parent.ICEcoder.resetKeys(event);">

<div title="<?php echo $t['Lock'];?>" onClick="parent.ICEcoder.lockUnlockNav()" id="fmLock" class="lock"></div>
<div title="<?php echo $t['Refresh'];?>" onClick="parent.ICEcoder.refreshFileManager()" class="refresh"></div>
<div title="<?php echo $t['Plugins'];?>" onClick="parent.ICEcoder.showHidePlugins(parent.get('plugins').style.width != '55px' ? 'show' : 'hide')" class="plugins"></div>

<ul class="fileManager">
    <li class="pft-directory dirOpen"><a nohref title="/" onMouseOver="parent.ICEcoder.overFileFolder('folder','/')" onMouseOut="parent.ICEcoder.overFileFolder('folder','')" onClick="parent.ICEcoder.openCloseDir(this)" style="position: relative; left:-22px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span id="|">/ <?php
                echo $iceRoot == "" ? $t['ROOT'] : trim($iceRoot,"/");
                $thisPermVal = $serverType=="Linux" ? substr(sprintf('%o', fileperms($docRoot.$iceRoot)), -3) : "";
                $permColors = $thisPermVal == 777 ? 'background: #800; color: #eee' : 'color: #888';
                ?></span> <span style="<?php echo $permColors;?>; font-size: 8px" id="|_perms"><?php echo $thisPermVal;;?></span></a></li><?php
    // tree file items generated by the iFrame 'fileControl' below which loads in the items at location=| (ie, the root)
    ?>
</ul>

<iframe name="fileControl" src="lib/get-branch.php?location=|&csrf=<?php echo $_SESSION['csrf'];?>" style="display: none"></iframe>

<iframe name="processControl" style="display: none"></iframe>

<iframe name="pingActive" style="display: none"></iframe>

<div class="fmDragBox" id="fmDragBox"></div>

</body>

</html>