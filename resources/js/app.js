document.addEventListener('DOMContentLoaded', () => {
    const scrollNavbar = document.querySelector('[data-scroll-navbar]');

    if (scrollNavbar) {
        let previousScrollY = window.scrollY;
        let scrollFrame = null;

        const updateNavbarVisibility = () => {
            const currentScrollY = window.scrollY;

            if (currentScrollY <= scrollNavbar.offsetHeight) {
                scrollNavbar.classList.remove('-translate-y-full');
                previousScrollY = currentScrollY;
                scrollFrame = null;

                return;
            }

            if (Math.abs(currentScrollY - previousScrollY) > 4) {
                scrollNavbar.classList.toggle(
                    '-translate-y-full',
                    currentScrollY > previousScrollY
                );
                previousScrollY = currentScrollY;
            }

            scrollFrame = null;
        };

        window.addEventListener('scroll', () => {
            if (scrollFrame === null) {
                scrollFrame = window.requestAnimationFrame(updateNavbarVisibility);
            }
        }, { passive: true });
    }

    const toast = document.querySelector('[data-toast]');

    if (toast) {
        let dismissTimeout;
        let removalTimeout;

        const dismissToast = () => {
            if (toast.dataset.leaving === 'true') {
                return;
            }

            window.clearTimeout(dismissTimeout);
            toast.dataset.leaving = 'true';
            toast.classList.remove('toast-visible');
            toast.classList.add('toast-leaving');
            removalTimeout = window.setTimeout(() => toast.remove(), 400);
        };

        toast.querySelector('[data-toast-close]')?.addEventListener('click', () => {
            dismissToast();
        });


        window.requestAnimationFrame(() => {
            toast.classList.remove('toast-hidden');
            toast.classList.add('toast-visible');
        });

        dismissTimeout = window.setTimeout(dismissToast, 2600);
    }

    const searchForm = document.getElementById('searchForm');
    const keyword = document.getElementById('keyword');
    const locationInput = document.getElementById('location');
    const jobGrid = document.getElementById('jobGrid');
    const cards = jobGrid
        ? Array.from(jobGrid.querySelectorAll('.job-card'))
        : [];

    const empty = document.getElementById('empty');
    const filterButton = document.getElementById('filterButton');
    const filterPanel = document.getElementById('filterPanel');
    const filterButtons = Array.from(
        document.querySelectorAll('.filter-btn')
    );
    const categoryButtons = Array.from(
        document.querySelectorAll('.category-btn')
    );
    const lowonganSection = document.getElementById('lowongan');

    let selectedCategory = 'all';

    const normalize = (value) =>
        (value || '').toLowerCase().trim();

    function getGridItem(card) {
        return card.parentElement === jobGrid
            ? card
            : card.parentElement;
    }

   function filterJobs() {
    if (!jobGrid || !empty) return;

    const search = normalize(keyword?.value);
    const loc = normalize(locationInput?.value);

    let visible = 0;

    cards.forEach((card) => {
        const text = normalize(card.dataset.search);
        const category = card.dataset.category || '';

        const matchKeyword =
            search === '' || text.includes(search);

        const matchLocation =
            loc === '' || text.includes(loc);

        const matchCategory =
            selectedCategory === 'all' ||
            category === selectedCategory;

        const show =
            matchKeyword &&
            matchLocation &&
            matchCategory;

        const gridItem = getGridItem(card);

        card.classList.toggle('hidden', !show);

        if (gridItem && gridItem !== card) {
            gridItem.classList.toggle('hidden', !show);
        }

        if (show) visible++;
    });

    empty.classList.toggle('hidden', visible !== 0);

    // Kembalikan grid ke layout responsif dan rata kiri.
    jobGrid.style.removeProperty('grid-template-columns');
    jobGrid.style.removeProperty('justify-content');
    jobGrid.style.removeProperty('justify-items');
}

    function setActiveFilter(activeValue) {
        filterButtons.forEach((button) => {
            const active =
                button.dataset.filter === activeValue;

            button.classList.toggle(
                'bg-[#151442]',
                active
            );

            button.classList.toggle(
                'text-white',
                active
            );

            button.classList.toggle(
                'border',
                !active
            );

            button.classList.toggle(
                'border-gray-300',
                !active
            );
        });
    }

    if (searchForm) {
        searchForm.addEventListener('submit', (event) => {
            event.preventDefault();

            filterJobs();

            lowonganSection?.scrollIntoView({
                behavior: 'smooth'
            });
        });
    }

    keyword?.addEventListener('input', filterJobs);
    locationInput?.addEventListener('input', filterJobs);

    filterButton?.addEventListener('click', () => {
        if (!filterPanel) return;

        const isExpanded = filterPanel.classList.contains('hidden');
        filterPanel.classList.toggle('hidden', !isExpanded);
        filterPanel.classList.toggle('flex', isExpanded);

        if (filterButton.hasAttribute('aria-expanded')) {
            filterButton.setAttribute('aria-expanded', String(isExpanded));
        }
    });

    filterButtons.forEach((button) => {
        button.addEventListener('click', () => {
            selectedCategory =
                button.dataset.filter || 'all';

            setActiveFilter(selectedCategory);
            filterJobs();
        });
    });

    categoryButtons.forEach((button) => {
        button.addEventListener('click', () => {
            selectedCategory =
                button.dataset.category || 'all';

            setActiveFilter(selectedCategory);

            filterPanel?.classList.remove('hidden');
            filterPanel?.classList.add('flex');

            filterJobs();

            lowonganSection?.scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    setActiveFilter(selectedCategory);
    filterJobs();

    const loadMoreJobsButton = document.getElementById('loadMoreJobs');
    const loadMoreJobsContainer = document.getElementById('loadMoreJobsContainer');
    const lowonganEmpty = document.getElementById('emptyJobs');
    const lowonganFilterButtons = Array.from(
        document.querySelectorAll('.filter-button')
    );

    if (loadMoreJobsButton && lowonganEmpty && jobGrid) {
        let visibleRows = 4;

        const getVisibleCardLimit = () => {
            const columnCount = window
                .getComputedStyle(jobGrid)
                .gridTemplateColumns.split(' ').length;

            return columnCount * visibleRows;
        };

        const updateLowonganCards = () => {
            const visibleCardLimit = getVisibleCardLimit();
            let matchingJobs = 0;
            let visibleJobs = 0;

            cards.forEach((card) => {
                const matchesCategory =
                    selectedCategory === 'all' ||
                    card.dataset.category === selectedCategory;
                const shouldShow = matchesCategory && visibleJobs < visibleCardLimit;

                card.classList.toggle('hidden', !shouldShow);

                if (matchesCategory) {
                    matchingJobs++;

                    if (shouldShow) {
                        visibleJobs++;
                    }
                }
            });

            lowonganEmpty.classList.toggle('hidden', matchingJobs > 0);
            loadMoreJobsContainer?.classList.toggle(
                'hidden',
                matchingJobs <= visibleCardLimit
            );
        };

        lowonganFilterButtons.forEach((button) => {
            button.addEventListener('click', () => {
                selectedCategory = button.dataset.filter || 'all';
                visibleRows = 4;

                lowonganFilterButtons.forEach((filterButton) => {
                    const isActive = filterButton === button;
                    filterButton.classList.toggle('bg-[#151442]', isActive);
                    filterButton.classList.toggle('text-white', isActive);
                    filterButton.classList.toggle('border', !isActive);
                    filterButton.classList.toggle('border-gray-300', !isActive);
                });

                updateLowonganCards();
            });
        });

        loadMoreJobsButton.addEventListener('click', () => {
            visibleRows += 4;
            updateLowonganCards();
        });

        window.addEventListener('resize', updateLowonganCards);
        updateLowonganCards();
    }
});