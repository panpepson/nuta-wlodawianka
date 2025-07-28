<?php
function getMusicFiles($dir = './nuta/') {
    $files = array();
    if (is_dir($dir)) {
        foreach (glob($dir . "*.mp3") as $file) {
            $files[] = basename($file);
        }
    }
    return $files;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Włodawianka Włodawa - Fanatyczna Kolekcja Muzyczna Kibiców ❤️💙</title>
    <meta name="description" content="Oficjalna kolekcja muzyczna kibiców LKS Włodawianka Włodawa. Słuchaj piosenek kibicowskich, pieśni meczowych i utworów wspierających drużynę z Włodawy. ❤️💙">
    <meta name="keywords" content="LKS Włodawianka, Włodawa, kibice, muzyka kibicowska, pieśni meczowe, piłka nożna, Lublin, doping">
    <meta name="author" content="LKS Włodawianka Włodawa - Pepson ^p^ ">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="LKS Włodawianka Włodawa - Fanatyczna Kolekcja Muzyczna Kibiców ❤️💙">
    <meta property="og:description" content="Oficjalna kolekcja muzycznej kibiców LKS Włodawianka Włodawa. Słuchaj piosenek kibicowskich i pieśni meczowych wspierających naszą drużynę!">
    <meta property="og:image" content="https://nuta.wlodawa.net/cover.jpg">
    <meta property="og:url" content="https://nuta.wlodawa.net">
    <meta property="og:site_name" content="LKS Włodawianka - Muzyka Kibiców">
    <meta property="og:locale" content="pl_PL">
    
    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="LKS Włodawianka Włodawa - Fanatyczna Kolekcja Muzyczna Kibiców">
    <meta name="twitter:description" content="Słuchaj oficjalnej kolekcji muzycznej kibiców LKS Włodawianka Włodawa">
    <meta name="twitter:image" content="https://nuta.wlodawa.net/cover.jpg">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://nuta.wlodawa.net/">
    <link rel="shortcut icon" href="./fav-lks.png" type="image/x-icon">

	<script src="https://cdn.jsdelivr.net/npm/gun/gun.js"></script>
	<script src="vot.js"></script>
    
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-051XD13E5Y"></script>
<script>
  window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-051XD13E5Y');
</script>

    <!-- Schema.org Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "Organization",
                "@id": "https://nuta.wlodawa.net/#organization",
                "name": "LKS Włodawianka Włodawa",
                "alternateName": "Włodawianka",
                "url": "https://nuta.wlodawa.net",
                "logo": {
                    "@type": "ImageObject",
                    "url": "https://nuta.wlodawa.net/LKS-Herb-pepson-2x2.png",
                    "width": 60,
                    "height": 60
                },
                "sameAs": [
                    "https://wlodawa.net/tag/wlodawianka"
                ],
                "description": "Oficjalny klub piłkarski LKS Włodawianka z Włodawy"
            },
            {
                "@type": "WebSite",
                "@id": "https://nuta.wlodawa.net/#website",
                "url": "https://nuta.wlodawa.net",
                "name": "LKS Włodawianka - Muzyka Kibiców",
                "description": "Fanatyczna kolekcja muzyczna kibiców LKS Włodawianka Włodawa",
                "publisher": {
                    "@id": "https://nuta.wlodawa.net/#organization"
                },
                "inLanguage": "pl-PL"
            },
            {
                "@type": "MusicPlaylist",
                "@id": "https://nuta.wlodawa.net/#playlist",
                "name": "Fanatyczna kolekcja muzyczna kibiców LKS Włodawianka",
                "description": "Kolekcja pieśni i utworów kibicowskich wspierających LKS Włodawianka Włodawa",
                "genre": "Muzyka kibicowska",
                "publisher": {
                    "@id": "https://nuta.wlodawa.net/#organization"
                },
                "track": [
                    <?php
                    $musicFiles = getMusicFiles();
                    $trackSchemas = [];
                    if (!empty($musicFiles)) {
                        foreach ($musicFiles as $index => $file) {
                            $fileInfo = pathinfo($file);
                            $baseName = $fileInfo['filename'];
                            $trackSchemas[] = '{
                                "@type": "MusicRecording",
                                "name": "' . addslashes($baseName) . '",
                                "url": "https://nuta.wlodawa.net/nuta/' . addslashes($file) . '",
                                "encodingFormat": "audio/mpeg",
                                "genre": "Muzyka kibicowska",
                                "byArtist": {
                                    "@type": "MusicGroup",
                                    "name": "Kibice LKS Włodawianka"
                                },
                                "inPlaylist": {
                                    "@id": "https://nuta.wlodawa.net/#playlist"
                                }
                            }';
                        }
                        echo implode(',', $trackSchemas);
                    }
                    ?>
                ]
            }
        ]
    }
    </script>
    
    <style>
        body {
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                        url('cover.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            color: #fff;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }
        
        .music-item {
            margin: 20px 0;
            padding: 15px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            position: relative;
        }
        
        .music-item h3 {
            margin: 0 0 10px 0;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: color 0.3s ease;
        }
        
        .filename {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .filename-base {
            color: #fff;
            transition: color 0.3s ease;
        }
        
        .filename-extension {
            color: #fff;
            transition: color 0.3s ease;
        }
        
        .music-item.playing .filename-base {
            color: #fff !important;
        }
        
        .music-item.playing .filename-extension {
            color: #0066ff !important;
        }
        
        .speaker-icon {
            display: none;
            font-size: 20px;
            animation: pulse 1.5s infinite;
        }
        
        .music-item.playing .speaker-icon {
            display: inline-block;
        }
        
        .hearts {
            display: none;
            gap: 5px;
            align-items: center;
        }
        
        .music-item.playing .hearts {
            display: flex;
        }
        
        .heart-red {
            color: #ff0000;
            font-size: 18px;
            animation: pulse 1.2s infinite;
        }
        
        .heart-blue {
            color: #0066ff;
            font-size: 18px;
            animation: pulse 1.2s infinite 0.6s;
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.7;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        audio {
            width: 100%;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 5px;
        }
        
        .controls {
            margin: 20px 0;
            text-align: center;
        }
        
        .control-btn {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s ease;
        }
        
        .control-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }
        
        .control-btn.active {
            background: rgba(255, 0, 0, 0.7);
        }
        
        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }
            
            .music-item {
                margin: 10px 0;
            }
            
            .control-btn {
                padding: 8px 15px;
                font-size: 12px;
            }
        }
        
        #cooki{
            padding:20px;
            border:1px solid #ccc;
            background-color:#3333ff;
            border-radius:5px;
            text-align:center;
        }
        
        .btn{
            font-size:16px;
            padding:10px 20px;
            margin:5px;
            border:none;
            border-radius:5px;
            cursor:pointer;
        }
        
        .btn-primary{
            background-color:#007bff;
            color:white;
        }
        
        .btn-danger{
            background-color:#dc3545;
            color:white;
        }
        
        #shuffleBtn {
            display: none;
            }
        .play-all-active #shuffleBtn {
            display: inline-block;
            }
