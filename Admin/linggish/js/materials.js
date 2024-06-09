document.addEventListener('DOMContentLoaded', () => {
    // Fungsi untuk mengedit materi
    function editMateri(row) {
        const cells = row.querySelectorAll('td');
        document.getElementById('title').value = cells[0].innerText;
        document.getElementById('date').value = cells[1].innerText;
        document.getElementById('content').value = cells[2].innerText;
        document.getElementById('video-link').value = cells[3].innerText;

        // Mengatur submit button untuk update
        const submitBtn = document.querySelector('#materi-form button[type="submit"]');
        submitBtn.textContent = 'Update Materi';
        submitBtn.onclick = function (e) {
            e.preventDefault();
            cells[0].innerText = document.getElementById('title').value;
            cells[1].innerText = document.getElementById('date').value;
            cells[2].innerText = document.getElementById('content').value;
            cells[3].innerText = document.getElementById('video-link').value;
            submitBtn.textContent = 'Add Materi';
            submitBtn.onclick = addMateri;
            document.getElementById('materi-form').reset();
        };
    }

    // Fungsi untuk mengedit kuis
    function editKuis(row) {
        const cells = row.querySelectorAll('td');
        document.getElementById('quiz-title').value = cells[0].innerText;
        document.getElementById('question').value = cells[1].innerText;
        document.getElementById('option-a').value = cells[2].innerText;
        document.getElementById('option-b').value = cells[3].innerText;
        document.getElementById('option-c').value = cells[4].innerText;
        document.getElementById('option-d').value = cells[5].innerText;
        document.getElementById('correct-answer').value = cells[6].innerText;

        // Mengatur submit button untuk update
        const submitBtn = document.querySelector('#kuis-form button[type="submit"]');
        submitBtn.textContent = 'Update Kuis';
        submitBtn.onclick = function (e) {
            e.preventDefault();
            cells[0].innerText = document.getElementById('quiz-title').value;
            cells[1].innerText = document.getElementById('question').value;
            cells[2].innerText = document.getElementById('option-a').value;
            cells[3].innerText = document.getElementById('option-b').value;
            cells[4].innerText = document.getElementById('option-c').value;
            cells[5].innerText = document.getElementById('option-d').value;
            cells[6].innerText = document.getElementById('correct-answer').value;
            submitBtn.textContent = 'Add Kuis';
            submitBtn.onclick = addKuis;
            document.getElementById('kuis-form').reset();
        };
    }

    // Menambahkan materi baru ke tabel
    function addMateri(e) {
        e.preventDefault();
        const title = document.getElementById('title').value;
        const date = document.getElementById('date').value;
        const content = document.getElementById('content').value;
        const videoLink = document.getElementById('video-link').value;

        const table = document.getElementById('materi-results').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();
        newRow.insertCell(0).innerText = title;
        newRow.insertCell(1).innerText = date;
        newRow.insertCell(2).innerText = content;
        newRow.insertCell(3).innerText = videoLink;
        const actionCell = newRow.insertCell(4);
        const editButton = document.createElement('button');
        editButton.classList.add('edit-btn');
        editButton.innerText = 'Edit';
        editButton.setAttribute('data-type', 'materi');
        actionCell.appendChild(editButton);
        editButton.addEventListener('click', () => editMateri(newRow));

        document.getElementById('materi-form').reset();
    }

    // Menambahkan kuis baru ke tabel
    function addKuis(e) {
        e.preventDefault();
        const title = document.getElementById('quiz-title').value;
        const question = document.getElementById('question').value;
        const optionA = document.getElementById('option-a').value;
        const optionB = document.getElementById('option-b').value;
        const optionC = document.getElementById('option-c').value;
        const optionD = document.getElementById('option-d').value;
        const correctAnswer = document.getElementById('correct-answer').value;

        const table = document.getElementById('kuis-results').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();
        newRow.insertCell(0).innerText = title;
        newRow.insertCell(1).innerText = question;
        newRow.insertCell(2).innerText = optionA;
        newRow.insertCell(3).innerText = optionB;
        newRow.insertCell(4).innerText = optionC;
        newRow.insertCell(5).innerText = optionD;
        newRow.insertCell(6).innerText = correctAnswer;
        const actionCell = newRow.insertCell(7);
        const editButton = document.createElement('button');
        editButton.classList.add('edit-btn');
        editButton.innerText = 'Edit';
        editButton.setAttribute('data-type', 'kuis');
        actionCell.appendChild(editButton);
        editButton.addEventListener('click', () => editKuis(newRow));

        document.getElementById('kuis-form').reset();
    }

    // Event listener untuk tombol edit
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            if (this.getAttribute('data-type') === 'materi') {
                editMateri(row);
            } else {
                editKuis(row);
            }
        });
    });

    // Event listener untuk form submit
    document.getElementById('materi-form').addEventListener('submit', addMateri);
    document.getElementById('kuis-form').addEventListener('submit', addKuis);
});

