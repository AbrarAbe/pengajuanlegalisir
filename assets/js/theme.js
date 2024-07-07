document.addEventListener('DOMContentLoaded', function () {
    const themeToggleBtn = document.getElementById('theme-toggle');
    const currentTheme = localStorage.getItem('theme') || 'light';

    // Set the initial theme
    setTheme(currentTheme);

    // Add event listener to the theme toggle button
    themeToggleBtn.addEventListener('click', function () {
        const newTheme = document.documentElement.getAttribute('data-bs-theme') === 'light' ? 'dark' : 'light';
        setTheme(newTheme);
    });

    function setTheme(theme) {
        document.documentElement.setAttribute('data-bs-theme', theme);
        localStorage.setItem('theme', theme);
        applyTableTheme(theme);
    }
    function applyTableTheme(theme) {
        const tableElementS = document.getElementById('table-sp');
        const tableElementSP = document.getElementById('table-s');
        const sidebarBg = document.getElementById('sidebar');
        const sidebarBt = document.getElementById('sidebarCollapse');
        const themeIcon = document.getElementById('theme-icon');

        // Ganti warna tabel
        if (tableElementS) {
            const tableHead = tableElementS.querySelector('thead');
            if (theme === 'light') {
                tableElementS.classList.remove('table-striped');
                tableElementS.classList.add('table-hover');
                tableHead.classList.add('table-primary');
                tableHead.classList.remove('table-secondary');
            } else {
                tableElementS.classList.add('table-striped');
                tableElementS.classList.remove('table-hover');
                tableHead.classList.add('table-secondary');
                tableHead.classList.remove('table-dark');
            }
        }
        if (tableElementSP) {
            const tableHead = tableElementSP.querySelector('thead');
            if (theme === 'light') {
                tableElementSP.classList.remove('table-striped');
                tableElementSP.classList.add('table-hover');
                tableHead.classList.add('table-primary');
                tableHead.classList.remove('thead-secondary');

            } else {
                tableElementSP.classList.add('table-striped');
                tableElementSP.classList.remove('table-hover');
                tableHead.classList.add('table-secondary');
                tableHead.classList.remove('thead-dark');
            }
        }

        // Ganti backgroud sidebar
        if (theme === 'light') {
            sidebarBg.classList.add('nav-bg-light');
            sidebarBg.classList.remove('nav-bg-dark');

        } else {
            sidebarBg.classList.add('nav-bg-dark');
            sidebarBg.classList.remove('nav-bg-light');
        }

        // Ganti tombol sidebar
        if (theme === 'light') {
            sidebarBt.classList.add('btn-light');
            sidebarBt.classList.remove('btn-dark');

        } else {
            sidebarBt.classList.add('btn-dark');
            sidebarBt.classList.remove('btn-light');
        }

        // Ganti icon tema
        if (theme === 'light') {
            themeIcon.classList.add('fa-sun');
            themeIcon.classList.remove('fa-moon');

        } else {
            themeIcon.classList.add('fa-moon');
            themeIcon.classList.remove('fa-sun');
        }
    }
});
