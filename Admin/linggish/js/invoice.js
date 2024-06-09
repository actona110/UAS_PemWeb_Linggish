document.addEventListener('DOMContentLoaded', () => {
    let billIdCounter = 2;

    // Fungsi untuk mengedit payment
    function editPayment(row) {
        const cells = row.querySelectorAll('td');
        document.getElementById('user-id').value = cells[1].innerText;
        document.getElementById('total').value = cells[2].innerText;
        document.getElementById('payment-date').value = cells[3].innerText;
        document.getElementById('payment-method').value = cells[4].innerText;

        // Mengatur submit button untuk update
        const submitBtn = document.querySelector('#payment-form button[type="submit"]');
        submitBtn.textContent = 'Update Payment';
        submitBtn.onclick = function (e) {
            e.preventDefault();
            cells[1].innerText = document.getElementById('user-id').value;
            cells[2].innerText = document.getElementById('total').value;
            cells[3].innerText = document.getElementById('payment-date').value;
            cells[4].innerText = document.getElementById('payment-method').value;
            submitBtn.textContent = 'Add Payment';
            submitBtn.onclick = addPayment;
            document.getElementById('payment-form').reset();
        };
    }

    // Menambahkan payment baru ke tabel
    function addPayment(e) {
        e.preventDefault();
        const userId = document.getElementById('user-id').value;
        const total = document.getElementById('total').value;
        const paymentDate = document.getElementById('payment-date').value;
        const paymentMethod = document.getElementById('payment-method').value;

        const table = document.getElementById('payment-results').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();
        newRow.insertCell(0).innerText = billIdCounter++;
        newRow.insertCell(1).innerText = userId;
        newRow.insertCell(2).innerText = total;
        newRow.insertCell(3).innerText = paymentDate;
        newRow.insertCell(4).innerText = paymentMethod;
        const actionCell = newRow.insertCell(5);
        const editButton = document.createElement('button');
        editButton.classList.add('edit-btn');
        editButton.innerText = 'Edit';
        actionCell.appendChild(editButton);
        editButton.addEventListener('click', () => editPayment(newRow));

        document.getElementById('payment-form').reset();
    }

    // Event listener untuk tombol edit
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            editPayment(row);
        });
    });

    // Event listener untuk form submit
    document.getElementById('payment-form').addEventListener('submit', addPayment);
});
