import $ from "jquery";
window.$ = window.jQuery = $;

import DataTable from "datatables.net";
import "datatables.net-bs4";
import "datatables.net-buttons";
import "datatables.net-buttons-bs4";
import "datatables.net-buttons/js/buttons.print";
import "datatables.net-buttons/js/buttons.colVis";
import "datatables.net-responsive";
import "datatables.net-responsive-bs4";
import "datatables.net-select";
import "datatables.net-select-bs4";

// Helpers
// ----------------------------------------------------------

/**
 * Build query params
 *
 * @param   {DataTables} dt
 * @param   {string}     action
 * @param   {boolean}    onlyVisibles
 * @returns {object}
 */
function buildParams(dt, action, onlyVisibles = false) {
  const params = dt.ajax.params();
  params.action = action;
  params._token = $('meta[name="csrf-token"]').attr("content");

  if (onlyVisibles) {
    params.visible_columns = getVisibleColumns();
  } else {
    params.visible_columns = null;
  }

  return params;
}

/**
 * Get visible columns
 *
 * @returns {array}
 */
function getVisibleColumns() {
  const visible_columns = [];
  $.each(DataTable.settings[0].aoColumns, function(key, col) {
    if (col.bVisible) {
      visible_columns.push(col.name);
    }
  });

  return visible_columns;
}

/**
 * Download resource from URL
 *
 * @param   {string} url
 * @param   {object} params
 * @returns {void}
 */