.votes {
    position: absolute;
    bottom: -12px;
    right: 10px;
    display: flex;
    gap: 5px;
    align-items: center;
    padding: 4px 6px;
    border-radius: 4px;
}
.votes button {
    background: none;
    border: none;
    color: white;
    font-size: 18px;
    cursor: pointer;
}
.vote-score {
    color: #fff;
    font-weight: bold;
}

</style>
</head>
<body>
<span id="cooki" style="display: none;"></span>
<div class="container">
<center>
<h2>Fanatyczna kolekcja muzyczna kibiców</h2>
<center><a href="https://wlodawa.net/tag/wlodawianka" target="_blank"><img src="./LKS-Herb-pepson-2x2.png" width="60" height="60" alt="Herb Klubu Włodawiank"></a>
<h1> ❤️💙 <span style="color: red;">Włodawianka</span> <span style="color: blue;">Włodawa</span> ❤️💙 </h1></center>
<div class="controls">
    <button id="playAllBtn" class="control-btn">⏭️ Odtwarzaj wszystkie po kolei</button>
    <button id="stopAllBtn" class="control-btn">⏹️ Zatrzymaj odtwarzanie</button>
    <button id="shuffleBtn" class="control-btn">🔀 Losowa kolejność</button>
</div>
        <?php
        $musicFiles = getMusicFiles();
        if (!empty($musicFiles)) {
            $index = 0;
            foreach ($musicFiles as $file) {
                // Rozdziel nazwę pliku i rozszerzenie
                $fileInfo = pathinfo($file);
                $baseName = $fileInfo['filename'];
                $extension = isset($fileInfo['extension']) ? '.' . $fileInfo['extension'] : '';
                echo '<article class="music-item" data-index="' . $index . '" itemscope itemtype="https://schema.org/MusicRecording">';
                echo '<h3 itemprop="name">';
                echo '<span class="speaker-icon" aria-label="Obecnie odtwarzane">🔊</span>';
                echo '<div class="filename">';
                echo '<span class="filename-base">' . htmlspecialchars($baseName) . '</span>';
                echo '<span class="filename-extension">' . htmlspecialchars($extension) . '</span>';
                echo '</div>';
                echo '<div class="hearts" aria-hidden="true">';
                echo '<span class="heart-red">❤️</span>';
                echo '<span class="heart-blue">💙</span>';
                echo '</div>';
                echo '</h3>';
                echo '<audio controls data-index="' . $index . '" itemprop="audio" preload="metadata">';
                echo '<source src="/nuta/' . htmlspecialchars($file) . '" type="audio/mpeg" itemprop="contentUrl">';
                echo 'Twoja przeglądarka nie obsługuje elementu audio.';
                echo '</audio>';
                echo '<meta itemprop="encodingFormat" content="audio/mpeg">';
                echo '<meta itemprop="genre" content="Muzyka kibicowska">';
                echo '<div itemprop="byArtist" itemscope itemtype="https://schema.org/MusicGroup">';
                echo '<meta itemprop="name" content="Kibice LKS Włodawianka">';
?>
<div class="votes" data-track="<?= htmlspecialchars($baseName) ?>">
  <button class="vote-up">👍</button>
  <span class="vote-score">0</span>
  <button class="vote-down">👎</button>
</div>
<?php
            echo '</div>';
            echo '</article>';
                $index++;
            }
        } else {
            echo '<p>Brak plików muzycznych.</p>';
        }
        ?>
    </div>
