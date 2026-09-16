document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('recordsTable');
    const totalCount = document.getElementById('totalCount');
    const noResultsMsg = document.getElementById('noResultsMsg');

    if (!searchInput || !table) return;

    const rows = Array.from(table.querySelectorAll('tbody tr')).filter(row => row.children.length > 1);
    const originalTotal = rows.length;

    searchInput.addEventListener('input', function () {
        const query = searchInput.value.trim().toLowerCase();
        let visibleCount = 0;

        rows.forEach(function (row) {
            const match = row.textContent.toLowerCase().includes(query);
            row.style.display = match ? '' : 'none';
            if (match) visibleCount++;
        });

        totalCount.textContent = query === '' ? originalTotal : visibleCount;
        noResultsMsg.style.display = visibleCount === 0 && query !== '' ? 'block' : 'none';
    });
});
