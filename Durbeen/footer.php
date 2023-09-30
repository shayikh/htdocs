<script src="./js/bootstrap.bundle.min.js"></script>
<script src="./js/all.min.js"></script>
<script src="./js/alertify.min.js"></script>

<script>
    let pwd = document.querySelector('.pwd');
    let icon = document.querySelector('.icon');




    function showPwd() {
        if (pwd.type == 'password') {
            pwd.type = 'text';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else if (pwd.type == 'text') {
            pwd.type = 'password';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    };


    window_size()

    function window_size() {

        // let width = window.innerWidth;
        let width = window.screen.width;

        if (width < 500) {
            window.location = "./m/";
        }
    }

    const logout = (unique_id_me) => {
        let id_data = {};

        id_data.unique_id_me = unique_id_me;

        axios.post("./api/logout.php",
                id_data, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
            .then(res => {

                // console.log(res.data);
                window.location = './?out'



            })
            .catch(err => {
                console.log(err);
            })
    }

</script>

</body>

</html>
