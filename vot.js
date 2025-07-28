const gun = Gun(['https://gun-manhattan.herokuapp.com/gun']);

// Funkcja do wyświetlania ładnych komunikatów
function showMessage(text, type = 'info') {
    // Usuń poprzednie komunikaty
    const existingModal = document.querySelector('.vote-modal');
    if (existingModal) {
        existingModal.remove();
    }

    // Utwórz modal
    const modal = document.createElement('div');
    modal.className = 'vote-modal';
    modal.innerHTML = `
        <div class="vote-modal-content ${type}">
            <span class="vote-modal-close">&times;</span>
            <div class="vote-modal-text">${text}</div>
            <button class="vote-modal-btn">OK</button>
        </div>
    `;

    // Dodaj style jeśli nie istnieją
    if (!document.querySelector('#vote-modal-styles')) {
        const styles = document.createElement('style');
        styles.id = 'vote-modal-styles';
        styles.textContent = `
            .vote-modal {
                position: fixed;
                z-index: 10000;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.7);
                display: flex;
                justify-content: center;
                align-items: center;
                animation: fadeIn 0.3s ease;
            }
            
            .vote-modal-content {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                padding: 30px;
                border-radius: 15px;
                text-align: center;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
                max-width: 400px;
                width: 90%;
                position: relative;
                animation: slideIn 0.3s ease;
            }
            
            .vote-modal-content.success {
                 background: linear-gradient(135deg, #ff0000 0%, #0066ff 100%);
            }
            
            .vote-modal-content.warning {
                background: linear-gradient(135deg, #ff0000 0%, #0066ff 100%);
            }
            
            .vote-modal-close {
                position: absolute;
                right: 15px;
                top: 10px;
                font-size: 28px;
                font-weight: bold;
                color: white;
                cursor: pointer;
                opacity: 0.7;
                transition: opacity 0.3s;
            }
            
            .vote-modal-close:hover {
                opacity: 1;
            }
            
            .vote-modal-text {
                color: white;
                font-size: 18px;
                font-weight: bold;
                margin: 20px 0;
                line-height: 1.5;
            }
            
            .vote-modal-btn {
                background: rgba(255, 255, 255, 0.2);
                color: white;
                border: 2px solid white;
                padding: 12px 30px;
                border-radius: 25px;
                cursor: pointer;
                font-size: 16px;
                font-weight: bold;
                transition: all 0.3s ease;
            }
            
            .vote-modal-btn:hover {
                background: white;
                color: #333;
                transform: scale(1.05);
            }
            
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            
            @keyframes slideIn {
                from { 
                    transform: translateY(-50px);
                    opacity: 0;
                }
                to { 
                    transform: translateY(0);
                    opacity: 1;
                }
            }
        `;
        document.head.appendChild(styles);
    }

    document.body.appendChild(modal);

    // Obsługa zamykania
    const closeBtn = modal.querySelector('.vote-modal-close');
    const okBtn = modal.querySelector('.vote-modal-btn');
    
    function closeModal() {
        modal.style.animation = 'fadeOut 0.3s ease';
        setTimeout(() => {
            modal.remove();
        }, 300);
    }

    closeBtn.addEventListener('click', closeModal);
    okBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    // Dodaj animację zamykania do CSS jeśli nie istnieje
    if (!styles.textContent.includes('fadeOut')) {
        styles.textContent += `
            @keyframes fadeOut {
                from { opacity: 1; }
                to { opacity: 0; }
            }
        `;
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const musicContainer = document.querySelector('.container');
    if (!musicContainer) return;

    const voteElements = Array.from(document.querySelectorAll('.music-item'));

    // Wczytaj wszystkie głosy i zapisz z referencją do DOM
    const voteData = [];

    let loadedCount = 0;
    voteElements.forEach(item => {
        const trackName = item.querySelector('.votes')?.dataset.track;
        if (!trackName) return;

        gun.get('LKS-Wlodawianka-TAK-JEST').get(trackName).once(data => {
            const score = (data?.up || 0) - (data?.down || 0);
            voteData.push({ element: item, score: score, name: trackName });
            const span = item.querySelector('.vote-score');
            if (span) span.textContent = score;
            loadedCount++;

            // Gdy wszystkie wczytane — sortuj
            if (loadedCount === voteElements.length) {
                voteData.sort((a, b) => b.score - a.score);
                voteData.forEach(vote => {
                    musicContainer.appendChild(vote.element);
                });
            }
        });
    });

    // Obsługa klików głosowania
    let totalClicks = 0;
    const votedTracks = new Set(); // Śledzenie głosów w tej sesji

    document.querySelectorAll('.votes').forEach(voteBox => {
        const track = voteBox.dataset.track;
        const upBtn = voteBox.querySelector('.vote-up');
        const downBtn = voteBox.querySelector('.vote-down');
        const scoreSpan = voteBox.querySelector('.vote-score');

        const voteKey = `LKS-Wlodawianka-TAK-JEST_${track}`;
        
        function updateScore() {
            gun.get('LKS-Wlodawianka-TAK-JEST').get(track).once(data => {
                const score = (data?.up || 0) - (data?.down || 0);
                scoreSpan.textContent = score;
            });
        }

        function canVoteOnTrack() {
            const votedAt = localStorage.getItem(voteKey);
            return !votedAt || (Date.now() - parseInt(votedAt) > 86400000);
        }

        function handleVote(type) {
            totalClicks++;
            
            // Sprawdź limit 3 kliknięć globalnych
            if (totalClicks >= 3) {
                showMessage("Brawo Ziom! Takich Fanów Włodawianki <br/> nam trzeba 💪❤️💙🤳", 'success');
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
                return;
            }

            // Sprawdź czy można głosować na ten konkretny utwór (limit 24h per utwór)
            const canVoteThisTrack = canVoteOnTrack();
            
            // Zawsze aktualizuj wynik wizualnie (użytkownik widzi zmianę)
            gun.get('LKS-Wlodawianka-TAK-JEST').get(track).once(data => {
                const up = data?.up || 0;
                const down = data?.down || 0;
                
                // Jeśli może głosować na ten utwór - zapisz realny głos
                if (canVoteThisTrack && !votedTracks.has(track)) {
                    const newData = {
                        up: type === 'up' ? up + 1 : up,
                        down: type === 'down' ? down + 1 : down
                    };
                    
                    gun.get('LKS-Wlodawianka-TAK-JEST').get(track).put(newData);
                    localStorage.setItem(voteKey, Date.now().toString());
                    votedTracks.add(track);
                    
                    const voteType = type === 'up' ? '👍' : '👎';
                    showMessage(`Twój głos ${voteType} został zapisany!`, 'success');
                } else {
                    // Głos nie liczy się, ale user widzi "zmianę"
                    if (votedTracks.has(track)) {
                        showMessage('Już głosowałeś na ten utwór w tej sesji 😍🤙', 'warning');
                    } else {
                        showMessage('Już głosowałeś na ten utwór w ciągu 24h, <br/>ale fajnie, że nadal wspierasz nasz klub!</br> 🎵❤️🦹🥁🦹‍♂️💙🎶', 'warning');
                    }
                }
                
                // Zawsze odśwież wynik (żeby user widział aktualny stan)
                updateScore();
            });
        }

        upBtn.addEventListener('click', () => handleVote('up'));
        downBtn.addEventListener('click', () => handleVote('down'));
        
        updateScore();
    });
});
