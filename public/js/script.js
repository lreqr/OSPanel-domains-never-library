document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('watchingButton').addEventListener('click', function (e){
       e.preventDefault();
       updateStatus('watching');
    });

    document.getElementById('watchedButton').addEventListener('click', function (e){
       e.preventDefault();
        updateStatus('watched');
    });

    document.getElementById('plannedButton').addEventListener('click', function (e){
       e.preventDefault();
        updateStatus('planned');
    });

    function updateStatus(status){
        let animeId = document.getElementById('animeId').value;
        let animeSlug = document.getElementById('animeSlug').value;
        // console.log('Аниме ссылка http://never-library/user/' + animeId + '/' + animeSlug);
        fetch('http://never-library/user/' + animeId + '/' + animeSlug,{
            method: 'POST',
            headers:{
                'Content-Type': 'text/plain',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ status: status })
        })
            .then(response => {
                if (response.ok){
                    console.log('Статус успешно обновлен');
                } else {
                    console.error('Произошла ошибка при обновлении статуса');
                }
            })
            .catch(error => {
                console.error('Произошла ошибка', error);
            })

    }
});