<footer>
<center>
<br><br>
<p><b><a href="https://wlodawa.net/wlodawianka/" rel="noopener" target="_blank">Włodawianka</a></b> wspierane jest  przez</p>
<a href="https://wlodawa.net" rel="noopener" target="_blank"><img src="https://wlodawa.net/wp-content/uploads/2019/04/lwl-280x80-cien.png" alt="Logo wlodawa.net" width="267" height="83" loading="lazy"></a>
</center>
</footer>    

<script>
document.addEventListener('DOMContentLoaded', function() {
    let audioElements = document.querySelectorAll('audio');
    let musicItems = document.querySelectorAll('.music-item');
    let currentPlayingIndex = -1;
    let autoPlayEnabled = false;
    let shuffleEnabled = false;
    let playedTracks = [];
    
    // Funkcja do resetowania wszystkich stanów odtwarzania
    function resetAllPlayingStates() {
        musicItems.forEach(item => {
            item.classList.remove('playing');
        });
    }
    
    // Funkcja do ustawiania aktywnego utworu
    function setActiveTrack(index) {
        resetAllPlayingStates();
        if (index >= 0 && index < musicItems.length) {
            musicItems[index].classList.add('playing');
            currentPlayingIndex = index;
        }
    }
    
    // Funkcja do odtwarzania następnego utworu
    function playNext(lastPlayedIndex = null) {
        console.log('playNext wywołane, autoPlayEnabled:', autoPlayEnabled);
        console.log('lastPlayedIndex:', lastPlayedIndex);
        console.log('currentPlayingIndex:', currentPlayingIndex);
        
        if (!autoPlayEnabled) {
            console.log('AutoPlay wyłączony, kończę');
            return;
        }
        
        let nextIndex;
        let baseIndex = lastPlayedIndex !== null ? lastPlayedIndex : currentPlayingIndex;
        
        if (shuffleEnabled) {
            // Losowy wybór z nieodtworzonych utworów
            let availableTracks = [];
            for (let i = 0; i < audioElements.length; i++) {
                if (!playedTracks.includes(i)) {
                    availableTracks.push(i);
                }
            }
            
            if (availableTracks.length === 0) {
                // Wszystkie utwory zostały odtworzone, resetuj
                playedTracks = [];
                availableTracks = Array.from({length: audioElements.length}, (_, i) => i);
            }
            
            nextIndex = availableTracks[Math.floor(Math.random() * availableTracks.length)];
        } else {
            // Sekwencyjne odtwarzanie - używaj baseIndex zamiast currentPlayingIndex
            if (baseIndex === -1) {
                nextIndex = 0; // Jeśli nie ma aktywnego, zacznij od pierwszego
            } else {
                nextIndex = (baseIndex + 1) % audioElements.length;
            }
        }
        
        console.log('baseIndex:', baseIndex);
        console.log('Następny utwór index:', nextIndex);
        console.log('Długość audioElements:', audioElements.length);
        
        if (nextIndex >= 0 && nextIndex < audioElements.length) {
            console.log('Próbuję odtworzyć następny utwór:', nextIndex);
            
            // Małe opóźnienie aby upewnić się, że poprzedni utwór się zakończył
            setTimeout(() => {
                audioElements[nextIndex].currentTime = 0; // Reset pozycji
                audioElements[nextIndex].play().then(() => {
                    console.log('Udało się odtworzyć utwór:', nextIndex);
                    if (shuffleEnabled) {
                        playedTracks.push(nextIndex);
                    }
                }).catch(error => {
                    console.error('Błąd odtwarzania:', error);
                });
            }, 100);
        } else {
            console.log('Nieprawidłowy nextIndex:', nextIndex);
        }
    }
    
    // Event listenery dla wszystkich elementów audio
    audioElements.forEach((audio, index) => {
        // Gdy zaczyna się odtwarzanie
        audio.addEventListener('play', function() {
            // Zatrzymaj wszystkie inne
            audioElements.forEach((otherAudio, otherIndex) => {
                if (otherIndex !== index && !otherAudio.paused) {
                    otherAudio.pause();
                }
            });
            
            setActiveTrack(index);
        });
        
        // Gdy zatrzymuje się odtwarzanie
        audio.addEventListener('pause', function() {
            if (currentPlayingIndex === index) {
                resetAllPlayingStates();
                currentPlayingIndex = -1;
            }
        });
        
        // Gdy kończy się utwór
        audio.addEventListener('ended', function() {
            console.log('Utwór zakończony, index:', index);
            console.log('currentPlayingIndex przed:', currentPlayingIndex);
            console.log('autoPlayEnabled:', autoPlayEnabled);
            
            // Zapisz index zakończonego utworu PRZED resetowaniem
            let finishedTrackIndex = index;
            resetAllPlayingStates();
            
            // Małe opóźnienie przed odtworzeniem następnego
            setTimeout(() => {
                playNext(finishedTrackIndex);
            }, 200);
        });
        
        // Gdy utwór się ładuje
        audio.addEventListener('loadstart', function() {
            if (currentPlayingIndex === index) {
                setActiveTrack(index);
            }
        });
    });
    
    // Przycisk odtwarzania wszystkich
    document.getElementById('playAllBtn').addEventListener('click', function() {
    
    
        const shuffleBtn = document.getElementById('shuffleBtn');
            
                // Przełącz widoczność przycisku shuffle
                
                 this.classList.toggle('play-all-active');
                 
                    if (shuffleBtn.style.display === 'none' || shuffleBtn.style.display === '') {
                            shuffleBtn.style.display = 'inline-block'; // lub 'block' w zależności od twojego stylu
                                } else {
                                        shuffleBtn.style.display = 'none';
                                            }
    
        autoPlayEnabled = !autoPlayEnabled;
        this.classList.toggle('active');
        this.textContent = autoPlayEnabled ? '⏸️ Zatrzymaj kolejkę' : '⏭️  Odtwarzaj wszystkie po kolei';
        
        console.log('AutoPlay przełączony na:', autoPlayEnabled);
        
        if (autoPlayEnabled) {
            if (currentPlayingIndex === -1) {
                // Rozpocznij od pierwszego utworu
                console.log('Rozpoczynam odtwarzanie od pierwszego utworu');
                audioElements[0].play().then(() => {
                    console.log('Pierwszy utwór rozpoczęty');
                }).catch(error => {
                    console.error('Błąd rozpoczęcia pierwszego utworu:', error);
                });
                playedTracks = [0];
            }
        } else {
            // Jeśli wyłączamy autoplay, zatrzymaj bieżący utwór
            if (currentPlayingIndex >= 0) {
                audioElements[currentPlayingIndex].pause();
            }
        }
    });
    
    // Przycisk zatrzymania wszystkich
    document.getElementById('stopAllBtn').addEventListener('click', function() {
        audioElements.forEach(audio => {
            audio.pause();
            audio.currentTime = 0;
        });
        autoPlayEnabled = false;
        shuffleEnabled = false;
        playedTracks = [];
        resetAllPlayingStates();
        document.getElementById('playAllBtn').classList.remove('active');
        document.getElementById('playAllBtn').textContent = '🎵 Odtwarzaj wszystkie po kolei';
        document.getElementById('shuffleBtn').classList.remove('active');
    });
    
    // Przycisk losowej kolejności
    document.getElementById('shuffleBtn').addEventListener('click', function() {
        shuffleEnabled = !shuffleEnabled;
        this.classList.toggle('active');
        playedTracks = currentPlayingIndex >= 0 ? [currentPlayingIndex] : [];
    });
    
    // Cookie handling
    function getCookie(name) {
        const value = "; " + document.cookie;
        const parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
    }
    
    if (!getCookie('nutaLWL')) {
        const message = `<b>Czy lubisz cookies?</b> &#x1F36A; Ta aplikacja wymaga zgody na tak zwane <b>cookies</b> czyli ciasteczka i właśnie informuje Cię, że tutaj są zbierane ciasteczka firm trzecich. Jeśli nie zgadzasz się na tego typu internetowe praktyki, prosimy opuść tę stronę. We use cookies to ensure you get the best experience on our website. <a href="https://pl.wikipedia.org/wiki/HTTP_cookie" target="_blank">Zobacz więcej</a><br><br><button id="btnYes" type="button" class="btn btn-primary">Tak</button><button id="btnNo" type="button" class="btn btn-danger">Nie</button>`;
        document.getElementById('cooki').innerHTML = message;
        document.getElementById('cooki').style.display = 'block';
    }
    
    document.addEventListener('click', function(event) {
        if (event.target && event.target.id === 'btnYes') {
            document.cookie = "nutaLWL=true; path=/; max-age=" + (60*60*24*365);
            document.getElementById('cooki').style.display = 'none';
        }
        if (event.target && event.target.id === 'btnNo') {
            alert("Zamykaj aplikację.");
            window.close();
        }
    });
});
// Auto-reload po 50 minutach
setInterval(function() {
    location.reload();
}, 3000000);
</script>
</body>
</html>