function downloadFromUrl(url, params) {
  const postUrl = url + "/export";
  const xhr = new XMLHttpRequest();
  xhr.open("POST", postUrl, true);
  xhr.responseType = "arraybuffer";
  xhr.onload = function() {
    if (this.status === 200) {
      let filename = "";
      const disposition = xhr.getResponseHeader("Content-Disposition");
      if (disposition && disposition.indexOf("attachment") !== -1) {
        const filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
        const matches = filenameRegex.exec(disposition);
        if (matches != null && matches[1])
          filename = matches[1].replace(/['"]/g, "");
      }
      const type = xhr.getResponseHeader("Content-Type");

      const blob = new Blob([this.response], { type });
      if (typeof window.navigator.msSaveBlob !== "undefined") {
        // IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
        window.navigator.msSaveBlob(blob, filename);
      } else {
        const URL = window.URL || window.webkitURL;
        const downloadUrl = URL.createObjectURL(blob);

        if (filename) {
          // use HTML5 a[download] attribute to specify filename
          const a = document.createElement("a");
          // safari doesn't support this yet
          if (typeof a.download === "undefined") {
            window.location = downloadUrl;
          } else {
            a.href = downloadUrl;
            a.download = filename;
            document.body.appendChild(a);
            a.click();
          }
        } else {
          window.location = downloadUrl;
        }

        setTimeout(function() {
          URL.revokeObjectURL(downloadUrl);
        }, 100); // cleanup
      }
    }
  };
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send($.param(params));
}

/**
 * Build URL for action
 *
 * @param   {DataTables} dt
 * @param   {string}     action
 * @returns {string}
 */
function buildUrl(dt, action) {
  let url = dt.ajax.url() || "";
  const params = dt.ajax.params();
  params.action = action;

  if (url.indexOf("?") > -1) {
    return url + "&" + $.param(params);
  }

  return url + "?" + $.param(params);
}

// Buttons
// -----------------------------------------------------------

/**
 * Button `excel`
 * Click to download excel file include data of this table. Downloading use GET method.
 */
DataTable.ext.buttons.excel = {
  className: "buttons-excel",
  text: function(dt) {
    return (
      '<i class="far fa-fw fa-file-excel"></i> ' + dt.i18n("buttons.excel", "Excel")
    );
  },
  action: function(e, dt, button, config) {
    window.location = buildUrl(dt, "excel");
  }
};

/**
 * Button `post-excel`
 * Click to download excel file include data of this table. Downloading use POST method.
 */
DataTable.ext.buttons.postExcel = {
  className: "buttons-excel",
  text: function(dt) {
    return (
      '<i class="far fa-fw fa-file-excel"></i> ' + dt.i18n("buttons.excel", "Excel")
    );
  },
  action: function(e, dt, button, config) {
    const url = dt.ajax.url() || window.location.href;
    const params = buildParams(dt, "excel");

    downloadFromUrl(url, params);
  }
};

/**
 * Button `post-excel-visible-columns`
 * Click to download excel file include data of visiable columns in this table. Downloading use POST method.
 */
DataTable.ext.buttons.postExcelVisibleColumns = {
  className: "buttons-excel",
  text: function(dt) {
    return (
      '<i class="far fa-fw fa-file-excel"></i> ' +
      dt.i18n("buttons.excel", "Excel (only visible columns)")
    );
  },
  action: function(e, dt, button, config) {
    const url = dt.ajax.url() || window.location.href;
    const params = buildParams(dt, "excel", true);

    downloadFromUrl(url, params);
  }
};

/**
 * Button `csv`
 * Click to download csv file include data of this table. Downloading use GET method.
 */
DataTable.ext.buttons.csv = {
  className: "buttons-csv",
  text: function(dt) {
    return (
      '<i class="far fa-fw fa-file-excel"></i> ' + dt.i18n("buttons.csv", "CSV")
    );
  },
  action: function(e, dt, button, config) {
    const url = buildUrl(dt, "csv");
    window.location = url;
  }
};

/**
 * Button `post-csv`
 * Click to download csv file include data of this table. Downloading use POST method.
 */
DataTable.ext.buttons.postCsv = {
  className: "buttons-csv",
  text: function(dt) {
    return (
      '<i class="far fa-fw fa-file-excel"></i> ' + dt.i18n("buttons.csv", "CSV")
    );
  },
  action: function(e, dt, button, config) {
    const url = dt.ajax.url() || window.location.href;
    const params = buildParams(dt, "csv");

    downloadFromUrl(url, params);
  }
};

/**
 * Button `post-csv-visible-columns`
 * Click to download csv file include data of visiable columns in this table. Downloading use POST method.
 */
DataTable.ext.buttons.postCsvVisibleColumns = {
  className: "buttons-csv",
  text: function(dt) {
    return (
      '<i class="far fa-fw fa-file-excel"></i> ' +
      dt.i18n("buttons.csv", "CSV (only visible columns)")
    );
  },
  action: function(e, dt, button, config) {
    const url = dt.ajax.url() || window.location.href;
    const params = buildParams(dt, "csv", true);

    downloadFromUrl(url, params);
  }
};

/**
 * Button `pdf`
 * Click to download pdf file include data of this table. Downloading use GET method.
 */
DataTable.ext.buttons.pdf = {
  className: "buttons-pdf",
  text: function(dt) {
    return '<i class="far fa-fw fa-file-pdf"></i> ' + dt.i18n("buttons.pdf", "PDF");
  },
  action: function(e, dt, button, config) {
    const url = buildUrl(dt, "pdf");
    window.location = url;
  }
};

/**
 * Button `post-pdf`
 * Click to download pdf file include data of this table. Downloading use POST method.
 */
DataTable.ext.buttons.postPdf = {
  className: "buttons-pdf",
  text: function(dt) {
    return '<i class="far fa-fw fa-file-pdf"></i> ' + dt.i18n("buttons.pdf", "PDF");
  },
  action: function(e, dt, button, config) {
    const url = dt.ajax.url() || window.location.href;
    const params = buildParams(dt, "pdf");

    downloadFromUrl(url, params);
  }
};

/**
 * Button `export`
 * Group buttons for `csv`, `excel` and `pdf` buttons.
 */
DataTable.ext.buttons.export = {
  extend: "collection",
  className: "buttons-export",
  text: function(dt) {
    return (
      '<i class="fas fa-fw fa-download"></i> ' +
      dt.i18n("buttons.export", "Export") +
      '&nbsp;<span class="caret"/>'
    );
  },
  buttons: ["csv", "excel", "pdf"]
};

/**
 * Button `print`
 * Click to view printable table.
 */
DataTable.ext.buttons.print = {
  className: "buttons-print",
  text: function(dt) {
    return '<i class="fas fa-fw fa-print"></i> ' + dt.i18n("buttons.print", "Print");
  },
  action: function(e, dt, button, config) {
    const url = buildUrl(dt, "print");
    window.location = url;
  }
};

/**
 * Button `reset`
 * Click to reset search stare.
 */
DataTable.ext.buttons.reset = {
  className: "buttons-reset",
  text: function(dt) {
    return '<i class="fas fa-fw fa-undo"></i> ' + dt.i18n("buttons.reset", "Reset");
  },
  action: function(e, dt, button, config) {
    dt.search("");
    dt.columns().search("");
    dt.draw();
  }
};

/**
 * Button `reload`
 * Click to reload table.
 */
DataTable.ext.buttons.reload = {
  className: "buttons-reload",
  text: function(dt) {
    return (
      '<i class="fas fa-fw fa-sync"></i> ' + dt.i18n("buttons.reload", "Reload")
    );
  },
  action: function(e, dt, button, config) {
    dt.draw(false);
  }
};

/**
 * Button `create`
 * Click to go to create resource page.
 */
DataTable.ext.buttons.create = {
  className: "buttons-create",
  text: function(dt) {
    return '<i class="fas fa-fw fa-plus-circle"></i> ' + dt.i18n("buttons.create", "Create");
  },
  action: function(e, dt, button, config) {
    window.location = window.location.href.replace(/\/+$/, "") + "/create";
  }
};

// Modify some buttons
//---------------------------------------------------------------------

if (typeof DataTable.ext.buttons.copyHtml5 !== "undefined") {
  $.extend(DataTable.ext.buttons.copyHtml5, {
    text: function(dt) {
      return '<i class="far fa-fw fa-clipboard"></i> ' + dt.i18n("buttons.copy", "Copy");
    }
  });
}

if (typeof DataTable.ext.buttons.colvis !== "undefined") {
  $.extend(DataTable.ext.buttons.colvis, {
    text: function(dt) {
      return (
        '<i class="fas fa-eye"></i> ' +
        dt.i18n("buttons.colvis", "Column visibility")
      );
    }
  });
}
