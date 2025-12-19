document.addEventListener('DOMContentLoaded', function() {
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    if(mobileBtn && mobileMenu) {
        mobileBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }

    const userMenuBtn = document.getElementById('user-menu-button');
    const userMenuDropdown = document.getElementById('user-menu-dropdown');

    if(userMenuBtn && userMenuDropdown) {
        userMenuBtn.addEventListener('click', function(e) {
            e.stopPropagation(); // Impede que o clique feche imediatamente
            userMenuDropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', function(e) {
            if (!userMenuBtn.contains(e.target) && !userMenuDropdown.contains(e.target)) {
                userMenuDropdown.classList.add('hidden');
            }
        });
    }
});

/**
 * Função de Pesquisa Global Unificada
 * Funciona na Home, Modelos, Anos E na Garagem.
 */
function filterGlobal() {
    let input = document.getElementById('searchInput');
    let filter = input.value.toLowerCase();

    let items = document.querySelectorAll('.search-item, .search-card');

    let visibleCount = 0;
    let hasResults = false;

    items.forEach(item => {
        let titleElement = item.querySelector('.search-text');

        if (titleElement) {
            let txtValue = titleElement.textContent || titleElement.innerText;

            if (txtValue.toLowerCase().indexOf(filter) > -1) {
                item.style.display = "";
                visibleCount++;
                hasResults = true;
            } else {
                item.style.display = "none";
            }
        }
    });

    let countDisplay = document.getElementById('countDisplay');
    if (countDisplay) {
        countDisplay.innerText = visibleCount + " opções encontradas";
    }

    let noResultsMsg = document.getElementById('noResults');
    if (noResultsMsg) {
        if (!hasResults) {
            noResultsMsg.classList.remove('hidden');
        } else {
            noResultsMsg.classList.add('hidden');
        }
    }
}
