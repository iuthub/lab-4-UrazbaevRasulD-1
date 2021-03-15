<?php
$isEmptyList = isset($_REQUEST["playlist"]);


if (isset($_REQUEST["shuffle"])) {
    $isShuffleOn = $_REQUEST["shuffle"] == "on";
} else {
    $isShuffleOn = false;
}

if (isset($_REQUEST["bysize"])) {
    $orderBySize = $_REQUEST["bysize"] == "on";
} else {
    $orderBySize= false;
}

$playlist = glob("songs/*.mp3");

if (!$isEmptyList) {
    $playlist = glob("songs/*.mp3");

    if ($isShuffleOn) {
        shuffle($playlist);
    }
    foreach ($playlist as $music) {
        ?>
        <li class="mp3item">
            <a href="<?= $music ?>">
                <?= basename($music); ?>
            </a>(<?= filesize($music) ?> b)
        </li>
    <?php } ?>
    <?php
    foreach (glob("songs/*.txt") as $lists) {
        ?>
        <li class="playlistitem">
            <a href="index.php?playlist=<?= basename($lists) ?>"><?= basename($lists) ?></a>
        </li>
    <?php }
} else {
    $file = fopen("songs/" . $_REQUEST["playlist"], "r+");
    $playlist = array();
    ?>
    <li id="return">
        <a href="index.php">Go Back</a>
    </li>
    <?php
    while (!feof($file)) {
        $music = fgets($file);
        array_push($playlist, $music);
    }
    if ($isShuffleOn) {
        shuffle($playlist);
    }
    foreach ($playlist as $music) {
        ?>
        <li class="mp3item">
            <a href="songs/<?= $music ?>"><?= $music; ?>
            </a>
        </li>
        <?php
    }
} ?>
