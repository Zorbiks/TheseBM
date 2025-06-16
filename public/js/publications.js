if (document.getElementById('publicationModal')) {
    // Select each input field using getElementById
    const titreInput = document.getElementById('titre');
    const auteursInput = document.getElementById('auteurs');
    const lieuInput = document.getElementById('lieu');
    const doiInput = document.getElementById('doi');
    const dateInput = document.getElementById('date');
    const typeInput = document.getElementById('type'); // This is a select element
    const numeroInput = document.getElementById('numero');
    const volumeInput = document.getElementById('volume');
    const attestationInput = document.getElementById('attestation');
    const publicationInput = document.getElementById('publication');
    const rapportInput = document.getElementById('rapport');
    const pubidInput = document.getElementById('pubid');
    const submitBtn = document.querySelector('.submit');

    // Set max date to the current year
    const currentYear = new Date().getFullYear();
    dateInput.setAttribute('max', currentYear);

    // Activate volume only on journal & chapitre publication types
    const volumeWrapper = document.getElementById('volume-wrapper');
    const numeroWrapper = document.getElementById('numero-wrapper');
    volumeWrapper.style.display = 'none';
    numeroWrapper.style.display = 'none';
    volumeInput.setAttribute('disabled', '');
    numeroInput.setAttribute('disabled', '');
    typeInput.addEventListener('change', function () {
        if (typeInput.value === 'Journal' || typeInput.value === 'Chapitre') {
            volumeInput.removeAttribute('disabled');
            numeroInput.removeAttribute('disabled');
            volumeWrapper.style.display = 'block';
            numeroWrapper.style.display = 'block';
        } else {
            volumeInput.setAttribute('disabled', '');
            numeroInput.setAttribute('disabled', '');
            volumeWrapper.style.display = 'none';
            numeroWrapper.style.display = 'none';
        }
    })

    // Activate location only on conference/communications publication types
    const lieuWrapper = document.getElementById('lieu-wrapper');
    lieuWrapper.style.display = 'none';
    lieuInput.setAttribute('disabled', '');
    typeInput.addEventListener('change', function () {
        if (typeInput.value === 'Conférence' || typeInput.value === 'Communication') {
            lieuInput.removeAttribute('disabled');
            lieuWrapper.style.display = 'block';
        } else {
            lieuInput.setAttribute('disabled', '');
            lieuWrapper.style.display = 'none';
        }
    });

    // Modify modal behavior when adding a publication
    const addBtn = document.getElementById('add-btn');
    addBtn.addEventListener('click', () => {
        clearInputFields();

        // Change title of modal
        const modalTitle = document.getElementById('publicationModalLabel');
        modalTitle.textContent = 'Ajouter Publication';

        // Change submit button label
        submitBtn.innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Ajouter';
        submitBtn.setAttribute('value', 'add');

        // Update upload input labels to indicate required fields
        const attestaionLabel = document.querySelector('label[for="attestation"]');
        const publicationLabel = document.querySelector('label[for="publication"]');
        const rapportLabel = document.querySelector('label[for="rapport"]');

        // disable pubid input (only used for when modifying publication)
        pubidInput.setAttribute('disabled', true);

        attestaionLabel.innerHTML = "Attestation *";
        publicationLabel.innerHTML = "Publication *";
        rapportLabel.innerHTML = "Rapport *";
    });

    // Modify modal behavior when editing a publication
    const modifyBtns = document.querySelectorAll('.modify-btn');

    modifyBtns.forEach(function (btn) {
        btn.addEventListener('click', () => {
            clearInputFields();

            // Change title of modal
            const modalTitle = document.getElementById('publicationModalLabel');
            modalTitle.textContent = 'Modifier La Publication';

            // Change submit button behaviour
            submitBtn.innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Modifer';
            submitBtn.setAttribute('value', 'edit');

            // Update upload input labels to show fields as optional
            // If no files are uploaded, the database remains unchanged
            const attestaionLabel = document.querySelector('label[for="attestation"]');
            const publicationLabel = document.querySelector('label[for="publication"]');
            const rapportLabel = document.querySelector('label[for="rapport"]');

            attestaionLabel.innerHTML = "Attestation <small>(Laissez le fichier vide pour conserver l’actuel)</small>";
            publicationLabel.innerHTML = "Publication <small>(Laissez le fichier vide pour conserver l’actuel)</small>";
            rapportLabel.innerHTML = "Rapport <small>(Laissez le fichier vide pour conserver l’actuel)</small>";

            // disable pubid input (only used for when modifying publication)
            pubidInput.removeAttribute('disabled');
            pubidInput.value = btn.dataset.tbmId;

            attestationInput.removeAttribute('required');
            publicationInput.removeAttribute('required');
            rapportInput.removeAttribute('required');

            // Get the row containg all the info about the publication
            // And fill the form with the data
            const row = btn.closest("tr");

            titreInput.value = row.querySelector('td.titre').textContent;
            auteursInput.value = row.querySelector('td.auteurs').textContent;
            lieuInput.value = row.querySelector('td.lieu').textContent;
            doiInput.value = row.querySelector('td.doi').textContent;
            dateInput.value = row.querySelector('td.date').textContent;
            typeInput.value = row.querySelector('td.type').textContent;
            numeroInput.value = row.querySelector('td.numero').textContent;
            volumeInput.value = row.querySelector('td.volume').textContent;
        });
    });

    // Clear all input fields
    function clearInputFields() {
        titreInput.value = '';
        auteursInput.value = '';
        lieuInput.value = '';
        doiInput.value = '';;
        dateInput.value = '';
        typeInput.value = '';
        numeroInput.value = '';
        volumeInput.value = '';
        attestationInput.value = '';
        publicationInput.value = '';
        rapportInput.value = '';
    }
}


const multiDownloadButton = document.getElementById('multi-download-btn');
if (multiDownloadButton) {
    // Retrieve all checked checkbox elements
    const checkboxes = document.querySelectorAll('td.checkbox input[type="checkbox"]');
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', () => {
            const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
            multiDownloadButton.disabled = !anyChecked;
        });
    });

    // When the multi-download button is clicked, trigger a download on each selected publication link
    multiDownloadButton.addEventListener("click", () => {
        const checkedCheckboxes = document.querySelectorAll('td.checkbox input[type="checkbox"]:checked');
        // For each checked box, locate the corresponding publication link in the same row
        const links = Array.from(checkedCheckboxes).map(cb => {
            const tr = cb.closest('tr');
            return tr.querySelector('a.publication');
        });

        // Programmatically click each link to start the downloads
        links.forEach(link => link.click());
    })
}

const exportButton = document.getElementById('export-btn');
if (exportButton) {
    exportButton.addEventListener('click', exportTableToCSV);
}

function exportTableToCSV() {
    const table = document.querySelector("table.table");
    const rows = table.querySelectorAll("tbody tr");
    
    let csv = [];
  
    // Headers
    const headerCells = table.querySelectorAll("thead th");
    const headers = Array.from(headerCells)
      .slice(1, -3) // Skip first (checkbox) and last 3 (attestation, rapport, publication)
      .map(th => th.textContent.trim());
    csv.push(headers.join(","));
  
    // Rows
    rows.forEach(row => {
      const cells = row.querySelectorAll("td");
      const rowData = Array.from(cells)
        .slice(1, -3) // Skip first (checkbox) and last 3
        .map(cell => `"${cell.textContent.trim().replace(/"/g, '""')}"`);
      csv.push(rowData.join(","));
    });
  
    // Trigger download
    const blob = new Blob([csv.join("\n")], { type: "text/csv;charset=utf-8;" });
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = 'publications.csv';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  }