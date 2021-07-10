const stat = document.getElementById('stat');

if (stat) {
    stat.addEventListener('click', e => {
        if (e.target.className === 'btn btn-danger delete-stat btn-sm') {
            if (confirm('Êtes-vous sûr de le supprimer?')) {
                const id = e.target.getAttribute('data-id');
                fetch(`/cnslt/ord/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}