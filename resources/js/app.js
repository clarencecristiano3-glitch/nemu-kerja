document.addEventListener('DOMContentLoaded', () => {
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

        filterPanel.classList.toggle('hidden');
        filterPanel.classList.toggle('flex');
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
});