const statStk = document.getElementById('statStk');

if (statStk) {
    statStk.addEventListener('click', e => {
        if (e.target.className === 'btn btn-danger delete-stat btn-sm') {
            if (confirm('Êtes-vous sûr de le supprimer?')) {
                const id = e.target.getAttribute('data-id');
                fetch(`/cnslt/stk/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}