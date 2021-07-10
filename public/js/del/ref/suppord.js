const PrmOrd = document.getElementById('PrmOrd');

if (PrmOrd) {
    PrmOrd.addEventListener('click', e => {
        if (e.target.className === 'btn btn-danger delete-tp btn-sm') {
            if (confirm('Êtes-vous sûr de le supprimer?')) {
                const id = e.target.getAttribute('data-id');
                fetch(`/ord/typeprix/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
        else if (e.target.className === 'btn btn-danger delete-tv btn-sm'){
            if (confirm('Êtes-vous sûr de le supprimer?')) {
                const id = e.target.getAttribute('data-id');
                fetch(`/ord/typevld/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
        else if (e.target.className === 'btn btn-danger delete-st btn-sm'){
            if (confirm('Êtes-vous sûr de le supprimer?')) {
                const id = e.target.getAttribute('data-id');
                fetch(`/ord/stat/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}