document.addEventListener('DOMContentLoaded', function () {
    // UPDATE ANIME FOR USER
    // Buttons
    let showPage = document.getElementsByClassName('show-page');
    if (showPage[0]) {
        document.getElementById('watching').addEventListener('click', function (e) {
            e.preventDefault();
            updateStatus('watching');
        });

        document.getElementById('watched').addEventListener('click', function (e) {
            e.preventDefault();
            updateStatus('watched');
        });

        document.getElementById('planned').addEventListener('click', function (e) {
            e.preventDefault();
            updateStatus('planned');
        });

        //Stars
        document.getElementById('star5').addEventListener('click', function (e) {
            e.preventDefault();
            updateStatus(null, 5);
        });
        document.getElementById('star4').addEventListener('click', function (e) {
            e.preventDefault();
            updateStatus(null, 4);
        });
        document.getElementById('star3').addEventListener('click', function (e) {
            e.preventDefault();
            updateStatus(null, 3);
        });
        document.getElementById('star2').addEventListener('click', function (e) {
            e.preventDefault();
            updateStatus(null, 2);
        });
        document.getElementById('star1').addEventListener('click', function (e) {
            e.preventDefault();
            updateStatus(null, 1);
        });

        async function updateStatus(status, rating) {
            const animeId = document.getElementById('animeId').value;
            const animeSlug = document.getElementById('animeSlug').value;
            const url = `http://never-library/user/${animeId}/${animeSlug}`;
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const request = new Request(url, {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token,
                    credentials: "same-origin",
                },
                body: JSON.stringify({
                    type: status,
                    rating: rating,
                }),
                method: 'POST'
            });

            const response = await fetch(request)
                .then(data => data.json())
                .then(data => updateInterface(data))
                .catch(error => {
                    // window.location.replace("http://never-library/user/create");
                    console.log(error.message)
                });

            function updateInterface(data) {
                if (data.message === 'Unauthenticated.') {
                    window.location.replace("http://never-library/user/create");
                }
                if (data.type) {
                    updateTypeAnime(data.type);
                }
                if (data.rating) {
                    updateRatingAnime(data.rating);
                }

            }


        }

        const animeType = document.getElementById('animeType').value ?? null;
        const animeRating = document.getElementById('animeRating').value / 2 ?? null;
        if (animeType || animeRating) {
            updateAnimeInterface(animeType, animeRating);
        }

        function updateAnimeInterface(animeType, animeRating) {
            if (animeType) {
                updateTypeAnime(animeType);
            }
            if (animeRating) {
                updateRatingAnime(animeRating);
            }
        }

        //Comment
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        document.getElementById('submitDescription').addEventListener('click', function (e) {
            e.preventDefault();
            let comment = document.getElementById('comment').value
            sendCommentToController(comment, token);
        });

        async function sendCommentToController(comment, token) {
            const animeId = document.getElementById('animeId').value;
            const animeSlug = document.getElementById('animeSlug').value;
            const url = `http://never-library/user/comment/${animeId}/${animeSlug}`;
            const request = new Request(url, {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token,
                    credentials: "same-origin",
                },
                body: JSON.stringify({
                    comment: comment,
                }),
                method: 'POST'
            });

            const response = await fetch(request)
                .then(data => data.json())
                .then(data => location.reload())
                .catch(error => {
                    console.log(error.message)
                });
        }

        function updateTypeAnime(type) {
            const watching = document.getElementsByClassName(`view-watching`);
            const watched = document.getElementsByClassName(`view-watched`);
            const planned = document.getElementsByClassName(`view-planned`);

            let element = document.getElementsByClassName(`view-${type}`);

            watching[0].classList.remove("active");
            watched[0].classList.remove("active");
            planned[0].classList.remove("active");
            element[0].classList.add("active");
        }

        function updateRatingAnime(rating) {
            let stars = document.getElementsByClassName('star');
            stars[0].classList.remove("active");
            stars[1].classList.remove("active");
            stars[2].classList.remove("active");
            stars[3].classList.remove("active");
            stars[4].classList.remove("active");
            for (let i = 0; i < rating; i++) {
                stars[i].classList.add("active")
            }
        }
    }
    // END UPDATE ANIME FOR USER

// UPLOAD OR UPDATE USER IMG
    let profilePage = document.getElementsByClassName('profile-page');
    if (profilePage[0]) {

        document.getElementById('editImage').addEventListener('change', function (e) {
            e.preventDefault();
            uploadUserImg(e);
        });

        function uploadUserImg(event) {
            const btn = document.getElementById('submitEditImage');
            const form = document.getElementById('formEditImage');
            btn.click();
            form.submit();
        }


    }
// END UPLOAD OR UPDATE USER IMG

    //ADMIN PANEL SEASON EVENTS



    //END ADMIN PANEL SEASON EVENTS


});
