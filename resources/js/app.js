document.addEventListener('DOMContentLoaded', () => {

    const searchForm =
        document.getElementById('searchForm');

    const keyword =
        document.getElementById('keyword');

    const location =
        document.getElementById('location');

    const cards =
        document.querySelectorAll('.job-card');

    const empty =
        document.getElementById('empty');

    const filterButton =
        document.getElementById('filterButton');

    const filterPanel =
        document.getElementById('filterPanel');

    const filterButtons =
        document.querySelectorAll('.filter-btn');

    const categoryButtons =
        document.querySelectorAll('.category-btn');


    let selectedCategory = 'all';


    function normalize(text) {

        return text
            .toLowerCase()
            .trim();

    }


    function filterJobs() {

        const search =
            normalize(keyword.value);

        const loc =
            normalize(location.value);


        let visible = 0;


        cards.forEach(card => {

            const text =
                card.dataset.search || '';

            const category =
                card.dataset.category || '';


            const matchKeyword =
                search === '' ||
                text.includes(search);


            const matchLocation =
                loc === '' ||
                text.includes(loc);


            const matchCategory =
                selectedCategory === 'all' ||
                category === selectedCategory;


            const show =
                matchKeyword &&
                matchLocation &&
                matchCategory;


            if (show) {

                card.classList.remove(
                    'hidden'
                );

                visible++;

            } else {

                card.classList.add(
                    'hidden'
                );

            }

        });


        if (visible === 0) {

            empty.classList.remove(
                'hidden'
            );

        } else {

            empty.classList.add(
                'hidden'
            );

        }

    }


    /* ================= SEARCH ================= */

    searchForm.addEventListener(
        'submit',
        event => {

            event.preventDefault();

            filterJobs();

            document
                .getElementById('lowongan')
                .scrollIntoView({
                    behavior: 'smooth'
                });

        }
    );


    keyword.addEventListener(
        'input',
        filterJobs
    );


    location.addEventListener(
        'input',
        filterJobs
    );


    /* ================= FILTER PANEL ================= */

    filterButton.addEventListener(
        'click',
        () => {

            filterPanel.classList.toggle(
                'hidden'
            );

            filterPanel.classList.toggle(
                'flex'
            );

        }
    );


    /* ================= FILTER BUTTON ================= */

    filterButtons.forEach(button => {

        button.addEventListener(
            'click',
            () => {

                filterButtons.forEach(
                    item => {

                        item.classList.remove(
                            'bg-[#151442]',
                            'text-white'
                        );

                    }
                );


                button.classList.add(
                    'bg-[#151442]',
                    'text-white'
                );


                selectedCategory =
                    button.dataset.filter;


                filterJobs();

            }
        );

    });


    /* ================= CATEGORY ================= */

    categoryButtons.forEach(button => {

        button.addEventListener(
            'click',
            () => {

                selectedCategory =
                    button.dataset.category;


                filterButtons.forEach(
                    filter => {

                        const active =
                            filter.dataset.filter ===
                            selectedCategory;


                        filter.classList.toggle(
                            'bg-[#151442]',
                            active
                        );


                        filter.classList.toggle(
                            'text-white',
                            active
                        );

                    }
                );


                filterPanel.classList.remove(
                    'hidden'
                );

                filterPanel.classList.add(
                    'flex'
                );


                filterJobs();


                document
                    .getElementById('lowongan')
                    .scrollIntoView({
                        behavior: 'smooth'
                    });

            }
        );

    });


    filterJobs();

});//
