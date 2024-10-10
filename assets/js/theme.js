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
      const tableElementS = document.getElementById("table-sp");
      const tableElementSP = document.getElementById("table-s");
      const sidebarBg = document.getElementById("sidebar");
      const sidebarBt = document.getElementById("sidebarCollapse");
      const themeIcon = document.getElementById("theme-icon");
      const logoutModalBg = document.getElementById("logoutModalBg",);
      const notifModalBg = document.getElementById("notifModalBg",);
  
      // Fungsi untuk toggle class
      const toggleClass = (element, addClass, removeClass) => {
        element.classList.add(addClass);
        element.classList.remove(removeClass);
      };
  
      // Table theme
      if (tableElementS) {
        const tableHead = tableElementS.querySelector("thead");
        if (theme === "light") {
          toggleClass(tableElementS, "table-hover", "table-striped");
          toggleClass(tableHead, "table-primary", "table-secondary");
        } else {
          toggleClass(tableElementS, "table-striped", "table-hover");
          toggleClass(tableHead, "table-secondary", "table-dark");
        }
      }
      if (tableElementSP) {
        const tableHead = tableElementSP.querySelector("thead");
        if (theme === "light") {
          toggleClass(tableElementSP, "table-hover", "table-striped");
          toggleClass(tableHead, "table-primary", "thead-secondary");
        } else {
          toggleClass(tableElementSP, "table-striped", "table-hover");
          toggleClass(tableHead, "table-secondary", "thead-dark");
        }
      }
  
      // Sidebar theme
      toggleClass(
        sidebarBg,
        theme === "light" ? "nav-bg-light" : "nav-bg-dark",
        theme === "light" ? "nav-bg-dark" : "nav-bg-light"
      );
      toggleClass(
        sidebarBt,
        theme === "light" ? "btn-light" : "btn-dark",
        theme === "light" ? "btn-dark" : "btn-light"
      );
  
      // Theme icon
      toggleClass(
        themeIcon,
        theme === "light" ? "fa-sun" : "fa-moon",
        theme === "light" ? "fa-moon" : "fa-sun"
      );
  
      // Logout modal
      toggleClass(
        logoutModalBg,
        theme === "light" ? "bg-light" : "bg-dark",
        theme === "light" ? "bg-dark" : "bg-light"
      );
  
      // Notif modal
      toggleClass(
        notifModalBg,
        theme === "light" ? "bg-light" : "bg-dark",
        theme === "light" ? "bg-dark" : "bg-light"
      );
    }
});
