document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registrationForm');
    if (!form) return;

    const modalElement = document.getElementById('confirmModal');
    const confirmModal = new bootstrap.Modal(modalElement);
    const confirmBody = document.getElementById('confirmModalBody');
    const confirmButton = document.getElementById('confirmSubmitBtn');
    const eventSelect = document.getElementById('event_id');

    // Client-side validation + confirmation modal
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        event.stopPropagation();

        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        const name = document.getElementById('student_name').value.trim();
        const admission = document.getElementById('admission_number').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const course = document.getElementById('course').value.trim();
        const eventText = eventSelect.options[eventSelect.selectedIndex].text;

        confirmBody.innerHTML = `
            <p class="mb-2"><strong>Student:</strong> ${escapeHtml(name)}</p>
            <p class="mb-2"><strong>Admission No.:</strong> ${escapeHtml(admission)}</p>
            <p class="mb-2"><strong>Email:</strong> ${escapeHtml(email)}</p>
            <p class="mb-2"><strong>Phone:</strong> ${escapeHtml(phone)}</p>
            <p class="mb-2"><strong>Course:</strong> ${escapeHtml(course)}</p>
            <p class="mb-0"><strong>Event:</strong> ${escapeHtml(eventText)}</p>
        `;

        confirmModal.show();
    });

    confirmButton.addEventListener('click', function () {
        confirmModal.hide();
        form.submit();
    });

    // Selected event information
    function updateSelectedEvent() {
        const option = eventSelect.options[eventSelect.selectedIndex];
        const emptyState = document.getElementById('eventEmptyState');
        const details = document.getElementById('eventDetails');
        const hint = document.getElementById('selectionHint');

        if (!eventSelect.value) {
            emptyState.style.display = 'block';
            details.style.display = 'none';
            hint.style.display = 'flex';
            return;
        }

        document.getElementById('selectedEventName').textContent = option.dataset.name;
        document.getElementById('selectedEventVenue').textContent = option.dataset.venue;
        document.getElementById('selectedEventDate').textContent = formatDate(option.dataset.date);
        document.getElementById('selectedEventDescription').textContent = option.dataset.description;

        emptyState.style.display = 'none';
        details.style.display = 'block';
        hint.style.display = 'none';
    }

    eventSelect.addEventListener('change', updateSelectedEvent);
    updateSelectedEvent();

    // Status message auto-hide
    const statusAlert = document.getElementById('statusAlert');
    if (statusAlert) {
        setTimeout(function () {
            statusAlert.style.transition = 'opacity .4s ease';
            statusAlert.style.opacity = '0';
            setTimeout(function () { statusAlert.remove(); }, 400);
        }, 4500);
    }

    function formatDate(value) {
        if (!value) return '';
        const date = new Date(value + 'T00:00:00');
        return date.toLocaleDateString('en-GB', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });
    }

    function escapeHtml(value) {
        const div = document.createElement('div');
        div.textContent = value;
        return div.innerHTML;
    }
});
