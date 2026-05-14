<?php
$pageTitle = "Home - Radiohead Archive";
include 'includes/header.php';
?>

<main id="index-page">
    <section>
        <h2>Welcome to the Radiohead Archive</h2>
        <p>
            A fan-made website dedicated to the history,
            music, and vinyl collection of Radiohead.
        </p>
    </section>
    <section>
        <h2>Featured Albums</h2>
        <div id="featured-albums">
            <div class="featured-album">
                <img src="assets/images/okcomputer.png" alt="An image of the Radiohead album - Ok Computer">
                <p>OK Computer (1997)</p>
            </div>
            <div class="featured-album">
                <img src="assets/images/thebends.png" alt="An image of the Radiohead album - The Bends">
                <p>The Bends (1995)</p>
            </div>
            <div class="featured-album">
                <img src="assets/images/kida.png" alt="An image of the Radiohead album - Kid A">
                <p>Kid A (2000)</p>
            </div>
        </div>
        
    </section>
    <section id="featured-video-section">
        <h2>Featured Fan Video</h2>
        <div id="featured-video">
            <iframe width="560" height="315"
            src="https://www.youtube.com/embed/nZq_jeYsbTs"
            allowfullscreen>
            </iframe>
            <div id="featured-video-info">
                <h2>How to Disappear Completely</h2>
                <p>
                    “How to Disappear Completely” is a track by Radiohead from their 2000 album Kid A, and it's often
                    considered one of their most emotionally powerful songs. It explores themes of anxiety, detachment, and the
                    desire to escape overwhelming reality. The lyrics are widely linked to Thom Yorke's experiences during the
                    band's late-90s touring period, where he reportedly felt intense stress and disconnection from his surroundings,
                    repeating the phrase “I'm not here, this isn't happening” as a coping mechanism.
                    <br><br>
                    Musically, the song relies heavily on atmospheric orchestration rather than traditional rock structure.
                    Jonny Greenwood's string arrangements create a drifting, dreamlike soundscape that reinforces the feeling
                    of fading away. Instead of building toward a typical climax, the track maintains a slow, floating tension,
                    making it feel more like an emotional state than a conventional song.
                </p>
            </div>
        </div>
    </section>
</main>

<?php
include 'includes/footer.php';
?>