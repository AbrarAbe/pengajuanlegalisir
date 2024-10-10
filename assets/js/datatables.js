document.addEventListener("DOMContentLoaded", () => {
  // Common DataTable configuration
  const dataTableOptions = {
    autoWidth: false,
    stateSave: true,
    responsive: true,
    colReorder: true,
  };

  // Table pagination
  new DataTable("#table-p", {
    ...dataTableOptions,
    layout: {
      topStart: {
        buttons: ["copy", "excel", "pdf", "print"],
      },
    },
  });

  // Table scroll with pagination
  const scrollTableOptions = {
    ...dataTableOptions,
    paging: false,
    scrollCollapse: true,
    scrollY: "50vh",
  };

  // Initialize scroll tables
  const scrollTables = [
    "#table-s",
    "#table-s2",
    "#table-s3",
    "#table-s4",
    "#table-s5",
  ];
  scrollTables.forEach((selector) => {
    $(document).ready(() => {
      $(selector).DataTable({
        ...scrollTableOptions,
        dom: selector === "#table-s5" ? '<"top"f>rt<"bottom"Blip>' : undefined,
        buttons:
          selector === "#table-s5"
            ? ["copy", "excel", "pdf", "print"]
            : undefined,
      });
    });
  });

  // Table scroll + pagination
  $(document).ready(() => {
    $("#table-sp").DataTable({
      lengthChange: true,
      ...dataTableOptions,
      ...scrollTableOptions,
      layout: {
        topStart: {
          buttons: ["copy", "excel", "pdf", "print"],
        },
      },
    });
  });

  // Table scroll print
  $(document).ready(() => {
    $("#table-a").DataTable({
      ...scrollTableOptions,
      dom: '<"top"f>rt<"bottom"Blip>',
      buttons: ["copy", "excel", "pdf", "print"],
    });
  });

  // Example tables with different features
  $(function () {
    $("#example1")
      .DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
      })
      .buttons()
      .container()
      .appendTo("#example1_wrapper .col-md-6:eq(0)");

    $("#example2").DataTable({
      stateSave: true,
      paging: false,
      lengthChange: false,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: false,
      responsive: true,
      scrollCollapse: true,
      scrollY: "50vh",
      buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
    });
  });
});
