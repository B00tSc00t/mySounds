<?php include("includes/includedFiles.php");


// Get album id from url

if(isset($_GET['id'])) {
    $albumId = $_GET['id'];
} else {
    header("Location: index.php");
}

$album = new Album($conn, $albumId);

$artist = $album->getArtist();;

?>

<div class="entityInfo">

    <div class="leftSection">
        <img src="<?= $album->getArtworkPath(); ?>">
    </div>

    <div class="rightSection">
        <h2><?= $album->getTitle(); ?></h2>
        <p>By <?= $artist->getName(); ?></p>
        <p><?php echo $album->getNumberOfSongs();
            if($album->getNumberOfSongs() > 1) {
                echo " songs";
            } else {
                echo " song";
            }
            ?>
        </p>
        
    </div>
</div>

<div class="trackListContainer">

    <ul class="trackList">
        
        <?php
            $songIdArray = $album->getSongId();

            $i = 1;

            foreach($songIdArray as $songId) {

                $albumSong = new Song($conn, $songId);

                $albumArtist = $albumSong->getArtist();

                echo "<li class='trackListRow'>
                        <div class='trackCount'>
                            <img class='play' src='assets/images/icons/play_white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
                            <span class='trackNumber'>$i</span>
                        </div>

                        <div class='trackInfo'>
                            <span class='trackName'>" . $albumSong->getTitle() . "</span>
                            <span class='artistName'>" . $albumArtist->getName() . "</span>
                        </div>

                        <div class='trackOptions'>
                            <input type='hidden' class='songId' value='" . $albumSong->getId() . "'>
                            <img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
                        </div>

                        <div class='trackDuration'>
                            <span class='duration'>" . $albumSong->getDuration() . "</span>
                        </div>

                    </li>";

                $i++;

            }
        ?>

        <script>
            var tempSongIds = '<?= json_encode($songIdArray) ; ?>';
            tempPlaylist = JSON.parse(tempSongIds);
        </script>
        
    </ul>
</div>

<nav class="optionsMenu">
    <input type="hidden" class="songId">
    <?= Playlist::getPlaylistsDropdown($conn, $userLoggedIn->getUsername()); ?>
</nav>