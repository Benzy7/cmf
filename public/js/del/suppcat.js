const categories = document.getElementById('categories');

if (categories) {
    categories.addEventListener('click', e => {
        if (e.target.className === 'btn btn-danger delete-cat btn-sm') {
            if (confirm('Êtes-vous sûr de le supprimer?')) {
                const id = e.target.getAttribute('data-id');
                fetch(`/ctgav/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}